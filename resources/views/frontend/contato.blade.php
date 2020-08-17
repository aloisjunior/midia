@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Entre em contato com a Akhena')

@section('page-meta')

    <link rel="canonical" href="{{route('contato')}}" />
    <meta property="og:url" content="{{route('contato')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Akhena - Entre em contato - Anúncios em Mídia Digital Indoor, TV Corporativa, Vitrine Digital" />
    <meta name="twitter:title" content="Akhena - Entre em contato - Anúncios em Mídia Digital Indoor, TV Corporativa, Vitrine Digital" />

    <meta name="description" content="Página para você tirar suas dúvidas de como anunciar na rede Akhena ou adquirir outro de nossos serviços.">
    <meta property="og:description" content="Página para você tirar suas dúvidas de como anunciar na rede Akhena ou adquirir outro de nossos serviços." />
    <meta name="twitter:description" content="Página para você tirar suas dúvidas de como anunciar na rede Akhena ou adquirir outro de nossos serviços." />

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
                <li><a href="#">Páginas</a></li>
                <li class="active">Contato</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <section class="b-0">
        <div class="container">

            <div class="row">

                <div class="col-lg-7 push-lg-5">

                   <aton-contato></aton-contato>

                </div>


                <div class="col-lg-5 pull-lg-7">

                    <!--
                    Available heights
                        h-100
                        h-150
                        h-200
                        h-250
                        h-300
                        h-350
                        h-400
                        h-450
                        h-500
                        h-550
                        h-600
                    -->
                    {{--<div id="map2" class="h-400 grayscale"></div>--}}
                    <div id="map2" class="h-400 "></div>

                    <hr/>

                    <p>
                        <span class="block fw-300">
                            Onde nos encontrar:
                        </span>
                        <span class="block fw-300">
                        </span>
                        <span class="block fw-300">
                        </span>
                    </p>

                    <ul class="list-unstyled list-icons">
                        <li><i class="fa fa-map-marker"></i> <strong>Localização:</strong> Porto Alegre/RS,
                            Brasil
                        </li>
                        <li><i class="fa fa-phone"></i> <strong>Telefone:</strong> <a href="tel:+55-51-33778830">(51)
                                3377-8830</a></li>
                        <li><i class="fa fa-whatsapp"></i><strong>WhatsApp:</strong> <a href="tel:+55-51-996638988">(51)
                                99663-8988</a></li>
                        <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a
                                    href="mailto:contato@rothermel.com.br">contato@rothermel.com.br</a></li>
                    </ul>

                    <hr/>
                    <h4 class="font300">Nossos horários</h4>
                    <p>
                        <span class="block"><strong>Segunda a Sexta:</strong> 9:00 às 18:00</span>
                        <span class="block"><strong>Sábado:</strong> 9:00 às 12:00</span>
                        <span class="block"><strong>Domingo:</strong> Somente plantão</span>
                    </p>


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


            </div>


        </div>
    </section>




    <div class="callout alert b-0 rad-0 m-0 alert-success ">

        <div class="text-center">

            <h3>Já conhece nossa rede para <span><strong>anúncios?</strong></span></h3>
            <p class="font-lato fs-20">
                Veja onde veicularemos seu anuncio
            </p>

            <a href="/pontosdeveiculacao" class="btn btn-primary btn-lg mt-30">CONHECER</a>

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDT9WcJg-caoZswjL9aCaQCPN5Iy-78vFw"></script>
    <script type="text/javascript">

        //google map
        function initialize() {
            var myLatlng = new google.maps.LatLng(-30.026015, -51.212763);
            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById('map2'), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Akhena'
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@endsection
