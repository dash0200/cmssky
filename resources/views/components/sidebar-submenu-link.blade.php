@props([
    'link' => '',
    'title' => '',
])

<li class="nav-item">
    <a class="nav-link" href="{{$link}}">{{$title}}</a>
</li>