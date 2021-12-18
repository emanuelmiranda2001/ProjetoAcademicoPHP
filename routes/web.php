<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

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
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//user routes
Route::get('users/profile', 'App\Http\Controllers\UserController@edit')->name('users.edit-profile')->middleware('auth', 'verified');

Route::post('users/profile', 'App\Http\Controllers\UserController@update')->name('users.update-profile')->middleware('auth', 'verified');

Route::get('users/password', 'App\Http\Controllers\UserController@passwordEdit')->name('password.edit')->middleware('auth', 'verified');

Route::post('users/password', 'App\Http\Controllers\UserController@passwordUpdate')->name('password.update')->middleware('auth', 'verified');

Route::get('users/orders', 'App\Http\Controllers\UserController@getProfile')->name('user.profile')->middleware('auth', 'verified');

Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.updat');


//search route
Route::get('search', [App\Http\Controllers\AutoCompleteController::class, 'index'])->name('search')->middleware('auth', 'verified');

Route::get('autocomplete', [App\Http\Controllers\AutoCompleteController::class, 'autocomplete'])->name('autocomplete')->middleware('auth');



//shop route
Route::get('shops', [App\Http\Controllers\ShopController::class, 'index'])->name('shops')->middleware('auth', 'verified');

Route::get('/shopping-cart', [
	'uses' => 'App\Http\Controllers\ProductController@getCart',
	'as' => 'product.shoppingCart'
])->middleware('auth', 'verified');

Route::get('/checkout', [
    'uses' => 'App\Http\Controllers\ProductController@getCheckout',
    'as' => 'checkout'
])->middleware('auth', 'verified');


Route::post('/checkout', [
    'uses' => 'App\Http\Controllers\ProductController@postCheckout',
    'as' => 'checkout'
])->middleware('auth', 'verified');

Route::get('/add-to-cart/{id}', [
	'uses' => 'App\Http\Controllers\ProductController@getAddToCart',
	'as' => 'product.addToCart'
])->middleware('auth', 'verified');

Route::get('/reduce/{id}', [
	'uses' => 'App\Http\Controllers\ProductController@getReduceByOne',
	'as' => 'product.reduceByOne'
])->middleware('auth', 'verified');

Route::get('/remove/{id}', [
	'uses' => 'App\Http\Controllers\ProductController@getRemoveItem',
	'as' => 'product.remove'
])->middleware('auth', 'verified');


// tickets normal
Route::get('new_ticket', 'App\Http\Controllers\TicketsController@create')->name('new_ticket')->middleware('auth', 'verified');

Route::post('new_ticket', 'App\Http\Controllers\TicketsController@store')->name('new_ticket')->middleware('auth', 'verified');

Route::get('my_tickets', 'App\Http\Controllers\TicketsController@userTickets')->name('my_tickets')->middleware('auth', 'verified');

Route::get('tickets/{ticket_id}', 'App\Http\Controllers\TicketsController@show')->middleware('auth', 'verified');

Route::post('comment', 'App\Http\Controllers\CommentsController@postComment')->middleware('auth', 'verified');


// admin routes 
Route::group(['middleware' => 'role:admin'], function() {
    Route::get('tickets', 'App\Http\Controllers\TicketsController@index')->name('tickets');
    Route::post('close_ticket/{ticket_id}', 'App\Http\Controllers\TicketsController@close');
	Route::get('users/allorders', 'App\Http\Controllers\UserController@getAllOrders')->name('admin.profile');
	Route::get('users/{id}/edit', 'App\Http\Controllers\UserController@editUser')->name('users.edit')->middleware('auth', 'verified');
	Route::post('users/{id}/edit', 'App\Http\Controllers\UserController@updateUser')->name('users.update-user')->middleware('auth', 'verified');
	
});

Route::group(['middleware' => ['role:admin']], function () {
	Route::get('/admin', function(){
	return view('adminView');
	});
	Route::resource('products', 'App\Http\Controllers\ProductController');
});


Route::resource('users', 'App\Http\Controllers\UserController');







