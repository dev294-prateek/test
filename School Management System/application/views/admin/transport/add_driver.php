
<h1 class="page-title"> Add driver </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('driver')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_class);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add driver

                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_driver',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Father Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="father" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Gender :</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="gender" >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Aadhar No :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="addhar_no" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Votar Card No</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="votar_card_no" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Driving Licence No </label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="licence_no" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">DL Expire Date  :</label>
                    <div class="col-xs-6">
                        <input type="date" class="form-control" name="exp_date" required >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-6">Type  :</label>
                        <select  class="form-control" name="type">
                            <option value="driver">Driver</option>
							<option value="helper">Helper</option>
                        </select>
                </div>
                <div class="col-sm-12 ch">
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>assets/images/placeholder-300x300.png"
                         alt="your image"/>
                    <div class="centered">Driver</div>

                    <input type="file" name="image" size="20" id="inputFile"/>

                </div>

                <!--=====================================-->
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success"  value="Submit" id="submit">
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
<!--to form submit upload image-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_driver',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'>driver added successfully. </span><div>");
                    loadview('driver');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
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

