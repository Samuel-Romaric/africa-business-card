@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')

    <h1>Connexion</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

        <button type="submit">Connexion</button>
    </form>

@endsection

