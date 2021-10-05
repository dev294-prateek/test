<h1 class="page-title">Home Work </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('class_work')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
   <div class="panel-body">

                    <div id="eventCalendar"></div>

                </div>
    <!-- EVENT CALENDAR -->
    <link rel="stylesheet" href="<?php echo base_url('assets/eventCalendar/eventCalendar.css'); ?>">

    <!-- Theme CSS file: it makes eventCalendar nicer -->
    <link rel="stylesheet" href="<?php echo base_url('assets/eventCalendar/eventCalendar_theme_responsive.css'); ?>">

    <!-- plugin has dependency of moment.js to show dates -->
    <script src="<?php echo base_url('assets/eventCalendar/moment.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/eventCalendar/jquery.eventCalendar.js'); ?>" type="text/javascript"></script>


    <script>
        $(document).ready(function() {


            var eventsInline = [
                <?php foreach($class_work as $work_row){ ?>
                {"date": "<?php echo $work_row['date'];  ?>", "type": "meeting", "title": "</i> <?php echo $work_row['title'];  ?> <?php echo $work_row['credit'];  ?>", "description": "<br><?php echo $work_row['description']; ?>", "url": "uploads/<?php echo $work_row['attachment'];  ?>" },
                <?php } ?>
            ];
            $("#eventCalendar").eventCalendar({
                jsonData: eventsInline,
                 dateFormat: 'D-MM-YYYY',
                jsonDateFormat: 'human',
                showDescription: true,
                openEventInNewWindow: true,
                startWeekOnMonday: false,
                cacheJson: false
            });


        });
    </script>
    <!-- end EVENT CALENDAR -->
</div>
