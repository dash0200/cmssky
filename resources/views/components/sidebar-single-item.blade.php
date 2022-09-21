@props([
    "title" => "",
    "link" => "",
    "icon" => "",
    "active" => false
])

@php
    $act = "";

    if($active)
    $act = "active";

@endphp

<li class="nav-item {{$act}}">
    <a class="nav-link" href="{{$link}}">
        <i class="{{$icon}}"></i>
        <span class="menu-title">{{$title}}</span>
    </a>
</li>
