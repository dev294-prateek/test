
<h1 class="page-title"> All Class </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_class')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_class);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2" style="display: none">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                   Add Class
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_class',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                </div>
<!--                <div class="form-group">
                    <label class="col-xs-6">Class Teacher :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="teacher_id" value="">
                    </div>
                </div>-->
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
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
<div class="col-sm-8 col-sm-offset-2" style="overflow-x:auto;">
<table id="example"  >
    <thead>
    <tr><th style="width: 10%"> Id </th><th>Class Name</th><!--<td>Class Teacher</td>--><th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
    <?php foreach ( $all_class as $row) { ?>
        <tr>
            <td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $row['class_id']?></td>
            <td><?php echo $row['name']?></td>
           <!-- <td><?php /*echo $row['teacher_id']*/?></td>-->
            <td><?php if($row['status']==1){ ?>
                    <span class="label label-sm btn-green" onclick="loadview('edit_class/<?php echo $row['class_id']; ?>')"><i class="entypo-star-empty"></i> Active</span>
                <?php }else{ ?>
                    <span class="label label-sm btn-red" onclick="loadview('edit_class/<?php echo $row['class_id']; ?>')"><i class="entypo-star"></i> Inactive</span>
                <?php } ?>
            </td>

            <td><a class="gold-bt" onclick="loadview('edit_class/<?php echo $row['class_id']; ?>')"><i class="entypo-pencil"></i>  Edit</a></td>

        </tr>
    <?php }?>
    </tbody>
</table>
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
                url: '<?php echo base_url()?>index.php/admin/add_class',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    if(msg) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> One record inserted successfully. </span><div>");

                    }else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable to insert record . </span><div>");

                    }
                    loadview('all_class');
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


