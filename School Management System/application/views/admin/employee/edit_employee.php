
<h1 class="page-title">Update Employee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_employee/<?php echo $employee["employee_id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<a class="gold-bt" style="visibility:hidden"><i class="entypo-reply"></i>Prev</a>
<a class="gold-bt float-r" onclick="loadview('qualification/<?php echo $employee["employee_id"];?>')">Next<i class="entypo-forward"></i></a>
<hr>
<!--=====================================-->
<?php //print_r($employee);?>
<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update Employee
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_employee',$data) ?>
                <input value="<?php echo $employee['employee_id'];?>" type="hidden" class="form-control" name="employee_id" >
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Employee No :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['emp_no'];?>" type="number" class="form-control" name="emp_no" >

                    </div>
                    <label class="col-sm-2">Employement Type :</label>
                    <div class="col-sm-4">
                        <select name="employee_type" class="form-control" >
                            <option >Select</option>
                            <option value="Permanent" <?php if($employee['employee_type']=='Permanent') echo 'selected'?> >Permanent</option>
                            <option value="Adhoc" <?php if($employee['employee_type']=='Adhoc') echo 'selected'?>>Adhoc</option>
                            <option value="Temporary" <?php if($employee['employee_type']=='Temporary') echo 'selected'?>>Temporary</option>
                        </select>
                    </div>

                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Name:</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['name'];?>" type="text" class="form-control" name="name" >
                    </div>
                    <label class="col-sm-2">Father Name :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['father_name'];?>" type="text" class="form-control" name="father_name" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Gender:</label>
                    <div class="col-sm-4">
                        <select name="gender" class="form-control">
                            <option value="male" <?php if($employee['gender']=='male') echo 'selected'?>>Male</option>
                            <option value="female" <?php if($employee['gender']=='female') echo 'selected'?>>Female</option>
                        </select>
                    </div>
                    <label class="col-sm-2">DOB :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['dob'];?>" type="date" class="form-control" name="dob" >

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Joining Date :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['joining_date'];?>" type="date" class="form-control datepicker" name="joining_date">
                    </div>
                    <label class="col-sm-2">Contact No : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['contact_no'];?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10"  class="form-control" name="contact_no">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Email:</label>
                    <div class="col-sm-10">
                        <input value="<?php echo $employee['email'];?>" type="email" class="form-control" name="email" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Emergency Person :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['emergency_person'];?>" type="text" class="form-control datepicker" name="emergency_person">
                    </div>
                    <label class="col-sm-2">Emergency Contact No : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['emergency_contact_no'];?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10"  class="form-control" name="emergency_contact_no">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Aadhaar No :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['adhar_no'];?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12"  class="form-control datepicker"  name="adhar_no">
                    </div>
                    <label class="col-sm-2">Pan No : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['pan_no'];?>" type="text" maxlength="10" class="form-control" name="pan_no">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Function :</label>
                    <div class="col-sm-4">
                        <select name="function" class="form-control" >
                            <option <?php if($employee['employee_type']=='Permanent') echo 'selected'?> >Select</option>
                            <option value="Director Office" <?php if($employee['function']=='Director Office') echo 'selected'?>>Director Office</option>
                            <option value="Principal Office" <?php if($employee['function']=='Principal Office') echo 'selected'?>>Principal Office</option>
                            <option value="Academics"  <?php if($employee['function']=='Academics') echo 'selected'?>>Academics</option>
                            <option value="Administration"  <?php if($employee['function']=='Administration') echo 'selected'?>>Administration</option>
                            <option value="Finance"  <?php if($employee['function']=='Finance') echo 'selected'?>>Finance</option>
                            <option value="Other"  <?php if($employee['function']=='Other') echo 'selected'?>>Other</option>
                        </select>
                    </div>
                    <label class="col-sm-2">Designation : </label>
                    <?php //print_r($designation);?>
                    <div class="col-sm-4">
                        <?php if($_SESSION['sub_user_role']=='admin') {?>
                        <select name="designation" class="form-control">
                            <?php foreach($designation as $row){?>
                                <option value="<?php echo $row['name'];?>" <?php if($row['name']==$employee['designation']){echo 'selected';}?>><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                        <?php } ?>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Remarks : </label>
                    <div class="col-sm-10">
                        <input value="<?php echo $employee['remark'];?>" type="text" class="form-control" name="remark" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Blood Group :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['blood_group'];?>" type="text" class="form-control" name="blood_group" value="">
                    </div>
                    <label class="col-sm-2">Nationality :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nationality">
                            <?php foreach($nationality as $row){?>
                                <option value="<?php echo $row['name'];?>" <?php if($employee['nationality']==$row['name']) echo 'selected'?>  ><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Residential Address : </label>
                    <div class="col-sm-10">
                        <input value="<?php echo $employee['residential_address'];?>" type="text" class="form-control" name="residential_address">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Correspondence Address : </label>
                    <div class="col-sm-10">
                        <input value="<?php echo $employee['correspondence_address'];?>" type="text" class="form-control" name="correspondence_address" >
                    </div>
                </div>
                <!--=====================================-->


                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Login Id :<em>*</em></label>
                    <div class="col-sm-4">
                        <input value="<?php echo $employee['login_id'];?>" type="text" class="form-control" name="login_id" >
                    </div>

                    <label for="field-2" class="col-sm-2 control-label">Password : <em>*</em></label>

                    <div class="col-sm-4">
                        <input value="<?php echo $employee['password'];?>" type="password" class="form-control" name="password" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-12 ch">
                    <!---->
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $employee['employee_image'];?>"
                         alt="your image"/>
                    <div class="centered">Employee</div>

                    <input  type="file" name="employee_image" size="20" id="inputFile"/>
                    <!---->
                    <!--=====================================-->
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('all_employee')">
                            <span class="title">Back</span>
                        </a>
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <input  type="submit"  class=" btn btn-success "  value="Submit">
                    </div>
                </div>
                <!--=====================================-->


                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div><!--=====================================-->
<!--to preview image-->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
</script>
<!--to form submit upload image-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_employee',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'>  Updated successfully.</span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>
<!--dismis message after 4 second-->
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
</script>



