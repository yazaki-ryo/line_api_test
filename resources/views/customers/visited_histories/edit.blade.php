@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.visit')@lang ('elements.words.history')@lang ('elements.words.edit') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('styles')
    <link href="{{ asset('vendor/jquery-ui/datepicker/datepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.visit')@lang ('elements.words.history')@lang ('elements.words.edit') <small><code>@lang ('Sub text')</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => route('customers.visited_histories.edit', [$row->customerId(), $row->id()]), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            @include ('customers.visited_histories.components.crud', ['mode' => 'edit'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        (function($){
        	    $('#visited_date').datepicker({
                dateFormat: 'yy-mm-dd',
                numberOfMonths: 2,
                showOtherMonths: true,
                showButtonPanel: true
            });
        })(jQuery);

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
