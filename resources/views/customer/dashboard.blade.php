@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{ __('لوحة التحكم') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($customer)
                        <form action="{{ url('dashboardUpdate') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">الجنس</label>

                                <div class="col-md-6">
                                    <input type="input" class="form-control" name="gender" value="{{ $customer->gender }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-md-4 col-form-label text-md-end">الجوال</label>

                                <div class="col-md-6">
                                    <input type="input" class="form-control" name="mobile" value="{{ $customer->mobile }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-md-4 col-form-label text-md-end">المدينة</label>

                                <div class="col-md-6">
                                    <input type="input" class="form-control" name="city" value="{{ $customer->city }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">صورة العرض</label>

                                <div class="col-md-6">
                                    <input type="input" class="form-control" name="image" value="{{ $customer->image }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <input type="submit" value="حفظ" class="btn btn-primary">
                        </form>
                    @endif                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


