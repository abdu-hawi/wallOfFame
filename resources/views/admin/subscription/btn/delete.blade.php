



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#subscriptions_delete_modal_{!! $id !!}">
    <i class="fa fa-trash"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="subscriptions_delete_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-danger">
                <h4 class="modal-title">{!! trans('admin.Delete Subscription') !!}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


        <!-- Modal body -->
            <div class="modal-body">
                <h5>{!! trans('admin.Are you sure you want delete subscription',['s'=>'( ','name'=>lang() == 'ar'?$duration_ar:$duration_en,'q'=>' )?']) !!}</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.Close') !!}</button>
                <button type="submit" class="btn btn-outline-danger delete-subscription-{!! $id !!}" data-dismiss="modal">{!! trans('admin.Agree') !!}</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('subscriptions/'.$id),'id'=>'form_delete_subscription_'.$id,'method'=>'delete']) !!}
{!! Form::close() !!}

<script>
    $(document).on('click','.delete-subscription-{!! $id !!}',function(){
        $('#form_delete_subscription_{!! $id !!}').submit();
    });
</script>
