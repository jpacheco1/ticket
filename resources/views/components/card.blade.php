@props([
    'title' => '',
    'class' => '',
    'style' => ''
])

<div class="card border-0 {{ $class }}" style="{{$style ?? ''}}">
    @if ($title)
    <div class="card-header">
        {{ $title }}
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
