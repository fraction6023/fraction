<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){

        $customer =  Customer::find(Auth::id());
        //$customer->note = 'ok';

        return view('customer.index')->with('funds',$customer->funds);
    }

    public function dashboard(){
        $customer = Customer::find(Auth::id());
        return view('customer.dashboard',['customer'=>$customer]);
    }
    
    public function dashboardUpdate(Request $req){
        
        $customer = Customer::find(Auth::id());

        $customer->gender= $req->input('gender');
        $customer->mobile= $req->input('mobile');
        $customer->city= $req->input('city');
        $customer->image= $req->input('image');
        $customer->note= $req->input('note');


        $customer->update();


        return view('customer.dashboard',['customer'=>$customer]);
    }
}