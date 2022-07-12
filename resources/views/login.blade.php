@extends('layouts.guest')

@section('title', '| Accedi')

@section('content')
<h1>Benvenuto</h1>
<form name='login' method='post' action="{{ route('login') }}">
    @csrf
    <div class="username @error('username') error @enderror @error('email') error @enderror">
        <div><label for='username'>Nome utente</label></div>
        <div><input type='text' name='username' value='{{ old('username') }}'></div>
    </div>
    <div class="password @error('password') error @enderror">
        <div><label for='password'>Password</label></div>
        <div><input type='password' name='password'></div>
    </div>
    @isset($error)

<h1 class='errore'>{{$error}} </h1>

@endisset
    <div>
        <input type='submit' value="Accedi">
    </div>
 

</form>
<div class="signup">Non hai un account? <a href="{{ route('register') }}">Iscriviti</a>
@endsection
