<style>
.tile-stats .num {
    font-size: 25px;
    font-weight: 700;
}
</style>

        <h1 class="page-title" > Fee Summary </h1>
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



                <th>Today</th><th>This Month </th><th>This Session</th><th >Action</th></tr>
            </thead>
            <tbody>

            <?php  $t_t=$m_t=$s_t=0; ?>

            <?php  foreach ( $all_section as $row) { ?>
                <tr>
                    <td style="width: 50px" ><?php  echo $row['section_id']?></td>
                    <td style="width: 20px" ><?php $x=$this->admin_model->class_by_id($row['class_id']); echo $x['name']?></td>
                    <td style="width: 50px" ><?php echo $row['name']?></td>


                    <td><?php $teach=$this->admin_model->teacher_name($row['teacher_id']); print_r($teach);?></td>

                    <td> <?php $t=$this->admin_model->fee_coll_this_today_by_section($row['section_id']); $t_t+=$t;  echo $t;?> </td>
                    <td> <?php $m=$this->admin_model->fee_coll_this_month_by_section($row['section_id']); $m_t+=$m;   echo $m;?> </td>
                    <td> <?php $s=$this->admin_model->fee_coll_this_session_by_section($row['section_id']);  $s_t+=$s;  echo $s;?> </td>
                    <td> <button  onclick="loadview('fee_summary_detail/<?php  echo $row["section_id"]?>')" class="btn btn-green">Detail</button></td>


                </tr>
            <?php }?>
            <tr><th colspan="4">Total</th>
                <td> <?php echo $t_t;?></td>
                <td> <?php echo $m_t;?></td>
                <td> <?php echo $s_t;?></td>
                <td></td>

            </tr>
            </tbody>
        </table>
    </div>
</div>



