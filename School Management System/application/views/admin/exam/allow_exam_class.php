<h1 class="page-title"> Allow Class  </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('allow_exam_class/<?php echo $exam['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_exam);?>
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
                <?php echo form_open_multipart('admin/add_allow_exam_class',$data) ?>
                <br>
                <input type="hidden" name="exam_id" value="<?php echo $exam['id'];?>">
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Class :</label>

                    <div class="col-sm-8">
                        <select type="text" class="form-control" name="class_id" id="class_id" value="" onChange="getSection(value);">
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>

                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Section :</label>
                    <div class="col-sm-8">
                        <select id="section" class="form-control" name="section_id">
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
<div class="col-sm-12" style="overflow-x:auto;">
    <table id="example"  >
        <thead>
        <tr><th style="width: 20px"> Id </th><th>Exam</th><th style="width: 30px">Class</th><th style="width: 30px">Section</th><th style="width: 80px">Status</th><th style="width: 80px">Action</th></tr>
        </thead>
        <tbody>
        <?php $sn=1;foreach ( $all_exam as $row) { ?>
            <?php
            $class=$this->admin_model->class_by_id($row['class_id']); $class=$class['name'];
            $section=$this->admin_model->section_by_id($row['section_id']); $section=$section['name'];
            $exam=$this->admin_model->list_all_exam_by_id($row['exam_id']); /*$exam=$exam['name'];*/
            ?>
            <tr>
                <td style="width: 20px" ><?php echo $sn++;?></td>
                <td style="width: 20px" ><?php echo($exam['name']);?></td>
                <td style="width: 30px"><?php echo $class; ?></td>
                <td style="width: 30px"><?php echo $section; ?></td>
                <td style="width: 80px"><?php if($row['status']==1){ ?>
                        <span class="label label-sm btn-green" onclick="change_status(<?php echo $row["id"] ?>,0)"><i class="entypo-star-empty"></i> Active</span>
                    <?php }else{ ?>
                        <span class="label label-sm btn-red" onclick="change_status(<?php echo $row["id"] ?>,1)"><i class="entypo-star"></i> Inactive</span>
                    <?php } ?>
                </td>
                <td>
                    <!---->
                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a onclick="loadview('edit_exam_class/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                            <li><a onclick="loadview('subject_marks/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i>Subject Marks</a></li>
                            <li><a onclick="loadview('syllabus_study/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i>Syllabus & Study Material</a></li>
                            <li><a onclick="loadview('exam_time_table/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i>Time Table</a></li>
                        </ul>
                    </div>
                    <!---->
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--=====================================-->
</div>

<!--=====================================-->
<script>
    function change_status(id,status) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/update_allow_exam_class',
            type:"POST",
            datatype:"json",
            data:{id:id,status:status},
            success: function (msg) {
                if(msg==1) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
                }else{
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable Update . </span><div>");
                }
                loadview('allow_exam_class/<?php echo $exam['id'];?>');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }
</script>

<script>

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_allow_exam_class',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added  Successfully <div>");
                    loadview('allow_exam_class/<?php echo $exam['id'];?>')
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

