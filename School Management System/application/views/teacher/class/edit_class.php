<h1 class="page-title"> Update Class </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_class/<?php echo $class["class_id"]; ?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_class);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update Class
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_class',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="class_id" value="<?php echo $class['class_id'] ?>">
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $class['name'] ?>">
                    </div>
                </div>
<!--                <div class="form-group">
                    <label class="col-xs-6">Class Teacher :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="teacher_id" value="<?php /*echo $class['teacher_id'] */?>">
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-xs-6">Status :</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="status" >
                            <option value="1" <?php if($class['status']==1){echo 'selected';}?>>Active</option>
                            <option value="0" <?php if($class['status']==0){echo 'selected';}?>>In Active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success "  value="Update" id="submit">
                    </div>
                </div>

                <!--=====================================-->

                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div>
<!--=====================================-->

<!--=====================================-->

<!--to form submit upload image-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/teacher/update_class',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    if(msg) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> One record inserted successfully. </span><div>");

                    }else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable to insert record . </span><div>");

                    }
                    loadview('all_class');
                },
                error: function(e){
                    alert(e);
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

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


