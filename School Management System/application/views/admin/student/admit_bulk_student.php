<style>
    th{width: 16%!important;}
</style>
<h1 class="page-title"> Admit Bulk Student </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('bulk_student')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<!--=====================================-->
<div class="guardian">
    <div class="col-md-12">
<!--==================================================================================================-->
        <?php $data = array('id'=>"fupForm")?>
        <?php echo form_open_multipart('admin/admit_bulk_student',$data) ?>
        <table class="table">
            <thead>
            <tr><th>Name</th><th>Admission No</th><th>Roll No</th><th>Class</th><th>Section</th><th>Guardian</th><th>Action</th></tr>
            </thead>
            <tbody><tr>
                <td> <input type="text" class="form-control" name="student_name" required></td>
                <td><input type="number"  name="admission_no" class="form-control"></td>
                <td><input type="number"  name="roll_no" class="form-control"></td>
                <td>
                    <select type="text" class="form-control" name="class" value="" onChange="getSection(value);" required>
                        <option>Select</option>
                        <?php foreach($class as $row){ ?>

                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <select id="section" class="form-control" name="section" value="" required>
                    </select>
                </td>
                <td>
                    <select type="text" class="form-control" name="guardian" value="" required>
                        <option>Select</option>
                        <?php foreach($guardains as $row){ ?>

                            <option value="<?php echo $row['guardian_id'];?>">( Id : <?php echo $row['guardian_id'];?>) <?php echo $row['guardian_name'];?> </option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <input type="submit"  class=" btn btn-success "  value="Submit">
                </td>
            </tr>
            <?php  foreach($students as $row){ ?>
                <tr>
                    <td><?php echo $row['student_name'] ?></td>
                    <td><?php echo  $row['admission_no'];?></td>
                    <td><?php echo  $row['roll_no'];?></td>
                    <td><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?></td>
                    <td><?php $section= $this->admin_model->section_by_id($row['section']); echo $section['name']; ?></td>
                    <td><?php $guardian= $this->admin_model->list_guardian_by_id($row['guardian']); echo $guardian['guardian_name']; ?></td>

                    <td>
                       <a class="btn btn-success"   onclick="loadview('edit_student/<?php echo $row["student_id"];?>')"><i class="entypo-pencil"></i>  Edit </a>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php echo form_close() ?>
<!--==================================================================================================-->

    </div>
</div><!--=====================================-->

<!--get section value-->
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
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

<!--submit form-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/admit_bulk_student',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Added successfully. </span><div>");
                    loadview('bulk_student')
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



