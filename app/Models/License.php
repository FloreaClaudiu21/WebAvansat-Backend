<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $fillable = ['issueDate', 'categories', 'expirationDate', 'licenseNumber'];
    protected $guarded = [];

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}