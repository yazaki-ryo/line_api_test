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
    <div class="nav-tabs-container side-by-side wrap">
        <p class="page-title">
            <i class="fas fa-angle-double-right"></i>
            @lang ('elements.words.reservations')@lang ('elements.words.list')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, 'calender', $tab) }}">
                <a href="#calender-tab" data-toggle="tab">
                    @lang ('elements.words.calender')
                </a>
            </li>

            <li class="{{ \Util::activatable($errors, 'index', $tab) }}">
                <a href="#result-tab" data-toggle="tab">
                    @lang ('elements.words.list')
                    <span class="badge">{{ $paginator->total() }}</span>
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
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'calender', $tab) }}" id="calender-tab">
                        @include ('reservations.components.calender')
                    </div>

                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'index', $tab) }}" id="result-tab">
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
                                    {!! Form::open(['url' => route('reservations.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'reservations_create_form']) !!}
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
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/ja.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script>
        var selectedCustomerId = {{ empty($customer_id) ? '0' : $customer_id }};
        var reservationForm = new ReservationForm(appvm, selectedCustomerId, window.reservations_create_form);
    </script>
    <script>
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
                info: false,
                order: [],
                ordering: false,
                paging: false,
                scrollX: false,
                // order: [0, "asc"],
                searching: false,
                stateSave: true,
                responsive: true
            });
        });
    </script>
@endsection
