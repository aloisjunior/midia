<div id="header" class="navbar-toggleable-md sticky dark header-md transparent b-0 clearfix">

    <!-- TOP NAV -->
    <header id="topNav">
        <div class="container"><!-- add .full-container for fullwidth -->

            <!-- Mobile Menu Button -->
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>


            <!-- BUTTONS -->
            <ul class="float-right nav nav-pills nav-second-main">

                <!-- SEARCH -->
                {{--<li class="search">--}}
                    {{--<a href="javascript:;">--}}
                        {{--<i class="fa fa-search"></i>--}}
                    {{--</a>--}}
                    {{--<div class="search-box">--}}
                        {{--<form action="page-search-result-1.html" method="get">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" name="src" placeholder="Procurar" class="form-control"/>--}}
                                {{--<span class="input-group-btn">--}}
												{{--<button class="btn btn-primary" type="submit">Procurar</button>--}}
											{{--</span>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</li>--}}
                <!-- /SEARCH -->

            </ul>
            <!-- /BUTTONS -->

            <!-- Logo -->
            <a class="logo float-left" href="{{ route('inicio') }}">
                <img src="{{ getCDN('/img/ayro.png', 'cdn2') }}" alt="" style="padding: 5px"/>
                {{--<aton-bodymovin :width="300" />--}}
            </a>

            <!--
                Top Nav

                AVAILABLE CLASSES:
                submenu-dark = dark sub menu
            -->
            <div class="navbar-collapse collapse float-right nav-main-collapse submenu-dark">
            {{--<div class="navbar-toggleable-md sticky transparent clearfix">--}}
                <nav class="nav-main">

                    <!--
                        NOTE

                        For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
                        Direct Link Example:

                        <li>
                            <a href="#">HOME</a>
                        </li>
                    -->
                    <ul id="topMain" class="nav nav-pills nav-main">
                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate ">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon" href="{{ route('inicio') }}">
                                <b>Início</b>
                            </a>
                        </li>

                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate ">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon" href="{{ route('sobre') }}">
                                <b>Sobre</b>
                            </a>
                        </li>

                        <!--
                           MENU ANIMATIONS
                               .nav-animate-fadeIn
                               .nav-animate-fadeInUp
                               .nav-animate-bounceIn
                               .nav-animate-bounceInUp
                               .nav-animate-flipInX
                               .nav-animate-flipInY
                               .nav-animate-zoomIn
                               .nav-animate-slideInUp

                               .nav-hover-animate 		= animate text on hover

                               .hover-animate-bounceIn = bounceIn effect on mouse over of main menu
                       -->
                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate ">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon" href="#">
                                <span class="badge badge-danger float-right fs-11">Novidades!</span>
                                <b>Nossos Produtos e Serviços</b>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-clean">
                                <li>
                                    <div class="row">

                                        <div class="col-md-5th">
                                            <ul class="list-unstyled">
                                                <li><span>LINKS : MATERIAIS</span></li>
                                                <li class="divider"></li>
                                                <li>
                                                    <span class="fs-11 mt-0 pb-15 pt-15 text-info">Baixe nosso material e fique informado sobre nossos produtos e serviços</span>
                                                </li>
                                                <li class="divider"></li>

                                                <p class="menu-caption hidden-xs-down text-muted text-center">
                                                <li><a href="{{ route('downloads') }}">Área de downloads (MidiaKit)</a></li>
                                                </p>


                                                <li class="divider"></li>
                                                {{--<li><a target="_blank" href="pack-megashop-home-1.html">Rádio Indoor</a></li>--}}
                                                {{--<li><a target="_blank" href="pack-hotel-home-1.html">TV Corporativa</a></li>--}}
                                                <li><span>CONTATOS</span></li>
                                                <li><a href="{{ route('contato') }}">Quero falar com a Akhena</a></li>
                                            </ul>
                                        </div>

                                        <div class="col-md-5th">
                                            <ul class="list-unstyled">
                                                <li><span>SERVIÇOS</span></li>
                                                <li><a href="{{ route('midiaindoor') }}">Midia Digital Indoor</a></li>
                                                <li><a href="{{ route('tvcorporativa') }}">TV Coporativa</a></li>
                                                <li><a href="{{ route('vitrinedigital') }}">Vitrine Digital</a></li>

                                                <li><a href="{{ route('radioindoor') }}">Rádio Indoor</a></li>
                                                <li class="divider"></li>

                                                {{--<li class="divider"></li>--}}
                                                {{--<li><a href="{{ route('sobre') }}">Sobre a Akhena</a></li>--}}

                                                {{--<li><span>SERVIÇOS</span></li>--}}
                                                <li><a href="{{ route('criacaovideos') }}">Criação de Vídeos
                                                        <b>Motion Graphics</b></a></li>
                                                {{--<li><a target="_blank" href="index-thematics-hosting.html">Hospedagem de--}}
                                                        {{--<b>Sites</b></a></li>--}}
                                                <li><a href="{{ route('desenvolvimento') }}">Desenvolvimento de
                                                        <b>Softwares</b></a></li>

                                                {{--<p class="menu-caption hidden-xs-down text-muted text-center">--}}
                                                <li class="divider"></li>
                                                <li class="mt-10">
                                                    <a href="{{ route('pontos') }}"><span class="fs-11 mt-0 pb-15 pt-15 text-info uppercase">Pontos de Veiculação
                                                    </span></a>
                                                </li>
                                                {{--</p>--}}

                                            </ul>
                                        </div>


                                        <div class="col-md-5th hidden-sm text-center">
                                            <ul class="list-unstyled">
                                            <li><a href="{{ route('sobre') }}">Sobre a Akhena</a></li>
                                            <li class="divider"></li>
                                            <div class="p-15 block">
                                                <img class="img-fluid" src="{{ getCDN('/img/ayro.png', 'cdn2') }}" alt=""/>
                                            </div>
                                            <li class="divider"></li>
                                            <p class="menu-caption hidden-xs-down text-muted text-center">
                                                <li>
                                                <a target="_blank" href="{{ route('admin') }}"><span class="fs-11 mt-0 pb-15 pt-15 text-info uppercase">Login
                                                    <b>sistema Akhena</b></span></a>
                                                </li>
                                            </p>
                                            </ul>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </li>




                        <li class="dropdown"><!-- BLOG and SHOP -->
                            <a class="dropdown-toggle" href="#">
                                Artigos &amp; Notícias
                            </a>
                            <ul class="dropdown-menu">

                                <!-- BLOG -->
                                <li>
                                    {{--<a href="{{ route('artigos') }}"><i class="fa fa-list-alt"></i> Artigos</a>--}}
                                    <a href="{{ route('artigos') }}"><i class="fa fa-list-alt text-danger"></i> Artigos</a>
                                </li>
                                <!-- noticias -->
                                <li>
                                    <a href="{{ route('categoria.detalhe', 'noticias') }}"><i class="fa fa-newspaper-o text-danger"></i> Notícias</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate active">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon active" href="{{ route('contato') }}">
                                <b>Contato</b>
                            </a>
                        </li>



                    </ul>

                </nav>
            </div>

        </div>
    </header>
    <!-- /Top Nav -->

</div>