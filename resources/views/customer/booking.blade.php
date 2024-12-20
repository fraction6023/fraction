@extends('layouts.app')

@section('content')


<div class="card">
<div class="container_ centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header ">حجز تمرين اليوم</div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($gyms)
                        <p>رصيدك الحالي {{$fund->funds}} ريال</p>
                        
                        @php
                        $i = 0;
                        $j = 0;
                        $rating_count=0;
                        
                        @endphp

                        @foreach($allVisits as $visit)
                            @if($visit->customer_rate)
                                @if($visit->user_id ==  Auth::user()->id )
                                    @php 
                                        $i = $i + $visit->customer_rate;
                                        $j++;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                    
                        @if($i >0 )
                            
                            @php
                            $rating_count = $j;
                            $j=($i / $j)
                            @endphp
                        <p class="">عدد مرات التقييم {{$rating_count}}</p>
                        <div class="">
                            <p class="">تقييم العميل </p>
                            @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                        </div>
                        
                        @endif
                    @endif
</div>
<div class="card">
    <div class="card-body" style="background-color: #6ac8;padding:20px" onclick="location.href='showGymsOnMap';">
        <p class="">استعراض الأندية على الخريطة</p>
    </div>
</div>


    <div class="card-body_ scroll-container_ scrollingDiv__">
                @if($gyms)
                    @foreach($gyms as $gym)
                            <!-- <form action="{{ url('bookGym') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card2">
                                    <input type="hidden" class="form-control" name="gym_id" value="{{ $gym->id }}">
                                    <input type="hidden" class="form-control" name="cpd" value="{{ $gym->cpd }}">
                                        <div class="gymCardContainer4">
                                            <div class="gymCardTop">
                                                <div class="card-header" name="gym_name">{{ $gym->name }}</div>
                                                <img src="{{ url('storage/images/'.$gym->image) }}" alt="" width="100%" height="">
                                            </div>
                                            <div class="gymCardBelow">
                                                
                                            <p class="">تكلفة الحجز اليومي: <span style="font-weight: bold; color: #69a;">{{$gym->cpd}}</span> ريال</p>
                                            <p class="">{{$gym->comment}}</p>
                                            </div>


                                            @php 
                                                $rating_count = 0;
                                                $i=0;
                                                $j=0; 
                                            @endphp

                                            @foreach($allVisits as $visit)
                                               

                                                @if($visit->gym_rate)
                                                    @if($visit->gym_id == $gym->id)
                                                        @php

                                                            $i = $i + $visit->gym_rate;
                                                            $j++;

                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            
                                            @if($i > 0 )

                                            @php 
                                            
                                                $rating_count = $j;
                                                $j=($i / $j) 
                                            @endphp
                                            <p class="">عدد مرات التقييم {{$rating_count}}</p>
                                        <div class="">
                                            @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            </div>
                                            @endif
                                            
                                            <input style="margin-bottom: 10px; width:100%" type="button" onclick="location.href='{{$gym->location}}';" value="موقع النادي " class="btn btn-success">
                                            <br>
                                            
                                    @if(count($visits) > 0)
                                        @if($visits[0]->status == 'pending')
                                        <input style="margin-bottom: 10px; width:100%" type="button" onclick="location.href='visit';" value="لديك حجز نشط حالياً" class="btn btn-primary">
                                        @elseif($fund->funds - $gym->cpd >= 0 )
                                            <input style="margin-bottom: 10px; width:100%" type="submit" value="احجز" class="btn btn-primary">
                                        @elseif($fund->funds - $gym->cpd < 0 )
                                            <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                        @endif
                                    @endif

                                    @if(count($visits) == 0)
                                        @if($fund->funds - $gym->cpd >= 0 )
                                            <input type="submit" value="احجز" class="btn btn-primary">
                                        @elseif($fund->funds - $gym->cpd < 0 )
                                            <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                        @endif
                                    @endif   
                                        </div>     
                                                                
                                </div>
                            
                            </form> -->
                        <div class="center" style="margin: 13px;">
                        <form action="{{ url('bookGym') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" class="form-control" name="gym_id" value="{{ $gym->id }}">
                            <input type="hidden" class="form-control" name="cpd" value="{{ $gym->cpd }}">
                            <div class="card2">
                                <img src="https://via.placeholder.com/350x200" alt="User Experience Image">
                                <h2> {{$gym->name}} </h2>
                                <p class="title"> تكلفة الحجز اليومي {{$gym->cpd}} ريال </p>
                                <p> {{$gym->comment}} </p>


                                @php 
                                    $rating_count = 0;
                                    $i=0;
                                    $j=0; 
                                @endphp

                                @foreach($allVisits as $visit)
                                    

                                    @if($visit->gym_rate)
                                        @if($visit->gym_id == $gym->id)
                                            @php

                                                $i = $i + $visit->gym_rate;
                                                $j++;

                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                                
                                @if($i > 0 )

                                @php 
                                
                                    $rating_count = $j;
                                    $j=($i / $j) 
                                @endphp
                                <p class="">عدد مرات التقييم {{$rating_count}}</p>
                            <div class="">
                                @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                </div>
                                @endif
                                <input style="margin-bottom: 10px; width:100%" type="button" onclick="location.href='{{$gym->location}}';" value="موقع النادي " class="btn btn-success">
                                <br>
                                                                    
                                @if(count($visits) > 0)
                                    @if($visits[0]->status == 'pending')
                                    <input style="margin-bottom: 10px; width:100%" type="button" onclick="location.href='visit';" value="لديك حجز نشط حالياً" class="btn btn-primary">
                                    @elseif($fund->funds - $gym->cpd >= 0 )
                                        <input style="margin-bottom: 10px; width:100%" type="submit" value="احجز" class="btn btn-primary">
                                    @elseif($fund->funds - $gym->cpd < 0 )
                                        <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                    @endif
                                @endif

                                @if(count($visits) == 0)
                                    @if($fund->funds - $gym->cpd >= 0 )
                                        <input type="submit" value="احجز" class="btn btn-primary">
                                    @elseif($fund->funds - $gym->cpd < 0 )
                                        <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                    @endif
                                @endif   
                            </div>
                        </form>
                    </div>
                    
                    @endforeach

                @endif
            </div>
        </div>
    </div>
