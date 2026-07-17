@props([
    'label' => '',
    'type'=> '',
    'name'=>'',
    'value'=>'',
    'placeholder'=>'',
    'required'=>''
])

<div class="mb-3">
    <label class="form-label">
        {{$label}}
        <span style="color: #dc3545;">{{ $required != 'true'? '' : ' *' }}</span>
    </label>
    <input
        type="{{$type}}"
        class="form-control"
        id="{{$name}}"
        name="{{$name}}"
        value="{{$value}}"
        placeholder="{{$placeholder}}"
    />
</div>
