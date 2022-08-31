<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PaymentProviderController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/', function(){
    return redirect()->route('login');
});

Route::group(['prefix'=>'admin','middleware'=>['isAdmin','auth','verified']],function(){
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('review-request', [AdminController::class, 'viewrequest'])->name('admin.request');
    Route::put('accept-guide/{user_id}/{id}', [AdminController::class, 'accept']);
    Route::delete('deny-guide/{user_id}/{id}', [AdminController::class, 'deny']);
    Route::get('ban-guide', [AdminController::class, 'ban'])->name('admin.ban');
    Route::put('ban-guide/{id}', [AdminController::class, 'ban_update']);

    Route::get('edit_dashboards', [AdminController::class, 'add_picture'])->name('admin.dashboardcrud');
});

Route::group(['prefix'=>'Guide','middleware'=>['isGuide','auth','verified']],function(){
    Route::get('dashboard',[GuideController::class,'index'])->name('Guide.dashboard');
    Route::get('add-trip',[GuideController::class,'addtrip'])->name('Guide.addtrip');
    Route::post('store-trip',[GuideController::class,'storetrip'])->name('Guide.storetrip');
    Route::get('mytrip',[GuideController::class,'viewmytrip'])->name('Guide.viewtrip');
    Route::put('hold/{id}',[GuideController::class,'hold'])->name('Guide.hold');
    Route::get('profit',[GuideController::class,'profit'])->name('Guide.profit');
    Route::get('add_picture/{id}',[GuideController::class,'addimage']);
    Route::post('store-image/{id}',[GuideController::class,'storeimage'])->name('Guide.storeimage');

    Route::get('myAlbum', [GuideController::class,'view'])->name('Guide.myphoto');
    Route::delete('delete-image/{id}', [GuideController::class, 'destroy']);
});

Route::group(['prefix'=>'User','middleware'=>['isUser','auth','verified']],function(){
    Route::get('dashboard',[UserController::class,'index'])->name('User.dashboard');
    Route::get('send-request', [UserController::class, 'request'])->name('User.request');
    Route::post('add-request', [UserController::class, 'store']);
    Route::get('trip',[UserController::class,'trip'])->name('User.trip');
    Route::get('specific_trip/{id}',[UserController::class,'selecttrip'])->name('User.spetrip');
    Route::get('get-checkout-id/{price}/{trip_id}',[PaymentProviderController::class,'request'])->name('offers.checkout') ;
    Route::get('get-status-id/{quantity}/{trip_id}',[PaymentProviderController::class,'request2'])->name('offers.status');
    Route::get('trip_on_map',[UserController::class,'map'])->name('User.map');
    Route::get('mytickets',[UserController::class,'orders'])->name('User.mytickets');
    Route::get('review/{id}',[UserController::class,'review'])->name('User.review');
    Route::post('review_store/{id}',[UserController::class,'review_store'])->name('User.storereview');
    Route::put('review_edit/{id}',[UserController::class,'review_edit'])->name('User.editereview');
    Route::get('specific_guide/{id}',[UserController::class,'selectguide'])->name('User.speguide');
    Route::get('add_picture/{id}',[UserController::class,'addform']);
    Route::post('store-picture/{id}',[UserController::class,'storepicture'])->name('User.storepicture');
    Route::get('album/{id}',[UserController::class,'album']);
    Route::get('search',[UserController::class,'searchindex'])->name('User.search');
    Route::get('search_map',[UserController::class,'searchindex2'])->name('User.search2');
    Route::get('guides',[UserController::class,'guides'])->name('User.guides');

    Route::get('myAlbum', [UserController::class,'view'])->name('User.myphoto');;
    Route::delete('delete-image/{id}', [UserController::class, 'destroy']);

});



