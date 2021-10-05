
<h1 class="page-title" > Route </h1>
<?php //print_r($student_sub_list); ?>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('route')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Add  Route
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/add_route',$data) ?>
            <br>

            <div class="form-group">
                <div class="col-xs-5">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="col-xs-5">
                    <input type="text" class="form-control" name="url" placeholder="Map Custom Route url ">
                </div>
                <div class="col-xs-2">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>


            <?php echo form_close() ?>
        </div>

    </div>
    <!---->
</div>
<?php // print_r($all_route) ?>
<div class="col-sm-12">
    <table id="example">
        <thead>
        <tr><th  >map</th><th  >Name</th><th  >Vehicle</th><th  >Driver</th><th>Helper</th><th>Action</th></tr>
        </thead>
        <tbody>

        <?php $sn=1;foreach ($all_route as $row){?>
            <tr>
                <td ><iframe src="<?php echo $row['url']; ?>" width="200" height="100"></iframe></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php $v=$this->admin_model->vehicle_by_id($row['vechiles_id']); print_r($v['nick_name']) ; ?></td>
                <td><?php $d=$this->admin_model->driver_by_id($row['driver_id']);print_r($d['name']) ?></td>
                <td><?php $h=$this->admin_model->driver_by_id($row['helper_id']);print_r($h['name']) ?></td>
                <td style="text-align: center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a   onclick="loadview('edit_route/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                            <li><a   onclick="loadview('route_location/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>Add Location </a> </li>
                            <li><a   onclick="loadview('manage_route/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>Manage </a> </li>
                            <li><a   onclick="loadview('manage_route_students/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>SMS To Students </a> </li>
                            <li><a   onclick="loadview('manage_route_students_all/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>SMS To All </a> </li>
                        </ul>
                    </div>
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
                url: '<?php echo base_url()?>index.php/admin/add_route',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    /*  alert(msg);*/
                    loadview('route');
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




