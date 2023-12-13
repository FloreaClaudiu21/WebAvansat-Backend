<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'birthDate',
        'lastName',
        'firstName',
        'cars_id',
        'licenses_id',
    ];

    protected $guarded = [];

    public function license()
    {
        return $this->belongsTo(License::class, 'licenses_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'cars_id');
    }
}
