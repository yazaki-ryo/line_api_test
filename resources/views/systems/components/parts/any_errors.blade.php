@foreach ($errors->getBags() as $errorBag)
    @if ($errorBag->any())
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><span class="fa fa-exclamation-triangle"></span>&nbsp;@lang ('There is an item of input error.')</strong>
        </div>

        @break
    @endif
@endforeach

