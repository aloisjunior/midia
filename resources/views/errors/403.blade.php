@extends('layouts.frontend.master')

@section('page-css')

@endsection

@section('content')
    <section id="slider" class="fullheight dark">

        <div class="display-table">
            <div class="display-table-cell vertical-align-middle">
                <div class="container">

                    <div class="row err-404-row">
                        <div class="text-center col-md-8 col-xs-12 offset-md-2">

                            <h1 class="fa fa-frown-o fs-100 theme-color hidden-xs-down"></h1>
                            <h2><strong>Não autorizado</strong></h2>

                            <p>Não está autorizado para este recurso, procure o administrador.</p>
                            <p>Por favor, retorne a página inicial.</p>

                        </div>
                        <a href="{{route('inicio')}}" rel="nofollow"
                           class="btn btn-xlg btn-success fs-20 fullwidth m-0 rad-0 p-40">
				            <span class="font-lato fs-30">
					        Volte para página principal
					        <strong>Aqui &raquo;</strong>
				            </span>
                        </a>
                        {{--<p></p>--}}
                        {{--<a href="{{route('login')}}" rel="nofollow"--}}
                           {{--class="btn btn-xlg btn-info fs-20 fullwidth m-0 rad-0 p-40">--}}
				            {{--<span class="font-lato fs-30">--}}
					        {{--Ou, faça o login--}}
					        {{--<strong>Aqui &raquo;</strong>--}}
				            {{--</span>--}}
                        {{--</a>--}}
                    </div>

                </div>
            </div>
        </div>

    </section>



@endsection

@section('page-scripts')

@endsection
