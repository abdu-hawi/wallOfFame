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
                            <li><a href="{!! aurl('cities') !!}">{!! trans('admin.Cities') !!}</a> /</li>
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
                            {!! Form::open(['url'=>aurl('cities')]) !!}

                            <div class="input-group mb-3">
                                <label class="form-control col-4">{!! trans('admin.Arabic City Name') !!}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('city_name_ar') is-invalid @enderror"
                                       name="city_name_ar" value="{!! old('city_name_ar') !!}"
                                       placeholder="{!! trans('admin.Arabic City Name') !!}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
                                    </div>
                                </div>
                                @error('city_name_ar')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="form-control col-4">{!! trans('admin.English City Name') !!}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('city_name_en') is-invalid @enderror"
                                       name="city_name_en" value="{!! old('city_name_en') !!}"
                                       placeholder="{!! trans('admin.English City Name') !!}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
                                    </div>
                                </div>
                                @error('city_name_en')
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

