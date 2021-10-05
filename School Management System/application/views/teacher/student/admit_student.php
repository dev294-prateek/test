<h1 class="page-title"> Admit Student </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('student')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>

<!--=====================================-->

<div class="guardian">
    <div class="col-md-12">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Admit Student
                </div>
            </div>
<?php //print_r($guardains); ?>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/admit_student',$data) ?>
                <br>
                <div class="form-group">
                    <label class="col-sm-2">Admission No. : </label>
                    <div class="col-sm-4">
                            <input type="number"  name="admission_no" class="form-control">
                    </div>
                    <label class="col-sm-2">Roll No. : </label>
                    <div class="col-sm-4">
                        <input type="number" name="roll_no" class="form-control">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Name:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="student_name" value="">
                    </div>
                    <label for="field-1" class="col-sm-2 control-label">Aadhaar No: </label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="aadhaar_no" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Gender :</label>
                    <div class="col-sm-4">

                        <select class="form-control" name="gender" >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <label class="col-sm-2">Birthday :</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="birthday" value="">
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Class :</label>

                    <div class="col-sm-4">
                        <select type="text" class="form-control" name="class" value="" onChange="getSection(value);">
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>

                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <label for="field-1" class="col-sm-2 control-label">Section :</label>
                    <div class="col-sm-4">
                        <select id="section" class="form-control" name="section" value="">
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Nationality :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nationality">
                            <?php foreach($nationality as $row){?>
                                <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <label for="field-1" class="col-sm-2 control-label">Religion : </label>

                    <div class="col-sm-4">
                        <select  class="form-control" name="Religion">
                            <option value="">Select</option>
                            <option value="Hinduism">Hinduism</option>
                            <option value="Islam">Islam</option>
                            <option value="Christianity">Christianity</option>
                            <option value="Buddhism">Buddhism</option>
                            <option value="Sikhism">Sikhism</option>
                        </select>
                    </div>


                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Guardian: </label>
                    <div class="col-sm-4">
                        <select type="text" class="form-control" name="guardian" value="" >
                            <option>Select</option>
                            <?php foreach($guardains as $row){ ?>

                                <option value="<?php echo $row['guardian_id'];?>">( Id : <?php echo $row['guardian_id'];?>) <?php echo $row['guardian_name'];?> </option>
                            <?php }?>
                        </select>
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Relation To Guardian: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="relation_to_guardian" value="">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Morher Name : </label>
                    <div class="col-sm-4">
                        <input type="text" name="mother" class="form-control">
                    </div>
                    <label class="col-sm-2">Father Name : </label>
                    <div class="col-sm-4">
                        <input type="text" name="father" class="form-control">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                       <label for="field-1" class="col-sm-2 control-label">SC/ST : </label>
                        <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="SC">SC</label></div>
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="ST">ST</label></div>
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="OBC">OBC</label></div>
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="General" checked>General</label> </div>
                        </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Language Known :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                    <div class="col-sm-3"><input class="form-control" type="text" name="language1" value="Hindi" ></div>
                    <div class="col-sm-3"><input class="form-control" type="text" name="language2" value="English" ></div>
                    <div class="col-sm-3"><input class="form-control"  type="text" name="language3" placeholder="Other" ></div>
                    <div class="col-sm-3"><input class="form-control" type="text" name="language4" placeholder="Other" ></div>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Residential Address :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                    <div class="col-sm-3"><input class="form-control" type="text" name="resident_address1" ></div>
                    <div class="col-sm-3"><input class="form-control" type="text" name="resident_address2" ></div>
                    <div class="col-sm-3"><input class="form-control" type="text" name="resident_address3" ></div>
                    <div class="col-sm-1"><label >Pin No :</label></div>
                    <div class="col-sm-2"><input class="form-control" type="number" name="resident_address_pin" ></div>
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Correspondence Address :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-3"><input class="form-control" type="text" name="correspond_address1" ></div>
                        <div class="col-sm-3"><input class="form-control" type="text" name="correspond_address2" ></div>
                        <div class="col-sm-3"><input class="form-control" type="text" name="correspond_address3" ></div>
                        <div class="col-sm-1"><label >Pin No :</label></div>
                        <div class="col-sm-2"><input class="form-control" type="number" name="correspond_address_pin" ></div>
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Distance from school (in kms) : </label>
                    <div class="col-sm-4">
                        <input type="number" name="distance_from_school" class="form-control">
                    </div>

                    <label class="col-sm-2">Preferred Phone no. for School SMS : </label>
                    <div class="col-sm-4">
                        <input type="number" name="mobile_no_for_sms" class="form-control">
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group" style="height: 80px">
                    <label class="col-sm-2">Scholastic Activities : </label>
                    <div class="col-sm-4">
                        <!-------------------------->
                        <select name="scholastic_activities" class="form-control select2 select2-offscreen visible" tabindex="-1">
                            <option value="">Select</option>
                            <option value="Drawing">Drawing</option>
                            <option value="Craft">Craft</option>
                            <option value="P.T">P.T</option>
                            <option value="G.K">G.K</option>
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>
                            <option value="Computer">Computer</option>
                            <option value="S.ST">S.ST</option>
                            <option value="Science">Science</option>
                            <option value="Moral Science">Moral Science</option>
                            <option value="E.V.S">E.V.S</option>
                            <option value="Physics">Physics</option>
                            <option value="Biology">Biology</option>
                            <option value="Maths">Maths</option>
                            <option value="Economics">Economics</option>
                            <option value="Business Study">Business Study</option>
                            <option value="Accountancy">Accountancy</option>
                            <option value="Physical Education">Physical Education</option>
                            <option value="Chemistry">Chemistry</option>
                        </select>
                        <!-------------------------->
                    </div>

                    <label class="col-sm-2">Co-Scholastic Activities (hobbies) : </label>
                    <div class="col-sm-4">
                       <!---------------------------->
                        <select multiple="" name="coscholastic_activities[]" class="form-control">

                            <option value="Drawing/Craftwork">Drawing/Craftwork</option>
                            <option value="G.K. Competition">G.K. Competition</option>
                            <option value="Speach">Speach</option>
                            <option value="Story Telling">Story Telling</option>
                            <option value="Ty-kwando">Ty-kwando</option>
                            <option value="Scating">Scating</option>
                            <option value="Badminton">Badminton</option>
                            <option value="Hand ball">Hand ball</option>
                            <option value="Table Tennis">Table Tennis</option>
                            <option value="Carrom">Carrom</option>
                            <option value="Chess">Chess</option>
                            <option value="Cricket">Cricket</option>
                            <option value="Vollyball">Vollyball</option>
                            <option value="Football">Football</option>
                            <option value="Picnic">Picnic</option>
                            <option value="Educational Tour">Educational Tour</option>
                            <option value="Singing">Singing</option>
                            <option value="Dancing">Dancing</option>
                            <option value="Rakhi Making">Rakhi Making</option>
                            <option value="Rangoli Competition">Rangoli Competition</option>
                            <option value="Mahendi">Mahendi</option>
                            <option value="Salad Making">Salad Making</option>
                            <option value="Kho-Kho">Kho-Kho</option>
                            <option value="Writing Competition">Writing Competition</option>
                            <option value="Antakshri">Antakshri</option>
                            <option value="Diya and Candle making">Diya and Candle making</option>
                            <option value="Movie">Movie</option>
                            <option value="Eleqution">Eleqution</option>
                            <option value="Debate">Debate</option>
                            <option value="College Making">College Making</option>
                        </select>
                       <!---------------------------->
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Emergency Contact I :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-4"><input class="form-control" type="text" name="emergency_contact_name_1" placeholder="Name" ></div>
                        <div class="col-sm-4"><input class="form-control" type="number" name="emergency_contact_mobile_1" placeholder="Mobile No"  pattern="^\d{10}" required ></div>
                        <div class="col-sm-4"><input class="form-control" type="text" name="emergency_contact_relation_1" placeholder="Relationship"></div>
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Emergency Contact II :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-4"><input class="form-control" type="text" name="emergency_contact_name_2" placeholder="Name" ></div>
                        <div class="col-sm-4"><input class="form-control" type="number" name="emergency_contact_mobile_2" placeholder="Mobile No"  pattern="^\d{10}" required ></div>
                        <div class="col-sm-4"><input class="form-control" type="text" name="emergency_contact_relation_2" placeholder="Relationship"></div>
                    </div>

                </div>
                <!--=====================================-->

                <div class="col-sm-12 ch">
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>assets/images/placeholder-300x300.png"
                         alt="your image"/>
                    <div class="centered">Student</div>

                    <input type="file" name="student_image" size="20" id="inputFile"/>

                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('all_student')">
                            <span class="title">Back</span>
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
<!--get section value-->
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
    function getSection(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/teacher/section_by_class_id/'+value,
            success: function(data){
                obj=JSON.parse(data);
                for (var i = 0; i <obj.length; i++) {
                    msg += '<option value="'+ obj[i].section_id +'">'+obj[i].name+'</option>';

                }

                $('#section').html(msg);
            },
            error: function(){

                alert("fail");
            },

        });
        /*----------------------*/
    }
</script>

<!--submit form-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/teacher/admit_student',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('birth_certificate/'+msg);
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Added successfully. </span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



