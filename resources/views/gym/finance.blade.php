@extends('layouts.app')

@section('content')

@php
$amountNotCollected = 0;
$amountCollected = 0;
@endphp
<div class="card center" style="margin-bottom: 5px;">
    <div class="card-body">
        <table style="width: 100%;">
        <tr class="" style="font-weight:bold">
            <td style="width: 25%;" class=""><div class=""><p class="">اسم العميل</p></div></td>
            <td style="width: 25%;" class=""><div class=""><p class="">القيمة</p></div></td>
            <td style="width: 25%;" class=""><div class=""><p class="">تاريخ الزيارة</p></div></td>
            <td style="width: 25%;" class=""><div class=""><p class="">حالة الصرف</p></div></td>
        </tr>
@foreach($visits as $visit)

    <!-- <div class="card-header">اسم العميل: {{$visit->user->name}}</div> -->
    <!-- <div class="card-body">
        <table style="width: 100%;"> -->
            <tr style="width: 100%;" class="">
                <td style="width: 25%;" class=""><div class=""><p class="">{{$visit->user->name}}</p></div></td>
                <!-- <td class=""><div class=""><p class="">المبلغ</p></div></td> -->
                <td style="width: 25%;" class=""><div class=""><p class="">{{$visit->cost}}</p></div></td>
                <!-- <td class=""><div class=""><p class="">وقت الزيارة</p></div></td> -->
                <td style="width: 25%;" class=""><div class=""><p class="">{{$visit->updated_at}}</p></div></td>
                <!-- <td class=""><div class=""><p class="">الحالة</p></div></td> -->
                @if($visit->status =! 'collected')
                    <td style="width: 25%;" class=""><div class=""><p class="">تم التحصيل</p></div></td>
                    @php
                    $amountCollected = $amountCollected + $visit->cost;
                    @endphp
                @else
                    <td style="width: 25%;" class=""><div class=""><p class="">لم يتم التحصيل</p></div></td>
                    @php 
                        $amountNotCollected = $amountNotCollected + $visit->cost;
                    @endphp

                @endif
            </tr>
            <!-- @php $amount = $amountCollected + $visit->cost @endphp -->
    @endforeach
            <!-- <tr class="" style="border: 2px solid #3333;">
                <td style="width: 25%;" class=""><p class=""></p></td>
                <td style="width:50%;text-align: center; padding-left:15px;font-weight:bold"><p class="">المجموع</p></td>
                <td style="width:50%;text-align: center; padding-left:15px;font-weight:bold"><p class="">3</p></td>
                <td style="width: 25%;" class=""><p class=""></p></td>
            </tr> -->
        </table>
    </div>
</div>

<!-- <div class="card center">
    <table style="width: 100%;">
        <tr>
            <td style="width:50%;text-align: left; padding-left:15px;font-weight:bold">
                <div class="">
                    <p class="">المجموع </p>
                </div>
            </td>
            <td style="width: 50%; text-align:right;padding-right:15px">
                <div>
                    <p class="">{{$amountCollected}}</p>
                </div>
            </td>
        </tr>
    </table>
</div> -->

<div class="card center">
    <table style="width: 100%;">
        <tr>
            <td style="width:50%;text-align: left; padding-left:15px;font-weight:bold">
                <p class="">تم تحصيله </p>
            </td>
            <td style="width: 50%; text-align:right;padding-right:15px">
                <p class="">{{$amountCollected}}</p>
            </td>
        </tr>
    </table>
</div>
<div class="card center">
    <table style="width: 100%;">
        <tr>
            <td style="width:50%;text-align: left; padding-left:15px;font-weight:bold">
                <p class="">لم يتم تحصيله </p>
            </td>
            <td style="width: 50%; text-align:right;padding-right:15px">
                <p class="">{{$amountNotCollected}}</p>
            </td>
        </tr>
    </table>
</div>

@endsection