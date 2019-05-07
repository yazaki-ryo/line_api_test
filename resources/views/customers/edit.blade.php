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
                @can ('authorize', config('permissions.groups.customers.select'))
                    <p class="left"><a href="{{ route('customers.index') }}" class="btn btn-info">@lang ('elements.words.customers')@lang ('elements.words.list')へ戻る</a></p>
                @endcan
                <div class="tab-content">
                    @can ('select', $row)
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'customers_update_request', 'customers_update_request') }}" id="edit-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('customers.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
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
                order: [],
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
    </script>
@endsection
