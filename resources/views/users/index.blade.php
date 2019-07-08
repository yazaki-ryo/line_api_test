@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.users')@lang ('elements.words.list') | {{ config('app.name') }}</title>
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
            @lang ('elements.words.users')@lang ('elements.words.list')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, 'index', 'index') }}">
                <a href="#result-tab" data-toggle="tab">
                    @lang ('elements.words.list')
                    <span class="badge">{{ $rows->count() }}</span>
                </a>
            </li>
{{--
            @can ('authorize', config('permissions.groups.users.select'))
                <li class="{{ \Util::activatable($errors, 'users_search_request') }}">
                    <a href="#search-tab" data-toggle="tab">@lang ('elements.words.search')</a>
                </li>
            @endcan
--}}
            @can ('authorize', config('permissions.groups.users.create'))
                <li class="{{ \Util::activatable($errors, 'users_create_request') }}">
                    <a href="#create-tab" data-toggle="tab">@lang ('elements.words.register')</a>
                </li>
            @endcan
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
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'index', 'index') }}" id="result-tab">
                        @include ('users.components.list')
                    </div>
{{--
                    @can ('authorize', config('permissions.groups.users.select'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'users_search_request') }}" id="search-tab">
                            <div class="well">
                                {!! Form::open(['url' => route('users.index'), 'id' => 'users-search-form', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                                    @include ('users.components.search')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endcan
--}}
                    @can ('authorize', config('permissions.groups.users.create'))
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'users_create_request') }}" id="create-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('users.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                        @include ('users.components.crud', ['mode' => 'add', 'errorBag' => 'users_create_request'])
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
            $("#users-table").DataTable({
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
    </script>
@endsection
