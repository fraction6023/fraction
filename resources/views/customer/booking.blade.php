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
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">اسم النادي</label>

                                        <div class="col-md-6">
                                            <input type="input" class="form-control" name="gym_id" value="{{ $gym->id }}">
                                        </div>
                                    </div>
                                    <input type="submit" value="احجز" class="btn btn-primary">
                            </form>
                        @endforeach
                    @endif                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


