
<?php //print_r($class);?>
<h1 class="page-title" > Promotion </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('promotion')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<!--==================================-->
<div class="row">

    <div class="col-md-12" style="margin-bottom: 10px;">
        <!--=====================================-->
        <label class="col-xs-2">Sellect :</label>
        <div class="col-xs-3">
            <select class="form-control mtz-monthpicker-widgetcontainer" onchange="getinstal(value)" >
                <option>select</option>
                <option value=" ">All class</option>
                <?php foreach($class as $row){ ?>
                    <option value="<?php echo $row['class_id'];?>" <?php if($row['name']==$class_name)echo 'selected';?>><?php echo $row['name'];?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-xs-3" style="float: right">
            <span class="label label-sm btn-green" style="padding: 10px 20px"><?php echo $class_name;?></span>
        </div>

        <!--=====================================-->
    </div>

</div>
<br>
<?php //print_r($class) ?>
<!--==================================-->
<table id="example">
    <thead>
    <tr>
        <th style="width:40px !important;">ID</th>
        <th >Image</th>
        <th>Name</th>

<!--        <th>Class</th>-->
<!--        <th>Section</th>-->

        <th>Class</th>
        <th>Section</th>

        <th style="width:500px !important;">Action</th>
        <th style="width:500px !important;">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($students as $row){?>
        <tr >
            <td><?php echo $row['student_id'] ?></td>
            <td> <?php if($row['student_image']) {?>
                <img style="width:80px !important;"  class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['student_image'] ?>">
            <?php } ?>
            </td>
            <td><?php echo $row['student_name'] ?>
                <br> <span style="color: red"><?php $class1= $this->admin_model->class_by_id($row['class']); echo $class1['name'] ?> </span> -
            <span style="color: green"><?php $section1= $this->admin_model->section_by_id($row['section']); echo $section1['name']; ?></span>
           <td>
                <select id="class_<?php echo $row['student_id'] ?>"  type="text" class="form-control" name="class" value="" onChange="getSection(<?php echo $row['student_id'] ?>,value);" required>
                    <option>Select</option>
                    <?php foreach($class as $row1){ ?>

                        <option value="<?php echo $row1['class_id'];?>"><?php echo $row1['name'];?></option>

                    <?php }?>
                </select>
            </td>
            <td>
                <select id="section_<?php echo $row['student_id'] ?>" class="form-control" name="section" value="" required>
                </select>
            </td>
            <td>   <button  id="btn_<?php echo $row['student_id'] ?>" class="btn btn-success" onclick="Promote(<?php echo $row['student_id'] ?>,<?php echo $row['roll_no'] ?>)">Promote</button>

            </td>
            <td>   <button  id="del_<?php echo $row['student_id'] ?>" class="btn btn-red" onclick="deleteStudent(<?php echo $row['student_id'] ?>)">Delete</button>

            </td>
        </tr>
    <?php } ?>
    </tbody>

</table>


<script>


    function deleteStudent(id) {

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/delete_student',
            type:"POST",
            datatype:"json",
            data:{student_id:id},
            success: function (msg) {
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> "+msg+"  </span><div>");
                $('#del_'+id).hide();
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })



    }
</script>
<script>


    function Promote(id,roll_no) {
        var class_id = $('#class_'+id+ ' option:selected').val();
        var section_id = $('#section_'+id+ ' option:selected').val();
        // alert(id);
        // alert(class_id);
        // alert(section_id);

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/update_promotion',
            type:"POST",
            datatype:"json",
            data:{student_id:id,class:class_id,section:section_id,roll_no:roll_no},
            success: function (msg) {
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> "+msg+"  </span><div>");
                $('#btn_'+id).hide();
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })



    }
</script>

<script>
    function getinstal(x) {
        loadview('promotion/'+x);
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
    function getSection(id,value){
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

                $('#section_'+id).html(msg);
            },
            error: function(){

                alert("fail");
            },

        });
        /*----------------------*/
    }
</script>


