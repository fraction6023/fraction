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
                            <input type="button" value="الحجوزات" onclick="location.href='waitingOrders';" class="btn btn-success mb-3" >
                        <!-- </a> -->
                    
                    <!-- <div class="row mb-3">
                        <a href="\dashboard"> -->
                            <input type="button" value="ادارة النادي" onclick="location.href='dashboard';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\customer"> -->
                            <input type="button" value="تقييمات العملاء" onclick="location.href='gymFeedBack';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\customer"> -->
                        <input type="button" value="الإدارة المالية" onclick="location.href='finance';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\customer"> -->
                        <input type="button" value="مسح رمز الدخول QR" onclick="location.href='qrScanner';" class="btn btn-success mb-3" >
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
