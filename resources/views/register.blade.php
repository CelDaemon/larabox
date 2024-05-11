<x-layout title="Register">
    <link rel="stylesheet" href="css/register.css">
    <div>
        <main>
            <header>
                <h1 id="title">Register</h1>
                <h2 id="subtitle">Welcome to Larabox!</h2>
            </header>
            <hr>
            <form>
                <input name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Password Confirmation" required>
                <input type="submit" value="Register">
            </form>
        </main>
    </div>
</x-layout>
