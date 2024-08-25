<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Visit;
use App\Models\Gym;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index(){
        if(Auth::id()){
        $customer =  Customer::find(Auth::id());
        return view('customer.index')->with('customer',$customer);
        }else{
            $customer =  Customer::find(Auth::id());
        return view('welcome');
        }
    }

    public function dashboard(){
        $customer = Customer::find(Auth::id());
        return view('customer.dashboard',['customer'=>$customer]);
    }


    public function visits(){
        //$visits = Visit::all()->where('user_id',Auth::id());
        $visits = Visit::where('user_id',Auth::id())->get();
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        return view('customer.visits',['visits'=>$visits]);
    }
    
    public function dashboardUpdate(Request $req){
        
        $customer = Customer::find(Auth::id());

        $customer->user_id= Auth::id();
        $customer->gender= $req->input('gender');
        $customer->mobile= $req->input('mobile');
        $customer->city= $req->input('city');
        $customer->image= $req->input('image');
        $customer->note= $req->input('note');


        $customer->update();


        return view('customer.dashboard',['customer'=>$customer]);
    }

    public function booking(){
        $gyms = Gym::all();
        return view('customer.booking',['gyms'=>$gyms]);
    }
    
    public function bookGym(Request $req){
        $visit = new Visit;
        $visit->gym_id = $req->input('gym_id');
        $visit->user_id = Auth::id();
        $visit->save();

        //$visits = Visit::where('user_id',Auth::id());
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        $visits = Visit::where('user_id',Auth::id())->get();


        //return view('customer.visits',['visits'=>$visits]);
        return redirect('visits');
    }


}