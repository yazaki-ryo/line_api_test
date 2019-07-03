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
        <ul class="nav nav-tabs" id="customers-navigation-tab">
            <li class="{{ \Util::activatable($errors, 'index', $tab) }}">
                <a href="#result-tab" data-toggle="tab">
                    @lang ('elements.words.list')
                    <span class="badge">{{ $paginator->total() }}</span>
                </a>
            </li>

            @can ('authorize', config('permissions.groups.customers.select'))
                <li class="{{ \Util::activatable($errors, 'customers_search_request', $tab) }}">
                    <a href="#search-tab" data-toggle="tab">@lang ('elements.words.search')</a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.create'))
                <li class="{{ \Util::activatable($errors, 'customers_create_request') }}">
                    <a href="#create-tab" data-toggle="tab">@lang ('elements.words.register')</a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.postcards.export'))
                <li id="print-tab-handle" class="disabled {{ \Util::activatable($errors, 'customers_postcards_export_request') }}">
                    <a id="print-tab-link" href="#" data-toggle="tab">@lang ('elements.words.postcard')@lang ('elements.words.print')</a>
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
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'index', $tab) }}" id="result-tab">
                        @include ('customers.components.list')
                    </div>

                    @can ('authorize', config('permissions.groups.customers.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_search_request', $tab) }}" id="search-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.index'), 'id' => 'customers-search-form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'customers_search_form']) !!}
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
                info: false,
                order: [],
                ordering: false,
                paging: false,
                scrollX: false,
                searching: false,
                stateSave: true,
                responsive: true,
            });
        });

        (function () {
            'use strict';

            replaceHref();

            document.getElementById('setting').addEventListener('change', replaceHref, false);
            document.getElementsByName('selection').forEach(function (item) {
                item.addEventListener('change', selectionChanged, false);
            });
        })();
        
        function selectionChanged() {
            toggleActionButtons();
            replaceHref();
        }
        
        function toggleActionButtons() {
            var isRowSelected = window.common.selectedValues().length > 0;
            var handle = jQuery("#print-tab-handle");
            var wrapper = jQuery("#customers-action-button-wrapper");
            var link = jQuery("#print-tab-link");
            if (isRowSelected) {
                handle.removeClass("disabled");
                wrapper.removeClass("invisible");
                link.attr("href", "#print-tab");
            } else {
                handle.addClass("disabled");
                wrapper.addClass("invisible");
                link.attr("href", "#");
            }
        }
        
        function deleteSelectedCustomers() {
            jQuery("input[name='target_customers[]']").remove();
            
            var form = window.customers_delete_form;
            var selectedCustomers = window.common.selectedValues();
            for (var i = 0; i < selectedCustomers.length; i++) {
              var id = selectedCustomers[i];
              jQuery(form).append("<input type='hidden' name='target_customers[]' value='" + id + "' />");
            }
            form.submit();
        }

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
        
        function showPrintTab() {
            $('#customers-navigation-tab a[href="#print-tab"]').tab('show');
        }
    </script>
@endsection
