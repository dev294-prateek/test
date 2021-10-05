
<h1 class="page-title"> Update Student </h1>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('edit_student/<?php echo $student["student_id"];?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<a class="gold-bt" style="visibility:hidden">Prev</a>
<a class="gold-bt float-r"  onclick="loadview('birth_certificate/<?php echo $student["student_id"];?>')">Next</a>
<hr>
<!--=====================================-->
<?php // print_r($student); ?>
<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update Student
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_student',$data) ?>
                <input value="<?php echo $student['student_id'] ?>" type="hidden" name="student_id" >
                <br>
                <div class="form-group">
                    <label class="col-sm-2">Admission No. : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['admission_no'] ?>" type="number" name="admission_no" class="form-control">
                    </div>
                    <label class="col-sm-2">Roll No. : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['roll_no'] ?>" type="number" name="roll_no" class="form-control">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Name:</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['student_name'] ?>" type="text" class="form-control" name="student_name">
                    </div>
                    <label for="field-1" class="col-sm-2 control-label">Aadhaar No: </label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="aadhaar_no" value="<?php echo $student['aadhaar_no'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Gender :</label>
                    <div class="col-sm-4">

                        <select class="form-control" name="gender" >
                            <option value="male" <?php if($student['gender']=='male') echo 'selected'?>>Male</option>
                            <option value="female" <?php if($student['gender']=='female') echo 'selected'?>>Female</option>
                        </select>
                    </div>
                    <label class="col-sm-2">Birthday :</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['birthday'] ?>" type="date" class="form-control" name="birthday">
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Class :</label>

                    <div class="col-sm-4">
                        <select type="text" class="form-control"  name="class" onChange="getSection(value);">
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>

                                <option value="<?php echo $row['class_id'];?>" <?php if($student['class']==$row['class_id']){ echo 'selected'; } ?>><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <label for="field-1" class="col-sm-2 control-label">Section :</label>
                    <div class="col-sm-4">
                        <select id="section" class="form-control" name="section">
                            <?php $section= $this->guardian_model->section_by_id($student['section']); echo $section['name']; ?>
                            <option value=" <?php echo $section['section_id']; ?>" > <?php echo $section['name']; ?></option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Nationality :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nationality">
                            <?php foreach($nationality as $row){?>
                                <option value="<?php echo $row['name'];?>" <?php if($student['nationality']==$row['name']) echo 'selected'?>  ><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <label for="field-1" class="col-sm-2 control-label">Religion : </label>

                    <div class="col-sm-4">
                        <select  class="form-control" name="Religion">
                            <option value="" >Select</option>
                            <option value="Hinduism"  <?php if($student['Religion']=='Hinduism') echo 'selected'?> >Hinduism</option>
                            <option value="Islam" <?php if($student['Religion']=='Islam') echo 'selected'?> >Islam</option>
                            <option value="Christianity" <?php if($student['Religion']=='Christianity') echo 'selected'?> >Christianity</option>
                            <option value="Buddhism" <?php if($student['Religion']=='Buddhism') echo 'selected'?> >Buddhism</option>
                            <option value="Sikhism" <?php if($student['Religion']=='Sikhism') echo 'selected'?> >Sikhism</option>
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

                                <option value="<?php echo $row['guardian_id'];?>" <?php if($student['guardian']==$row['guardian_id']) echo 'selected'?>>( Id : <?php echo $row['guardian_id'];?>) <?php echo $row['guardian_name'];?> </option>
                            <?php }?>
                        </select>
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Relation To Guardian: </label>

                    <div class="col-sm-4">
                        <input value="<?php echo $student['relation_to_guardian'] ?>" type="text" class="form-control" name="relation_to_guardian" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Morher Name : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['mother'] ?>" type="text" name="mother" class="form-control">
                    </div>
                    <label class="col-sm-2">Father Name : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['father'] ?>" type="text" name="father" class="form-control">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">SC/ST : </label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="SC"  <?php if($student['sc_st']=="SC") echo 'checked'?> >SC</label></div>
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="ST" <?php if($student['sc_st']=="ST") echo 'checked'?>>ST</label></div>
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="OBC" <?php if($student['sc_st']=="OBC") echo 'checked'?>>OBC</label></div>
                        <div class="col-sm-3"><label class="radio-inline "><input type="radio" name="sc_st" value="General" <?php if($student['sc_st']=="General") echo 'checked'?>>General</label> </div>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Language Known :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-3"><input value="<?php echo $student['language1'] ?>" class="form-control" type="text" name="language1" ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['language2'] ?>" class="form-control" type="text" name="language2"  ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['language3'] ?>" class="form-control"  type="text" name="language3"  ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['language4'] ?>" class="form-control" type="text" name="language4"  ></div>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Residential Address :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-3"><input value="<?php echo $student['resident_address1'] ?>" class="form-control" type="text" name="resident_address1" ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['resident_address2'] ?>" class="form-control" type="text" name="resident_address2" ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['resident_address3'] ?>" class="form-control" type="text" name="resident_address3" ></div>
                        <div class="col-sm-1"><label >Pin No :</label></div>
                        <div class="col-sm-2"><input value="<?php echo $student['resident_address_pin'] ?>" class="form-control" type="number" name="resident_address_pin" ></div>
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Correspondence Address :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-3"><input value="<?php echo $student['correspond_address1'] ?>" class="form-control" type="text" name="correspond_address1" ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['correspond_address2'] ?>" class="form-control" type="text" name="correspond_address2" ></div>
                        <div class="col-sm-3"><input value="<?php echo $student['correspond_address3'] ?>" class="form-control" type="text" name="correspond_address3" ></div>
                        <div class="col-sm-1"><label >Pin No :</label></div>
                        <div class="col-sm-2"><input value="<?php echo $student['correspond_address_pin'] ?>" class="form-control" type="number" name="correspond_address_pin" ></div>
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Distance from school (in kms) : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['distance_from_school'] ?>" type="number" name="distance_from_school" class="form-control">
                    </div>

                    <label class="col-sm-2">Preferred Phone no. for School SMS : </label>
                    <div class="col-sm-4">
                        <input value="<?php echo $student['mobile_no_for_sms'] ?>" type="number" name="mobile_no_for_sms" class="form-control">
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group" style="height: 80px">
                    <label class="col-sm-2">Scholastic Activities : </label>
                    <div class="col-sm-4">
                        <!-------------------------->
                        <select name="scholastic_activities" class="form-control select2 select2-offscreen visible" tabindex="-1">
                            <option value="Drawing"  <?php if($student['scholastic_activities']=='Drawing') echo 'selected'?> >Drawing</option>
                            <option value="Craft" <?php if($student['scholastic_activities']=='Craft') echo 'selected'?>>Craft</option>
                            <option value="P.T" <?php if($student['scholastic_activities']=='P.T') echo 'selected'?>>P.T</option>
                            <option value="G.K" <?php if($student['scholastic_activities']=='G.K') echo 'selected'?>>G.K</option>
                            <option value="Hindi" <?php if($student['scholastic_activities']=='Hindi') echo 'selected'?>>Hindi</option>
                            <option value="English" <?php if($student['scholastic_activities']=='English') echo 'selected'?>>English</option>
                            <option value="Computer" <?php if($student['scholastic_activities']=='Computer') echo 'selected'?>>Computer</option>
                            <option value="S.ST"> <?php if($student['scholastic_activities']=='S.ST') echo 'selected'?>S.ST</option>
                            <option value="Science" <?php if($student['scholastic_activities']=='Science') echo 'selected'?>>Science</option>
                            <option value="Moral Science" <?php if($student['scholastic_activities']=='Moral Science') echo 'selected'?>>Moral Science</option>
                            <option value="E.V.S" <?php if($student['scholastic_activities']=='E.V.S') echo 'selected'?>>E.V.S</option>
                            <option value="Physics" <?php if($student['scholastic_activities']=='Physics') echo 'selected'?>>Physics</option>
                            <option value="Biology" <?php if($student['scholastic_activities']=='Biology') echo 'selected'?>>Biology</option>
                            <option value="Maths" <?php if($student['scholastic_activities']=='Maths') echo 'selected'?>>Maths</option>
                            <option value="Economics" <?php if($student['scholastic_activities']=='Economics') echo 'selected'?>>Economics</option>
                            <option value="Business Study" <?php if($student['scholastic_activities']=='Business Study') echo 'selected'?>>Business Study</option>
                            <option value="Accountancy" <?php if($student['scholastic_activities']=='Accountancy') echo 'selected'?>>Accountancy</option>
                            <option value="Physical Education" <?php if($student['scholastic_activities']=='Physical Education') echo 'selected'?>>Physical Education</option>
                            <option value="Chemistry" <?php if($student['scholastic_activities']=='Chemistry') echo 'selected'?>>Chemistry</option>
                        </select>
                        <!-------------------------->
                    </div>

                    <label class="col-sm-2">Co-Scholastic Activities (hobbies) : </label>
                    <div class="col-sm-4">
                        <!---------------------------->
                        <select multiple="" name="coscholastic_activities[]" class="form-control">
                            <?php $x= json_decode($student['coscholastic_activities']); $length=count($x);
                            for($i=0; $i<$length;$i++){
                                echo $x[$i];
                                echo '<option value="'.$x[$i].'" selected>'.$x[$i].'</option>';
                            }

                            ?>

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
                        <div class="col-sm-4"><input value="<?php echo $student['emergency_contact_name_1'] ?>" class="form-control" type="text" name="emergency_contact_name_1" placeholder="Name" ></div>
                        <div class="col-sm-4"><input value="<?php echo $student['emergency_contact_mobile_1'] ?>" class="form-control" type="number" name="emergency_contact_mobile_1" placeholder="Mobile No"  pattern="^\d{10}" required ></div>
                        <div class="col-sm-4"><input value="<?php echo $student['emergency_contact_relation_1'] ?>" class="form-control" type="text" name="emergency_contact_relation_1" placeholder="Relationship"></div>
                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Emergency Contact II :</label>
                    <div class="col-sm-10" style="padding-left: 0px;">
                        <div class="col-sm-4"><input value="<?php echo $student['emergency_contact_name_2'] ?>" class="form-control" type="text" name="emergency_contact_name_2" placeholder="Name" ></div>
                        <div class="col-sm-4"><input value="<?php echo $student['emergency_contact_mobile_2'] ?>" class="form-control" type="number" name="emergency_contact_mobile_2" placeholder="Mobile No"  pattern="^\d{10}" required ></div>
                        <div class="col-sm-4"><input value="<?php echo $student['emergency_contact_relation_2'] ?>" class="form-control" type="text" name="emergency_contact_relation_2" placeholder="Relationship"></div>
                    </div>

                </div>
                <!--=====================================-->

                <div class="col-sm-12 ch">
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a  class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $student['student_image'] ?>"
                         alt="your image"/>
                    <div class="centered">Student</div>

                    <input  type="file" name="student_image" size="20" id="inputFile"/>

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
                url: '<?php echo base_url()?>index.php/teacher/update_student',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    /*loadview('birth_certificate/'+ msg);*/
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>  Updated successfully.</span><div>");
                    loadview('edit_student/<?php echo $student["student_id"];?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



