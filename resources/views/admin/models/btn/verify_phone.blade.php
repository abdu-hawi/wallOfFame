
@if(!$verify_phone)
<button class="btn btn-danger btn-sm">
    {!! trans('admin.No') !!}
</button>
@else
    <button class="btn btn-success btn-sm">
        {!! trans('admin.Yes') !!}
    </button>
@endif
