<div class='card'>
    @isset($title)
        <div class='card-header'>
            <div class='float-start'>
                <h4 class='m-0 p-0'>{{$title}}</h4>
                @if(!empty($filter))
                    @php
                        $ret = [];
                        foreach ($filter as $f) {
                            if ($f instanceof \App\Filters\Abstracts\FilterAbstract) {
                                $dataHandle = $f->handle();
                                if (request($dataHandle['name'])) {
                                    $ret[] = __($dataHandle['label']) . ": " . request($dataHandle['name']);
                                }
                            }
                        }
                        print "<a data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" href='javascript:void(1)'><i class='fa fa-filter' style='font-size:0.8em'></i>";
                        print count($ret) ? implode(', ', $ret) : "Filtrar";
                        print "</a>";
                    @endphp
                @endif
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

@if(!empty($filter))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Filtrar') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $ret = [];
                    foreach ($filter as $f) {
                        if ($f instanceof \App\Filters\Abstracts\FilterAbstract) {
                            $dataHandle = $f->handle();
                            $placeHolder = $dataHandle['placeholder'] ?? '';

                            print '<div class="card mb-3">';
                            print '<div class="card-header" onclick="$(this).parent().find(\'.card-body\').toggleClass(\'d-none\')"><i class="fa fa-angle-right"></i> '.__($dataHandle['label']).'</div>';
                            $block = 'd-none';
                            if (request($dataHandle['name'])) {
                                $block = '';
                            }
                            print "<div class='card-body {$block}'>";
                            switch($dataHandle['type']){
                                case 'text': 
                                    print "<input class='form-control' placeholder='{$placeHolder}' type='text' name='{$dataHandle['name']}' value='" . request($dataHandle['name']) . "' />";

                                break;
                                default: throw new Exception('Não implementado');
                            }

                            print "</div>";
                            print '</div>';
                        }
                    }
                @endphp
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('Aplicar') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
            </div>
        </div>
    </form>
</div>
@endif