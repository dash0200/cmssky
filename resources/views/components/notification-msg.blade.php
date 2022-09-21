@props([
    "msg" => "",
    "time" => "",
    "icon" => ""
])

<a class="dropdown-item preview-item">
    <div class="preview-thumbnail">
        <div class="preview-icon bg-success">
            <i class="mdi mdi-{{$icon}} mx-0"></i>
        </div>
    </div>
    <div class="preview-item-content">
        <h6 class="preview-subject font-weight-normal">{{$msg}}</h6>
        <p class="font-weight-light small-text mb-0 text-muted">
            {{$time}}
        </p>
    </div>
</a>
