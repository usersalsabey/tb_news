<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profile Routes
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// News Routes
Route::get('/news', function () {
    return view('news.index');
})->name('news');

Route::get('/news/{slug}', function ($slug) {
    return view('news.show', compact('slug'));
})->name('news.show');

// Information Routes
Route::get('/information', function () {
    return view('information');
})->name('information');

// Contact Routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Services Routes
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/report', function () {
        return view('services.report');
    })->name('report');
    
    Route::get('/sim', function () {
        return view('services.sim');
    })->name('sim');
    
    Route::get('/skck', function () {
        return view('services.skck');
    })->name('skck');
    
    Route::get('/complaint', function () {
        return view('services.complaint');
    })->name('complaint');
});

// About Routes
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/profile', function () {
        return view('about.profile');
    })->name('profile');
    
    Route::get('/structure', function () {
        return view('about.structure');
    })->name('structure');
    
    Route::get('/privacy', function () {
        return view('about.privacy');
    })->name('privacy');
    
    Route::get('/terms', function () {
        return view('about.terms');
    })->name('terms');
});