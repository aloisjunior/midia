@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Conheça um pouco de nossa história.')

@section('page-meta')

    <link rel="canonical" href="{{route('sobre')}}" />
    <meta property="og:url" content="{{route('sobre')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Empresa gaúcha de tecnologia que busca como diferencial a inovação na área de comunicação." />
    <meta name="twitter:title" content="Empresa gaúcha de tecnologia que busca como diferencial a inovação na área de comunicação." />

    <meta name="description" content="A Akhena atua no mercado de comunicação, provendo um canal de alto impacto dentro de Shopping Centers, além de diversos outros produtos e serviços.l ">
    <meta property="og:description" content="A Akhena atua no mercado de comunicação, provendo um canal de alto impacto dentro de Shopping Centers, além de diversos outros produtos e serviços." />
    <meta name="twitter:description" content="A Akhena atua no mercado de comunicação, provendo um canal de alto impacto dentro de Shopping Centers, além de diversos outros produtos e serviços." />

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
    <section class="page-header parallax parallax-3" style="background-image:url('img/atonmidia/total-cabecalho.jpg')">
        <div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

        <div class="container">

            <h1>Akhena</h1>
            <p>Sobre Nós</p>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{ route('inicio') }}">Início</a></li>
                <li><a href="#">Páginas</a></li>
                <li class="active">Sobre</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>

    <section>
        <div class="container">

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-9">

                    <img style="width: 300px;" class="float-left" src="{{ getCDN('img/ayro.png', 'cdn2') }}.png" alt="" />

                    <div class="heading-title">
                        <h2>Quem Somos?</h2>
                    </div>

                    <h1 class="fs-16">Empresa que nasceu para inovar o segmento de Mídia Digital Indoor e em tecnologias para área de comunicação.
                        Nos orgulhamos de nossas parcerias, como o Shopping Total de Porto Alegre onde temos dezenas de monitores para veiculação de anúncios publicitários.
                    </h1>


                    <div class="row mt-60">

                        <div class="col-sm-6">
                            <div class="heading-title heading-border-bottom heading-color">
                                <h3>Nossa missão</h3>
                                <p>ampliar resultados com tecnologia</p>
                            </div>

                            <p>A missão da Akhena é muito simples, usar a tecnologia para ajudar empresas e profissionais autonomos a mostrarem seus produtos e marcas de forma ecologicamente correta.
                                Sempre buscando impactar um público diferenciado, que realmente faz parte dos tomadores de decisão da sociedade.</p>
                            <p>Preserve você também o nosso meio ambiente, use mídias ecologicamente corretas.</p>

                        </div>

                        <div class="col-sm-6">
                            <div class="heading-title heading-border-bottom heading-color">
                                <h3>São <span class="counter"  >9</span> anos de experiência</h3>
                                <p>tudo que você precisa num só lugar</p>
                            </div>

                            <p>A origem da Akhena foi como uma empresa desenvolvedora de soluções comerciais, que com o  passar do tempo se tornou expert em plataformas digitais.</p>
                            <p>Foi uma migração natural ir para outros mercados onde a tecnologia pode fazer a diferença. Usamos nossas plataformas para realizar o sonho de quem quer ter visibilidade sem agredir o meio ambiente.</p>

                        </div>

                    </div>


                    <div class="mt-60">

                        <div class="heading-title heading-border-bottom heading-color text-center">
                            <h3>Por que escolher a Akhena?</h3>
                            <p>Primeiramente porque nos importamos com seu resultado.</p>
                        </div>
                        <p>Nós elaboramos uma série de plataformas de negócio que permitem que você fique tranquilo ao anunciar conosco, seus vídeos e conteúdos ficam agendados para a
                            data que programar, evitando assim qualquer erro que onere sua campanha. Fabricamos tranquilidade e satisfação.
                            </p>

                        <div class="row">

                            <div class="col-sm-4">
                                <ul class="list-unstyled list-icons">
                                    <li><i class="fa fa-check text-success"></i> Alta tecnologia.</li>
                                    <li><i class="fa fa-check text-success"></i> Tecnologia própria.</li>
                                    <li><i class="fa fa-check text-success"></i> Ambiente totalmente online.</li>
                                </ul>
                            </div>

                            <div class="col-sm-4">
                                <ul class="list-unstyled list-icons">
                                    <li><i class="fa fa-check text-success"></i> Controle de pós-venda.</li>
                                    <li><i class="fa fa-check text-success"></i> Consultoria de marketing.</li>
                                    <li><i class="fa fa-check text-success"></i> Campanhas online na rede indoor.</li>
                                </ul>
                            </div>

                            <div class="col-sm-4">
                                <ul class="list-unstyled list-icons">
                                    <li><i class="fa fa-check text-success"></i> Descontos progressivos.</li>
                                    <li><i class="fa fa-check text-success"></i> Excelente custo x benefício.</li>
                                    <li><i class="fa fa-check text-success"></i> Planos flexíveis.</li>
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /LEFT -->

                <!-- RIGHT -->
                <div class="col-md-3">

                    <div class="box-static box-border-top mb-60">
                        <div class="box-title">
                            <h4>Faz parte de nossa receita</h4>
                        </div>
                        <ul class="list-unstyled list-icons p-15 pb-0 white-text">
                            <li class="mb-20">
                                <i class="fa fa-check text-success fs-18"></i>
                                <span class="block bold fs-18">Comprometimento</span>
                                <small>Valorizar cada cliente como único</small>
                            </li>
                            <li class="mb-20">
                                <i class="fa fa-check text-success fs-18"></i>
                                <span class="block bold fs-18">Inovação</span>
                                <small>Estamos comprometidos em sempre ter o melhor para oferecer aos clientes.</small>
                            </li>
                            <li class="mb-20">
                                <i class="fa fa-check text-success fs-18"></i>
                                <span class="block bold fs-18">Transparência</span>
                                <small>Temos um cuidado especial com nossas relações comerciais.</small>
                            </li>
                            <li class="mb-20">
                                <i class="fa fa-check text-success fs-18"></i>
                                <span class="block bold fs-18">Vitalidade</span>
                                <small>Uma empresa composta por sócios jovens comprometidos com seu aprimoramento constante, que reflete na empresa.</small>
                            </li>
                        </ul>

                        <hr />

                        <p class="text-center fs-11 mb-10">"Faça sempre seu melhor"</p>
                    </div>

                    <!-- FACEBOOK -->
                    {{--<iframe class="hidden-xs-down" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fstepofweb&amp;width=263&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" style="border:none; overflow:hidden; width:263px; height:258px;"></iframe>--}}
                    <div id="fb-root">
                        <div class="fb-page" data-href="https://www.facebook.com/AtonMidia" data-small-header="false" data-adapt-container-width="true"
                             data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/AtonMidia">
                                    <a href="https://www.facebook.com/AtonMidia">Akhena Soluções em Comunicação</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <hr />


                    <!-- SOCIAL ICONS -->

                        <div class="clearfix">

                            <a target="_blank" href="https://www.facebook.com/AtonMidia"
                               class="social-icon social-icon-sm social-icon-border social-facebook float-left"
                               data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="icon-facebook"></i>
                                <i class="icon-facebook"></i>
                            </a>

                            <a target="_blank" href="https://twitter.com/AtonMidia"
                               class="social-icon social-icon-sm social-icon-border social-twitter float-left"
                               data-toggle="tooltip" data-placement="top" title="Twitter">
                                <i class="icon-twitter"></i>
                                <i class="icon-twitter"></i>
                            </a>

                            <a target="_blank" href="https://www.instagram.com/atonmidia/"
                               class="social-icon social-icon-sm social-icon-border social-instagram float-left"
                               data-toggle="tooltip" data-placement="top" title="Instagram">
                                <i class="icon-instagram"></i>
                                <i class="icon-instagram"></i>
                            </a>

                            <a target="_blank" href="https://www.youtube.com/channel/UCpMRcdMkNT5ZdLC4o5CbiRQ?sub_confirmation=1"
                               class="social-icon social-icon-sm social-icon-border social-youtube float-left"
                               data-toggle="tooltip" data-placement="top" title="Youtube">
                                <i class="icon-youtube-play"></i>
                                <i class="icon-youtube-play"></i>
                            </a>

                            <a target="_blank" href="https://plus.google.com/u/0/106473949254029025814"
                               class="social-icon social-icon-sm social-icon-border social-gplus float-left"
                               data-toggle="tooltip" data-placement="top" title="Google+">
                                <i class="icon-google-plus"></i>
                                <i class="icon-google-plus"></i>
                            </a>

                            <a target="_blank"
                               href="https://www.linkedin.com/company/atonm%C3%ADdia-tecnologia-e-comunica%C3%A7%C3%A3o"
                               class="social-icon social-icon-sm social-icon-border social-linkedin float-left"
                               data-toggle="tooltip" data-placement="top" title="Linkedin">
                                <i class="icon-linkedin"></i>
                                <i class="icon-linkedin"></i>
                            </a>

                        </div>
                </div>
                <!-- /RIGHT -->

            </div>

        </div>
    </section>

    <!--
    CALLOUT
    FULLWIDTH: OUTSIDE OF <section>

        Available Classes:
        alert-transparent
        alert-default
        alert-info
        alert-warning
        alert-danger
        alert-success
        alert-dark

        bordered-bottom
        bordered-top
    -->
    <div class="alert alert-success bordered-bottom m-0">
        <div class="container">

            <div class="row">

                <div class="col-md-9 col-sm-12"><!-- left text -->
                    <h3>Ligue agora para <span><strong>+55-51-33778830</strong></span> será um prazer falar com você!</h3>
                    <p class="font-lato fw-300 fs-20 mb-0">
                        Nós realmente acreditamos nos nossos produtos
                    </p>
                </div><!-- /left text -->


                <div class="col-md-3 col-sm-12 text-right"><!-- right btn -->
                    <a href="{{route('contato')}}" rel="nofollow" target="_blank" class="btn btn-success btn-lg">Entre em Contato</a>
                </div><!-- /right btn -->

            </div>

        </div>
    </div>
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
    {{-- facebook plugin --}}
    <script>
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

@endsection
