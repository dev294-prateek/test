
<h1 class="page-title"> Update Teacher </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_teacher/<?php echo $teacher['teacher_id']?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<div class="guardian">
     <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                   All Teacher
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_teacher',$data) ?>
                <br>
                <input type="hidden" name="teacher_id" value="<?php echo $teacher['teacher_id']?>">
                <!--=====================================-->
                <div id="det"><img class="img-responsive detail" src="<?php echo base_url();?>/uploads/168_18576_11_thumb.jpg">
                    <table class="table table-responsive">
                        <tbody>
                        <tr><th>Id</th><td><?php echo $teacher_detail['employee_id'] ?></td></tr>
                        <tr><th>Name</th><td><?php echo $teacher_detail['name'] ?></td></tr>
                        <tr><th>Mobile No</th><td><?php echo $teacher_detail['contact_no'] ?></td></tr>
                        <tr><th>Email</th><td><?php echo $teacher_detail['email'] ?></td>
                        </tr><tr><th>Type</th><td><?php echo $teacher_detail['employee_type'] ?></td></tr>
                        <tr><th>Designation</th><td><?php echo $teacher_detail['designation'] ?></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="col-xs-4">Sellect Type :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="type"  required >
                            <?php foreach($teacher_type as $row){?>
                                <option value="<?php echo $row['id'];?>" <?php if($row['id']==$teacher['type']) {echo 'selected';}?> ><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
                    </div>
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
<!--to form submit upload image-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_teacher',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    if(msg==1) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                    }
                    else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Unable To Update <span style='color: red'> Try again</span><div>");

                    }
                    loadview('teacher');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>
