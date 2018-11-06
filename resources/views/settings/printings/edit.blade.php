@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.print')@lang ('elements.words.settings') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.print')@lang ('elements.words.settings')
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
                    @foreach ($rows as $key => $item)
                        <li class="{{ $key === 1 ? \Util::activatable($errors) : \Util::activatable($errors, sprintf('settings_printings_request_%s', $key)) }}">
                            <a href="{{ sprintf('#setting%s-tab', $key) }}" data-toggle="tab">
                                {{ is_null($rows[$key]) ? sprintf('%s%s', __('elements.words.settings'), $key) : $rows[$key]->name() }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach ($rows as $key => $item)
                        <div class="tab-pane fade in pt-10 {{ $key === 1 ? \Util::activatable($errors) : \Util::activatable($errors, sprintf('settings_printings_request_%s', $key)) }}" id="{{ sprintf('setting%s-tab', $key) }}">
                            <div class="well">
                                {!! Form::open(['url' => route('settings.printings.update', $key), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                    @include ('settings.printings.components.crud', ['row' => is_null($rows[$key]) ? $brankPrintSetting : $rows[$key], 'key' => $key, 'errorBag' => sprintf('settings_printings_request_%s', $key)])
                                {!! Form::close() !!}
                            </div>
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
