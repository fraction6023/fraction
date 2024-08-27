@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('اشتراكي') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($customer)
                        <label> الرصيد المتوفر: <span>{{$customer->funds}}</span> ريال</label>
                    @endif

                    <form action="{{ url('purchase') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <input type="text" class="form-control" name="funds">
                                <input type="submit" class="btn btn-success" name="" value="حفظ">
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


