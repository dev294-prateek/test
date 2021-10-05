<style>
    th{border: 1px solid wheat;}
    th {
        vertical-align: middle !important;
    }
    span.vis {
        display: none;
        position: absolute;
        border: 6px solid darkgoldenrod;
        background-color: black;
        padding: 20px 10px;
        color: white;
        border-bottom-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-top-right-radius: 50%;
        z-index: 100;
    }
    a:hover + span.vis {
        display: block;
    }
</style>
<h1 class="page-title"> Tabulation  </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('tabulation_marks/<?php echo $exam_id; ?>/<?php echo $class_id; ?>/<?php echo $section_id; ?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<?php //print_r($sub); ?>

<!--=====================================-->
<div class="col-sm-12" >
    <table class="table" >
        <tr><td>
                <h4 class="page-title" style="text-align: center;" >Exam : <?php $class= $this->admin_model->list_all_exam_by_id( $exam_id); echo $class['name'] ?>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Class : <?php $class= $this->admin_model->class_by_id($class_id); echo $class['name'] ?></span>
                    <span >&nbsp;&nbsp;&nbsp;&nbsp; Section : <?php $section= $this->admin_model->section_by_id($section_id); echo $section['name']; ?></span>
                </h4>
            </td></tr>
    </table>
</div>
<div class="col-sm-12" style="overflow-x:auto;">
    <div id="table-scroll" class="table-scroll">
        <div class="table-wrap">
            <table class="main-table">
        <thead>

        <tr>
            <th rowspan="2" class="fixed-side" scope="col" style="width: 20px">S.N</th>
            <th  rowspan="2" class="fixed-side" scope="col">Name</th>
            <?php foreach ( $sub as $sub_l) {; ?>
               <?php $paper=$this->admin_model->list_all_exam_allowed_section_paper_tabulation($exam_id,$class_id,$section_id,$sub_l['subject_id']); ?>
                <th  style="text-align: center" colspan="<?php  print_r(count($paper)); ?>">
                <?php  $sub1=$this->admin_model->list_subjects_by_id($sub_l['subject_id']); echo $sub1['name'];   ?>
                </th>
            <?php } ?>
           </tr>
        <tr>
            <?php foreach ( $sub as $sub_l) {; ?>
                <?php $paper=$this->admin_model->list_all_exam_allowed_section_paper_tabulation($exam_id,$class_id,$section_id,$sub_l ['subject_id']); ?>
            <?php foreach ( $paper as $pap_l) {; ?>
                    <?php $y=$this->admin_model->paper_name($pap_l['paper_id']); echo "<th>";echo $y; echo "</th>"; ?>
            <?php } } ?>
        </tr>

        </thead>
        <tbody>
        <?php $sn=1;foreach ( $all_data as $row) {; ?>
            <tr>
                <td  class="fixed fixed-side" style="vertical-align: middle;text-align: center"  ><?php echo $sn++?></td>
                <td  class="fixed-side fixed" style="vertical-align: middle;" ><?php $stu=$this->admin_model->student_name_by_id($row['student_id']) ; print_r($stu); ?></td>
                <?php foreach ( $sub as $sub_l) {; ?>
                    <?php $paper=$this->admin_model->list_all_exam_allowed_section_paper_tabulation($exam_id,$class_id,$section_id,$sub_l ['subject_id']); ?>
                    <?php foreach ( $paper as $pap_l) {; ?>
                        <?php $mark=$this->admin_model->subject_paper_mark($exam_id,$class_id,$section_id,$row['student_id'],$sub_l ['subject_id'],$pap_l['paper_id']); echo "<td>";echo "<a>".$mark['marks']."</a>"; echo "<span class='vis' > Min : " . $mark['min']; echo "<br>Max : " . $mark['max'] . "</span>" ;echo "</td>"; ?>
                    <?php } } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
        </div>
    </div>
</div>
<!--=====================================-->
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
<script>
    jQuery(document).ready(function() {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
</script>


