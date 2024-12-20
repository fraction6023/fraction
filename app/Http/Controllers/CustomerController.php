<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Visit;
use App\Models\Gym;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index(){
        if(Auth::id()){
            return redirect('welcome');
        }else{
        return view('customer.welcome');
        }
    }
    public function welcome(){
        if(Auth::id()){
        $customer =  Customer::find(Auth::id());
        if( $customer->user_kind == 'customer' ){
            $visit = Visit::where('user_id',Auth::id())->where('status','pending')->orderBy('id', 'DESC')->get();

            $visits = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
            // return view('customer.home',['visit'=>$visit]);

            //return view('app.your_view',compact('object'));
            return view('customer.home',['visits'=>$visits,'visit'=>$visit,'customer'=>$customer]);
            //return view('customer.home1')->with('customer',$customer);
        }elseif( $customer->user_kind == 'gym' ){
            return view('gym.home')->with('customer',$customer);
        }else{
            return view('welcome')->with('customer',$customer);
        }
        }else{
            $customer =  Customer::find(Auth::id());
        return view('welcome');
        }
    }

    public function customerFeedBack(){
        if(Auth::id()){

            $customerFeedBack = Visit::where('user_id',Auth::id())->where('status','finish')->orderBy('id', 'DESC')->get();

            return view('customer.customerFeedBack',['customerFeedBack'=>$customerFeedBack]);
        }else{
        return view('welcome');
        }
    }

    public function finance(){
        if(Auth::id()){
            $customer = Customer::find(Auth::id());
            $visits = Visit::where('user_id',Auth::id())
                            ->where(function($query){
                                $query->where('status','finish')
                                        ->orWhere('status','finish_customer')
                                        ->orWhere('status','visited')
                                        ->orWhere('status','finish_gym');
                            })->orderBy('id', 'DESC')->get();

            return view('customer.finance',['visits'=>$visits,'customer'=>$customer]);
        }else{
        return view('welcome');
        }
    }

    public function showGymsOnMap(){
        if(Auth::id()){

            $gyms = Gym::all();

            return view('customer.showGymsOnMap',['gyms'=>$gyms]);
        }else{
        return view('welcome');
        }
    }

    public function charging(){
        return view('customer.charging');
    }

    public function submit(Request $req) 
    {
        // إعداد البيانات
        $merchantIdentifier = 'fDDkIzNY';
        $accessCode = 'kkCup7v8OTkCnYxCcdAf';
        $shaRequestPhrase = '097YS5/VQl9X9ZyQqWb1OO#@';
        $endpoint = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
        $merchantReference = 'ORD-' . time(); // رقم مرجعي فريد
        $amount = $req->amount;// المبلغ بالعملة الأصغر (مثال: 100 ريال = 10000 هللة)
        $currency = 'SAR'; // العملة
        $customerEmail = 'test@example.com';
        $language = 'ar'; // لغة الواجهة
        $command = 'PURCHASE'; // نوع العملية
        $threeDs = 'true'; // تفعيل 3D Secure

        // بناء التوقيع (Signature)
        $signatureString = "$shaRequestPhrase" .
            "access_code=$accessCode" .
            "amount=$amount" .
            "command=$command" .
            "currency=$currency" .
            "customer_email=$customerEmail" .
            "language=$language" .
            "merchant_identifier=$merchantIdentifier" .
            "merchant_reference=$merchantReference" .
            "$shaRequestPhrase";

        $signature = hash('sha256', $signatureString);

        // البيانات المرسلة إلى PayFort
        $postData = [
            'merchant_reference' => $merchantReference,
            'access_code' => $accessCode,
            'merchant_identifier' => $merchantIdentifier,
            'amount' => $amount,
            'currency' => $currency,
            'customer_email' => $customerEmail,
            'language' => $language,
            'command' => $command,
            'signature' => $signature,
            'three_ds' => $threeDs,
        ];

        // إرسال الطلب باستخدام Laravel HTTP Client
        $response = Http::asForm()->post($endpoint, $postData);

        // معالجة الرد
        if ($response->successful()) {
            $fund = Customer::find(Auth::id());
            $fund->funds = $fund->funds + $amount;
            $fund->save();


            $responseData = $response->json();
            // return response()->json([
            //     'message' => 'Payment request successful',
            //     'data' => $responseData,
            // ]);

            return redirect('customerFinance');//,['responseData' => $responseData]);
        }

        return response()->json([
            'message' => 'Payment request failed',
            'error' => $response->body(),
        ], 400);
    }
    
    public function redirectToSubmitPage(Request $req){ // old submit()

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        $string = str_shuffle($pin);

        $shaString = '';
            
        $requestParams = array(
            'command' => 'AUTHORIZATION',
            'access_code' => 'kkCup7v8OTkCnYxCcdAf',
            'merchant_identifier' => 'fDDkIzNY',
            'merchant_reference' => $string,
            'amount' => $req->amount * 100,
            'currency' => 'SAR',
            'language' => 'en',
            'customer_email' => 'test@payfort.com',
            'order_description' => 'charging acount'
            );


        ksort($requestParams);
        foreach($requestParams as $key => $value){
            $shaString .= "$key=$value";
        }

        $shaString = '097YS5/VQl9X9ZyQqWb1OO#@' . $shaString . '097YS5/VQl9X9ZyQqWb1OO#@';

        $signature = hash('sha256',$shaString);

        $requestParams['signature'] = $signature;

        // echo"<div style:'color:#6e9; width:100%; border: 2px solid #3333; text-align:center'>signiture key => ". $requestParams['signature']."</div>";

        $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
        echo "<html xmlns='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        echo "<form action='$redirectUrl' method='post' name='frm'>\n";
        header("refresh:15;url=".$redirectUrl."");
        foreach ($requestParams as $a => $b) {
             echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
         }
        echo "\t<script type='text/javascript'>\n";
        echo "\t\tdocument.frm.submit();\n";
        echo "\t</script>\n";
        echo "</form>\n</body>\n</html>";

    }

    public function dashboard(){
    if(Auth::id()){
    $customer = Customer::find(Auth::id());
    return view('customer.dashboard',['customer'=>$customer]);
    }else{
            return view('welcome');
        }

    }
    public function purchase(Request $req){
        
        $fund = Customer::find(Auth::id());
        $fund->funds = $fund->funds + $req->input('funds');
        $fund->save();

        return redirect('booking'); 
        

    }

    public function visit(){
        if(Auth::id()){
             //$visits = Visit::all()->where('user_id',Auth::id());
        $visit = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        return view('customer.visit',['visit'=>$visit]);
        }else{
            return view('welcome');
        }
       
    }
    public function visits(){
        if(Auth::id()){
        //$visits = Visit::all()->where('user_id',Auth::id());
        $visits = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        return view('customer.visits',['visits'=>$visits]);
        }else{
            return view('welcome');
        }
        
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
        if(Auth::id()){
        $gyms = Gym::all();
        $fund = Customer::find(Auth::id());
        $visits = Visit::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        $allVisits = Visit::all();
        return view('customer.booking',['gyms'=>$gyms,'fund'=>$fund,'visits'=>$visits,'allVisits'=>$allVisits]);   
        }else{
            return view('welcome');
        }
       
    }

    public function pay(Request $req){
        
        $checkout = $req->user()->checkout(['pri_tshirt', 'pri_socks' => 5]);
 
        return view('customer.billing', ['checkout' => $checkout]);

        // $payLink = Auth::user()->charge(71 , 'Finally done!');

        // return view('customer.billing',[
        //     'payLink' => $payLink
        // ]);
    }

    
    public function bookGym(Request $req){

        $fund = Customer::find(Auth::id());
        $fund->funds = $fund->funds - $req->input('cpd');
        $fund->save();

        $visit = new Visit;
        $visit->gym_id = $req->input('gym_id');
        $visit->user_id = Auth::id();
        $visit->status = 'approved';
        $visit->cost = $req->input('cpd');

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        $string = str_shuffle($pin);
        $visit->approveCode = $string;

        $visit->save();

        //$visits = Visit::where('user_id',Auth::id());
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        //$visits = Visit::where('user_id',Auth::id())->get();


        //return view('customer.visits',['visits'=>$visits]);
        return redirect('/');
    }
    public function cancelBookGym(Request $req){
        $visit_status = Visit::find($req->input('visit_id'));
        if($visit_status->status=='pending'){
            $fund = Customer::find(Auth::id());
            $fund->funds = $fund->funds + $req->input('visit_cost');
            $fund->save();

            $visit = Visit::find($req->input('visit_id'));
            $visit->status = 'canceled';
            $visit->save();
        }

        //$visits = Visit::where('user_id',Auth::id());
        //$visits = DB::table('visits')->where('user_id',Auth::id())->get();
        //$visits = Visit::where('user_id',Auth::id())->get();


        //return view('customer.visits',['visits'=>$visits]);
        //return redirect('visit');
        return redirect('/');
    }

    public function approveVisit(Request $req){
        
        $visit_status = Visit::find($req->input('visit_id'));
        if($visit_status->status=='pending'){

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
        }
        return redirect('/');

        
        
    }

    public function feedbackVisit(Request $req){
        $visit = Visit::find($req->input('visit_id'));
        $visit->gym_comment = $req->input('comment');
        $visit->gym_rate = $req->input('rate');

        if($visit->status == 'visited')
            $visit->status = 'finish_customer';
        else
            $visit->status = 'finish';

        $visit->save();

        return redirect('/');
    }
    public function feedbackfinish(Request $req){
        $visit = Visit::find($req->input('visit_id'));
     
        $visit->status = 'visited';

        $visit->save();

        return redirect('/');
    }


}