<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasApiTokens,HasFactory;
    
    public function gym(){
        return $this->belongsTo(Gym::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
