<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeAbout;
use App\Models\MultiImage;
use PhpParser\Parser\Multiple;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ChangePasswordController;

Route::get('/email/verify',function(){
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/',function(){
    $brands=DB::table('brands')->get();
    $abouts=DB::table('home_abouts')->get();
    $multis=MultiImage::all();
    return view('home',compact('brands','abouts','multis'));
})->name('main-home');

//FOR CATEGORY

//category  list route
Route::get('/category/all',([CategoryController::class,'index']))
       ->name('all.category');

//validate category route
Route::post('/category/create',([CategoryController::class,'store']))
       ->name('store.category');

//edit category route
Route::get('/category/edit/{id}',([CategoryController::class,'edit']))
       ->name('edit.category');

//validate update category route
Route::put('/category/edit/{id}',([CategoryController::class,'update']))
       ->name('update.category');

//soft delete category route
Route::get('/category/delete/{id}',([CategoryController::class,'softDestroy']))
       ->name('soft-destroy.category');

//restore category route
Route::get('/category/restore/{id}',([CategoryController::class,'restore']))
       ->name('restore.category');

//permanently delete category route
Route::get('/category/permanently-delete/{id}',([CategoryController::class,'perDestroy']))
       ->name('permanently-destroy.category');


//FOR BRAND
//brand list route
Route::get('brand/all',([BrandController::class,'index']))
       ->name('all.brand');

//brand validate
Route::post('/brand/create',([BrandController::class,'store']))
       ->name('store.brand');

//edit brand route
Route::get('/brand/edit/{id}',([BrandController::class,'edit']))
       ->name('edit.brand');

//validate update brand route
Route::put('/brand/edit/{id}',([BrandController::class,'update']))
       ->name('update.brand');

//permanently delete brand route
Route::get('/brand/delete/{id}',([BrandController::class,'destroy']))
       ->name('destroy.brand');


//Multi Image list
Route::get('/multi/image',([BrandController::class,'multiImage']))
       ->name('multi.image');

//multi image store
Route::post('/multi/create',([BrandController::class,'multiStore']))
       ->name('multi.store');

//admin all slider route
Route::get('/home/slider',([HomeController::class,'index']))
       ->name('home.slider');
Route::get('/create/slider',([HomeController::class,'create']))
->name('slider.create');
Route::post('/create/slider',([HomeController::class,'store']))
->name('slider.store');
Route::get('/edit/slider/{id}',([HomeController::class,'edit']))
->name('slider.edit');
Route::put('/edit/slider/{id}',([HomeController::class,'update']))
->name('slider.update');
Route::get('/destroy/slider/{id}',([HomeController::class,'destroy']))
->name('slider.destroy');

//admin home about route
Route::get('/home/about',([HomeAboutController::class,'index']))
       ->name('home.about');
Route::get('/create/about',([HomeAboutController::class,'create']))
->name('about.create');
Route::post('/create/about',([HomeAboutController::class,'store']))
->name('about.store');
Route::get('/edit/about/{id}',([HomeAboutController::class,'edit']))
->name('about.edit');
Route::put('/edit/about/{id}',([HomeAboutController::class,'update']))
->name('about.update');
Route::get('/destroy/about/{id}',([HomeAboutController::class,'destroy']))
->name('about.destroy');

//admin contact route page
Route::get('/home/contact',([AdminContactController::class,'index']))
       ->name('home.contact');
Route::get('/create/contact',([AdminContactController::class,'create']))
->name('contact.create');
Route::post('/create/contact',([AdminContactController::class,'store']))
->name('contact.store');
Route::get('/edit/contact/{id}',([AdminContactController::class,'edit']))
->name('contact.edit');
Route::put('/edit/contact/{id}',([AdminContactController::class,'update']))
->name('contact.update');
Route::get('/destroy/contact/{id}',([AdminContactController::class,'destroy']))
->name('contact.destroy');

Route::get('/admin/message',([AdminContactController::class,'listMessage']))
       ->name('admin.message');
Route::get('/admin/message/destroy/{id}',([AdminContactController::class,'messageDestroy']))
->name('admin.message.destroy');

//home page contact route
Route::get('/contact',([AdminContactController::class,'contact']))
->name('contact');
Route::post('/contact/form',([AdminContactController::class,'contactForm']))
->name('contact.form');


//portfolio
Route::get('/portfolio',([HomeAboutController::class,'Portfolio']))
       ->name('portfolio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        return view('admin.index');
    })->name('dashboard');
});

Route::get('/user/logout',([BrandController::class,'Logout']))
       ->name('user.logout');

// Chanage Password and user Profile Route
Route::get('/user/password',([ChangePasswordController::class,'index']))
       ->name('change.password');
Route::post('/user/update',([ChangePasswordController::class,'update']))
->name('password.update');

// User Profile
Route::get('/user/profile',([AdminProfileController::class, 'index']))->name('profile.update');
Route::post('/user/profile/update',([AdminProfileController::class, 'store']))->name('update.user.profile');

