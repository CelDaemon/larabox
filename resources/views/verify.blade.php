<x-layout title="Verify">
    <h1>Your email is not verified</h1>
    <form method="POST">
        <input type="submit" value="Send verification email">
    </form>
    {{session('message')}}
</x-layout>
