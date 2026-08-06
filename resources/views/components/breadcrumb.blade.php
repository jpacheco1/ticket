@props([
    'backname' => '',
    'backlink' => '#',
    'activename' => '',
])

<nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 bg-body-tertiary rounded-3">
        <li class="breadcrumb-item">
            <a href="{{ $backlink }}">{{ $backname }}</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $activename }}
        </li>
    </ol>
</nav>
