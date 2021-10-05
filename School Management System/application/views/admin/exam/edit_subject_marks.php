<h1 class="page-title">Subject Marks </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_subject_marks/<?php echo $exam_allowed_section_subject['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($exam_allowed_section_subject); ?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2" >
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Manage Subject Marks
                </div>
            </div>


            <div class="panel-body">
                <h4 class="page-title" style="text-align: center;" >Exam : <?php $class= $this->admin_model->list_all_exam_by_id($exam_allowed_section_subject['exam_id']); echo $class['name'] ?>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Class : <?php $class= $this->admin_model->class_by_id($exam_allowed_section_subject['class_id']); echo $class['name'] ?></span>
                <span >&nbsp;&nbsp;&nbsp;&nbsp; Section : <?php $section= $this->admin_model->section_by_id($exam_allowed_section_subject['section_id']); echo $section['name']; ?></h4>

                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_exam_allowed_section_subject',$data) ?>
                <br>
                <input type="hidden" name="id" value="<?php echo $exam_allowed_section_subject['id'];?>">
                <input type="hidden" name="exam_id" value="<?php echo $exam_allowed_section_subject['exam_id'];?>">
                <input type="hidden" name="class_id" value="<?php echo  $exam_allowed_section_subject['class_id'];?>">
                <input type="hidden" name="section_id" value="<?php echo  $exam_allowed_section_subject['section_id'] ;?>">
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Subject :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="subject_id" value="" required >
                            <option>Select</option>
                            <?php foreach ( $section_subject as $row) { ?>
                             <?php $x=$this->admin_model->list_subjects_by_id($row['subject_id']);?>
                                <option value="<?php echo $row['subject_id'];?>" <?php if($exam_allowed_section_subject['subject_id']==$row['subject_id']){echo 'selected';}?>><?php print_r($x['name']); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Paper :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="paper_id" value="" required >
                            <?php foreach ( $subject_option as $row) { ?>
                                <option value="<?php echo $row['id'];?>" <?php if($exam_allowed_section_subject['paper_id']==$row['id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                            <?php }?>
                        </select>

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Max Mark :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="max" value="<?php echo  $exam_allowed_section_subject['max']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Min Mark :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="min" value="<?php echo  $exam_allowed_section_subject['min']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Syllabus :</label>
                    <div class="col-xs-6">
                        <input type="file" class="form-control" name="syllabus">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Study Material:</label>
                    <div class="col-xs-6">
                        <input type="file" class="form-control" name="study_material">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-6 control-label">Exam Date:</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="exam_date"  value="<?php echo  $exam_allowed_section_subject['exam_date']; ?>" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-6 control-label">Start Time:</label>
                    <div class="col-sm-6">
                        <input type="time" class="form-control" name="start_time" id="start_time" value="<?php echo  $exam_allowed_section_subject['start_time']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-6 control-label">End Time :</label>
                    <div class="col-sm-6">
                        <input type="time" class="form-control" name="end_time" id="end_time" onblur="chk_time()" value="<?php echo  $exam_allowed_section_subject['end_time']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success"  value="Submit" id="submit">
                    </div>
                </div>
                <!--=====================================-->
                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
    <!---------------------------->

</div>
<!--=====================================-->
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
                url: '<?php echo base_url()?>index.php/admin/update_exam_allowed_section_subject',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    if(msg) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully. </span><div>");

                    }else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable to update record . </span><div>");

                    }
                    loadview('subject_marks/<?php echo $sub_id;?>');
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

<script>

    function chk_time() {
        var end = $('#end_time').val();
        var start = $('#start_time').val();
        if( start > end)
        {
            var end = $('#end_time').val("");
            $('#end_time').val('');
            alert('End time always greater then Start time');
        }
    }

</script>
