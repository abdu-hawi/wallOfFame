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
                            <li><a href="{!! aurl('subscriptions') !!}">{!! trans('admin.Subscriptions') !!}</a> /</li>
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
                            {!! Form::open(['url'=>aurl('subscriptions')]) !!}

                            <div class="input-group mb-3">
                                <label class="form-control col-4">{!! trans('admin.Duration in Arabic') !!}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('duration_ar') is-invalid @enderror"
                                       name="duration_ar" value="{!! old('duration_ar') !!}"
                                       placeholder="{!! trans('admin.Duration in Arabic') !!}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-hourglass-half"></span>
                                    </div>
                                </div>
                                @error('duration_ar')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="form-control col-4">{!! trans('admin.Duration in English') !!}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('duration_en') is-invalid @enderror"
                                       name="duration_en" value="{!! old('duration_en') !!}"
                                       placeholder="{!! trans('admin.Duration in English') !!}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-hourglass-half"></span>
                                    </div>
                                </div>
                                @error('duration_en')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="form-control col-4">{!! trans('admin.Price') !!}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('price') is-invalid @enderror"
                                       name="price" value="{!! old('price') !!}"
                                       placeholder="{!! trans('admin.Price') !!}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-money-bill-wave"></span>
                                    </div>
                                </div>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            {!! form::submit(trans('admin.Save'),['class'=>'btn btn-primary form-control']) !!}

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


    @push('jQuery')



    @endpush

@endsection

