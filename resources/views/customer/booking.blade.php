@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">حجز تمرين اليوم</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($gyms)

                        @foreach($gyms as $gym)
                            <form action="{{ url('bookGym') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="gymCardContainer">
                                        <div class="gymCardRight">
                                            <div class="card-header" name="gym_name">{{ $gym->name }}</div>

                                            <input type="hidden" class="form-control" name="gym_id" value="{{ $gym->id }}">
                                            
                                            <label class="form-control" name="gym_id">{{ $gym->comment }}</label>
                                            <input type="hidden" class="form-control" name="gym_id" value="{{ $gym->id }}">

                                            <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $gym->cpd }}</span> ريال</label>
                                            <label class="form-control" name="gym_id">{{ $gym->rate }}</label>
                                            
                                            
                                            @if( $gym->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $gym->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $gym->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $gym->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $gym->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                                                                
                                        
                                        </div>
                                        <div class="gymCardLeft">
                                            <img src="{{ $gym->image }}" alt="" width="100%" height="">
                                        </div>
                                    </div>
                                    <input type="submit" value="احجز" class="btn btn-primary">
                                </div>
                            </form>
                            <br>
                        @endforeach
                    @endif                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


