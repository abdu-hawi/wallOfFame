
@if($active == 'inactive')
<button class="btn btn-danger btn-sm" id="status_{!! $id !!}" data-toggle="modal" data-target="#model_status_modal_{!! $id !!}">
    {!! trans('admin.Inactive') !!}
</button>
@elseif($active == 'active')
    <button class="btn btn-success btn-sm" id="status_{!! $id !!}" data-toggle="modal" data-target="#model_status_modal_{!! $id !!}">
        {!! trans('admin.Active') !!}
    </button>
@elseif($active == 'pending')
    <button class="btn btn-warning btn-sm" id="status_{!! $id !!}" data-toggle="modal" data-target="#model_status_modal_{!! $id !!}">
        {!! trans('admin.Pending') !!}
    </button>
@endif

<div class="modal fade" id="model_status_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-gradient-success">
                <h4 class="modal-title">{!! trans('admin.Status') !!}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <h5>{!! trans('admin.Please chose to any status change',['name'=>$gm_name , 'company'=>$company_name]) !!}</h5>

                {!! Form::open(['url' => aurl('companies/status/'.$id),'id'=>'form_status_model_'.$id,'method'=>'put']) !!}
                <select name="active" id="active_{!! $id !!}" class="form-control">
                    <option value="active" {!! $active == 'active'?'selected class="bg-success"':'' !!}>Active</option>
                    <option value="inactive" {!! $active == 'inactive'?'selected class="bg-success"':'' !!}>Inactive</option>
                    <option value="pending" {!! $active == 'pending'?'selected class="bg-success"':'' !!}>Pending</option>
                </select>
                <div id="len_sta_{!! $id !!}">
                    <input type="hidden" name="pageLength" id="pageLength" value="10">
                    <input type="hidden" name="displayStart" id="displayStart" value="0">
                    <input type="hidden" name="column" id="column" value="0">
                    <input type="hidden" name="dir" id="dir" value="desc">
                </div>
                {!! Form::close() !!}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.Close') !!}</button>
                <button type="submit" class="btn btn-outline-success status-model-{!! $id !!}" data-dismiss="modal">{!! trans('admin.Agree') !!}</button>
            </div>

        </div>
    </div>
</div>

{{--<div id="active_div_{!! $id !!}">--}}
{{--    <input type="hidden" name="active" value="{!! $active !!}" >--}}
{{--</div>--}}
{{--<input type="hidden" name="name" value="{!! $name !!}" >--}}
{{--<input type="hidden" name="email" value="{!! $email !!}" >--}}


<script>
    $(document).on('click','.status-model-{!! $id !!}',function(){
        {{--const active = $('#active_{!! $id !!}').val();--}}
        {{--document.getElementById("active_div_{!! $id !!}'").innerHTML= '<input type="hidden" name="active" value="'+active+'" >';--}}
        $('#form_status_model_{!! $id !!}').submit();
    });
    $(document).on('click','#status_{!! $id !!}',function () {
        if (sessionStorage.getItem('displayStart') != null){
            document.getElementById("len_sta_{!! $id !!}").innerHTML =
                '<input type="hidden" name="displayStart" value="'+sessionStorage.getItem('displayStart')+'" >\n'+
                '<input type="hidden" name="pageLength" value="'+sessionStorage.getItem('pageLength')+'" >\n'+
                '<input type="hidden" name="column" id="column" value="'+sessionStorage.getItem('column')+'">\n' +
                '<input type="hidden" name="dir" id="dir" value="'+sessionStorage.getItem('dir')+'">';
        }
    });
</script>


