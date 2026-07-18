@props([
    'title' => '',
    'class' => '',
    'style' => ''
])

<div class="card border-0 {{ $class }}" style="{{$style ?? ''}}">
    <div class="card-body">
        <h5 class="card-title text-center">{{ $title }}</h5>
        <p class="card-text">{{ $slot }}</p>
    </div>
</div>
