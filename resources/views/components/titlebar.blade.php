
@props([
    'title' => '',
])
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
    <h1 class="h2">{{ $title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        {{ $slot }}
    </div>
</div>
