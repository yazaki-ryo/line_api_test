@section('title', 'おおさか料理 浅井東迎')

<input type="text" id="name" name="name" value="{{old('line_name')}}" placeholder="お名前" autofocus required><br />
<input type="tel" id="tel" name="tel" value="{{old('tel')}}" placeholder="電話番号" minlength="8" maxlength="11" required><br />
<input type="number" id="number" name="number" value="{{old('number')}}" placeholder="人数" required><br />
<input type="text" id="date-picker" class="date-picker mb30" name="date" value="{{old('date')}}" placeholder="日付" required>
<div class="btn-group" data-toggle="buttons">
    <label id="reserve-type-lunch" class="btn btn-default active">
        <input type="radio" class="reserve-type" name="reserve_type" value="lunch" autocomplete="off" checked>ランチ
    </label>
    <label id="reserve-type-dinner" class="btn btn-default">
        <input type="radio" class="reserve-type" name="reserve_type" value="dinner" autocomplete="off">ディナー
    </label>
</div>
<div id="lunch-time-picker">
    <input type="text" class="lunch-time-picker" name="time" value="{{old('time')}}" placeholder="ランチ希望時間" required>
</div>
<div id="lunch-time-menu" class="selectdiv">
    <select name="order_menu">
        <option value="五品 梅コース 3,780円">五品 梅コース 3,780円</option>
        <option value="七品 竹コース 5,500円">七品 竹コース 5,500円</option>
        <option value="八品 松コース 7,700円">八品 松コース 7,700円</option>
        <option value="どなん和牛コース5品 3,780円">どなん和牛コース5品 3,780円</option>
        <option value="どなん和牛コース7品 5,500円">どなん和牛コース7品 5,500円</option>
        <option value="【水曜日限定】釜飯御膳 3,780円">【水曜日限定】釜飯御膳 3,780円</option>
        <option value="アラカルト">アラカルト</option>
    </select>
</div>
<div id="dinner-time-picker">
    <input type="text" id="dinner-time-picker" class="dinner-time-picker" name="time" value="{{old('time')}}" placeholder="ディナー希望時間" required>
</div>
<div id="dinner-time-menu" class="selectdiv">
    <select name="order_menu">
        <option value="季節の八品 8,800円">季節の八品 8,800円</option>
        <option value="季節の九品 11,000円">季節の九品 11,000円</option>
        <option value="季節の九品 13,200円">季節の九品 13,200円</option>
        <option value="どなん和牛コース8品 11,000円">どなん和牛コース8品 11,000円</option>
        <option value="どなん和牛コース9品 12,000円">どなん和牛コース9品 12,000円</option>        
        <option value="アラカルト">アラカルト</option>
        <option value="席だけ予約">席だけ予約</option>
    </select>
</div>
<textarea type="text" id="message" name="message" placeholder="備考">{{old('message')}}</textarea><br />
<input type="hidden" id="store_id" name="store_id" value="{{ $store_id }}" required><br />
<button id="submit" type="submit" name="action" value="submit">予約内容を送信</button>