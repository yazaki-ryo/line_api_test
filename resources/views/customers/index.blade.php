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
                    <li>
                        <a href="#print-tab" data-toggle="tab">@lang ('elements.labels.postcard')@lang ('elements.actions.print')</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          @lang ('elements.actions.menu') <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="disabled">
                                <a href="#">
                                    @lang ('elements.labels.name_collation')
                                </a>
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
                            {!! Form::open(['url' => route('customers'), 'id' => 'customers-search-form', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                                @include ('customers.components.search')
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane pt-10" id="print-tab">
                        <div class="well">
                            {!! Form::open(['url' => route('customers.postcards.output'), 'id' => 'customers-postcards-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @include ('customers.components.postcard')
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

        /**
         * @param string url
         * @return void
         */
        function restoreRecord(url) {
            if( confirm('@lang ("Do you really want to restore this?")') ) {
                var form = document.getElementById('basic-post-form');
                form.action = url;
                form.submit();
            }
        }

        /**
         * @param string url
         * @param string name
         * @return void
         */
        function submitPostcardsForm(url, name) {
            var element = document.createElement('input');
            element.setAttribute('type', 'hidden');
            element.setAttribute('name', name);

            var value = elementsByName(name);
            element.setAttribute('value', value);

            var form = document.getElementById('customers-postcards-form');
            form.action = url;
            form.appendChild(element);
            form.submit();
        }

        /**
         * @param string name
         * @param bool onlyChecked
         * @return array
         */
        function elementsByName(name, onlyChecked = true) {
            var element = document.getElementsByName(name);
            var selected = [];

            for (var item of element) {
                if (item.checked === false && onlyChecked) {
                    continue;
                }
                selected.push(parseInt(item.value));
            }

            return selected;
        }
    </script>
@endsection
