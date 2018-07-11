@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1>Dashboard <small><code>サブテキスト</code></small></h1>
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
                <div class="well">
                    <h2>顧客管理</h1>
                    <p><code>texttexttexttexttexttexttexttexttext.</code></p>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-0">
                <div class="well">
                    <h2>予約管理</h1>
                    <p><code>texttexttexttexttexttexttexttexttext.</code></p>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-0">
                <div class="well">
                    <h2>アプリ</h1>
                    <p><code>texttexttexttexttexttexttexttexttext.</code></p>

                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>
            </div>
        </div>
    </div>
@endsection
