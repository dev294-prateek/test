
<h1 class="page-title"> Update Vehicle </h1>



<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_vehicle/<?php echo $vehicle["id"]; ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
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
                   Update Vehicle

                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_vehicle',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="id" required  value="<?php echo $vehicle['id']; ?>">

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Vehicle No :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="vehicle_no" required  value="<?php echo $vehicle['vehicle_no']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Nick Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="nick_name" required value="<?php echo $vehicle['nick_name']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Vehicle Type :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="type" required value="<?php echo $vehicle['type']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Make :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="make" required value="<?php echo $vehicle['make']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Year :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="make" required value="<?php echo $vehicle['make']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Registration No :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="registration_no" required value="<?php echo $vehicle['registration_no']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Seating Capacity :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="seating_capacity" required value="<?php echo $vehicle['seating_capacity']; ?>">
                    </div>
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
                url: '<?php echo base_url()?>index.php/admin/update_vehicle',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'>Vehicle Updated successfully. </span><div>");
                    loadview('all_vehicle');
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


