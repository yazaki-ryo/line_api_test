<script>
    (function ($) {
        $('#date-picker').pickadate({
            format: 'yyyy/mm/dd',
            disable: [], // 除外する曜日を指定
            min: 0,
            max: 90
        });
    
        // ノーマル
        $('.time-picker').timepicker({
            'timeFormat': 'H:mm',
            'minTime': '11:00',
            'maxTime': '20:00',
            'interval': 30
        });
    })(jQuery);
</script>