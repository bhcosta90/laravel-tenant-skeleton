<div class='card'>
    @isset($title)
    <div class='card-header'>
        <div class='float-start'>
            <h4 class='m-0 p-0'>{{$title}}</h4>
        </div>
        @if(!empty($add))
        <div class='float-end'>
            <a href="{{ $add }}" class='btn btn-outline-success btn-sm'>{{$labelAdd ?? $add}}</a>
        </div>
        @endif
    </div>
    @endif
    {{ $slot }}

    @if(is_object($data) && class_basename(get_class($data)) == 'LengthAwarePaginator' && $data->lastPage() > 1)
    <div class='card-footer'>
        <div class='float-start'>{{ $data->appends(request()->all())->links() }}</div>
        <div class='float-end' style='padding-top:5px'><small class='text-muted'>{{ __(':total item(s)', ['total' => $data->total()]) }}</small></div>
    </div>
    @endif
</div>
