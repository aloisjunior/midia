@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Criação de vídeos animados, motion graphics.')

@section('page-meta')

    <link rel="canonical" href="{{route('criacaovideos')}}" />
    <meta property="og:url" content="{{route('criacaovideos')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Akhena - Criação de vídeos animados em Motion Graphics" />
    <meta name="twitter:title" content="Akhena - Criação de vídeos animados em Motion Graphics" />

    <meta name="description" content="A Akhena cria seu vídeo de forma simplificada e eficiente.">
    <meta property="og:description" content="A Akhena cria seu vídeo de forma simplificada e eficiente." />
    <meta name="twitter:description" content="A Akhena cria seu vídeo de forma simplificada e eficiente." />

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
                <li class="active">Criação de vídeos</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>
        <div class="container">


            <div class="heading-title">
                <h3>
                    Se a questão é vídeo para seus anúncios, nos
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>criamos</span>
				            <span>editamos</span>
				            <span>veiculamos</span>
				            <span>resolvemos</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>

            <h1 class="fs-17">
                Animação MOTION GRAPHICS, ou vídeo com design em movimento, tem uma história quase tão antiga quanto o próprio cinema e atualmente é uma das grandes tendências da Produção Audiovisual, estando presente em
                <span>Vídeos Institucionais, Vídeos de Treinamento, Tutoriais, Marketing de Conteúdo em Vídeo, Vídeos Educativos, Publicidade</span>     e por aí vai.
                Com muitos e variados estilos, o fundamental são elementos visuais que se movem muitas vezes por inteiro, como um círculo que surge no centro da tela ou uma mensagem de texto que aparece de forma criativa.
            </h1>

            <div class="divider divider-center divider-color"><!-- divider -->
                <i class="fa fa-chevron-down"></i>
            </div>

            <!-- BORN TO BE A WINNER -->
            <article class="row">

                <div class="col-md-6">
                    <div class="heading-title">
                        <h3>
                            Porque
                            <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>criar</span>
				            <span>inovar</span>
				            <span>motion graphics</span>
                        </span>
                    </span><!-- /word rotator -->
                        </h3>
                    </div>
                    <p>Em poucas palavras: clareza e elegância. Como uma Produtora de Vídeo de Motion Graphics, vemos que uma das características atuais do design
                        em movimento é a grande valorização dos espaços vazios, utilização de elementos simplificados visualmente,
                        cores agradáveis e fontes grandes e claras. Ou seja, telas de leitura fácil e imediata.
                    </p>

                    <p>
                        Outro ponto muito interessante é que ao fazer surgirem os esquemas gráficos é fácil explicar estruturas lógicas complexas.
                        Isso acontece, por exemplo, ao apresentar um organograma, uma lista de vantagens, uma sequência de atendimento, e assim em diante.
                        O que pode ser aplicado em Landing Pages, Email Marketing, Youtube Ads, Facebook, Instagram Videos, Twitter Videos e também junto ao time de vendas.
                    </p>
                </div>

                <div class="col-md-6">
                    <!-- OWL SLIDER -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/2n33FHKWwn8?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <!-- /OWL SLIDER -->
                </div>

            </article>
            <h3><span>Importância</span> de um vídeo</h3>
            <p>Os vídeos são uns dos formatos mais consumidos na internet atualmente. Vídeos podem apresentar de forma rápida e dinâmica conteúdos que seriam densos e difíceis de assimilar, por exemplo,
                se apresentados na forma escrita. Nos do estúdio aste atuamos na criação de vídeos motion graphics para as mais diversas finalidades, dando vida e movimento às suas ideias.
            </p>
            <p>Veja o exemplo de uma criação ao lado. E para mais exemplos visite nosso canal do youtube!
            </p>
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
                Aproveite esta oportunidade!
            </p>

            <a href="/contato" class="btn btn-primary btn-lg mt-30">ENTRE EM CONTATO</a>

        </div>

    </div>

@endsection

@section('page-scripts')
@endsection
