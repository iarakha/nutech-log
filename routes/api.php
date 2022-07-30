<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/sign-in', [AuthController::class, 'authenticate'])->name('authenticate');


// Route::get('/getwo', [apiController::class, 'getWo']) -> name('getWo');

Route::post('/register-api', [apiController::class, 'registerApi'])->name('register-api');
Route::post('/login-api', [apiController::class, 'loginApi'])->name('login-api');


// $router->group(['middleware' => 'auth'], function () use ($router) {
//   Route::get('/user-byapi', [apiController::class, 'userByApi'])->name('user-byApi');

//   });


//   //API route for register new user
// Route::post('/register', [AuthController::class,'registerApi']);
// //API route for login user
// Route::post('/login', [AuthController::class,'loginApi']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        $user =  auth()->user();
        return response()->json(["status" => 200, "success" => true, "message" => "successfully", "result" => $user]);
       
    });

    Route::get('/getuser', [apiController::class, 'getUser']) -> name('getuser');

    Route::get('/getwo', [apiController::class, 'getWo']) -> name('getwo');
    // Route::get('/getwo', [apiController::class, 'getWo']) -> name('getWo');
    
    Route::post('/create-wo', [apiController::class, 'createWo'])->name('wo-api');

    // API route for logout user
    Route::post('/logout', [AuthController::class,'logout']);
});
  