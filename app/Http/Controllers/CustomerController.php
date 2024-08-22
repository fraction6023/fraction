<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){

        $customer = new Customer();
        $customer->note = 'ok';
        $customer->save();

        return view('customer.index');
    }

    public function dashboard(){
        return view('customer.dashboard');
    }}
