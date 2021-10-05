<h1 class="page-title"> Update Section </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_section/<?php  echo $section['section_id'];?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
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
                    Update Section
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_section',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="section_id" value="<?php  echo $section['section_id'];?>"  >
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Section Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" required value="<?php  echo $section['name'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class Name :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="class_id" value="<?php  echo $section['class_id'];?>" required >
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>
                                <option value="<?php echo $row['class_id'];?>" <?php if($section['class_id']==$row['class_id']){echo 'selected';}?>><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Medium :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="medium" value="<?php  echo $section['medium'];?>" required >
                            <option>Select</option>
                            <option value="Hindi" <?php if($section['medium']=="Hindi"){echo 'selected';}?> >Hindi</option>
                            <option value="English" <?php if($section['medium']=="English"){echo 'selected';}?>>English</option>

                        </select>

                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-6">Class Teacher :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="teacher_id"  >
                            <option>Select</option>

                            <?php foreach($emp_teacher as $row){?>
                                <option value="<?php $x=$this->teacher_model->teacher_by_employee_id($row['employee_id']); echo $x['teacher_id'];?>"<?php if($x['teacher_id']==$section['teacher_id']){echo 'selected';}?>><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Status :</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="status" >
                            <option value="1" <?php if($section['status']==1){echo 'selected';}?>>Active</option>
                            <option value="0" <?php if($section['status']==0){echo 'selected';}?>>In Active</option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
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
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/teacher/update_section',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    if(msg) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully. </span><div>");

                    }else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable to  Update . </span><div>");

                    }
                    loadview('all_section');
                },
                error: function(){
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


