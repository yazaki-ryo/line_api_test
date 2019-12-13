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
                <li id="mail-tab-handle" class="disabled {{ \Util::activatable($errors, 'customers_mail_request') }}">
                    <a id="mail-tab-link" href="#" data-toggle="tab">@lang ('elements.words.mail')@lang ('elements.words.send')</a>
                </li>
            @endcan

            @can ('authorize', config('permissions.groups.customers.postcards.export'))
                <li id="print-tab-handle" class="disabled {{ \Util::activatable($errors, 'customers_postcards_export_request') }}">
                    <a id="print-tab-link" href="#" data-toggle="tab">@lang ('elements.words.postcard')@lang ('elements.words.print')</a>
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
                                    {!! Form::open(['url' => route('customers.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr', 'files' => true]) !!}
                                        @include ('customers.components.crud', ['mode' => 'add', 'errorBag' => 'customers_create_request'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.postcards.export'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_mail_request') }}" id="mail-tab">
                            <div class="well pt-50 pb-30">
                                {!! Form::open(['url' => route('customers.magazines.mail'), 'id' => 'customers-magazines-mail-form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'customers_magazines_mail_form']) !!}
                                    @include ('customers.components.magazine_mail', ['errorBag' => 'customers_mail_request'])
                                {!! Form::close() !!}
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
    <script type="text/javascript" src="https://yubinbango.github.io/yubinbango/yubinbango.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script type="text/javascript">

        @can ('authorize', config('permissions.groups.customers.postcards.export'))
        // エディタ設定
        CKEDITOR.replace('content',{
            extraPlugins:'codesnippet',
            codeSnippet_theme:'dark',
            width: '650px',
            height:'350px',
            filebrowserUploadUrl: '{{ route("customers.magazines.image", ['_token' => csrf_token() ]) }}',
            filebrowserUploadMethod: 'form',
            // removeButtons:'Unlink,Anchor, NewPage,DocProps,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,RemoveFormat,Outdent,Indent,Blockquote,Styles,About,Source'
            removeButtons:'Source'
        });
        @endcan

        (function () {
            'use strict';

            replaceHref();

            if(document.getElementById('setting') != null) {
                document.getElementById('setting').addEventListener('change', replaceHref, false);
            }

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
        
        function showPrintTab() {
            $('#customers-navigation-tab a[href="#print-tab"]').tab('show');
        }

        function showMailTab() {
            $('#customers-navigation-tab a[href="#mail-tab"]').tab('show');
        }

    </script>
@endsection
