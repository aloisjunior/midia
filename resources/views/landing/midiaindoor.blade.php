@extends('layouts.landing.master')


@section('page-title', 'Akhena - Midia Digital Indoor')

@section('page-meta')
    <link rel="canonical" href="{{route('landing.midiaindoor', ['account'=>'pages'])}}"/>
    <meta property="og:url" content="{{route('landing.midiaindoor', ['account'=>'pages'])}}"/>

    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:title" content="Akhena - Midia Digital Indoor"/>
    <meta name="twitter:title" content="Akhena - Midia Digital Indoor"/>

    <meta name="description"
          content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor.">
    <meta property="og:description"
          content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor."/>
    <meta name="twitter:description"
          content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor."/>
    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901"/>


    <meta property="og:site_name" content="Akhena - Ampliando Resultados com Tecnologia"/>
    <meta property="og:image" content="{{ asset('/img/atonmidia/atonmidia-midiaindoor.jpg') }}"/>
    <meta name="twitter:image:src" content="{{ asset('/img/atonmidia/atonmidia-midiaindoor1x1.jpg') }}"/>

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@atonmidia"/>
    <meta name="twitter:domain" content="{{ route('inicio') }}"/>
    <meta name="twitter:creator" content="@atonmidia"/>
@endsection


@section('page-css')
    <link href="{{ getCDN('_frontend/js/plugins/layerslider/css/layerslider.css', 'cdn2') }}" rel="stylesheet"
          type="text/css">
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

    <section class="page-header aton-page-header-landing " id="apresentacao">

        <header class="text-center">
            <h2 class="m-0">Anunciar em mídia digital indoor nunca foi tão
                <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>acessível</span>
				            <span>fácil</span>
				            <span>desejado</span>
                            <span>moderno</span>
                        </span>
                    </span><!-- /word rotator -->
            </h2>

            <h3>
            <span class="word-rotator" data-delay="3000">
                    <span class="items">
                        <span>Seu anúncio no Shopping Total de Porto Alegre</span>
                        <span>O único shopping com mídia digital indoor </span>
                        <span>O local mais desejado de Porto Alegre para anunciar</span>
                        <span>O Shopping Total tem um espaço para seu anúncio</span>
                    </span>
            </span><!-- /word rotator -->
            </h3>
        </header>
    </section>



    <section class="page-header aton-page-header-landing ">
        <div class="container">

            <div class="row text-center">

                <!-- LEFT -->
                <div class="col-md-6 col-sm-6 offset-lg-3 offset-md-3 offset-sm-3">

                    <div class="mb-20">
                        <div class="embed-responsive embed-responsive-16by9">
                            {{-- configuração de embed colocadas diretamente no campo--}}
                            <iframe class="embed-responsive-item" width="560" height="315"
                                    src="https://www.youtube.com/embed/ttp7U0ONCK0?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">

            <div class="text-center">
                <h3 class="fs-30">Participe da exclusividade de anunciar em Shopping Center</h3>
                <p>Conheça nossa rede e peça já seu orçamento</p>
            </div>

        </div>
    </section>


    <!-- /PAGE HEADER -->

    <div id="pontos"></div>


    <!-- -->
    <section class="page-header aton-page-header-landing ">

        <div class="container">

            <p class="lead"></p>

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
                            <a href="#contato" class="btn btn-featured btn-danger">
                                <span>QUERO UM ORÇAMENTO</span>
                                <i class="et-megaphone"></i>
                            </a>
                        </div>
                        <div class="col-sm-2">

                        </div>
                    </div>


                </div>
                <div class="col-md-6">

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

                    {{--<h3>Anunciar em Shopping Center: A melhor opção</h3>--}}
                    <p>Estamos com nossa grade aberta para novos anunciantes nos monitores internos do <strong>Shopping
                            Total de Porto Alegre</strong>
                    </p>

                    <p>Mídia Digital Indoor é a forma inteligente de atingir o consumidor no momento certo, no momento
                        da sua decisão de compra.
                        <br>
                        E o melhor lugar para veicular uma campanha de Mídia Digital Indoor é um Shopping Center, que
                        reúne todos os requisitos de sucesso para uma campanha publicitária.
                    </p>
                    <p>Aproveite a oportunidade de ter seu anúncio veiculado no único shopping de Porto Alegre com
                        monitores digitais disponíveis para anunciantes.
                    </p>


                </div>
            </article>
            <!-- /BORN TO BE A WINNER -->

        </div>
    </section>
    <!-- / -->

    <!-- -->
    <section class="page-header aton-page-header-landing ">
        <div class="container">
            <!-- FEATURED BOXES 3 -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box-static box-border-top p-30 relative">
                        <div class="ribbon"><!-- ribbon inside relative box -->
                            <div class="ribbon-inner">Exclusivo</div>
                        </div><!-- /ribbon -->

                        <div class="box-title mb-30">
                            <h2 class="fs-20">Aproveite esta grande oportunidade de anunciar com exclusividade</h2>
                        </div>

                        O Shopping Total é reconhecidamente um local de <span>altíssima circulação de pessoas</span>, a atenção delas está
                        voltada para aquisição de novas experiências e estão altamente propensas ao consumo.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-header aton-page-header-landing ">
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
                        <p>O melhor resultado para suas campanhas você encontra anunciando no Shopping Total
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

    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">

            <div class="text-center">
                <h3 class="fs-30">Nós levamos seu anúncio para os monitores do Shopping Total</h3>
                <p class="lead">São 23 pontos de veiculação, com isso oferecemos grandes resultados aos nossos clientes,
                    e nunca
                    paramos de inovar, sempre oferencendo o que há de melhor em tecnologia e comunicação.</p>
            </div>

        </div>
    </section>

    <section class="page-header aton-page-header-landing ">
        <div class="container">
            {{--<h2 class="fs-25">Por que escolher a Akhena?</h2>--}}

            {{--<p class="lead">Essa resposta é muito simples, somos focados nos resultados de nossos clientes, e nunca--}}
            {{--paramos de inovar, sempre oferencendo aos nossos clientes o que há de melhor em tecnologia e--}}
            {{--comunicação.</p>--}}

            <div class="mt-30">
                <ul class="nav nav-tabs nav-clean">
                    <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">Alcance na entrega com Alto Impacto </a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab">Temos mais de 100 pontos para anúncios no Estado</a></li>
                </ul>

                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <div class="row ">
                            <!-- tabs content -->
                            <div class="col-md-3 col-sm-3">
                                <div class="tab-content tab-stacked nav-alternate">
                                    <div id="tab_mi" class="tab-pane active">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="thumbnail mb-8 radius-0">
                                                <!--
                                                    IMAGE ZOOM

                                                    data-mode="mouseover|grab|click|toggle"
                                                -->
                                                <figure id="zoom-primary" class="zoom" data-mode="mouseover">
                                                    <!--
                                                        zoom buttton

                                                        positions available:
                                                            .bottom-right
                                                            .bottom-left
                                                            .top-right
                                                            .top-left
                                                    -->
                                                    <a class="lightbox bottom-right"
                                                       href="img/atonmidia/pontosveiculacao1.jpg"
                                                       data-plugin-options='{"type":"image", "gallery": {"enabled": true}}'>
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                    <!--
                                                        image

                                                        Extra: add .image-bw class to force black and white!
                                                    -->
                                                    <img class="img-fluid"
                                                         src="img/atonmidia/pontosveiculacao1.jpg" width="568" alt=""/>
                                                </figure>

                                            </div>

                                            <!--
                                                Thumbnails (required height:100px)

                                                data-for = figure image id match

                                                NOTE: 	loop wil cause an issue to zoom plugin!
                                                        DO NOT use loop!
                                            -->

                                            <div data-for="zoom-primary" class="owl-carousel-2 zoom-more" data-plugin-options='{
                                                                                "responsiveBaseElement":	"#wrapper",
                                                                                "loop":						false,
                                                                                "margin":					8,

                                                                                "nav":						true,
                                                                                "dots":						false,

                                                                                "center":					false,
                                                                                "slideBy":					"1",
                                                                                "autoplay":					false,
                                                                                "autoplayTimeout":			4500,
                                                                                "autoWidth":				false,
                                                                                "merge":					true,
                                                                                "rtl":						false,

                                                                                "animateIn":				"",
                                                                                "animateOut":				"",

                                                                                "responsive": {
                                                                                    "0":	{"items":3},
                                                                                    "960":	{"items":5}
                                                                                }

                                                                            }'>
                                                <a class="thumbnail radius-0 active"
                                                   href="img/atonmidia/pontosveiculacao1.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao1.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao2.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao2.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao3.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao3.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao4.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao4.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao5.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao5.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao6.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao6.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                                <a class="thumbnail radius-0" href="img/atonmidia/pontosveiculacao7.jpg">
                                                    <img class="img-fluid p-3" src="img/atonmidia/pontosveiculacao7.jpg"
                                                         height="100" alt=""/>
                                                </a>
                                            </div>
                                            <!-- /Thumbnails -->

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <p>Monitores distribuídos nas áreas de maior impacto, como a espera forçada no hall de espera
                                dos elevadores, em frente a escada rolante, praça de alimentação e dentro dos elevadores.
                                </p>
                                <p>Conheça nossa rede de Shoppings e anuncie seu produto ou marca, alta visibilidade a um custo excelente.
                                </p>
                                <p>Os frequentadores do Shopping vem de todas as áreas da grande Porto Alegre, fazendo que o anúncio exibido na rede Akhena seja de grande penetração regional.</p>
                            </div>
                        </div>


                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <p>Para quem quer ainda mais visibilidade a AtonMidia e sua rede de parceiros possuem mais de
                            100
                            pontos de veiculação em todo o Rio Grande do Sul, peça já um orçamento com alcance total no final da página.
                        <p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- / -->

    <!-- -->
    <section class="page-header aton-page-header-landing ">
        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <h3 class="fs-20 text-center">O que dizem nossos clientes?</h3>
                    <!--
                        Note: remove class="rounded" from the img for squared image!
                    -->
                    <div class="row clearfix testimonial-dotted list-unstyled">
                        <div class="col-md-6">
                            <div class="">

                                <div class="fs-13">
                                    <p>Anunciamos continuamente com a Akhena, quem frequenta um Shopping Center é
                                        exatamente o público que buscamos!</p>
                                    <cite>
                                        Tatiane
                                        <span>VitaQuali</span>
                                    </cite>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <div class="fs-13">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="contato"></div>
    </section>
    <!-- / -->




    <section class="page-header aton-page-header-landing">
        <div class="container">
            <div class="row">

                <div class="box-static box-border-top box-dark">

                    <aton-contato-landing></aton-contato-landing>
                </div>


            </div>
        </div>
    </section>


