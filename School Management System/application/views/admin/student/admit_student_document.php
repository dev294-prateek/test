

<h1 class="page-title"> Upload Student Document</h1>
<!--=====================================-->

<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Upload Student Document
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/birth_certificate',$data) ?>
                <br>
                <input type="hidden" value="1" name="id">

                <div class="col-sm-4 centered-ch">
                    <img id="image_upload_preview" src="<?php echo base_url() ?>assets/images/placeholder-300x300.png"
                         alt="your image"/>
                    <div class="centered">Birth Certificate</div>

                    <input type="file" name="student_image" size="20" id="inputFile"/>
                    <input type="submit"  class=" btn btn-success "  value="Upload">
                </div>
                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div><!--=====================================-->
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

<!--dismis message after 4 second-->
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
</script>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/admit_student_certificate',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                 alert(msg);
                },
                error: function(){

                },

            });
        });
    });
</script>




