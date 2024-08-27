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
                    @endif
                    <form action="visits" class="">
                        <div class="card">
                            <input type="submit" value="اشتراكاتي السابقة" class="btn btn-success" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


