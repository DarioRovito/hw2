@extends('layouts.site')

@section('style')
<link rel='stylesheet' href='{{ asset('css/new_post.css') }}'>

@endsection

@section('script')
<script src='{{asset('js/new_post.js')}}' defer></script>
<script> const BASE_URL="{{url('/')}}/";  </script>

@endsection


@section ("title")
<h1>
            <strong>Crea il tuo nuovo post</strong><br/>
        </h1>
  @endsection

@section('head_content')
<article>
<form name='search_content' id='search' autocomplete="off" >
@csrf

            <h1>Ricerca post</h1>

            <input type='text' name='content' id='content'>

            <select name='type' id='tipo'>
                <option value='sports'>Sports</option>
                <option value='giphy'>Giphy</option>
                <option value='spotify'>Spotify</option>
            </select>

            <label>&nbsp;<input class="submit" type='submit'></label>
        </form>
    </article>
@endsection

@section('main_content')

<section class="box_container">

<div id="contents">
</div>

</section>

<section id="modale" class="hidden" >
    </section>

@endsection

