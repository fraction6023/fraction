<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Customer;
use App\Models\Gym;
use Illuminate\Support\Facades\Auth;



class GymController extends Controller
{
    public function waitingOrders(){
    if(Auth::id()){
    $customer = Customer::find(Auth::id());
    $visits = Visit::where('gym_id',$customer->gym_id)->orderBy('id', 'DESC')->get();
    $visitsStar = Visit::all();
    return view('gym.waitingOrders',['visits'=>$visits,'visitsStar'=>$visitsStar]);
    }else{
        return view('welcome');
    }
    }

    public function gymfeedbackVisit(Request $req){
        $visit = Visit::find($req->input('visit_id'));
        $visit->customer_comment = $req->input('comment');
        $visit->customer_rate = $req->input('rate');

        if($visit->status == 'visited')
            $visit->status = 'finish_gym';
        else
            $visit->status = 'finish';

        $visit->save();

        return redirect('waitingOrders');
    }

    public function qrScanner(){
 
        return view('gym.qrScanner');
    }

    public function gymregister(){
 
        return view('gym.gymregister');
    }

    public function insertGMY(Request $req){
        $newGYM = new Gym;
        if($req->hasFile('image')){
            $distination_path = 'public\images';
            $gymImage = time().'.'.$req->image->extension();
            $req->file('image')->storeAs($distination_path ,$gymImage);
        }else{
            $gymImage='noImage.gif';
        }

        $newGYM->name = $req->input('gymName');
        $newGYM->cpd = $req->input('cpd');
        $newGYM->comment = $req->input('comment');
        $newGYM->image = $gymImage;

        $newGYM->save();
  
        return redirect('waitingOrders');
    }
}
