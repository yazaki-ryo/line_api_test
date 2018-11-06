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
                    <li class="{{ \Util::activatable($errors) }}">
                        <a href="#setting1-tab" data-toggle="tab">
                            {{ is_null($rows[1]) ? sprintf('%s1', __('elements.words.settings')) : $rows[1]->name() }}
                        </a>
                    </li>
@if (false)
                    <li class="{{ \Util::activatable($errors, 'settings_printings_request_2') }}">
                        <a href="#setting2-tab" data-toggle="tab">
                            @if (empty($rows[2]))
                                @lang ('elements.words.settings')2
                            @else
                                {{ $rows[2]->name }}
                            @endif
                        </a>
                    </li>
                    <li class="{{ \Util::activatable($errors, 'settings_printings_request_3') }}">
                        <a href="#setting3-tab" data-toggle="tab">
                            @if (empty($rows[3]))
                                @lang ('elements.words.settings')3
                            @else
                                {{ $rows[3]->name }}
                            @endif
                        </a>
                    </li>
@endif
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors) }}" id="setting1-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('settings.printings.update', 1), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('settings.printings.components.crud', ['row' => is_null($rows[1]) ? $brankPrintSetting : $rows[1], 'key' => 1, 'errorBag' => 'settings_printings_request_1'])
                            {!! Form::close() !!}
                        </div>
                    </div>
@if (false)
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'settings_printings_request_2') }}" id="setting2-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('settings.printings.update', 2), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('settings.printings.components.crud', ['row' => $rows[2], 'key' => 2, 'errorBag' => 'settings_printings_request_2'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'settings_printings_request_3') }}" id="setting3-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('settings.printings.update', 3), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('settings.printings.components.crud', ['row' => $rows[3], 'key' => 3, 'errorBag' => 'settings_printings_request_3'])
                            {!! Form::close() !!}
                        </div>
                    </div>
@endif
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
