<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CornerPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\CornerPost as LWModelCornerPost;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('home', [HomeController::class, 'show'])
->name('home');

Route::get('/', fn() => to_route('home'));

Route::get('/logout', fn() => to_route('login'));
Route::get('/like', fn() => to_route('login'));

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category:name}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('user-profile/{user:username}', [ProfileController::class, 'show'])
->name('user.profile');

Route::get('cornerposts', [CornerPostController::class, 'index'])->name('cornerposts.index');

Route::get('cornerposts/search', [CornerPostController::class, 'search'])->name('cornerposts.search');
Route::get('cornerposts/{cornerpost:title}', [CornerPostController::class, 'show'])->name('cornerposts.show');


Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'sendEnquiry'])->name('contact.enquiry');

Route::get('/cornerpost', function () {
    return view('cornerpost');
})->name('cornerpost');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/likes-and-comments', [DashboardController::class, 'likes_and_comments'])->name('dashboard.likes.comments');
    Route::get('/dashboard/cornerposts', [DashboardController::class, 'cornerposts'])->name('dashboard.cornerposts');
    Route::get('/dashboard/cornerposts/i-like', [DashboardController::class, 'cornerposts_i_like'])->name('dashboard.cornerposts.ilike');
    Route::get('/dashboard/cornerposts/mycomments', [DashboardController::class, 'cornerposts_mycomments'])->name('dashboard.cornerposts.mycomments');
    Route::get('/dashboard/cornerpost/create', [DashboardController::class, 'cornerpost_create'])->name('dashboard.cornerpost.create');
    Route::post('/dashboard/cornerpost/store', [DashboardController::class, 'cornerpost_store'])->name('dashboard.cornerpost.store');
    Route::get('/dashboard/cornerpost/update/{cornerpost:title}', [DashboardController::class, 'cornerpost_update'])->name('dashboard.cornerpost.update');
    Route::put('/dashboard/cornerpost/update', [DashboardController::class, 'cornerpost_update_store'])->name('dashboard.cornerpost.update.store');
    Route::delete('/dashboard/cornerpost/delete', [DashboardController::class, 'cornerpost_delete'])->name('dashboard.cornerpost.delete');
    Route::post('/cornerposts/cornerpost/comment/store',[CommentController::class, 'store'])->name('comment.store');
    Route::delete('/cornerposts/cornerpost/comment/destroy{id}',[CommentController::class, 'destroy'])->name('comment.destroy');

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/dashboard/admin/check/{cornerpost}', [AdminController::class, 'check'])->name('admin.cornerpost.check');
        Route::put('/dashboard/admin/publish/{cornerpost}', [AdminController::class, 'publish'])->name('admin.cornerpost.publish');

    });
});




require __DIR__.'/auth.php';
