@props([
    "title" => "",
    "link" => "",
    "icon" => "",
])



<li class="nav-item">
    <a class="nav-link" href="{{$link}}">
        <i class="{{$icon}} menu-icon"></i>
        <span class="menu-title">{{$title}}</span>
    </a>
</li>
