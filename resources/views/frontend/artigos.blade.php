@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Artigos e Noticias')

@section('page-meta')

    <link rel="canonical" href="{{route('artigos')}}" />
    <meta property="og:url" content="{{route('artigos')}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="Akhena - Artigos e Noticias" />
    <meta name="twitter:title" content="Akhena - Artigos e Noticias" />

    <meta name="description" content="Novidades sobre as soluções AtonMída para Mídia Digital Indoor, Tv Corporativa e Rádio Indoor">
    <meta property="og:description" content="Novidades sobre as soluções AtonMída para Mídia Digital Indoor, Tv Corporativa e Rádio Indoor" />
    <meta name="twitter:description" content="Novidades sobre as soluções AtonMída para Mídia Digital Indoor, Tv Corporativa e Rádio Indoor" />

    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    <meta property="og:image" content="{{asset('img/atonmidia/atonmidia-servicos.jpg')}}" />
    <meta name="twitter:image:src" content="{{asset('img/atonmidia/atonmidia-servicos1x1.jpg')}}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@atonmidia" />
    <meta name="twitter:domain" content="{{route('inicio')}}" />
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
                <li><a href="{{ route('inicio') }}">Início</a></li>
                <li><a href="{{ route('artigos') }}">Artigos</a></li>
                <li class="active">{{ isset($filtro) ? $filtro : 'Todos' }}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->




    <!-- -->
    <section>
        <div class="container">

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-9 col-sm-9">

                    <!-- TIMELINE -->
                    <div class="timeline"><!-- .timeline-inverse = right position [left on RTL] -->
                        <div class="timeline-hline"><!-- horizontal line --></div>

                    @if(count($artigos) < 1)
                        <h3>Nenhum registro encontrado para sua busca</h3>
                    @endif



                    @foreach($artigos as $post)
                        <!-- POST ITEM -->
                            <div class="blog-post-item">

                                <!-- timeline entry -->
                                <div class="timeline-entry"><!-- .rounded = entry -->
                                    {!! date('d', strtotime($post->created_at))!!}
                                    <span>
                                    {!! substr(mes_pt_br($post->created_at), 0, 3)!!}
                                </span>
                                    <div class="timeline-vline"><!-- vertical line --></div>
                                </div>
                                <!-- /timeline entry -->

                                <!-- VIDEO -->
                                @if($post->url_video != '')
                                    <div class="mb-20">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            {{-- configuração de embed colocadas diretamente no campo--}}
                                            {!!  $post->url_video !!}
                                        </div>
                                    </div>
                                @elseif (count($post->arquivos) > 0 )
                                    <div class="flexslider" data-arrowNav="false" data-slideshowSpeed="3000">
                                        <ul class="slides">
                                            @foreach( $post->arquivos as $arquivo )
                                                <li>
                                                    <a href="{{ route('artigos.detalhe', $post->slug) }}">
                                                        <img class="img-fluid"
                                                             src="{{ url('/storage/'.$arquivo->link) }}"
                                                             width="600"
                                                             height="399" alt="">
                                                    </a>
                                                </li>
                                        @endforeach
                                    </div>
                                @endif


                                <h2><a href="{{ route('artigos.detalhe', $post->slug) }}">{{ $post->titulo }}</a></h2>

                                <ul class="blog-post-info list-inline">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o"></i>
                                            <span class="font-lato">
                                            {!! date('d', strtotime($post->created_at))!!} {!! substr(mes_pt_br($post->created_at), 0, 3)!!}
                                                , {!! date('Y', strtotime($post->created_at)) !!}
                                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-folder-open-o"></i>

                                        @foreach( $post->categorias as $categoria )
                                            <a class="category" href="{{ route('categoria.detalhe', $categoria) }}">
                                                <span class="font-lato">{{ $categoria }}  </span>
                                            </a>
                                        @endforeach

                                    </li>
                                    <li>
                                        <i class="fa fa-tags"></i>
                                        @foreach( $post->tags as $tag )
                                            <a class="category" href="{{ route('tag.detalhe', $tag) }}">
                                                <span class="font-lato">{{ $tag }}  </span>
                                            </a>
                                        @endforeach

                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user"></i>
                                            <span class="font-lato">by Akhena</span>
                                            {{--<span class="font-lato">{{ $post->user->name }}</span>--}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-eye"></i>
                                            <span class="font-lato">{{ $post->views }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <h1 class="fs-15">{!! $post->apresentacao !!}</h1>

                                <a href="{{ route('artigos.detalhe', $post->slug) }}"
                                   class="btn btn-reveal btn-default">
                                    <i class="fa fa-plus"></i>
                                    <span>Mais</span>
                                </a>

                            </div>
                            <!-- /POST ITEM -->
                        @endforeach


                    </div>
                    <!-- /TIMELINE -->


                    <!-- PAGINATION -->
                {{ $artigos->links() }}
                <!-- /PAGINATION -->

                </div>

                <!-- RIGHT -->
                <div class="col-md-3 col-sm-3">

                    <!-- INLINE SEARCH -->
                    <div class="inline-search clearfix mb-30">
                        <form action="" method="get" class="widget_search">
                            <input type="search" placeholder="Digite o que procura..." id="s" name="s"
                                   class="serch-input">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <!-- /INLINE SEARCH -->

                    <hr/>

                    <!-- side navigation -->
                    <div class="side-nav mb-60 mt-30">

                        @if (count($categorias) > 0)
                            <div class="side-nav-head">
                                <button class="fa fa-bars"></button>
                                <h4>CATEGORIAS</h4>
                            </div>
                            <ul class="list-group list-group-bordered list-group-noicon uppercase">
                                @foreach($categorias as $categoria)
                                    <li class="list-group-item"><a
                                                href="{!! route('categoria.detalhe', $categoria)!!}"> {!! $categoria!!}</a>
                                    </li>
                                @endforeach
                                {{--<li class="list-group-item"><a href="#"><span class="fs-11 text-muted float-right">(8)</span> MOVIES</a></li>--}}
                            </ul>
                    @endif
                    <!-- /side navigation -->

                    </div>


                    <!-- JUSTIFIED TAB -->
                    <div class="tabs mt-0 hidden-xs-down mb-60">

                        <!-- tabs -->
                        <ul class="nav nav-tabs nav-bottom-border nav-justified">
                            <li class="nav-item">
                                <a class="nav-item active" href="#tab_1" data-toggle="tab">
                                    Recentes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item" href="#tab_2" data-toggle="tab">
                                    Mais lidas
                                </a>
                            </li>
                        </ul>

                        <!-- tabs content -->
                        <div class="tab-content mb-60 mt-30">

                            <!-- POPULAR -->
                            <div id="tab_1" class="tab-pane active">

                                @foreach($ultimosposts as $post)
                                    <div class="row tab-post"><!-- post -->
                                        {{--<div class="col-md-3 col-sm-3 col-xs-3">--}}
                                            {{--<a href="{!! route('artigos.detalhe', $post->slug)!!}">--}}
                                                {{--                                                <img src="{{  $post->imagem }}" width="50" alt=""/>--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                        <div class="col-md-12 col-sm-12 col-xs-12 fs-12">
                                            <a href="{!! route('artigos.detalhe', $post->slug)!!}"
                                               class="tab-post-link">{{ $post->titulo }}</a>
                                            <small>
                                                {!! date('d', strtotime($post->created_at))!!}
                                                {!! substr(mes_pt_br($post->created_at), 0, 3)!!}
                                                {!! date('Y', strtotime($post->created_at)) !!}
                                            </small>
                                            <small>

                                                <i class="fa fa-eye"></i>
                                                <span class="font-lato">{{ $post->views }}</span>
                                                <i class="fa fa-thumbs-o-up"></i>
                                                <span class="font-lato">{{ $post->likes }}</span>

                                            </small>
                                        </div>
                                    </div><!-- /post -->
                                @endforeach
                            </div>
                            <!-- /POPULAR -->


                            <!-- RECENT -->
                            <div id="tab_2" class="tab-pane">

                                @foreach($maislidas as $post)
                                    <div class="row tab-post"><!-- post -->
                                        {{--<div class="col-md-3 col-sm-3 col-xs-3">--}}
                                        {{--<a href="{!! route('artigos.detalhe', $post->slug)!!}">--}}
                                        {{--                                                <img src="{{  $post->imagem }}" width="50" alt=""/>--}}
                                        {{--</a>--}}
                                        {{--</div>--}}
                                        <div class="col-md-12 col-sm-12 col-xs-12 fs-12">
                                            <a href="{!! route('artigos.detalhe', $post->slug)!!}"
                                               class="tab-post-link">{{ $post->titulo }}</a>
                                            <small>
                                                {!! date('d', strtotime($post->created_at))!!}
                                                {!! substr(mes_pt_br($post->created_at), 0, 3)!!}
                                                {!! date('Y', strtotime($post->created_at)) !!}
                                            </small>
                                            <small>

                                                <i class="fa fa-eye"></i>
                                                <span class="font-lato">{{ $post->views }}</span>
                                                <i class="fa fa-thumbs-o-up"></i>
                                                <span class="font-lato">{{ $post->likes }}</span>

                                            </small>
                                        </div>
                                    </div><!-- /post -->
                                @endforeach
                            </div>

                            <!-- /RECENT -->

                        </div>

                    </div>
                    <!-- JUSTIFIED TAB -->


                    <!-- TAGS -->
                    <h3 class="hidden-xs-down fs-16 mb-20">TAGS</h3>
                    <div class="hidden-xs-down mb-60">
                        @foreach($tags as $tag)
                            <a class="tag" href="{!! route('tag.detalhe', $tag)!!}">
                                <span class="txt">{{ lcfirst($tag) }}</span>
                            </a>
                        @endforeach
                    </div>


                    <!-- FEATURED VIDEO -->
                    <h3 class="hidden-xs-down fs-16 mb-10">Sobre a Akhena</h3>
                    <div class="hidden-xs-down embed-responsive embed-responsive-16by9 mb-60">
                        {{--<iframe class="embed-responsive-item" src="http://player.vimeo.com/video/8408210" width="800"--}}
                        {{--height="450"></iframe>--}}
                        <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/ttp7U0ONCK0?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1"
                                frameborder="0" allowfullscreen></iframe>
                    </div>


                    <!-- FACEBOOK -->
                    <div class="mt-30 mb-60">
                        <div id="fb-root">
                            <div class="fb-page" data-href="https://www.facebook.com/AtonMidia"
                                 data-small-header="false"
                                 data-adapt-container-width="true"
                                 data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                                <div class="fb-xfbml-parse-ignore">
                                    <blockquote cite="https://www.facebook.com/AtonMidia">
                                        <a href="https://www.facebook.com/AtonMidia">Akhena Soluções em
                                            Comunicação</a>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr/>


                    <!-- SOCIAL ICONS -->
                    <div class="clearfix mt-30">

								<span class="float-left mt-6 bold hidden-xs-down">
									Compartilhar:
								</span>

                        <a href="https://www.linkedin.com"
                           target="popup"
                           onclick="window.open('{{'https://www.linkedin.com/shareArticle?mini=true&url='.route('artigos')}}','popup','width=600,height=600'); return false;"
                           class="social-icon social-icon-sm social-icon-transparent social-linkedin float-right"
                           data-toggle="tooltip" data-placement="top" title="Linkedin">
                            <i class="icon-linkedin"></i>
                            <i class="icon-linkedin"></i>
                        </a>

                        <a href="https://www.twitter.com"
                           target="popup"
                           onclick="window.open('{{'https://www.facebook.com/sharer/sharer.php?u='.route('artigos')}}','popup','width=600,height=600'); return false;"
                           class="social-icon social-icon-sm social-icon-transparent social-facebook float-right"
                           data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                    </div>

                    {{--<div class="hidden-xs-down mt-30 mb-60">--}}
                        {{--<a href="https://www.facebook.com"--}}
                           {{--target="popup"--}}
                           {{--onclick="window.open('{{'https://www.facebook.com/sharer/sharer.php?u='.route('artigos')}}','popup','width=600,height=600'); return false;"--}}
                           {{--class="social-icon social-icon-border social-facebook float-left"--}}
                           {{--data-toggle="tooltip" data-placement="top" title="Facebook"--}}
                        {{-->--}}
                            {{--<i class="icon-facebook"></i>--}}
                            {{--<i class="icon-facebook"></i>--}}

                        {{--</a>--}}

                        {{--<a href="https://www.linkedin.com"--}}
                           {{--target="popup"--}}
                           {{--onclick="window.open('{{'https://www.linkedin.com/shareArticle?mini=true&url='.route('artigos')}}','popup','width=600,height=600'); return false;"--}}
                           {{--class="social-icon social-icon-border social-linkedin float-left"--}}
                           {{--data-toggle="tooltip" data-placement="top" title="Linkedin">--}}
                            {{--<i class="icon-linkedin"></i>--}}
                            {{--<i class="icon-linkedin"></i>--}}
                        {{--</a>--}}
                    {{--</div>--}}

                </div>

            </div>


        </div>
    </section>
    <!-- / -->

@endsection

@section('page-scripts')
    {{-- facebook plugin --}}
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
