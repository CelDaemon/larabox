<x-layout :title="__('Register')">
    <h1>{{__('Register')}}</h1>
    <form method="POST" action="{{route('users.store')}}" novalidate>
        <div>
            <label for="name">{{__('Name')}}:</label>
            <input id="name" type="text" name="name" maxlength="255" value="{{old('name')}}" class="@error('name') error-input @enderror">
        </div>
        @error('name')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="email">{{__('Email')}}:</label>
            <input id="email" type="text" name="email" maxlength="255" value="{{old('email')}}" class="@error('email') error-input @enderror">
        </div>
        @error('email')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="password">{{__('Password')}}:</label>
            <input id="password" type="password" name="password" value="{{old('password')}}" class="@error('password') error-input @enderror">
        </div>
        @error('password')
            <div class="error-message">{{$message}}</div>
        @enderror
        <div>
            <label for="password_confirmation">{{__('Password confirmation')}}:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="@error('password_confirmation') error-input @enderror">
        </div>
        @error('password_confirmation')
            <div class="error-message">{{$message}}</div>
        @enderror
        <input type="submit" value="{{__('Update')}}">
    </form>
</x-layout>
