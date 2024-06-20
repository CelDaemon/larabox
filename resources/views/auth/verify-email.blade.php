<x-layout :title="__('Verify Email')">
    <h1>{{__('Verify Email')}}</h1>
    <form method="POST" action="{{route('verification.send')}}" novalidate>
        <input type="submit" value="{{__('Send')}}">
        <div>{{session('status')}}</div>
    </form>
</x-layout>
