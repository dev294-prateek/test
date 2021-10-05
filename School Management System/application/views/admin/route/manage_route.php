<style>
    .chhhh {
        margin-bottom: 10px;
    }
</style>
<h1 class="page-title" >Manage Route </h1>
<?php //print_r($student_sub_list); ?>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('manage_route/<?php echo $route['id'];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title" style="text-align: center">
                <i class="entypo-plus-circled"></i>
                <?php echo $route['name'];?>
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/update_route_histry',$data) ?>
            <br>
            <input type="hidden" class="form-control" name="id" value="<?php echo $route['id'];?>">
            <div class="col-xs-3 chhhh">Vehicle</div><div class="col-xs-3 chhhh">Driver</div><div class="col-xs-6 chhhh">Helper</div>

            <div class="col-xs-3 ">
                <select class="form-control" name="vechiles_id" >
                    <?php foreach($vehicle as $row){ ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['nick_name'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-3">
                <select class="form-control" name="driver_id" >
                    <?php foreach($driver as $row){ ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-3">
                <select class="form-control" name="helper_id">
                    <?php foreach($helper as $row){ ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-3">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>

            <?php echo form_close() ?>
        </div>

    </div>
    <!---->
    <div class="col-sm-12">
        <table id="example">
            <thead>
            <tr><th  style="width: 10%">Id</th><th  >Route</th><th  >Start Date</th><th  >End Date</th><th  >Vehicle</th><th  >Driver</th><th>Helper</th></tr>
            </thead>
            <tbody>

            <?php $sn=1;foreach ($history as $row){?>
                <tr>

                    <td style="width: 10%"><?php echo $row['id']; ?></td>

                    <td><?php $r=$this->admin_model->route_by_id($row['route_id']); print_r($r['name'] ) ; ?></td>
                    <td style="width: 10%"><?php echo date("d-m-Y", strtotime($row['date_from'])); ?> </td>
                    <td style="width: 10%"><?php echo date("d-m-Y", strtotime($row['date_to'])); ?> </td>

                    <td><?php $v=$this->admin_model->vehicle_by_id($row['vechiles_id']); print_r($v['nick_name']) ; ?></td>
                    <td><?php $d=$this->admin_model->driver_by_id($row['driver_id']);print_r($d['name']) ?></td>
                    <td><?php $h=$this->admin_model->driver_by_id($row['helper_id']);print_r($h['name']) ?></td>

                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

</div>

</div>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_route_histry',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    /*  alert(msg);*/
                    loadview('manage_route/<?php echo $route["id"];?>');
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




