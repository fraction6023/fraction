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
                            <input type="button" value="حجز تمرين اليوم" onclick="location.href='booking';" class="btn btn-success mb-3" >
                        <!-- </a> -->
                    
                    <!-- <div class="row mb-3">
                        <a href="\dashboard"> -->
                            <input type="button" value="استعراض بياناتي" onclick="location.href='dashboard';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\customer"> -->
                            <input type="button" value="استعراض اشتراكي" onclick="location.href='customer';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- <div class="row mb-3">
                        <a href="\visit"> -->
                            <input type="button" value="اشتراكي الحالي" onclick="location.href='visit';" class="btn btn-success mb-3" >
                        <!-- </a>
                    </div> -->
                    <!-- {{ __('تم تسجيل الدخول!') }} -->
            </div>
        </div>
    </div>
</div>
<!-- <div class="card"> -->
    <!-- <div class="card-header">
        <p class="">header</p>
    </div> -->
    <!-- <div class="card-body">
        <p class="">body</p>
        
        <div class="scroll-container">

            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div>
            <div><p class="">Ok..</p></div> -->
            <!-- <img src="https://www.w3schools.com/howto/img_5terre.jpg" alt="Cinque Terre" width="600" height="400">
            <img src="https://www.w3schools.com/howto/img_5terre.jpg" alt="Forest" width="600" height="400">
            <img src="https://www.w3schools.com/howto/img_5terre.jpg" alt="Northern Lights" width="600" height="400">
            <img src="https://www.w3schools.com/howto/img_5terre.jpg" alt="Mountains" width="600" height="400"> -->
        <!-- </div>
    </div> -->

    <!-- </div> -->
<!-- </div> -->
@endsection
