<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    use HasFactory;

    // public function gym(){
    //     return $this->hasOne(Gym::class);
    // }
    public function gym(){
        return $this->belongsTo(Gym::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
