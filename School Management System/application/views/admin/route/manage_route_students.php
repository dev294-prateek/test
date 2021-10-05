<style>
    .chhhh {
        margin-bottom: 10px;
    }
</style>
<h1 class="page-title" > SMS</h1>

<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('manage_route_students/<?php echo $route_id;?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<?php //print_r($students)?>
<div class="col-sm-12">

    <!---->
    <div class="col-sm-12">
        <table  class="table table-bordered">
            <thead>
            <tr><th  style="width: 10%">Id</th><th  >Image</th><th >Detail</th><th  >Mobile No</th><th  >Sms</th><th  >Action</th></tr>
            </thead>
            <tbody>
            <?php $sn=1;foreach ($students as $row){?>

                <tr>
                    <td><?php echo $sn++ ?></td>

                    <td style="width:100px !important;" > <?php if($row['student_image']) {?>
                            <img style="width:80px !important;"  class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['student_image'] ?>">
                        <?php } ?>
                    </td>
                    <td><?php echo $row['student_name'] ?> <br> <span style="color: red"><?php $guardian= $this->admin_model->list_guardian_by_id($row['guardian']); echo $guardian['guardian_name']; ?></span><br>
                   ( <?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?> &nbsp;&nbsp;-&nbsp;&nbsp;<?php $section= $this->admin_model->section_by_id($row['section']); echo $section['name']; ?> )<br>
                        <?php  $r=$this->admin_model->route_location_by_id($row['s_loc_id']); echo $r['name']  ?> to
                        <?php  $r=$this->admin_model->route_location_by_id($row['e_loc_id']); echo $r['name']  ?>
                    </td>

                    <td><?php echo $row['mobile_no_for_sms'] ?></td>
                    <td><textarea rows="5" id="sms_<?php echo $row['student_id'] ?>"></textarea></td>
                    <td><button class="btn btn-success" onclick="sms(<?php echo $row['student_id'] ?>,<?php echo $row['mobile_no_for_sms'] ?>)">Send</button></td>

                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

</div>

</div>
<script>
    function sms(id,mob) {
    var sms=  $('#sms_'+id).val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/send_sms_individual',
            type:"POST",
            datatype:"json",
            data:{mobile_no:mob,sms:sms},
            success: function (msg) {
                alert(msg);
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'>Send successfully.  </span><div>");
            },
            error: function () {
                alert('fail');
            }
        });

    }

</script>
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/send_all_student_route_sms',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Updated successfully. </span><div>");
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>




