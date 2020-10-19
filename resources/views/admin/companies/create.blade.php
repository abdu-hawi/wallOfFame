@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{!! $title !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! aurl() !!}">{!! trans('admin.Dashboard') !!}</a> /</li>
                            <li><a href="{!! aurl('companies') !!}">{!! trans('admin.Companies Account') !!}</a> /</li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body register-card-body col-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['url'=>aurl('companies')]) !!}
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{!! old('name') !!}" placeholder="{!! trans('admin.Name') !!}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{!! old('email') !!}" placeholder="{!! trans('admin.Email') !!}">
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
                                    <input type="text" class="form-control  @error('job_title') is-invalid @enderror" name="job_title" value="{!! old('job_title') !!}" placeholder="{!! trans('admin.Job title') !!}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-tasks"></span>
                                        </div>
                                    </div>
                                    @error('job_title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="{!! trans('admin.Password') !!}">
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
                                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation"placeholder="{!! trans('admin.Password Confirmation') !!}">
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

                                    <!-- /.col -->
                                    <div class="col-4" style="margin-right: auto;margin-left: auto">
                                        <button type="submit" class="btn btn-primary btn-block">{!! trans('admin.Agree') !!}</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @push('scripts')


    @endpush

@endsection

