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
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.customers')@lang ('elements.words.detail')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors', ['errorBags' => ['tags']])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#edit-tab" data-toggle="tab">
                            @lang ('elements.words.detail')
                        </a>
                    </li>

                    @can ('authorize', config('permissions.groups.tags.select'))
                        <li>
                            <a href="#tags-tab" data-toggle="tab">@lang ('elements.words.tags')</a>
                        </li>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                        <li>
                            <a href="#histories-tab" data-toggle="tab">
                                @lang ('elements.words.visit')@lang ('elements.words.history')
                                <span class="badge">{{ $visitedHistories->count() }}</span>
                            </a>
                        </li>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                        <li>
                            <a href="#create-history-tab" data-toggle="tab">
                                @lang ('elements.words.visit')@lang ('elements.words.register')
                            </a>
                        </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    @can ('select', $row)
                        <div class="tab-pane active fade in pt-10" id="edit-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('customers.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
                                        @include ('customers.components.crud', ['mode' => 'edit'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.tags.select'))
                        <div class="tab-pane fade pt-10" id="tags-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('customers.tags', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                    @include ('customers.components.tags')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.select'))
                        <div class="tab-pane fade pt-10" id="histories-tab">
                            @include ('visited_histories.components.list', ['rows' => $visitedHistories])
                        </div>
                    @endcan

                    @can ('authorize', config('permissions.groups.customers.visited_histories.create'))
                        <div class="tab-pane fade pt-10" id="create-history-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('visited_histories.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                        @include ('visited_histories.components.crud', ['mode' => 'add', 'row' => $brankHistory])
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
            $("#visited-histories-table").DataTable({
                columnDefs: [
                    {
                        targets: [0, 5],
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
                searching: true,
                stateSave: true
            });
        });

        /**
         * @param string url
         * @return void
         */
        function deleteRecord(url) {
            if( confirm('@lang ("Do you really want to delete this?")') ) {
                var form = document.getElementById('basic-post-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
