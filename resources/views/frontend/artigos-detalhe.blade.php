@extends('layouts.frontend.master')

@section('page-title')
    Akhena - {!! $artigos->titulo !!}
@endsection

@section('page-tags', $artigos->tags)

@section('page-meta')

    <link rel="canonical" href="{{route('artigos.detalhe', $artigos->slug)}}" />
    <meta property="og:url" content="{{route('artigos.detalhe', $artigos->slug)}}" />

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="{!! $artigos->titulo !!}" />
    <meta name="twitter:title" content="{!! $artigos->titulo !!}" />

    <meta name="description" content="{!! html_entity_decode(strip_tags($artigos->apresentacao)) !!}">
    <meta property="og:description" content="{!! html_entity_decode(strip_tags($artigos->apresentacao)) !!}" />
    <meta name="twitter:description" content="{!! html_entity_decode(strip_tags($artigos->apresentacao)) !!}" />

    {{--<meta property="og:keyword"       content="{!! url($artigos->tags) !!}" />--}}

    <meta property="og:type" content="article">
    <meta property="fb:app_id" content="144291826259901" />

    <meta property="og:site_name" content="Akhena - Ampliando Resultados com  Tecnologia" />

    {{--@if($artigos->url_video != '')--}}
        {{--<meta property="og:image" content="{{asset('img/atonmidia/atonmidia-servicos.jpg')}}" />--}}
        {{--<meta name="twitter:image:src" content="{{asset('img/atonmidia/atonmidia-servicos1x1.jpg')}}" />--}}
    {{--@else--}}
        @foreach($artigos->arquivos as $arquivo)
            <meta property="og:image" content="{{asset('storage/artigos/'.$arquivo->filename)}}" />
            <meta name="twitter:image:src" content="{{asset('storage/artigos/'.$arquivo->filename)}}" />
        @endforeach
    {{--@endif--}}


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
                <li class="active">{{ $artigos->titulo }}</li>
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

                    <h1 class="blog-post-title">{{ $artigos->titulo }}</h1>
                    <ul class="blog-post-info list-inline">
                        <li>
                            <a href="#">
                                <i class="fa fa-clock-o"></i>
                                <span class="font-lato">
                                    {!! date('d', strtotime($artigos->created_at))!!} {!! substr(mes_pt_br($artigos->created_at), 0, 3)!!}
                                    , {!! date('Y', strtotime($artigos->created_at)) !!}
                                </span>
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-folder-open-o"></i>

                            @foreach( $artigos->list_categorias as $categoria )
                                <a class="category" href="{!! route('categoria.detalhe', $categoria)!!}">
                                    <span class="font-lato">{{ $categoria }}  </span>
                                </a>
                            @endforeach
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="font-lato">by Akhena</span>
                                {{--<span class="font-lato">{{ $artigos->name }}</span>--}}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-eye"></i>
                                <span class="font-lato">{{ $artigos->views }}</span>
                            </a>
                        </li>
                    </ul>


                    @if($artigos->url_video != '')
                        <div class="mb-20 embed-responsive embed-responsive-16by9">
                            {!!  $artigos->url_video !!}
                            {{--<iframe class="embed-responsive-item" src="{{$artigos->url_video}}" width="800"--}}
                            {{--height="auto"></iframe>--}}
                        </div>
                    @elseif (count($artigos->arquivos) > 0 )
                        <div class="flexslider" data-arrowNav="false" data-slideshowSpeed="3000">
                            <ul class="slides">
                                @foreach( $artigos->arquivos as $arquivo )
                                    <li>
                                        <a class="lightbox" href="{{ url('/storage/'.$arquivo->link) }}"
                                        data-plugin-options='{"type":"image"}'>
                                        <img class="img-fluid" src="{{url('/storage/'.$arquivo->link)}}" alt=""/>
                                        </a>
                                    </li>
                            @endforeach
                        </div>
                    @endif

                    {{--@if(count($artigos->arquivos) > 0 )--}}
                        {{--<div class="owl-carousel buttons-autohide controlls-over"--}}
                             {{--data-plugin-options='{"items": {{count($artigos->arquivos)}}, "autoPlay": 4500, "autoHeight": true, "navigation": true, "pagination": true, "transitionStyle":"fadeUp", "progressBar":"false"}'>--}}
                            {{--@foreach( $artigos->arquivos as $arquivo )--}}
                                {{--<a class="lightbox" href="{{ url('/storage/'.$arquivo->link) }}"--}}
                                   {{--data-plugin-options='{"type":"image"}'>--}}
                                    {{--<img class="img-fluid" src="{{url('/storage/'.$arquivo->link)}}" alt=""/>--}}
                                {{--</a>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--@endif--}}


                <!-- OWL SLIDER -->
                    <!--
                    <div class="owl-carousel buttons-autohide controlls-over" data-plugin-options='{"items": 1, "autoPlay": 4500, "autoHeight": false, "navigation": true, "pagination": true, "transitionStyle":"fadeUp", "progressBar":"false"}'>
                        <a class="lightbox" href="demo_files/images/1200x800/10-min.jpg" data-plugin-options='{"type":"image"}'>
                            <img class="img-fluid" src="demo_files/images/content_slider/10-min.jpg" alt="" />
                        </a>
                        <a class="lightbox" href="demo_files/images/1200x800/3-min.jpg" data-plugin-options='{"type":"image"}'>
                            <img class="img-fluid" src="demo_files/images/content_slider/3-min.jpg" alt="" />
                        </a>
                        <a class="lightbox" href="demo_files/images/1200x800/21-min.jpg" data-plugin-options='{"type":"image"}'>
                            <img class="img-fluid" src="demo_files/images/content_slider/21-min.jpg" alt="" />
                        </a>
                    </div>
                    -->
                    <!-- /OWL SLIDER -->

                    <!-- IMAGE -->
                    {{--<figure class="mb-20">--}}
                    {{--<img class="img-fluid" src="demo_files/images/content_slider/21-min.jpg" alt="img" />--}}
                    {{--</figure>--}}
                <!-- /IMAGE -->

                    <!-- VIDEO -->


                    <!-- /VIDEO -->


                    <!-- article content -->

                    <p>
                        {!! $artigos->apresentacao !!}
                    </p>

                    <p>
                        {!! $artigos->corpo !!}
                    </p>
                    <!-- /article content -->


                    <div class="divider divider-dotted"><!-- divider --></div>


                    <!-- TAGS -->
                    @foreach( $artigos->list_tags as $tag )
                        <a class="tag" href="{!! route('tag.detalhe', $tag)!!}">
                            <span class="txt">{{ $tag }}</span>
                        </a>

                    @endforeach

                <!-- /TAGS -->


                    <!-- SHARE POST -->
                    <div class="clearfix mt-30">

								<span class="float-left mt-6 bold hidden-xs-down">
									Compartilhar:
								</span>

                        <a href="https://www.linkedin.com"
                           target="popup"
                           onclick="window.open('{{'https://www.linkedin.com/shareArticle?mini=true&url='.route('artigos.detalhe', $artigos->slug)}}','popup','width=600,height=600'); return false;"
                           class="social-icon social-icon-sm social-icon-transparent social-linkedin float-right"
                           data-toggle="tooltip" data-placement="top" title="Linkedin">
                            <i class="icon-linkedin"></i>
                            <i class="icon-linkedin"></i>
                        </a>

                        <a href="https://www.twitter.com"
                           target="popup"
                           onclick="window.open('{{'https://www.facebook.com/sharer/sharer.php?u='.route('artigos.detalhe', $artigos->slug)}}','popup','width=600,height=600'); return false;"
                           class="social-icon social-icon-sm social-icon-transparent social-facebook float-right"
                           data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>

                        {{--<a href="#"--}}
                           {{--class="social-icon social-icon-sm social-icon-transparent social-twitter float-right"--}}
                           {{--data-toggle="tooltip" data-placement="top" title="Twitter">--}}
                            {{--<i class="icon-twitter"></i>--}}
                            {{--<i class="icon-twitter"></i>--}}
                        {{--</a>--}}

                        {{--<a href="#"--}}
                           {{--class="social-icon social-icon-sm social-icon-transparent social-gplus float-right"--}}
                           {{--data-toggle="tooltip" data-placement="top" title="Google plus">--}}
                            {{--<i class="icon-gplus"></i>--}}
                            {{--<i class="icon-gplus"></i>--}}
                        {{--</a>--}}



                    </div>
                    <!-- /SHARE POST -->


                    <div class="divider"><!-- divider --></div>


                    {{--<ul class="pager">--}}
                    {{--<li class="previous"><a class="b-0" href="#">&larr; Previous Post</a></li>--}}
                    {{--<li class="next"><a class="b-0" href="#">Next Post &rarr;</a></li>--}}
                    {{--</ul>--}}
                    {{--<div class="divider"><!-- divider --></div>--}}


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
                                src="https://www.youtube.com/embed/ttp7U0ONCK0?rel=0&amp;controls=0&amp;showinfo=0"
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
                           onclick="window.open('{{'https://www.linkedin.com/shareArticle?mini=true&url='.route('artigos.detalhe', $artigos->slug)}}','popup','width=600,height=600'); return false;"
                           class="social-icon social-icon-sm social-icon-transparent social-linkedin float-right"
                           data-toggle="tooltip" data-placement="top" title="Linkedin">
                            <i class="icon-linkedin"></i>
                            <i class="icon-linkedin"></i>
                        </a>

                        <a href="https://www.twitter.com"
                           target="popup"
                           onclick="window.open('{{'https://www.facebook.com/sharer/sharer.php?u='.route('artigos.detalhe', $artigos->slug)}}','popup','width=600,height=600'); return false;"
                           class="social-icon social-icon-sm social-icon-transparent social-facebook float-right"
                           data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                    </div>
                    {{--<div class="hidden-xs-down mt-30 mb-60">--}}
                        {{--<a href="https://www.facebook.com"--}}
                           {{--target="popup"--}}
                           {{--onclick="window.open('{{'https://www.facebook.com/sharer/sharer.php?u='.route('artigos.detalhe', $artigos->slug)}}','popup','width=600,height=600'); return false;"--}}
                           {{--class="social-icon social-icon-border social-facebook float-left"--}}
                           {{--data-toggle="tooltip" data-placement="top" title="Facebook"--}}
                        {{-->--}}
                            {{--<i class="icon-facebook"></i>--}}
                            {{--<i class="icon-facebook"></i>--}}

                        {{--</a>--}}

                        {{--<a href="https://www.linkedin.com"--}}
                           {{--target="popup"--}}
                           {{--onclick="window.open('{{'https://www.linkedin.com/shareArticle?mini=true&url='.route('artigos.detalhe', $artigos->slug)}}','popup','width=600,height=600'); return false;"--}}
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
