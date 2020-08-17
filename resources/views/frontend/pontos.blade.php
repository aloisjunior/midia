@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Lista e fotos dos pontos de veiculação de anúncios da rede Akhena.')

@section('page-meta')

    <link rel="canonical" href="{{route('pontos')}}" />
    <meta property="og:url" content="{{route('pontos')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Lista e fotos dos pontos de veiculação de anúncios da rede Akhena." />
    <meta name="twitter:title" content="Lista e fotos dos pontos de veiculação de anúncios da rede Akhena." />

    <meta name="description" content="Área de nosso site com as fotos dos pontos de exibição de anúncios, também a lista de pontos de nossa rede de parceiros.">
    <meta property="og:description" content="Área de nosso site com as fotos dos pontos de exibição de anúncios, também a lista de pontos de nossa rede de parceiros." />
    <meta name="twitter:description" content="Área de nosso site com as fotos dos pontos de exibição de anúncios, também a lista de pontos de nossa rede de parceiros." />

    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    <meta property="og:image" content="{{asset('img/atonmidia/pontosveiculacao5.jpg')}}" />
    <meta name="twitter:image:src" content="{{asset('img/atonmidia/atonmidia-servicos1x1.jpg')}}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@atonmidia" />
    <meta name="twitter:domain" content="{{ route('inicio') }}" />
    <meta name="twitter:creator" content="@atonmidia" />
@endsection

@section('page-css')

@endsection

@section('content')
    <!--
				PAGE HEADER

				CLASSES:
					.page-header-xs	= 20px margins
					.page-header-md	= 50px margins
					.page-header-lg	= 80px margins
					.page-header-xlg= 130px margins
					.dark			= dark page header

					.shadow-before-1 	= shadow 1 header top
					.shadow-after-1 	= shadow 1 header bottom
					.shadow-before-2 	= shadow 2 header top
					.shadow-after-2 	= shadow 2 header bottom
					.shadow-before-3 	= shadow 3 header top
					.shadow-after-3 	= shadow 3 header bottom
			-->
    <section class="page-header aton-page-header">
        <div class="container">

            <h1>+ Akhena</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="#">Início</a></li>
                <li><a href="#">Páginas</a></li>
                <li class="active">Pontos de Veiculação</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <section style="padding: 30px;">
        <div class="container">
            <h1 class="fs-17">
            Veja todos os pontos disponíveis para sua campanha de sucesso na Akhena, eferecemos alta visibilidade e <span>mais de 100 pontos de veiculação</span> em todo o estado.
            </h1>

            <aton-pontos-veiculacao></aton-pontos-veiculacao>
        </div>
    </section>


    <div class="callout alert b-0 rad-0 m-0 alert-success ">

        <div class="text-center">

            <h3>Ligue agora para <span><strong>+55 (51) 3377-8830</strong></span>, será um prazer falar com você!</h3>
            <p class="font-lato fs-20">
                Garanta seu lugar em nossa grade de veiculação!
            </p>

            <a href="/contato" class="btn btn-primary btn-lg mt-30">ENTRE EM CONTATO</a>

        </div>

    </div>

@endsection

@section('page-scripts')
@endsection
