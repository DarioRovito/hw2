@extends('layouts.object')


@section('style')
<link rel='stylesheet' href='{{ asset('css/home.css') }}'>

@endsection

@section('script')
<script src='{{asset('js/home.js')}}' defer></script>
<script> const BASE_URL="{{url('/')}}/";  </script>
@endsection

@section('profile')
<section id="profile" data-user="{{$user['username']}}">        
    <div class="avatar"  style="background-image:url('{{ 'data:image/jpg;charset=utf8;base64,'.base64_encode($user['propic']) }}')"></div>
    <div class="name">
    {{ $user['name'] }} {{ $user['surname'] }}
    </div>
    <div class="username">
        {{ '@'.$user['username'] }} 
    </div>
    <a  class="visualizza"  href="{{route('profilo')}}">Visualizza profilo</a>
    <div class="information">
        <div>
            <span class="count">{{ $user['nposts'] }} </span><br>Posts
        </div>
        <div id="view_followers">
            <span class="count">{{ $user['nfollowers'] }} </span><br>followers
        </div>
        <div id="view_following">
            <span class="count">{{ $user['nfollowing'] }} </span><br>following
        </div>
    </div>
</section>
@endsection


