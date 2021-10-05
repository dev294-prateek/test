<h1 class="page-title"> All Videos Gallery </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_videos_gallery')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<?php //print_r($lesson_plan) ?>
<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
    <table id="example"  >
        <thead>
        <tr><th style="width: 20px"> Id </th><th style="width: 30px">Vidios</th><th style="width: 30px">Title</th><th style="width: 30px">Status</th><th style="width: 80px">Action</th></tr>
        </thead>
        <tbody>
        <?php foreach ( $all_v_gallery as $row) { ?>
            <tr>
                <td style="width: 20px" ><?php echo $row['id']?></td>

                <td style="width: 20px" >
                    <?php $url=$row['url']; ?>
                    <iframe width="150" height="100" src="<?php echo $url; ?>" allowfullscreen />

                </td>
                <td style="width: 20px" ><?php echo $row['title']?></td>
                <td style="width: 20px" ><?php echo $row['title']?></td>
                <td style="width:80px">
                    <!--====================================-->
                    <a  data-toggle="modal" class="btn btn-green" data-target="#myModal<?php echo $row['id'] ?>"><i class="entypo-newspaper"></i>Play</a>
                    <!---->
                    <div class="modal fade" id="myModal<?php echo $row['id'] ?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2 class="modal-title">Lesson Plan Detail</h2>
                                </div>
                                <div class="modal-body" style="text-align: center">
                                    <iframe width="550" height="300" src="<?php echo $url; ?>" allowfullscreen />                                </div>
                            </div>

                        </div>
                    </div>
                    <!--====================================-->
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!--=====================================-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>;


