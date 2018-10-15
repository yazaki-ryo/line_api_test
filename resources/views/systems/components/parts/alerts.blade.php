@if (session()->has('alerts.success'))
    @foreach (session()->get('alerts.success') as $alert)
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><span class="fa fa-check"></span>&nbsp;{{ $alert }}</strong>
        </div>
    @endforeach
@endif

@if (session()->has('alerts.info'))
    @foreach (session()->get('alerts.info') as $alert)
        <div class="alert alert-info alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><span class="fa fa-info"></span>&nbsp;{{ $alert }}</strong>
        </div>
    @endforeach
@endif

@if (session()->has('alerts.warning'))
    @foreach (session()->get('alerts.warning') as $alert)
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><span class="fa fa-exclamation"></span>&nbsp;{{ $alert }}</strong>
        </div>
    @endforeach
@endif

@if (session()->has('alerts.danger'))
    @foreach (session()->get('alerts.danger') as $alert)
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><span class="fa fa-exclamation-triangle"></span>&nbsp;{{ $alert }}</strong>
        </div>
    @endforeach
@endif
