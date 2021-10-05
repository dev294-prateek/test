<h1 class="page-title" > Student Subject </h1>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('st_subject/<?php echo $student["student_id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<a class="gold-bt" onclick="loadview('sc_st_certificate/<?php echo $student["student_id"];?>')"><i class="entypo-reply"></i>Prev</a>
<a class="gold-bt float-r" onclick="reset_subject(<?php echo $student["student_id"];?>,<?php echo $student["section"];?>)" ><i class="entypo-arrows-ccw"></i>Reset Subject </a>
<hr>
<div class="col-sm-8 col-sm-offset-2" >
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Student Detail
            </div>
        </div>
        <div class="panel-body">
            <h4 class="page-title" > Name : <?php echo $student['student_name'] ?></h4>
            <h4 class="page-title" >Class : <?php $class= $this->admin_model->class_by_id($student['class']); echo $class['name'] ?></h4>
            <h4 class="page-title" >Section : <?php $section= $this->admin_model->section_by_id($student['section']); echo $section['name']; ?></h4>
            <h4 class="page-title" >Guardian : <?php $guardian= $this->admin_model->list_guardian_by_id($student['guardian']); echo $guardian['guardian_name']; ?></h4>

        </div>
    </div>
    <div class="alert alert-warning "> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> This Student required <span style="color: red"> <?php echo $section['s_compulsory'] ?>  </span> Compulsory Subjects & <span style="color: red"> <?php echo ($section['s_required']-$section['s_compulsory']) ?>  </span> Optional Subjects<div></div></div>

</div>
<br>
<div class="col-sm-8 col-sm-offset-2">
    <table class="table table-responsive">
        <tbody>
        <tr><td  colspan="5" style="text-align: center;color: darkgoldenrod;">Student Subjects</td></tr>
        <tr><th>S.N.</th><th  >Student Subjects</th><th>Type</th><th>Action</th></tr>

        <?php $l= count($student_subject); for($i=0;$i<$l;$i++){ ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php $x=$this->admin_model->list_subjects_by_id($student_subject[$i]['subject_id']);print_r($x['name']); ?></td>
                <td><?php if($student_subject[$i]['type']==1){ ?>
                        <span class="label label-sm btn-green" ><i class="entypo-star-empty"></i> Compulsory</span>
                    <?php }else{ ?>
                        <span class="label label-sm btn-red"  ><i class="entypo-star"></i>Optional</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if($student_subject[$i]['type']!=1){ ?>
                    <button class="btn  btn-red" onclick="delete_sub(<?php echo $student["student_id"];?>,<?php echo $i;?>)">Delete</button>
                    <?php } ?>
                </td>
            </tr>
        <?php }?>


        </tbody>
    </table>
</div>

 </div>
<script>
    function delete_sub(st_id,offset) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/delete_student_subject',
            type:"POST",
            datatype:"json",
            data:{st_id:st_id,offset:offset},
            success: function(msg){
              loadview('st_subject/<?php echo $student["student_id"];?>');
            },
            error: function () { alert("fail");
            }
        })

    }
</script>


<script>
    function reset_subject(st_id,section_id) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/reset_student_subject',
            type:"POST",
            datatype:"json",
            data:{st_id:st_id,section_id:section_id},
            success: function(msg){
               loadview('st_subject/<?php echo $student["student_id"];?>');
            },
            error: function () { alert("fail");
            }
        })
    }


</script>





