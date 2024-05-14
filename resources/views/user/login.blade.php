<x-layout title="Login">
    <link rel="stylesheet" href="/css/user/login.css">
    <x-single-modal title="Login" subtitle="Welcome to Larabox!">
        <form method="POST" class="single-modal-form">
            <input name="email" placeholder="Email" type="email" required value="{{old("email")}}">
            <input name="password" placeholder="Password" required value="{{old("password")}}">
            <input type="submit" value="Login">
        </form>
    </x-single-modal>
</x-layout>
