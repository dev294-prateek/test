
<h1 class="page-title" > Leaving Certificate </h1>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('leaving_certificate/<?php echo $student["student_id"];?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<a class="gold-bt" onclick="loadview('medical_certificate/<?php echo $student["student_id"];?>')">Prev</a>
<a class="gold-bt float-r"  onclick="loadview('sc_st_certificate/<?php echo $student["student_id"];?>')">Next</a>
<hr>
<div class="col-xs-12 ch-msg"> <div id="subsmsg"></div></div>
<div class="img-cert">
    <div class="col-xs-6">
        <h4 class="page-title" > Name : <?php echo $student['student_name'] ?></h4>
        <h4 class="page-title" >Class : <?php $class= $this->guardian_model->class_by_id($student['class']); echo $class['name'] ?></h4>
        <h4 class="page-title" >Section : <?php $section= $this->guardian_model->section_by_id($student['section']); echo $section['name']; ?></h4>
        <h4 class="page-title" >Guardian : <?php $guardian= $this->guardian_model->list_guardian_by_id($student['guardian']); echo $guardian['guardian_name']; ?></h4>
    </div>
    <div class="col-xs-6">
        <div class="frm-cert">
            <!--============================================================-->
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/update_student_certificate',$data) ?>
            <br>
            <input type="hidden" value="<?php echo $student['student_id'] ?>" name="id">
            <input type="hidden" value="leaving_certificate" name="field_name">
            <input type="file" name="certificate" size="20" id="inputFile"/>
            <input type="submit"  class=" btn btn-success"  value="Upload">
            <?php echo form_close() ?>
            <!--============================================================-->
        </div>
    </div>
    <img class="img-responsive certi" src="<?php echo base_url()?>/uploads/<?php echo $student['leaving_certificate'] ?>"> </div>


<!-- Update Certificate-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/teacher/update_student_certificate',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('leaving_certificate/<?php echo $student["student_id"];?>');
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Updated successfully.<div>");
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>





