@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>
                            <button class="btn btn-sm btn-gold" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> </button>
                            <label>{!! trans('admin.ID') !!}: {!! $models->id !!}</label>
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! aurl() !!}">{!! trans('admin.Dashboard') !!}</a> /</li>
                            <li><a href="{!! aurl('admins') !!}">{!! trans('admin.Admin Account') !!}</a> /</li>
                            <li class="breadcrumb-item active">{!! $title??'Show' !!}</li>
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

                        <div class="card-body register-card-body col-12" >
                            <!--- start  -->

                            <div class="table">

                                <table class="table table-bordered">

                                    <tr>
                                        <td colspan="2">
                                            <div align="center">
                                                <img src="{!! url('/').'/storage/'.$models->img_cover !!}" width="300" class="img-rounded">
                                                <br>
                                                <label>{!! trans('model.Nickname').': ' !!}</label>
                                                <span>{!! $models->nick_name??'' !!}</span>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                  <label>{!! trans('model.Full name') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $profile->full_name??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Instagram') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $models->instagram??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Mobile No.') !!}</label>
                                                    <input type="text" class="form-control " value="{!! '0'.$models->phone??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('admin.Email') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $profile->email??'' !!}" readonly />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Age') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $profile->age??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Length') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $profile->length??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Weight') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $profile->weight??'' !!}" readonly />
                                                </div>
                                            </div>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Start work') !!}</label>
                                                    <input type="text" class="form-control " value="{!! substr($profile->start_work,0,5)??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.End work') !!}</label>
                                                    <input type="text" class="form-control " value="{!! substr($profile->end_work,0,5)??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('model.Nationality') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $profile->nationality??'' !!}" readonly />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{!! trans('model.Verify Phone') !!}</label>
                                                    @if($models->verify_phone)
                                                        <input type="text" class="form-control bg-success" value="{!! trans('admin.Yes') !!}" readonly />
                                                        @else
                                                        <input type="text" class="form-control bg-danger" value="{!! trans('admin.Not Verify') !!}" readonly />
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label>{!! trans('admin.Email verify at') !!}</label>
                                                    @if($models->email_verified_at == null)
                                                        <input type="text" class="form-control bg-danger" value="{!! trans('admin.Not Verify') !!}" readonly />
                                                    @else
                                                        <input type="text" class="form-control " value="{!! $models->email_verified_at !!}" readonly />
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{!! trans('model.Contract accept') !!}</label>
                                                    @if($models->contract_accept)
                                                        <input type="text" class="form-control bg-success" value="{!! trans('admin.Yes') !!}" readonly />
                                                    @else
                                                        <input type="text" class="form-control bg-danger" value="{!! trans('admin.Not yet') !!}" readonly />
                                                    @endif
                                                </div>
                                                    <div class="col-md-3">
                                                        <label>{!! trans('admin.End of subscription') !!}</label>
                                                    @php($date_facturation = \Carbon\Carbon::parse($models->end_of_subscription))
                                                    @if ($date_facturation->isPast())
                                                        <input type="text" class="form-control bg-danger" value="{!! $models->end_of_subscription !!}" readonly />
                                                    @else
                                                        <input type="text" class="form-control bg-success" value="{!! $models->end_of_subscription !!}" readonly />
                                                    @endif
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>{!! trans('admin.Status') !!}</label>
                                                        @if($models->active == 'active')
                                                            <input type="text" class="form-control bg-success" value="{!! $models->active !!}" readonly />
                                                        @elseif($models->active == 'inactive')
                                                            <input type="text" class="form-control bg-danger" value="{!! $models->active !!}" readonly />
                                                        @elseif($models->active == 'pending')
                                                            <input type="text" class="form-control bg-warning" value="{!! $models->active !!}" readonly />
                                                        @endif
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(count($images)>0)
                                            <td>
                                                @for($i=0;$i<count($images);$i++)
                                                <img src="{!! url('/').'/storage/'.$images[$i]->path !!}"  class="img-rounded" style="width: 33%;">
                                                @endfor
                                            </td>
                                        @else
                                            <td class="bg-warning text-center">
                                                <h5>{!! trans('admin.The Model Not Upload Any Images For Profile') !!}</h5>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if(empty($bankInfo))
                                            <td class="bg-gray-dark text-center">
                                                <h5>{!! trans('admin.The Model Not Add Bank Information') !!}</h5>
                                            </td>
                                        @else
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>{!! trans('admin.IBAN') !!}</label>
                                                        <input type="text" class="form-control " value="{!! $bankInfo->iban??'' !!}" readonly />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>{!! trans('admin.Bank Name') !!}</label>
                                                        <input type="text" class="form-control " value="{!! $bankInfo->bank_name??'' !!}" readonly />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>{!! trans('admin.Owner Account Name') !!}</label>
                                                        <input type="text" class="form-control " value="{!! $bankInfo->owner_name??'' !!}" readonly />
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <form id="change_status_form">
                                                <select name="status" id="choice_status" class="form-control col-md-2">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                                <input type="text" name="reason_inactive" id="reason_inactive" class="form-control" placeholder="Reason of pending" readonly>
                                            </form>
                                            <input type="button" id="change_status_button"
                                                class="btn btn-info" value="Change Status"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
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

        <script>
            $('#change_status_button').on('click',function () {

                if(document.getElementById('choice_status').value === 'pending'){
                    var value = document.getElementById("reason_inactive").value.trim();
                    if (value.length === 0){
                        alert("Please write reason of pending")
                    }else{
                        $.ajax({
                            url:"{!! aurl('/').'models/status/'.$models->id !!}",
                            data:document.getElementById("change_status_form").serialize(),
                            type:"post",
                            success:function (data) {
                                console.log(data);
                            },
                            error:function (e,m) {
                                console.log('e:'+e+"||||| m:"+m);
                            }
                        })
                    }
                }
            });
            $('#choice_status').on('change',function () {
                if (this.value === 'pending'){
                    $('#reason_inactive').removeAttr('readonly');
                }else{
                    document.getElementById("reason_inactive").readOnly = true;
                }
            });
        </script>

    @endpush

@endsection

