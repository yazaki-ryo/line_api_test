@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.users')@lang ('elements.words.detail') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.users')@lang ('elements.words.detail')
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#edit-tab" data-toggle="tab">
                            @lang ('elements.words.detail')
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    @can ('select', $row)
                        <div class="tab-pane active fade in pt-10" id="edit-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('users.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
                                        @include ('users.components.crud', ['mode' => 'edit'])
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
        //
    </script>
@endsection
