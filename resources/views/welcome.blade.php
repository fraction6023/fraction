@extends('layouts.app')

@section('content')
<div class="container_ centerText_">
    <div class="row justify-content-center">
        <div class="col-md-8_">
            <div class="card_">
                <div class="card-body_">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- <p class="">مرحبا بكم في {{ config('app.name', 'Laravel') }}</p>
                    <br> -->
                    <section class="hero-section mt-4_ container_ center">                    
                        <input class="btn nice-btn btn-success_ mb-3_" style="width: 90%;" type="button" value="تسجيل دخول" onclick="location.href='login';">
                        <br>
                        <input class="btn nice-btn btn-success_ mb-3_" style="width: 90%;" type="button" value="تسجيل جديد" onclick="location.href='register';" >
                        <br>
                        <input class="btn nice-btn btn-success_ mb-3_" style="width: 90%;" type="button" value="طلب انضمام نادي" onclick="location.href='gymregister';">
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
