<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<div class="container">

    <div class="row" style="width: 80%;">
        <div class="col-sm-12">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var events = <?php echo json_encode($data) ?>;

    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    $('#calendar').fullCalendar({
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
        },
        events    : events

    })
</script>
