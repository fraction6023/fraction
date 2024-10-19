@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ربط المستخدمين</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">ربط المستخدمين</div>
                        <div class="card-content">

                            <form action="{{ url('matchUserGym') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="user_id" >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                </select>
                                <select name="gym_id">
                                @foreach($gyms as $gym)
                                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                                @endforeach
                                </select>
                                <select name="user_kind">
                                    <option value="customer">customer</option>
                                    <option value="gym">gym</option>
                                </select>
                                <input type="submit" value="حفظ" class="btn btn-success">
                            </form>

                        </div>

                    </div>
                    

                 
                </div>
            </div>
        </div>
    </div>
</div>

    
@foreach($customers as $customer)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ url('matchUserGym') }}" method="POST">
            @csrf
            @method('PUT')
                <div class="card">
                    <div class="card-header">{{$customer->id}}</div>
                    <div class="card-body">
                        <select name="gym_id">
                            <option selected={{$customer->gym_id}}>{{$customer->gym_id}}</option>
                            @foreach($gyms as $gym)
                                <option value="{{$gym->id}}">{{$gym->name}}</option>
                            @endforeach
                        </select>
                        <select name="user_kind">
                            <option selected={{$customer->user_kind}}>{{$customer->user_kind}}</option>
                            <option value="customer">customer</option>
                            <option value="gym">gym</option>
                        </select>
                        <input type="hidden" name="user_id" id="user_id" value="{{$customer->id}}">
                        <input type="submit" value="حفظ" class="btn btn-success">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection


