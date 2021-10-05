
<?php //print_r($class);?>
<h1 class="page-title" > All Student </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_student')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<!--==================================-->
<div class="row">

    <div class="col-md-12" style="margin-bottom: 10px;">
        <!--=====================================-->
        <label class="col-xs-2">Sellect :</label>
        <div class="col-xs-3">
            <select class="form-control mtz-monthpicker-widgetcontainer" onchange="getinstal(value)" >
                <option>select</option>
                <option value=" ">All class</option>
                <?php foreach($class as $row){ ?>
                    <option value="<?php echo $row['class_id'];?>" <?php if($row['name']==$class_name)echo 'selected';?>><?php echo $row['name'];?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-xs-3" style="float: right">
            <span class="label label-sm btn-green" style="padding: 10px 20px"><?php echo $class_name;?></span>
        </div>

        <!--=====================================-->
    </div>

</div>
<br>
<!--==================================-->
<table id="example">
    <thead>
    <tr>
        <th style="width:40px !important;">ID</th>
        <th >Image</th>
        <th>Name</th>
        <th>Class</th>
        <th>Section</th>
        <th>Guardian</th>
        <th>Status</th>
        <th style="width:500px !important;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($students as $row){?>
        <tr >
            <td><?php echo $row['student_id'] ?></td>
            <td> <?php if($row['student_image']) {?>
                <img style="width:80px !important;"  class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['student_image'] ?>">
            <?php } ?>
            </td>
            <td><?php echo $row['student_name'] ?></td>
            <td><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?></td>
            <td><?php $section= $this->admin_model->section_by_id($row['section']); echo $section['name']; ?></td>
            <td><?php $guardian= $this->admin_model->list_guardian_by_id($row['guardian']); echo $guardian['guardian_name']; ?></td>
            <td><?php if($row['status']==1){ ?>
                <span class="label label-sm btn-green" onclick="change_status(<?php echo $row["student_id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star-empty"></i> Active</span>
                <?php }else{ ?>
                <span class="label label-sm btn-red" onclick="change_status(<?php echo $row["student_id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star"></i> Inactive</span>
                <?php } ?>
            </td>
            <td>
                <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
                <div class="btn-group">
                    <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">
                        <li><a   onclick="loadview('edit_student/<?php echo $row["student_id"];?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                        <li><a   onclick="loadview('print_student/<?php echo $row["student_id"];?>')"><i class="entypo-print"></i> Print </a> </li>
                        <li><a  data-toggle="modal" data-target="#myModal<?php echo $row['student_id'] ?>"><i class="entypo-newspaper"></i>Detail</a></li>
                        <li><a  onclick="loadview('birth_certificate/<?php echo $row["student_id"];?>')"><i class="entypo-plus-squared"></i> Birth Certificate</a></li>
                        <li><a  onclick="loadview('leaving_certificate/<?php echo $row["student_id"];?>')"><i class="entypo-flashlight"></i> Leaving Certificate</a></li>
                        <li><a  onclick="loadview('character_certificate/<?php echo $row["student_id"];?>')"> <i class="entypo-flashlight"></i>Character Certificate</a></li>
                        <li><a  onclick="loadview('medical_certificate/<?php echo $row["student_id"];?>')"><i class="entypo-palette"></i> Medical Certificate</a></li>
                        <li><a  onclick="loadview('sc_st_certificate/<?php echo $row["student_id"];?>')"><i class="entypo-doc-text-inv"></i> Category Certificate</a></li>
                        <li><a  onclick="loadview('st_subject/<?php echo $row["student_id"];?>')"><i class="entypo-doc-text-inv"></i> Subjects</a></li>
                        <li><a  onclick="loadview('lib_book_stu_history/<?php echo $row["student_id"];?>')"><i class="entypo-doc-text-inv"></i>Library</a></li>

                    </ul>
                </div>
                <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


                <!-----------------MODEL FOR DISPLAY DETAIL------------------->


                <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $row['student_id'] ?>" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2 class="modal-title">Student Detail</h2>
                            </div>
                            <div class="modal-body">
                                <table class="table table-responsive">
                                    <tr><th>Id</th><td><?php echo $row['student_id'] ?></tr>
                                    <tr><th>Admission No</th><td><?php echo $row['admission_no'] ?></tr>
                                    <tr><th>Session</th><td><?php echo $_SESSION['running_year']; ?></tr>
                                    <tr><th>Name</th><td><?php echo $row['student_name'] ?></tr>
                                    <tr><th>Gender</th><td><?php echo $row['gender'] ?></tr>
                                    <tr><th>DOB</th><td><?php echo $row['birthday'] ?></tr>
                                    <tr><th>Aadhaar No</th><td><?php echo $row['aadhaar_no'] ?></tr>
                                    <tr><th>Class</th><td><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?></tr>
                                    <tr><th>Section</th><td><?php $section= $this->admin_model->section_by_id($row['section']); echo $section['name']; ?></tr>
                                    <tr><th>Nationality</th><td><?php echo $row['nationality'] ?></tr>
                                    <tr><th>Religion</th><td><?php echo $row['Religion'] ?></tr>
                                    <tr><th>Guardian</th><td><?php $guardian= $this->admin_model->list_guardian_by_id($row['guardian']); echo $guardian['guardian_name']; ?></tr>
                                    <tr><th>Relation To Guardian</th><td><?php echo $row['relation_to_guardian'] ?></tr>
                                    <tr><th>Father's Name</th><td><?php echo $row['father'] ?></tr>
                                    <tr><th>Mother's Name</th><td><?php echo $row['mother'] ?></tr>
                                    <tr><th>Category</th><td><?php echo $row['sc_st'] ?></tr>
                                    <tr><th>Language Known </th><td><?php echo $row['language1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['language2']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['language3']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['language4']; ?></tr>

                                    <tr><th>Residential Address</th><td><?php echo $row['resident_address1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['resident_address2']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['resident_address3'];echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['resident_address_pin']; ?></tr>
                                    <tr><th>Correspondence Address</th><td><?php echo $row['correspond_address1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['correspond_address2']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['correspond_address3'];echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $row['correspond_address_pin']; ?></tr>

                                    <tr><th>Distance from school (in kms)</th><td><?php echo $row['distance_from_school'] ?></tr>
                                    <tr><th>Preferred Phone no. for School SMS</th><td><?php echo $row['mobile_no_for_sms'] ?></tr>
                                    <tr><th>Scholastic Activities :</th><td><?php echo $row['scholastic_activities'] ?></tr>
                                    <tr><th>Co-Scholastic Activities (hobbies)</th><td><?php $x= json_decode($row['coscholastic_activities']);
                                            if($x !='') {
                                                $length = count($x);
                                                for ($i = 0; $i < $length; $i++) {
                                                    echo ($i + 1) . " :- " . $x[$i] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                                }
                                            }
                                            ?></td></tr>

                                    <tr><th>Emergency Contact I </th><td><?php echo $row['emergency_contact_name_1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $row['emergency_contact_mobile_1'];  echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $row['emergency_contact_relation_1']; ?></tr>


                                    <tr><th>Emergency Contact II </th><td><?php echo $row['emergency_contact_name_2'];  echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $row['emergency_contact_mobile_2'];  echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $row['emergency_contact_relation_2']; ?></tr>
                                    <img class="img-responsive image_on_modal " src="<?php echo base_url()?>/uploads/<?php echo $row['student_image'] ?>">

                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </td>
        </tr>
    <?php } ?>
    </tbody>

</table>


<script>
    function getinstal(x) {
        loadview('all_student/'+x);
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_student_status',
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
                loadview('all_student');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })



    }
</script>




