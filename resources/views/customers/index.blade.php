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
    <div class="nav-tabs-container side-by-side wrap">
        <p class="page-title">
            <i class="fas fa-angle-double-right"></i>
            @lang ('elements.words.customers')@lang ('elements.words.list')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, null, true) }}">
                <a href="#result-tab" data-toggle="tab">
                    @lang ('elements.words.list')
                    <span class="badge">{{ $rows->count() }}</span>
                </a>
            </li>

            @can ('authorize', config('permissions.groups.customers.select'))
                <li class="{{ \Util::activatable($errors, 'customers_search_request') }}">
                    <a href="#search-tab" data-toggle="tab">@lang ('elements.words.search')</a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.create'))
                <li class="{{ \Util::activatable($errors, 'customers_create_request', request('tab') === 'test') }}">
                    <a href="#create-tab" data-toggle="tab">@lang ('elements.words.register')</a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.postcards.export'))
                <li class="{{ \Util::activatable($errors, 'customers_postcards_export_request') }}">
                    <a href="#print-tab" data-toggle="tab">@lang ('elements.words.postcard')@lang ('elements.words.print')</a>
                </li>
            @endcan
        </ul>
    </div>
    <div class="container pt-150">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tab-content">
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, null, true) }}" id="result-tab">
                        @include ('customers.components.list')
                    </div>

                    @can ('authorize', config('permissions.groups.customers.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_search_request') }}" id="search-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.index'), 'id' => 'customers-search-form', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                                    @include ('customers.components.search', ['errorBag' => 'customers_search_request'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.create'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_create_request') }}" id="create-tab">
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
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_postcards_export_request') }}" id="print-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.postcards.export'), 'id' => 'customers-postcards-form', 'method' => 'get', 'class' => 'form-horizontal']) !!}
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
                stateSave: true,
                responsive: true,
            });
        });

        (function () {
            'use strict';

            replaceHref();

            document.getElementById('setting').addEventListener('change', replaceHref, false);
            document.getElementsByName('selection').forEach(function (item) {
                item.addEventListener('change', replaceHref, false);
            });
        })();

        /**
         * @return void
         */
        function replaceHref() {
            var setting = document.getElementById('setting');
            var selection = window.common.elementsByName('selection');

            document.getElementById('export-link').search = window.common.serialize({
                'mode': 'export',
                'setting': setting[setting.selectedIndex].value,
                'selection': selection
            });

            document.getElementById('preview-link').search = window.common.serialize({
                'mode': 'preview',
                'setting': setting[setting.selectedIndex].value,
                'selection': selection
            });
        }
    </script>
@endsection
