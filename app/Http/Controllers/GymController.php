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

    public function qrScanner(Request $req){
        if(Auth::id()){
       
            if($req->qrInfo){
                $customer = Customer::find(Auth::id());
                $visit = Visit::where('approveCode',$req->qrInfo)->orderBy('approveCode', 'DESC')->get()->first();
                //$visit = Visit::find('45');
                if($visit){
                    if( $visit->gym_id == $customer->gym_id ){
                        //$visit->approveCode = $req->qrInfo.'Finish';//601769B46292817
                        $currentStatus = $visit->status; // to chech is it scanned befor or not .. for redirect message

                        $visit->status = 'visited';//$customer->gym_id;'visited';
                        $visit->save();
                    //return view('gym.qrScanner');//->with('grapped successfull');
                        if( $currentStatus == 'approved' ){
                            return redirect()->back()->with('success', $req->qrInfo.'  تم المسح بنجاح');
                        }else{
                            return redirect()->back()->with('success', $req->qrInfo.'  تم المسح مسبقاً');
                        }
                    }else{
                        //return view('gym.qrScanner');//->with('this qr not fot this gym');
                        return redirect()->back()->with('error', 'الرمز مخصص لصالة أخرى');  
                    }
                }else{
                    //return view('gym.home');//->with('wrog reading qr');
                    return redirect()->back()->with('error', 'الرمز غير صحيح');  
                }
            }else{
                return view('gym.qrScanner');
            }
        }else{
            return view('welcome');
        }
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

            //$gymImage = 'noImage.png';

        $newGYM->name = $req->input('gymName');
        $newGYM->cpd = $req->input('cpd');
        $newGYM->comment = $req->input('comment');
        $newGYM->image = $gymImage;

        $newGYM->save();
  
        return redirect('waitingOrders');
    }

    
    public function gymFeedBack(){
        if(Auth::id()){

            $gymFeedBack = Visit::where('user_id',Auth::id())->where('status','finish')->orderBy('id', 'DESC')->get();

            return view('gym.gymFeedBack',['gymFeedBack'=>$gymFeedBack]);
        }else{
        return view('welcome');
        }
    }

    public function finance(){
        if(Auth::id()){
            $gymId = Customer::where('user_id',Auth::id())->get();
            $visits = Visit::where('gym_id',$gymId[0]->gym_id)
                            ->where(function($query){
                                $query->where('status','finish')
                                        ->orWhere('status','finish_customer')
                                        ->orWhere('status','visited')
                                        ->orWhere('status','finish_gym');
                            })->orderBy('id', 'DESC')->get();

            return view('gym.finance',['visits'=>$visits]);
        }else{
        return view('welcome');
        }
    }

}
