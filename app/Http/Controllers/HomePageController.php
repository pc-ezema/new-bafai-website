<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUserMail;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\MoodleUser;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch featured courses (e.g., first 6 visible courses, ordered by sortorder)
        $featuredCourses = Course::visible()
            ->where('mdlhpdl_course.id', '>', 1) // exclude site course
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

        // Top rated courses (example: latest 6 courses, or you can join ratings table)
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
        
        // Build the base query – using a subquery to get a single overview file per course
        $query = Course::visible()
            ->where('mdlhpdl_course.id', '>', 1) // exclude site course
            ->leftJoin('mdlhpdl_course_categories', 'mdlhpdl_course.category', '=', 'mdlhpdl_course_categories.id')
            ->leftJoin('mdlhpdl_context', function($join) {
                $join->on('mdlhpdl_context.instanceid', '=', 'mdlhpdl_course.id')
                     ->where('mdlhpdl_context.contextlevel', '=', 50); // course context
            })
            ->leftJoin('mdlhpdl_files', function($join) {
                // Subquery: take only the first overview file (by id) for each context
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
            ->select(
                'mdlhpdl_course.*',
                'mdlhpdl_course_categories.name as category_name',
                'mdlhpdl_context.id as context_id',        // needed for direct pluginfile URL
                'mdlhpdl_files.filename as image_filename',
                'mdlhpdl_files.contenthash as image_hash'
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
                ->select(
                    'mdlhpdl_course.*',
                    'mdlhpdl_course_categories.name as category_name',
                    'mdlhpdl_context.id as context_id',
                    'mdlhpdl_files.filename as image_filename',
                    'mdlhpdl_files.contenthash as image_hash'
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
            
            // Price (example)
            $price = match($course->id) {
                5 => 199,
                6 => 299,
                10 => 399,
                12 => 249,
                default => 149,
            };
            
            return compact('course', 'instructor', 'sections', 'avgRating', 'ratingCount', 'enrollUrl', 'price');
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
        // Validation – add country rule
        $request->validate([
            'username'  => 'required|string|min:3|max:100|unique:mdlhpdl_user,username',
            'firstname' => 'required|string|max:100',
            'lastname'  => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email|unique:mdlhpdl_user,email',
            'country'   => 'required|string|size:2', // ISO 3166-1 alpha-2
            'password'  => [
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
        ]);

        // Create Moodle user (add country to insert)
        $now = time();
        $hashedPassword = $this->generateSha512CryptHash($request->password);

        $moodleId = DB::table('mdlhpdl_user')->insertGetId([
            'username'      => $request->username,
            'password'      => $hashedPassword,
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'email'         => $request->email,
            'country'       => $request->country,   // ADDED
            'confirmed'     => 1,
            'deleted'       => 0,
            'suspended'     => 0,
            'auth'          => 'manual',
            'mnethostid'    => 1,
            'timecreated'   => $now,
            'timemodified'  => $now,
        ]);

        // Create local Laravel user (optional: you can also store country here if needed)
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'country'   => $request->country,
            'moodle_id' => $moodleId,
        ]);

        // Send welcome email (include country if you want)
        Mail::to($request->email)->send(new WelcomeUserMail($request->firstname, $request->username, $request->password));

        Auth::login($user);

        return redirect()->route('cart.index')->with('success', 'Registration successful! Check your email for login details.');
    }
}
