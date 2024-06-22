@use('Illuminate\View\ComponentAttributeBag')
@use('Illuminate\Support\ViewErrorBag')
@php
    /** @var string $label */
    /** @var string $name */
    /** @var string $type */
    /** @var bool $preserve */
    /** @var ?string $value */
    /** @var ComponentAttributeBag $attributes */
    /** @var ViewErrorBag $errors */
@endphp
<div>
    <label for="{{$name}}">{{$label}}:</label>
    <input
        id="{{$name}}"
        name="{{$name}}"
        type="{{$type}}"
        value="{{($preserve && $type !== "password" ? old($name) : null) ?? $value }}"
        {{$attributes->class([
            'error-input' => $errors->has($name)
        ])}}
    >
    @error($name)
    <div class="error-message">{{$message}}</div>
    @enderror
</div>
