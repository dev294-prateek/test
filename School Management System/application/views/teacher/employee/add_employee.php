
<h1 class="page-title"> Add Employee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('employee')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($designation);?>
<div class="guardian">
    <div class="col-md-12">
      <!--  <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Employee
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_employee',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Employee No :</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="emp_no" >

                    </div>
                    <label class="col-sm-2">Employement Type :</label>
                    <div class="col-sm-4">
                        <select name="employee_type" class="form-control" >
                        <option >Select</option>
                        <option value="Permanent">Permanent</option>
                        <option value="Adhoc">Adhoc</option>
                        <option value="Temporary">Temporary</option>
                        </select>
                    </div>

                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Name:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <label class="col-sm-2">Father Name :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="father_name" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Gender:</label>
                    <div class="col-sm-4">
                        <select name="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <label class="col-sm-2">DOB :</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="dob" >

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Joining Date :</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control datepicker" name="joining_date">
                    </div>
                    <label class="col-sm-2">Contact No : </label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="contact_no">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Emergency Person :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" name="emergency_person">
                    </div>
                    <label class="col-sm-2">Emergency Contact No : </label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="emergency_contact_no">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Aadhaar No :</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control datepicker"  name="adhar_no">
                    </div>
                    <label class="col-sm-2">Pan No : </label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="pan_no">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Function :</label>
                    <div class="col-sm-4">
                        <select name="function" class="form-control" >
                            <option value="">Select</option>
                            <option value="Director Office">Director Office</option>
                            <option value="Principal Office">Principal Office</option>
                            <option value="Academics">Academics</option>
                            <option value="Administration">Administration</option>
                            <option value="Finance">Finance</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <label class="col-sm-2">Designation : </label>
                    <div class="col-sm-4">
                        <select name="designation" class="form-control">
                            <?php foreach($designation as $row){?>
                                <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Remarks : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="remark" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Blood Group :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="blood_group" value="">
                    </div>
                    <label class="col-sm-2">Nationality :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nationality">
                            <?php foreach($nationality as $row){?>
                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Residential Address : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="residential_address" value="">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Correspondence Address : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="correspondence_address" >
                    </div>
                </div>
                <!--=====================================-->


                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Login Id :<em>*</em></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="login_id" >
                    </div>

                    <label for="field-2" class="col-sm-2 control-label">Password : <em>*</em></label>

                    <div class="col-sm-4">
                        <input type="password" class="form-control" name="password" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-12 ch">
                    <!---->
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>assets/images/placeholder-300x300.png"
                         alt="your image"/>
                    <div class="centered">Employee</div>

                    <input type="file" name="employee_image" size="20" id="inputFile"/>
                    <!---->
                    <!--=====================================-->
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('employee')">
                            <span class="title">Reset</span>
                        </a>
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <input type="submit"  class=" btn btn-success "  value="Submit">
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
                url: '<?php echo base_url()?>index.php/admin/add_employee',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('qualification'+msg);
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");

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



