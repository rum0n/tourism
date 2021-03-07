<?php

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
//
Route::get('infinit/scroll', function () {
    return view('scroll');
});


//Auth::routes();

Route::get('/', 'FrontController@index')->name('home_page');
Route::get('/find/locals', 'FrontController@find_local')->name('find_local');
Route::get('/bookings', 'FrontController@bookings')->name('bookings');



Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/local/{id}', 'FrontController@local')->name('local');
Route::post('/review/{id}', 'FrontController@review')->name('add_review');
Route::post('/report/{id}', 'FrontController@report')->name('report_user');



/*
|=====================================================
|               Admin Routes
|=====================================================
*/

Route::group(['as' => 'admin.','prefix' => 'admin', 'namespace' => 'Admin','middleware' => ['auth','admin']],function(){

    Route::get('/dashboard', 'AdminController@index')->name('dashboard');

    Route::get('/reviews', 'AdminController@reviews')->name('reviews');
    Route::post('/delete/review/{id}', 'AdminController@delete_review')->name('delete.review');

    Route::get('/reports', 'AdminController@reports')->name('reports');
    Route::post('/delete/report/{id}', 'AdminController@delete_report')->name('delete.report');

    //    ===========User Control Routes======================
    Route::resource('/users', 'UserController');
    Route::get('/block/{users}', 'UserController@blockUnblock')->name('user_status');

});

/*
|-----------------------------------------------------
|               Admin Routes ends
|-----------------------------------------------------
*/


/*
|=====================================================
|               Guide Routes
|=====================================================
*/

Route::group(['as' => 'guide.','prefix' => 'guide', 'namespace' => 'Guide','middleware' => ['auth','guide','verified']],function(){

    Route::get('/dashboard', 'GuideController@index')->name('dashboard');

    Route::get('/edit/profile/{id}', 'GuideController@editProfile')->name('edit.profile');
    Route::post('/update/profile/{id}', 'GuideController@updateProfile')->name('update.profile');

    Route::get('/booking/approve/{id}', 'GuideController@approve')->name('approve');
    Route::get('/booking/reject/{id}', 'GuideController@reject')->name('reject');
});

/*
|-----------------------------------------------------
|               Guide Routes ends
|-----------------------------------------------------
*/

/*
|-----------------------------------------------------
|               User Routes
|-----------------------------------------------------
*/


Route::group(['as' => 'user.','prefix' => 'user', 'namespace' => 'User','middleware' => ['auth','user','verified']],function(){

    Route::get('/dashboard', 'UserController@index')->name('dashboard');

    Route::get('/edit/profile/{id}', 'UserController@editProfile')->name('edit.profile');
    Route::post('/update/profile/{id}', 'UserController@updateProfile')->name('update.profile');


    Route::get('/create/trips/{id}', 'UserController@trips')->name('create_trip');
    Route::post('/create/trip/{id}', 'UserController@createTrip')->name('createtrip');
    Route::get('/destroy/trip/{id}', 'UserController@destroy')->name('destroy.trip');

});


/*
|-----------------------------------------------------
|               User Routes ends
|-----------------------------------------------------
*/