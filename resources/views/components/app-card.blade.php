@props([
    'type' => 'booked' ,
    'doc' => "",
    'reason' => '',
    'time' => ''
])

@php
    $card = '';
    switch ($type) {
        case 'booked':
            $card = "card-tale";
            break;
        case 'confirmed':
            $card = 'card-dark-blue';
            break;
        default:
            $card = "card-tale";
            break;
    }
@endphp

<div class="col-md-3 mb-4 stretch-card transparent">
    <div class="row">
    <div class="card {{$card}}">
        <div class="card-body">
        <p class="mb-4">
            <span style="font-size: 11px;">Today's Booking for</span>
            <span style="font-size: 16px;">{{$reason}}</span>
        </p>
        <p class="fs-30 mb-2">Dr. {{$doc}}</p>
        <p> {{$time}} </p>
        </div>
    </div>
      </div>
  </div>