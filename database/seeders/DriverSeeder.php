<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\License;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder {
    public function run() {
        $firstNames = ["John", "Emma", "Michael", "Olivia", "William", "Ava", "James", "Sophia", "Benjamin", "Isabella"];
        $lastNames = ["Smith", "Johnson", "Brown", "Lee", "Garcia", "Davis", "Rodriguez", "Martinez", "Jackson", "Taylor"];
        for ($i = 1; $i <= 40; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $birthDate = date('Y-m-d', strtotime('-'.rand(18, 50).' years'));
            $phoneNumber = "555-".rand(100, 999)."-".rand(1000, 9999);
            $issueDate = date('Y-m-d', strtotime('-'.rand(1, 5).' years'));
            $expirationDate = date('Y-m-d', strtotime('+'.rand(1, 5).' years'));
            $license = License::create([
                'issueDate' => $issueDate,
                'categories' => "A, B",
                'expirationDate' => $expirationDate,
                'licenseNumber' => "LIC" . $i,
            ]);
            Driver::create([
                'phone' => $phoneNumber,
                'birthDate' => $birthDate,
                'lastName' => $lastName,
                'firstName' => $firstName,
                'licenses_id' => $license->id,
            ]);
        }
    }
}
