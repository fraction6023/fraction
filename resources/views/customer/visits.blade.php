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
                    
                    @if($visits)
                    @foreach($visits as $visit)
                    
                    <form action="{{ url('bookGym') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <div class="gymCardRight">
                                    <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>

                                    <input type="hidden" class="form-control" name="gym_id" value="{{ $visit->gym->id }}">
                                    
                                    <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                    <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                    <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->
                                    
                                    <?php
                                        if($visit->status == 'pending'){
                                            $statusMsg = 'تحت الدراسة';
                                            $string = '';
                                        }elseif($visit->status == 'approved'){
                                            $statusMsg = 'معتمد';

                                            // Available alpha caracters
                                            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                                            // generate a pin based on 2 * 7 digits + a random character
                                            $pin = mt_rand(1000000, 9999999)
                                                . mt_rand(1000000, 9999999)
                                                . $characters[rand(0, strlen($characters) - 1)];

                                            // shuffle the result
                                            $string = str_shuffle($pin);

                                        }else{
                                            $statusMsg = '';
                                            $string = '';
                                        }
                                    ?>

                                    <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                    <br>
                                    <label class="form-control_ " name="visit_status">{{ $string }}</label>
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;"> قيم زيارتك</label>
                                        @if( $visit->gym->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                        @if( $visit->gym->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                        @if( $visit->gym->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                        @if( $visit->gym->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                        @if( $visit->gym->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @endif
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;">اترك تعليق </label>
                                    <input type="text" name="visitComment"/>
                                    @endif
                                    <br>
                                    
                                </div>
                                <div class="gymCardLeft">
                                    <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                </div>
                            </div>
                            @if( $visit->status == 'visited')
                                    <input type="submit" value="حفظ" class="btn btn-primary">
                                    @endif
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


