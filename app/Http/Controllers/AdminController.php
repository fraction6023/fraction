<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gym;
use Illuminate\Container\Attributes\Auth;

class AdminController extends Controller
{
    public function index(){
        $users =  User::all();
        $gyms =  Gym::all();
        return view('admin.userManagement',['users'=>$users,'gyms'=>$gyms]);
    }
    
    public function matchUserGym(Request $req){
        $customer = Customer::find($req->input('user_id'));

        $customer->user_id = $req->input('user_id');
        $customer->gym_id = $req->input('gym_id');
        $customer->user_kind = $req->input('user_kind');

        $customer->save();


        $users =  User::all();
        $gyms =  Gym::all();

        return view('admin.userManagement',['users'=>$users,'gyms'=>$gyms]);
    }
}
