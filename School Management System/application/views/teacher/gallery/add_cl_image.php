<h1 class="page-title"> Add Image </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('cl_image/<?php echo $gallery["id"]; ?>')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($_SESSION);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo $gallery["title"]; ?>
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('teacher/add_class_gal',$data) ?>
                <br>
                <!--=====================================-->
                <input type="hidden" class="form-control" name="id" value="<?php echo $gallery["id"]; ?>" >

                <div class="form-group">

                    <img style="width:100%" id="image_upload_preview" src="<?php echo base_url() ?>assets/images/placeholder-300x300.png"
                         alt="your image"/>
                </div>
                <p></p>
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
    <div class="col-sm-12">
        <?php foreach($all_gallery as $row){ ?>
        <div class="col-sm-4" >
            <img src="<?php echo base_url(); ?>/uploads/<?php echo $row['image'] ?>" class="img-thumbnail">
            <button  id='del' class="btn btn-red" onclick="del(<?php echo $row['id'] ?>)">Delete</button>
        </div>
         <?php } ?>
    </div>

</div>
</div>

<!--=====================================-->
<!--to form submit upload image-->
<script>
    function del(id){
     /*   alert(id);*/
     var x=   confirm("Are You Sure  ?");
     if(x==true){
         $.ajax({
             url: '<?php echo base_url()?>index.php/teacher/delete_class_image',
             type:"POST",
             datatype:"json",
             data:{id:id},
             success: function (msg) {
                 $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Deleted Successfully <div>");
                 loadview('cl_image/<?php echo $gallery["id"]; ?>')
             },
             error: function () { alert("fail");
             }
         })
     }else{
     }

    }
</script>

<script>

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/teacher/add_class_gal',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Allotted Successfully <div>");
                    loadview('cl_image/<?php echo $gallery["id"]; ?>')
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
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

