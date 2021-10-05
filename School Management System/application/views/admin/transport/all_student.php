
<?php //print_r($class);?>
<h1 class="page-title" > All Student Route </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('alot_route')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
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
<!--==================================-->
<table id="example">
    <thead>
    <tr>
        <th style="width:40px !important;">ID</th>
        <th style="width:100px !important;" >Image</th>
        <th>Name</th>
        <th style="width:100px !important;" >Class</th>
        <th>Route</th>
        <th>Start Location</th>
        <th>End Location</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach($students as $row){?>
        <tr >
            <td><?php echo $row['student_id'] ?></td>
            <td style="width:100px !important;" > <?php if($row['student_image']) {?>
                <img style="width:80px !important;"  class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['student_image'] ?>">
            <?php } ?>
            </td>
            <td><?php echo $row['student_name'] ?> <br> <span style="color: red"><?php $guardian= $this->admin_model->list_guardian_by_id($row['guardian']); echo $guardian['guardian_name']; ?></span> </td>
            <td style="width:100px !important;" ><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?> &nbsp;&nbsp;-&nbsp;&nbsp;<?php $section= $this->admin_model->section_by_id($row['section']); echo $section['name']; ?></td>
            <td>
                <select class="form-control" onchange="getlocation(this.value,<?php echo $row['student_id'] ?>)">
                    <option>Select</option>
                    <?php foreach($route as $col){?>
                        <option value="<?php echo $col['id']; ?>" <?php if ($col['id']==$row['route_id']){echo 'selected';} ?>><?php echo $col['name']; ?></option>
                    <?php }?>
                </select>

            </td>
            <td>  <select class="form-control location_<?php echo $row['student_id'] ?>" name=""  onchange="setStartlocation(this.value,<?php echo $row['student_id'] ?>)">
                    <?php if ( $row['s_loc_id'] ) {?>
                        <option><?php  $r=$this->admin_model->route_location_by_id($row['s_loc_id']); echo $r['name']  ?></option>
                    <?php  }?>
                </select> </td>
            <td>  <select class="form-control location_<?php echo $row['student_id'] ?>" name=""  onchange="setEndlocation(this.value,<?php echo $row['student_id'] ?>)">
                    <?php if ( $row['e_loc_id'] ) {?>
                        <option><?php  $r=$this->admin_model->route_location_by_id($row['e_loc_id']); echo $r['name']  ?></option>
                    <?php  }?>
                </select> </td>


        </tr>
    <?php } ?>
    </tbody>

</table>
<script>
    function setStartlocation(loc_id,st_id) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/update_student_start_location',
            type:"POST",
            datatype:"json",
            data:{s_loc_id : loc_id ,student_id : st_id},
            success: function (msg) {
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
            },
            error: function () {
                alert('fail');
            }
        });
    }
</script>
<script>
    function setEndlocation(loc_id,st_id) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/update_student_start_location',
            type:"POST",
            datatype:"json",
            data:{e_loc_id : loc_id ,student_id : st_id},
            success: function (msg) {
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");

            },
            error: function () {
                alert('fail');
            }
        });
    }
</script>
<script>
    function getlocation(route_id,st_id) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/get_location',
            type:"POST",
            datatype:"json",
            data:{route_id : route_id ,student_id : st_id},
            success: function (msg) {
                $(".location_"+st_id).html(msg);
            },
            error: function () {
                alert('fail');
            }
        });
    }
</script>

<script>

    function getinstal(x) {
        loadview('all_student/'+x);
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_student_status',
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
                loadview('all_student');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })



    }
</script>




