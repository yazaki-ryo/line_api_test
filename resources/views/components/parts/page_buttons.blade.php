    <div class="col-md-12">
        <div class="col-md-4">
            <p class="pagination">@lang('Displaying :begin - :end of :total', ['begin' => $paginator->firstItem(), 'end' => $paginator->lastItem(), 'total' => $paginator->total()])</p>
        </div>
        <div class="col-md-8 text-right">{{$paginator->links()}}</div>
    </div>