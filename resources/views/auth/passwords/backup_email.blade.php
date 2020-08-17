@extends('layouts.comum.base')

@section('container')
    @include('layouts.backend.parts.head')

    @include('layouts.backend.parts.header-auth')

    <div class="container">
        <div class="text-center">
            <img style="padding-bottom: 20px; width: 100px;" src="{{ asset('img/ayro.png') }}"
                 alt=""/>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-block">@if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>@endif
                        <form class="" role="form" method="POST"
                              action="{{ route('password.email') }}">{{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col form-control-label">E-Mail Address</label>

                                <div class="col">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}"
                                           required="required"/>@if ($errors->has('email')) <span class="help-block">

                                            <strong>{{ $errors->first('email') }}</strong>

                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="container">--}}

    {{--<div class="text-center">--}}
    {{--<img style="padding-bottom: 20px; width: 100px" src="{{ asset('img/ayro.png') }}" alt="">--}}
    {{--</div>--}}

    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">Reset Password</div>--}}
    {{--<div class="panel-body">--}}
    {{--@if (session('status'))--}}
    {{--<div class="alert alert-success">--}}
    {{--{{ session('status') }}--}}
    {{--</div>--}}
    {{--@endif--}}

    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">--}}
    {{--{{ csrf_field() }}--}}

    {{--<div class="form-group{{ $errors->>has('email') ? ' has-error' : '' }}">--}}
    {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

    {{--@if ($errors->>has('email'))--}}
    {{--<span class="help-block">--}}
    {{--<strong>{{ $errors->>first('email') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<div class="col-md-6 col-md-offset-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--Send Password Reset Link--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection
