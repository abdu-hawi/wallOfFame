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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{!! route('admin.password.email') !!}" method="post">
                    {!! csrf_field() !!}
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
                    <div class="row">

                        <div class="col-4">
                            <button type="submit" class="btn btn-gold btn-block">{!! trans('admin.Send Password Reset Link') !!}</button>
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
