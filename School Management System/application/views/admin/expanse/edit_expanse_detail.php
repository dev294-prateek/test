<h1 class="page-title">Update Expenditure </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_expanse_detail/<?php echo $exp['id']?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($exp);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update Expenditure
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_expanse_detail',$data) ?>
                <br>

                <!--=====================================-->
                <label class="col-xs-12">Select :</label>

                <select class="form-control" name="exp_id" >
                   
                     <?php foreach($expanse as $exp1){ ?>
                      <option value="<?php echo $exp1['id'] ?>" <?php if ($exp['id']==$exp1['id']){echo 'selected';} ?>  > <?php echo $exp1['name'] ?></option>
                     <?php } ?>
                 </select>
                <label class="col-xs-12">Amount :</label>
                <input type="number" name="amt" class="form-control" value="<?php echo  $exp['amt']?>">
                <label class="col-xs-12">Bill No :</label>
                <input type="number" name="bill_no" class="form-control" value="<?php echo  $exp['bill_no']?>">
                <label class="col-xs-12">Use :</label>
                <input type="text" name="use" class="form-control" value="<?php echo  $exp['use']?>">
                <label class="col-xs-12">Material :</label>
                <input type="text" name="material" class="form-control" value="<?php echo  $exp['material']?>">
                <label class="col-xs-12">Payment Mode :</label>
                <select name="p_mode" class="form-control">
                    <option value="Cash" <?php if ($exp['p_mode']=="Cash"){echo 'selected';} ?> >Cash</option>
                    <option value="Cheque"  <?php if ($exp['p_mode']=="Cheque"){echo 'selected';} ?> >Cheque</option>
                </select>
                <label class="col-xs-12">Description :</label>
                <textarea style="width: 100%" rows="4" name="comment"><?php echo  $exp['comment']?></textarea>
                <div class="form-group">

                    <div class="col-xs-12">
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


<!--=====================================-->


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_expanse_detail',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  updateed successfully.</span><div>");
                    loadview('manage_expanse');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



