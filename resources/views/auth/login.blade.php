@extends('layouts.guest')

@section('title', 'Connexion | ')

@push('style')
    <style>
        /***/
    </style>
@endpush

@section('content')

    <h1>Connexion</h1>

    @if ($errors->any())
        <div class="alert alert-danger bg-opacity-10">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" placeholder="exemple@domaine.tld" value="{{ old('email') }}" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

        <button type="submit">Connexion</button>
    </form>

@endsection

@push('script')
    <script>
        /***/
    </script>
@endpush