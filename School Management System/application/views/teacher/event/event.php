<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<style>


</style>
<h1 class="page-title">Event</h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('event')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
<div class="guardian">
    <div class="col-sm-12">
        <div id="calendar"></div>
    </div>
</div>

<!--=====================================-->
<script type="text/javascript">
    var event = <?php echo json_encode($data) ?>;
    var date = new Date();
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
        events    : event,
        selectable :true,
        selectHelper : true,
    })
</script>


