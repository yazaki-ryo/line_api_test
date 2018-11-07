@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.reservations')@lang ('elements.words.list') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('styles')
    <link href="{{ asset('vendor/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container tab-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.reservations')@lang ('elements.words.list')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <ul class="nav nav-tabs">
                    <li class="{{ \Util::activatable($errors, null, true) }}">
                        <a href="#calender-tab" data-toggle="tab">
                            @lang ('elements.words.calender')
                        </a>
                    </li>

                    <li class="{{ \Util::activatable($errors) }}">
                        <a href="#result-tab" data-toggle="tab">
                            @lang ('elements.words.list')
                            <span class="badge">{{ $rows->count() }}</span>
                        </a>
                    </li>
{{--
                    @can ('authorize', config('permissions.groups.reservations.select'))
                        <li class="{{ \Util::activatable($errors, 'reservations_search_request') }}">
                            <a href="#search-tab" data-toggle="tab">@lang ('elements.words.search')</a>
                        </li>
                    @endcan
--}}
                    @can ('authorize', config('permissions.groups.reservations.create'))
                        <li class="{{ \Util::activatable($errors, 'reservations_create_request') }}">
                            <a href="#create-tab" data-toggle="tab">@lang ('elements.words.register')</a>
                        </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, null, true) }}" id="calender-tab">
                        @include ('reservations.components.calender')
                    </div>

                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors) }}" id="result-tab">
                        @include ('reservations.components.list')
                    </div>
{{--
                    @can ('authorize', config('permissions.groups.reservations.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'reservations_search_request') }}" id="search-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('reservations.index'), 'id' => 'reservations-search-form', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                                    @include ('reservations.components.search')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan
--}}
                    @can ('authorize', config('permissions.groups.reservations.create'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'reservations_create_request') }}" id="create-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('reservations.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                        @include ('reservations.components.crud', ['mode' => 'add', 'errorBag' => 'reservations_create_request'])
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
    <script type="text/javascript">
        jQuery(function($){
            $.extend( $.fn.dataTable.defaults, {
                language: {
                    url: "{{ asset('vendor/DataTables/ja.json') }}"
                }
            });
            $("#reservations-table").DataTable({
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
                ordering: true,
                paging: true,
                // order: [0, "asc"],
                searching: true,
                stateSave: true
            });
        });
    </script>
@endsection
