@extends('layouts.comum.base')

@section('container')
    @include('layouts.backend.parts.head')

    @include('layouts.backend.parts.header-auth')

    <div class="container">
        <div class="text-center">
            <img style="padding-bottom: 20px; width: 100px;" src="{{ asset('img/ayro.png') }}"
                 alt="" />
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-block">
                        <form class="" role="form" method="POST" action="{{ route('register') }}">{{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="form-control-label">Name</label>

                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                           required="required" autofocus="autofocus" />@if ($errors->has('name')) <span class="help-block">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="form-control-label">E-Mail Address</label>

                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           required="required" />@if ($errors->has('email')) <span class="help-block">

                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="form-control-label">Password</label>

                                    <input id="password" type="password" class="form-control" name="password"
                                           required="required" />@if ($errors->has('password')) <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="form-control-label">Confirm Password</label>

                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                           required="required" />

                            </div>
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
