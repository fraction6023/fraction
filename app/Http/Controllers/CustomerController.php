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
    public function purchase(Request $req){

        $fund = Customer::find(Auth::id());
        $fund->funds = $fund->funds + $req->input('funds');
        $fund->save();

        return redirect('booking');
    }

    public function visit(){
        //$visits = Visit::all()->where('user_id',Auth::id());
        $visit = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        return view('customer.visit',['visit'=>$visit]);
    }
    public function visits(){
        //$visits = Visit::all()->where('user_id',Auth::id());
        $visits = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
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
        $fund = Customer::find(Auth::id());
        $visits = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        $allVisits = Visit::all();
        return view('customer.booking',['gyms'=>$gyms,'fund'=>$fund,'visits'=>$visits,'allVisits'=>$allVisits]);
    }
    
    public function bookGym(Request $req){

        $fund = Customer::find(Auth::id());
        $fund->funds = $fund->funds - $req->input('cpd');
        $fund->save();

        $visit = new Visit;
        $visit->gym_id = $req->input('gym_id');
        $visit->user_id = Auth::id();
        $visit->status = 'pending';
        $visit->cost = $req->input('cpd');
        $visit->save();

        //$visits = Visit::where('user_id',Auth::id());
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        //$visits = Visit::where('user_id',Auth::id())->get();


        //return view('customer.visits',['visits'=>$visits]);
        return redirect('visit');
    }
    public function cancelBookGym(Request $req){

        $fund = Customer::find(Auth::id());
        $fund->funds = $fund->funds + $req->input('visit_cost');
        $fund->save();

        $visit = Visit::find($req->input('visit_id'));
        $visit->status = 'canceled';
        $visit->save();

        //$visits = Visit::where('user_id',Auth::id());
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        //$visits = Visit::where('user_id',Auth::id())->get();


        //return view('customer.visits',['visits'=>$visits]);
        return redirect('visit');
    }

    public function approveVisit(Request $req){
        
        $visit = Visit::find($req->input('visit_id'));
       
        // if($visit->status = 'approved'){
        // $visit->status = 'finish';
        // $visit->comment = $req->input('comment');
        // $visit->rate = $req->input('rate');

        // $visit->save();
        
        // return redirect('visits');

        // }elseif($visit->status = 'pending'){

        $visit->status = 'approved';

        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        $string = str_shuffle($pin);
        $visit->approveCode = $string;
        
        $visit->save();

        return redirect('visits');

        
        
    }

    public function feedbackVisit(Request $req){
        $visit = Visit::find($req->input('visit_id'));
        $visit->comment = $req->input('comment');
        $visit->rate = $req->input('rate');
        $visit->status = 'finish';

        $visit->save();

        return redirect('visits');
    }
    public function feedbackfinish(Request $req){
        $visit = Visit::find($req->input('visit_id'));
     
        $visit->status = 'visited';

        $visit->save();

        return redirect('visits');
    }


}