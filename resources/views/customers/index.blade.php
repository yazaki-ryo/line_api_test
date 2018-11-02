@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.customers')@lang ('elements.words.list') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('styles')
    <link href="{{ asset('vendor/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container tab-container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header">
                    <h1 class="h2">@lang ('elements.words.customers')@lang ('elements.words.list')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs">
                    <li class="{{ \Util::activeTab($errors) }}">
                        <a href="#result-tab" data-toggle="tab">
                            @lang ('elements.words.list')
                            <span class="badge">{{ $rows->count() }}</span>
                        </a>
                    </li>

                    @can ('authorize', config('permissions.groups.customers.select'))
                        <li class="{{ \Util::activeTab($errors, 'customers_search_request') }}">
                            <a href="#search-tab" data-toggle="tab">@lang ('elements.words.search')</a>
                        </li>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.create'))
                        <li class="{{ \Util::activeTab($errors, 'customers_create_request') }}">
                            <a href="#create-tab" data-toggle="tab">@lang ('elements.words.register')</a>
                        </li>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.postcards.export'))
                        <li class="{{ \Util::activeTab($errors, 'customers_postcards_export_request') }}">
                            <a href="#print-tab" data-toggle="tab">@lang ('elements.words.postcard')@lang ('elements.words.print')</a>
                        </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in pt-10 {{ \Util::activeTab($errors) }}" id="result-tab">
                        @include ('customers.components.list')
                    </div>

                    @can ('authorize', config('permissions.groups.customers.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activeTab($errors, 'customers_search_request') }}" id="search-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.index'), 'id' => 'customers-search-form', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                                    @include ('customers.components.search', ['errorBag' => 'customers_search_request'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.create'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activeTab($errors, 'customers_create_request') }}" id="create-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('customers.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
                                        @include ('customers.components.crud', ['mode' => 'add', 'errorBag' => 'customers_create_request'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.postcards.export'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activeTab($errors, 'customers_postcards_export_request') }}" id="print-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.postcards.export'), 'id' => 'customers-postcards-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                    @include ('customers.components.postcard', ['errorBag' => 'customers_postcards_export_request'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="https://yubinbango.github.io/yubinbango/yubinbango.js"></script>
    <script type="text/javascript">
        jQuery(function($){
            $.extend( $.fn.dataTable.defaults, {
                language: {
                    url: "{{ asset('vendor/DataTables/ja.json') }}"
                }
            });
            $("#customers-table").DataTable({
                columnDefs: [
                    {
                        targets: [0, 6],
                        orderable: false
                    }
                ],
                displayLength: 25,
                info: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                order: [],
                ordering: true,
                paging: true,
                scrollX: false,
                searching: true,
                stateSave: true
            });
        });

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
