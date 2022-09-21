

@props(['disabled' => false, 'value'=>""])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'btn btn-primary']) !!}>{{$value}}</button>
