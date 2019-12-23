@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.mail_history')@lang ('elements.words.list') | {{ config('app.name') }}</title>
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
            @lang ('elements.words.mail_history')@lang ('elements.words.list')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, 'index', 'index') }}">
                <a href="#result-tab" data-toggle="tab">
                    @lang ('elements.words.list')
                    <span class="badge">{{ $rows->count() }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container content-wrapper">

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="tab-content">
                    <div id="result-tab" class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'index', 'index') }}">
                        @include ('mail_histories.components.list') 
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
            $("#seats-table").DataTable({
                columnDefs: [
                    {
                        targets: [0, 5],
                        orderable: false
                    }
                ],
                displayLength: 25,
                info: false,
                lengthChange: false,
                lengthMenu: [10, 25, 50, 100],
                ordering: false,
                paging: false,
                // order: [0, "asc"],
                searching: false,
                stateSave: false
            });
        });
    </script>
@endsection
