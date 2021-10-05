<h1 class="page-title"> Exam Marks </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('exam')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<div class="col-sm-8 col-sm-offset-2" style="overflow-x:auto;">
    <table id="example"  >
        <thead>
        <tr><th style="width: 20px"> Id </th><th style="width: 30px">Class</th><th style="width: 30px">Section</th><th style="width: 80px" >Subject</th><th style="width: 80px">Teacher</th><th style="width: 80px">Exam</th><th style="width: 80px">Paper</th></tr>
        </thead>
        <tbody>
        <?php foreach ( $all_period as $row) { ?>
            <?php
            $class=$this->guardian_model->class_by_id($row['class_id']); $class=$class['name'];
            $section=$this->guardian_model->section_by_id($row['section_id']); $section=$section['name'];
            $subject=$this->guardian_model->list_subjects_by_id($row['subject']); $subject=$subject['name'];
            $teacher=$this->guardian_model->teacher_name($row['teacher_id']);
            ?>
            <tr>
                <td style="width: 20px" ><?php echo $row['id']?></td>
                <td style="width: 30px"><?php echo $class; ?></td>
                <td style="width: 30px"><?php echo $section ?></td>
                <td style="width: 80px"><?php echo $subject; ?></td>
                <td style="width: 80px"><?php echo $teacher;?></td>
                <td style="width: 80px"><?php $exam=$this->guardian_model->list_all_exam_allowed_section($row['class_id'],$row['section_id']);?>
                    <select class="form-control" name="exam_id" id="exam_id<?php echo $row['id']?>" value="" onchange="getpaper(value,<?php echo $row['class_id'];?>,<?php echo $row['section_id'];?>,<?php echo $row['subject'];?>,<?php echo $row['id'];?>);">
                        <option>Select</option>
                        <?php foreach ( $exam as $col) { ?>
                        <option value="<?php echo $col['exam_id']?>"><?php $exam1=$this->guardian_model->exam_by_id($col['exam_id']); echo $exam1['name'] ;?></option>
                        <?php }?>
                    </select>
                </td>
                <td style="width: 80px">
                    <select class="form-control" name="paper_id" id="paper_id<?php echo $row['id']?>" value="" onchange="go(value,<?php echo $row['class_id'];?>,<?php echo $row['section_id'];?>,<?php echo $row['subject'];?>,<?php echo $row['id'];?>)">
                    </select>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--=====================================-->
<script>
    function go(paper_id,cl_id,sec_id,sub_id,id){
        var exam_id = $('#exam_id'+id).val();
        var view='paper_marks/'+exam_id+'/'+cl_id+'/'+sec_id+'/'+sub_id+'/'+paper_id;
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/generate_exam_marks',
            type:"POST",
            datatype:"json",
            data:{exam_id:exam_id,class_id:cl_id,section_id:sec_id,subject_id:sub_id,paper_id:paper_id},
            success: function (msg) {
               loadview(view);
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

</script>



