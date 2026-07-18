@props(['type' => 'success'])

<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    {{ $slot }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
</div>

