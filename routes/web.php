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

//*===============TOOLS DEVELOPER==================*//
$router->group(['namespace' => '\Rap2hpoutre\LaravelLogViewer'], function () use ($router) {
    $router->get('logs', 'LogViewerController@index');
});
//*===============ROUTE CONTROLL WEB==================*//
Route::get('/test-email', 'RoomController@sendEmail');


Route::get('/profile', function () {
    // Only verified users may enter...
    return "ok";
})->middleware('verified');

Route::get('/', 'RoomController@latest')->name('index');
Route::get('/category-room/{id}', 'RoomController@getByCategoryId')->name('category_rooms');
Route::get('/detail-room/{id}', 'RoomController@show');
Route::get('/logout', '\App\Http\Controllers\Auth\@logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/booking-room/{id}', 'RoomController@booking');
    Route::post('booking/{id}', 'BookingController@store')->name('store');
});
//*===============ROUTE CONTROLL ADMIN==================*//

// //fix auth middleware
// Route::group(['middleware' => ['auth']], function () {
//     Route::group(['prefix' => '/admin'], function () {


//         Route::group(['prefix' => '/users'], function () {
//             /*-------------------API VUEJS CURD USER-----------------*/
//             Route::view('/', 'vuejs.user');
//         });
//     });
// });

Route::get('/getCurrentUser', function () {
    return Auth::user()->load('roles');
});
Auth::routes(['verify' => true]);

//*===============ROUTE FOR SPA-ADMIN==================*//
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', function () {
        return view('admin.app');
    });
    Route::any('/admin/{any}', function () {
        return view('admin.app');
    })->where('any', '.*');
});
