@extends('layouts.app')

@section('content')

@php
$amount = 0;
@endphp
<div class="card center" style="margin-bottom: 5px;">
    <div class="card-body">
        <table style="width: 100%;">
        <tr class="" style="font-weight:bold">
            <td class=""><div class=""><p class="">اسم العميل</p></div></td>
            <td class=""><div class=""><p class="">القيمة</p></div></td>
            <td class=""><div class=""><p class="">تاريخ الزيارة</p></div></td>
            <td class=""><div class=""><p class="">حالة الصرف</p></div></td>
        </tr>
@foreach($visits as $visit)

    <!-- <div class="card-header">اسم العميل: {{$visit->user->name}}</div> -->
    <!-- <div class="card-body">
        <table style="width: 100%;"> -->
            <tr class="">
                <td class=""><div class=""><p class="">{{$visit->user->name}}</p></div></td>
                <!-- <td class=""><div class=""><p class="">المبلغ</p></div></td> -->
                <td class=""><div class=""><p class="">{{$visit->cost}}</p></div></td>
                <!-- <td class=""><div class=""><p class="">وقت الزيارة</p></div></td> -->
                <td class=""><div class=""><p class="">{{$visit->updated_at}}</p></div></td>
                <!-- <td class=""><div class=""><p class="">الحالة</p></div></td> -->
                <td class=""><div class=""><p class="">لم يتم التحصيل</p></div></td>
            </tr>
            @php $amount = $amount + $visit->cost @endphp
    @endforeach
        </table>
    </div>
</div>

<div class="card center">
    <table style="width: 100%;">
        <tr>
            <td style="width:50%;text-align: left; padding-left:15px;font-weight:bold">
                <div class="">
                    <p class="">المجموع </p>
                </div>
            </td>
            <td style="width: 50%; text-align:right;padding-right:15px">
                <div>
                    <p class="">{{$amount}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection