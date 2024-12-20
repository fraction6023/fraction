<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        //$visits = Visit::all();
        $visits = Visit::orderBy('created_at', 'desc')->get();

        return response()->json($visits);
    }

    public function myvisits($id)
    {
        // قراءة جميع المنتجات
        //$visits = Visit::all();
        $visits = Visit::where('user_id',$id)->orderBy('created_at', 'desc')->get();

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
        // $validationRule = [
        //     'email' => 'required|string',
        //     'password' => 'required|string'
        // ];

        $credentials = request(key:['email','password']);
        if(!Auth::attempt(credentials:$credentials)){
            return response()->json(data:[
                'status' => 'faild',
                'message' => 'incorrect login details',
            ]);
        }

        //$user=Auth::user();
        
        //$user = $request->user();
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        $bearerToken = $user->createToken('auth_token')->plainTextToken;;
        
        

        //$validation = Validator::make(data: $request->all(), rules: $validationRule);

        return response()->json(data:[
            "status" => "success",
            "success" => "true",
            "user" => $user,
            "user_id" => $user->id,
            "token" => $bearerToken
        ]);
       
    }

    public function register(Request $request)
    {
        // // تحقق من صحة البيانات
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // // إنشاء المستخدم
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // تأكد من استخدام Hash::make

        ]);

        // // إنشاء التوكن (اختياري)
        $token = $user->createToken('auth_token')->plainTextToken;

        $customer = new Customer();
        $customer->user_id = 'undefined';
        $customer->gym_id = 'undefined';
        $customer->save();

        // إرجاع الاستجابة
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully!',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 201);
        
        // return response()->json([
        //         'success' => true,
        //         'message' => 'User registered successfully!',
        //         'data' => [
        //             'user' => 'user',
        //             'token' => 'token',
        //         ],
        //     ]);
    }

    public function updateStatus(Request $request)
    {
        // التحقق من صحة البيانات المرسلة
        // $request->validate([
        //     'itemId' => 'required|id',
        //     'status' => 'required|string',
        // ]);

        try {
            // العثور على الحجز وتحديث حالته
            $booking = Visit::findOrFail($request->itemId);
            $booking->status = 'visited';
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث حالة الحجز بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الحجز',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function saveFeedback(Request $request)
    {
   
        try {
            // العثور على الحجز وتحديث حالته
            $booking = Visit::findOrFail($request->itemId);
            $booking->gym_comment = $request->comment;
            $booking->gym_rate = $request->rating;
            $booking->status = 'finish_customer';
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث حالة الحجز بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الحجز',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
