@extends('layouts.app')

@section('content')

@foreach($visits as $visit)
<div class="card center">
    <div class="card-header">{{$visit->cost}}</div>
</div>
@endforeach

@endsection