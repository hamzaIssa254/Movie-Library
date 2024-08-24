<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    /**
     * Login Route
     *
     * @method POST
     * @route /login
     * @desc Authenticates a user and returns a JWT token.
     */
    Route::post('login', 'login');

    /**
     * Register Route
     *
     * @method POST
     * @route /register
     * @desc Registers a new user and returns a JWT token.
     */
    Route::post('register', 'register');

    /**
     * Logout Route
     *
     * @method POST
     * @route /logout
     * @desc Logs out the authenticated user.
     * @middleware auth:api
     */
    Route::post('logout', 'logout')->middleware('auth:api');
});
/**
 *@method  resource
 *@desc Movie CRUD
 *@middleware auth:api
 */
Route::apiResource('movie',MovieController::class)->middleware('auth:api')->except(['index','show']);

 /**
     * add rate Route
     *
     * @method POST
     * @route /add-rate
     * @desc add rating for movie.
     * @middleware auth:api
     */

Route::post('/add-rate',[RatingController::class,'addRate'])->middleware('auth:api');
