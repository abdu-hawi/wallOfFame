
@if($status == 'inactive')
<button class="btn btn-danger btn-sm" id="status_{!! $id !!}" data-toggle="modal" data-target="#user_status_modal_{!! $id !!}">
    {!! trans('admin.Inactive') !!}
</button>
@elseif($status == 'active')
    <button class="btn btn-success btn-sm" id="status_{!! $id !!}" data-toggle="modal" data-target="#user_status_modal_{!! $id !!}">
        {!! trans('admin.Active') !!}
    </button>
@endif

<div class="modal fade" id="user_status_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-gradient-success">
                <h4 class="modal-title">{!! trans('admin.Status') !!}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <h5>{!! trans('admin.are_you_sure_you_want_status_user',['s'=>'( ','name'=>$name]) !!}</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.Close') !!}</button>
                <button type="submit" class="btn btn-outline-success status-admin-{!! $id !!}" data-dismiss="modal">{!! trans('admin.Agree') !!}</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('admins/'.$id),'id'=>'form_status_admin_'.$id,'method'=>'put']) !!}
<input type="hidden" name="status" value="{!! $status == 'inactive' ? 'active':'inactive' !!}" >
<input type="hidden" name="name" value="{!! $name !!}" >
<input type="hidden" name="email" value="{!! $email !!}" >
<div id="len_sta_{!! $id !!}">
    <input type="hidden" name="pageLength" id="pageLength" value="10">
    <input type="hidden" name="displayStart" id="displayStart" value="0">
    <input type="hidden" name="column" id="column" value="0">
    <input type="hidden" name="dir" id="dir" value="desc">
</div>
{!! Form::close() !!}

<script>
    $(document).on('click','.status-admin-{!! $id !!}',function(){
        $('#form_status_admin_{!! $id !!}').submit();
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


