
<h1 class="page-title"> Update driver </h1>



<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_driver/<?php echo $driver["id"]; ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php // print_r($driver);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                   Update driver

                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_driver',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="id" required  value="<?php echo $driver['id']; ?>">

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" required  value="<?php echo $driver['name']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Father Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="father" required value="<?php echo $driver['father']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Gender :</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="gender" >
                            <option value="male" <?php if($driver['gender']=='male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if($driver['gender']=='female') echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Aadhar No :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="addhar_no" required value="<?php echo $driver['addhar_no']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Votar Card No</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="votar_card_no" required value="<?php echo $driver['votar_card_no']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Driving Licence No </label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="licence_no" required value="<?php echo $driver['licence_no']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">DL Expire Date  :</label>
                    <div class="col-xs-6">
                        <input type="date" class="form-control" name="exp_date" required value="<?php echo $driver['exp_date']; ?>">
                    </div>
                </div>
                <div class="col-sm-12 ch">
                    <div id="img-message" class="alert alert-danger fade in alert-dismissible">
                        <a class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Alert!</strong> The image will be cropped by 300 x 300 automatically.
                    </div>
                    <img id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $driver['image']; ?>"
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
                url: '<?php echo base_url()?>index.php/admin/update_driver',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                   
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'>driver Updated successfully. </span><div>");
                     loadview('all_driver/<?php echo $driver["id"]; ?>');
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


