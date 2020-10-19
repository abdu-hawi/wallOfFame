<button class="btn btn-outline-primary btn-sm" id="edit_{!! $id !!}">
    <i class="fa fa-edit"></i>
</button>

{!! Form::open(['url' => aurl('admins/'.$id.'/edit'),'id'=>'form_edit_'.$id,'method'=>'get']) !!}
<div id="len_sta_edit_{!! $id !!}">
    <input type="hidden" name="pageLength" id="pageLength" value="10">
    <input type="hidden" name="displayStart" id="displayStart" value="0">
    <input type="hidden" name="column" id="column" value="0">
    <input type="hidden" name="dir" id="dir" value="desc">
</div>
{!! Form::close() !!}

<script>
    $(document).on('click','#edit_{!! $id !!}',function(){
        if (sessionStorage.getItem('displayStart') != null){
            document.getElementById("len_sta_edit_{!! $id !!}").innerHTML =
                '<input type="hidden" name="displayStart" value="'+sessionStorage.getItem('displayStart')+'" >\n'+
                '<input type="hidden" name="pageLength" value="'+sessionStorage.getItem('pageLength')+'" >\n'+
                '<input type="hidden" name="column" id="column" value="'+sessionStorage.getItem('column')+'">\n' +
                '<input type="hidden" name="dir" id="dir" value="'+sessionStorage.getItem('dir')+'">';
        }
        $('#form_edit_{!! $id !!}').submit();
    });
</script>


