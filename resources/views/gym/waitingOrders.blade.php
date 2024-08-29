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
                    @if( $visit->status == 'approved')
                    <form action="{{ url('feedbackfinish') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <div class="gymCardRight">
                                    <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>

                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                    <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                    <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                    <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                    <?php
                                        if($visit->status == 'pending'){
                                            $statusMsg = 'تحت الدراسة';
                                            $string = '';
                                        }elseif($visit->status == 'approved'){
                                            $statusMsg = 'معتمد';
                                        }elseif($visit->status == 'canceled'){
                                            $statusMsg = 'ملغى';
                                        }elseif($visit->status == 'visited'){
                                            $statusMsg = 'تمت الدخول';
                                        }elseif($visit->status == 'finish'){
                                            $statusMsg = 'تم';
                                        }else{
                                            $statusMsg = '';
                                            $string = '';
                                        }

                                            
                                    ?>

                                    <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                    <br>
                                    <!-- <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label> -->
                                    
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;"> قيم زيارتك</label>
                                    <input type="text" name="rate" >
                                    @endif
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;">اترك تعليق </label>
                                    <input type="textarea" name="comment"/>
                                    @endif
                                    <br>
                                    @if( $visit->status == 'finish')
                                    @if( $visit->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    <label style="padding-left: 10px;"> {{ $visit->comment }}</label>
                                    @endif
                                </div>
                                <div class="gymCardLeft">
                                    <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                </div>
                            </div>
                            <!-- <input type="submit" value="حفظ" class="btn btn-primary"> -->
                                
                              
                        </div>
                    </form>
                    @elseif( $visit->status == 'visited' ||  $visit->status == 'finish_customer' )
                    <form action="{{ url('gymfeedbackVisit') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <div class="gymCardRight">
                                    <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>

                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                    <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                    <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                    <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                    <?php
                                        if($visit->status == 'pending'){
                                            $statusMsg = 'تحت الدراسة';
                                            $string = '';
                                        }elseif($visit->status == 'approved'){
                                            $statusMsg = 'معتمد';
                                        }elseif($visit->status == 'canceled'){
                                            $statusMsg = 'ملغى';
                                        }elseif($visit->status == 'visited'){
                                            $statusMsg = 'تمت الدخول';
                                        }elseif($visit->status == 'finish'){
                                            $statusMsg = 'تم';
                                        }else{
                                            $statusMsg = '';
                                            $string = '';
                                        }

                                            
                                    ?>

                                    <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                    <br>
                                    <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                    
                                    <br>
                                    @if( $visit->status == 'visited' ||  $visit->status == 'finish_customer' )
                                    <label style="padding-left: 10px;"> قيم العمبل</label>
                                    <input type="text" name="rate" >
                                    @endif
                                    <br>
                                    @if( $visit->status == 'visited' ||  $visit->status == 'finish_customer' )
                                    <label style="padding-left: 10px;">ملاحظات على العميل</label>
                                    <input type="textarea" name="comment"/>
                                    @endif
                                    <br>
                                    @if( $visit->status == 'finish')
                                    @if( $visit->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    <label style="padding-left: 10px;"> {{ $visit->comment }}</label>
                                    @endif
                                </div>
                                <div class="gymCardLeft">
                                    <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                </div>
                            </div>
                                
                                <input type="submit" value="حفظ" class="btn btn-primary">
                                
                              
                        </div>
                    </form>
                    
                    @elseif( $visit->status == 'pending')
                    <form action="{{ url('approveVisit') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <div class="gymCardRight">
                                    <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>
                            
                                    {{$i = 0;}}
                                    {{$j = 0;}}

                                    @foreach($visitsStar as $visitRate)
                                        @if($visitRate->customer_rate)
                                            @if($visit->user_id ==  $visitRate->user_id )
                                                {{$i = $i + $visitRate->customer_rate}}
                                                {{$j++;}}
                                                <h1 class="">{{$i}}</h1>
                                            @endif
                                        @endif
                                    @endforeach
                                    
                                    @if($i >0 )
                                    <p>{{($i / $j) }}</p>
                                    {{$j=($i / $j) }}
                                    
                                    @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    
                                    @endif



                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                    <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                    <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                    <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                    <?php
                                        if($visit->status == 'pending'){
                                            $statusMsg = 'تحت الدراسة';
                                            $string = '';
                                        }elseif($visit->status == 'approved'){
                                            $statusMsg = 'معتمد';
                                        }elseif($visit->status == 'canceled'){
                                            $statusMsg = 'ملغى';
                                        }elseif($visit->status == 'visited'){
                                            $statusMsg = 'تمت الدخول';
                                        }elseif($visit->status == 'finish'){
                                            $statusMsg = 'تم';
                                        }else{
                                            $statusMsg = '';
                                            $string = '';
                                        }

                                            
                                    ?>

                                    <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                    <br>
                                    <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                    
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;"> قيم زيارتك</label>
                                    <input type="text" name="rate" >
                                    @endif
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;">اترك تعليق </label>
                                    <input type="textarea" name="comment"/>
                                    @endif
                                    <br>
                                    @if( $visit->status == 'finish')
                                    @if( $visit->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    <label style="padding-left: 10px;"> {{ $visit->comment }}</label>
                                    @endif
                                </div>
                                <div class="gymCardLeft">
                                    <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                </div>
                            </div>
                            <input type="submit" value="قبول" class="btn btn-warning">
                                
                        </div>
                    </form>
                    @else
                    <form action="{{ url('approveVisit') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <div class="gymCardRight">
                                    <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>

                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                    <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                    <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                    <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                    <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                    <?php
                                        if($visit->status == 'pending'){
                                            $statusMsg = 'تحت الدراسة';
                                            $string = '';
                                        }elseif($visit->status == 'approved'){
                                            $statusMsg = 'معتمد';
                                        }elseif($visit->status == 'canceled'){
                                            $statusMsg = 'ملغى';
                                        }elseif($visit->status == 'visited'){
                                            $statusMsg = 'تمت الدخول';
                                        }elseif($visit->status == 'finish'){
                                            $statusMsg = 'تم';
                                        }else{
                                            $statusMsg = '';
                                            $string = '';
                                        }

                                            
                                    ?>

                                    <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                    <br>
                                    <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                    
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;"> قيم زيارتك</label>
                                    <input type="text" name="rate" >
                                    @endif
                                    <br>
                                    @if( $visit->status == 'visited')
                                    <label style="padding-left: 10px;">اترك تعليق </label>
                                    <input type="textarea" name="comment"/>
                                    @endif
                                    <br>
                                    @if( $visit->status == 'finish')
                                    @if( $visit->gym_rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym_rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym_rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym_rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym_rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    <label style="padding-left: 10px;"> {{ $visit->gym_comment }}</label>
                                    @endif
                                </div>
                                <div class="gymCardLeft">
                                    <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                </div>
                            </div>
                                
                        </div>
                    </form>
                    @endif
                    <br>


                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


