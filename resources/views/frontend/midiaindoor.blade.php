@extends('layouts.frontend.master')


@section('page-title', 'Akhena - Midia Digital Indoor')

@section('page-meta')
    <link rel="canonical" href="{{route('midiaindoor')}}" />
    <meta property="og:url" content="{{route('midiaindoor')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Akhena - Midia Digital Indoor" />
    <meta name="twitter:title" content="Akhena - Midia Digital Indoor" />

    <meta name="description" content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor.">
    <meta property="og:description" content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor." />
    <meta name="twitter:description" content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor." />
    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />


    <meta property="og:site_name" content="Akhena - Ampliando Resultados com Tecnologia" />
    <meta property="og:image" content="{{ asset('/img/atonmidia/atonmidia-midiaindoor.jpg') }}" />
    <meta name="twitter:image:src" content="{{ asset('/img/atonmidia/atonmidia-midiaindoor1x1.jpg') }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@atonmidia" />
    <meta name="twitter:domain" content="{{ route('inicio') }}" />
    <meta name="twitter:creator" content="@atonmidia" />
@endsection


@section('page-css')
    <link href="{{ getCDN('_frontend/js/plugins/layerslider/css/layerslider.css', 'cdn2') }}" rel="stylesheet" type="text/css">
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
                <li class="active">Mídia Indoor</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>

        <div id="layerslider" style="height:450px;width: 800px; ">

            {{-- slider 1--}}
            <div class="ls-slide" data-ls="slidedelay:12000;transition2d:4; fadein:true;">
                {{--<img src="{!! asset('_frontend/layerslider-radioindoor/bg_1.png') !!}" class="ls-bg" alt="Slide background" />--}}
                <p class="ls-l"
                   style="top:50%;left:50%;font-weight: 300; background: white; background: rgba(255,255,255,.2);height:60px;padding-right:10px;padding-left:10px;font-size:50px;line-height:57px;color:#ffe9db;white-space: nowrap;"
                   data-ls="offsetxin:0;rotatexin:-70;scalexin:3;scaleyin:3;offsetxout:0;durationout:1000;showuntil:1000;rotatexout:70;scalexout:0.5;scaleyout:0.5;">
                    Quer anunciar em shopping centers?
                </p>
                <p class="ls-l"
                   style="top:35%;left:50%;font-weight: 300;font-size:30px;color:#ffffff;white-space: nowrap;"
                   data-ls="delayin:2000;offsetxin:50;durationin:750;easingin:easeOutBack;skewxin:-50;offsetxout:-50;durationout:600;showuntil:500;easingout:easeInBack;skewxout:50;">
                    Apresentamos
                </p>
                <p class="ls-l ls-shadow"
                   style="top:50%;left:50%;font-weight: 300;font-size:50px;color:#ffffff;white-space: nowrap;"
                   data-ls="delayin:2500;offsetxin:-100;durationin:750;easingin:easeOutBack;skewxin:-50;offsetxout:100;durationout:600;showuntil:500;easingout:easeInBack;skewxout:50;">
                    Um nova forma de anunciar
                </p>
                {{--<img class="ls-l" style="top:30%;left:50%;width:120%;height:auto;white-space: nowrap;" data-ls="offsetxin:-100;durationin:2000;delayin:1500;offsetxout:-100;durationout:1000;parallaxlevel:-2;" src="assets/sliderimages/slide-b-1.png" alt=""><img class="ls-l" style="top:353px;left:237px;white-space: nowrap;" data-ls="offsetxin:50;durationin:2000;delayin:1500;offsetxout:50;durationout:1000;parallaxlevel:1;" src="assets/sliderimages/slide-b-2.png" alt=""><img class="ls-l" style="top:453px;left:483px;white-space: nowrap;" data-ls="offsetxin:100;durationin:2000;delayin:1500;offsetxout:100;durationout:1000;parallaxlevel:3;" src="assets/sliderimages/slide-b-3.png" alt=""><img class="ls-l" style="top:456px;left:586px;white-space: nowrap;" data-ls="offsetxin:150;durationin:2000;delayin:1500;offsetxout:150;durationout:1000;parallaxlevel:5;" src="assets/sliderimages/slide-b-4.png" alt=""><img class="ls-l" style="top:421px;left:659px;white-space: nowrap;" data-ls="offsetxin:200;durationin:2000;delayin:1500;offsetxout:200;durationout:1000;parallaxlevel:7;" src="assets/sliderimages/slide-b-5.png" alt="">--}}
                <p class="ls-l"
                   style="top:50%;left:590px;font-weight: 500;font-size:40px;color:#ffffff;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:1500;delayin:4000;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:1500;showuntil:1000;rotateyout:-90;transformoriginout:left 50% 0;">
                    Divulgue sua empresa
                    <br> em nossa rede de Mídia Indoor!</p>
                <img class="ls-l" style="top:50%;left:300px;width:260px;height:30%;white-space: nowrap;"
                     data-ls="offsetxin:0;durationin:1500;delayin:4000;rotateyin:90;transformoriginin:right 50% 0;offsetxout:0;durationout:1500;showuntil:1000;rotateyout:-90;transformoriginout:right 50% 0;"
                     src="{{ getCDN('/img/ayro.png', 'cdn2') }}" alt="">

                <p class="ls-l"
                   style="top:40%;left:150px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#849e00;background:#ffffff;border-radius:4px;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:2000;delayin:7000;rotatein:-45;rotateyin:-1;scalexin:0.5;scaleyin:0.5;transformoriginin:left bottom 0;offsetxout:0;durationout:1000;rotateout:45;scalexout:2;scaleyout:2;transformoriginout:right bottom 0;">
                    Invista onde realmente
                </p>
                <p class="ls-l"
                   style="top:50%;left:150px;font-weight: 500;font-size:30px;color:#ffffff;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:2000;delayin:7500;rotatein:-45;scalexin:2;scaleyin:2;transformoriginin:right top 0;offsetxout:0;durationout:1000;rotateout:45;scalexout:2;scaleyout:2;transformoriginout:left top 0;">
                    tem retorno!
                </p>
                <img class="ls-l" style="top:40%;left:60%;white-space: nowrap;width: 500px;height:70%;"
                     data-ls="delayin:7400;durationin:1500;showuntil:3000;scalexin:0.8;scaleyin:0.8;scalexout:0.8;scaleyout:0.8;"
                     src="{{ getCDN('/img/atonmidia/midiaindoor5.jpg', 'cdn2') }}" alt="">
                <p class="ls-l"
                   style="top:81%;left:60%;font-weight: 300; text-align: center;width:480px;height:40px;padding:5px;font-size:30px;line-height:37px;color:#ffffff;background:#f06a52;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:2000;delayin:8500;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% top 0;offsetxout:0;showuntil:800;durationout:1000;rotatexout:90;transformoriginout:50% top 0;">
                    SHOPPING TOTAL PORTO ALEGRE
                </p>
            </div>

            {{-- slide 2--}}
            <div class="ls-slide" data-ls="slidedelay:11000;transition2d:75,79;">
                {{--                    <img src="{!! asset('_frontend/layerslider-radioindoor/bg_2.png') !!}" class="ls-bg" alt="Slide background" />--}}
                {{--<img class="ls-l" style="top:0px;left:0px;white-space: nowrap;opacity: .5;" data-ls="offsetxin:0;durationin:1000;easingin:linear;offsetxout:0;durationout:6000;showuntil:2;easingout:linear;" src="{!! asset('_frontend/layerslider-radioindoor/bg_1.png') !!}" alt="">--}}

                <h1 class="ls-l"
                    style="top:60px;left:700px;font-weight: 300;font-size:40px;color:#d4eaff;white-space: nowrap;"
                    data-ls="offsetxin:50;durationin:2000;rotateyin:60;transformoriginin:right 50% 0;offsetxout:-50;durationout:2000;showuntil:7000;rotateyout:-60;transformoriginout:left 50% 0;">
                    Mídia Indoor Akhena</h1>
                <h2 class="ls-l"
                    style="top:100px;left:701px;font-weight: 500;font-size:30px;color:#fa6b4b;white-space: nowrap;"
                    data-ls="offsetxin:-50;durationin:2000;delayin:500;rotateyin:-60;transformoriginin:left 50% 0;offsetxout:50;durationout:2000;showuntil:7000;rotateyout:60;transformoriginout:right 50% 0;">
                    características</h2>

                <img class="ls-l" style="top:50%;left:20%;white-space: nowrap; width: 350px"
                     data-ls="offsetxin:0;durationin:750;delayin:1300;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:750;rotateyout:90;transformoriginout:left -50% 0;"
                     src="{{  getCDN('/img/atonmidia/shoppingtotal1.jpg' , 'cdn2') }}" alt="">

                {{--<h1 class="ls-l" style="font-family: Oswald; top:15%;left:20%;font-weight: 500; text-align: center; width:340px;font-size:60px;color:#01a10c;border-radius:5px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:3000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotateout:-90;transformoriginout:left bottom 0;">--}}
                {{--Produto Exclusivo</h1>--}}
                <p class="ls-l"
                   style="top:150px;left:450px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;"
                   data-ls="durationin:1500;delayin:3300;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">
                    Visibilidade
                </p>
                <p class="ls-l"
                   style="top:190px;left:450px;font-weight: 300;font-size:24px;color:#fff;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:1500;delayin:3700;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">
                    Audiência de mais de 1 milhão de pessoas por mês.
                </p>
                <p class="ls-l"
                   style="top:250px;left:450px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;"
                   data-ls="durationin:1500;delayin:4000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">
                    Baixo Custo
                </p>
                <p class="ls-l"
                   style="top:290px;left:450px;font-weight: 300;font-size:24px;color:#fff;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:1500;delayin:4400;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">
                    Melhor custo benefício comparado as formas tradicionais de anuncios.
                </p>
                <p class="ls-l"
                   style="top:350px;left:450px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;"
                   data-ls="durationin:1500;delayin:4700;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">
                    Concorrência
                </p>
                <p class="ls-l"
                   style="top:390px;left:450px;font-weight: 300;font-size:24px;color:#fff;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:1500;delayin:5100;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">
                    Oferecemos baixissima concorrência para seu anuncio!
                </p>
                {{--<p class="ls-l" style="top:450px;left:500px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;" data-ls="durationin:1500;delayin:5400;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">--}}
                {{--CLEANER MARKUP--}}
                {{--</p>--}}
                {{--<p class="ls-l" style="top:490px;left:499px;font-weight: 300;font-size:24px;color:#333;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:5800;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">--}}
                {{--working with the plugin is more easy--}}
                {{--</p>--}}
            </div>

            {{-- slide 3--}}
            <div class="ls-slide" data-ls="slidedelay:9500;transition2d:5;timeshift:-3000;">
                {{--<img src="assets/sliderimages/bg4.jpg" class="ls-bg" alt="Slide background" />--}}
                <p class="ls-l"
                   style="top:-17px;left:915px;opacity: .3; font-weight: 300;font-size:200px;color:#ffffff;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:2000;easingin:linear;scalexin:1;scaleyin:1;offsetxout:0;durationout:2000;showuntil:1000;easingout:linear;scalexout:3;scaleyout:3;">
                    +
                </p>
                <h1 class="ls-l"
                    style="top:60px;left:700px;font-weight: 300;font-size:40px;color:#ffffff;white-space: nowrap;"
                    data-ls="offsetxin:50;durationin:3000;rotateyin:60;transformoriginin:right 50% 0;offsetxout:-50;durationout:3000;showuntil:400;rotateyout:-60;transformoriginout:left 50% 0;">
                    LIBERDADE</h1>
                <h2 class="ls-l"
                    style="top:100px;left:701px;font-weight: 500;font-size:30px;color:#286e89;white-space: nowrap;"
                    data-ls="offsetxin:-50;durationin:3000;delayin:500;rotateyin:-60;transformoriginin:left 50% 0;offsetxout:50;durationout:3000;showuntil:1;rotateyout:60;transformoriginout:right 50% 0;">
                    de criação.. </h2>
                <h1 class="ls-l"
                    style="top:257px;left:88px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#29768f;border-radius:4px;white-space: nowrap;"
                    data-ls="offsetxin:0;durationin:4000;delayin:2000;rotateyin:450;transformoriginin:right 50% 0;offsetxout:0;durationout:500;showuntil:1;easingout:easeInBack;rotateyout:-90;transformoriginout:right 50% 0;">
                    Gerenciamento </h1>
                <h3 class="ls-l"
                    style="top:277px;left:320px;font-weight: 300;font-size:60px;color:#ffffff;white-space: nowrap;"
                    data-ls="offsetxin:0;durationin:4000;delayin:2000;rotateyin:450;transformoriginin:left 50% 0;offsetxout:0;durationout:500;showuntil:1;easingout:easeInBack;rotateyout:90;transformoriginout:left 50% 0;">
                    Remoto</h3>
                <h1 class="ls-l"
                    style="top:161px;left:667px;font-weight: 300; text-align: right;font-size:30px;color:#ffffff;white-space: nowrap;"
                    data-ls="showuntil:2000;offsetxin:0;durationin:2000;delayin:6500;easingin:easeOutElastic;rotateyin:-90;transformoriginin:right 50% 0;offsetxout:0;durationout:500;rotateyout:-90;transformoriginout:right 50% 0;"><span
                            style="color: #286e89;">
                            VÍDEO</span> e</h1>
                <h3 class="ls-l"
                    style="top:200px;left:667px;font-weight: 300;font-size:30px;color:#ffffff;white-space: nowrap;"
                    data-ls="showuntil:2000;offsetxin:0;durationin:2000;delayin:6500;easingin:easeOutElastic;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:500;rotateyout:90;transformoriginout:left 50% 0;"><span
                            style="color: #286e89;">
                            Artes Animadas</span><br>
                    <span style="color:#9e4e3b;">produzimos para você.</span></h3>

                {{--<img class="ls-l" style="top:100px;left:-82px;width:765px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:1000;offsetxout:-100;offsetyout:50;durationout:2000;showuntil:2010;" src="{!! asset('_frontend/layerslider-radioindoor/slide-a-1.png') !!}" alt="">--}}
                {{--<img class="ls-l" style="top:495px;left:135px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:1000;offsetxout:-100;offsetyout:50;durationout:2000;showuntil:2010;" src="assets/sliderimages/slide-a-2.png" alt="">--}}
                {{--<img class="ls-l" style="top:155px;left:130px;height:350px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:1000;offsetxout:0;durationout:1500;showuntil:1500;scalexout:1.2;scaleyout:1.2;" src="{!! asset('_frontend/layerslider-radioindoor/radio_tablet.png') !!}" alt="">--}}
                {{--<img class="ls-l" style="top:275px;left:135px;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:3500;scalexin:1.5;scaleyin:1.5;offsetxout:-100;offsetyout:50;durationout:2000;showuntil:1;" src="assets/sliderimages/slide-a-4.png" alt="">--}}

                {{--<img class="ls-l" style="top:376px;left:236px;white-space: nowrap;" data-ls="offsetxin:0;durationin:1;delayin:4498;offsetxout:0;durationout:750;showuntil:1;easingout:easeOutSine;scalexout:10;scaleyout:10;" src="{!! asset('_frontend/layerslider-radioindoor/slide-a-6.png') !!}" alt="">--}}
                {{--  mão clicando--}}
                {{--<img class="ls-l" style="top:375px;left:200px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:bottom;delayin:3500;offsetxout:0;offsetyout:bottom;durationout:1000;showuntil:1;" src="{!! asset('_frontend/layerslider-radioindoor/slide-a-5.png') !!}" alt="">--}}


                <img class="ls-l" style="top:150px;left:22%;white-space: nowrap;width: 120px"
                     data-ls="offsetxin:-100;delayin:7000;easingin:easeInOutCubic;rotatein:-180;offsetxout:300;durationout:500;showuntil:3500;easingout:easeInOutCubic;rotateout:360;"
                     src="{{ getCDN('/img/atonmidia/shoppingtotal-redondo.png', 'cdn2') }}" alt="">
                <p class="ls-l"
                   style="top:300px;left:100px; text-align: center; font-weight: 500; opacity: .75;font-size:24px;line-height:25px;color:#ffffff;white-space: nowrap;"
                   data-ls="offsetxin:0;delayin:7000;showuntil:3500;scalexin:2;scaleyin:2;offsetxout:0;durationout:500;scalexout:2;scaleyout:2;">
                    São 23 pontos no Shopping Total
                    <br> exbindo seu anuncio sem parar.
                </p>
            </div>

            {{-- slide--}}

            <div class="ls-slide" data-ls="slidedelay:8000;transition2d:21,105;timeshift:-1000;">
                {{--                    <img src="{{ getCDN('_frontend/layerslider-radioindoor/bg6b.jpg') !!}" class="ls-bg" alt="Slide back, 'cdn2'gr}}d" />--}}
                <img class="ls-l" style="top:55px;left:50%;white-space: nowrap;"
                     data-ls="offsetxin:0;durationin:1500;delayin:4000;easingin:linear;scalexin:0;scaleyin:0;offsetxout:0;durationout:1500;showuntil:1;easingout:linear;scalexout:2;scaleyout:2;"
                     src="{{ getCDN('_frontend/layerslider-radioindoor/circle.png', 'cdn2') }}" alt="">
                <img class="ls-l" style="top:55px;left:50%;white-space: nowrap;"
                     data-ls="offsetxin:0;durationin:1500;delayin:4500;easingin:linear;scalexin:0;scaleyin:0;offsetxout:0;durationout:1500;showuntil:1;easingout:linear;scalexout:2;scaleyout:2;"
                     src="{{ getCDN('_frontend/layerslider-radioindoor/circle.png', 'cdn2') }}" alt="">
                <p class="ls-l"
                   style="top:234px;left:56px;font-weight: 300; opacity: .4;font-size:200px;color:#f06a52;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:2500;delayin:1000;scalexin:0;scaleyin:0;offsetxout:0;scalexout:0;scaleyout:0;">
                    +
                </p>
                <p class="ls-l"
                   style="top:220px;left:120px;font-weight: 300; background: white; background: rgba(255,255,255,.85);height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#bd5949;white-space: nowrap;"
                   data-ls="offsetxin:-50;durationin:2000;delayin:1000;offsetxout:-50;durationout:1000;">
                    Sempre trabalhando
                </p>
                <p class="ls-l"
                   style="top:260px;left:173px;font-weight: 500;font-size:30px;color:#bd5949;white-space: nowrap;"
                   data-ls="offsetxin:50;delayin:2000;skewxin:-60;offsetxout:-50;durationout:1000;skewxout:-60;">
                    para melhorar!
                </p>
                <p class="ls-l"
                   style="top:220px;left:863px;font-weight: 500; text-align: right;font-size:30px;color:#bd5949;white-space: nowrap;"
                   data-ls="offsetxin:0;delayin:2500;rotatein:90;transformoriginin:right bottom 0;offsetxout:0;durationout:1500;transformoriginout:right bottom 0;">
                    ...e oferecer
                </p>
                <p class="ls-l"
                   style="top:260px;left:900px;font-weight: 300; text-align: right;width:200px;height:40px;padding-right:10px;font-size:30px;line-height:37px;color:#ffffff;background:#f06a52;white-space: nowrap;"
                   data-ls="offsetxin:0;durationin:2500;delayin:3250;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% top 0;offsetxout:0;durationout:1000;rotatexout:90;transformoriginout:50% bottom 0;">
                    EXCELENTE
                </p>
                <p class="ls-l"
                   style="top:305px;left:810px;font-family:'Indie Flower';font-size:30px;color:#d9482b;white-space: nowrap;"
                   data-ls="offsetxin:-50;delayin:3500;skewxin:60;scalexin:1.5;offsetxout:-50;durationout:1000;skewxout:60;scalexout:1.5;">
                    Visibilidade para sua marca!
                </p>

                <img class="ls-l" style="top:190px;left:50%;width:300px;white-space: nowrap;"
                     data-ls="durationin:1500;delayin:1500;scalexin:0.2;scaleyin:0.2;scalexout:0.3;scaleyout:0.3;"
                     src="{{ getCDN('/img/ayro.png', 'cdn2') }}" alt="">
                {{--<img class="ls-l" style="top:200px;left:53%;width:100px;white-space: nowrap;" data-ls="durationin:1500;delayin:1500;scalexin:0.2;scaleyin:0.2;scalexout:0.3;scaleyout:0.3;" src="{!! asset('_frontend/layerslider-radioindoor/caixa.png') !!}" alt="">--}}
                {{--<img class="ls-l" style="top:195px;left:47%;width:100px;white-space: nowrap;" data-ls="durationin:1500;delayin:1500;scalexin:0.2;scaleyin:0.2;scalexout:0.3;scaleyout:0.3;" src="{!! asset('_frontend/layerslider-radioindoor/faixa-som.png') !!}" alt="">--}}
            </div>
        </div>


        <div class="container">

            <p class="lead"></p>
            <div class="heading-title">
                <h3>
                    Anunciar em Shopping Center:
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>A melhor opção</span>
				            <span>O melhor retorno</span>
				            <span>A maior visibilidade</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>
            <h1 class="fs-17">Informações veiculadas através da Mídia Digital Indoor possuem visibilidade e índice de
                audiência maiores, a atenção do expectador é atraída de maneira espontânea e agradável.</h1>

            <div class="divider divider-center divider-color"><!-- divider -->
                <i class="fa fa-chevron-down"></i>
            </div>

            <!-- BORN TO BE A WINNER -->
            <article class="row">
                <div class="col-md-6">
                    <!-- OWL SLIDER -->
                    <div class="owl-carousel buttons-autohide controlls-over m-0"
                         data-plugin-options='{"items": 1, "autoHeight": true, "navigation": false, "pagination": false, "transitionStyle":"backSlide", "progressBar":"true"}'>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/midiaindoor1.jpg','cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/midiaindoor2.jpg','cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/midiaindoor3.jpg','cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/midiaindoor4.jpg','cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/midiaindoor5.jpg','cdn2') }}" alt="">
                        </div>
                    </div>
                    <!-- /OWL SLIDER -->


                    <div class="row mt-40">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-8">
                            <a href="{{ route('contato') }}" class="btn btn-featured btn-danger">
                                <span>ANUNCIAR NO TOTAL</span>
                                <i class="et-megaphone"></i>
                            </a>
                        </div>
                        <div class="col-sm-2">

                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="heading-title">
                        <h4>
                            Uma nova maneira de pensar
                            <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>a Mídia Digital Indoor.</span>
				            <span>seu investimento.</span>
				            <span>seu marketing.</span>
                        </span>
                    </span><!-- /word rotator -->
                        </h4>
                    </div>
                    {{--<h3>Anunciar em Shopping Center: A melhor opção</h3>--}}
                    <p>Se quer fazer sua marca ou produto acontecer, você tem que estar presente na vida de quem mais
                        influencia o consumo nos grandes centros: <strong>Os influenciadores urbanos.</strong>
                    </p>

                    <p>
                        Aqueles milhões de pessoas que trabalham, estudam, fazem compras, se divertem e circulam nas
                        cidades.
                    </p>

                    <p>Mídia Digital Indoor é a forma inteligente de atingir o consumidor no momento certo, no momento
                        da sua decisão de compra.
                    </p>

                    <p>E o melhor lugar para veicular uma campanha de Mídia Digital Indoor é um Shopping Center, que
                        reúne todos os requisitos de sucesso para uma campanha publicitária.
                    </p>
                    <p>Planeje a mensagem certa, para a pessoa certa, no momento certo e no local certo com a Akhena.
                    </p>


                </div>
            </article>
            <!-- /BORN TO BE A WINNER -->

        </div>
    </section>
    <!-- / -->

    <!-- -->
    <section>
        <div class="container">

            <!-- FEATURED BOXES 3 -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="text-center">
                        <i class="ico-light ico-lg ico-rounded ico-hover et-target"></i>
                        <h4>Planejamento</h4>
                        <p>Nossos consultores ajudarão a definir o tempo certo para o sucesso de suas campanhas.</p>

                        {{--<a href="#">--}}
                        {{--Read--}}
                        {{--<!-- /word rotator -->--}}
                        {{--<span class="word-rotator" data-delay="2000">--}}
                        {{--<span class="items">--}}
                        {{--<span>more</span>--}}
                        {{--<span>now</span>--}}
                        {{--</span>--}}
                        {{--</span><!-- /word rotator -->--}}
                        {{--<i class="glyphicon glyphicon-menu-right fs-12"></i>--}}
                        {{--</a>--}}

                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="text-center">
                        <i class="ico-light ico-lg ico-rounded ico-hover et-linegraph"></i>
                        <h4>Acompanhamento</h4>
                        <p>Relatórios online de acompanhamento da sua campanha.</p>

                        {{--<a href="#">--}}
                        {{--Read--}}
                        {{--<!-- /word rotator -->--}}
                        {{--<span class="word-rotator" data-delay="2000">--}}
                        {{--<span class="items">--}}
                        {{--<span>more</span>--}}
                        {{--<span>now</span>--}}
                        {{--</span>--}}
                        {{--</span><!-- /word rotator -->--}}
                        {{--<i class="glyphicon glyphicon-menu-right fs-12"></i>--}}
                        {{--</a>--}}

                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="text-center">
                        <i class="ico-light ico-lg ico-rounded ico-hover et-strategy"></i>
                        <h4>Posicionamento</h4>
                        <p>Sua marca ou produto exposto para o público de alto padrão de um shopping center.</p>

                        {{--<a href="#">--}}
                        {{--Read--}}
                        {{--<!-- /word rotator -->--}}
                        {{--<span class="word-rotator" data-delay="2000">--}}
                        {{--<span class="items">--}}
                        {{--<span>more</span>--}}
                        {{--<span>now</span>--}}
                        {{--</span>--}}
                        {{--</span><!-- /word rotator -->--}}
                        {{--<i class="glyphicon glyphicon-menu-right fs-12"></i>--}}
                        {{--</a>--}}

                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="text-center">
                        <i class="ico-light ico-lg ico-rounded ico-hover et-megaphone"></i>
                        <h4>Marketing</h4>
                        <p>Trabalhamos diretamente com agências se preferir, atendemos tanto clientes finais quanto
                            agências.</p>

                        {{--<a href="#">--}}
                        {{--Read--}}
                        {{--<!-- /word rotator -->--}}
                        {{--<span class="word-rotator" data-delay="2000">--}}
                        {{--<span class="items">--}}
                        {{--<span>more</span>--}}
                        {{--<span>now</span>--}}
                        {{--</span>--}}
                        {{--</span><!-- /word rotator -->--}}
                        {{--<i class="glyphicon glyphicon-menu-right fs-12"></i>--}}
                        {{--</a>--}}

                    </div>
                </div>
            </div>
            <!-- /FEATURED BOXES 3 -->

        </div>
    </section>
    <!-- / -->

    <!-- -->
    <section>
        <div class="container">

            <h2 class="fs-25">Por que escolher a Akhena?</h2>

            <p class="lead">Essa resposta é muito simples, somos focados nos resultados de nossos clientes, e nunca
                paramos de inovar, sempre oferencendo aos nossos clientes o que há de melhor em tecnologia e
                comunicação.</p>

            <div class="mt-60">
                <ul class="nav nav-tabs nav-clean">
                    <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">Alto Impacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Alcance na entrega</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Especializados em Shopping
                    <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab">Rede de Parceiros em todo o Estado</a></li>
                </ul>

                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <img class="float-left" src="{{ getCDN('/img/atonmidia/rolante-pq01.jpg', 'cdn2') }}" width="200" alt=""/>
                        <p>Monitores distribuídos nas áreas de maior impacto, como a espera forçada no hall de espera
                            dos elevadores, em frente a escada rolante, praça de alimentação e dentro dos elevadores.
                        <p>
                        <a href="{{ route('pontos') }}"
                           class="btn btn-reveal btn-default">
                            <i class="fa fa-plus"></i>
                            <span>Mais</span>
                        </a>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <img class="float-right" src="{{ getCDN('/img/atonmidia/rolante-pq02.jpg', 'cdn2') }}" width="200" alt=""/>
                        <p>Os frequentadores do Shopping vem de todas as áreas da grande Porto Alegre, fazendo que o
                            anuncio exibido na rede Akhena seja de grande penetração regional.
                        <p>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <p>O Shopping Total é reconhecidamente um local de altíssima circulação de pessoas, a atenção
                            delas está voltada para aquisição de novas experiências e estão altamente propensas ao
                            consumo.
                        <p>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <p>Para quem quer ainda mais visibilidade a AtonMidia e sua rede de parceiros possuem mais de 100
                            pontos de veiculação em todo o Rio Grande do Sul, solicite informações pelo link de contato no final desta página.
                        <p>
                        <a href="{{ route('pontos') }}"
                           class="btn btn-reveal btn-default">
                            <i class="fa fa-plus"></i>
                            <span>Mais</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- / -->

    <!-- -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h3 class="fs-20">Mais vantagens da nossa rede</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check"></i>As pessoas estão mais abertas para informações nos horários de
                            lazer.
                        </li>
                        <li><i class="fa fa-check"></i>Não existe desperdício de verba do cliente com consumidores
                            desinteressantes
                        </li>
                        <li><i class="fa fa-check"></i>Todo tempo é horário nobre (dia inteiro)</li>
                        <li><i class="fa fa-check"></i>Foco direto no público alvo</li>
                        <li><i class="fa fa-check"></i>Os expectadores podem acompanhar as últimas notícias regionais,
                            nacionais e do mundo em tempo real. Além de claro, assistir seu anúncio.
                        </li>
                        <li><i class="fa fa-check"></i>O gerenciamento dos anúncios pode ser realizado a qualquer hora
                            em tempo real.
                        </li>
                        <li><i class="fa fa-check"></i>A veiculação dos anúncios é feita em ambientes com alto padrão de
                            acabamento e locais bem frequentados, valorizando seus anúncios.
                        </li>

                    </ul>
                </div>

                <div class="col-md-6">
                    <h3 class="fs-20 text-center">O que dizem nossos clientes?</h3>
                    <!--
                        Note: remove class="rounded" from the img for squared image!
                    -->
                    <ul class="row clearfix testimonial-dotted list-unstyled">
                        <li class="col-md-6">
                            <div class="testimonial">
                                {{--<figure class="float-left">--}}
                                    {{--<img class="rounded"--}}
                                         {{--src="https://cdn7.kreaturamedia.com/wp-content/uploads/2016/10/happy-girl.jpg"--}}
                                         {{--alt=""/>--}}
                                {{--</figure>--}}
                                <div class="fs-11">
                                    <p>Anunciamos continuamente com a Akhena, quem frequenta um Shopping Center é
                                        exatamente o público que buscamos!</p>
                                    <cite>
                                        Tatiane
                                        <span>VitaQuali</span>
                                    </cite>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <div class="testimonial">
                                {{--<figure class="float-left">--}}
                                    {{--<img class="rounded"--}}
                                         {{--src="https://cdn7.kreaturamedia.com/wp-content/uploads/2016/10/happy-girl.jpg"--}}
                                         {{--alt=""/>--}}
                                {{--</figure>--}}
                                <div class="fs-11">
                                    <p>A facilidade em realizar a troca de produtos dentro de uma mesma campanha nos
                                        conquistou,
                                        temos campanhas dinâmicas com atualizações frequentes, em pouco tempo nosso novo
                                        vídeo já está no ar!</p>
                                    <cite>
                                        Ana Brock
                                        <span>Dimed</span>
                                    </cite>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <!-- / -->

    <div class="callout alert b-0 rad-0 m-0 alert-success ">

        <div class="text-center">

            <h3>Ligue agora para <span><strong>+55 (51) 3377-8830</strong></span>, será um prazer falar com você!</h3>
            <p class="font-lato fs-20">
                Aproveite esta oportunidade!
            </p>

            <a href="/contato" class="btn btn-primary btn-lg mt-30">ENTRE EM CONTATO</a>

        </div>

    </div>
    {{--<div class="alert alert-success bordered-bottom m-0">--}}
    {{--<div class="container">--}}

    {{--<div class="row">--}}

    {{--<div class="col-md-9 col-sm-12"><!-- left text -->--}}
    {{--<h3>Ligue agora para <span><strong>+55-51-33778830</strong></span> será um prazer falar com você!</h3>--}}
    {{--<p class="font-lato fw-300 fs-20 mb-0">--}}
    {{--Nós realmente acreditamos nos nossos produtos--}}
    {{--</p>--}}
    {{--</div><!-- /left text -->--}}


    {{--<div class="col-md-3 col-sm-12 text-right"><!-- right btn -->--}}
    {{--<a href="{{route('contato')}}" rel="nofollow" target="_blank" class="btn btn-success btn-lg">Entre em Contato</a>--}}
    {{--</div><!-- /right btn -->--}}

    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
    <!-- /CALLOUT -->
    <!-- BUTTON CALLOUT -->
    {{--<a href="#purchase" rel="nofollow" target="_blank" class="btn btn-xlg btn-success fs-20 fullwidth m-0 rad-0 p-40">--}}
    {{--<span class="font-lato fs-30">--}}
    {{--Did Smarty convinced you?--}}
    {{--<strong>Purchase now &raquo;</strong>--}}
    {{--</span>--}}
    {{--</a>--}}
    <!-- /BUTTON CALLOUT -->
@endsection

@section('page-scripts')
    <script type='text/javascript' data-cfasync="false" src={{ getCDN('/_frontend/js/plugins/layerslider/js/greensock.js', 'cdn2') }}></script>
    <script type='text/javascript' data-cfasync="false" src={{ getCDN('/_frontend/js/plugins/layerslider/js/layerslider.kreaturamedia.jquery.js', 'cdn2') }}></script>
    <script type='text/javascript' data-cfasync="false" src={{ getCDN('/_frontend/js/plugins/layerslider/js/layerslider.transitions.js', 'cdn2') }}></script>


    <script>
        jQuery("#layerslider").layerSlider({
            responsive: false,
            responsiveUnder: 1280,
            layersContainer: 1280,
            navButtons: false,
            navPrevNext: false,
            navStartStop: false,
            width: 600,
            pauseOnHover: false,
            autoPlayVideos: false,
            skinsPath: '_frontend/js/plugins/layerslider/skins/'
        });
    </script>

@endsection
