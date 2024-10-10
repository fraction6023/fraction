@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('تسجيل نادي جديد') }}</div>

                <div class="card-body">
                    <form action="{{ url('insertGMY') }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        
                        <div class="row mb-3">
                            <label for="gymName" class="col-md-4 col-form-label text-md-end">{{ __('اسم النادي') }}</label>

                            <div class="col-md-6">
                                <input id="gymName" type="text" class="form-control @error('gymName') is-invalid @enderror" name="gymName" value="{{ old('gymName') }}" required autocomplete="gymName">

                                @error('gymName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('جوال النادي') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cpd" class="col-md-4 col-form-label text-md-end">{{ __('قيمة الحجز اليومي') }}</label>

                            <div class="col-md-6">
                                <input id="cpd" type="text" class="form-control @error('cpd') is-invalid @enderror" name="cpd" value="{{ old('cpd') }}" required autocomplete="cpd">

                                @error('cpd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('صورة العرض') }}</label>

                            <div class="col-md-6">
                                
                                <input type="file" id="image" name="image" accept="image/*"class="form-control @error('image') is-invalid @enderror" required >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('الفئة') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="class" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required autocomplete="class">

                                @error('class')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('حالة النادي') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status">

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <label for="capacity" class="col-md-4 col-form-label text-md-end">{{ __(' سعة النادي في الساعة') }}</label>

                            <div class="col-md-6">
                                <input id="capacity" type="capacity" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" required autocomplete="capacity">

                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('موقع النادي') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="location" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location">

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <label for="cpd" class="col-md-4 col-form-label text-md-end">{{ __('قيمة الاشتراك في اليوم ') }}</label>

                            <div class="col-md-6">
                                <input id="cpd" type="cpd" class="form-control @error('cpd') is-invalid @enderror" name="cpd" value="{{ old('cpd') }}" required autocomplete="cpd">

                                @error('cpd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="row mb-3">
                            <label for="cpw" class="col-md-4 col-form-label text-md-end">{{ __('قيمة الاشتراك في الأسبوع') }}</label>

                            <div class="col-md-6">
                                <input id="cpw" type="cpw" class="form-control @error('cpw') is-invalid @enderror" name="cpw" value="{{ old('cpw') }}" required autocomplete="cpw">

                                @error('cpw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="row mb-3">
                            <label for="cpm" class="col-md-4 col-form-label text-md-end">{{ __('قيمة الاشتراك في الشهر') }}</label>

                            <div class="col-md-6">
                                <input id="cpm" type="cpm" class="form-control @error('cpm') is-invalid @enderror" name="cpm" value="{{ old('cpm') }}" required autocomplete="cpm">

                                @error('cpm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="row mb-3">
                            <label for="cpy" class="col-md-4 col-form-label text-md-end">{{ __('قيمة الاشتراك في السنة') }}</label>

                            <div class="col-md-6">
                                <input id="rate" type="rate" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate') }}" required autocomplete="rate">

                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="row mb-3">
                            <label for="rate" class="col-md-4 col-form-label text-md-end">{{ __('التقييم العام للنادي') }}</label>

                            <div class="col-md-6">
                                <input id="rate" type="rate" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate') }}" required autocomplete="rate">

                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('معلومات عن النادي') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment"></textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تسجيل') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
