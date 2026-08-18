<?php

namespace App\Http\Controllers;

use App\Mail\EnrollmentConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaystackController extends Controller
{
    /**
     * Get live USD to NGN exchange rate with caching (1 hour).
     */
    public function getExchangeRate()
    {
        return Cache::remember('usd_to_ngn_rate', 3600, function () {
            try {
                $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
                if ($response->successful()) {
                    $data = $response->json();
                    return $data['rates']['NGN'] ?? 1500;
                }
            } catch (\Exception $e) {
                Log::error('Exchange rate API failed: ' . $e->getMessage());
            }
            // Fallback rate
            return 1500;
        });
    }

    /**
     * Verify Paystack payment and enroll the user.
     */
    public function verify($reference)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
        ])->get('https://api.paystack.co/transaction/verify/' . $reference);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] && $data['data']['status'] === 'success') {
                // Payment successful – enroll the user
                $cart = session()->get('paystack_cart', []);
                if (empty($cart)) {
                    return redirect()->route('cart.index')->with('error', 'Cart not found.');
                }

                $user = Auth::user();
                if (!$user) {
                    return redirect()->route('login')->with('error', 'Please login to enroll.');
                }

                // Find Moodle user by email
                $moodleUser = DB::table('mdlhpdl_user')
                    ->where('email', $user->email)
                    ->first();

                if (!$moodleUser) {
                    return redirect()->route('cart.index')->with('error', 'No matching Moodle account found. Please contact support.');
                }

                // Get course details for the email
                $courseIds = array_keys($cart);
                $courses = DB::table('mdlhpdl_course')
                    ->whereIn('id', $courseIds)
                    ->select('id', 'fullname', 'shortname')
                    ->get();

                $errors = [];
                $enrolledCourses = [];

                foreach ($courseIds as $courseId) {
                    $success = $this->addUserToSiteCohort($moodleUser->id, $courseId);
                    if ($success) {
                        $enrolledCourses[] = $courseId;
                    } else {
                        $errors[] = "Failed to enroll in course ID $courseId";
                    }
                }

                // Clear payment session data
                session()->forget(['paystack_reference', 'paystack_cart', 'paystack_amount']);

                // If at least one course was enrolled, send confirmation email
                if (!empty($enrolledCourses)) {
                    // Get the course objects for enrolled courses
                    $enrolledCourseDetails = $courses->filter(function($course) use ($enrolledCourses) {
                        return in_array($course->id, $enrolledCourses);
                    });

                    try {
                        Mail::to($user->email)->send(new EnrollmentConfirmationMail($user, $enrolledCourseDetails, null));
                    } catch (\Exception $e) {
                        Log::error('Failed to send enrollment email: ' . $e->getMessage());
                    }

                    // Clear the cart
                    session()->forget('cart');

                    return redirect()->route('cart.index')
                        ->with('success', '🎉 Payment successful! You are now enrolled. A confirmation email has been sent to your inbox.');
                }

                if (!empty($errors)) {
                    return redirect()->route('cart.index')->with('errors', $errors);
                }

                return redirect()->route('cart.index')->with('error', 'Something went wrong. Please contact support.');
            }
        }

        Log::error('Paystack verification failed for reference: ' . $reference . ' Response: ' . $response->body());
        return redirect()->route('cart.index')->with('error', 'Payment verification failed. Please contact support.');
    }

    /**
     * Add a Moodle user to a site‑wide cohort (copied from CartController).
     */
    private function addUserToSiteCohort($moodleUserId, $courseId)
    {
        try {
            $course = DB::table('mdlhpdl_course')->where('id', $courseId)->first();
            if (!$course) {
                Log::error("Course {$courseId} not found.");
                return false;
            }

            $cohortName = strtolower($course->shortname) . '-' . now()->format('Y-m-d');

            // System context (level 10)
            $systemContextId = DB::table('mdlhpdl_context')
                ->where('contextlevel', 10)
                ->value('id');

            if (!$systemContextId) {
                Log::error("System context not found.");
                return false;
            }

            // Find existing cohort
            $cohort = DB::table('mdlhpdl_cohort')
                ->where('name', $cohortName)
                ->where('contextid', $systemContextId)
                ->first();

            if (!$cohort) {
                $now = time();
                $cohortId = DB::table('mdlhpdl_cohort')->insertGetId([
                    'name'              => $cohortName,
                    'idnumber'          => $cohortName,
                    'contextid'         => $systemContextId,
                    'description'       => 'Auto‑generated cohort for ' . $course->shortname . ' starting ' . now()->toDateString(),
                    'descriptionformat' => 1,
                    'visible'           => 1,
                    'component'         => '',
                    'timecreated'       => $now,
                    'timemodified'      => $now,
                ]);
                Log::info("Created new site cohort '{$cohortName}' (ID: {$cohortId})");
            } else {
                $cohortId = $cohort->id;
            }

            // Add user if not already a member
            $alreadyMember = DB::table('mdlhpdl_cohort_members')
                ->where('cohortid', $cohortId)
                ->where('userid', $moodleUserId)
                ->exists();

            if (!$alreadyMember) {
                DB::table('mdlhpdl_cohort_members')->insert([
                    'cohortid'  => $cohortId,
                    'userid'    => $moodleUserId,
                    'timeadded' => time(),
                ]);
                Log::info("User {$moodleUserId} added to cohort {$cohortId}");
            }

            return true;
        } catch (\Exception $e) {
            Log::error("Cohort assignment exception: " . $e->getMessage());
            return false;
        }
    }
}
