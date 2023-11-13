<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home.index');
});

Route::get('/active', function () {
    return view('panel.active');
});
Route::post('check_active', [\App\Http\Controllers\DashboardController::class, 'check_active']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'active'], function () {
        Route::get('send_code', [\App\Http\Controllers\DashboardController::class, 'panel']);

        Route::get('panel', [\App\Http\Controllers\DashboardController::class, 'panel']);

        Route::get('contact', [\App\Http\Controllers\AdminController::class, 'contact']);

        Route::resource('blogs', \App\Http\Controllers\BlogController::class);
        Route::any('blogs/delete/{id}', [\App\Http\Controllers\BlogController::class, 'destroy']);
        Route::any('blogs/files/{id}', [\App\Http\Controllers\BlogController::class, 'files']);

        Route::resource('products', \App\Http\Controllers\ProductController::class);
        Route::any('products/delete/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);
        Route::any('products/files/{id}', [\App\Http\Controllers\ProductController::class, 'files']);

        Route::post('files/store', [\App\Http\Controllers\FileController::class, 'store']);
        Route::any('files/delete/{id}', [\App\Http\Controllers\FileController::class, 'delete']);
        Route::any('files/download/{id}', [\App\Http\Controllers\FileController::class, 'downloadfile']);

        Route::get('orders', [\App\Http\Controllers\ReportController::class, 'orders']);
        Route::any('invoice/status/{id}/{status}', [\App\Http\Controllers\ReportController::class, 'status']);

        Route::get('transactions', [\App\Http\Controllers\ReportController::class, 'transactions']);

        Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'profile']);
        Route::post('profile_update', [\App\Http\Controllers\ProfileController::class, 'profile_update']);
        Route::post('insert_code', [\App\Http\Controllers\ProfileController::class, 'insert_code']);

        Route::resource('learns', \App\Http\Controllers\LearnController::class);
        Route::any('learns/delete/{id}', [\App\Http\Controllers\LearnController::class, 'destroy']);
        Route::any('learns/files/{id}', [\App\Http\Controllers\LearnController::class, 'files']);
        Route::get('learns_list/{level_id}', [\App\Http\Controllers\LearnController::class, 'learns_level']);
        Route::get('learns_list_level', [\App\Http\Controllers\LearnController::class, 'learns_level_detect']);

        Route::resource('exams', \App\Http\Controllers\ExamController::class);
        Route::any('exams/delete/{id}', [\App\Http\Controllers\ExamController::class, 'destroy']);
        Route::any('exams/files/{id}', [\App\Http\Controllers\ExamController::class, 'files']);
        Route::get('exams_list/{level_id}', [\App\Http\Controllers\ExamController::class, 'exams_level']);
        Route::get('exams/questions/{level_id}', [\App\Http\Controllers\ExamController::class, 'questions']);
        Route::post('exams/questions_update/{id}', [\App\Http\Controllers\ExamController::class, 'questions_update']);
        Route::any('exams/questions_delete/{id}', [\App\Http\Controllers\ExamController::class, 'questions_delete']);
        Route::post('exams/questions_create/{id}', [\App\Http\Controllers\ExamController::class, 'questions_create']);
        Route::get('exams/take/{id}', [\App\Http\Controllers\ExamController::class, 'take']);
        Route::post('exams/tik', [\App\Http\Controllers\ExamController::class, 'tik']);
        Route::get('exams/finish/{id}', [\App\Http\Controllers\ExamController::class, 'take']);

        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::any('members/update/{id}', [\App\Http\Controllers\MemberController::class, 'update']);

        Route::get('members/first', [\App\Http\Controllers\MemberController::class, 'first']);
        Route::get('members/bronze', [\App\Http\Controllers\MemberController::class, 'bronze']);
        Route::get('members/silver', [\App\Http\Controllers\MemberController::class, 'silver']);
        Route::get('members/golden', [\App\Http\Controllers\MemberController::class, 'golden']);
        Route::get('members/final', [\App\Http\Controllers\MemberController::class, 'final']);
        Route::get('members/second', [\App\Http\Controllers\MemberController::class, 'second']);
        Route::get('members/shared', [\App\Http\Controllers\MemberController::class, 'shared']);
        Route::get('members/invites', [\App\Http\Controllers\MemberController::class, 'invites']);
        Route::get('members/presents', [\App\Http\Controllers\MemberController::class, 'presents']);
        Route::get('members/follow_up', [\App\Http\Controllers\MemberController::class, 'follow_up']);
        Route::get('members/register', [\App\Http\Controllers\MemberController::class, 'register']);

        Route::post('members/create', [\App\Http\Controllers\MemberController::class, 'store']);
        Route::post('members/update_silver/{id}', [\App\Http\Controllers\MemberController::class, 'update_silver']);
        Route::any('members/delete/{id}', [\App\Http\Controllers\MemberController::class, 'delete']);
        Route::get('members/analyze', [\App\Http\Controllers\MemberController::class, 'analyze']);
        Route::get('members/analyze_silver', [\App\Http\Controllers\MemberController::class, 'analyze_silver']);
        Route::get('members/analyze_golden', [\App\Http\Controllers\MemberController::class, 'analyze_golden']);

        Route::get('members/questions/{type}/{level}', [\App\Http\Controllers\MemberController::class, 'questions']);
        Route::post('members/questions/store', [\App\Http\Controllers\MemberController::class, 'questions_store']);

        Route::post('members/change_type', [\App\Http\Controllers\MemberController::class, 'change_type']);
        Route::post('members/change_point', [\App\Http\Controllers\MemberController::class, 'change_point']);


    });
});
Route::get('', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('home/blogs', [\App\Http\Controllers\HomeController::class, 'blogs']);
Route::get('home/products', [\App\Http\Controllers\HomeController::class, 'products']);
Route::get('blog/{id}', [\App\Http\Controllers\HomeController::class, 'blog']);
Route::get('buy/{id}', [\App\Http\Controllers\HomeController::class, 'buy']);
Route::post('pay', [\App\Http\Controllers\HomeController::class, 'pay']);

Route::get('home/contact', [\App\Http\Controllers\HomeController::class, 'contact']);
Route::post('home/contact_store', [\App\Http\Controllers\HomeController::class, 'contact_store']);
Route::get('home/about', [\App\Http\Controllers\HomeController::class, 'about']);
Route::get('home/develop', [\App\Http\Controllers\HomeController::class, 'develop']);
Route::get('home/map', [\App\Http\Controllers\HomeController::class, 'map']);

Route::get('payment/checkout/{token}', [\App\Http\Controllers\HomeController::class, 'checkout']);
Route::post('payment/checkout/{token}', [\App\Http\Controllers\HomeController::class, 'checkout']);
Route::get('payment/bank-redirect/{bank}', [\App\Http\Controllers\HomeController::class, 'bankRedirect']);


Auth::routes();
Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'register']);
Route::post('/register_user', [\App\Http\Controllers\Auth\LoginController::class, 'register_user']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
