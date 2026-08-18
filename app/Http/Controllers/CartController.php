<?php

namespace App\Http\Controllers;

use App\Mail\EnrollmentConfirmationMail;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display cart contents.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $courses = [];
        $total = 0;

        if (!empty($cart)) {
            $courseIds = array_keys($cart);

            // Fetch course details
            $courses = DB::table('mdlhpdl_course')
                ->whereIn('id', $courseIds)
                ->select('id', 'fullname', 'summary', 'category')
                ->get();

            // 🔽 Fetch ALL enrolments for these courses in ONE query (efficient!)
            $enrolments = DB::table('mdlhpdl_enrol')
                ->whereIn('courseid', $courseIds)
                ->where('enrol', 'fee') // Change to 'stripe' if needed
                ->where('status', 1)
                ->get()
                ->keyBy('courseid'); // Key the collection by course ID for easy lookup

            // Attach price & currency to each course
            foreach ($courses as $course) {
                $enrol = $enrolments->get($course->id);
                $course->price = $enrol ? floatval($enrol->cost) : 0;
                $course->currency = $enrol ? $enrol->currency : 'USD';
                $total += $course->price;
            }
        }

        return view('pages.cart.index', compact('courses', 'total'));
    }

    /**
     * Add a course to cart (no quantity – just once).
     */
    public function add(Request $request)
    {
        $courseId = $request->input('course_id');
        $cart = session()->get('cart', []);

        if (!isset($cart[$courseId])) {
            $cart[$courseId] = true;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Course added to cart!');
        }

        return redirect()->back()->with('info', 'Course is already in your cart.');
    }

    /**
     * Remove a course from cart.
     */
    public function remove($courseId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$courseId])) {
            unset($cart[$courseId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Course removed.');
    }

    /**
     * Enroll the logged-in user into all courses in the cart.
     */
    public function enroll(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $user = Auth::user();
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
            if ($this->addUserToSiteCohort($moodleUser->id, $courseId)) {
                $enrolledCourses[] = $courseId;
            } else {
                $errors[] = "Failed to enroll in course ID $courseId";
            }
        }

        // If at least one course was enrolled, clear cart and send email
        if (!empty($enrolledCourses)) {
            // Get the course objects for enrolled courses
            $enrolledCourseDetails = $courses->filter(function($course) use ($enrolledCourses) {
                return in_array($course->id, $enrolledCourses);
            });

            // Send confirmation email
            try {
                Mail::to($user->email)->send(new EnrollmentConfirmationMail($user, $enrolledCourseDetails, null));
            } catch (\Exception $e) {
                Log::error('Failed to send enrollment email: ' . $e->getMessage());
            }

            // Clear the cart
            session()->forget('cart');

            return redirect()->route('cart.index')
                ->with('success', '🎉 You have been successfully enrolled! A confirmation email has been sent to your inbox.');
        }

        if (!empty($errors)) {
            return redirect()->route('cart.index')->with('errors', $errors);
        }

        return redirect()->route('cart.index')->with('error', 'Something went wrong. Please contact support.');
    }

    /**
     * Add a Moodle user to a site‑wide cohort (no course enrolment).
     * The cohort name is based on course shortname + date.
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

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    /**
     * Show checkout page.
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Fetch courses and prices
        $courseIds = array_keys($cart);
        $courses = DB::table('mdlhpdl_course')->whereIn('id', $courseIds)->get();
        $enrolments = DB::table('mdlhpdl_enrol')
            ->whereIn('courseid', $courseIds)
            ->where('enrol', 'fee')
            ->where('status', 1)
            ->get()
            ->keyBy('courseid');

        $totalUSD = 0;
        foreach ($courses as $course) {
            $enrol = $enrolments->get($course->id);
            $course->price = $enrol ? floatval($enrol->cost) : 0;
            $totalUSD += $course->price;
        }

        // If total is zero, free checkout
        if ($totalUSD <= 0) {
            return view('pages.cart.free-checkout', compact('courses'));
        }

        // Check for discount – apply in USD first
        $discountCode = session()->get('discount_code');
        $discount = null;
        $discountAmountUSD = 0;
        $finalUSD = $totalUSD;

        if ($discountCode) {
            $discount = Discount::where('code', $discountCode)->first();
            if ($discount && $discount->isValid()) {
                $finalUSD = $discount->applyTo($totalUSD);          // discounted total
                $discountAmountUSD = $totalUSD - $finalUSD;        // discount in USD
            } else {
                session()->forget('discount_code');
            }
        }

        // 🔽 Now compute NGN and Stripe using the FINAL USD amount
        $paystack = new PaystackController();
        $rate = $paystack->getExchangeRate();

        $totalNaira = $finalUSD * $rate;
        $discountAmountNaira = $discountAmountUSD * $rate;
        $amountInKobo = (int) round($totalNaira * 100);
        $stripeAmount = (int) round($finalUSD * 100);

        // Generate Paystack reference
        $paystackRef = 'BAFAI-' . strtoupper(Str::random(10));

        session()->put('paystack_reference', $paystackRef);
        session()->put('paystack_cart', $cart);
        session()->put('paystack_amount', $amountInKobo);

        return view('pages.cart.checkout', compact(
            'courses',
            'totalUSD',                // original subtotal (for display)
            'finalUSD',                // discounted total (for payments)
            'discountAmountUSD',
            'discountAmountNaira',
            'totalNaira',
            'rate',
            'amountInKobo',
            'paystackRef',
            'stripeAmount'
        ));
    }

    public function applyDiscount(Request $request)
    {
        $request->validate(['code' => 'required|string|max:50']);
        $code = $request->code;
        $discount = Discount::where('code', $code)->first();

        if (!$discount || !$discount->isValid()) {
            return response()->json(['error' => 'Invalid or expired discount code.'], 422);
        }

        session()->put('discount_code', $code);
        session()->put('discount_id', $discount->id);
        return response()->json(['success' => 'Discount applied!']);
    }

    public function removeDiscount()
    {
        session()->forget(['discount_code', 'discount_id']);
        return response()->json(['success' => 'Discount removed.']);
    }
}