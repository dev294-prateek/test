<h1 class="page-title"> Update Class Work </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_class_work/<?php echo $class_work['id'];?>')" ><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($class_work);?>
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
                <?php echo form_open_multipart('teacher/update_class_work_data',$data) ?>
                <br>
                <!--=====================================-->
                <input type="text" class="form-control" name="id" id="id" value="<?php echo $class_work['id'];?>">
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Class :</label>
                     <?php $class=$this->teacher_model->class_by_id($class_work['class_id']); ?>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" disabled value="<?php echo $class['name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Section :</label>
                    <?php $sec=$this->teacher_model->section_by_id($class_work['section_id']); //print_r($sec);?>
                <div class="col-xs-8">
                        <input type="text" class="form-control" disabled value="<?php echo $sec['name'];?>">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Subject :</label>
                    <div class="col-xs-8">
                        <?php $sub=$this->teacher_model->list_subjects_by_id($class_work['subject_id']);// print_r($sub);?>
                        <input type="text" class="form-control"  value="<?php echo $sub['name'];?>" disabled >
                        </div>
                </div>

                <label class="col-xs-12">Title :</label>
                <input type="text" name="title" class="form-control" value="<?php echo $class_work['title'];?>">
                <label class="col-xs-12">Description :</label>
                <textarea style="width: 100%" rows="10" name="description">
                    <?php echo $class_work['description'];?>
                </textarea>
                <label class="col-xs-12">Attachment :</label>

                <img style="width:100%" id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $class_work['attachment'];?>"
                     alt="your image"/>

                <input type="file" name="attachment" size="20" id="inputFile"/>
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
                url: '<?php echo base_url()?>index.php/teacher/update_class_work_data',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Updated successfully.</span><div>");
                    loadview('edit_class_work/<?php echo $class_work['id'];?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");
                    loadview('edit_class_work/<?php echo $class_work['id'];?>');
                },

            });
        });
    });
</script>



