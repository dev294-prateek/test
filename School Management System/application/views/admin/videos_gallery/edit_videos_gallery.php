<h1 class="page-title">Video Gallery </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_videos_gallery/<?php echo $gallery['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->

<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Gallery
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_videos_gallery',$data) ?>
                <br>
                <input type="hidden" name="id"  value="<?php echo $gallery['id'];?>">
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-3">Title :</label>
                    <div class="col-xs-9">
                        <input type="text" name="title" class="form-control" required value="<?php echo $gallery['title'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-3">Url :</label>
                    <div class="col-xs-9">
                        <input type="url" name="url" class="form-control" required value="<?php echo $gallery['url'];?>">
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
    <div class="col-sm-6">
        <div  id="det">
        </div>
        <div  id="det2">
        </div>
    </div>

</div>
</div>

<!--=====================================-->

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_videos_gallery',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                    loadview('edit_videos_gallery/<?php echo $gallery['id'];?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



