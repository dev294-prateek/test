<h1 class="page-title">Update Class Gallery </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_class_gallery/<?php echo $gallery["id"] ?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($gallery);?>
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
            <?php echo form_open_multipart('admin/update_class_gallery',$data) ?>
            <br>
            <!--=====================================-->
            <input type="hidden" class="form-control" name="id" value="<?php echo $gallery['id'] ?>" >
            <!--=====================================-->
            <div class="form-group">
            <label class="col-xs-3">Title :</label>
            <div class="col-xs-9">
                <input type="text" name="title" class="form-control" value="<?php echo $gallery['title'] ?>" required >
            </div>
            </div>
            <div class="form-group">
            <label class="col-xs-3">Description :</label>
            <div class="col-xs-9">

                <input type="text" name="description" class="form-control" value="<?php echo $gallery['description'] ?>" required>
            </div>
            </div>
            <div class="form-group">
            <label class="col-xs-12">Image :</label>

            <img style="width:100%" id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $gallery['image'] ?>"
                 alt="your image"/>
            </div>
             <p></p>
            <div class="form-group">
                <label class="col-xs-3">Title :</label>
                <div class="col-xs-9">
                    <select name="status" class="form-control" >
                        <option value="1" <?php if($gallery['status']==1){ echo 'selected'; }?>>Active</option>
                        <option value="0" <?php if($gallery['status']==0){ echo 'selected'; }?>>In Active</option>
                    </select>
                </div>
            </div>
            <input type="file" name="image" size="20" id="inputFile"/>
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


</div>
</div>

<!--=====================================-->
<!--to form submit upload image-->



<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<!--to preview image-->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
</script>
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_class_gallery',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  alert(msg);
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                    loadview('edit_class_gallery/<?php echo $gallery["id"] ?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>


