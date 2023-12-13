<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteCar extends Model
{
    use HasFactory;
    
    protected $fillable = ['cars_id', 'users_id'];
    protected $guarded = [];

    public function car()
    {
        return $this->belongsTo(Car::class, 'cars_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
