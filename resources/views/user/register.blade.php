<x-layout title="Register">
    <link rel="stylesheet" href="{{asset("/css/user/register.css")}}">
    <x-single-modal title="Register" subtitle="Welcome to Larabox!">
        <form method="POST" class="single-modal-form">
            <input name="name" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Password Confirmation" required>
            <input type="submit" value="Register">
        </form>
    </x-single-modal>
</x-layout>
