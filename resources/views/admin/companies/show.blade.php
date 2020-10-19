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
                            <label>{!! trans('admin.ID') !!}: {!! $company->id !!}</label>
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! aurl() !!}">{!! trans('admin.Dashboard') !!}</a> /</li>
                            <li><a href="{!! aurl('companies') !!}">{!! trans('admin.Companies Account') !!}</a> /</li>
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
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>{!! trans('admin.GM Name') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $company->gm_name??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                  <label>{!! trans('admin.Email') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $company->email??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('company.Phone') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $company->phone??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('company.Company Name') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $company->company_name??'' !!}" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>{!! trans('company.Commercial register number') !!}</label>
                                                    <input type="text" class="form-control " value="{!! $company->commercial_register_number??'' !!}" readonly />
                                                </div>
                                            </div>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{!! trans('model.Verify Phone') !!}</label>
                                                    @if($company->verify_phone)
                                                        <input type="text" class="form-control bg-success" value="{!! trans('admin.Yes') !!}" readonly />
                                                        @else
                                                        <input type="text" class="form-control bg-danger" value="{!! trans('admin.Not Verify') !!}" readonly />
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label>{!! trans('admin.Email verify at') !!}</label>
                                                    @if($company->email_verified_at == null)
                                                        <input type="text" class="form-control bg-danger" value="{!! trans('admin.Not Verify') !!}" readonly />
                                                    @else
                                                        <input type="text" class="form-control " value="{!! $company->email_verified_at !!}" readonly />
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{!! trans('model.Contract accept') !!}</label>
                                                    @if($company->contract_accept)
                                                        <input type="text" class="form-control bg-success" value="{!! trans('admin.Yes') !!}" readonly />
                                                    @else
                                                        <input type="text" class="form-control bg-danger" value="{!! trans('admin.Not yet') !!}" readonly />
                                                    @endif
                                                </div>
                                                    <div class="col-md-2">
                                                        <label>{!! trans('admin.Status') !!}</label>
                                                        @if($company->active == 'active')
                                                            <input type="text" class="form-control bg-success" value="{!! $company->active !!}" readonly />
                                                        @elseif($company->active == 'inactive')
                                                            <input type="text" class="form-control bg-danger" value="{!! $company->active !!}" readonly />
                                                        @elseif($company->active == 'pending')
                                                            <input type="text" class="form-control bg-warning" value="{!! $company->active !!}" readonly />
                                                        @endif
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
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
                        const status = document.getElementById('choice_status').value;
                        const reason = document.getElementById('reason_inactive').value;
                        $.ajax({
                            url:"{!! aurl('/').'models/status/'.$company->id !!}",
                            data:{"status":status,"reason_inactive":reason},
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

