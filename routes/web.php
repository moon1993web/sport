<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialNetworkController;
use App\Http\Controllers\Front\BlogFrontController;
use App\Http\Controllers\Front\HomeControllerFront;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//ADMIN
 Route::get('/index', [HomeController::class, 'index'])->name('admin.index');






Route::prefix('admin')->name('admin.')->group(function () {




    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/store', [BlogController::class, 'store'])->name('store');
        Route::get('/edit/{blog}', [BlogController::class, 'edit'])->name('edit');
        Route::put('/update/{blog}', [BlogController::class, 'update'])->name('update');
        Route::delete('/destroy/{blog}', [BlogController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('classes')->name('classes.')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('index');
        Route::get('/create', [ClassController::class, 'create'])->name('create');
        Route::post('/store', [ClassController::class, 'store'])->name('store');
        Route::get('/edit/{class}', [ClassController::class, 'edit'])->name('edit');
        Route::put('/update/{class}', [ClassController::class, 'update'])->name('update');
        Route::delete('destroy/{class}', [ClassController::class, 'destroy'])->name('destroy');
    });
    




Route::prefix('coaches')->name('coaches.')->group(function () {
    Route::get('/', [CoachController::class, 'index'])->name('index');
    Route::get('/create', [CoachController::class, 'create'])->name('create');
    Route::post('/store', [CoachController::class, 'store'])->name('store');
    Route::get('/edit/{coach}', [CoachController::class, 'edit'])->name('edit');
    Route::put('/update/{coach}', [CoachController::class, 'update'])->name('update');
    Route::delete('/destroy/{coach}', [CoachController::class, 'destroy'])->name('destroy');
});








Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});




Route::prefix('icons')->name('icons.')->group(function () {
    Route::get('/', [IconController::class, 'index'])->name('index');
    Route::post('/store', [IconController::class, 'store'])->name('store');
    Route::delete('/destroy/{icon}', [IconController::class, 'destroy'])->name('destroy');
    
    // شما می‌توانید در صورت نیاز، روت‌های create, edit و update را نیز اضافه کنید.
    // Route::get('/create', [IconController::class, 'create'])->name('create');
    // Route::get('/edit/{icon}', [IconController::class, 'edit'])->name('edit');
    // Route::put('/update/{icon}', [IconController::class, 'update'])->name('update');

});




Route::prefix('social-networks')->name('social-networks.')->group(function () {
    Route::get('/', [SocialNetworkController::class, 'index'])->name('index');
    Route::get('/create', [SocialNetworkController::class, 'create'])->name('create');
    Route::post('/store', [SocialNetworkController::class, 'store'])->name('store');
    Route::get('/edit/{social_network}', [SocialNetworkController::class, 'edit'])->name('edit');
    Route::put('/update/{social_network}', [SocialNetworkController::class, 'update'])->name('update');
    Route::delete('/destroy/{social_network}', [SocialNetworkController::class, 'destroy'])->name('destroy');
});






Route::prefix('about-us')->name('about-us.')->group(function () {
  
    Route::get('/', [AboutUsController::class, 'edit'])->name('edit');

  
    Route::put('/update', [AboutUsController::class, 'update'])->name('update');
});








Route::prefix('menus')->name('menus.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::post('/store', [MenuController::class, 'store'])->name('store');
    Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('edit');
    Route::put('/update/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/destroy/{menu}', [MenuController::class, 'destroy'])->name('destroy');
    Route::post('/update-order', [MenuController::class, 'updateOrder'])->name('update.order');
});


















Route::prefix('skills')->name('skills.')->group(function () {
    Route::get('/', [SkillController::class, 'index'])->name('index');
    Route::get('/create', [SkillController::class, 'create'])->name('create');
    Route::post('/store', [SkillController::class, 'store'])->name('store');
    Route::get('/edit/{skill}', [SkillController::class, 'edit'])->name('edit');
    Route::put('/update/{skill}', [SkillController::class, 'update'])->name('update');
    Route::delete('/destroy/{skill}', [SkillController::class, 'destroy'])->name('destroy');
});






});






//FRONT
 Route::get('/', [HomeControllerFront::class, 'index'])->name('front.index');

 //BLOG


// روت‌های فرانت‌اند بلاگ
Route::get('/blogs', [BlogFrontController::class, 'index'])->name('front.blogs.index');
Route::get('/blogs/{blog}', [BlogFrontController::class, 'show'])->name('front.blogs.show');