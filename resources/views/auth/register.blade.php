<x-layout :title="__('Register')">
    <h1>{{__('Register')}}</h1>
    <form method="POST" action="{{route('users.store')}}" novalidate>
        <div>
            <label for="name">{{__('Name')}}:</label>
            <input id="name" type="text" name="name" maxlength="255" value="{{old('name')}}">
        </div>
        @error('name')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="email">{{__('Email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255" value="{{old('email')}}">
        </div>
        @error('email')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="password">{{__('Password')}}:</label>
            <input id="password" type="password" name="password" maxlength="255" value="{{old('password')}}">
        </div>
        @error('password')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="password_confirmation">{{__('Password confirmation')}}:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" maxlength="255" value="{{old('password_confirmation')}}">
        </div>
        @error('password_confirmation')
            <div>{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Update')}}">
    </form>
</x-layout>
