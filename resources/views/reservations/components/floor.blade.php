<script type="text/javascript">
        jQuery(function($){
            var $floor = $('#floor');
            var original = $floor.html();

            $('#seat').change(function() {
                var val1 = $(this).val();

                @foreach ($seats as $item)
                    if(val1 == {{ $item->id() }}){
                        var floor = "{{ $item->floor() }}";
                    }
                @endforeach

                $floor.html(original).find('option').each(function() {
                    var val2 = $(this).val();
                    if (floor != val2) {
                        $(this).not(':first-child').remove();
                        $(this).not(':last-child').remove();
                    }else{
                        console.log('val1:' + val1);
                        console.log('floor:' + floor);
                        console.log('val2:' + val2);
                    }
                
                });
                $floor.attr('disabled', 'disabled');
            });
        });
</script>