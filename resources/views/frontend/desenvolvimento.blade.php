@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Desenvolvimento de Sistemas Customizados.')

@section('page-meta')

    <link rel="canonical" href="{{route('desenvolvimento')}}" />
    <meta property="og:url" content="{{route('desenvolvimento')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Akhena - Desenvolvimento de Sistemas Customizados(Laravel, Vue, Vuetify, Delphi Tokyo)." />
    <meta name="twitter:title" content="Akhena - Desenvolvimento de Sistemas Customizados(Laravel, Vue, Vuetify, Delphi Tokyo)." />

    <meta name="description" content="A Akhena também desenvolve sistema customizados, faça seu orçamento e tire seu projeto do papel">
    <meta property="og:description" content="A Akhena desenvolve sistemas customizados com o melhor da tecnologia, faça seu orçamento e tire seu projeto do papel" />
    <meta name="twitter:description" content="A Akhena desenvolve sistemas customizados com o melhor da tecnologia, faça seu orçamento e tire seu projeto do papel" />

    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    <meta property="og:image" content="{{asset('img/atonmidia/atonmidia-servicos.jpg')}}" />
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
                <li><a href="#">Serviços</a></li>
                <li class="active">Desenvolvimento</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>
        <div class="container">


            <div class="heading-title">
                <h3>
                    Faz parte de nosso portifólio também: desenvolvimento
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>de websites</span>
				            <span>de softwares Windows</span>
				            <span>de Apps Android</span>
				            <span>de backends</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>

            <h1 class="fs-17">Criamos sistemas para web de acordo com sua necessidade, utilizando design responsivo, que se adapta a qualquer tamanho de tela, seja no computador, tablet ou celular.
                Nós desenvolvemos o sistema adaptado para a realidade da sua empresa, assim sua empresa não precisa se adaptar a realidade do sistema.
            </h1>

            <div class="divider divider-center divider-color"><!-- divider -->
                <i class="fa fa-chevron-down"></i>
            </div>

            <!-- BORN TO BE A WINNER -->
            <article class="row">

                <div class="col-md-6">
                    <div class="heading-title">
                        <h3>
                            Escolha
                            <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>Akhena</span>
				            <span>o melhor</span>
				            <span>um software com sua cara</span>
                        </span>
                    </span><!-- /word rotator -->
                        </h3>
                    </div>
                    <p>Possuímos uma grande experiência na criação de sistemas customizados, criados de acordo com a necessidade do cliente. Não adaptamos sistemas existentes,
                        nós criamos um novo sistema para sua empresa. Trabalhamos com padrões e frameworks que garantem nossa eficiência e utilizamos
                        programas capazes de reduzir tarefas repetitivas, desta maneira conseguimos oferecer prazo e preço competitivos para um sistema único.
                    </p>

                </div>

                <div class="col-md-6">
                    <h3>
                        Tecnologias usadas:
                    </h3>
                        {{--<!-- OWL SLIDER -->--}}
                    <div class="embed-responsive ">
                        <img class="img-fluid" src="{{ getCDN('img/atonmidia/tecnologiasdesenvolvimento.jpg', 'cdn2') }}" alt="">
                    </div>
                    {{--<!-- /OWL SLIDER -->--}}
                </div>

            </article>
            {{--<h3><span>Importância</span> de um vídeo</h3>--}}
            {{--<p>Os vídeos são uns dos formatos mais consumidos na internet atualmente. Vídeos podem apresentar de forma rápida e dinâmica conteúdos que seriam densos e difíceis de assimilar, por exemplo,--}}
                {{--se apresentados na forma escrita. Nos do estúdio aste atuamos na criação de vídeos motion graphics para as mais diversas finalidades, dando vida e movimento às suas ideias.--}}
            {{--</p>--}}
            {{--<p>Veja o exemplo de uma criação ao lado. E para mais exemplos visite nosso canal do youtube!--}}
            {{--</p>--}}
            <!-- /BORN TO BE A WINNER -->

        </div>
    </section>


    <!-- -->

    <!-- -->
    {{--<section>--}}
        {{--<div class="container fs-14">--}}
            {{--<h3 class="fs-20">Mais <span>vantagens</span> da TV Corporativa Akhena</h3>--}}
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
                Ajudaremos a seu projeto sair do papel!
            </p>

            <a href="/contato" class="btn btn-primary btn-lg mt-30">ENTRE EM CONTATO</a>

        </div>

    </div>

@endsection

@section('page-scripts')
@endsection
