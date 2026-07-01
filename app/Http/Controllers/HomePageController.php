<?php

namespace App\Http\Controllers;

use App\Mail\SponsorshipApplicationMail;
use App\Mail\WelcomeUserMail;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\MoodleUser;
use App\Models\SponsorshipApplication;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    /**
     * Generate a SHA‑512 crypt hash (compatible with Moodle's $6$ format)
     *
     * @param string $password
     * @param int $rounds
     * @return string
     */
    private function generateSha512CryptHash($password, $rounds = 10000)
    {
        // Generate a random 16‑character salt (using characters ./0-9A-Za-z)
        $salt = '';
        $saltChars = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        for ($i = 0; $i < 16; $i++) {
            $salt .= $saltChars[random_int(0, 63)];
        }

        // Build the crypt format: $6$rounds=10000$salt$
        $cryptFormat = '$6$rounds=' . $rounds . '$' . $salt . '$';

        // Generate the hash
        $hash = crypt($password, $cryptFormat);

        return $hash;
    }

    /**
     * Get the price for a course from Moodle's custom field.
     */
    private function getCoursePrice($courseId)
    {
        $enrolment = DB::table('mdlhpdl_enrol')
            ->where('courseid', $courseId)
            ->where('enrol', 'fee') // Change to 'stripe' if needed
            ->where('status', 1)
            ->first();

        return $enrolment ? floatval($enrolment->cost) : 0; // 0 means free
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. Fetch featured courses
        $featuredCourses = Course::visible()
            ->where('mdlhpdl_course.id', '>', 1)
            ->leftJoin('mdlhpdl_course_categories', 'mdlhpdl_course.category', '=', 'mdlhpdl_course_categories.id')
            ->leftJoin('mdlhpdl_context', function($join) {
                $join->on('mdlhpdl_context.instanceid', '=', 'mdlhpdl_course.id')
                    ->where('mdlhpdl_context.contextlevel', '=', 50);
            })
            ->leftJoin('mdlhpdl_files', function($join) {
                $join->on('mdlhpdl_files.contextid', '=', 'mdlhpdl_context.id')
                    ->where('mdlhpdl_files.component', '=', 'course')
                    ->where('mdlhpdl_files.filearea', '=', 'overviewfiles')
                    ->where('mdlhpdl_files.filename', '!=', '.');
            })
            ->select(
                'mdlhpdl_course.*',
                'mdlhpdl_course_categories.name as category_name',
                'mdlhpdl_files.filename as image_filename',
                'mdlhpdl_files.contenthash as image_hash'
            )
            ->orderBy('mdlhpdl_course.sortorder', 'desc')
            ->limit(6)
            ->get();

        // 2. Fetch top courses
        $topCourses = Course::visible()
            ->where('mdlhpdl_course.id', '>', 1)
            ->leftJoin('mdlhpdl_course_categories', 'mdlhpdl_course.category', '=', 'mdlhpdl_course_categories.id')
            ->leftJoin('mdlhpdl_context', function($join) {
                $join->on('mdlhpdl_context.instanceid', '=', 'mdlhpdl_course.id')
                    ->where('mdlhpdl_context.contextlevel', '=', 50);
            })
            ->leftJoin('mdlhpdl_files', function($join) {
                $join->on('mdlhpdl_files.contextid', '=', 'mdlhpdl_context.id')
                    ->where('mdlhpdl_files.component', '=', 'course')
                    ->where('mdlhpdl_files.filearea', '=', 'overviewfiles')
                    ->where('mdlhpdl_files.filename', '!=', '.');
            })
            ->select(
                'mdlhpdl_course.*',
                'mdlhpdl_course_categories.name as category_name',
                'mdlhpdl_files.filename as image_filename',
                'mdlhpdl_files.contenthash as image_hash'
            )
            ->orderBy('mdlhpdl_course.sortorder', 'desc')
            ->limit(6)
            ->get();

        // 3. 🔽 COLLECT ALL COURSE IDs FROM BOTH COLLECTIONS
        $allCourseIds = $featuredCourses->pluck('id')->merge($topCourses->pluck('id'))->unique()->toArray();

        // 4. 🔽 FETCH ALL PRICES IN ONE SINGLE QUERY
        $enrolments = DB::table('mdlhpdl_enrol')
            ->whereIn('courseid', $allCourseIds)
            ->where('enrol', 'fee') // Change to 'stripe' if needed
            ->where('status', 1)
            ->get()
            ->keyBy('courseid'); // Key by course ID for fast lookup

        // 5. 🔽 ATTACH PRICES TO BOTH COLLECTIONS
        foreach ($featuredCourses as $course) {
            $enrol = $enrolments->get($course->id);
            $course->price = $enrol ? floatval($enrol->cost) : 0;
            $course->currency = $enrol ? $enrol->currency : 'USD';
        }

        foreach ($topCourses as $course) {
            $enrol = $enrolments->get($course->id);
            $course->price = $enrol ? floatval($enrol->cost) : 0;
            $course->currency = $enrol ? $enrol->currency : 'USD';
        }

        return view('pages.index', compact('featuredCourses', 'topCourses'));
    }

    /**
     * Show the about us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('pages.about-us');
    }

    /**
     * Show the contact us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('pages.contact-us');
    }

    /**
     * Show the testimonials page.
     *
     * @return \Illuminate\Http\Response
     */
    public function testimonials()
    {
        return view('pages.testimonials');
    }

    /**
     * Show the FAQs page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqs()
    {
        return view('pages.faqs');
    }

    /**
     * Show the sponsorship page.
     *
     * @return \Illuminate\Http\Response
     */
    public function sponsorship()
    {
        return view('pages.sponsorship');
    }

    /**
     * Show the faculty page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faculty()
    {
        return view('pages.faculty');
    }

    /**
     * Show the courses page with filtering and pagination.
     */
    public function courses(Request $request)
    {
        $selectedCategory = $request->input('category');
        
        // Build the base query – joining the enrol table to get the price
        $query = Course::visible()
            ->where('mdlhpdl_course.id', '>', 1) // exclude site course
            ->leftJoin('mdlhpdl_course_categories', 'mdlhpdl_course.category', '=', 'mdlhpdl_course_categories.id')
            ->leftJoin('mdlhpdl_context', function($join) {
                $join->on('mdlhpdl_context.instanceid', '=', 'mdlhpdl_course.id')
                    ->where('mdlhpdl_context.contextlevel', '=', 50);
            })
            ->leftJoin('mdlhpdl_files', function($join) {
                $join->on('mdlhpdl_files.contextid', '=', 'mdlhpdl_context.id')
                    ->whereRaw('mdlhpdl_files.id = (
                        SELECT f2.id FROM mdlhpdl_files f2
                        WHERE f2.contextid = mdlhpdl_context.id
                        AND f2.component = "course"
                        AND f2.filearea = "overviewfiles"
                        AND f2.filename != "."
                        ORDER BY f2.id ASC
                        LIMIT 1
                    )');
            })
            // 🔽 ADD THIS JOIN TO GET THE PRICE
            ->leftJoin('mdlhpdl_enrol', function($join) {
                $join->on('mdlhpdl_enrol.courseid', '=', 'mdlhpdl_course.id')
                    ->where('mdlhpdl_enrol.enrol', '=', 'fee') // or 'payrol, stripe'
                    ->where('mdlhpdl_enrol.status', '=', 1);      // only active enrolments
            })
            ->select(
                'mdlhpdl_course.*',
                'mdlhpdl_course_categories.name as category_name',
                'mdlhpdl_context.id as context_id',
                'mdlhpdl_files.filename as image_filename',
                'mdlhpdl_files.contenthash as image_hash',
                // 🔽 SELECT THE PRICE AND CURRENCY
                'mdlhpdl_enrol.cost as price',
                'mdlhpdl_enrol.currency as currency'
            );
        
        // Apply category filter
        if ($selectedCategory && is_numeric($selectedCategory)) {
            $query->where('mdlhpdl_course.category', $selectedCategory);
        }
        
        // Cache the results for 1 hour (adjust as needed)
        $cacheKey = 'courses_page_' . ($selectedCategory ?? 'all') . '_' . $request->get('page', 1);
        $courses = Cache::remember($cacheKey, 3600, function() use ($query) {
            return $query->orderBy('mdlhpdl_course.sortorder', 'desc')
                         ->orderBy('mdlhpdl_course.id', 'desc')
                         ->paginate(9);
        });
        
        // Get categories for the sidebar filter
        $categories = CourseCategory::where('visible', 1)
            ->orderBy('sortorder')
            ->get();
        
        return view('pages.courses', compact('courses', 'categories', 'selectedCategory'));
    }
    
    /**
     * Show detailed view of a single course with dynamic data
     */
    public function courseDetails($id)
    {
        $cacheKey = 'course_details_' . $id;
        
        $courseData = Cache::remember($cacheKey, 3600, function() use ($id) {
            // Main course query
            $course = Course::visible()
                ->where('mdlhpdl_course.id', $id)
                ->leftJoin('mdlhpdl_course_categories', 'mdlhpdl_course.category', '=', 'mdlhpdl_course_categories.id')
                ->leftJoin('mdlhpdl_context', function($join) {
                    $join->on('mdlhpdl_context.instanceid', '=', 'mdlhpdl_course.id')
                        ->where('mdlhpdl_context.contextlevel', '=', 50);
                })
                ->leftJoin('mdlhpdl_files', function($join) {
                    $join->on('mdlhpdl_files.contextid', '=', 'mdlhpdl_context.id')
                        ->where('mdlhpdl_files.component', '=', 'course')
                        ->where('mdlhpdl_files.filearea', '=', 'overviewfiles')
                        ->where('mdlhpdl_files.filename', '!=', '.');
                })
                // JOIN TO GET THE PRICE
                ->leftJoin('mdlhpdl_enrol', function($join) {
                    $join->on('mdlhpdl_enrol.courseid', '=', 'mdlhpdl_course.id')
                        ->where('mdlhpdl_enrol.enrol', '=', 'fee') // Change to 'stripe' if needed
                        ->where('mdlhpdl_enrol.status', '=', 1);
                })
                ->select(
                    'mdlhpdl_course.*',
                    'mdlhpdl_course_categories.name as category_name',
                    'mdlhpdl_context.id as context_id',
                    'mdlhpdl_files.filename as image_filename',
                    'mdlhpdl_files.contenthash as image_hash',
                    'mdlhpdl_enrol.cost as price',
                    'mdlhpdl_enrol.currency as currency'
                )
                ->first();
            
            // If course not found, abort
            if (!$course) {
                abort(404, 'Course not found');
            }
            
            // Instructor – safe handling
            $instructor = null;
            if ($course->creatorid) {
                try {
                    // Use the correct table name – change this to whatever your actual user table is
                    $userTable = 'mdlhpdl_user';  // ← adjust this
                    $instructor = DB::table($userTable)
                        ->where('id', $course->creatorid)
                        ->select('id', 'firstname', 'lastname', 'email', 'picture', 'imagealt')
                        ->first();
                } catch (\Illuminate\Database\QueryException $e) {
                    // Log error but don't break the page
                    Log::error('Failed to fetch instructor: ' . $e->getMessage());
                }
            }
            
            // Sections
            $sections = DB::table('mdlhpdl_course_sections')
                ->where('course', $course->id)
                ->where('visible', 1)
                ->orderBy('section', 'asc')
                ->get(['id', 'name', 'summary', 'section']);
            
            // Ratings (optional, use fallbacks if table missing)
            $avgRating = 4.8;
            $ratingCount = 245;
            try {
                $avgRating = DB::table('mdlhpdl_rating')
                    ->where('contextid', $course->context_id)
                    ->where('ratingarea', 'course')
                    ->avg('rating');
                $ratingCount = DB::table('mdlhpdl_rating')
                    ->where('contextid', $course->context_id)
                    ->where('ratingarea', 'course')
                    ->count();
                $avgRating = $avgRating ? round($avgRating, 1) : 4.8;
                $ratingCount = $ratingCount ?: 245;
            } catch (\Exception $e) {
                // Ratings table might not exist – keep defaults
            }
            
            // Enrollment URL
            $moodleUrl = config('app.moodle_base_url', 'https://your-moodle.com');
            $enrollUrl = $moodleUrl . '/course/view.php?id=' . $course->id;

            $price = $course->price ? floatval($course->price) : 0;
            $currency = $course->currency ?? 'USD';
            
            return compact('course', 'instructor', 'sections', 'avgRating', 'ratingCount', 'enrollUrl', 'price', 'currency');
        });

        // Add dynamic cart check after cache (always fresh)
        $cart = session()->get('cart', []);
        $courseData['inCart'] = isset($cart[$courseData['course']->id]);
        
        return view('pages.course-details', $courseData);
    }
    
    /**
     * Serve course overview image from Moodle filedir
     */
    public function showFile($hash, $filename)
    {
        // Path: filedir/{first2}/{next2}/{full_hash}
        $first2 = substr($hash, 0, 2);
        $next2  = substr($hash, 2, 2);
        $path = "filedir/{$first2}/{$next2}/{$hash}";

        if (Storage::disk('moodle')->exists($path)) {
            $file = Storage::disk('moodle')->get($path);
            $mime = Storage::disk('moodle')->mimeType($path);
            return response($file, 200)->header('Content-Type', $mime);
        }

        // Fallback placeholder
        return response()->file(public_path('assets/img/course-placeholder.jpg'));
    }
    
    /**
     * Serve user profile picture from Moodle filedir
     * Note: Moodle stores user pictures as 'f1.jpg' or 'f2.jpg' in filedir.
     * The `picture` column contains a numeric hash; you may need to adjust.
     */
    public function showUserFile($userid, $hash, $filename)
    {
        $path = 'filedir/' . substr($hash, 0, 2) . '/' . $hash;
        
        if (Storage::disk('moodle')->exists($path)) {
            $file = Storage::disk('moodle')->get($path);
            $mimeType = Storage::disk('moodle')->mimeType($path);
            return response($file, 200)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
        }
        
        return response()->file(public_path('assets/img/avatar-placeholder.jpg'));
    }
    
    /**
     * Clear course cache (optional admin endpoint)
     */
    public function clearCache()
    {
        Cache::flush();
        return redirect()->back()->with('success', 'Course cache cleared.');
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',   // changed from email
            'password' => 'required',
        ]);

        // Validate against Moodle table using username
        $moodleUser = MoodleUser::validateCredentials($request->username, $request->password);
        if (!$moodleUser) {
            return back()->withErrors(['username' => 'Invalid username or account not confirmed/active'])->withInput();
        }

        // After validating Moodle credentials ($moodleUser)
        $user = User::updateOrCreate(
            ['email' => $moodleUser->email],
            [
                'firstname' => $moodleUser->firstname,
                'lastname'  => $moodleUser->lastname,
                'email'     => $moodleUser->email,
                'password'  => Hash::make($request->password), // local fallback hash
                'country'   => $moodleUser->country ?? null,
                'moodle_id' => $moodleUser->id,
            ]
        );

        Auth::login($user, $request->has('remember'));
        return redirect()->intended(route('courses'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        $countries = config('countries');
        return view('pages.auth.register', compact('countries'));
    }

    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'username'       => 'required|string|min:3|max:100|unique:mdlhpdl_user,username',
            'firstname'      => 'required|string|max:100',
            'lastname'       => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email|unique:mdlhpdl_user,email',
            'country'        => 'required|string|size:2',
            // NEW RULES
            'phone_primary'  => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/', // simple phone validation
            'phone_secondary'=> 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'referred_by'    => 'nullable|string|max:20', // ensure the code exists
            'password'       => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase, one lowercase, one digit, and one special character.',
            'phone_primary.regex' => 'Please enter a valid phone number.',
        ]);

        // Create Moodle user (only fields that exist in mdl_user)
        $now = time();
        $hashedPassword = $this->generateSha512CryptHash($request->password);

        $moodleId = DB::table('mdlhpdl_user')->insertGetId([
            'username'      => $request->username,
            'password'      => $hashedPassword,
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'email'         => $request->email,
            'country'       => $request->country,
            'confirmed'     => 1,
            'deleted'       => 0,
            'suspended'     => 0,
            'auth'          => 'manual',
            'phone1'        => $request->phone_primary,
            'phone2'        => $request->phone_secondary,
            'mnethostid'    => 1,
            'timecreated'   => $now,
            'timemodified'  => $now,
        ]);

        // ✅ Generate unique referral code for this user (e.g., 8-char alphanumeric)
        do {
            $referralCode = strtoupper(substr(md5(uniqid($moodleId, true)), 0, 8));
        } while (User::where('referral_code', $referralCode)->exists());

        // Create local user
        $user = User::create([
            'firstname'       => $request->firstname,
            'lastname'        => $request->lastname,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'country'         => $request->country,
            'moodle_id'       => $moodleId,
            // NEW FIELDS
            'referral_code'   => $referralCode,           // this user's own code
            'referred_by'     => $request->referred_by,   // code they used (if any)
            'phone_primary'   => $request->phone_primary,
            'phone_secondary' => $request->phone_secondary,
        ]);

        // Send welcome email (you can include the user's new referral code)
        Mail::to($request->email)->send(new WelcomeUserMail($request->firstname, $request->username, $request->password, $referralCode));

        Auth::login($user);

        return redirect()->route('cart.index')->with('success', 'Registration successful! Your referral code is: ' . $referralCode);
    }

    public function getBlogPosts()
    {
        $posts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.blog.index', compact('posts'));
    }

    public function showBlogPost($slug)
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // prevent multiple counts per session
        if (!session()->has('viewed_post_' . $post->id)) {
            $post->increment('views');
            session()->put('viewed_post_' . $post->id, true);
        }

        // Get previous and next posts (optional)
        $previous = BlogPost::published()
            ->where('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        $next = BlogPost::published()
            ->where('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        return view('pages.blog.show', compact('post', 'previous', 'next'));
    }

    public function storeSponsorshipApplication(Request $request)
    {       
        // Validate based on the form type
        $rules = [
            'type' => 'required|in:sponsor,student',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'consent' => 'accepted',
        ];

        if ($request->type === 'sponsor') {
            $rules['student_count'] = 'required|integer|min:1';
        } else {
            $rules['essay'] = 'required|string|min:50';
        }

        $validated = $request->validate($rules);

        // Store the application
        $application = SponsorshipApplication::create([
            'type' => $validated['type'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'student_count' => $validated['student_count'] ?? null,
            'essay' => $validated['essay'] ?? null,
            'consent' => true,
            'status' => 'pending',
        ]);

        // Send email to admin
        try {
            Mail::to(config('mail.admin_email', 'admin@bafai.ai'))
                ->send(new SponsorshipApplicationMail($application));
        } catch (\Exception $e) {
            Log::error('Failed to send sponsorship email: ' . $e->getMessage());
        }

        // Optionally send a confirmation email to the applicant
        // Mail::to($application->email)->send(new SponsorshipConfirmationMail($application));

        return redirect()->back()->with('success', 'Your application has been submitted successfully! We will contact you soon.');
    }
}
