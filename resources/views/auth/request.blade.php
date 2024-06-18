<x-layout :title="__('Request Password Reset')">
    <h1>{{__('Request Password Reset')}}</h1>
    <form method="POST" action="{{route('password.email')}}" novalidate>
        <div>
            <label for="email">{{__('Email')}}:</label>
            <input id="email" type="email" name="email" maxlength="255" value="{{old('email')}}">
        </div>
        @error('email')
            <div>{{$message}}</div>
        @enderror
        <input type="submit">
        <div>{{session('status')}}</div>
    </form>
</x-layout>
