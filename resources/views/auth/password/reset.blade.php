@php
    /** @var string $token */
    /** @var string $email */
@endphp
<x-layout :title="__('Reset Password')">
    <h1>{{__('Reset Password')}}</h1>
    <form method="POST" action="{{route('password.update', ['token' => $token])}}" novalidate>
        <input type="hidden" name="email" value="{{$email}}">
        <div>
            <label for="password">{{__('Password')}}:</label>
            <input id="password" type="password" name="password" class="@error('password') error-input @enderror">
        </div>
        @error('password')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="password_confirmation">{{__('Password confirmation')}}:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="@error('password_confirmation') error-input @enderror">
        </div>
        @error('password_confirmation')
            <div class="error-message">{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Reset password')}}">
    </form>
</x-layout>
