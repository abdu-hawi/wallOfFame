@extends('admin.layouts.app_login')
@section('content')




    <div class="login-box col-sm-12">
{{--        <div class="login-logo">--}}
{{--            <b>{{ config('app.name', 'Wall Of Fame') }}</b>--}}
{{--        </div>--}}
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-header" >
                {!! trans('admin.Reset Password') !!}
            </div>
            <div class="card-body login-card-body">

                <form action="{!! route('admin.password.update') !!}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="{!! trans('admin.Email') !!}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="{!! trans('admin.Password') !!}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                               placeholder="{!! trans('admin.Password Confirmation') !!}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-4">
                            <button type="submit" class="btn btn-gold btn-block">{!! trans('admin.Reset Password') !!}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@stop
