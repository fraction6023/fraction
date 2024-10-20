<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    public function visits(){
        return $this->hasMany(Visit::class);
    }

    public function customer(){
        return $this->hasMany(Customer::class);
    }
}
