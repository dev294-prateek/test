<h1 class="page-title">Fee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('fee')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($all);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add fee
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_fee',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-3">Name :</label>
                    <div class="col-xs-9">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-3">Comment :</label>
                    <div class="col-xs-9">
                        <input type="text" name="comment" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3">Type :</label>
                    <div class="col-xs-9">
                        <select name="type" class="form-control" required>
                            <?php foreach($fee_type as $row){ ?>
                                <option value="<?php echo $row['id'];?>"> <?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
                    </div>
                </div>
            </div>
            <!--=====================================-->
            <?php echo form_close() ?>
        </div>

        <!--end panal body-->
    </div>
    <!--=====================================-->
    <div class="col-sm-12" style="overflow-x:auto;">
        <table id="example"  >
            <thead>
            <tr><th style="width: 20px"> Id </th><th style="width: 30px">Name</th><th style="width: 30px">Comment</th><th style="width: 30px">Type</th><th style="width: 80px">Action</th></tr>
            </thead>
            <tbody>
            <?php foreach ( $all as $row) { ?>
                <tr>
                    <td style="width: 20px" ><?php echo $row['id']?></td>
                    <td style="width: 20px" ><?php echo $row['name']?></td>
                    <td style="width: 20px" ><?php echo $row['comment']?></td>
                    <?php $type=$this->admin_model->fee_type_name($row['type']) ?>
                    <td style="width: 20px" ><?php echo $type; ?></td>
                    <td style="width:80px">
                        <!--====================================-->
                        <div class="btn-group">
                            <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a onclick="loadview('edit_fee/<?php echo $row['id']; ?>')"><i class="entypo-plus-squared"></i>Edit</a></li>
                            </ul>
                        </div>

                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <!--=====================================-->

</div>
</div>

<!--=====================================-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>;

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_fee',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Added Successfully <div>");
                    loadview('fee')
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



