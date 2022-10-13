@props([
    'title' => '',
    'name' => '',
    'id' => '',
    'value' => '',
    'RadioType' => 'primary'
])
<div class="form-check form-check-{{$RadioType}}">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="{{$name}}" id="{{$id}}" value="{{$value}}">
        {{$title}}
        <i class="input-helper"></i></label>
</div>
