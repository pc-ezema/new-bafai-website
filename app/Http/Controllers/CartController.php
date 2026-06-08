<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            // Fetch course details from Moodle DB
            $courses = DB::table('mdlhpdl_course')
                ->whereIn('id', array_keys($cart))
                ->select('id', 'fullname', 'summary', 'category')
                ->get();

            // Add price (you can use your price logic)
            foreach ($courses as $course) {
                $price = $this->getCoursePrice($course->id);
                $course->price = $price;
                $total += $price;
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

        $errors = [];
        foreach (array_keys($cart) as $courseId) {
            if ($this->addUserToSiteCohort($moodleUser->id, $courseId)) {
                // success
                session()->forget('cart');
            } else {
                $errors[] = "Failed to enroll in course ID $courseId";
            }
        }

        if (empty($errors)) {
            return redirect()->route('cart.index')->with('success', 'You have been enrolled in all selected courses!');
        } else {
            return redirect()->route('cart.index')->with('errors', $errors);
        }
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
                    'descriptionformat' => 1,   // FORMAT_HTML = 1
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
     * Helper: Get course price (same logic as in your controller).
     */
    private function getCoursePrice($courseId)
    {
        return match($courseId) {
            5 => 199,
            6 => 299,
            10 => 399,
            12 => 249,
            default => 149,
        };
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Fetch course details
        $courses = DB::table('mdlhpdl_course')
            ->whereIn('id', array_keys($cart))
            ->get();

        // Attach price to each course and calculate total
        $total = 0;
        foreach ($courses as $course) {
            $course->price = $this->getCoursePrice($course->id);
            $total += $course->price;
        }

        return view('pages.cart.checkout', compact('courses', 'total'));
    }
}