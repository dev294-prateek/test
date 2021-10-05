<h1 class="page-title"> Add Lesson Plan </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('add_lesson_plan/<?php echo $s_period['id'];?>')" ><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($s_period);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Lesson Plan
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_lesson_plan_data',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Class :</label>
                     <?php $class=$this->teacher_model->class_by_id($s_period['class_id']); ?>
                    <div class="col-xs-8">
                        <input type="hidden" class="form-control" name="class_id" id="class_id" value="<?php echo $s_period['class_id'];?>">
                        <input type="text" class="form-control" disabled value="<?php echo $class['name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Section :</label>
                    <?php $sec=$this->teacher_model->section_by_id($s_period['section_id']); //print_r($sec);?>
                <div class="col-xs-8">
                        <input type="hidden" id="section" class="form-control" name="section_id" value="<?php echo $s_period['section_id'];?>">
                        <input type="text" class="form-control" disabled value="<?php echo $sec['name'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <input type="hidden" class="form-control" name="teacher_id" value="<?php echo $s_period['teacher_id'];?>" >
                <div class="form-group">
                    <label class="col-xs-4">Time</label>
                    <?php $sec=$this->teacher_model->section_by_id($s_period['section_id']); //print_r($sec);?>
                    <div class="col-xs-8">
                        <?php $s= date('h:ia', strtotime($s_period['start_time'])). " - " .date('h:ia', strtotime($s_period['end_time'])) ?>
                        <input type="text" class="form-control" disabled value="<?php echo $s;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4">Subject :</label>
                    <div class="col-xs-8">
                        <?php $sub=$this->teacher_model->list_subjects_by_id($s_period['subject']);// print_r($sub);?>
                        <input type="hidden" class="form-control" name="subject_id"  required value="<?php echo $s_period['subject'];?>" >
                        <input type="text" class="form-control"  value="<?php echo $sub['name'];?>" disabled >

                         </div>
                </div>



                <label class="col-xs-12">Title :</label>
                <input type="text" name="title" class="form-control">
                <label class="col-xs-12">Time :</label>
                <input type="text" name="time" class="form-control">
                <label class="col-xs-12">Objectives :</label>
                <textarea style="width: 100%" rows="10" name="objective"></textarea>
                <label class="col-xs-12">Attachment :</label>
                <input style="width: 100%" type="file" name="attachment" size="20" id="inputFile"/>
                <div class="form-group">

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
                url: '<?php echo base_url()?>index.php/teacher/add_lesson_plan_data',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  alert(msg);
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



