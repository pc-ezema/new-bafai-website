<?php

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


Route::get('/login', [HomePageController::class, 'login'])->name('login');
Route::post('/login', [HomePageController::class, 'authenticate'])->name('login.post');
Route::get('/register', [HomePageController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [HomePageController::class, 'register'])->name('register.post');
Route::post('/logout', [HomePageController::class, 'logout'])->name('logout');