@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.tags')@lang ('elements.words.detail') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="nav-tabs-container side-by-side wrap">
        <p class="page-title">
            <i class="fas fa-angle-double-right"></i>
            @lang ('elements.words.tags')@lang ('elements.words.detail')
        </p>
        <ul class="nav nav-tabs">
            <li class="{{ \Util::activatable($errors, 'tags_update_request', 'tags_update_request') }}">
                <a href="#edit-tab" data-toggle="tab">
                    @lang ('elements.words.detail')
                </a>
            </li>
        </ul>
    </div>
    <div class="container pt-150">

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <p class="left">
                    <a href="{{ route('tags.index') }}" class="btn btn-info">@lang ('elements.words.tags')@lang ('elements.words.list')へ戻る</a>
                </p>
                <div class="tab-content">
                    @can ('select', $row)
                        <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'tags_update_request', 'tags_update_request') }}" id="edit-tab">
                            <div class="panel panel-default">
                                <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                <div class="panel-body">
                                    {!! Form::open(['url' => route('tags.edit', $row->id()), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                        @include ('tags.components.crud', ['mode' => 'edit', 'errorBag' => 'tags_update_request'])
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
