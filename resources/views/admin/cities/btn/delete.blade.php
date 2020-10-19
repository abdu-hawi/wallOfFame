



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cities_delete_modal_{!! $id !!}">
    <i class="fa fa-trash"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="cities_delete_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-danger">
                <h4 class="modal-title">{!! trans('admin.Delete City') !!}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


        <!-- Modal body -->
            <div class="modal-body">
                <h5>{!! trans('admin.Are you sure you want delete city',['s'=>'( ','name'=>lang() == 'ar'?$city_name_ar:$city_name_en,'q'=>' )?']) !!}</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.Close') !!}</button>
                <button type="submit" class="btn btn-outline-danger delete-city-{!! $id !!}" data-dismiss="modal">{!! trans('admin.Agree') !!}</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('cities/'.$id),'id'=>'form_delete_city_'.$id,'method'=>'delete']) !!}
{!! Form::close() !!}

<script>
    $(document).on('click','.delete-city-{!! $id !!}',function(){
        $('#form_delete_city_{!! $id !!}').submit();
    });
</script>
