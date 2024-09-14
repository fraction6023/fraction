@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">سجل الزيارات</div>

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
@endsection