@endsection

@section('page-scripts')
    <script>
        $('#apresentacao').focus();
    </script>
    {{--<script type='text/javascript' data-cfasync="false"--}}
    {{--src={{ getCDN('/_frontend/js/plugins/layerslider/js/greensock.js', 'cdn2') }}></script>--}}
    {{--<script type='text/javascript' data-cfasync="false"--}}
    {{--src={{ getCDN('/_frontend/js/plugins/layerslider/js/layerslider.kreaturamedia.jquery.js', 'cdn2') }}></script>--}}
    {{--<script type='text/javascript' data-cfasync="false"--}}
    {{--src={{ getCDN('/_frontend/js/plugins/layerslider/js/layerslider.transitions.js', 'cdn2') }}></script>--}}


    {{--<script>--}}
    {{--jQuery("#layerslider").layerSlider({--}}
    {{--responsive: false,--}}
    {{--responsiveUnder: 1280,--}}
    {{--layersContainer: 1280,--}}
    {{--navButtons: false,--}}
    {{--navPrevNext: false,--}}
    {{--navStartStop: false,--}}
    {{--width: 600,--}}
    {{--pauseOnHover: false,--}}
    {{--autoPlayVideos: false,--}}
    {{--skinsPath: '_frontend/js/plugins/layerslider/skins/'--}}
    {{--});--}}
    {{--</script>--}}

@endsection
