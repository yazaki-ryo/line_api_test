@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.reservations')@lang ('elements.words.detail') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="nav-tabs-container side-by-side wrap">
        <p class="page-title">
            <i class="fas fa-angle-double-right"></i>
            @lang ('elements.words.reservations')@lang ('elements.words.detail')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, 'reservations_update_request', 'reservations_update_request') }}">
                <a href="#edit-tab" data-toggle="tab">
                    @lang ('elements.words.detail')
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
                @can ('authorize', config('permissions.groups.reservations.select'))
                    @if (\Route::has('reservations.index'))<!-- TODO -->
                        <p class="left">
                            <a href="{{ route('reservations.index', ['page' => session()->get('page')]) }}" class="btn btn-info">@lang ('elements.words.reservations')@lang ('elements.words.list')へ戻る</a>
                        </p>
                    @endif
                @endcan
                <div class="tab-content">
                    @can ('select', $row)
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'reservations_update_request', 'reservations_update_request') }}" id="edit-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('reservations.edit', $row->id()), 'name' => 'reservations_create_form', 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                        @include ('reservations.components.crud', ['mode' => 'edit', 'errorBag' => 'reservations_update_request'])
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
    <script type="text/javascript">
        var selectedCustomerId = {{ empty($customer_id) ? '0' : $customer_id }};
        var reservationForm = new ReservationForm(appvm, selectedCustomerId, window.reservations_create_form);
    </script>

    {{-- 席変更時にフロアも変更する --}}
    @include ('reservations.components.floor')
@endsection
