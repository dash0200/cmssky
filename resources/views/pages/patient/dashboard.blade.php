<x-app-layout title="Dashboard">
@if($appointment !== null)
  <x-app-card 
    type="{{$appointment->status}}" doc="{{$appointment->doctor}}" reason="{{$appointment->reason}}"
    time="Timing Chosen : {{$appointment->cnf_time == null ? $appointment->time_slot : $appointment->cnf_time}}"
  />
@endif

 </x-app-layout>