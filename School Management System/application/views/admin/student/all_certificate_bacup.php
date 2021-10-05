
<h1 class="page-title" > Student Certificate</h1>
<hr>
<div class="col-xs-12 ch-msg"> <div id="subsmsg"></div></div>
<div class="img-cert">
    <div class="col-xs-6"><h4 class="page-title" >Birth Certificate </h4></div>
    <div class="col-xs-6">
        <div class="frm-cert">
        <!--============================================================-->
        <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/update_student_certificate',$data) ?>
            <br>
            <input type="hidden" value="<?php echo $student['student_id'] ?>" name="id">
            <input type="hidden" value="birth_certificate" name="field_name">
            <input type="file" name="certificate" size="20" id="inputFile"/>
            <input type="submit"  class=" btn btn-success"  value="Upload">
            <?php echo form_close() ?>
            <!--============================================================-->
        </div>
    </div>
    <img class="img-responsive certi" src="<?php echo base_url()?>/uploads/<?php echo $student['birth_certificate'] ?>"> </div>
<div class="img-cert">
    <div class="col-xs-6"><h4 class="page-title" >Leaving Certificate</h4></div>
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
<div class="img-cert">
    <div class="col-xs-6"><h4 class="page-title" >Character Certificate</h4></div>
    <div class="col-xs-6">
    <div class="frm-cert">
    <!--============================================================-->
    <?php $data = array('id'=>"fupForm")?>
    <?php echo form_open_multipart('admin/update_student_certificate',$data) ?>
    <br>
    <input type="hidden" value="<?php echo $student['student_id'] ?>" name="id">
    <input type="hidden" value="character_certificate" name="field_name">
    <input type="file" name="certificate" size="20" id="inputFile"/>
    <input type="submit"  class=" btn btn-success"  value="Upload">
    <?php echo form_close() ?>
    <!--============================================================-->
    </div>
    </div>
    <img class="img-responsive certi" src="<?php echo base_url()?>/uploads/<?php echo $student['character_certificate'] ?>"> </div>
<div class="img-cert">
    <div class="col-xs-6"><h4 class="page-title" >Medical Certificate</h4></div>
    <div class="col-xs-6">
    <div class="frm-cert">
    <!--============================================================-->
    <?php $data = array('id'=>"fupForm")?>
    <?php echo form_open_multipart('admin/update_student_certificate',$data) ?>
    <br>
    <input type="hidden" value="<?php echo $student['student_id'] ?>" name="id">
    <input type="hidden" value="medical_certificate" name="field_name">
    <input type="file" name="certificate" size="20" id="inputFile"/>
    <input type="submit"  class=" btn btn-success"  value="Upload">
    <?php echo form_close() ?>
    <!--============================================================-->
    </div>
    </div>
    <img class="img-responsive certi" src="<?php echo base_url()?>/uploads/<?php echo $student['medical_certificate'] ?>"> </div>
<div class="img-cert">
    <div class="col-xs-6"><h4 class="page-title" >Category Certificate</h4></div>
    <div class="col-xs-6">
    <!--============================================================-->
    <div class="frm-cert">
    <?php $data = array('id'=>"fupForm")?>
    <?php echo form_open_multipart('admin/update_student_certificate',$data) ?>
    <br>
    <input type="hidden" value="<?php echo $student['student_id'] ?>" name="id">
    <input type="hidden" value="sc_st_certificate" name="field_name">
    <input type="file" name="certificate" size="20" id="inputFile"/>
    <input type="submit"  class=" btn btn-success"  value="Upload">
    <?php echo form_close() ?>
    <!--============================================================-->
    </div>
    </div>
    <img class="img-responsive certi" src="<?php echo base_url()?>/uploads/<?php echo $student['sc_st_certificate'] ?>"> </div>


<!-- Update Certificate-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_student_certificate',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '>Updated successfully. <span style='color: red'><a class='btn btn-danger' onclick='loadview(\"student_certificate/<?php echo $student['student_id'];?>\")'>View Result</a></span><div>");
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>





