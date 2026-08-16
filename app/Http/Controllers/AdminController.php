<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Discount;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    /**
     * Logout.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    /**
     * Dashboard – show stats.
     */
    public function dashboard()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalBlogs' => BlogPost::count(),
            // 'totalResources' => Resource::count(),
            'recentUsers' => User::latest()->limit(5)->get(),
            'recentBlogs' => BlogPost::latest()->limit(5)->get(),
            // 'recentResources' => Resource::latest()->limit(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Display a listing of blog posts.
     */
    public function indexBlog()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('posts'));
    }

    /**
     * Display all registered users with filters and search.
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by country
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Filter by course interest
        if ($request->filled('course_interest')) {
            $query->where('course_interest', $request->course_interest);
        }

        // Filter by referral code used (referred_by)
        if ($request->filled('referred_by')) {
            $query->where('referred_by', $request->referred_by);
        }

        // Filter by registration date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        // Get distinct countries and course interests for filter dropdowns
        $countries = User::distinct()->pluck('country')->filter()->values();
        $interests = User::distinct()->pluck('course_interest')->filter()->values();

        return view('admin.users', compact('users', 'countries', 'interests'));
    }

    /**
     * Export users as CSV (filters applied).
     */
    public function exportUsersCsv(Request $request)
    {
        $query = User::query();

        // Apply same filters as in users() method
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('course_interest')) {
            $query->where('course_interest', $request->course_interest);
        }
        if ($request->filled('referred_by')) {
            $query->where('referred_by', $request->referred_by);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        // CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_export_' . date('Y-m-d') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($users) {
            $handle = fopen('php://output', 'w');

            // Add CSV header row
            fputcsv($handle, [
                'ID', 'First Name', 'Last Name', 'Email', 'Country',
                'Phone Primary', 'Phone Secondary', 'Referral Code',
                'Referred By', 'Course Interest', 'Moodle ID', 'Registered At'
            ]);

            // Add data rows
            foreach ($users as $user) {
                fputcsv($handle, [
                    $user->id,
                    $user->firstname,
                    $user->lastname,
                    $user->email,
                    $user->country,
                    $user->phone_primary,
                    $user->phone_secondary,
                    $user->referral_code,
                    $user->referred_by,
                    $user->course_interest,
                    $user->moodle_id,
                    $user->created_at,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function createBlog()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created blog post.
     */
    public function storeBlog(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'excerpt'       => 'nullable|string|max:500',
            'content'       => 'required|string',
            'featured_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author'        => 'nullable|string|max:100',
            // 'is_published'  => 'boolean',
            'published_at'  => 'nullable|date',
        ], [
            'title.required' => 'The blog title is required.',
            'content.required' => 'Please write some content for your blog post.',
            'featured_image.image' => 'The featured image must be an image file.',
            'featured_image.max' => 'The featured image must not be larger than 2MB.',
            'published_at.date' => 'Please enter a valid date and time.',
        ]);

        // ✅ Set is_published from checkbox presence
        $validated['is_published'] = $request->has('is_published');

        // ✅ Generate unique slug
        $validated['slug'] = Str::slug($request->title);
        // Ensure unique slug
        $slug = $validated['slug'];
        $count = 1;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $validated['slug'] . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // 🔽 Handle image upload – save to public/assets/img/blog/
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Move image directly to public/assets/img/blog/
            $image->move(public_path('assets/img/blog'), $filename);
            
            // Store only the filename in the database
            $validated['featured_image'] = $filename;
        }

        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->published_at ?? now();

        BlogPost::create($validated);

        return redirect()->route('admin.blogs.index')
                         ->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the blog post.
     */
    public function editBlog(BlogPost $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified blog post.
     */
    public function updateBlog(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'excerpt'       => 'nullable|string|max:500',
            'content'       => 'required|string',
            'featured_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author'        => 'nullable|string|max:100',
            // 'is_published'  => 'boolean',
            'published_at'  => 'nullable|date',
        ], [
            'title.required' => 'The blog title is required.',
            'content.required' => 'Please write some content for your blog post.',
            'featured_image.image' => 'The featured image must be an image file.',
            'featured_image.max' => 'The featured image must not be larger than 2MB.',
            'published_at.date' => 'Please enter a valid date and time.',
        ]);

        // Update slug if title changed
        if ($blog->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = Str::slug($request->title) . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        // 🔽 Handle image upload – save to public/assets/img/blog/
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                $oldImagePath = public_path('assets/img/blog/' . $blog->featured_image);
                if (file::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Move image directly to public/assets/img/blog/
            $image->move(public_path('assets/img/blog'), $filename);
            
            // Store only the filename in the database
            $validated['featured_image'] = $filename;
        }

        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->published_at ?? $blog->published_at ?? now();

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
                         ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroyBlog(BlogPost $blog)
    {
        // Delete featured image if exists
        if ($blog->featured_image) {
            $imagePath = public_path('asset/img/blog/' . $blog->featured_image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $blog->delete();

        return redirect()->route('admin.blogs.index')
                         ->with('success', 'Blog post deleted successfully.');
    }

    public function indexResource()
    {
        $resources = Resource::orderBy('created_at', 'desc')->get();
        return view('admin.resources.index', compact('resources'));
    }

    public function createResource()
    {
        return view('admin.resources.create');
    }

    public function storeResource(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'type'          => 'required|in:document,video,link,other',
            'file'          => 'nullable|file|max:10240', // 10MB
            'external_url'  => 'nullable|url|max:255',
            // 'is_published'  => 'nullable|boolean',
        ], [
            'title.required' => 'Resource title is required.',
            'type.required'  => 'Please select a resource type.',
            'file.max'       => 'File must not exceed 10MB.',
            'external_url.url' => 'Please enter a valid URL.',
        ]);

        // 🔥 Remove the 'file' key from validated data – it's not a DB column
        unset($validated['file']);

        // Handle file upload
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('resources', 'public');
            $validated['file_path'] = $path;
            $validated['external_url'] = null; // clear external if file uploaded
        }

        // If external_url is provided, clear file_path
        if ($request->filled('external_url')) {
            $validated['external_url'] = $request->external_url;
            $validated['file_path'] = null;
        }

        // Both file and external_url can't be empty
        if (empty($validated['file_path']) && empty($validated['external_url'])) {
            return back()->withErrors(['file' => 'Please upload a file or provide an external URL.'])->withInput();
        }

        $validated['is_published'] = $request->has('is_published');

        Resource::create($validated);

        return redirect()->route('admin.resources.index')
                         ->with('success', 'Resource created successfully.');
    }

    public function editResource(Resource $resource)
    {
        return view('admin.resources.edit', compact('resource'));
    }


    public function updateResource(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'type'          => 'required|in:document,video,link,other',
            'file'          => 'nullable|file|max:10240',
            'external_url'  => 'nullable|url|max:255',
            // 'is_published'  => 'nullable|boolean',
        ], [
            'title.required' => 'Resource title is required.',
            'type.required'  => 'Please select a resource type.',
            'file.max'       => 'File must not exceed 10MB.',
            'external_url.url' => 'Please enter a valid URL.',
        ]);

        // 🔥 Remove the 'file' key from validated data – it's not a DB column
        unset($validated['file']);

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }
            $path = $request->file('file')->store('resources', 'public');
            $validated['file_path'] = $path;
            $validated['external_url'] = null;
        }

        // If external_url is provided, clear file_path
        if ($request->filled('external_url')) {
            // Delete old file if exists
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }
            $validated['external_url'] = $request->external_url;
            $validated['file_path'] = null;
        }

        // Ensure either file or url is present
        if (empty($validated['file_path']) && empty($validated['external_url'])) {
            // If both are empty, try to keep existing values
            $validated['file_path'] = $resource->file_path;
            $validated['external_url'] = $resource->external_url;
        }

        $validated['is_published'] = $request->has('is_published');

        $resource->update($validated);

        return redirect()->route('admin.resources.index')
                         ->with('success', 'Resource updated successfully.');
    }

    public function destroyResource(Resource $resource)
    {
        // Delete file if exists
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }
        $resource->delete();

        return redirect()->route('admin.resources.index')
                         ->with('success', 'Resource deleted successfully.');
    }

    public function indexDiscount()
    {
        $discounts = Discount::orderBy('created_at', 'desc')->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function createDiscount()
    {
        return view('admin.discounts.create');
    }

    public function storeDiscount(Request $request)
    {
        $validated = $request->validate([
            'code'       => 'required|string|max:50|unique:discounts,code',
            'type'       => 'required|in:percentage,fixed',
            'value'      => 'required|numeric|min:0.01',
            'max_uses'   => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date|after:now',
            // 'is_active'  => 'boolean',
        ], [
            'code.required' => 'Discount code is required.',
            'code.unique'   => 'This discount code already exists.',
            'value.required'=> 'Discount value is required.',
            'value.numeric' => 'Discount value must be a number.',
            'expires_at.date' => 'Please enter a valid expiration date.',
        ]);

        $validated['is_active'] = $request->has('is_active');
        Discount::create($validated);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount code created.');
    }

    public function editDiscount(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function updateDiscount(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'code'       => 'required|string|max:50|unique:discounts,code,' . $discount->id,
            'type'       => 'required|in:percentage,fixed',
            'value'      => 'required|numeric|min:0.01',
            'max_uses'   => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date|after:now',
            // 'is_active'  => 'boolean',
        ], [
            'code.required' => 'Discount code is required.',
            'code.unique'   => 'This discount code already exists.',
            'value.required'=> 'Discount value is required.',
            'value.numeric' => 'Discount value must be a number.',
            'expires_at.date' => 'Please enter a valid expiration date.',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $discount->update($validated);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated.');
    }

    public function destroyDiscount(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted.');
    }
}
