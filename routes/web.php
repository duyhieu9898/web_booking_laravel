<?php
use Illuminate\Support\Facades\Auth;
use App\Events\RedisEvent;

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

//*===============TOOLS DEVELOPER==================*//
$router->group(['namespace' => '\Rap2hpoutre\LaravelLogViewer'], function () use ($router) {
    $router->get('logs', 'LogViewerController@index');
});
//*===============ROUTE CONTROLL WEB==================*//
Route::get('/test-email', 'RoomController@sendEmail');
Route::view('/index2', 'index2');
Route::get('/email', function () {
    // Only verified users may enter...
    return "ok";
})->middleware('verified');


Route::get('/', 'HomeController@index')->name('index');
Route::get('/category-room/{id}', 'RoomController@getByCategoryId')->name('category_rooms');
Route::get('/detail-room/{id}', 'RoomController@show');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/search-room', 'SearchController@searchRoom');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/getCurrentUser', function () {
        return Auth::user()->load('roles');
    });

    Route::post('/bookings/rooms/{id}', 'BookingController@booking'); //store
    Route::post('check-out/', 'BookingController@checkOut');
    Route::get('/cart', 'BookingController@cart');
    Route::view('/profile', 'info_user');
    Route::get('/order', 'BookingController@bookingOfUser');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', function () {
            $token = Auth::user()->api_token;
            return redirect("http://localhost:8080/?api_token=$token");
        });
    });

    Route::get('/getCurrentUser', function () {
        return Auth::user()->load('roles');
    });
});
//route auth
Auth::routes(['verify' => true]);
Route::get('statistical', 'API\StatisticalController@index');

//notify
Route::get('/notify', function () {
    return view('notify');
});

Route::get('/send', 'SendMessageController@index');
Route::post('/postMessage', 'SendMessageController@sendMessage')->name('postMessage');

//chat
Route::get('/chat', function () {
    return view('home');
});
//test
Route::get('publish', function () {
    LRedis::publish('message', "hello my friend");
});
