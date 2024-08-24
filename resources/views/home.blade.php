@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('لوحة التحكم') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- <div class="testRed">TESTING...H2</div> -->
                    <div class="row mb-3">
                        <a href="\booking">
                            <input type="button" value="حجز تمرين اليوم" class="btn btn-success" >
                        </a>
                    </div>
                    <div class="row mb-3">
                        <a href="\dashboard">
                            <input type="button" value="استعراض بياناتي" class="btn btn-success" >
                        </a>
                    </div>
                    <div class="row mb-3">
                        <a href="\customer">
                            <input type="button" value="استعراض اشتراكي" class="btn btn-success" >
                        </a>
                    </div>
                    <div class="row mb-3">
                        <a href="\visits">
                            <input type="button" value="اشتراكاتي السابقة" class="btn btn-success" >
                        </a>
                    </div>
                    <!-- {{ __('تم تسجيل الدخول!') }} -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
