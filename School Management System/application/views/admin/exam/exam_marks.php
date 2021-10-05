<h1 class="page-title"> Exam Marks </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('exam_marks')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
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
                    Exam Marks
                </div>
            </div>

            <div class="panel-body">
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
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Section :</label>
                    <div class="col-xs-8">
                        <select id="section" class="form-control" name="section_id" onChange="getSsubject(value)";>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Subject :</label>
                    <div class="col-xs-8">
                        <select id="subject" class="form-control" name="subject_id" onChange="getExam()">
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Exam :</label>
                    <div class="col-xs-8">
                        <select id="exam" class="form-control" name="exam_id" onchange="getpaper(value)">

                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Paper :</label>
                    <div class="col-xs-8">
                        <select  class="form-control" name="paper_id" id="paper_id" onchange="go(value)">
                        </select>
                    </div>
                </div>
            <!--=====================================-->

        </div>

        <!--end panal body-->
    </div>
</div>
</div>
<!--=====================================-->

<!--=====================================-->
<!--=====================================-->
<script>
    function getpaper(exam_id) {
        var cl_id=$('#class_id').val();
        var sec_id=$('#section').val();
        var sub_id=$('#subject').val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/getpaper',
            type:"POST",
            datatype:"json",
            data:{exam_id:exam_id,cl_id:cl_id,sec_id:sec_id,sub_id:sub_id},
            success: function (msg) {
                $('#paper_id').html(msg);
            },
            error: function () {
                alert("fail");
            }
        })
    }
</script>
<script>
    function go(paper_id){
        var cl_id=$('#class_id').val();
        var sec_id=$('#section').val();
        var sub_id=$('#subject').val();
        var exam_id = $('#exam').val();
        var view='paper_marks/'+exam_id+'/'+cl_id+'/'+sec_id+'/'+sub_id+'/'+paper_id;
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/generate_exam_marks',
            type:"POST",
            datatype:"json",
            data:{exam_id:exam_id,class_id:cl_id,section_id:sec_id,subject_id:sub_id,paper_id:paper_id},
            success: function (msg) {
                loadview(view);
            },
            error: function () {
                alert("fail");
            }
        })
    }
</script>

<!--list Exam-->
<script>
    function getExam(){
    var cl_id=$('#class_id').val();
    var sec_id=$('#section').val();
        /*----------------------*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/list_exam',
            type:"POST",
            datatype:"json",
            data:{class_id:cl_id,section_id:sec_id},
            success: function (msg) {
                $('#exam').html(msg);
            },
            error: function () { alert("fail");
            }
        })
    }
</script>
<!--list subject-->
<script>
    function getSsubject(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/list_section_subject/'+value,
            success: function(msg){

                $('#subject').html(msg);
            },
            error: function(){ alert("fail"); },
        });
    }
</script>

<!--list section-->
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
            error: function(){ alert("fail"); },
        });
    }
</script>




