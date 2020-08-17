@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Vitrine Digital é a forma de modernizar sua vitrine.')

@section('page-meta')

    <link rel="canonical" href="{{route('vitrinedigital')}}" />
    <meta property="og:url" content="{{route('vitrinedigital')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="A Vitrine Digital da Akhena vai revolucionar a forma de exibir seus produtos e promoções." />
    <meta name="twitter:title" content="A Vitrine Digital da Akhena vai revolucionar a forma de exibir seus produtos e promoções." />

    <meta name="description" content="Inove sua vitrine e traga ela para o século 21, a Vitrine Digital da Akhena vai é diferencial que sua empresa procura.">
    <meta property="og:description" content="Inove sua vitrine e traga ela para o século 21, a Vitrine Digital da Akhena vai é diferencial que sua empresa procura." />
    <meta name="twitter:description" content="Inove sua vitrine e traga ela para o século 21, a Vitrine Digital da Akhena vai é diferencial que sua empresa procura." />

    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    <meta property="og:image" content="{{ asset('/img/atonmidia/vitrinedigital2.jpg') }}" />
    <meta name="twitter:image:src" content="{{ asset('/img/atonmidia/vitrinedigital2.jpg') }}" />

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
                <li><a href="#">Produtos</a></li>
                <li class="active">Vitrine Digital</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>
        <div class="container">


            <div class="heading-title">
                <h3>
                    Com Vitrine Digital da Akhena sua empresa
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>se diferencia</span>
				            <span>se moderniza</span>
				            <span>vende mais</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>

            <h1 class="fs-17">Instalação de monitores de TV ou painéis de LED com o intuito de fomentar a venda de produtos ou serviços de seu estabelecimento.
                Uma vitrine moderna e atraente é a estratégia perfeita para aumentar as vendas em seu estabelecimento.
            </h1>

            <div class="divider divider-center divider-color"><!-- divider -->
                <i class="fa fa-chevron-down"></i>
            </div>

            <!-- BORN TO BE A WINNER -->
            <article class="row">

                <div class="col-md-6">
                    <div class="heading-title">
                        <h3>
                            Vitrine
                            <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>Digital</span>
				            <span>Eficiente</span>
				            <span>Moderna</span>
                        </span>
                    </span><!-- /word rotator -->
                        </h3>
                    </div>
                    <p>Com a disputa cada vez mais acirrada pela atenção dos clientes, é crescente o número de lojas e redes de franchising que
                        optam por vitrines em formato digital com fácil gerenciamento de conteúdo.
                    </p>

                    <p>
                        A instalação de monitores na vitrine das lojas ou em pontos internos estratégicos, permite a veiculação imediata de uma
                        ou mais campanhas em diversas unidades ao mesmo tempo, atingindo os consumidores de forma direta e dinâmica.
                    </p>
                </div>

                <div class="col-md-6">
                    <!-- OWL SLIDER -->
                    <div class="owl-carousel buttons-autohide controlls-over m-0" data-plugin-options='{"items": 1, "autoHeight": true, "navigation": true, "pagination": true, "transitionStyle":"backSlide", "progressBar":"true"}'>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/vitrinedigital4.jpg', 'cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/vitrinedigital1.jpg', 'cdn2') }}" alt="">
                        </div>

                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/vitrinedigital2.jpg', 'cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/vitrinedigital3.jpg', 'cdn2') }}" alt="">
                        </div>

                    </div>
                    <!-- /OWL SLIDER -->
                </div>

            </article>

            <div class="heading-title">
                <h3>
                    Exibição de produtos
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>dinâmica</span>
				            <span>diferenciada</span>
				            <span>atraente</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>
            <p>Além da dificuldade para expor itens, um mostruário estático não comporta todos os destaques que sua empresa gostaria de enfatizar
                , e é aí que está o grande diferencial da vitrine digital da Akhena, que possibilita a exibição de mais de um de seus produtos ou peças,
                reduzindo também os custos de manutenção das vitrines durante a troca de coleções ou campanhas.
                Com o nosso modelo de vitrine digital, a sua loja atrairá ainda mais a atenção de possíveis clientes.
            </p>
            <!-- /BORN TO BE A WINNER -->

            <div class="heading-title">
                <h3>
                    <span>Impacto</span> da Vitrine Digital
                    {{--<span class="word-rotator" data-delay="2000">--}}
                        {{--<span class="items">--}}
                            {{--<span>dinâmica</span>--}}
				            {{--<span>diferenciada</span>--}}
				            {{--<span>atraente</span>--}}
                        {{--</span>--}}
                    {{--</span><!-- /word rotator -->--}}
                </h3>
            </div>
            <p>Em pesquisa realizada pela Digital Screenmedia Association, 1 a cada 5 pessoas é impactada positivamente por TVs nos Pontos de Venda,
                de maneira suficiente para adquirir o produto ou serviço anunciado, podendo elevar o faturamento em mais de 20%.
            </p>

        </div>
    </section>
    <!-- -->

    <!-- -->
    {{--<section>--}}
        {{--<div class="container fs-14">--}}
            {{--<h3 class="fs-20">Mais <span>vantagens</span> da Vitrine Digital Akhena</h3>--}}
            {{--<div class="row">--}}

                {{--<div class="col-md-6">--}}
                    {{--<ul class="list-unstyled">--}}
                        {{--<li><i class="fa fa-check"></i>Estabelecer um canal de comunicação interna eficiente</li>--}}
                        {{--<li><i class="fa fa-check"></i>Promover ações internas e externas da empresa entre colaboradores</li>--}}
                        {{--<li><i class="fa fa-check"></i>Fomentar o alinhamento estratégico da empresa</li>--}}
                        {{--<li><i class="fa fa-check"></i>Divulgação mais dinâmica e atrativa das informações</li>--}}
                        {{--<li><i class="fa fa-check"></i>Trabalhar sua marca e a imagem institucional da empresa</li>--}}
                        {{--<li><i class="fa fa-check"></i>Eficiência em campanhas de EndoMarketing</li>--}}
                        {{--<li><i class="fa fa-check"></i>Controle rápido e seguro para gerenciamento de conteúdo</li>--}}

                    {{--</ul>--}}
                {{--</div>--}}

                {{--<div class="col-md-6">--}}

                    {{--<ul class="list-unstyled">--}}
                        {{--<li><i class="fa fa-check"></i>Design personalizado de acordo com identidade visual da empresa</li>--}}
                        {{--<li><i class="fa fa-check"></i>Eficiência na realização de palestras e treinamentos</li>--}}
                        {{--<li><i class="fa fa-check"></i>Promover a motivação e a qualidade de trabalho dos colaboradores</li>--}}
                        {{--<li><i class="fa fa-check"></i>Eliminação da poluição visual gerada por murais e cartazes</li>--}}
                        {{--<li><i class="fa fa-check"></i>Interligação com representantes, escritórios comerciais, matrizes e filiais</li>--}}
                        {{--<li><i class="fa fa-check"></i>Responsabilidade ambiental com a não geração de resíduos de papel ou plástico</li>--}}
                        {{--<li><i class="fa fa-check"></i>Maior agilidade na disseminação de todo tipo de informação (Gerencial, Metas, Visão, Missão)</li>--}}

                    {{--</ul>--}}
                {{--</div>--}}


            {{--</div>--}}

        {{--</div>--}}
    {{--</section>--}}
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
@endsection

@section('page-scripts')
@endsection
