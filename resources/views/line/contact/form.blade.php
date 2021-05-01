@if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
@endif

@extends('line.contact.head')

<body>
    <div class="container">

    @if(!empty( $liff_id ))
        <form action="{{route('process')}}" method="post" id="contact" class="row">
        {{ csrf_field() }}
            <div class="container">
                @include("line.contact.templates." . $liff_id)
            </div>
        </form>
    @else
        ストアIDが不正です。<br>
    @endif
        <div class="container">
            <footer class="footer">
                <p>&copy; tsf.</p>
            </footer>
        </div>
    </div>
</body>
<script src="{{asset('js/jquery-1.12.4-min_.js')}}"></script>
<script src="{{asset('js/picker/picker.js')}}"></script>
<script src="{{asset('js/picker/picker.date.js')}}"></script>
<script src="{{asset('js/jquery-timepicker/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('js/picker/ja_JP.js')}}"></script>
<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js" charset="UTF-8"></script>
<script>
    // LIFFの初期化を行う
    liff.init({
        // 自分のLIFF ID（URLから『https://liff.line.me/』を除いた文字列）を入力する
        @if(!empty( $liff_id ))
            liffId: "{{ $liff_id }}"
        @endif
    }).then(() => { // 初期化完了. 以降はLIFF SDKの各種メソッドを利用できる
        @if(!empty(session('line_message')))  
        var line_message = "{{session('line_message')}}";
        liff.sendMessages([
        {
            type: 'text',
            text: line_message.replace(/(&quot;)/g, '')
        }
        ]).then(() => {
            liff.closeWindow();
        }).catch((err) => {
            console.log('error', err);
        });
        @endif
    });    
</script>
@include("line.contact.templates.js." . $liff_id . "-js")
</html>