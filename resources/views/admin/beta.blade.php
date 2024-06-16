@use('Illuminate\Support\Collection')
@use('App\Models\User')
@php
    /** @var Collection<User> $users */
@endphp
<x-layout title="Manage Beta Access">
    <style @nonce>
        form {
            display: inline;
        }
    </style>
    <h1>Manage Beta Access</h1>
    <ul>
        @foreach($users as $user)
            <li>{{$user->name}} <form method="POST" action="{{route('admin.beta.update', ['user' => $user])}}">@method("PATCH")<input type="checkbox" name="beta" @checked($user->is_beta)><input type="submit"></form></li>
        @endforeach
    </ul>
</x-layout>
