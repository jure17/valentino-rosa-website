<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Counter;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
 
Route::get('/counter', Counter::class);

Route::get('/fratelli', [\App\Http\Controllers\FratelliController::class, 'index'])->name('fratelli');
Route::get('/valentino', [\App\Http\Controllers\ValentinoController::class, 'index'])->name('valentino');
Route::get('/story', [\App\Http\Controllers\StoryController::class, 'index'])->name('story');

// Contact form
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Quote request form
Route::post('/quote', [\App\Http\Controllers\ContactController::class, 'submitQuote'])->name('quote.submit');

// Test email route (remove in production)
Route::get('/test-email', function() {
    $inquiryData = [
        'property_title' => 'Test Property',
        'property_type' => 'vendite',
        'name' => 'Test User',
        'phone' => '+41 123 456 789',
        'email' => 'test@example.com',
        'message' => 'This is a test message from the contact form.',
    ];
    
    Mail::to('juriken17grgic@gmail.com')->send(new \App\Mail\PropertyInquiry($inquiryData));
    
    return 'Test email sent! Check your logs or email inbox.';
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Public login routes
    Route::get('/login', [\App\Http\Controllers\AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('login.post');
    
    // Protected admin routes
    Route::middleware([\App\Http\Middleware\AdminSessionAuth::class])->group(function () {
        // Properties management
        Route::get('/properties', [\App\Http\Controllers\PropertyController::class, 'index'])->name('properties.index');
        Route::get('/properties/create', [\App\Http\Controllers\PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [\App\Http\Controllers\PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [\App\Http\Controllers\PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/properties/{property}', [\App\Http\Controllers\PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [\App\Http\Controllers\PropertyController::class, 'destroy'])->name('properties.destroy');
        Route::delete('/properties/photos/{photo}', [\App\Http\Controllers\PropertyController::class, 'deletePhoto'])->name('properties.photos.destroy');
        
        // Photos management
        Route::get('/photos', [\App\Http\Controllers\PhotoController::class, 'index'])->name('photos.index');
        Route::get('/photos/create', [\App\Http\Controllers\PhotoController::class, 'create'])->name('photos.create');
        Route::post('/photos', [\App\Http\Controllers\PhotoController::class, 'store'])->name('photos.store');
        Route::get('/photos/{photo}/edit', [\App\Http\Controllers\PhotoController::class, 'edit'])->name('photos.edit');
        Route::put('/photos/{photo}', [\App\Http\Controllers\PhotoController::class, 'update'])->name('photos.update');
        Route::delete('/photos/{photo}', [\App\Http\Controllers\PhotoController::class, 'destroy'])->name('photos.destroy');
        
        Route::post('/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('logout');
    });
});