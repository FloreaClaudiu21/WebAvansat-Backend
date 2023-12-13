<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    
    protected $fillable = ['car_brands_id', 'plateNumber', 'features', 'mileage', 'color', 'registrationDate', 'fuelType', 'transmission'];
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(CarBrands::class, 'car_brands_id');
    }

    public function driver() {
        return $this->hasOne(Driver::class, "cars_id");
    }
}
