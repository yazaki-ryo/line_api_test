<script>
    (function ($) {
        $('#date-picker').pickadate({
            format: 'yyyy/mm/dd',
            disable: [0,1], // 除外する曜日を指定
            min: 0,
            max: 90
        });
    
        // ノーマル
        $('.time-picker').timepicker({
            'timeFormat': 'H:mm',
            'minTime': '11:30',
            'maxTime': '19:00',
            'interval': 30
        });
    })(jQuery);
</script>