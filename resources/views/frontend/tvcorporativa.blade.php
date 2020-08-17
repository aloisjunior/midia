@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Tv Corporativa')

@section('page-meta')

    <link rel="canonical" href="{{route('tvcorporativa')}}" />
    <meta property="og:url" content="{{route('tvcorporativa')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Akhena - Tv Corporativa" />
    <meta name="twitter:title" content="Akhena - Tv Corporativa" />

    <meta name="description" content="Solução para Tv Corporativa de sua empresa você encontra na Akhena.">
    <meta property="og:description" content="Solução para Tv Corporativa de sua empresa você encontra na Akhena." />
    <meta name="twitter:description" content="Solução para Tv Corporativa de sua empresa você encontra na Akhena." />

    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    <meta property="og:image" content="{{ asset('img/atonmidia/tvcorporativa2.jpg') }}" />
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
                <li class="active">TV Corporativa</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>
        <div class="container">


            <div class="heading-title">
                <h3>
                    A TV Corporativa Akhena
                    <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>Integra</span>
				            <span>Facilita</span>
				            <span>Informa</span>
                        </span>
                    </span><!-- /word rotator -->
                </h3>
            </div>

            <h1 class="fs-17">A TV Corporativa é um produto de destaque dentro da mídia digital indoor (digital signage). Idealizada para facilitar e modernizar o cotidiano de empresas
                , redes de lojas e corporações, a TV Corporativa é uma ferramenta fundamental para seu negócio. A boa comunicação de sua empresa é excencial para o sucesso empresarial.
            </h1>

            <div class="divider divider-center divider-color"><!-- divider -->
                <i class="fa fa-chevron-down"></i>
            </div>

            <!-- BORN TO BE A WINNER -->
            <article class="row">

                <div class="col-md-6">
                    <div class="heading-title">
                        <h3>
                            Comunicação
                            <span class="word-rotator" data-delay="2000">
                        <span class="items">
                            <span>Interna</span>
				            <span>Eficiente</span>
				            <span>Moderna</span>
                        </span>
                    </span><!-- /word rotator -->
                        </h3>
                    </div>
                    <p>Entre os benefícios da TV Corporativa destaca-se a otimização dos processos de comunicação interna das empresas e fábricas. O alcance da TV Corporativa é ilimitado: o
                        conteúdo corporativa pode ser integrados entre matriz e filiais de diferentes regiões do mundo, uniformizando as informações de toda a rede.
                    </p>

                    <p>
                        Através de imagens animadas e vídeos institucionais, produzidos a critério dos gestores de cada empresa, todo recado é distribuído integralmente aos colaboradores de todos os níveis hierárquicos da empresa.
                        As telas são colocadas em ambientes de comun circulação, como refeitórios e salas de espera, fazendo com que as informações relevantes ao trabalho sejam repassadas a todos.
                    </p>
                </div>

                <div class="col-md-6">
                    <!-- OWL SLIDER -->
                    <div class="owl-carousel buttons-autohide controlls-over m-0" data-plugin-options='{"items": 1, "autoHeight": true, "navigation": true, "pagination": true, "transitionStyle":"backSlide", "progressBar":"true"}'>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/tvcorporativa3.jpg', 'cdn2') }}" alt="">
                        </div>

                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/tvcorporativa1.jpg', 'cdn2') }}" alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ getCDN('/img/atonmidia/tvcorporativa2.jpg', 'cdn2') }}" alt="">
                        </div>

                    </div>
                    <!-- /OWL SLIDER -->
                </div>

            </article>
            <h3>Fortalecendo a imagem da empresa</h3>
            <p>Muito usado por grandes corporações, a TV Corporativa ajuda a divulgar suas ações humanitárias e ações em prol da sociedade, como medidas educativas, socioambientais e filantrópicas entre os colaboradores,
                clientes ou visitantes. A opção pelo uso de mídia indoor digital é ponto positivo na responsabilidade ambiental da empresa, já que reduz o uso de papel na impressão dos processos comunicativos.
            </p>
            <!-- /BORN TO BE A WINNER -->

        </div>
    </section>
    <!-- -->

    <!-- -->
    <section>
        <div class="container fs-14">
            <h3 class="fs-20">Mais <span>vantagens</span> da TV Corporativa Akhena</h3>
            <div class="row">

                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check"></i>Estabelecer um canal de comunicação interna eficiente</li>
                        <li><i class="fa fa-check"></i>Promover ações internas e externas da empresa entre colaboradores</li>
                        <li><i class="fa fa-check"></i>Fomentar o alinhamento estratégico da empresa</li>
                        <li><i class="fa fa-check"></i>Divulgação mais dinâmica e atrativa das informações</li>
                        <li><i class="fa fa-check"></i>Trabalhar sua marca e a imagem institucional da empresa</li>
                        <li><i class="fa fa-check"></i>Eficiência em campanhas de EndoMarketing</li>
                        <li><i class="fa fa-check"></i>Controle rápido e seguro para gerenciamento de conteúdo</li>

                    </ul>
                </div>

                <div class="col-md-6">

                    <ul class="list-unstyled">
                        <li><i class="fa fa-check"></i>Design personalizado de acordo com identidade visual da empresa</li>
                        <li><i class="fa fa-check"></i>Eficiência na realização de palestras e treinamentos</li>
                        <li><i class="fa fa-check"></i>Promover a motivação e a qualidade de trabalho dos colaboradores</li>
                        <li><i class="fa fa-check"></i>Eliminação da poluição visual gerada por murais e cartazes</li>
                        <li><i class="fa fa-check"></i>Interligação com representantes, escritórios comerciais, matrizes e filiais</li>
                        <li><i class="fa fa-check"></i>Responsabilidade ambiental com a não geração de resíduos de papel ou plástico</li>
                        <li><i class="fa fa-check"></i>Maior agilidade na disseminação de todo tipo de informação (Gerencial, Metas, Visão, Missão)</li>

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

@endsection

@section('page-scripts')
@endsection
