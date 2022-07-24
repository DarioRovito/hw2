@extends('layouts.site')

@section('style')
<link rel='stylesheet' href='{{ asset('css/home.css') }}'>

@endsection

@section('script')
<script src='{{asset('js/cerca_utenti.js')}}' defer></script>
<script> const BASE_URL="{{url('/')}}/";  </script>
@endsection

@section ("title")
        <h1>
            <strong>Ricerca utenti</strong><br />
        </h1>
  @endsection

@section('head_content')
<div class="search_people">
        <label>Ricerca Utenti<input type="search" id="search_people"></label>
        <div class="btnCerca">
            <button class="CercaUtente">Ricerca Utente</button>
            <button class="TuttiUtenti">Visualizza tutti gli utenti</button>
        </div>
    </div>
    @endsection

    @section('main_content')
    <div class="utenti hidden">

    </div>
    @endsection