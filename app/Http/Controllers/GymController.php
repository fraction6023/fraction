<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;



class GymController extends Controller
{
    public function waitingOrders(){
    $customer = Customer::find(Auth::id());
    $visits = Visit::where('gym_id',$customer->gym_id)->orderBy('id', 'DESC')->get();
    $visitsStar = Visit::all();
    return view('gym.waitingOrders',['visits'=>$visits,'visitsStar'=>$visitsStar]);
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
}
