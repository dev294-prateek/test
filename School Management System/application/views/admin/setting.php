<h1 class="page-title"> Setting </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('setting')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($setting);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    New Exam
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_setting',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">School Name :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="school_name"  value="<?php echo $setting['school_name'] ?>" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Address :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="address"  value="<?php echo $setting['address'] ?>" required >
                    </div>
                </div>


                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Running Year</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="running_year"  >
                            <option value="<?php echo $setting['running_year'] ; ?>"><?php echo $setting['running_year'] ; ?></option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Logo :</label>
                    <div class="col-xs-8">
                        <input type="file" class="form-control" name="logo" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Background :</label>
                    <div class="col-xs-8">
                        <input type="file" class="form-control" name="background" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success"  value="Submit" id="submit">
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
<!--to form submit upload image-->

<script>

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_setting',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                },
                error: function(){

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



