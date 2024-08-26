@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">سجل الاشتراكات</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('bookGym') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="gymCardContainer">
                                <div class="gymCardRight">
                                    <div class="card-header" name="gym_name">{{ $visit->gym->name }}</div>

                                    <input type="hidden" class="form-control" name="gym_id" value="{{ $visit->gym->id }}">
                                    
                                    <label class="form-control" name="gym_comment">{{  $visit->gym->comment }}</label>
                                    <input type="hidden" class="form-control" name="gym_id" value="{{  $visit->gym->id }}">

                                    <label class="form-control" name="gym_id">اسمتع باستخدم جميع خدمات النادي فقط بـ <span style="font-weight:900;"> {{ $visit->gym->cpd }}</span> ريال</label>
                                    <?php
                                        if($visit->status == 'pending'){
                                            $statusMsg = 'تحت الدراسة';
                                            }elseif($visit->status == 'approved'){
                                                $statusMsg = 'معتمد';
                                            }
                                    ?>
                                    <label class="form-control_ {{ $visit->status }}" name="visit_status">{{ $statusMsg }}</label>
                                    <br>
                                    
                                    @if( $visit->gym->rate -1 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym->rate -2 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym->rate -3 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym->rate -4 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                    @if( $visit->gym->rate -5 >=0 ) <span class="fa fa-star checked"></span> @else <span class="fa fa-star"></span> @endif
                                                                        
                                
                                </div>
                                <div class="gymCardLeft">
                                    <img src="{{ $visit->gym->image }}" alt="" width="100%" height="">
                                </div>
                            </div>
                            <!-- <input type="submit" value="احجز" class="btn btn-primary"> -->
                        </div>
                    </form>
                    
                    <form action="visits" class="">
                        <div class="card">
                            <!-- <a href="\visits"> -->
                                <input type="submit" value="اشتراكاتي السابقة" class="btn btn-success" >
                            <!-- </a> -->
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


