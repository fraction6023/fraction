@extends('layouts.app')

@section('content')
<div class="card center">
    <div class="card body">
        <x-paddle-button :checkout="$checkout" class="px-8 py-4">
            <p class="" style="font-weight:bold">شحن الرصيد</p>
        </x-paddle-button>
    </div>
</div>
@endsection
