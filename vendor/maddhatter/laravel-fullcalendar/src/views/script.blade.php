<script>
    $(document).ready(function(){
        $('#calendar-{{ $id }}').fullCalendar({!! $options !!});

        $('#calendar-{{ $id }}').fullCalendar({
            weekends: false // will hide Saturdays and Sundays
        });
    });
</script>
