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
                              action="{{ route('password.request') }}">{{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}"
                            />
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="form-control-label">E-Mail Address</label>

                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $email or old('email') }}"
                                           required="required" autofocus="autofocus"/>@if ($errors->has('email')) <span
                                            class="help-block">

                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="form-control-label">Password</label>

                                    <input id="password" type="password" class="form-control" name="password"
                                           required="required"/>@if ($errors->has('password')) <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm"
                                       class="form-control-label">Confirm Password</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"
                                           required="required"/>@if ($errors->has('password_confirmation')) <span
                                            class="help-block">

                                        <strong>{{ $errors->first('password_confirmation') }}</strong>

                                    </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
