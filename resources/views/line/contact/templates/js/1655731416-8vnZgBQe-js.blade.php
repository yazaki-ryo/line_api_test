<script>
    (function ($) {
        $('#date-picker').pickadate({
            format: 'yyyy/mm/dd',
            disable: [2], // 除外する曜日を指定
            min: 0,
            max: 90
        });
    
        // ノーマル
        $('.time-picker').timepicker({
            'timeFormat': 'H:mm',
            'minTime': '18:00',
            'maxTime': '19:30',
            'interval': 30
        });
    })(jQuery);
</script>