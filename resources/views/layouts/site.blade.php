<!DOCTYPE html>

<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">


   @yield('style')
   <script type="text/javascript">
       const CSFR_TOKEN = '{{ csrf_token() }}';
   </script>
    @yield('script')


</head>

<body>
    <header>
        <div id="overlay"></div>
        <nav>
   <div id="titolo">Sportify</div>
   <div class="links">
   <ul>
   <a href="{{ route('home') }}">HOME</a>
   <a href="{{ route('search_people') }}">Ricerca Utenti</a>
   <a href="{{route('New')}}">Nuovo Post</a>
   <a  href="{{ route('logout') }}" onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">Logout</a>



<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
     </ul>
            </div>

            <div id="sidebar_button">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>

        @yield('title')
        
    </header>
    
    @yield('head_content')
    
    @yield('profile')

    @yield('main_content')




</section>
    <!--SIDEBAR-->
    <section id="sidebar" class="hidden">
        <div class="side" id="sidebar_links">
   <ul>
   <a href="{{ route('home') }}">HOME</a>
   <a href="{{ route('search_people') }}">Ricerca Utenti</a>
   <a href="{{route('New')}}">Nuovo Post</a>
   <a href="{{ route('logout') }}" onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">Logout</a>
  </ul>
</section>

<section id="modale_like" class="hidden">
</section>

</body>

<footer>
    <p>
        Developed by Dario Rovito
    </p>
</footer>

</html>