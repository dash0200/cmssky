@props([
    "title" => "",
    "icon" => "",
    "active" => false
])

@php
    $show = "";
    $open = "false";

    if($active) {
        $show = "show";
        $open = "true";
    }
@endphp

<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="{{$open}}" aria-controls="ui-basic">
        <i class="{{$icon}} menu-icon"></i>
        <span class="menu-title">{{$title}}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{$show}}" id="ui-basic">
        <ul class="nav flex-column sub-menu">
            {{$slot}}
        </ul>
    </div>
</li>