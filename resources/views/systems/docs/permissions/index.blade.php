@extends('systems.layouts.app')

@section('meta')
    <title>@lang ('elements.words.authorization') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.authorization')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <ul class="nav nav-tabs">
                    @foreach ($permissions as $label => $rows)
                        <li class="{{ $loop->first ? 'active' : '' }}">
                            <a href="{{ sprintf('#%s-tab', $label) }}" data-toggle="tab">
                                @lang (sprintf('elements.words.%s', $label))
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach ($permissions as $label => $rows)
                        <div class="tab-pane {{ $loop->first ? 'active' : '' }} fade in pt-5" id="{{ sprintf('%s-tab', $label) }}">
                            @include ('systems.docs.permissions.components.list', ['rows' => $rows])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript">
        //
    </script>
@endsection
