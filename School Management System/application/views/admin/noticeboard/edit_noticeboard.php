<h1 class="page-title"> Noticeboard </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_noticeboard/<?php echo  $notice["id"]; ?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($notice);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Class Work
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_noticeboard',$data) ?>
                <br>
                <!--=====================================-->
                <input type="hidden" name="id" value="<?php echo  $notice['id'];  ?>">
                <label class="col-xs-12">Title :</label>
                <input type="text" name="title" class="form-control" value="<?php echo  $notice['title']; ?>">
                <label class="col-xs-12">Description :</label>
                <textarea style="width: 100%" rows="10" name="notice"><?php echo  $notice['notice']; ?></textarea>
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
                url: '<?php echo base_url()?>index.php/admin/update_noticeboard',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Updated successfully.</span><div>");
                    loadview('noticeboard');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