</div>
</div>
<br>
<!-- @if($gyms)
    @foreach($gyms as $gym)
    <form action="{{ url('bookGym') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" class="form-control" name="gym_id" value="{{ $gym->id }}">
        <input type="hidden" class="form-control" name="cpd" value="{{ $gym->cpd }}">
        <div class="card2">
            <img src="https://via.placeholder.com/350x200" alt="User Experience Image">
            <h2> {{$gym->name}} </h2>
            <p class="title"> تكلفة الحجز اليومي {{$gym->cpd}} ريال </p>
            <p> {{$gym->comment}} </p>


            @php 
                $rating_count = 0;
                $i=0;
                $j=0; 
            @endphp

            @foreach($allVisits as $visit)
                

                @if($visit->gym_rate)
                    @if($visit->gym_id == $gym->id)
                        @php

                            $i = $i + $visit->gym_rate;
                            $j++;

                        @endphp
                    @endif
                @endif
            @endforeach
            
            @if($i > 0 )

            @php 
            
                $rating_count = $j;
                $j=($i / $j) 
            @endphp
            <p class="">عدد مرات التقييم {{$rating_count}}</p>
        <div class="">
            @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
            @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
            @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
            @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
            @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
            </div>
            @endif
            <input style="margin-bottom: 10px; width:100%" type="button" onclick="location.href='{{$gym->location}}';" value="موقع النادي " class="btn btn-success">
            <br>
                                                
            @if(count($visits) > 0)
                @if($visits[0]->status == 'pending')
                <input style="margin-bottom: 10px; width:100%" type="button" onclick="location.href='visit';" value="لديك حجز نشط حالياً" class="btn btn-primary">
                @elseif($fund->funds - $gym->cpd >= 0 )
                    <input style="margin-bottom: 10px; width:100%" type="submit" value="احجز" class="btn btn-primary">
                @elseif($fund->funds - $gym->cpd < 0 )
                    <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                @endif
            @endif

            @if(count($visits) == 0)
                @if($fund->funds - $gym->cpd >= 0 )
                    <input type="submit" value="احجز" class="btn btn-primary">
                @elseif($fund->funds - $gym->cpd < 0 )
                    <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                @endif
            @endif   
        </div>
    </form>
    @endforeach
