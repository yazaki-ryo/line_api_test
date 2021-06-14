@section('title', '季ごころ廣')

<input type="text" id="name" name="name" value="{{old('name')}}" placeholder="お名前" autofocus required><br />
<input type="tel" id="tel" name="tel" value="{{old('tel')}}" placeholder="電話番号" minlength="8" maxlength="11" required><br />
<input type="text" id="date-picker" class="date-picker" name="date" value="{{old('date')}}" placeholder="日付" required>
<input type="text" id="time-picker" class="time-picker" name="time" value="{{old('time')}}" placeholder="受け取り時間" required><br />


<h2 class="headline-h2">テイクアウトメニュー</h2>

<div class="takeout-form-block">
    <div class="flex around">
        <p class="takeout-menu-title">旬菜弁当  3,780円</p> 
        <p class="takeout-menu-num"><input type="number" class="takeout-form-checkbox" name="shunsai3780_cnt" min="0" max="10" placeholder="0" value="0"> 個</p>
    </div>

    <div class="flex around">
        <p class="takeout-menu-title">旬菜弁当  5,400円</p> 
        <p class="takeout-menu-num"><input type="number" class="takeout-form-checkbox" name="shunsai5400_cnt" min="0" max="10" placeholder="0" value="0"> 個</p>
    </div>

    <div class="flex around">
        <p class="takeout-menu-title">旬菜弁当  7,560円</p> 
        <p class="takeout-menu-num"><input type="number" class="takeout-form-checkbox" name="shunsai7560_cnt" min="0" max="10" placeholder="0" value="0"> 個</p>
    </div>

    <div class="flex around">
        <p class="takeout-menu-title">おまかせセット 2人前 10,800円</p>
        <p class="takeout-menu-num"><input type="number" class="takeout-form-checkbox" name="omakase_cnt" min="0" max="10" placeholder="0" value="0"> 個</p>
    </div>
</div>

<div class="takeout-form-block">
    <div class="flex around">
        <p class="takeout-menu-title">天然えび天重 1,620円</p> 
        <p class="takeout-menu-num"><input type="number" class="takeout-form-checkbox" name="tennenebi_cnt" min="0" max="10" placeholder="0" value="0"> 個</p>
    </div>
</div>

<div class="takeout-form-block">
    <div class="flex around">
        <p class="takeout-menu-title">黒毛和牛ヘレステーキ重 3,780円</p> 
        <p class="takeout-menu-num"><input type="number" class="takeout-form-checkbox" name="heresteke_cnt" min="0" max="10" placeholder="0" value="0"> 個</p>
    </div>
</div>

<div class="takeout-form-block">
    <p>その他、リクエストにお応えしお作りさせて頂きます。備考欄にてお問い合わせ下さい。</p>
</div>

<textarea type="text" id="message" name="message" placeholder="備考">{{old('message')}}</textarea><br />
<input type="hidden" id="store_id" name="store_id" value="{{ $store_id }}" required><br />
<input type="hidden" id="takeout" name="takeout" value="1" required><br />
<input type="hidden" id="number" name="number" value="0" required><br />
<button id="submit" type="submit" name="action" value="submit">予約内容を送信</button>