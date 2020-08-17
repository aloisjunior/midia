<div id="header" class="navbar-toggleable-md sticky header-md transparent b-0 clearfix">

    <!-- TOP NAV -->
    <header id="topNav" >
        <div class="container"><!-- add .full-container for fullwidth -->

            <!-- Mobile Menu Button -->
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>


                       <!-- Logo -->

            <img src="{{ getCDN('/img/ayro.png', 'cdn2') }}" alt="" style="padding: 5px"/>


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
                    <ul id="topMain" class="nav nav-pills nav-main" style="color: #151515;">
                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate ">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon" href="#apresentacao">
                                <b>Apresentação</b>
                            </a>
                        </li>

                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate ">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon" href="#pontos">
                                <b>Onde será veiculado meu anúncio</b>
                            </a>
                        </li>
                        <li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate ">
                            <!-- THEMATIC -->
                            <a class="dropdown-toggle noicon" href="#contato">
                                <b>Tenho interesse</b>
                            </a>
                        </li>


                    </ul>

                </nav>
            </div>

        </div>
    </header>
    <!-- /Top Nav -->

</div>