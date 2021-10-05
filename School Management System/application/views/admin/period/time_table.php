<h1 class="page-title"> Time Table </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('time_table')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
    <div class="col-md-12" style="margin-bottom: 10px; border: 1px solid white;">
        <!--=====================================-->
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Class :</label>
        <div class="col-sm-3 col-xs-8" style="margin-bottom: 10px">
            <select class="form-control" id="class" onChange="getSection(value);">
                <?php foreach($class as $row){ ?>
                    <option value="<?php echo $row['class_id'];?>" <?php if($cl==$row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                <?php }?>
            </select>
        </div>
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Section :</label>
        <div class="col-sm-3 col-xs-8" style="margin-bottom: 10px">
            <select id="section" class="form-control"  onchange="getdata()">
                <option value="<?php echo $sec;?>"><?php $x=$this->admin_model->section_by_id($sec); echo $x['name'];?></option>
            </select>
        </div>
        <!--=====================================-->
    </div>

<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
<table class="table table-bordered"  >
    <thead>
    <tr><td id="edate" colspan="7" style="text-align: center;background-color: palegoldenrod;color: darkgoldenrod;">Class : <?php $z=$this->admin_model->class_by_id($cl); print_r($z['name']); ?> Section : <?php $x=$this->admin_model->section_by_id($sec); echo $x['name'];?></td></tr>
    <tr><th style="width: 20px"> Id </th><th>Period</th><th>Day Range</th><th>Time</th><th style="width: 80px" >Subject</th><th style="width: 80px">Teacher</th><th style="width: 80px">Status</th></tr>
    </thead>
    <tbody>
    <?php $idd=1;foreach ( $all_period as $row) { ?>
        <?php
        $class=$this->admin_model->class_by_id($row['class_id']); $class=$class['name'];
        $period=$this->admin_model->list_period_by_id($row['name']); $period=$period['name'];
        $section=$this->admin_model->section_by_id($row['section_id']); $section=$section['name'];
        $subject=$this->admin_model->list_subjects_by_id($row['subject']); $subject=$subject['name'];
        $teacher=$this->admin_model->teacher_name($row['teacher_id']);
        ?>
        <tr>
            <td style="width: 20px" ><?php echo $idd++; ?></td>
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
       loadview('time_table/'+cl+'/'+sec);

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
            url: '<?php echo base_url()?>index.php/admin/change_period_status',
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


