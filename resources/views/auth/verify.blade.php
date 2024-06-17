<x-layout :title="__('verify_email')">
    <h1>{{__('verify_email')}}</h1>
    <form method="POST" action="{{route('verification.send')}}" novalidate>
        <input type="submit" value="{{__('send')}}">
        <div>{{session('status')}}</div>
    </form>
</x-layout>
