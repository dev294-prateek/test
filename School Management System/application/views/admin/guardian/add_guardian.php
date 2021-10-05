
<h1 class="page-title"> Add Guardian </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('guardian')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->

<div class="guardian">
    <div class="col-md-12">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Guardian
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_guardian',$data) ?>
                <br>
                <div class="form-group">
                    <label class="col-sm-6">Father/Mother/Guardian :</label>
                    <div class="col-sm-6">
                        <label class="radio-inline ch"><input type="radio" name="guardian_type" value="father" checked>Father</label>
                        <label class="radio-inline ch"><input type="radio" name="guardian_type" value="guardian">Guardian</label>
                        <label class="radio-inline ch"><input type="radio" name="guardian_type"  value="mother">Mother</label>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="guardian_name" value="">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-sm-2">Age:</label>
                    <div class="col-sm-4">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "3" class="form-control" name="guardian_age" value="">
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
                    <label for="field-1" class="col-sm-2 control-label">Qualification: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_qualifications" value="">
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Institute: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_instituion" value="">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Occupation: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_occupation" value="">
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Designation: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="guardian_designation" value="">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Annual Income: </label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="guardian_annual_income" value="">
                    </div>

                    <label for="field-1" class="col-sm-2 control-label">Mobile No : </label>

                    <div class="col-sm-4">
                        <span id="message"></span>
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" class="form-control" name="guardian_mobile" required  >

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Aadhaar No: </label>
                    <div class="col-sm-10">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12" class="form-control" name="aadhaar_no" pattern="^\d{12}">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Office Address: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="guardian_office_address" value="">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Home Address: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="guardian_home_address" value="">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Email : <em>*</em></label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="email" data-validate="required"
                               data-message-required="Value Required" value="" onblur="chkexist(this.value)">
                    </div>

                    <label for="field-2" class="col-sm-2 control-label">Password : <em>*</em></label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="password" data-validate="required"
                               data-message-required="Value Required" value="">
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
                    <div class="centered">Guardian</div>

                    <input type="file" name="guardian_image" size="20" id="inputFile"/>
                    <!---->
                    <!--=====================================-->
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('guardian')">
                            <span class="title">Reset</span>
                        </a>
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <input type="submit" id="submit" class=" btn btn-success "  value="Submit">
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
    function chkexist(value) {
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/chk_guardian_email_exist',
            data: {email:value},
            success: function(msg){
               if(msg==1) {
                   $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Email Already Exist. </span><div>");
               }
               else{
                   $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> ok </span><div>");

               }
            },
            error: function(){
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            },

        });
    }
</script>
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
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_guardian',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> One record inserted successfully. </span><div>");
                    loadview('guardian');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



