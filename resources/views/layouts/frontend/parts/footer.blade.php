<!-- FOOTER -->
<footer id="footer">
    <div class="container pt-0 pb-0">

        <div class="row mt-30 mb-0 fs-13">

            <!-- col #1 -->
            <div class="col-md-4 col-sm-4 mb-0">

                <!-- Footer Logo -->
                {{--                <img class="footer-logo wow fadeIn animated" src="{{ asset('img/ayro.png') }}" alt="" style="width: 150px"/>--}}
                <img class="footer-logo wow fadeIn animated" src="{{ getCDN('/img/ayro.png', 'cdn2') }}" alt="" style="width: 220px"/>
                {{--<div class="footer-logo col-md-4 col-sm-4 mb-0 text-center">--}}
                    {{--<div >--}}
                        {{--<aton-bodymovin :width="220"/>--}}
                    {{--</div>--}}
                {{--</div>--}}


                <div>
                <h2>
                    <i class="fa fa-phone"></i> (51) 3377-8830 <br>
                    <i class="fa fa-whatsapp"></i> (51) 99663-8988
                </h2>
                </div>
                <!-- Social Icons -->
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
                <!-- /Social Icons -->

            </div>
            <!-- /col #1 -->

            <!-- col #2 -->
            <div class="col-md-8 col-sm-8 mb-0">

                <div class="row">

                    <aton-posts-footer></aton-posts-footer>

                    <div class="col-md-3 hidden-sm hidden-xs-down">
                        <h4 class="letter-spacing-1">ACESSO RÁPIDO</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="{{ route('midiaindoor') }}"><i class="fa fa-angle-right"></i> Mídia Indoor</a></li>
                            <li><a class="block" href="{{ route('tvcorporativa') }}"><i class="fa fa-angle-right"></i> TV Corporativa</a></li>
                            <li><a class="block" href="{{ route('vitrinedigital') }}"><i class="fa fa-angle-right"></i> Vitrine Digital</a></li>
                            <li><a class="block" href="{{ route('radioindoor') }}"><i class="fa fa-angle-right"></i> Rádio Indoor</a></li>
                            <li><a class="block" href="{{ route('pontos') }}"><i class="fa fa-angle-right"></i> Pontos de Veiculação</a></li>
                            <li><a class="block" href="{{ route('sobre') }}"><i class="fa fa-angle-right"></i> Sobre a
                                    Akhena</a></li>
                            <li><a class="block" href="{{ route('contato') }}"><i class="fa fa-angle-right"></i> Contato</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 mb-0">
                        <h4 class="letter-spacing-1">PÁGINA SEGURA</h4>
                        {{--<p>Prezamos pela segurança de nossos visitantes. Imagina dos clientes.</p>--}}
                        {{--<p>	<!-- see img/_smarty/cc/ for more icons -->--}}
                        <img src="{{getCDN('/img/atonmidia/site-seguro.png', 'cdn2') }}" width="200px" alt="" />
                        {{--<img src="img/_smarty/cc/Mastercard.png" alt="" />--}}
                        {{--<img src="img/_smarty/cc/Maestro.png" alt="" />--}}
                        {{--<img src="img/_smarty/cc/PayPal.png" alt="" />--}}
                        {{--</p>--}}
                    </div>

                </div>

            </div>
            <!-- /col #2 -->

        </div>

    </div>

    <div class="copyright">
        <div class="container">
            <ul class="float-right m-0 list-inline mobile-block">
                {{--<li><a href="#">Termos &amp; Condições</a></li>--}}
                {{--<li>&bull;</li>--}}
                {{--<li><a href="#">Privacidade</a></li>--}}
            </ul>
            &copy; Akhena - Todos direitos reservados
        </div>
    </div>
</footer>
<!-- /FOOTER -->