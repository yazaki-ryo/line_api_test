@extends('systems.layouts.app')

@section('meta')
    <title>@lang ('elements.words.home') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.home')
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
                <div class="well" style="height: 220px; overflow: auto;">
                    <p class="lead">■@lang ('elements.words.notice')</p>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object thumbnail" src="http://placehold.jp/16/ddd/666/64x64.png?text=64x64" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object thumbnail" src="http://placehold.jp/16/ddd/666/64x64.png?text=64x64" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.words.customers')@lang ('elements.words.information')</p>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object thumbnail" src="http://placehold.jp/16/ddd/666/64x64.png?text=64x64" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.words.stores')@lang ('elements.words.information')</p>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object thumbnail" src="http://placehold.jp/16/ddd/666/64x64.png?text=64x64" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.words.users')@lang ('elements.words.information')</p>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object thumbnail" src="http://placehold.jp/16/ddd/666/64x64.png?text=64x64" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.words.companies')@lang ('elements.words.information')</p>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object thumbnail" src="http://placehold.jp/16/ddd/666/64x64.png?text=64x64" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
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
