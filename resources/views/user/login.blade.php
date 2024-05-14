<x-layout title="Login">
    <link rel="stylesheet" href="/css/user/login.css">
    <x-single-modal title="Login" subtitle="Welcome to Larabox!">
        <form method="POST" class="single-modal-form">
            <input type="email" name="email" placeholder="Email" required value="{{old("email")}}">
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </x-single-modal>
</x-layout>
