<div class="row">
    <div class="col-sm-4 col-xs-8">
        <div id="message">

            <div>
                <h3 id="subsmsg" style="text-align: center;color: red"></h3>
            </div>

        </div>


        <div class="tile-stats tile-red">
            <!---->
            <?php $data = array('id' => 'submit') ?>
            <?php echo form_open_multipart('admin', $data); ?>
            <img id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $_SESSION['profile_image']; ?>" alt="your image"/>

            <input type="file" name="userfile" size="20" id="inputFile"/>

            <br/><br/>

            <button class="btn btn-red" id="btn_upload" type="submit">Upload</button>

            </form>
            <!---->
        </div>

    </div>

    <div class="col-sm-4 col-xs-8">

        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">0</div>

            <h3>Subscribers</h3>
            <p>on our site right now.</p>
        </div>

    </div>
</div>

<br/>
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
<!--to upload image-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#submit').submit(function (e) {
            e.preventDefault();
              $.ajax({
                url: '<?php echo base_url();?>admin/upload_profile_image',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    $('#subsmsg').html("Upload Image Successful.");

                }
            });
        });


    });

</script>



