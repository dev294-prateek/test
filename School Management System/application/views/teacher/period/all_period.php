<h1 class="page-title"> <?php echo $title; ?></h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_period')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
<table id="example"  >
    <thead>
    <tr><th style="width: 20px"> Id </th><th style="width: 30px">Class</th><th style="width: 30px">Section</th><th>Period</th><th>Day Range</th><th>Time</th><th style="width: 80px" >Subject</th><th style="width: 80px">Teacher</th><th style="width: 80px">Status</th><th style="width: 80px">Action</th></tr>
    </thead>
    <tbody>
    <?php foreach ( $all_period as $row) { ?>
        <?php
        $class=$this->teacher_model->class_by_id($row['class_id']); $class=$class['name'];
        $period=$this->teacher_model->list_period_by_id($row['name']); $period=$period['name'];
        $section=$this->teacher_model->section_by_id($row['section_id']); $section=$section['name'];
        $subject=$this->teacher_model->list_subjects_by_id($row['subject']); $subject=$subject['name'];
        $teacher=$this->teacher_model->teacher_name($row['teacher_id']);
        ?>
        <tr>
            <td style="width: 20px" ><?php echo $row['id']?></td>
            <td style="width: 30px"><?php echo $class; ?></td>
            <td style="width: 30px"><?php echo $section ?></td>
            <td><?php echo $period; ?></td>
            <td><?php echo $row['day']; ?></td>
            <td><?php echo date('h:ia', strtotime($row['start_time'])). " - " .date('h:ia', strtotime($row['end_time'])) ?></td>
            <td style="width: 80px"><?php echo $subject; ?></td>
            <td style="width: 80px"><?php echo $teacher;?></td>
            <td style="width: 80px"><?php if($row['status']==1){ ?>
                    <span class="label label-sm btn-green" onclick="change_status(<?php echo $row["id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star-empty"></i> Active</span>
                <?php }else{ ?>
                    <span class="label label-sm btn-red" onclick="change_status(<?php echo $row["id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star"></i> Inactive</span>
                <?php } ?>
            </td>

            <td style="width:80px">
                <!---->
                <div class="btn-group">
                    <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">

                        <li><a onclick="loadview('add_lesson_plan/<?php echo $row["id"]?>')"><i class="entypo-plus-squared"></i>Add Lesson Plan</a></li>
                        <li><a onclick="loadview('add_class_work/<?php echo $row["id"]?>')"><i class="entypo-plus-squared"></i>Add Class Work</a></li>
                        <li><a onclick="loadview('add_home_work/<?php echo $row["id"]?>')"><i class="entypo-plus-squared"></i>Add Home Work</a></li>
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
<script>
    function getdata() {
       var cl = $("#class").val();
       var sec = $("#section").val();
       loadview('all_period/'+cl+'/'+sec);

    }
</script>
<!--to form submit upload image-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}

        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/change_period_status',
            type:"POST",
            datatype:"json",
            data:{id:id,status:status},
            success: function (msg) {
                /*  alert(msg)*/
                if(msg==1) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
                }else{
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable Update . </span><div>");
                }
                loadview('all_period');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })



    }
</script>
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
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


