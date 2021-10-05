
<h1 class="page-title"> Manage Event </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('manage_event/<?php echo($events['id']) ?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($events) ?><br>
<?php //print_r($all_event_teacher) ?>
<div class="guardian">
    <div class="col-sm-6">
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Teacher
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_event_teacher',$data) ?>
                <br>
                <input type="hidden" name="event_id" value="<?php echo($events['id']) ?>">
                <div class="form-group">
                    <label class="col-xs-4">Teacher :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="teacher_id" >
                            <option value="">Select</option>
                            <?php foreach($emp_teacher as $row){?>
                                <option value="<?php $x=$this->admin_model->teacher_by_employee_id($row['employee_id']); echo $x['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4">Role</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="role" >
                    </div>
                </div>


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
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!--===========================================================-->
        <table  class="table table-bordered">
            <thead>
            <tr><th style="width: 10%"> Id </th><th>Teacher</th><th>Role</th><th>Action</th></tr>
            </thead>
            <tbody>
            <?php foreach ( $all_event_teacher as $row) { ?>
                <tr>

                    <td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $row['id']?></td>
                    <td><?php $y = $this->admin_model->teacher_name($row['teacher_id']);print_r($y)?></td>
                    <td><?php echo $row['role']?></td>
                    <td> <span class="label label-sm btn-red" onclick="delete_event_teacher(<?php echo $row['id']; ?>)"><i class="entypo-star"></i> Delete</span>
                    </td>



                </tr>
            <?php }?>
            </tbody>
        </table>

    </div>
    <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
    <div class="col-sm-6">
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Student
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm2")?>
                <?php echo form_open_multipart('admin/add_event_student',$data) ?>
                <br>
                <input type="hidden" name="event_id" value="<?php echo($events['id']) ?>">
                <div class="form-group">
                    <label class="col-xs-4">Class :</label>
                    <div class="col-xs-8">
                        <select class="form-control" id="class_id" name="class_id" onchange="getSection(value)" >
                            <option>select</option>
                            <?php foreach($all_class as $row){ ?>
                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4">Section:</label>
                    <div class="col-xs-8">
                        <select id="section" class="form-control" name="section_id"  onchange="getStudents(value)">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4">Student:</label>
                    <div class="col-xs-8">
                        <select id="students" class="form-control" name="student_id">
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4">Role</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="role" >
                    </div>
                </div>


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

        <!--===========================================================-->
        <table  class="table table-bordered">
            <thead>
            <tr><th style="width: 10%"> Id </th><th>Student</th><th>Role</th><th>Class & Section</th><th>Action</th></tr>
            </thead>
            <tbody>
            <?php foreach ( $all_event_student as $row) { ?>
                <tr>

                    <td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $row['id']?></td>
                    <?php $stu= $this->admin_model->student_name($row['student_id']); ?>
                    <td><?php echo $stu ?></td>
                    <td><?php echo $row['role']?></td>

                   <?php $class= $this->admin_model->class_by_id($row['class_id']); ?>
                    <?php $section= $this->admin_model->section_by_id($row['section_id']);  ?>
                    <td> <span class="label label-sm btn-red"><?php echo $class['name'] ; ?> </span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="label label-sm btn-green"><?php echo $section['name']; ?> </span></td>

                    <td> <span class="label label-sm btn-red" onclick="delete_event_student(<?php echo $row['id']; ?>)"><i class="entypo-star"></i> Delete</span>
                    </td>



                </tr>
            <?php }?>
            </tbody>
        </table>

    </div>
    <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

</div>
</div>

<!--=====================================-->
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
        /*----------------------*/
    }
    function getStudents(s_id) {
        var c_id= $('#class_id').val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/list_student_by_class_section_id',
            type:"POST",
            datatype:"json",
            data:{c_id:c_id,s_id:s_id},
            success: function (msg) {
                $('#students').html(msg);
            },
            error: function () { alert("fail");
            }
        })
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<script>
    function delete_event_teacher(id){
        if(confirm('Are you sure?')) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/delete_event_teacher',
                data: {id: id},
                success: function (msg) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Deleted Successfully <div>");
                    loadview('manage_event/<?php echo($events['id']) ?>');
                },
                error: function () {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        }
    }
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_event_teacher',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Allotted Successfully <div>");
                    loadview('manage_event/<?php echo($events['id']) ?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>
<script>
    function delete_event_student(id){
        if(confirm('Are you sure?')) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/delete_event_student',
                data: {id: id},
                success: function (msg) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Deleted Successfully <div>");
                    loadview('manage_event/<?php echo($events['id']) ?>');
                },
                error: function () {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        }
    }
    $(document).ready(function(e){

        $("#fupForm2").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_event_student',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                   $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Allotted Successfully <div>");
                    loadview('manage_event/<?php echo($events['id']) ?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>




