@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.pages.customers.index') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('css')
    <link href="{{ asset('vendor/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.pages.customers.index') <small><code>@lang ('Sub text')</code></small></h1>
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
                        <a href="#result-tab" data-toggle="tab">
                            @lang ('elements.actions.search')@lang ('elements.actions.result')
                            <span class="badge">{{ $rows->count() }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#search-tab" data-toggle="tab">@lang ('Search for')</a>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          Menu <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation" class="active">
                                <a href="#">
                                    @lang ('Sub text')
                                    <span class="badge">{{ $rows->count() }}</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#">@lang ('Sub text')</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active pt-10" id="result-tab">
                        @include ('customers.components.list')
                    </div>
                    <div class="tab-pane pt-10" id="search-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('customers'), 'id' => '', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                                @include ('customers.components.search')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($){
            $.extend( $.fn.dataTable.defaults, {
                language: {
                    url: "{{ asset('vendor/DataTables/ja.json') }}"
                }
            });
            $("#customers-table").DataTable({
                columnDefs: [
//                     { targets: 0, visible: false },
//                     { targets: 1, width: 150 },
//                     { targets: [6, 7], orderable: false }
                ],
                displayLength: 25,
                info: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                ordering: true,
                paging: true,
//                 order: [0, "asc"],
//                 scrollX: true,
//                 scrollY: true,
                searching: true,
                stateSave: true
            });
        });
    </script>
    <script type="text/javascript">
        function restoreRecord(url) {
            if( confirm('@lang ("Do you really want to restore this?")') ) {
                var form = document.getElementById('basic-post-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
