<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\DriverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/api/v1/')->group(function () {
    // AUTH ROUTE
    Route::post('auth', [AuthController::class, 'login']);
    // REGISTER ROUTE
    Route::post('register', [AuthController::class, 'register']);
    // USER ROUTES
    Route::get('user/getByID', [AuthController::class, 'getUserByID']);
    Route::get('user/getByEmail', [AuthController::class, 'getUserByEmail']);
    // CAR ROUTES
    Route::post('cars/create', [CarsController::class, 'createCar']);
    Route::put('cars/update', [CarsController::class, 'updateCar']);
    Route::delete('cars/delete', [CarsController::class, 'deleteCar']);
    Route::get('cars', [CarsController::class, 'getCarsWithPage']);
    Route::get('cars/all', [CarsController::class, 'getCars']);
    Route::get('cars/brands', [CarsController::class, 'getCarsBrands']);
    Route::get('cars/noDriver', [CarsController::class, 'getCarsWithoutDrivers']);
    Route::get('cars/byPlateNumber', [CarsController::class, 'getCarsByPlateNumber']);
    Route::get('cars/byFilters', [CarsController::class, 'getCarsByFilters']);
    Route::get('cars/favorites', [CarsController::class, 'getFavoriteCarsByPlateNumber']);
    Route::post('cars/favorites/create', [CarsController::class, 'favoriteCar']);
    Route::put('cars/favorites/exists', [CarsController::class, 'isFavoriteCar']);
    Route::delete('cars/favorites/delete', [CarsController::class, 'unfavoriteCar']);
    // DRIVERS ROUTES
    Route::post('drivers/create', [DriverController::class, 'createDriver']);
    Route::delete('drivers/delete', [DriverController::class, 'deleteDriver']);
    Route::post('drivers/allocate-car', [DriverController::class, 'allocateCarToDriver']);
    Route::put('drivers/deallocate-car', [DriverController::class, 'deallocateCarFromDriver']);
    Route::get('drivers/byFirstName', [DriverController::class, 'getDriversByFirstName']);
    Route::get('drivers/byCarId', [DriverController::class, 'getDriverByCarId']);
    Route::get('drivers/byFirstNameNoCar', [DriverController::class, 'getDriversByFirstNameAndNoCar']);
});

