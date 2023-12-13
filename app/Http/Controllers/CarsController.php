<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrands;
use App\Models\FavoriteCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller {

    public function createCar(Request $request) {
        try {
            $validatedData = $request->validate([
                'car_brands_id' => 'required|numeric',
                'plateNumber' => 'required|unique:cars|min:5|max:20',
                'features' => 'required|min:4',
                'mileage' => 'required|min:1|max:8',
                'color' => 'required|min:3|max:10',
                'registrationDate' => 'required',
                'fuelType' => 'required|min:4|max:20',
                'transmission' => 'required|min:4|max:20',
                'car_brands_id' => 'required|exists:car_brands,id',
            ]);
            $car = Car::create($validatedData);
            return response()->json(['success' => true, 'car' => $car]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function updateCar(Request $request) {
        try {
            $carID = $request->query('carID');
            if (!$carID) {
                return response()->json(['success' => false, 'error' => `Please specify the car id!`], 500);
            }
            $validatedData = $request->validate([
                'car_brands_id' => 'required|numeric',
                'features' => 'required|min:4',
                'mileage' => 'required|min:1|max:8',
                'color' => 'required|min:3|max:10',
                'registrationDate' => 'required',
                'fuelType' => 'required|min:4|max:20',
                'transmission' => 'required|min:4|max:20',
                'car_brands_id' => 'required|exists:car_brands,id',
            ]);
            $car = Car::find($carID);
            if (!$car) {
                return response()->json(['success' => false, 'error' => `Car with the ID: '{$carID}' have not been found!`], 404);
            }
            $car->update($validatedData);
            return response()->json(['success' => true, 'car' => $car]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteCar(Request $request) {
        $carID = $request->query('carID');
        if (!$carID) {
            return response()->json(['success' => false, 'error' => `Please specify the car id!`], 500);
        }
        $car = Car::where('id', $carID)->first();
        if (!$car) {
            return response()->json(['success' => false, 'error' => `Car with the ID: '{$carID}' have not been found!`], 404);
        }
        $car->delete();
        return response()->json(['success' => true, 'message' => `Car with the ID: '{$carID}' deleted successfully`]);
    }

    public function favoriteCar(Request $request)
    {
        try {
            $carID = $request->query('carID');
            if (!$carID) {
                return response()->json(['success' => false, 'error' => `Please specify the car id!`], 500);
            }
            $userID = $request->query('userID');
            if (!$userID) {
                return response()->json(['success' => false, 'error' => `Please specify the user id!`], 500);
            }
            $favoriteCar = FavoriteCar::create([
                'cars_id' => $carID,
                'users_id' => $userID,
            ]);
            return response()->json(['success' => true, 'message' => 'Car favorited successfully', 'favorite_car' => $favoriteCar]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function isFavoriteCar(Request $request) {
        try {
            $carID = $request->query('carID');
            if (!$carID) {
                return response()->json(['success' => false, 'error' => 'Please specify the car id!'], 500);
            }
            $userID = $request->query('userID');
            if (!$userID) {
                return response()->json(['success' => false, 'error' => 'Please specify the user id!'], 500);
            }
            $isFavorite = FavoriteCar::where('cars_id', $carID)
                ->where('users_id', $userID)
                ->exists();
            return response()->json(['success' => true, 'isFavorite' => $isFavorite]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function unfavoriteCar(Request $request) {
        try {
            $carID = $request->query('carID');
            if (!$carID) {
                return response()->json(['success' => false, 'error' => `Please specify the car id!`], 500);
            }
            $userID = $request->query('userID');
            if (!$userID) {
                return response()->json(['success' => false, 'error' => `Please specify the user id!`], 500);
            }
            $favoriteCar = FavoriteCar::where('cars_id', $carID)
                ->where('users_id', $userID)
                ->first();
            if ($favoriteCar) {
                $favoriteCar->delete();
                return response()->json(['success' => true, 'message' => 'Car unfavorited successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Car not found in favorites'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getCars() {
        $cars = Car::with('brand')->with('driver')::all();
        if (!$cars) {
            return response()->json(['success' => false, 'error' => 'Cars list have not been found!'], 404);
        }
        return response()->json(['success' => true, 'cars' => $cars]);
    }

    public function getCarsBrands() {
        $brands = CarBrands::all();
        if (!$brands) {
            return response()->json(['success' => false, 'error' => 'Cars brands list have not been found!'], 404);
        }
        if ($brands->isEmpty()) {
            return response()->json(['success' => false, 'error' => 'Cars brands list is empty!'], 404);
        }
        return response()->json(['success' => true, 'brands' => $brands]);
    }

    public function getCarsWithoutDrivers(Request $request) {
        $carsWithoutDrivers = Car::with('brand')->whereDoesntHave('driver')->get();
        return response()->json([
            'success' => true,
            'cars' => $carsWithoutDrivers,
        ]);
    }

    public function getCarsWithPage(Request $request) {
        $page = $request->query('page', 1);
        $cars = Car::with('brand')->paginate(10, ['*'], 'page', $page);
        if (!$cars) {
            return response()->json(['success' => false, 'error' => 'Cars list has not been found!'], 404);
        }
        return response()->json([
            'cars' => $cars,
            'success' => true,
            'maxPages' => $cars->lastPage(),
            'curPage' => $cars->currentPage(),
        ]);
    }

    public function getCarsByPlateNumber(Request $request) {
        $page = $request->query('page', 1);
        $plateNumber = $request->query('plateNumber');
        $cars = Car::with('brand')
            ->where('plateNumber', 'like', $plateNumber . '%')
            ->paginate(10, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'cars' => $cars,
            'maxPages' => $cars->lastPage(),
            'curPage' => $cars->currentPage(),
        ]);
    }

    public function getFavoriteCarsByPlateNumber(Request $request) {
        $page = $request->query('page', 1);
        $userID = $request->query('userID');
        if (!$userID) {
            return response()->json(['success' => false, 'error' => `Please specify the user id!`], 500);
        }
        $plateNumber = $request->query('plateNumber');
        $favoriteCarIds = FavoriteCar::where('users_id', $userID)->pluck('cars_id')->toArray();
        $query = Car::with('brand')->whereIn('id', $favoriteCarIds);
        if ($plateNumber) {
            $query->where('plateNumber', 'like', $plateNumber . '%');
        }
        $favoriteCars = $query->paginate(10, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'favoriteCars' => $favoriteCars,
            'maxPages' => $favoriteCars->lastPage(),
            'curPage' => $favoriteCars->currentPage(),
        ]);
    }

    public function getCarsByFilters(Request $request) {
        try {
            $filters = $request->all();
            $page = $request->query('page', 1);
            unset($filters['page']);
            $carsQuery = Car::with('brand')::query();
            foreach ($filters as $field => $value) {
                if ($field === 'manufacturer' || $field === 'model' || $field === 'year') {
                    $carsQuery->whereHas('brand', function ($query) use ($field, $value) {
                        $query->where($field, $value);
                    });
                } else {
                    $carsQuery->where($field, $value);
                }
            }
            $cars = $carsQuery->paginate(10, ['*'], 'page', $page);
            return response()->json([
                'cars' => $cars,
                'success' => true,
                'maxPages' => $cars->lastPage(),
                'curPage' => $cars->currentPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
