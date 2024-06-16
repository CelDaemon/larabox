<x-layout title="Verify">
    <h1>Your email is not verified</h1>
    <form method="POST" action="{{route('verification.send')}}">
        <input type="submit" value="Send verification email">
    </form>
    {{session('message')}}
</x-layout>
