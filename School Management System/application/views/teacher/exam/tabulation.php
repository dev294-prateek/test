<h1 class="page-title"> Tabulation </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('tabulation')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php // print_r($exam);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Tabulation
                </div>
            </div>

            <div class="panel-body">
                <br>
                 <!--=====================================-->

                <div class="form-group">
                    <label for="field-1" class="col-xs-4 control-label">Exam :</label>
                    <div class="col-xs-8">
                        <select id="exam" class="form-control" name="exam_id" onchange="go(value)">
                            <?php         echo "<option >select</option>";
                            foreach ($exam as $row){
                                $x=$this->admin_model->exam_by_id($row['exam_id']);
                                echo "<option value='" . $row['exam_id'] . "'>" . $x['name'] . "</option>";
                            } ?>

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

<script>
    function go(exam_id){
        var cl_id= <?php echo $_SESSION['class_id'] ?>;
        var sec_id=<?php echo $_SESSION['section_id'] ?>;;
        var view='tabulation_marks/'+exam_id+'/'+cl_id+'/'+sec_id;
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/generate_tabulation_marks',
            type:"POST",
            datatype:"json",
            data:{exam_id:exam_id,class_id:cl_id,section_id:sec_id},
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




