@extends('layouts.comum.base')


@section('head')
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W5DFG5');</script>
    <!-- End Google Tag Manager -->


    <title>@yield('page-title')</title>
    @include('layouts.frontend.parts.head')

    @yield('page-css')


    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "https://rothermel.com.br",
      "logo": "https://rothermel.com.br/img/ayro.png",
      "contactPoint": [{
        "@type": "ContactPoint",
        "telephone": "+55-51-3377-8830",
        "contactType": "customer service"
      }],
      "description": "Bem-vindo a Akhena, trabalhando com veiculação de anúncios em Mídia Digital Indoor, TV Corporativa, Vitrine Digital e Rádio Indoor. Veja como ter sucesso na sua campanha de publicidade ao anunciar no Shopping Total de Porto Alegre e mais 75 pontos da rede de parceiros.",
      "name": "Akhena - Ampliando Resultados com Tecnologia",
	  "email":"mailto:contato@rothermel.com.br"
    }
    </script>



@endsection

@section('page-plugins')
    @include('layouts.comum.googletagmanager')
@endsection

@section('container')
    @include('layouts.frontend.parts.header')

    @include('layouts.frontend.parts.sidebar')

    @yield('content')
    {{--<ap.frontend></ap.frontend>--}}

    <!-- SCROLL TO TOP -->
    <a href="#" id="toTop"></a>

    {{--<div id="preloader" class="preloader" style=" position: fixed;--}}
    {{--width: 100%;--}}
    {{--height: 100%;--}}
    {{--top: 0;--}}
    {{--left: 0;--}}
    {{--z-index: 100000;--}}
    {{--backface-visibility: hidden;--}}
    {{--background: #ffffff;">--}}
    {{--<div class="preloader_img" style="width: 200px;--}}
    {{--height: 200px;--}}
    {{--position: absolute;--}}
    {{--left: 48%;--}}
    {{--top: 48%;--}}
    {{--background-position: center;--}}
    {{--z-index: 999999">--}}
    {{--<img src="img/atonmidia/loader.gif" style=" width: 40px;" alt="loading...">--}}
    {{--<img src="img/_smarty/loaders/9.gif" style=" width: 40px;" alt="loading...">--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- PRELOADER -->
    <div id="preloader">
        <div class="inner">
            <span class="loader"></span>
        </div>
    </div><!-- /PRELOADER -->

    @include('layouts.frontend.parts.footer')

    {{--<aton-form-lateral></aton-form-lateral>--}}

    {{--<aton-notification-fcm></aton-notification-fcm>--}}

@endsection

@section('scripts')
    <script type="text/javascript">var plugin_path = "{{ getCDN('/_frontend/js/plugins/', 'cdn2') }}";</script>

    @include('layouts.frontend.parts.scripts')

    @yield('page-scripts')

    @include('layouts.plugins.whatshelp')
    @include('layouts.plugins.smartsupp')
@endsection

