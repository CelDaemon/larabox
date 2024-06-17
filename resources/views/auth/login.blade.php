<x-layout :title="__('login')">
    <h1>{{__('login')}}</h1>
    <form method="POST" action="{{route('auth.attempt')}}" novalidate>
        <div>
            <label for="email">{{__('email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255">
        </div>
        @error('email')
            <div>{{$message}}</div>
        @enderror
        <div>
            <label for="password">{{__('password')}}:</label>
            <input id="password" type="password" name="password" maxlength="255">
        </div>
        @error('password')
            <div>{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('login')}}">
    </form>
</x-layout>
