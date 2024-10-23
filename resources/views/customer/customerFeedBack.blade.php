@extends('layouts.app')

@section('content')

@foreach($customerFeedBack as $feedback)
<div class="card center">
    <div class="card-header ">***</div>
    <div class="card-body">
        <p class="">{{$feedback->customer_comment}}</p>
    </div>
</div>
@endforeach

@endsection
