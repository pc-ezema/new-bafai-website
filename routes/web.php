<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/about-us', [HomePageController::class, 'about'])->name('about-us');
Route::get('/contact-us', [HomePageController::class, 'contact'])->name('contact-us');
Route::get('/testimonials', [HomePageController::class, 'testimonials'])->name('testimonials');
Route::get('/faqs', [HomePageController::class, 'faqs'])->name('faqs');
Route::get('/sponsorship', [HomePageController::class, 'sponsorship'])->name('sponsorship');
Route::get('/faculty', [HomePageController::class, 'faculty'])->name('faculty');
Route::get('/courses', [HomePageController::class, 'courses'])->name('courses');
Route::get('/course/{slug}', [HomePageController::class, 'courseDetails'])->name('course-details');
Route::get('/moodle-file/{hash}/{filename}', [HomePageController::class, 'showFile'])->name('moodle.file');
Route::get('/blog', [HomePageController::class, 'getBlogPosts'])->name('blog.index');
Route::get('/blog/{slug}', [HomePageController::class, 'showBlogPost'])->name('blog.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{courseId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart-count', function () {
    $cart = session()->get('cart', []);
    return response()->json(['count' => count($cart)]);
})->name('cart-count');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [CartController::class, 'process'])->name('checkout');
    Route::post('/cart/enroll', [CartController::class, 'enroll'])->name('cart.enroll');
});
Route::post('/sponsorship/apply', [HomePageController::class, 'storeSponsorshipApplication'])->name('sponsorship.apply');


Route::get('/login', [HomePageController::class, 'login'])->name('login');
Route::post('/login', [HomePageController::class, 'authenticate'])->name('login.post');
Route::get('/register', [HomePageController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [HomePageController::class, 'register'])->name('register.post');
Route::post('/logout', [HomePageController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (login page)
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'login']);

    // Protected routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');

        // Blog routes
        Route::get('blogs', [AdminController::class, 'indexBlog'])->name('blogs.index');
        Route::get('blogs/create', [AdminController::class, 'createBlog'])->name('blogs.create');
        Route::post('blogs', [AdminController::class, 'storeBlog'])->name('blogs.store');
        Route::get('blogs/{blog}/edit', [AdminController::class, 'editBlog'])->name('blogs.edit');
        Route::put('blogs/{blog}', [AdminController::class, 'updateBlog'])->name('blogs.update');
        Route::delete('blogs/{blog}', [AdminController::class, 'destroyBlog'])->name('blogs.destroy');

        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::get('users/export-csv', [AdminController::class, 'exportUsersCsv'])->name('users.export');

        // Resources routes
        Route::get('resources', [AdminController::class, 'indexResource'])->name('resources.index');
        Route::get('resources/create', [AdminController::class, 'createResource'])->name('resources.create');
        Route::post('resources', [AdminController::class, 'storeResource'])->name('resources.store');
        Route::get('resources/{resource}/edit', [AdminController::class, 'editResource'])->name('resources.edit');
        Route::put('resources/{resource}', [AdminController::class, 'updateResource'])->name('resources.update');
        Route::delete('resources/{resource}', [AdminController::class, 'destroyResource'])->name('resources.destroy');
    });
});