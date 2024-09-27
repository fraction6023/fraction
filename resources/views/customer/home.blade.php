@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body current-booked-gym"> 
        @if(count($visit))
            <form action="{{ url('bookGym') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="gymCardContainer">
                        <div class="gymCardRight">
                            <div class="card-header" name="gym_name">{{ $visit[0]->gym->name }}</div>
                            <input type="hidden" class="form-control" name="gym_id" value="{{ $visit[0]->gym->id }}">
                            <label class="form-control" name="gym_comment">{{  $visit[0]->gym->comment }}</label>
                            <input type="hidden" class="form-control" name="gym_id" value="{{  $visit[0]->gym->id }}">
                            <label class="form-control" name="gym_id">استمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit[0]->gym->cpd }}</span> ريال</label>
                            <?php
                                if($visit[0]->status == 'pending'){
                                    $statusMsg = 'تحت الدراسة';
                                    }elseif($visit[0]->status == 'approved'){
                                        $statusMsg = 'معتمد';
                                    }elseif($visit[0]->status == 'canceled'){
                                        $statusMsg = 'ملغى';
                                    }else{
                                        $statusMsg = '';
                                        $string = '';
                                    }
                            ?>
                            <label class="form-control_ {{ $visit[0]->status }}" name="visit_status">{{ $statusMsg }}</label>
                            <br>
                            <label class="form-control_ " name="visit_status">{{ $visit[0]->approveCode }}</label>
                            <br>
                            
                            @if( $visit[0]->gym->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                                                
                        
                        </div>
                        <div class="gymCardLeft">
                            <img src="{{ $visit[0]->gym->image }}" alt="" width="100%" height="">
                        </div>
                    </div>
                    <!-- <input type="submit" value="احجز" class="btn btn-primary"> -->
                </div>
            </form>
        
            @if( $visit[0]->status == 'pending')
                <form action="{{ url('cancelBookGym') }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="card">
                        <input type="submit" value="الغاء" class="btn btn-danger" >
                        <input type="hidden" class="form-control" name="visit_id" value="{{ $visit[0]->id }}">
                        <input type="hidden" class="form-control" name="visit_cost" value="{{ $visit[0]->cost }}">
                    </div>
                </form>
            @endif
        
            @if($visits[0]->status != 'pending')
            <div class="card">
                <input type="button" value="حجز تمرين اليوم" onclick="location.href='booking';" class="btn btn-success mb-3" >
            </div>
            @endif
        @else
        <div class="card">
            <input type="button" value="حجز تمرين اليوم" onclick="location.href='booking';" class="btn btn-success mb-3" >
        </div>
        @endif
    </div>




<div class="card">
    <div class="card-body_ scroll-container_ scrollingDiv">
            <div class="">

                @if($visits)
                    @foreach($visits as $visit)
                    <div class="scrollingItem">
                        @if( $visit->status == 'approved' )
                        <form action="{{ url('feedbackfinish') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="gymCardContainer">
                                        <div class="gymCardRight">
                                            <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">
                                            <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">
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
                                        
                                        <input type="submit" value="تم الدخوول" class="btn btn-primary">
                                        
                                    
                                </div>
                            </form>
                        @elseif( $visit->status == 'visited' || $visit->status == 'finish_gym') <!-- gym finish feedback -->
                            <form action="{{ url('feedbackVisit') }}" method="POST">
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
                                            @if( $visit->status == 'visited' || $visit->status == 'finish_gym')
                                            <label style="padding-left: 10px;"> قيم زيارتك</label>
                                            <input type="text" name="rate" >
                                            @endif
                                            <br>
                                            @if( $visit->status == 'visited' || $visit->status == 'finish_gym')
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
                                <!-- <input type="submit" value="قبول" class="btn btn-warning"> -->
                                    
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
                                            <label style="padding-left: 10px;"> {{ $visit->comment }}</label>
                                            @endif
                                        </div>
                                        <div class="gymCardLeft">
                                            <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                        </div>
                                    </div>
                                        
                                </div>
                            </form>
                        @endif
                    </div>
                    @endforeach

                @endif
            </div>
        </div>
    </div>
</div>
<br>
<!-- <div class="card">
    <div class="card-header">test</div>
        <div class="scrollingDiv">
            <div class="scrollingItem">1</div>
            <div class="scrollingItem">2</div>
            <div class="scrollingItem">3</div>
            <div class="scrollingItem">4</div>    
            <div class="scrollingItem">1</div>
            <div class="scrollingItem">2</div>
            <div class="scrollingItem">3</div>
            <div class="scrollingItem">4</div>    
            <div class="scrollingItem">1</div>
            <div class="scrollingItem">2</div>
            <div class="scrollingItem">3</div>
            <div class="scrollingItem">4</div>    
            <div class="scrollingItem">1</div>
            <div class="scrollingItem">2</div>
            <div class="scrollingItem">3</div>
            <div class="scrollingItem">4</div>    
            <div class="scrollingItem">1</div>            
        </div>
    </div>
</div> -->
@endsection
