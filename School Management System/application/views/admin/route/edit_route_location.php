
<h1 class="page-title" >Update Route Location </h1>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('edit_route_location/<?php echo $route_location["id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<?php //print_r($route_location);?>
<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Edit  Route
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/update_route_location',$data) ?>
            <br>
            <input type="hidden" class="form-control" name="id"  value="<?php echo $route_location["id"];?>" >
            <input type="hidden" class="form-control" name="route_id"  value="<?php echo $route_location["route_id"];?>" >
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Name :</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name="name" required value="<?php echo $route_location["name"];?>" >
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Longitude :</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name="longitude" required value="<?php echo $route_location["longitude"];?>"  >
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Latitude :</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name="latitude" required value="<?php echo $route_location["latitude"];?>">
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Order No In Route :</label>
                <div class="col-xs-6">
                    <input type="number" class="form-control" name="order_no" required  value="<?php echo $route_location["order_no"];?>" >
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group" style="border: none">
                <label class="col-xs-6"></label>
                <div class="col-xs-6">
                    <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
                </div>
            </div>

            <!--=====================================-->


            <?php echo form_close() ?>
        </div>

    </div>
    <!---->
</div>

</div>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_route_location',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('route_location/<?php echo $route_location["route_id"];?>');
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Updated successfully. </span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

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




