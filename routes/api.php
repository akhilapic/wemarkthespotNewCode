<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//------------------------craated by akhil---------------start
Route::post('/user_register', 'App\Http\Controllers\Api\userController@userRegister');
Route::post('/login', 'App\Http\Controllers\Api\userController@logincheck');
Route::post('/forgot_password', 'App\Http\Controllers\Api\userController@forgotPassword');
Route::post('/resendotp', 'App\Http\Controllers\Api\userController@resendotp');

Route::post('/password_verification', 'App\Http\Controllers\Api\userController@passwordVerification');
Route::post('/password_update', 'App\Http\Controllers\Api\userController@passwordUpdate'); 
Route::post('/edit', 'App\Http\Controllers\Api\userController@edit'); 
Route::post('/profile_update', 'App\Http\Controllers\Api\userController@profile_update'); 
Route::get('/get_allusers', 'App\Http\Controllers\Api\userController@get_allusers'); 
Route::post('/guestuser', 'App\Http\Controllers\Api\userController@guestuser');

Route::post('/forgot_password_verify', 'App\Http\Controllers\Api\userController@forgetpasswordVerification');

Route::post('/get_homedata', 'App\Http\Controllers\Api\userController@getquoatesdata');

Route::post('/getnearby', 'App\Http\Controllers\Api\userController@getnearby');

Route::post('/business_review', 'App\Http\Controllers\Api\userController@business_review');
Route::get('/business_review_delete', 'App\Http\Controllers\Api\userController@business_review_delete');
Route::post('/checkOut', 'App\Http\Controllers\Api\userController@checkOut');

Route::post('/community_reviews', 'App\Http\Controllers\Api\userController@community_reviews');
Route::post('/community_reviews1', 'App\Http\Controllers\Api\userController@community_reviews1');


Route::post('/add_hotspots', 'App\Http\Controllers\Api\userController@add_hotspots');

Route::get('/gethotspot', 'App\Http\Controllers\Api\userController@gethotspots');

Route::post('/get_businessusers', 'App\Http\Controllers\Api\userController@get_businessusers');
Route::post('/businessfav', 'App\Http\Controllers\Api\userController@BusinessFav');

Route::post('/replies_community_reviews', 'App\Http\Controllers\Api\userController@replies_community_reviews');


Route::get('/get_replies_community_reviews', 'App\Http\Controllers\Api\userController@get_replies_community_reviews');

Route::get('/userCheckInList', 'App\Http\Controllers\Api\userController@userCheckInList');

Route::post('/getbusinessFavbyuserId', 'App\Http\Controllers\Api\userController@getbusinessFav');

Route::post('/addBuinessReports', 'App\Http\Controllers\Api\userController@addBuinessReports');


Route::post('/Businesslikedislike', 'App\Http\Controllers\Api\userController@Businesslikedislike');

Route::post('/Businesssearch', 'App\Http\Controllers\Api\userController@BusinessSearch');

//
//-----------------------------------end-------------------------------------------------------------------

Route::post('/email_verification', 'App\Http\Controllers\Api\userController@emailVerification');
Route::post('/email_sent_otp', 'App\Http\Controllers\Api\userController@emailSentOtp');
// Route::post('/verify_otp','App\Http\Controllers\LoginController@verifyOtp')->name('verify_otp');

