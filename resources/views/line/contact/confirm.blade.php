<head>
    <title>ご予約内容確認</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--
  <link rel="stylesheet" href="css/app.css">
-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<div class="container">
<div>
    <form action="{{route('process')}}" method="post">
    @csrf
        <div class="confirm-form">
            <label for="name">お名前</label><br>
            {{$contact->name}}
        </div>
        <div class="confirm-form">
            <label for="name">電話番号</label><br>
            {{$contact->tel}}
        </div>
        <div class="confirm-form">
          <label for="name">人数</label><br>
          {{$contact->number}}
        </div>
        <div class="confirm-form">
          <label for="name">時間</label><br>
          {{$contact->time}}
        </div>
        <div class="confirm-form">
          <label for="name">日付</label><br>
          {{$contact->date}}
        </div>
        <div class="confirm-form">
            <label for="name">備考</label><br>
            {{$contact->message}}
        </div>
        <button type="submit" name="action" value="back">戻る</button>
        <button type="submit" name="action" value="submit">送信する</button>

        @foreach($contact->getAttributes() as $key => $value)
        <input type="hidden" name="{{$key}}" value="{{$value}}">
        @endforeach
    </form>
</div>
</div>
</body>
</html>
