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
                    
                    @if($visits)
                        @foreach($visits as $visit)
                        <div class="card">
                            <div class="card-body">
                                <h1>{{$visit->id}}</h1>
                                <h1>{{$visit->rate}}</h1>
                            </div>
                        </div>
                        @endforeach
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


