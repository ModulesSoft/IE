<?php

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

//for vue route
Route::get('/', function () {return view('welcome');});
Route::get('/categories/', function (){return view('welcome');});
Route::get('/product/{id}', function (){return view('welcome');});
Route::get('/search/{keyword}',function (){return view('welcome');});
Route::get('/cart',function (){return view('welcome');});
Route::get('/profile',function (){return view('welcome');})->middleware('auth');;

Route::get('/home', 'HomeController@homePage');
Route::get('/getCategories', 'HomeController@categories');
Route::get('/products/{filters},{page},{perpage}', 'HomeController@products');
Route::get('/productsCount/{filters}', 'HomeController@productsCount');
Route::get('/getProduct/{id}', 'HomeController@product');
Route::get('/filters/{name},{value}', 'HomeController@filters');
Route::get('/getOrder/{id}', 'HomeController@getOrder');
Route::get('/getOrderProducts/{id}', 'HomeController@getOrderProducts');
Route::get('/getUser/{id}', 'HomeController@getUser');
Route::get('user/getAddresses/{id}', 'HomeController@getAddresses');
Route::put('user/addresses/{id}', 'HomeController@setAddresses');

Route::post('/order/','HomeController@order');
Route::post('/order/{id}/update','HomeController@orderPost');
Route::post('/setUser','HomeController@setUser');
Route::post('user/addresses', 'HomeController@setAddresses');
Route::post('/editUser','HomeController@editUser');


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('login', function (Request $request) {
    if (auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
        // Authentication passed...
        $user = auth()->user();
//        $user->api_token = str_random(60);
        $user->save();
        return $user;
    }

    return response()->json([
        'error' => 'Unauthenticated user',
        'code' => 401,
    ], 401);
});