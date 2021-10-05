<h1 class="page-title">Request For Approval </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('approv_req_lesson_plan/<?php echo $lesson_plan['id'];?>')" ><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($lesson_plan);?>

<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Request For Approval
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('teacher/update_lesson_plan_data',$data) ?>
                <br>
                <!--=====================================-->
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $lesson_plan['id'];?>">
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Class :</label>
                    <?php $class=$this->guardian_model->class_by_id($lesson_plan['class_id']); ?>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" disabled value="<?php echo $class['name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Section :</label>
                    <?php $sec=$this->guardian_model->section_by_id($lesson_plan['section_id']); //print_r($sec);?>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" disabled value="<?php echo $sec['name'];?>">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Subject :</label>
                    <div class="col-xs-8">
                        <?php $sub=$this->guardian_model->list_subjects_by_id($lesson_plan['subject_id']);// print_r($sub);?>
                        <input type="text" class="form-control"  value="<?php echo $sub['name'];?>" disabled >
                    </div>
                </div>



                <label class="col-xs-12">Title :</label>
                <input type="text" class="form-control" value="<?php echo $lesson_plan['title']; ?>" disabled>
                <input type="hidden" name="approv_request_date" value="<?php echo date('Y-m-d'); ?>">

                <label class="col-xs-12">Request :</label>
                <textarea style="width: 100%" rows="10" name="approv_request"> <?php echo $lesson_plan['approv_request']; ?></textarea>

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

<!--=====================================-->
<!--to form submit upload image-->
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
    function getSection(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/teacher/section_by_class_id/'+value,
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
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/teacher/update_lesson_plan_data',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Updated successfully.</span><div>");
                    loadview('approv_req_lesson_plan/<?php echo $lesson_plan['id'];?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");
                    loadview('edit_lesson_plan/<?php echo $lesson_plan['id'];?>');
                },

            });
        });
    });
</script>



