@extends('layouts.app')

@section('content')

@foreach($gymFeedBack as $feedback)
<div class="card center">
    <div class="card-header ">***</div>
    <div class="card-body">
        <p class="">{{$feedback->gym_comment}}</p>
    </div>
</div>
@endforeach

@endsection
