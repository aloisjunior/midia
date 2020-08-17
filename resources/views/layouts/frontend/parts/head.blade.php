<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
{{--<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>--}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- metas tags basicas--}}
<link rel="icon" href="<?php $_SERVER['SERVER_NAME']?>/img/favicon.ico"/>
<link rel="shortcut icon" href="<?php $_SERVER['SERVER_NAME']?>/img/favicon.ico" />

<meta name="robots" content="all">

<meta name="msvalidate.01" content="EB6B465CB0BB9D1CF032F00B693FA9F0" />


{{-- metas customizaveis--}}
<meta name="author" content="Akhena">
<meta name="keywords" content="Akhena,Mídia,Digital,Indoor,Segmentada,Porto Alegre,Anuncio,Anuncios,Publicidade,Sustentável,
TV Corporativa,Midia Indoor,Propaganda,Midia Indoor Segmentada,Shopping Total,Rádio Indoor,Canal de Veiculação,MOOH,@yield('page-tags')" >

<!-- mobile settings -->

@yield('page-meta')

<!-- Styles -->
{{--<link href="{{ route('static_cache', 'caminho='.mix('_frontend/css/app_frontend.css')) }}" rel="stylesheet">--}}
<link href="{{ getCDN(mix('_frontend/css/app_frontend.css')->__toString(), 'cdn2') }}" rel="stylesheet">
<link href="{{ getCDN(mix('_frontend/css/custom_frontend.css')->__toString(), 'cdn2') }}" rel="stylesheet">
{{--<link href="{{ mix('_frontend/css/app_frontend.css') }}" rel="stylesheet">--}}
{{--<link href="{{ mix('_frontend/css/custom_frontend.css') }}" rel="stylesheet">--}}
