@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body_">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="">مرحبا بكم في {{ config('app.name', 'Laravel') }}</p>
                    <br>
                    <input type="button" value="تسجيل دخول" onclick="location.href='login';" class="btn btn-success mb-3" style="width: 100%;">
                    <br>
                    <input type="button" value="تسجيل جديد" onclick="location.href='register';" class="btn btn-success mb-3" style="width: 100%;">
                    <br>
                    <input type="button" value="طلب انضمام نادي" onclick="location.href='gymregister';" class="btn btn-success mb-3"  style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
