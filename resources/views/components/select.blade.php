@props([
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'selected' => null,
    'options' => []
])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select"
    >
        <option value="">{{ $placeholder ?: 'Seleccione una opción' }}</option>
        @foreach($options as $option)
            @php
                $optionValue = is_array($option)
                    ? $option['id']
                    : $option->id;

                $optionLabel = is_array($option)
                    ? $option['name']
                    : $option->name;
            @endphp
            <option
                value="{{ $optionValue }}"
                @selected(old($name, $selected) == $optionValue)
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
