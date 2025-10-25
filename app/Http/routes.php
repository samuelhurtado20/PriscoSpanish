<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
 //   return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('/confirm/{p?}', 'HomeController@completeRegistration');

Route::group(['middleware' => ['web']], function () {
    
   Route::get('/',function () {
    return view('welcome');
   });
    
    //socialite routes
    Route::get('auth/google', 'Auth\AuthController@redirectToGoogle');
    Route::get('auth/google/callback', 'Auth\AuthController@handleGoogleCallback');
    Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebook');
    Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookCallback');
    
    Route::get('/profiles/{p?}',
               ['as' => 'profiles',
                'uses' => 'HomeController@getPublicProfile'
                ]);
});
             
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    
    //Route::get('/home', 'HomeController@dashboard');
    
     Route:: get('/dashboard', 'DashboardController@index');
     Route:: get('/private-sessions', 'DashboardController@privateSessions');
     Route:: get('/profile', 'DashboardController@profile');
     Route:: get('/settings', 'DashboardController@settings');
     Route:: get('/resources', 'DashboardController@resources');
     Route:: get('/goals', 'DashboardController@goals');
     Route:: get('/reservations', 'DashboardController@reservations');
     Route:: get('/register-sucessfull', 'HomeController@getRegisterOk');

     Route::get('/payment/status','PaypalController@getPaymentStatus')->name('payment.status');
     Route::post('/payment','PaypalController@postPayment')->name('payment');
    
    
    //Rutas para Mantenimiento de los detalles de la cuenta
     Route::post('accDetails','DashboardController@postAccountDetail');
     Route::post('accSettings','DashboardController@postAccountSettings');
     Route::post('postGoals','DashboardController@postGoals');
     Route::post('accPostPicture','DashboardController@postAccountPicture');
     
     //perfil publico
     Route::post('postTeacherProfile','DashboardController@postTeacherProfile');
    
     Route::post('postAddSession','SessionsController@addSession');
     Route::post('postUpdateSessionOffer','SessionsController@updateSessionOffer');
     Route::post('postGetSessionOffer','SessionsController@getSessionOffer');
     Route::post('postRemSessionOffer','SessionsController@removeSessionOffer');
     Route::post('postUpdatels','SessionsController@updateLearningSession');
     Route::post('postGetls','SessionsController@getLearningSession');
     //clendarios y eventos 
     Route::post('postSaveEvents','CalendarEventsController@saveEvents');
     Route::post('postSaveEvent','CalendarEventsController@saveEvent');
     Route::post('postRemoveEvent','CalendarEventsController@removeEvent');
     
});

#$exitCode = Artisan::call('command:name', ['--option' => 'foo']);
Route::get('/limpiarbd', function()
{
    $exitCode = Artisan::call('migrate:reset');
});
Route::get('/migrarbd', function()
{
    $exitCode = Artisan::call('migrate',['--seed'=>true]);
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
});
 


