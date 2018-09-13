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
                    	<h1 class="h2">@lang ('elements.words.print')@lang ('elements.words.settings') <small><code>@lang ('Sub text')</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')

                @if ($errors->setting_1->any() || $errors->setting_2->any() || $errors->setting_3->any())
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><span class="fa fa-exclamation-triangle"></span>&nbsp;@lang ('There is an item of input error.')</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#setting1-tab" data-toggle="tab">
                            @if (empty($rows[1]))
                                @lang ('elements.words.settings')1
                            @else
                                {{ $rows[1]->name }}
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#setting2-tab" data-toggle="tab">
                            @if (empty($rows[2]))
                                @lang ('elements.words.settings')2
                            @else
                                {{ $rows[2]->name }}
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#setting3-tab" data-toggle="tab">
                            @if (empty($rows[3]))
                                @lang ('elements.words.settings')3
                            @else
                                {{ $rows[3]->name }}
                            @endif
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active fade in pt-10" id="setting1-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('settings.configurations.printings.update', 1), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('settings.configurations.components.printings.crud', ['row' => $rows[1], 'key' => 1, 'errorBag' => 'setting_1'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane fade pt-10" id="setting2-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('settings.configurations.printings.update', 2), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('settings.configurations.components.printings.crud', ['row' => $rows[2], 'key' => 2, 'errorBag' => 'setting_2'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane fade pt-10" id="setting3-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('settings.configurations.printings.update', 3), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('settings.configurations.components.printings.crud', ['row' => $rows[3], 'key' => 3, 'errorBag' => 'setting_3'])
                            {!! Form::close() !!}
                        </div>
                    </div>
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
