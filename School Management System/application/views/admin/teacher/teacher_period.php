
<h1 class="page-title"> Teacher Period </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('teacher_period')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_period);?>
    <div class="col-md-12" style="margin-bottom: 10px; border: 1px solid white;">
        <!--=====================================-->
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Teacher :</label>
        <div class="col-sm-3 col-xs-8" style="margin-bottom: 10px">
            <select class="form-control" id="teacher" onchange="getdata(value)"  >
                <option value="">Select</option>
                <?php foreach($emp_teacher as $row){?>
                    <option value="<?php echo $row['employee_id'];?>"><?php echo $row['name'];?></option>
                <?php } ?>
            </select>
        </div>
        <!--=====================================-->
    </div>

<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
<table id="example"  >
    <thead>
    <tr><th style="width: 20px"> Id </th><th style="width: 30px">Class</th><th style="width: 30px">Section</th><th>Period</th><th>Time</th><th style="width: 80px" >Subject</th><th style="width: 80px">Teacher</th><th style="width: 80px">Status</th><th style="width: 80px">Action</th></tr>
    </thead>
    <tbody>
    <?php foreach ( $all_period as $row) { ?>
        <?php
        $class=$this->admin_model->class_by_id($row['class_id']); $class=$class['name'];
        $period=$this->admin_model->list_period_by_id($row['name']); $period=$period['name'];
        $section=$this->admin_model->section_by_id($row['section_id']); $section=$section['name'];
        $subject=$this->admin_model->list_subjects_by_id($row['subject']); $subject=$subject['name'];
       /* $teacher=$this->admin_model->list_employee_by_id($row['teacher_id']); $teacher=$teacher['name'];*/
        $teacher=$this->admin_model->teacher_name($row['teacher_id']);
        ?>
        <tr>
            <td style="width: 20px" ><?php echo $row['id']?></td>
            <td style="width: 30px"><?php echo $class; ?></td>
            <td style="width: 30px"><?php echo $section ?></td>
            <td><?php echo $period; ?></td>
            <td><?php echo date('h:ia', strtotime($row['start_time'])). " - " .date('h:ia', strtotime($row['end_time'])) ?></td>
            <td style="width: 80px"><?php echo $subject; ?></td>
            <td style="width: 80px"><?php echo $teacher;?></td>
            <td style="width: 80px"><?php if($row['status']==1){ ?>
                    <span class="label label-sm btn-green" onclick="change_status(<?php echo $row["id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star-empty"></i> Active</span>
                <?php }else{ ?>
                    <span class="label label-sm btn-red" onclick="change_status(<?php echo $row["id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star"></i> Inactive</span>
                <?php } ?>
            </td>

            <td style="width:80px"><a class="gold-bt" onclick="loadview('edit_period/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>  <span class="hidden-xs">Edit</span></a></td>

        </tr>
    <?php }?>
    </tbody>
</table>
</div>
<!--=====================================-->
<script>
    function getdata(x) {
       loadview('teacher_period/'+x);
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>



