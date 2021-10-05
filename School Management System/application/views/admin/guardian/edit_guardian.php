

<h1 class="page-title">Update Guardian </h1>
<!--=====================================-->
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_guardian/<?php echo $guardian["guardian_id"] ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--
<a class="gold-bt"  <?php /*if($guardian["guardian_id"]<2); echo 'style="visibility: hidden"'; */?>  onclick="loadview('edit_guardian/<?php /*echo $guardian["guardian_id"]-1 */?>')"><i class="entypo-reply"></i>Prev</a>

<a class="gold-bt float-r" onclick="loadview('edit_guardian/<?php /*echo $guardian["guardian_id"]+1 */?>')">Next<i class="entypo-forward"></i></a>
<hr>-->
<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update Guardian
                </div>
            </div>

<?php // print_r($guardian);?>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_guardian',$data) ?>
                <input type="hidden" class="form-control" name="guardian_id" value="<?php echo $guardian['guardian_id'] ?>">
                <br>
                <div class="form-group">
                    <label class="col-sm-6">Father/Mother/Guardian :</label>
                    <div class="col-sm-6">
                        <label class="radio-inline ch"><input type="radio" name="guardian_type" value="father" <?php if($guardian['guardian_type']=="father") echo "checked" ?>>Father</label>
                        <label class="radio-inline ch"><input type="radio" name="guardian_type" value="guardian" <?php if($guardian['guardian_type']=="guardian") echo "checked" ?>>Guardian</label>
                        <label class="radio-inline ch"><input type="radio" name="guardian_type"  value="mother" <?php if($guardian['guardian_type']=="mother") echo "checked" ?>>Mother</label>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="guardian_name" value="<?php echo $guardian['guardian_name'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Age:</label>
                    <div class="col-sm-4">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "3" class="form-control" name="guardian_age" value="<?php echo $guardian['guardian_age'];?>">
                    </div>
                    <label class="col-sm-2">Nationality :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nationality">
                            <?php foreach($nationality as $row){?>
                                <option value="<?php echo $row['name'];?>" <?php if($guardian['nationality']==$row['name']) echo 'selected'?>  ><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>


                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Qualification: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_qualifications" value="<?php echo $guardian['guardian_qualifications'];?>">
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Institute: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_instituion" value="<?php echo $guardian['guardian_instituion'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Occupation: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_occupation" value="<?php echo $guardian['guardian_occupation'];?>">
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Designation: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_designation" value="<?php echo $guardian['guardian_designation'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Annual Income: </label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="guardian_annual_income" value="<?php echo $guardian['guardian_annual_income'];?>">
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Mobile No : </label>

                    <div class="col-sm-4">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" class="form-control" name="guardian_mobile"  required  value="<?php echo $guardian['guardian_mobile'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Aadhaar No: </label>
                    <div class="col-sm-10">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12" class="form-control" name="aadhaar_no" value="<?php echo $guardian['aadhaar_no'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Office Address: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="guardian_office_address" value="<?php echo $guardian['guardian_office_address'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Home Address: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="guardian_home_address" value="<?php echo $guardian['guardian_home_address'];?>">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Email : <em>*</em></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="email" data-validate="required"
                               data-message-required="Value Required" value="<?php echo $guardian['email'];?>">
                    </div>

                    <label for="field-2" class="col-sm-2 control-label">Password : <em>*</em></label>

                    <div class="col-sm-4">
                        <input type="password" class="form-control" name="password" data-validate="required"
                               data-message-required="Value Required" value="<?php echo $guardian['password'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-12 ch">
                    <!---->
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $guardian['guardian_image'];?>"
                         alt="your image"/>


                    <input type="file" name="guardian_image" size="20" id="inputFile"/>
                    <!---->
                    <!--=====================================-->
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('all_guardian')">
                            <span class="title">&nbsp;&nbsp;Back&nbsp;&nbsp;</span>
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
                url: '<?php echo base_url()?>index.php/admin/update_guardian',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Updated successfully</span><div>");
                    loadview('edit_guardian/<?php echo $guardian["guardian_id"] ?>');
                },
                error: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong  <span style='color: red'> Try again </span><div>");

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



