
<h1 class="page-title"> All Events </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_event')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($events);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2" style="display: none">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Class
                </div>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div>
<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
    <table id="example"  >
        <thead>
        <tr><th style="width: 10%"> Id </th><th> Name</th><th>Start Date</th><th>End Date</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach ( $events as $row) { ?>
            <tr>
                <td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $row['id']?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo date("F j, Y, g:i a",strtotime($row['start_date'])); ?></td>
                <td><?php echo date("F j, Y, g:i a",strtotime($row['end_date'])); ?></td>
                <td><a class="gold-bt" onclick="loadview('manage_event/<?php echo $row['id']; ?>')">Manage</a></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--=====================================-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


