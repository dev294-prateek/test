<h1 class="page-title"> Add Home Work </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('add_home_work')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Home Work
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_home_work_data',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Class :</label>

                    <div class="col-xs-8">
                        <select type="text" class="form-control" name="class_id" id="class_id" value="" onChange="getSection(value);">
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>

                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Section :</label>
                    <div class="col-xs-8">
                        <select id="section" class="form-control" name="section_id">
                        </select>
                    </div>
                </div>
                <!--=====================================-->


                <div class="form-group">
                    <label class="col-xs-4">Teacher :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="teacher_id"  required >
                            <option value="">Select</option>
                            <?php foreach($emp_teacher as $row){?>
                                <option value="<?php $x=$this->admin_model->teacher_by_employee_id($row['employee_id']); echo $x['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4">Subject :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="subject_id"  required >
                            <?php foreach($subject as $row){?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>



                <label class="col-xs-12">Title :</label>
                <input type="text" name="title" class="form-control">
                <label class="col-xs-12">Description :</label>
                <textarea style="width: 100%" rows="10" name="description"></textarea>
                <label class="col-xs-12">Attachment :</label>

                <img style="width:100%" id="image_upload_preview" src="<?php echo base_url() ?>assets/images/placeholder-300x300.png"
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
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_home_work_data',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('add_home_work');
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



