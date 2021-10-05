<h1 class="page-title"> Exam Marks </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('paper_marks/<?php echo $exam_id; ?>/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $subject_id; ?>/<?php echo $paper_id; ?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<?php
//echo $exam_id;echo $class_id;echo $section_id;echo $subject_id;echo $paper_id;
?>
<!--=====================================-->
<div class="col-sm-8 col-sm-offset-2" style="overflow-x:auto;">
    <div>

    </div>
    <table class="table" >
        <thead>
        <tr><td colspan="5">
                <h4 class="page-title" style="text-align: center;" >Exam : <?php $class= $this->admin_model->list_all_exam_by_id( $exam_id); echo $class['name'] ?>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Class : <?php $class= $this->admin_model->class_by_id($class_id); echo $class['name'] ?></span>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Section : <?php $section= $this->admin_model->section_by_id($section_id); echo $section['name']; ?></span>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Subject : <?php $section= $this->admin_model->list_subjects_by_id($subject_id); echo $section['name']; ?></span>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Paper : <?php $section= $this->admin_model->list_subject_option_by_id($paper_id); echo $section['name']; ?></span>
                </h4>
            </td></tr>


        <tr><th style="width: 10px"> Id </th><th style="width: 30px">Name</th><th style="width: 30px">Marks</th><th style="width: 80px" >Max Mark</th><th style="width: 80px">Min Mark</th></tr>
        </thead>
        <tbody>
        <?php $sn=1;foreach ( $all_data as $row) {; ?>
            <tr>
                <td style="width: 20px;background-color: darkgoldenrod;color: white;vertical-align: middle;text-align: center"  ><?php echo $sn++?></td>
                <td style="width: 20px;background-color: darkgoldenrod;color: white;vertical-align: middle;" ><?php $stu=$this->admin_model->student_name_by_id($row['student_id']) ; print_r($stu); ?></td>
                <td style="width: 20px" ><input onblur="update_mark(value,<?php echo  $row['id']; ?>)" class="form-control" type="number" value="<?php echo $row['marks'] ?>"></td>
                <td style="width: 20px" ><?php echo $row['max'] ?></td>
                <td style="width: 20px" ><?php echo $row['min'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!--=====================================-->
<script>
    function update_mark(value,id) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/update_exam_marks_value',
            type:"POST",
            datatype:"json",
            data:{id:id,marks:value},
            success: function (msg) {
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'><b>"+msg+" <b> &nbsp;&nbsp;&nbsp;&nbsp;Updated successfully.  </span><div>");

            },
            error: function () {
                alert("fail");
            }
        })
    }

</script>
<script>
    function go(paper_id,cl_id,sec_id,sub_id,id){
        var exam_id = $('#exam_id'+id).val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/generate_exam_marks',
            type:"POST",
            datatype:"json",
            data:{exam_id:exam_id,class_id:cl_id,section_id:sec_id,subject_id:sub_id,paper_id:paper_id},
            success: function (msg) {
                alert(msg);
            },
            error: function () {
                alert("fail");
            }
        })
    }
</script>
<script>
    function getpaper(exam_id,cl_id,sec_id,sub_id,id) {
        var x='#paper_id'+id;
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/getpaper',
            type:"POST",
            datatype:"json",
            data:{exam_id:exam_id,cl_id:cl_id,sec_id:sec_id,sub_id:sub_id},
            success: function (msg) {
                $(x).html(msg);
            },
            error: function () {
                alert("fail");
            }
        })
    }
</script>
<!--to form submit upload image-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_period_status',
            type:"POST",
            datatype:"json",
            data:{id:id,status:status},
            success: function (msg) {
                /*  alert(msg)*/
                if(msg==1) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
                }else{
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable Update . </span><div>");
                }
                loadview('all_period');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }
</script>



