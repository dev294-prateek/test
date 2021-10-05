<h1 class="page-title">Update Allowed Class  </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_exam_class/<?php echo $allowed_class['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($allowed_class);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">

        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Allow Section
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_allow_exam_class',$data) ?>
                <br>
                <input type="hidden" name="id" value="<?php echo $allowed_class['id'];?>">
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Class :</label>

                    <div class="col-sm-8">
                        <select type="text" class="form-control" name="class_id" id="class_id" value="" onChange="getSection(value);">
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>
                                <option value="<?php echo $row['class_id'];?>" <?php if($row['class_id']==$allowed_class['class_id']){echo "selected";} ?>><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Section :</label>
                    <div class="col-sm-8">
                        <select id="section" class="form-control" name="section_id">
                            <?php $section= $this->admin_model->section_by_id($allowed_class['section_id']); ?>
                            <option value=" <?php echo $section['section_id']; ?>" > <?php echo $section['name']; ?></option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success"  value="Submit" id="submit">
                    </div>
                </div>
            </div>
            <!--=====================================-->

            <?php echo form_close() ?>
        </div>

        <!--end panal body-->
    </div>

</div>
<!--=====================================-->

</div>

<!--=====================================-->


<script>

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_allow_exam_class',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added  Successfully <div>");
                    loadview('allow_exam_class/<?php echo $allowed_class['exam_id'];?>')
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

