

<h1 class="page-title"> All Teacher </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('teacher')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
<div class="guardian">
     <div class="col-sm-8 col-sm-offset-2">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                   All Teacher
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_teacher',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Select Employee :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="employee_id" onchange="detail(value)" required >
                            <option value="">Select</option>
                        <?php foreach($emp_teacher as $row){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['name'];?></option>
                        <?php } ?>
                        </select>

                    </div>
                </div>
                <div  id="det">


                </div>
                <div class="form-group">
                    <label class="col-xs-4">Select Type :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="type"  required >
                            <?php foreach($teacher_type as $row){?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
                    </div>
                </div>
              </div>
            <!--=====================================-->

                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div>

<!--=====================================-->
<!--=====================================-->
<div class="col-sm-8 col-sm-offset-2" style="overflow-x:auto;">
    <table id="example"  >
        <thead>
        <tr><th style="width: 20px"> Id </th><th style="width: 50px" >Name</th><th style="width: 50px" >Type </th><th style="width: 50px" >Action </th></tr>
        </thead>
        <tbody>
        <?php foreach ( $teacher as $row) { ?>
            <?php $emp=$this->admin_model->list_employee_by_id($row["employee_id"]) ?>
            <tr>
                <td style="width: 50px" ><?php  echo $row['teacher_id']?></td>
                <td style="width: 50px" ><?php echo $emp['name'] ?></td>
                <td style="width: 50px" ><?php $type=$this->admin_model->teacher_type_by_id($row['type']);echo($type['name']); ?></td>
                <!--...............................................................-->
                <td>
                    <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a   onclick="loadview('edit_teacher/<?php echo $row["employee_id"];?>')"><i class="entypo-pencil"></i> Edit </a> </li>
<!--                            <li><a   onclick="loadview('print_employee/<?php /*echo $row["employee_id"];*/?>')"><i class="entypo-print"></i> Print </a> </li>
                            <li><a   onclick="loadview('qualification/<?php /*echo $row["employee_id"];*/?>')"><i class="entypo-print"></i>  Qualification </a> </li>
                            <li><a   onclick="loadview('experience/<?php /*echo $row["employee_id"];*/?>')"><i class="entypo-print"></i>  Experience </a> </li>-->
                            <li><a  data-toggle="modal" data-target="#myModal<?php echo $row['employee_id'] ?>"><i class="entypo-newspaper"></i> Detail</a>
                            </li>
                        </ul>
                    </div>
                    <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


                    <!-----------------MODEL FOR DISPLAY DETAIL------------------->


                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $row['employee_id'] ?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2 class="modal-title">Teacher Detail</h2>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-responsive">
                                        <tr><th>Id</th><td><?php echo $emp['employee_id'] ?></tr>
                                        <tr><th>Employee No</th><td><?php echo $emp['emp_no'] ?></tr>
                                        <tr><th>Name</th><td><?php echo $emp['name'] ?></td></tr>
                                        <tr><th>Type</th><td><?php echo $type['name'] ?></td></tr>
                                        <tr><th>Father's Name</th><td><?php echo $emp['father_name'] ?></td></tr>
                                        <tr><th>Gender</th><td><?php echo $emp['gender'] ?></td></tr>
                                        <tr><th>Date of Birth</th><td><?php echo $emp['dob'] ?></td></tr>
                                        <tr><th>Joining Date</th><td><?php echo $emp['joining_date'] ?></td></tr>
                                        <tr><th>Contact No</th><td><?php echo $emp['contact_no'] ?></td></tr>
                                        <tr><th>Email</th><td><?php echo $emp['email'] ?></td></tr>
                                        <tr><th>Emergency person</th><td><?php echo $emp['emergency_person'] ?></td></tr>
                                        <tr><th>Emergency Contact No</th><td><?php echo $emp['emergency_contact_no'] ?></td></tr>
                                        <tr><th>Addhar No</th><td><?php echo $emp['adhar_no'] ?></td></tr>
                                        <tr><th>Pan No</th><td><?php echo $emp['pan_no'] ?></td></tr>
                                        <tr><th>Function</th><td><?php echo $emp['function'] ?></td></tr>
                                        <tr><th>Designation</th><td><?php echo $emp['designation'] ?></td></tr>
                                        <tr><th>Remark</th><td><?php echo $emp['remark'] ?></td></tr>
                                        <tr><th>Blood Group</th><td><?php echo $emp['blood_group'] ?></td></tr>
                                        <tr><th>Nationality</th><td><?php echo $emp['nationality'] ?></td></tr>
                                        <tr><th>Residential Address</th><td><?php echo $emp['residential_address'] ?></td></tr>
                                        <tr><th>Correspondence Address</th><td><?php echo $emp['correspondence_address'] ?></td></tr>
                                        <tr><th>Login Id</th><td><?php echo $emp['login_id'] ?></td></tr>
                                        <tr><th>Password</th><td><?php echo $emp['password'] ?></td></tr>
                                        <tr><th>Left Date</th><td><?php echo $emp['left_date'] ?></td></tr>
                                        <tr><th>Status</th><td><?php echo $emp['status'] ?></td></tr>
                                        <tr><th>Type</th><td><?php echo $emp['employee_type'] ?></td></tr>
                                        <img class="img-responsive image_on_modal" src="<?php echo base_url()?>/uploads/<?php echo $emp['employee_image'] ?>">
                                    </table>
                                    <!--------------->
                                    <h1 class="page-title">Qualification</h1>
                                    <?php $qualification=$this->admin_model->list_emp_qualification_by_employee_id($row["employee_id"]) ?>
                                    <div  style="overflow-x:auto;">
                                    <table class="table table-responsive">
                                        <tr>
                                            <th style="width: 2%">ID</th>
                                            <th>Course</th>
                                            <th>Duration</th>
                                            <th>Board</th>
                                            <th>Year of Passing</th>
                                            <th>Subjects</th>
                                            <th>Marks Achieved</th>
                                            <th>Subjects Taught</th>
                                            <th>Specialisation</th>

                                        </tr>
                                        <?php $x=1; foreach($qualification as $row) { ?>
                                            <tr>
                                                <td><?php  echo $x++;?></td>
                                                <td><?php  echo $row['course'];?></td>
                                                <td><?php  echo $row['board'];?></td>
                                                <td><?php  echo $row['course_duration'];?></td>
                                                <td><?php  echo $row['year'];?></td>
                                                <td><?php  echo $row['subjects'];?></td>
                                                <td><?php  echo $row['marks_achieved'];?></td>
                                                <td><?php  echo $row['subjects_taught'];?></td>
                                                <td><?php  echo $row['specialisation'];?></td>
                                            </tr>

                                        <?php  } ?>
                                    </table>
                                    </div>

                                    <h1 class="page-title">Experience</h1>
                                    <?php $experience=$this->admin_model->list_emp_experience_by_employee_id($row["employee_id"]) ?>
                                    <div  style="overflow-x:auto;">
                                    <table class="table table-responsive">
                                        <tr>
                                            <th style="width: 2%">ID</th>
                                            <th>Post</th>
                                            <th>Organization</th>
                                            <th>Year From</th>
                                            <th>Year to</th>
                                            <th>Duration</th>

                                        </tr>
                                        <?php $x=1; foreach($experience as $row) { ?>
                                            <tr>
                                                <td><?php  echo $x++;?></td>
                                                <td><?php  echo $row['position'];?></td>
                                                <td><?php  echo $row['institution'];?></td>
                                                <td><?php  echo $row['from_year'];?></td>
                                                <td><?php  echo $row['to_year'];?></td>
                                                <td><?php  echo $row['total_duration'];?></td>
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                    </div>
                                    <!--------------->
                                </div>
                            </div>

                        </div>
                    </div>

                </td>
                <!--...............................................................-->
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--=====================================-->

<!--to form submit upload image-->
<script>
    function detail(id){
     /*   alert(id);*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/show_teacher_detail',
            type:"POST",
            datatype:"json",
            data:{id:id},
            success: function (msg) {

                $("#det").html(msg);
            },
            error: function () { alert("fail");
            }
        })
    }
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_teacher',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    if(msg==1) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                    }
                    else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Unable To Update <span style='color: red'> Try again</span><div>");

                    }
                    loadview('teacher');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


