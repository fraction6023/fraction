@extends('layouts.app')

@section('content')

@foreach($customerFeedBack as $feedback)
<div style="width:50%;margin-right:25%;margin-bottom:5px" class="center">
    <div class="card center">
        <p class="">{{$feedback->gym->name}}</p>
        <div class="card-header ">
        @if( $feedback->customer_rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
        @if( $feedback->customer_rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
        @if( $feedback->customer_rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
        @if( $feedback->customer_rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
        @if( $feedback->customer_rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
        </div>
        
        <div class="card-body">
            <p class="">{{$feedback->customer_comment}}</p>
        </div>

    </div>
</div>
@endforeach

@endsection
