<style>
.tile-stats .num {
    font-size: 25px;
    font-weight: 700;
}
</style>

        <h1 class="page-title" > Attendance Summary </h1>
        <hr>
           
<div class="row">
    <?php
    $all_section= $this->admin_model->list_all_active_section();
    $class= $this->admin_model->list_all_active_class();
    $emp_teacher=$this->admin_model->list_all_employee_teacher();


    ?>
    <div class="col-sm-12">
        <table id="example" class="table table-bordered" >
            <thead>
            <tr><th style="width: 20px"> Id </th><th style="width: 50px" >Class </th><th style="width: 50px" >Section</th><th>Class Teacher</th>



                <th>Today</th><th>This Month </th><th>This Session</th><th > Fee Collection</th><th>Status</th></tr>
            </thead>
            <tbody>

            <?php  $t_p=$t_a=$t_l=0; ?>
            <?php  $tm_p=$tm_a=$tm_l=0; ?>
            <?php  $ts_p=$ts_a=$ts_l=0; $fee_col=0; ?>
            <?php  foreach ( $all_section as $row) { ?>
                <tr>


                    <td style="width: 50px" ><?php  echo $row['section_id']?></td>
                    <td style="width: 20px" ><?php $x=$this->admin_model->class_by_id($row['class_id']); echo $x['name']?></td>
                    <td style="width: 50px" ><?php echo $row['name']?></td>
                    <td><?php $teach=$this->admin_model->teacher_name($row['teacher_id']); print_r($teach);?></td>

                    <td> <span style="color:green" >P : </span> <?php $p=$this->admin_model->get_attendance_p_for_dashboard($row['class_id'],$row['section_id']);  $t_p += $p; echo $p;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php $a=$this->admin_model->get_attendance_a_for_dashboard($row['class_id'],$row['section_id']); $t_a += $a; echo $a;?>
                  &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php $l=$this->admin_model->get_attendance_l_for_dashboard($row['class_id'],$row['section_id']); $t_l += $l; echo $l;?>
                    </td>

                    <td> <span style="color:green" >P : </span> <?php $pm=$this->admin_model->get_attendance_pm_for_dashboard($row['class_id'],$row['section_id']);$tm_p += $pm; echo $pm;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php $am=$this->admin_model->get_attendance_am_for_dashboard($row['class_id'],$row['section_id']);$tm_a += $am; echo $am;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php $lm=$this->admin_model->get_attendance_lm_for_dashboard($row['class_id'],$row['section_id']);$tm_l += $lm; echo $lm;?>
                    </td>

                    <td> <span style="color:green" >P : </span> <?php $ps=$this->admin_model->get_attendance_ps_for_dashboard($row['class_id'],$row['section_id']);$ts_p += $ps; echo $ps;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php $as=$this->admin_model->get_attendance_as_for_dashboard($row['class_id'],$row['section_id']);$ts_a += $as; echo $as;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php $ls=$this->admin_model->get_attendance_ls_for_dashboard($row['class_id'],$row['section_id']); $ts_l += $ls;echo $ls;?>
                    </td>

                    <td style="width:20%"><?php $fr=$this->admin_model->fee_rate_section($row['section_id']);// print_r($fr);?> 
                    <?php $fr2=$this->admin_model->fee_coll_section($row['section_id']); $fee_col +=$fr2; print_r($fr2);?></td>
					<td><?php $t=$p+$a+$l;if($t>0){?>
                            <span class="label label-sm btn-green"><i class="entypo-star-empty"></i> Attendance Taken</span>
                        <?php }else{ ?>
                            <span class="label label-sm btn-red"><i class="entypo-star"></i>Attendance Not Taken</span>
                        <?php } ?>

                    </td>
                </tr>
            <?php }?>
            <tr><th colspan="4">Total</th>
                <td> <span style="color:green" >P : </span> <?php echo $t_p;?>
                    &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php echo $t_a;?>
                    &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php  echo $t_l;?>
                </td>
                <td> <span style="color:green" >P : </span> <?php echo $tm_p;?>
                    &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php echo $tm_a;?>
                    &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php  echo $tm_l;?>
                </td>
                <td> <span style="color:green" >P : </span> <?php echo $ts_p;?>
                    &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php echo $ts_a;?>
                    &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php  echo $ts_l;?>
                </td>
                <td><?php echo $fee_col; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>



