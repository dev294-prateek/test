<h1 class="page-title"> Update Fee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_fee/<?php echo $fee['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($fee);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                   Update fee
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_fee',$data) ?>
                <br>
                <input type="hidden" name="id"  required value="<?php echo $fee['id'];?>">
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-3">Name :</label>
                    <div class="col-xs-9">
                        <input type="text" name="name" class="form-control" required value="<?php echo $fee['name'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-3">Comment :</label>
                    <div class="col-xs-9">
                        <input type="text" name="comment" class="form-control" required value="<?php echo $fee['comment'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3">Type :</label>
                    <div class="col-xs-9">
                        <select name="type" class="form-control" required>
                            <?php foreach($fee_type as $row){ ?>
                                <option value="<?php echo $row['id'];?>" <?php if( $row['id']==$fee['type']){echo 'selected';} ?>> <?php echo $row['name'];?></option>
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
                url: '<?php echo base_url()?>index.php/admin/update_fee',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                    loadview('fee')
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



