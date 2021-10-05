<style>
.tile-stats .num {
    font-size: 25px;
    font-weight: 700;
}

</style>

        <h1 class="page-title" > Section Fee Summary </h1>
        <hr>
           
<div class="row">
    <?php $all_student= $this->admin_model->all_student_detail_by_section_id($section_id);
    ?>
    <div class="col-sm-12">
        <table id="example" class="table table-bordered" >
            <thead>
            <tr><td  colspan="7" style="text-align: center;color: darkgoldenrod;    background-color: lightyellow;"> Class : <span style="color: red"><?php $z=$this->admin_model->class_by_id($all_student[0]['class']); print_r($z['name']); ?> </span> Section : <span style="color: red"><?php $x=$this->admin_model->section_by_id($section_id); echo $x['name']; ?></span></td></tr>

            <tr><th style="width: 20px"> Id </th><th  >Name </th>
                <th>Today</th><th>This Month </th><th>This Session</th></tr>
            </thead>
            <tbody>

            <?php  $t_t=$m_t=$s_t=0; ?>

            <?php $sn=1; foreach ( $all_student as $row) { ?>
                <tr>

                    <td style="width: 50px" ><?php echo $sn++ ?></td>
                    <td ><?php echo $row['student_name'] ?></td>
                    <td> <?php $t=$this->admin_model->fee_coll_this_today_by_student($row['section'],$row['student_id']); $t_t+=$t;  echo $t;?> </td>
                    <td> <?php $m=$this->admin_model->fee_coll_this_month_by_student($row['section'],$row['student_id']); $m_t+=$m;   echo $m;?> </td>
                    <td> <?php $s=$this->admin_model->fee_coll_this_session_by_student($row['section'],$row['student_id']);  $s_t+=$s;  echo $s;?> </td>



                </tr>
            <?php }?>
            <tr><th colspan="2"> Total</th>
                <td> <?php echo $t_t;?></td>
                <td> <?php echo $m_t;?></td>
                <td> <?php echo $s_t;?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>



