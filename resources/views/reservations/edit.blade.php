@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.reservations')@lang ('elements.words.detail') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.reservations')@lang ('elements.words.detail')
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
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => route('reservations.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            @include ('reservations.components.crud', ['mode' => 'edit'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript">
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
