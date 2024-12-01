<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Visit;
use App\Models\Gym;

class FractionController extends Controller
{
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
}
