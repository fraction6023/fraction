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

    public function book_club(Request $request)
    {
  
    $visit = new Visit();
    $visit->user_id = $request->user_id;
    $visit->gym_id = $request->club_id;
    $visit->status = 'approved';

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pin = mt_rand(1000000, 9999999)
        . mt_rand(1000000, 9999999)
        . $characters[rand(0, strlen($characters) - 1)];

    $string = str_shuffle($pin);
    $visit->approveCode = $string;
    
    $visit->save();

    return response()->json(['success' => true, 'message' => 'تم الحجز بنجاح']);
    }
    
    public function user ($user_id) {
        $user = User::find($user_id);
        $customer = Customer::find($user_id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'المستخدم غير موجود.',
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'name' => $user->name,
            'email' => $user->email,
            'user_kind' => $customer->user_kind
        ]);
    }

    public function get_user_kind ($user_id) {
        $customer = Customer::find($user_id);
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'المستخدم غير موجود.',
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'user_kind' => $customer->user_kind
        ]);
    }

    public function update_user_info (Request $request, $user_id) {
        $user = User::find($user_id);
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'المستخدم غير موجود.',
            ], 404);
        }
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_id,
        ]);
    
        $user->update($validatedData);
    
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث بيانات المستخدم بنجاح.',
            'data' => $user,
        ]);
    }

    public function change_password (Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // 'current_password' => 'required',
            'new_password' => 'min:8',
        ]);
    
        $user = User::find($request->user_id);
    
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'كلمة المرور الحالية غير صحيحة.',
            ], 400);
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'تم تغيير كلمة المرور بنجاح.',
        ]);
    }

    public function pending_bookings ($user_id) {
        // البحث عن الحجوزات القائمة بناءً على user_id
        $gym_id = Customer::where('user_id',$user_id)->get()->first();
        $bookings = Visit::with('user','gym')->where('gym_id', $gym_id->gym_id)->orderBy('created_at', 'desc')->get();
        //$bookings = Visit::with('customer') // جلب بيانات العميل مع الحجوزات

            //->where('status', 'approved') // التحقق من أن الحالة "pending"
            
    
        if ($bookings->isEmpty()) {
            return response()->json([
                'success' => true,
                'bookings' => [],
                'message' => 'لا توجد حجوزات قائمة حالياً.',
            ]);
        }
    
        return response()->json([
            'success' => true,
            'bookings' => $bookings,
        ]);
    }
}
