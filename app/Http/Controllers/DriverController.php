<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Models\License;
use Illuminate\Http\Request;

class DriverController extends Controller {

    public function getDriverByCarId(Request $request) {
        $carId = $request->query('carId');
        $driver = Driver::with('license')->whereHas('car', function ($query) use ($carId) {
            $query->where('id', $carId);
        })->with('car')->first();
        if ($driver) {
            return response()->json([
                'success' => true,
                'driver' => $driver,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Driver not found for the given car ID.',
            ]);
        }
    }

    public function getDriversByFirstName(Request $request) {
        $page = $request->query('page', 1);
        $firstName = $request->query('firstName');
        $drivers = Driver::with(['license', 'car.brand'])->where('firstName', 'like', $firstName . '%')
            ->paginate(10, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'drivers' => $drivers,
            'maxPages' => $drivers->lastPage(),
            'curPage' => $drivers->currentPage(),
        ]);
    }

    public function getDriversByFirstNameAndNoCar(Request $request) {
        $firstName = $request->query('firstName');
        $drivers = Driver::with('license')
            ->where('firstName', 'like', $firstName . '%')
            ->whereDoesntHave('car')
            ->get();
        return response()->json([
            'success' => true,
            'drivers' => $drivers,
        ]);
    }

    public function createDriver(Request $request) {
        try {
            $validatedData = $request->validate([
                'phone' => 'required|string',
                'birthDate' => 'required|date',
                'lastName' => 'required|string',
                'firstName' => 'required|string',
                'issueDate' => 'required|date',
                'categories' => 'required|string',
                'expirationDate' => 'required|date',
                'licenseNumber' => 'required|string|unique:licenses',
                'cars_id' => 'nullable|exists:cars,id',
            ]);
             // Create the license
            $license = License::create([
                'issueDate' => $validatedData['issueDate'],
                'categories' => $validatedData['categories'],
                'expirationDate' => $validatedData['expirationDate'],
                'licenseNumber' => $validatedData['licenseNumber'],
            ]);
            // Create the driver with the associated license
            $driver = Driver::create([
                'phone' => $validatedData['phone'],
                'birthDate' => $validatedData['birthDate'],
                'lastName' => $validatedData['lastName'],
                'firstName' => $validatedData['firstName'],
                'licenses_id' => $license->id,
            ]);
            return response()->json(['success' => true, 'driver' => $driver, 'license' => $license]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
       }
    }

    public function deleteDriver(Request $request) {
        try {
            $driverID = $request->query('driverID');
            if (!$driverID) {
                return response()->json(['success' => false, 'error' => 'Please specify the driver id!'], 500);
            }
            $driver = Driver::find($driverID);
            if (!$driver) {
                return response()->json(['success' => false, 'error' => 'Driver not found!'], 404);
            }
            if ($driver->license) {
                $driver->license->delete();
            }
            $driver->delete();
            return response()->json(['success' => true, 'message' => 'Driver deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function allocateCarToDriver(Request $request) {
        try {
            $driverID = $request->query('driverID');
            $carID = $request->query('carID');
            if (!$carID) {
                return response()->json(['success' => false, 'error' => `Please specify the car id!`], 500);
            }
            $driver = Driver::find($driverID);
            if (!$driver) {
                return response()->json(['success' => false, 'error' => 'Driver not found!'], 404);
            }
            $car = Car::find($carID);
            if (!$car) {
                return response()->json(['success' => false, 'error' => 'Car not found!'], 404);
            }
            $driver->car()->associate($car);
            $driver->save();
            return response()->json(['success' => true, 'message' => 'Car allocated to driver successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function deallocateCarFromDriver(Request $request) {
        try {
            $driverID = $request->query('driverID');
            $driver = Driver::find($driverID);
            if (!$driver) {
                return response()->json(['success' => false, 'error' => 'Driver not found!'], 404);
            }
            $driver->car()->dissociate();
            $driver->save();
            return response()->json(['success' => true, 'message' => 'Car deallocated from driver successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
