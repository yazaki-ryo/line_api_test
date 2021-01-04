@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.customers')@lang ('elements.words.detail') | {{ config('app.name') }}</title>
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
            @lang ('elements.words.customers')@lang ('elements.words.detail')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, 'customers_update_request', 'customers_update_request') }}">
                <a href="#edit-tab" data-toggle="tab">
                    @lang ('elements.words.detail')
                </a>
            </li>

            @can ('authorize', config('permissions.groups.tags.select'))
                <li class="{{ \Util::activatable($errors, 'customers_tags_update_request') }}">
                    <a href="#tags-tab" data-toggle="tab">@lang ('elements.words.tags')</a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                <li class="{{ \Util::activatable($errors, 'customers_histories') }}">
                    <a href="#histories-tab" data-toggle="tab">
                        @lang ('elements.words.visit')@lang ('elements.words.history')
                        <span class="badge">{{ $visitedHistories->count() }}</span>
                    </a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                <li class="{{ \Util::activatable($errors, 'visited_histories_create_request') }}">
                    <a href="#create-history-tab" data-toggle="tab">
                        @lang ('elements.words.visit')@lang ('elements.words.register')
                    </a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                <li class="{{ \Util::activatable($errors, 'customers_histories') }}">
                    <a href="#print-histories-tab" data-toggle="tab">
                        @lang ('elements.words.print')@lang ('elements.words.history')
                        <span class="badge">{{ $printHistories->count() }}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
    <div class="container content-wrapper">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @can ('authorize', config('permissions.groups.customers.select'))
                    <p class="left"><a href="{{ route('customers.index', ['page' => session()->get('page')]) }}" class="btn btn-info">@lang ('elements.words.customers')@lang ('elements.words.list')へ戻る</a></p>
                @endcan
                <div class="tab-content">
                    @can ('select', $row)
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_update_request', 'customers_update_request') }}" id="edit-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('customers.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr', 'files' => true]) !!}
                                        @include ('customers.components.crud', ['mode' => 'edit', 'errorBag' => 'customers_update_request'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.tags.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_tags_update_request') }}" id="tags-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.tags.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                    @include ('customers.components.tags', ['errorBag' => 'customers_tags_update_request'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_histories') }}" id="histories-tab">
                            @include ('visited_histories.components.list', ['rows' => $visitedHistories])
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'visited_histories_create_request') }}" id="create-history-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('visited_histories.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                                        @include ('visited_histories.components.crud', ['mode' => 'add', 'row' => $brankHistory, 'customer' => $row, 'errorBag' => 'visited_histories_create_request'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_histories') }}" id="print-histories-tab">
                            @include ('print_histories.components.list', ['rows' => $printHistories])
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
            var visited = $("#visited-histories-table").DataTable({
                columnDefs: [
                    {
                        targets: [0, 5],
                        orderable: false
                    }
                ],
                responsive: true,
                displayLength: 25,
                info: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                order: [[0, 'desc']],
                ordering: true,
                paging: true,
                scrollX: false,
                searching: true,
                stateSave: true
            });
            // タブ切り替え時にテーブル幅を調整
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                if (e.target.hash == '#histories-tab') {
                    var tables = $.fn.dataTable.tables( {visible: true, api: true} );
                    tables.table().node().style.width = '100%';
                    tables.columns.adjust();
                }
            } );
        });

        (function () {
            'use strict';

            replaceHref();

            if(document.getElementById('setting') != null) {
                document.getElementById('setting').addEventListener('change', replaceHref, false);
            }
            // TODO: IEではエラーになる
            // 参考: https://qiita.com/snjssk/items/8d179566b023703c0663
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
            var handle = jQuery("#print-tab-handle, #mail-tab-handle");
            var actionBtn = jQuery(".action-btn");
            var linkPrint = jQuery("#print-tab-link");
            var linkMail = jQuery("#mail-tab-link");
            if (isRowSelected) {
                handle.removeClass("disabled");
                actionBtn.css("display", "inline-block");
                linkPrint.attr("href", "#print-tab");
                linkMail.attr("href", "#mail-tab");
            } else {
                handle.addClass("disabled");
                actionBtn.css("display", "none");
                linkPrint.attr("href", "#");
                linkMail.attr("href", "#");
            }
        }

        function deleteSelectedPrintHistories() {
            jQuery("input[name='target_print_histories[]']").remove();
            
            var form = window.print_histories_delete_form;
            var SelectedPrintHistories = window.common.selectedValues();
            for (var i = 0; i < SelectedPrintHistories.length; i++) {
              var id = SelectedPrintHistories[i];
              jQuery(form).append("<input type='hidden' name='target_print_histories[]' value='" + id + "' />");
            }
            form.submit();
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

        function mailSelectedCustomers() {
            jQuery("input[name='target_customers[]']").remove();
            
            var form = window.customers_magazines_mail_form;
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

            if(document.getElementById('export-link') != null && document.getElementById('preview-link') != null) {

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
        }

    </script>
@endsection
