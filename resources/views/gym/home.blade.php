@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <!-- <input type="submit" value="قبول" class="btn btn-warning"> -->
                <div class="card-header">{{ __('لوحة التحكم') }}</div>
                <br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <!-- <div class="testRed">TESTING...H2</div> -->
                    
                        <!-- <a href="\booking"> -->
                            <input type="button" value="حجوزات بانتظار الاعتماد" onclick="location.href='waitingOrders';" class="btn btn-success mb-3" >
                        <!-- </a> -->
                    
                    <!-- <div class="row mb-3">
                        <a href="\dashboard"> -->
                            <input type="button" value="بيانات النادي" onclick="location.href='dashboard';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\customer"> -->
                            <input type="button" value="سجل العملاء" onclick="location.href='customer';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\visit"> -->
                            <!-- <input type="button" value="اشتراكي الحالي" onclick="location.href='visit';" class="btn btn-success mb-3" > -->
                        <!-- </a>
                    </div> -->
                    <!-- {{ __('تم تسجيل الدخول!') }} -->
            </div>
        </div>
    </div>
</div>
@endsection