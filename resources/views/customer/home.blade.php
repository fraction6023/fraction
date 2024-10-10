@extends('layouts.app')

@section('content')

<div class="card_">
    <div class="card-body current-booked-gym_"> 
        @if(count($visit))

        <form action="{{ url('bookGym') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="gymCardContainer3">
                    <div class="gymCardTop">
                        <div class="card-header" name="gym_name">{{ $visit[0]->gym->name }}</div>
                        <img src="{{ url('storage/images/'.$visit[0]->gym->image) }}" class="gymImage">
                    </div>
                    <div class="gymCardBelow">
                        <input type="hidden" class="form-control" name="visit_id" value="{{ $visit[0]->gym->id }}">
                        <input type="hidden" class="form-control" name="visit_id" value="{{ $visit[0]->id }}">

                        <!-- <label class="form-control" name="gym_comment">{{  $visit[0]->gym->comment }}</label> -->
                        <input type="hidden" class="form-control" name="gym_id" value="{{  $visit[0]->gym->id }}">

                        <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit[0]->gym->cpd }}</span> ريال</label> -->

                        <label class="form-control_ {{ $visit[0]->status_ }}" name="orderId">رقم الطلب: {{ $visit[0]->id }}</label>
                        <br>
                        <label class="form-control_ " name="visit_status">{{ $visit[0]->approveCode }}</label>
                        
                        <br>
                        @if( $visit[0]->status == 'visited' || $visit[0]->status == 'finish_gym')
                        <label style="padding-left: 10px;"> قيم زيارتك</label>
                        <div class="rating">
                        <!-- Notice that the stars are in reverse order -->

                        <input type="radio" id="star5" name="rate" value="5">
                        <label for="star5">&#9733;</label>
                        <input type="radio" id="star4" name="rate" value="4">
                        <label for="star4">&#9733;</label>
                        <input type="radio" id="star3" name="rate" value="3">
                        <label for="star3">&#9733;</label>
                        <input type="radio" id="star2" name="rate" value="2">
                        <label for="star2">&#9733;</label>
                        <input type="radio" id="star1" name="rate" value="1">
                        <label for="star1">&#9733;</label>
                        </div>
                        @endif
                        <br>
                        @if( $visit[0]->status == 'visited' || $visit[0]->status == 'finish_gym')
                        <label style="padding-left: 10px;">اترك تعليق </label>
                        <input type="textarea" name="comment"/>
                        @endif
                        <br>
             
                    </div>
                </form>
                    @if( $visit[0]->status == 'pending')
                        <form action="{{ url('cancelBookGym') }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="card">
                                <input type="submit" value="الغاء" class="btn btn-danger" >
                                <input type="hidden" class="form-control" name="visit_id" value="{{ $visit[0]->id }}">
                                <input type="hidden" class="form-control" name="visit_status" value="{{ $visit[0]->status }}">
                                <input type="hidden" class="form-control" name="visit_cost" value="{{ $visit[0]->cost }}">
                            </div>
                        </form>
                    @endif
                </div>
                
                
            </div>
         <!-- -->





            <!-- <form action="{{ url('bookGym') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="gymCardContainer">
                        <div class="gymCardTop">
                            <div class="card-header" name="gym_name">{{ $visit[0]->gym->name }}</div>
                            <input type="hidden" class="form-control" name="gym_id" value="{{ $visit[0]->gym->id }}">
                            <label class="form-control" name="gym_comment">{{  $visit[0]->gym->comment }}</label>
                            <input type="hidden" class="form-control" name="gym_id" value="{{  $visit[0]->gym->id }}">
                            <label class="form-control" name="gym_id">استمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit[0]->gym->cpd }}</span> ريال</label>
                            <?php
                                // if($visit[0]->status == 'pending'){
                                //     $statusMsg = 'تحت الدراسة';
                                //     }elseif($visit[0]->status == 'approved'){
                                //         $statusMsg = 'معتمد';
                                //     }elseif($visit[0]->status == 'canceled'){
                                //         $statusMsg = 'ملغى';
                                //     }else{
                                //         $statusMsg = '';
                                //         $string = '';
                                //     }
                            ?>
                            <label class="form-control_ {{ $visit[0]->status_ }}" name="orderId">رقم الطلب: {{ $visit[0]->id }}</label>
                            <br>
                            
                            <br> -->
                            <!-- <label class="form-control_ " name="visit_status">{{ $visit[0]->approveCode }}</label>
                            {!! QrCode::size(300)->generate('Embed this content into the QR Code') !!}
                            <br> -->
