@extends('layouts.app')

@section('content')

<div class="card_ center">

    <section class="hero-section mt-4_ container_ center">
        <h1>مرحباً بكم في {{ config('app.name', 'Laravel') }}</h1>
        <p>تجربة فريدة ومميزة تبدأ هنا.</p>
        <a href="welcome" class="btn">ابدأ الآن</a>
    </section>
    
</div>


@endsection
