<style>
    h5.head_text {
        background-color: darkgoldenrod;
        color: white;
        padding: 7px 15px;
        text-align: center;
    }
</style>
<h1 class="page-title" > Route Location </h1>
<?php //print_r($route); ?>

<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('route_location/<?php echo $route["id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<div class="col-sm-10 col-sm-offset-1">
    <h5 class="head_text"><?php print_r($route['name']); ?></h5>
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Add  Route Location
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/add_route_location',$data) ?>
            <br>
            <input type="hidden" class="form-control" name="route_id"  value="<?php echo $route["id"];?>" >
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Name :</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name="name" required >
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Longitude :</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name="longitude" required >
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Latitude :</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" name="latitude" required >
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-6">Order No In Route :</label>
                <div class="col-xs-6">
                    <input type="number" class="form-control" name="order_no" required >
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

<div class="col-sm-10 col-sm-offset-1">
    <table id="example">
        <thead>
        <tr><th >S.N.</th><th  >Name</th><th  >Longitude</th><th  >Latitude</th><th  >Order No In Route </th><th>Action</th></tr>
        </thead>
        <tbody>

        <?php $sn=1;foreach ($route_location as $row){?>
            <tr>
                <td  style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['longitude']; ?></td>
                <td><?php echo $row['latitude']; ?></td>
                <td><?php echo $row['order_no']; ?></td>
                <td style="text-align: center">
                    <a class="btn btn-success" onClick="loadview('edit_route_location/<?php echo $row['id']; ?>')" ><i class="entypo-pencil"></i>  <span class="hidden-xs">Edit</span></a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>

</div>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_route_location',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    /*  alert(msg);*/
                    loadview('route_location/<?php echo $route['id'];?>');
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Added successfully. </span><div>");

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




