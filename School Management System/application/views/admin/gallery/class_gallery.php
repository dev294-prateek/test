<h1 class="page-title"> Class Gallery </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('class_gallery')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
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
                    Add Gallery
                </div>
            </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/add_class_gallery',$data) ?>
            <br>
            <!--=====================================-->
            <div class="form-group">
                <label  class="col-sm-3 ">Class :</label>

                <div class="col-sm-9">
                    <select type="text" class="form-control" name="class_id" id="class_id" value="" onChange="getSection(value);">
                        <option>Select</option>
                        <?php foreach($class as $row){ ?>

                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-xs-3 ">Section :</label>
                <div class="col-sm-9">
                    <select id="section" class="form-control" name="section_id">
                    </select>
                </div>
            </div>
            <!--=====================================-->
            <!--=====================================-->
            <div class="form-group">
                <label class="col-xs-3">Teacher :</label>
                <div class="col-xs-9">
                    <select class="form-control" name="teacher_id"  required >
                        <option value="">Select</option>
                        <?php foreach($emp_teacher as $row){?>
                            <option value="<?php $x=$this->admin_model->teacher_by_employee_id($row['employee_id']); echo $x['teacher_id'];?>"><?php echo $row['name'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!--=====================================-->
            <div class="form-group">
            <label class="col-xs-3">Title :</label>
            <div class="col-xs-9">
                <input type="text" name="title" class="form-control" required>
            </div>
            </div>
            <div class="form-group">
            <label class="col-xs-3">Description :</label>
            <div class="col-xs-9">
                <?php $des="Created By ".$_SESSION['username']." sir.";  ?>
                <input type="text" name="description" class="form-control" value="<?php echo $des ; ?>" required>
            </div>
            </div>
            <div class="form-group">
            <label class="col-xs-12">Image :</label>

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
    <div class="col-sm-6">
        <div  id="det">
        </div>
        <div  id="det2">
        </div>
    </div>

</div>
</div>

<!--=====================================-->
<!--to form submit upload image-->
<script>
    $(document).ready(function(){
        $("#section").change(function(){
            var s_id=$(this).val();
            var c_id=$("#class_id").val();
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/period_class_detail',
                type:"POST",
                datatype:"json",
                data:{s_id:s_id,c_id:c_id},
                success: function (msg) {
                    $("#det2").html(msg);
                },
                error: function () { alert("fail");
                }
            })

        });
    });
</script>
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_class_gallery',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Added Successfully <div>");
                    loadview('class_gallery')
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
<script>
    function getSection(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/section_by_class_id/'+value,
            success: function(data){
                obj=JSON.parse(data);
                for (var i = 0; i <obj.length; i++) {
                    msg += '<option value="'+ obj[i].section_id +'">'+obj[i].name+'</option>';

                }

                $('#section').html(msg);
            },
            error: function(){

                alert("fail");
            },

        });
        /*----------------------*/
    }
</script>
<script>

        function chk_time() {
            var end = $('#end_time').val();
            var start = $('#start_time').val();
           if( start > end)
            {
             var end = $('#end_time').val("");
                $('#end_time').val('');
                alert('End time always greater then Start time');
            }
        }

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

