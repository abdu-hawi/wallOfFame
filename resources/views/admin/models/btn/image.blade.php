<!-- Trigger the modal with a button -->
<a data-toggle="modal" data-target="#myModal_{!! $id !!}">
    <img src="{!! url('/').'/storage/'.$img_cover !!}" class="rounded-circle" alt="{!! $nick_name !!}" width="30" height="30">
</a>

<!-- Modal -->
<div class="modal fade" id="myModal_{!! $id !!}" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <img src="{!! url('/').'/storage/'.$img_cover !!}" class="rounded-thumbnail img-fluid bg-black" alt="{!! $nick_name !!}" >
            </div>
        </div>

    </div>
</div>
