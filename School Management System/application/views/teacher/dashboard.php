


<h1 class="page-title" > Dashboard </h1>
<hr>
<?php if($_SESSION['class_id']) { ?> 


<?php $class= $this->admin_model->class_by_id($_SESSION['class_id']);  ?>
<?php $section= $this->admin_model->section_by_id($_SESSION['section_id']);  ?>
<h1 style="text-align: center">
    <span class="label label-sm btn-green">Class: &nbsp;&nbsp;<?php echo $class['name'] ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $section['name'] ;  ?></span>
</h1>
<hr>
<div class="row">
    <div class="col-sm-12">

    </div>
<hr>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->teacher_model->all_student_count() ?>
        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>

            <h3>Students</h3>
            <p></p>
        </div>

    </div>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->admin_model->all_event_count() ?>
        <div class="tile-stats tile-pink">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Events</h3>
            <p></p>
        </div>
    </div>
    <?php //print_r($_SESSION); ?>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->teacher_model->all_class_g_count() ?>
        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Class Gallery</h3>
            <p></p>
        </div>
    </div>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->admin_model->all_school_g_count() ?>
        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>School Gallery</h3>
            <p></p>
        </div>
    </div>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->admin_model->all_video_count() ?>
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Video Gallery</h3>
            <p></p>
        </div>
    </div>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->teacher_model->all_p_count() ?>
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Period</h3>
            <p></p>
        </div>
    </div>
    <div class="col-sm-6 col-xs-6">
        <?php  $p = $this->teacher_model->lesson_plan_count(); ?>
        <?php  $pp = $this->teacher_model->lesson_plan_p_count(); ?>
        <?php  $pa = $this->teacher_model->lesson_plan_a_count(); ?>
        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num"><span style="color:Yellow" ></span> T: <?php echo  $p ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >A : </span> <?php echo  $pa ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >P: </span> <?php echo  $pp ;  ?></div>
            <h3>Lesson Plan</h3>
            <p></p>
        </div>
    </div>

    <!--==========================================================-->

</div>

<br />

<div class="row">
    <?php
    $class= $this->admin_model->list_all_active_class();
    $emp_teacher=$this->admin_model->list_all_employee_teacher();


    ?>
    <?php //print_r($_SESSION)?>
    <div class="col-sm-12">
        <table id="example" class="table table-bordered" >
            <thead>
            <tr><th style="width: 20px"> Id </th><th>Class Teacher</th><th>Today</th><th>This Month </th><th>This Session</th><th>Status</th></tr>
            </thead>
            <tbody>

            <?php  $t_p=$t_a=$t_l=0; ?>
            <?php  $tm_p=$tm_a=$tm_l=0; ?>
            <?php  $ts_p=$ts_a=$ts_l=0; ?>

                <tr>
                    <td style="width: 50px" ><?php  echo $_SESSION['section_id']?></td>
                    <td><?php $teach=$this->admin_model->teacher_name($_SESSION['teacher_id']); print_r($teach);?></td>
                    <td> <span style="color:green" >P : </span> <?php $p=$this->admin_model->get_attendance_p_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']);  $t_p += $p; echo $p;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php $a=$this->admin_model->get_attendance_a_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']); $t_a += $a; echo $a;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php $l=$this->admin_model->get_attendance_l_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']); $t_l += $l; echo $l;?>
                    </td>

                    <td> <span style="color:green" >P : </span> <?php $pm=$this->admin_model->get_attendance_pm_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']);$tm_p += $pm; echo $pm;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php $am=$this->admin_model->get_attendance_am_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']);$tm_a += $am; echo $am;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php $lm=$this->admin_model->get_attendance_lm_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']);$tm_l += $lm; echo $lm;?>
                    </td>

                    <td> <span style="color:green" >P : </span> <?php $ps=$this->admin_model->get_attendance_ps_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']);$ts_p += $ps; echo $ps;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:red" >A : </span> <?php $as=$this->admin_model->get_attendance_as_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']);$ts_a += $as; echo $as;?>
                        &nbsp;&nbsp;&nbsp;<span style="color:blue" >L : </span> <?php $ls=$this->admin_model->get_attendance_ls_for_dashboard($_SESSION['class_id'],$_SESSION['section_id']); $ts_l += $ls;echo $ls;?>
                    </td>
                    <td><?php $t=$p+$a+$l;if($t>0){?>
                            <span class="label label-sm btn-green"><i class="entypo-star-empty"></i> Attendance Taken</span>
                        <?php }else{ ?>
                            <span class="label label-sm btn-red"><i class="entypo-star"></i>Attendance Not Taken</span>
                        <?php } ?>

                    </td>

                </tr>


            </tbody>
        </table>
    </div>
</div>

<?php } else{ ?>
     <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->admin_model->all_event_count() ?>
        <div class="tile-stats tile-pink">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Events</h3>
            <p></p>
        </div>
    </div>
        <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->admin_model->all_school_g_count() ?>
        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>School Gallery</h3>
            <p></p>
        </div>
    </div>
    <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->admin_model->all_video_count() ?>
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Video Gallery</h3>
            <p></p>
        </div>
    </div>
     <div class="col-sm-3 col-xs-6">
        <?php  $x = $this->teacher_model->all_p_count() ?>
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num"><?php echo  $x ;  ?></div>
            <h3>Period</h3>
            <p></p>
        </div>
    </div>
    <div class="col-sm-6 col-xs-6">
        <?php  $p = $this->teacher_model->lesson_plan_count(); ?>
        <?php  $pp = $this->teacher_model->lesson_plan_p_count(); ?>
        <?php  $pa = $this->teacher_model->lesson_plan_a_count(); ?>
        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num"><span style="color:Yellow" ></span> T: <?php echo  $p ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >A : </span> <?php echo  $pa ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >P: </span> <?php echo  $pp ;  ?></div>
            <h3>Lesson Plan</h3>
            <p></p>
        </div>
    </div>
<?php } ?>

