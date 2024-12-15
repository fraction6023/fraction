<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Visit;
use App\Models\Gym;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FractionController extends Controller
{
    use AuthenticatesUsers;

    public function visits()
    {
        // قراءة جميع المنتجات
        $visits = Visit::all();
        return response()->json($visits);
    }

    public function showvisit($id)
    {
        // قراءة منتج محدد
        $visit = Visit::find($id);

        if (!$visit) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($visit);
    }

    public function login(Request $request)
    {
        $validationRule = [
            'email' => 'required|string',
            'password' => 'required|string'
        ];

        $credentials = request(key:['email','password']);
        if(!Auth::attempt(credentials:$credentials)){
            return response()->json(data:[
                'status' => 'faild',
                'message' => 'incorrect login details',
            ]);
        }

        $user = $request->user();
        $bearerToken = $user->createToken('auth_token')->plainTextToken;;
        

        //$validation = Validator::make(data: $request->all(), rules: $validationRule);

        return response()->json(data:[
            "status" => "success",
            "success" => "true",
            "user" => $user,
            "token" => $bearerToken
        ]);
       
    }

}
