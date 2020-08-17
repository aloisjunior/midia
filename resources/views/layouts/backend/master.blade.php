@extends('layouts.comum.base_backend')

@section('head')
    <head>
        @include('layouts.backend.parts.head')

        @yield('csspage')

    </head>
@endsection

@section('container')
    <body>

    <div id="app-core">
        @yield('content')
        <div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
            <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
                <img src="/img/atonmidia/loader.gif" style=" width: 40px;" alt="loading...">
            </div>
        </div>
    </div>


    </body>
@endsection

@section('scripts')
    @include('layouts.backend.parts.scripts')

    <script> // retira loader
        $(document).ready(function () {
            $('.preloader img').fadeOut();
            $('.preloader').fadeOut(1000);
        });
    </script>

    @yield('page-scripts')



@endsection