<!--                             
                            @if( $visit[0]->gym->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                            @if( $visit[0]->gym->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                                                
                        
                        </div>
                        <div class="gymCardBelow">
                            <img src="{{ url('storage/images/'.$visit[0]->gym->image) }}" alt="" width="100%" height="">
                            
                        </div>
                    </div> -->
                    <!-- <input type="submit" value="احجز" class="btn btn-primary"> -->
                <!-- </div>
            </form>
        
            @if( $visit[0]->status == 'pending')
                <form action="{{ url('cancelBookGym') }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="card">
                        <input type="submit" value="الغاء" class="btn btn-danger" >
                        <input type="hidden" class="form-control" name="visit_id" value="{{ $visit[0]->id }}">
                        <input type="hidden" class="form-control" name="visit_status" value="{{ $visit[0]->status }}">
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
        @endif -->
    </div>





<div class="card">
    <div class="card-body_ scroll-container_ scrollingDiv">
            

                @if($visits)
                    @foreach($visits as $visit)
                    <div class="scrollingItem">
                    <?php
                        if($visit->status == 'pending'){
                            $statusMsg = 'تحت الدراسة';
                            $string = '';
                        }elseif($visit->status == 'approved'){
                            $statusMsg = 'معتمد';
                        }elseif($visit->status == 'canceled'){
                            $statusMsg = 'ملغى';
                        }elseif($visit->status == 'visited'){
                            $statusMsg = 'تم الدخول';
                        }elseif($visit->status == 'finish_customer'){
                            $statusMsg = 'قام العميل بالتقييم';
                        }elseif($visit->status == 'finish_gym'){
                            $statusMsg = 'قام النادي بالتقييم';
                        }elseif($visit->status == 'finish'){
                            $statusMsg = 'تم';
                        }else{
                            $statusMsg = '';
                            $string = '';
                        }
                    ?>
                        @if( $visit->status == 'approved' )
                        <form action="{{ url('feedbackfinish') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="gymCardContainer2">
                                        <div class="gymCardTop">
                                            <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>
                                            <img src="{{ url('storage/images/'.$visit->gym->image) }}" alt="" width="100%" height="">
                                        </div>
                                        <div class="gymCardBelow">
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">
                                            <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">
                                       
                                            <label class="form-control_ {{ $visit->status_ }}" name="orderId">رقم الطلب: {{ $visit->id }}</label>
                                            <br>
                                            <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                            <br>
                                            <label class="form-control_ " name="visit_status">{!! QrCode::size(130)->generate($visit->approveCode) !!}</label>
                                            <br>
                                            <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                            
                                            
                                            <br>
                                            @if( $visit->status == 'visited')
                                            <label style="padding-left: 10px;"> قيم زيارتك</label>
                                            <div class="rating">
                                                <!-- Notice that the stars are in reverse order -->
                                                <input type="radio" id="star5" name="rate" value="5">
                                                <label for="star5">&#9733;</label>
                                                <input type="radio" id="star4" name="rate" value="4">
                                                <label for="star4">&#9733;</label>
                                                <input type="radio" id="star3" name="rate" value="3">
                                                <label for="star3">&#9733;</label>
                                                <input type="radio" id="star2" name="rate" value="2">
                                                <label for="star2">&#9733;</label>
                                                <input type="radio" id="star1" name="rate" value="1">
                                                <label for="star1">&#9733;</label>
                                            </div>
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
                                            <br>
                                            <label style="padding-left: 10px;"> {{ $visit->gym_comment }}</label>
                                            @endif
                                        <input style="width: 100%;margin-top:5px;" type="submit" value="تم الدخول" class="btn btn-primary">
                                        </div>
                                    </div>
                                        
                                        
                                        
                                    
                                </div>
                            </form>
                        @elseif( $visit->status == 'visited' || $visit->status == 'finish_gym') <!-- gym finish feedback -->
                            <form action="{{ url('feedbackVisit') }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="card">
                                    <div class="gymCardContainer2">
                                        <div class="gymCardTop">
                                            <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>
                                            <img src="{{ url('storage/images/'.$visit->gym->image) }}" alt="" width="100%" height="">
                                        </div>
                                        <div class="gymCardBelow">
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                            <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                            <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                            <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                            <label class="form-control_ {{ $visit->status_ }}" name="orderId">رقم الطلب: {{ $visit->id }}</label>
                                            <br>
                                            <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                            <br>
                                            <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                            
                                            <br>
                                            @if( $visit->status == 'visited' || $visit->status == 'finish_gym')
                                            <label style="padding-left: 10px;"> قيم زيارتك</label>
                                            <div class="rating">
                                            <!-- Notice that the stars are in reverse order -->

                                            <input type="radio" id="star5" name="rate" value="5">
                                            <label for="star5">&#9733;</label>
                                            <input type="radio" id="star4" name="rate" value="4">
                                            <label for="star4">&#9733;</label>
                                            <input type="radio" id="star3" name="rate" value="3">
                                            <label for="star3">&#9733;</label>
                                            <input type="radio" id="star2" name="rate" value="2">
                                            <label for="star2">&#9733;</label>
                                            <input type="radio" id="star1" name="rate" value="1">
                                            <label for="star1">&#9733;</label>
                                            </div>
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
                                            <br>
                                            <label style="padding-left: 10px;"> {{ $visit->gym_comment }}</label>
                                            @endif
                                        </div>
                                        <input style="width: 100%;margin-top:5px;" type="submit" value="حفظ" class="btn btn-primary">
                                    </div>
                                    
                                    
                                </div>
                            </form>
                        
                        
                        @elseif( $visit->status == 'pending')
                            <form action="{{ url('approveVisit') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="gymCardContainer2">
                                    <div class="gymCardTop">
                                        <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>
                                        <img src="{{ url('storage/images/'.$visit->gym->image) }}" alt="" width="100%" height="">
                                    </div>
                                    <div class="gymCardBelow">
                                        <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                        <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                        <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                        <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                        <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                                                
                                        <label class="form-control_ {{ $visit->status_ }}" name="orderId">رقم الطلب: {{ $visit->id }}</label>
                                        <br>
                                        <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                        <br>
                                        <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                        
                                        <br>
                                        @if( $visit->status == 'visited')
                                        <label style="padding-left: 10px;"> قيم زيارتك</label>
                                        <div class="rating">
                                            <!-- Notice that the stars are in reverse order -->

                                            <input type="radio" id="star5" name="rate" value="5">
                                            <label for="star5">&#9733;</label>
                                            <input type="radio" id="star4" name="rate" value="4">
                                            <label for="star4">&#9733;</label>
                                            <input type="radio" id="star3" name="rate" value="3">
                                            <label for="star3">&#9733;</label>
                                            <input type="radio" id="star2" name="rate" value="2">
                                            <label for="star2">&#9733;</label>
                                            <input type="radio" id="star1" name="rate" value="1">
                                            <label for="star1">&#9733;</label>
                                        </div>
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
                                        <br>
                                        <label style="padding-left: 10px;"> {{ $visit->gym_comment }}</label>
                                        @endif
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
                                    <div class="gymCardContainer2">
                                        <div class="gymCardTop">
                                            <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>
                                            <!-- <img src="{{ $visit->gym->image }}" alt="" width="100%" height=""> -->
                                            <img src="{{ url('storage/images/'.$visit->gym->image) }}" alt="" width="100%" height="">
                                        </div>
                                        <div class="gymCardBelow">

                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->gym->id }}">
                                            <input type="hidden" class="form-control" name="visit_id" value="{{ $visit->id }}">

                                            <!-- <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label> -->
                                            <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                            <!-- <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label> -->

                                            <label class="form-control_ {{ $visit->status_ }}" name="orderId">رقم الطلب: {{ $visit->id }}</label>
                                            <br>
                                            <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                            <br>
                                            <label class="form-control_ " name="visit_status">{{ $visit->approveCode }}</label>
                                            
                                            <br>
                                            @if( $visit->status == 'visited')
                                            <label style="padding-left: 10px;"> قيم زيارتك</label>
                                            <div class="rating">
                                                <!-- Notice that the stars are in reverse order -->
                                                <input type="radio" id="star5" name="rate" value="5">
                                                <label for="star5">&#9733;</label>
                                                <input type="radio" id="star4" name="rate" value="4">
                                                <label for="star4">&#9733;</label>
                                                <input type="radio" id="star3" name="rate" value="3">
                                                <label for="star3">&#9733;</label>
                                                <input type="radio" id="star2" name="rate" value="2">
                                                <label for="star2">&#9733;</label>
                                                <input type="radio" id="star1" name="rate" value="1">
                                                <label for="star1">&#9733;</label>
                                            </div>
                                            @endif
                                            <br>
                                            @if( $visit->status == 'visited')
                                            <label style="padding-left: 10px;">اترك تعليق </label>
                                            <input type="textarea" name="comment"/>
                                            @endif
                                            <br>
                                            @if( $visit->status == 'finish'|| $visit->status == 'finish_customer')
                                            @if( $visit->gym_rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $visit->gym_rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $visit->gym_rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $visit->gym_rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            @if( $visit->gym_rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                            <br>
                                            <label style="padding-left: 10px;"> {{ $visit->gym_comment }}</label>
                                            @endif
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
