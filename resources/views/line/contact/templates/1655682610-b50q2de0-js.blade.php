<script>
    (function ($) {
        $('#date-picker').pickadate({
            format: 'yyyy/mm/dd',
            // disable: [2], // 除外する曜日を指定
            min: 0,
            max: 120
        });

        // 初期表示
        $('#dinner-time-picker').css('display', 'none');
        $('#dinner-time-picker > input').prop('disabled', true);
        $('#dinner-time-menu').css('display', 'none');
        $('#dinner-time-menu > select').prop('disabled', true);

        $('.reserve-type').on('click', function() {
            var reserve_type = $(this).val();
            if(reserve_type === "lunch") {
                $('#reserve-type-lunch').addClass('active');
                $('#reserve-type-dinner').removeClass('active');
                
                // ランチ用の時間表示
                $('#lunch-time-picker').css('display', 'inline');
                $('#lunch-time-picker > input').prop('disabled', false);
                $('#dinner-time-picker').css('display', 'none');
                $('#dinner-time-picker > input').prop('disabled', true);
                // ランチ用のプルダウン表示
                $('#lunch-time-menu').css('display', 'block');
                $('#lunch-time-menu > select').prop('disabled', false);
                $('#dinner-time-menu').css('display', 'none');
                $('#dinner-time-menu > select').prop('disabled', true);
            } else {
                $('#reserve-type-lunch').removeClass('active');
                $('#reserve-type-dinner').addClass('active');
                
                // ディナー用の時間表示
                $('#lunch-time-picker').css('display', 'none');
                $('#lunch-time-picker > input').prop('disabled', true);
                $('#dinner-time-picker').css('display', 'inline');
                $('#dinner-time-picker > input').prop('disabled', false);
                // ディナー用のプルダウン表示
                $('#lunch-time-menu').css('display', 'none');
                $('#lunch-time-menu > select').prop('disabled', true);
                $('#dinner-time-menu').css('display', 'block');
                $('#dinner-time-menu > select').prop('disabled', false);
            }
        });

        // ランチ
        $('.lunch-time-picker').timepicker({
            'timeFormat': 'H:mm',
            'minTime': '11:30',
            'maxTime': '13:00',
            'interval': 30
        });
        // ディナー
        $('.dinner-time-picker').timepicker({
            'timeFormat': 'H:mm',
            'minTime': '17:00',
            'maxTime': '20:00',
            'interval': 30
        });
    })(jQuery);
</script>