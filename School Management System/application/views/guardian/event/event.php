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
        select : function (start,end,allDay) {
            var title = prompt("Enter Event Title");
            if (title){
                var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: '<?php echo base_url()?>index.php/admin/add_event',
                    type:"POST",
                    data:{title:title,start_date:start,end_date:end},
                    success: function () {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Added Successfully <div>");
                        loadview('event')
                    },
                    error: function () { alert("fail");
                    }
                });

            }

        },
        editable:true,
        eventResize : function(event) {
            var start = $.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/update_event',
                type:"POST",
                data:{title:title,start_date:start,end_date:end,id:id},
                success: function () {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");

                },
                error: function () { alert("fail");
                }
            });
        },
        eventDrop : function(event) {
            var start = $.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/update_event',
                type:"POST",
                data:{title:title,start_date:start,end_date:end,id:id},
                success: function () {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");

                },
                error: function () { alert("fail");
                }
            });
        },
        eventClick : function(event) {
            if(confirm("Are you sure to want to remove it")){
                var id = event.id;
                $.ajax({
                    url: '<?php echo base_url()?>index.php/admin/delete_event',
                    type:"POST",
                    data:{id:id},
                    success: function () {
                        loadview('event')
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Removed Successfully <div>");
                    },
                    error: function () { alert("fail");
                    }
                });
            }

        },

    })
</script>


