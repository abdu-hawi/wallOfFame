



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-danger btn-sm" id="delete_{!! $id !!}" data-toggle="modal" data-target="#admin_delete_modal_{!! $id !!}">
    <i class="fa fa-trash"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="admin_delete_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-danger">
                <h4 class="modal-title">{!! trans('admin.Delete Admin') !!}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


        <!-- Modal body -->
            <div class="modal-body">
                <h5>{!! trans('admin.Are you sure you want delete admin',['s'=>'( ','name'=>$name,'q'=>' )?']) !!}</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.Close') !!}</button>
                <button type="submit" class="btn btn-outline-danger delete-admin-{!! $id !!}" data-dismiss="modal">{!! trans('admin.Agree') !!}</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('admins/'.$id),'id'=>'form_delete_admin_'.$id,'method'=>'delete']) !!}
<div id="len_sta_delete_{!! $id !!}">
    <input type="hidden" name="pageLength" id="pageLength" value="10">
    <input type="hidden" name="displayStart" id="displayStart" value="0">
    <input type="hidden" name="column" id="column" value="0">
    <input type="hidden" name="dir" id="dir" value="desc">
</div>
{!! Form::close() !!}

<script>
    $(document).on('click','.delete-admin-{!! $id !!}',function(){
        $('#form_delete_admin_{!! $id !!}').submit();
    });
    $(document).on('click','#delete_{!! $id !!}',function () {
        if (sessionStorage.getItem('displayStart') != null){
            document.getElementById("len_sta_delete_{!! $id !!}").innerHTML =
                '<input type="hidden" name="displayStart" value="'+sessionStorage.getItem('displayStart')+'" >\n'+
                '<input type="hidden" name="pageLength" value="'+sessionStorage.getItem('pageLength')+'" >\n'+
                '<input type="hidden" name="column" id="column" value="'+sessionStorage.getItem('column')+'">\n' +
                '    <input type="hidden" name="dir" id="dir" value="'+sessionStorage.getItem('dir')+'">';
        }
    });
</script>
