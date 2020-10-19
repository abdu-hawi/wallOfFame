



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#ext_delete_modal_{!! $id !!}">
    <i class="fa fa-recycle"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="ext_delete_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-warning">
                <h4 class="modal-title">{!! trans('admin.Extension to booking') !!}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


        <!-- Modal body -->
            <div class="modal-body">
                <h5>{!! trans('admin.Are you sure you want extension this quotation to booking?') !!}</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.Close') !!}</button>
                <button type="submit" class="btn btn-outline-danger delete-ext-{!! $id !!}" data-dismiss="modal">{!! trans('admin.Agree') !!}</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('quotations/ext/'.$id),'id'=>'form_ext_'.$id,'method'=>'post']) !!}
{!! Form::close() !!}

<script>
    $(document).on('click','.delete-ext-{!! $id !!}',function(){
        $('#form_ext_{!! $id !!}').submit();
    });
</script>
