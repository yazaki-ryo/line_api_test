@section('title', '沖縄居酒屋がちまやー')
<input type="text" id="name" name="name" value="{{session('line_name')}}" placeholder="お名前" autofocus required><br />
<input type="tel" id="tel" name="tel" value="{{old('tel')}}" placeholder="電話番号" minlength="8" maxlength="11" required><br />
<input type="number" id="number" name="number" value="{{old('number')}}" placeholder="人数" required><br />
<input type="text" id="date-picker" class="date-picker" name="date" value="{{old('date')}}" placeholder="日付" required><br />
<input type="text" id="time-picker" class="time-picker" name="time" value="{{old('time')}}" placeholder="希望時間" required><br />
<textarea type="text" id="message" name="message" placeholder="備考">{{old('message')}}</textarea><br />
<input type="hidden" id="store_id" name="store_id" value="{{ $store_id }}" required><br />
<button id="submit" type="submit" name="action" value="submit">予約内容を送信する</button>