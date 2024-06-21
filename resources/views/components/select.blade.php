@use('Illuminate\View\ComponentAttributeBag')
@use('Illuminate\Support\ViewErrorBag')
@php
    /** @var string $label */
    /** @var string $name */
    /** @var array<string, string> $options */
    /** @var bool $preserve */
    /** @var ?string $value */
    /** @var ComponentAttributeBag $attributes */
    /** @var ViewErrorBag $errors */
@endphp
<div>
    <label for="{{$name}}">{{$label}}:</label>
    <select
        id="{{$name}}"
        name="{{$name}}"
        autocomplete="off"
        {{$attributes->class([
            'error-input' => $errors->has($name)
        ])}}
    >
        @foreach($options as $option => $label)
            <option
                value="{{$option}}"
                @selected((($preserve ? old($name) : null)) ?? $value == $option)
            >{{$label}}</option>
        @endforeach
    </select>
    @error($name)
    <div class="error-message">{{$message}}</div>
    @enderror
</div>
