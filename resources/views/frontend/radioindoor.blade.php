@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Rádio Indoor para seu negócio, rádio online e aplicativo offline que nunca para, mesmo sem internet!')

@section('page-meta')

    <link rel="canonical" href="{{route('radioindoor')}}" />
    <meta property="og:url" content="{{route('radioindoor')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Conheça a Rádio Indoor Akhena, rádio online e aplicativo para rádio offline que nunca para, mesmo sem internet!" />
    <meta name="twitter:title" content="Conheça a Rádio Indoor Akhena, rádio online e aplicativo para rádio offline que nunca para, mesmo sem internet!" />

    <meta name="description" content="Nossa Rádio Indoor além da tradicional opção online você tem a opção de contratar a Rádio offline, é um aplicativo windows que sincroniza sua programação e roda mesmo sem internet.">
    <meta property="og:description" content="Nossa Rádio Indoor além da tradicional opção online você tem a opção de contratar a Rádio offline, é um aplicativo windows que sincroniza sua programação e roda mesmo sem internet." />
    <meta name="twitter:description" content="Nossa Rádio Indoor além da tradicional opção online você tem a opção de contratar a Rádio offline, é um aplicativo windows que sincroniza sua programação e roda mesmo sem internet." />

    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    <meta property="og:image" content="{{ asset('img/atonmidia/radioindoor2.jpg') }}" />
    <meta name="twitter:image:src" content="{{asset('img/atonmidia/atonmidia-servicos1x1.jpg')}}" />

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
                <li><a href="#">Produtos</a></li>
                <li class="active">Rádio Indoor</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>

        <div id="layerslider" style="height:450px;width: 800px; ">

                {{-- slider 1--}}
                <div class="ls-slide" data-ls="slidedelay:12000;transition2d:4; fadein:true;">
                    {{--<img src="{{ asset('_frontend/layerslider-radioindoor/bg_1.png') }}" class="ls-bg" alt="Slide background" />--}}
                    <p class="ls-l" style="top:50%;left:50%;font-weight: 300; background: white; background: rgba(255,255,255,.2);height:60px;padding-right:10px;padding-left:10px;font-size:50px;line-height:57px;color:#ffe9db;white-space: nowrap;" data-ls="offsetxin:0;rotatexin:-70;scalexin:3;scaleyin:3;offsetxout:0;durationout:1000;showuntil:1000;rotatexout:70;scalexout:0.5;scaleyout:0.5;">
                        Procurando Rádio Indoor Online e Offline?
                    </p>
                    <p class="ls-l" style="top:35%;left:50%;font-weight: 300;font-size:30px;color:#ffffff;white-space: nowrap;" data-ls="delayin:2000;offsetxin:50;durationin:750;easingin:easeOutBack;skewxin:-50;offsetxout:-50;durationout:600;showuntil:500;easingout:easeInBack;skewxout:50;">
                        Apresentamos
                    </p>
                    <p class="ls-l ls-shadow" style="top:50%;left:50%;font-weight: 300;font-size:50px;color:#ffffff;white-space: nowrap;" data-ls="delayin:2500;offsetxin:-100;durationin:750;easingin:easeOutBack;skewxin:-50;offsetxout:100;durationout:600;showuntil:500;easingout:easeInBack;skewxout:50;">
                        Um novo conceito em Rádio Interna
                    </p>
                    {{--<img class="ls-l" style="top:30%;left:50%;width:120%;height:auto;white-space: nowrap;" data-ls="offsetxin:-100;durationin:2000;delayin:1500;offsetxout:-100;durationout:1000;parallaxlevel:-2;" src="assets/sliderimages/slide-b-1.png" alt=""><img class="ls-l" style="top:353px;left:237px;white-space: nowrap;" data-ls="offsetxin:50;durationin:2000;delayin:1500;offsetxout:50;durationout:1000;parallaxlevel:1;" src="assets/sliderimages/slide-b-2.png" alt=""><img class="ls-l" style="top:453px;left:483px;white-space: nowrap;" data-ls="offsetxin:100;durationin:2000;delayin:1500;offsetxout:100;durationout:1000;parallaxlevel:3;" src="assets/sliderimages/slide-b-3.png" alt=""><img class="ls-l" style="top:456px;left:586px;white-space: nowrap;" data-ls="offsetxin:150;durationin:2000;delayin:1500;offsetxout:150;durationout:1000;parallaxlevel:5;" src="assets/sliderimages/slide-b-4.png" alt=""><img class="ls-l" style="top:421px;left:659px;white-space: nowrap;" data-ls="offsetxin:200;durationin:2000;delayin:1500;offsetxout:200;durationout:1000;parallaxlevel:7;" src="assets/sliderimages/slide-b-5.png" alt="">--}}
                    <p class="ls-l" style="top:50%;left:590px;font-weight: 500;font-size:40px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:4000;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:1500;showuntil:1000;rotateyout:-90;transformoriginout:left 50% 0;">
                        Fortaleça a identidade
                        <br> da sua empresa!</p>
                    <img class="ls-l" style="top:50%;left:150px;width:400px;height:25%;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:4000;rotateyin:90;transformoriginin:right 50% 0;offsetxout:0;durationout:1500;showuntil:1000;rotateyout:-90;transformoriginout:right 50% 0;" src="{{ getCDN('_frontend/layerslider-radioindoor/logo_radio.png') }}" alt="">

                    <p class="ls-l" style="top:60%;left:50px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#849e00;background:#ffffff;border-radius:4px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:7000;rotatein:-45;rotateyin:-1;scalexin:0.5;scaleyin:0.5;transformoriginin:left bottom 0;offsetxout:0;durationout:1000;rotateout:45;scalexout:2;scaleyout:2;transformoriginout:right bottom 0;">
                        Sua Rádio em qualquer lugar
                    </p>
                    <p class="ls-l" style="top:70%;left:50px;font-weight: 500;font-size:30px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:7500;rotatein:-45;scalexin:2;scaleyin:2;transformoriginin:right top 0;offsetxout:0;durationout:1000;rotateout:45;scalexout:2;scaleyout:2;transformoriginout:left top 0;">
                        e sempre no AR!
                    </p>
                    <img class="ls-l" style="top:40%;left:60%;white-space: nowrap;width:500px;height:70%;" data-ls="delayin:7400;durationin:1500;showuntil:3000;scalexin:0.8;scaleyin:0.8;scalexout:0.8;scaleyout:0.8;" src="{{ getCDN('_frontend/layerslider-radioindoor/radio.png') }}" alt="">
                    <p class="ls-l" style="top:80%;left:59%;font-weight: 300; text-align: center;width:260px;height:40px;padding:5px;font-size:30px;line-height:37px;color:#ffffff;background:#f06a52;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:8500;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% top 0;offsetxout:0;showuntil:800;durationout:1000;rotatexout:90;transformoriginout:50% top 0;">
                        LANÇAMENTO!
                    </p>
                </div>

                {{-- slide 2--}}
                <div class="ls-slide" data-ls="slidedelay:11000;transition2d:75,79;">
{{--                    <img src="{{ getCDN('_frontend/layerslider-radioindoor/bg_2.png') }}" class="ls-bg" alt="Slide background" />--}}
                    {{--<img class="ls-l" style="top:0px;left:0px;white-space: nowrap;opacity: .5;" data-ls="offsetxin:0;durationin:1000;easingin:linear;offsetxout:0;durationout:6000;showuntil:2;easingout:linear;" src="{{ getCDN('_frontend/layerslider-radioindoor/bg_1.png') }}" alt="">--}}

                    <h1 class="ls-l" style="top:60px;left:800px;font-weight: 300;font-size:40px;color:#d4eaff;white-space: nowrap;" data-ls="offsetxin:50;durationin:2000;rotateyin:60;transformoriginin:right 50% 0;offsetxout:-50;durationout:2000;showuntil:7000;rotateyout:-60;transformoriginout:left 50% 0;">
                        Akhena Rádio</h1>
                    <h2 class="ls-l" style="top:100px;left:801px;font-weight: 500;font-size:30px;color:#fa6b4b;white-space: nowrap;" data-ls="offsetxin:-50;durationin:2000;delayin:500;rotateyin:-60;transformoriginin:left 50% 0;offsetxout:50;durationout:2000;showuntil:7000;rotateyout:60;transformoriginout:right 50% 0;">
                        características</h2>

                    <img class="ls-l" style="top:50%;left:20%;white-space: nowrap;" data-ls="offsetxin:0;durationin:750;delayin:1300;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:750;rotateyout:90;transformoriginout:left -50% 0;" src="{{ getCDN('_frontend/layerslider-radioindoor/login_radio.png') }}" alt="">

                    {{--<h1 class="ls-l" style="font-family: Oswald; top:15%;left:20%;font-weight: 500; text-align: center; width:340px;font-size:60px;color:#01a10c;border-radius:5px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:3000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotateout:-90;transformoriginout:left bottom 0;">--}}
                    {{--Produto Exclusivo</h1>--}}
                    <p class="ls-l" style="top:150px;left:450px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;" data-ls="durationin:1500;delayin:3300;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">
                        Rádio Offline
                    </p>
                    <p class="ls-l" style="top:190px;left:450px;font-weight: 300;font-size:24px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:3700;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">
                        Aplicativo exclusivo, sua Rádio sempre no AR.
                    </p>
                    <p class="ls-l" style="top:250px;left:450px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;" data-ls="durationin:1500;delayin:4000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">
                        Rádio Online
                    </p>
                    <p class="ls-l" style="top:290px;left:450px;font-weight: 300;font-size:24px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:4400;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">
                        Players para todas plataformas.
                    </p>
                    <p class="ls-l" style="top:350px;left:450px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#fa6b4b;border-radius:4px;white-space: nowrap;" data-ls="durationin:1500;delayin:4700;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;">
                        Gerenciável pelo cliente.
                    </p>
                    <p class="ls-l" style="top:390px;left:450px;font-weight: 300;font-size:24px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:5100;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;">
                        Você mesmo altera suas playlists se desejar.
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
                    {{--<img src="getCDNs/sliderimages/bg4.jpg" class="ls-bg" alt="Slide background" />--}}
                    <p class="ls-l" style="top:-17px;left:915px;opacity: .3; font-weight: 300;font-size:200px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;easingin:linear;scalexin:1;scaleyin:1;offsetxout:0;durationout:2000;showuntil:1000;easingout:linear;scalexout:3;scaleyout:3;">
                        +
                    </p>
                    <h1 class="ls-l" style="top:60px;left:700px;font-weight: 300;font-size:40px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:50;durationin:3000;rotateyin:60;transformoriginin:right 50% 0;offsetxout:-50;durationout:3000;showuntil:400;rotateyout:-60;transformoriginout:left 50% 0;">
                        FACILIDADE</h1>
                    <h2 class="ls-l" style="top:100px;left:701px;font-weight: 500;font-size:30px;color:#286e89;white-space: nowrap;" data-ls="offsetxin:-50;durationin:3000;delayin:500;rotateyin:-60;transformoriginin:left 50% 0;offsetxout:50;durationout:3000;showuntil:1;rotateyout:60;transformoriginout:right 50% 0;">
                        de uso.. </h2>
                    <h1 class="ls-l" style="top:357px;left:688px;font-weight: 300;height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#ffffff;background:#29768f;border-radius:4px;white-space: nowrap;" data-ls="offsetxin:0;durationin:4000;delayin:2000;rotateyin:450;transformoriginin:right 50% 0;offsetxout:0;durationout:500;showuntil:1;easingout:easeInBack;rotateyout:-90;transformoriginout:right 50% 0;">
                        Música </h1>
                    <h3 class="ls-l" style="top:377px;left:800px;font-weight: 300;font-size:60px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:4000;delayin:2000;rotateyin:450;transformoriginin:left 50% 0;offsetxout:0;durationout:500;showuntil:1;easingout:easeInBack;rotateyout:90;transformoriginout:left 50% 0;">
                        Ambiente</h3>
                    <h1 class="ls-l" style="top:161px;left:667px;font-weight: 300; text-align: right;font-size:30px;color:#ffffff;white-space: nowrap;" data-ls="showuntil:2000;offsetxin:0;durationin:2000;delayin:6500;easingin:easeOutElastic;rotateyin:-90;transformoriginin:right 50% 0;offsetxout:0;durationout:500;rotateyout:-90;transformoriginout:right 50% 0;"><span style="color: #286e89;">
                            SPOTS</span> e</h1>
                    <h3 class="ls-l" style="top:200px;left:667px;font-weight: 300;font-size:30px;color:#ffffff;white-space: nowrap;" data-ls="showuntil:2000;offsetxin:0;durationin:2000;delayin:6500;easingin:easeOutElastic;rotateyin:90;transformoriginin:left 50% 0;offsetxout:0;durationout:500;rotateyout:90;transformoriginout:left 50% 0;"><span style="color: #286e89;">
                            Vinhetas</span><br>
                        <span style="color:#9e4e3b;">produzimos para você.</span></h3>

                    <img class="ls-l" style="top:100px;left:-82px;width:765px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:1000;offsetxout:-100;offsetyout:50;durationout:2000;showuntil:2010;" src="{{ getCDN('_frontend/layerslider-radioindoor/slide-a-1.png') }}" alt="">
                    {{--<img class="ls-l" style="top:495px;left:135px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:1000;offsetxout:-100;offsetyout:50;durationout:2000;showuntil:2010;" src="getCDNs/sliderimages/slide-a-2.png" alt="">--}}
                    <img class="ls-l" style="top:155px;left:130px;height:350px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:1000;offsetxout:0;durationout:1500;showuntil:1500;scalexout:1.2;scaleyout:1.2;" src="{{ getCDN('_frontend/layerslider-radioindoor/radio_tablet.png') }}" alt="">
                    {{--<img class="ls-l" style="top:275px;left:135px;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:3500;scalexin:1.5;scaleyin:1.5;offsetxout:-100;offsetyout:50;durationout:2000;showuntil:1;" src="getCDNs/sliderimages/slide-a-4.png" alt="">--}}

                    {{--<img class="ls-l" style="top:376px;left:236px;white-space: nowrap;" data-ls="offsetxin:0;durationin:1;delayin:4498;offsetxout:0;durationout:750;showuntil:1;easingout:easeOutSine;scalexout:10;scaleyout:10;" src="{{ getCDN('_frontend/layerslider-radioindoor/slide-a-6.png') }}" alt="">--}}
                    {{--  mão clicando--}}
                    <img class="ls-l" style="top:375px;left:200px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:bottom;delayin:3500;offsetxout:0;offsetyout:bottom;durationout:1000;showuntil:1;" src="{{ getCDN('_frontend/layerslider-radioindoor/slide-a-5.png') }}" alt="">


                    <img class="ls-l" style="top:150px;left:25%;white-space: nowrap;" data-ls="offsetxin:-100;delayin:7000;easingin:easeInOutCubic;rotatein:-180;offsetxout:300;durationout:500;showuntil:2500;easingout:easeInOutCubic;rotateout:360;" src="{{ getCDN('_frontend/layerslider-radioindoor/youtube-color.png') }}" alt="">
                    <p class="ls-l" style="top:300px;left:100px; text-align: center; font-weight: 500; opacity: .75;font-size:24px;line-height:25px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;delayin:7000;showuntil:2500;scalexin:2;scaleyin:2;offsetxout:0;durationout:500;scalexout:2;scaleyout:2;">
                        Baixe seus clipes preferidos
                        <br> diretamente do youtube para sua Rádio.
                    </p>
                </div>

                {{-- slide--}}

                <div class="ls-slide" data-ls="slidedelay:8000;transition2d:21,105;timeshift:-1000;">
{{--                    <img src="{{ getCDN('_frontend/layerslider-radioindoor/bg6b.jpg') }}" class="ls-bg" alt="Slide background" />--}}
                    <img class="ls-l" style="top:55px;left:50%;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:4000;easingin:linear;scalexin:0;scaleyin:0;offsetxout:0;durationout:1500;showuntil:1;easingout:linear;scalexout:2;scaleyout:2;" src="{{ getCDN('_frontend/layerslider-radioindoor/circle.png') }}" alt="">
                    <img class="ls-l" style="top:55px;left:50%;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:4500;easingin:linear;scalexin:0;scaleyin:0;offsetxout:0;durationout:1500;showuntil:1;easingout:linear;scalexout:2;scaleyout:2;" src="{{ getCDN('_frontend/layerslider-radioindoor/circle.png') }}" alt="">
                    <p class="ls-l" style="top:234px;left:56px;font-weight: 300; opacity: .4;font-size:200px;color:#f06a52;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:1000;scalexin:0;scaleyin:0;offsetxout:0;scalexout:0;scaleyout:0;">
                        +
                    </p>
                    <p class="ls-l" style="top:220px;left:20px;font-weight: 300; background: white; background: rgba(255,255,255,.85);height:40px;padding-right:10px;padding-left:10px;font-size:30px;line-height:37px;color:#bd5949;white-space: nowrap;" data-ls="offsetxin:-50;durationin:2000;delayin:1000;offsetxout:-50;durationout:1000;">
                        Sempre em busca
                    </p>
                    <p class="ls-l" style="top:260px;left:173px;font-weight: 500;font-size:30px;color:#bd5949;white-space: nowrap;" data-ls="offsetxin:50;delayin:2000;skewxin:-60;offsetxout:-50;durationout:1000;skewxout:-60;">
                        de mais recursos!
                    </p>
                    <p class="ls-l" style="top:220px;left:863px;font-weight: 500; text-align: right;font-size:30px;color:#bd5949;white-space: nowrap;" data-ls="offsetxin:0;delayin:2500;rotatein:90;transformoriginin:right bottom 0;offsetxout:0;durationout:1500;transformoriginout:right bottom 0;">
                        ...para oferecer
                    </p>
                    <p class="ls-l" style="top:260px;left:740px;font-weight: 300; text-align: right;width:260px;height:40px;padding-right:10px;font-size:30px;line-height:37px;color:#ffffff;background:#f06a52;white-space: nowrap;" data-ls="offsetxin:0;durationin:2500;delayin:3250;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% top 0;offsetxout:0;durationout:1000;rotatexout:90;transformoriginout:50% bottom 0;">
                        A MELHOR
                    </p>
                    <p class="ls-l" style="top:305px;left:733px;font-family:'Indie Flower';font-size:30px;color:#d9482b;white-space: nowrap;" data-ls="offsetxin:-50;delayin:3500;skewxin:60;scalexin:1.5;offsetxout:-50;durationout:1000;skewxout:60;scalexout:1.5;">
                        Rádio Interna!
                    </p>

                    <img class="ls-l" style="top:150px;left:50%;width:200px;white-space: nowrap;" data-ls="durationin:1500;delayin:1500;scalexin:0.2;scaleyin:0.2;scalexout:0.3;scaleyout:0.3;" src="{{ getCDN('_frontend/layerslider-radioindoor/logo_radio.png') }}" alt="">
                    <img class="ls-l" style="top:200px;left:53%;width:100px;white-space: nowrap;" data-ls="durationin:1500;delayin:1500;scalexin:0.2;scaleyin:0.2;scalexout:0.3;scaleyout:0.3;" src="{{ getCDN('_frontend/layerslider-radioindoor/caixa.png') }}" alt="">
                    <img class="ls-l" style="top:195px;left:47%;width:100px;white-space: nowrap;" data-ls="durationin:1500;delayin:1500;scalexin:0.2;scaleyin:0.2;scalexout:0.3;scaleyout:0.3;" src="{{ getCDN('_frontend/layerslider-radioindoor/faixa-som.png') }}" alt="">
                </div>
            </div>


        <div class="container">
            <div class="heading-title">
                <h3>
                    Comunicação
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>Interna</span>
				            <span>Inteligente</span>
				            <span>Eficaz</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>

            <h1 class="fs-17">Rádio criada para o ambiente da sua empresa. Resultando em um canal direto de comunicação com os colaboradores.
                A Rádio Interna oferece uma variedade de programações musicais que se adaptam ao perfil dos consumidores e proporcionando um ambiente agradável aos funcionários, clientes e fornecedores.
            </h1>

            <div class="divider divider-center divider-color"><!-- divider -->
                <i class="fa fa-chevron-down"></i>
            </div>

            <!-- BORN TO BE A WINNER -->
            <article class="row">
                <div class="col-md-6">
                    <div class="heading-title">
                        <h3>
                            A Rádio Indoor e seu
                            <span class="word-rotator" data-delay="2000">
                                <span class="items">
                                    <span>poder</span>
                                    <span>alcance</span>
                                    <span>diferencial</span>
                                </span>
                            </span><!-- /word rotator -->
                        </h3>
                    </div>
                    <p>Desenvolvemos e gerenciamos verdadeiras estações de rádio para o ponto de venda (PDV), através da criação de uma programação musical voltada para o público alvo da “marca” além de
                        vinhetas e spots comerciais que ajudarão a alavancar as vendas e a comunicação com o público consumidor. Com a Rádio Interna, a incessante batalha do ponto-de-venda para fazer com que o
                        consumidor decida qual produto comprar, ganhou uma arma infalível. Sucesso absoluto, a rádio é capaz de atingir o consumidor na hora da compra. Criamos uma Rádio sob medida, seus intervalos
                        comerciais com spots publicitários de produtos disponíveis na loja.
                    </p>

                </div>

                <div class="col-md-6">
                    <!-- OWL SLIDER -->
                    <div class="owl-carousel buttons-autohide controlls-over m-0" data-plugin-options='{"items": 1, "autoHeight": true, "navigation": true, "pagination": true, "transitionStyle":"backSlide", "progressBar":"true"}'>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('img/atonmidia/radioindoor1.jpg', 'cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('img/atonmidia/radioindoor2.jpg', 'cdn2') }}" alt="">
                        </div>

                        <div>
                            <img class="img-fluid" src="{{ getCDN('img/atonmidia/radioindoor3.jpg', 'cdn2') }}" alt="">
                        </div>
                        {{--<div>--}}
                            {{--<img class="img-fluid" src="img/atonmidia/tvcorporativa2.jpg" alt="">--}}
                        {{--</div>--}}

                    </div>
                    <!-- /OWL SLIDER -->
                </div>

            </article>
            <h3><span>Vendas</span> com sua Rádio Indoor</h3>
            <p>Através do anuncio de ofertas você estimula a permanência de seus clientes no seu estabelecimento, potencializando suas vendas. É muito importante para conseguir a
                atenção do consumidor investir em música. Para isso oferecemos serviço profissional na gravação de vinhetas, comerciais e toda a produção musical da Sua Rádio.
                Lembrando que conforme pesquisas internacionais, o som adequado no ambiente pode aumentar em até 15% a permanência do consumidor no estabelecimento comercial.
                E quanto mais tempo mais produtos ele compra. Se entre uma canção e outra o consumidor ouvir o anúncio de algum produto vendido no local, então, nem se fala.
                Em vez de anúncio de bancos, automóveis, e até da concorrência, o consumidor ouve a propaganda da sua loja e de seus produtos.
            </p>

            <h3><span>Entretenimento</span> na Rádio Indoor</h3>
            <p>Através de estudo do público alvo e da marca, criamos uma programação musical para o PDV/loja/espaço que traduza fielmente o conceito da marca, aproximando-a do público consumidor.
            </p>
            <!-- /BORN TO BE A WINNER -->

        </div>
    </section>
    <!-- -->

    <!-- -->
    <section>
        <div class="container fs-14">
            <h3 class="fs-20">Mais <span>vantagens</span> da Rádio Indoor Akhena</h3>
            <div class="row">

                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check"></i> Estabelecer um canal de comunicação interna eficiente</li>
                        <li><i class="fa fa-check"></i> Promover ações internas e externas da empresa entre colaboradores</li>
                        <li><i class="fa fa-check"></i> Fomentar o alinhamento estratégico da empresa</li>
                        <li><i class="fa fa-check"></i> Divulgação mais dinâmica e atrativa das informações</li>
                        <li><i class="fa fa-check"></i> Trabalhar sua marca e a imagem institucional da empresa</li>
                        <li><i class="fa fa-check"></i> Eficiência em campanhas de EndoMarketing</li>
                    </ul>
                </div>

                <div class="col-md-6">

                    <ul class="list-unstyled">
                        <li><i class="fa fa-check"></i> Controle rápido e seguro para gerenciamento de conteúdo</li>
                        <li><i class="fa fa-check"></i> Programação personalizada de acordo com identidade visual da empresa</li>
                        <li><i class="fa fa-check"></i> Promover a motivação e a qualidade de trabalho dos colaboradores</li>
                        <li><i class="fa fa-check"></i> Interligação com representantes, escritórios comerciais, matrizes e filiais</li>
                        <li><i class="fa fa-check"></i> Maior agilidade na disseminação de todo tipo de informação (Gerencial, Metas, Visão, Missão)</li>
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
            width:600,
            pauseOnHover: false,
            autoPlayVideos: false,
            skinsPath: '_frontend/js/plugins/layerslider/skins/'
        });
    </script>



@endsection
