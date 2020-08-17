@extends('layouts.comum.base-landing')


@section('head')
    <title>@yield('page-title')</title>
    @include('layouts.landing.parts.head')

    @yield('page-css')

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W5DFG5');</script>
    <!-- End Google Tag Manager -->

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
    @include('layouts.landing.parts.header')

    @yield('content')
    {{--<ap.landing></ap.landing>--}}

    <!-- SCROLL TO TOP -->
    <a href="#" id="toTop"></a>

    <div id="preloader">
        <div class="inner">
            <span class="loader"></span>
        </div>
    </div><!-- /PRELOADER -->

    @include('layouts.landing.parts.footer')


@endsection

@section('scripts')
    <script type="text/javascript">var plugin_path = "{{ getCDN('/_frontend/js/plugins/', 'cdn2') }}";</script>

    @include('layouts.landing.parts.scripts')

    @yield('page-scripts')

@endsection

