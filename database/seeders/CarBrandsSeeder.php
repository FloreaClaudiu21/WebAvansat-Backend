<?php

namespace Database\Seeders;

use App\Models\CarBrands;
use Illuminate\Database\Seeder;

class CarBrandsSeeder extends Seeder
{
    public function run()
    {
        $carData = [
            ["manufacturer" => "Audi", "model" => "A4", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "A5", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "A6", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "A7", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "A8", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "Q3", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "Q7", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "Q8", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "RS3", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "RS4", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "RS5", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "RS6", "year" => 2023],
            ["manufacturer" => "Audi", "model" => "RS7", "year" => 2023],
            ["manufacturer" => "Audi", "model" => "S3", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "S4", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "S5", "year" => 2021],
            ["manufacturer" => "Audi", "model" => "S6", "year" => 2022],
            ["manufacturer" => "Audi", "model" => "S7", "year" => 2023],
            ["manufacturer" => "Audi", "model" => "S8", "year" => 2023],
            ["manufacturer" => "BMW", "model" => "3 Series", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "5 Series", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "2 Series", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "4 Series", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "6 Series", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "7 Series", "year" => 2023],
            ["manufacturer" => "BMW", "model" => "8 Series", "year" => 2023],
            ["manufacturer" => "BMW", "model" => "X1", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "X2", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "X3", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "X4", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "X5", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "X6", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "X7", "year" => 2023],
            ["manufacturer" => "BMW", "model" => "M2", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "M3", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "M4", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "M5", "year" => 2023],
            ["manufacturer" => "BMW", "model" => "M8", "year" => 2023],
            ["manufacturer" => "BMW", "model" => "i3", "year" => 2021],
            ["manufacturer" => "BMW", "model" => "i4", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "iX3", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "iX5", "year" => 2022],
            ["manufacturer" => "BMW", "model" => "iX7", "year" => 2023],
            ["manufacturer" => "Chevrolet", "model" => "Equinox", "year" => 2022],
            ["manufacturer" => "Chevrolet", "model" => "Malibu", "year" => 2022],
            ["manufacturer" => "Chevrolet", "model" => "Silverado", "year" => 2022],
            ["manufacturer" => "Ford", "model" => "Escape", "year" => 2022],
            ["manufacturer" => "Ford", "model" => "Expedition", "year" => 2022],
            ["manufacturer" => "Ford", "model" => "F-150", "year" => 2021],
            ["manufacturer" => "Ford", "model" => "Fusion", "year" => 2021],
            ["manufacturer" => "Ford", "model" => "Mustang", "year" => 2023],
            ["manufacturer" => "Ford", "model" => "Ranger", "year" => 2023],
            ["manufacturer" => "Honda", "model" => "Accord", "year" => 2022],
            ["manufacturer" => "Honda", "model" => "Civic", "year" => 2022],
            ["manufacturer" => "Honda", "model" => "Odyssey", "year" => 2022],
            ["manufacturer" => "Honda", "model" => "Pilot", "year" => 2022],
            ["manufacturer" => "Mercedes-Benz", "model" => "C-Class", "year" => 2022],
            ["manufacturer" => "Mercedes-Benz", "model" => "E-Class", "year" => 2022],
            ["manufacturer" => "Mercedes-Benz", "model" => "GLE", "year" => 2022],
            ["manufacturer" => "Nissan", "model" => "Altima", "year" => 2021],
            ["manufacturer" => "Nissan", "model" => "Murano", "year" => 2021],
            ["manufacturer" => "Nissan", "model" => "Rogue", "year" => 2022],
            ["manufacturer" => "Tesla", "model" => "Model 3", "year" => 2022],
            ["manufacturer" => "Tesla", "model" => "Model S", "year" => 2023],
            ["manufacturer" => "Tesla", "model" => "Model X", "year" => 2022],
            ["manufacturer" => "Tesla", "model" => "Model Y", "year" => 2023],
            ["manufacturer" => "Toyota", "model" => "Camry", "year" => 2022],
            ["manufacturer" => "Toyota", "model" => "Corolla", "year" => 2023],
            ["manufacturer" => "Toyota", "model" => "Highlander", "year" => 2021],
            ["manufacturer" => "Toyota", "model" => "RAV4", "year" => 2023],
        ];
        foreach ($carData as $car) {
            CarBrands::create([
                'manufacturer' => $car['manufacturer'],
                'model' => $car['model'],
                'year' => $car['year'],
            ]);
        }
    }
}