@endif -->
<!-- 
<div class="card">
    <img src="https://via.placeholder.com/350x200" alt="User Experience Image">
    <h2> $experience->user_name </h2>
    <p class="title"> $experience->title </p>
    <p> $experience->description </p>
</div>


 -->




<!-- <div class="container centerText">
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
                    <p>رصيدك الحالي {{$fund->funds}} ريال</p>
                    @php
                    $i = 0;
                    $j = 0;
                    @endphp

                    @foreach($allVisits as $visit)
                        @if($visit->customer_rate)
                            @if($visit->user_id ==  Auth::user()->id )
                                @php 
                                    $i = $i + $visit->customer_rate;
                                    $j++;
                                @endphp
                            @endif
                        @endif
                    @endforeach
                    
                    @if($i >0 ) -->
                    <!-- <p>
                    @php
                    ($i / $j) 
                    @endphp
                    </p> -->
<!-- 
                    @php
                    $j=($i / $j)
                    @endphp
                    
                    @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                    @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                    @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                    @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                    @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif

                    @endif








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
                                            <input type="hidden" class="form-control" name="cpd" value="{{ $gym->cpd }}">

                                            <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $gym->cpd }}</span> ريال</label> -->
                                            <!-- <label class="form-control" name="gym_id">{{ $gym->rate }}</label> -->
                                            <!-- @php
                                            $i = 0;
                                            $j = 0;
                                            $allComments=array();

                                          


                                            @endphp 
                                            @foreach($allVisits as $visit)
                                                @if($visit->gym_rate)
                                                    @if($visit->gym_id == $gym->id)
                                                        @php
                                                            $allComments[] = $visit->gym_comment;
                                                            $i = $i + $visit->gym_rate;
                                                            $j++;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            
                                            @if($i >0 )

                                            @php 
                                                $rating_count = $j;
                                                $j=($i / $j) 
                                            @endphp
                                           <p class="">عدد مرات التقييم {{$rating_count}}</p>
                                           <p>
                                           @for($commentsCounter=0 ; $commentsCounter <= $rating_count-1 ; $commentsCounter = $commentsCounter + 1)
                                           <span class="comment_container">{{$allComments[$commentsCounter]}}</span>
                                           @endfor
                                            </p>
                                            @if( $j -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $j -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif

                                            @endif
                                        
                                        </div>
                                        <div class="gymCardLeft">
                                            <img src="{{ url('storage/images/'.$gym->image) }}" alt="" width="100%" height="">
                                        </div>
                                    </div>
                                    @if(count($visits) > 0)
                                        @if($visits[0]->status == 'pending')
                                        <input type="button" onclick="location.href='visit';" value="لديك حجز نشط حالياً" class="btn btn-primary">
                                        @elseif($fund->funds - $gym->cpd >= 0 )
                                            <input type="submit" value="احجز" class="btn btn-primary">
                                        @elseif($fund->funds - $gym->cpd < 0 )
                                            <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                        @endif
                                    @endif

                                    @if(count($visits) == 0)
                                        @if($fund->funds - $gym->cpd >= 0 )
                                            <input type="submit" value="احجز" class="btn btn-primary">
                                        @elseif($fund->funds - $gym->cpd < 0 )
                                            <input type="button" onclick="location.href='customer';" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                        @endif
                                    @endif

                                </div>
                            </form> -->
                            <!-- <form action="" class="">
                                @if($fund->funds - $gym->cpd < 0)
                                    <input type="submit" value="اشحن رصيدك لتتمكن من الحجز" class="btn btn-primary">
                                @endif
                                </div>
                            </form> -->
                          <!--  <br>
                         @endforeach
                    @endif                
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection


