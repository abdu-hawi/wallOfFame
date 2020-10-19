

@extends('admin.layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{!! trans('admin.Settings') !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! aurl() !!}">{!! trans('admin.Dashboard') !!}</a> /</li>
                            <li class="active">{!! trans('admin.Settings') !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->



        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{!! $title !!}</h3>
                        </div>

                            @include('admin.layouts.massages')

                        <!-- /.card-header -->
                        <div class="card-body col-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('site_name_ar',trans('admin.Arabic site name')) !!}
                                {!! Form::text('site_name_ar',setting()->site_name_ar,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('site_name_en',trans('admin.English site name')) !!}
                                {!! Form::text('site_name_en',setting()->site_name_en,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email',trans('admin.Email')) !!}
                                {!! Form::text('email',setting()->email,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo',trans('admin.Logo')) !!}
                                {!! Form::file('logo',['class'=>'form-control']) !!}
                                @if(!empty(setting()->logo))
                                    <img src="{!! Storage::url(setting()->logo) !!}" height="50"/>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('icon',trans('admin.icon')) !!}
                                {!! Form::file('icon',['class'=>'form-control']) !!}
                                @if(!empty(setting()->icon))
                                    <img src="{!! Storage::url(setting()->icon) !!}" height="50"/>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('main_lang',trans('admin.Main Language')) !!}
                                {!! Form::select('main_lang',['ar'=>trans('admin.ar'),'en'=>trans('admin.en')],setting()->main_lang,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('descriptions',trans('admin.Descriptions')) !!}
                                {!! Form::textarea('descriptions',setting()->descriptions,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('keywords',trans('admin.Keywords')) !!}
                                {!! Form::textarea('keywords',setting()->keywords,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status',trans('admin.Status')) !!}
                                {!! Form::select('status',['open'=>trans('admin.Open'),'close'=>trans('admin.Closing')],setting()->status,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('msg_maintenance_ar',trans('admin.Arabic message maintenance')) !!}
                                {!! Form::textarea('msg_maintenance_ar',setting()->msg_maintenance_ar,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('msg_maintenance_en',trans('admin.English message maintenance')) !!}
                                {!! Form::textarea('msg_maintenance_en',setting()->msg_maintenance_en,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>

                            {!! Form::submit(trans('admin.Save'),['class'=>'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

