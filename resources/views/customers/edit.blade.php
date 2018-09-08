@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.customers')@lang ('elements.words.edit') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.customers')@lang ('elements.words.edit') <small><code>@lang ('Sub text')</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#edit-tab" data-toggle="tab">
                            @lang ('elements.words.edit')
                        </a>
                    </li>
                    <li>
                        <a href="#tags-tab" data-toggle="tab">@lang ('elements.words.tags')</a>
                    </li>
                    <li>
                        <a href="#history-tab" data-toggle="tab">@lang ('elements.words.visit')@lang ('elements.words.history')</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          @lang ('elements.words.menu') <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="active">
                                <a href="#">@lang ('Sub text')</a>
                            </li>
                            <li>
                                <a href="#">@lang ('Sub text')</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active fade in pt-10" id="edit-tab">
                        <div class="panel panel-default">
                            <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                            <div class="panel-body">
                                {!! Form::open(['url' => route('customers.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                    @include ('customers.components.crud', ['mode' => 'edit'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-10" id="tags-tab">
                        <div class="well">
                            @include ('customers.components.tags')
                        </div>
                    </div>
                    <div class="tab-pane fade pt-10" id="history-tab">
                        <div class="well">
                            @lang ('Dedicated development in progress.')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript">
        function deleteRecord(url) {
            if( confirm('@lang ("Do you really want to delete this?")') ) {
                var form = document.getElementById('basic-post-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
