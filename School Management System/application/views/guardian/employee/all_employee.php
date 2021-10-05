<h1 class="page-title" ><?php echo  $title;?></h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_employee')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<?php //print_r($designation);?>
<div class="col-md-12" style="margin-bottom: 10px;">
    <!--=====================================-->
    <label class="col-xs-2">Sellect :</label>
    <div class="col-xs-3">
        <select class="form-control mtz-monthpicker-widgetcontainer" onchange="getinstal(value)" >
            <option>select</option>
            <?php foreach ($designation as $row){ ?>
            <option value="<?php echo  $row['designation']; ?>"><?php echo  $row['designation']; ?></option>
            <?php } ?>
        </select>
    </div>
    <!--=====================================-->
</div>
<!--==================================-->
<table id="example">
    <thead>
        <tr>
            <th style="width:40px !important;">ID</th>
            <th >Image</th>
            <th>Name</th>
          <!--  <th>Type</th>-->
            <th>Function</th>
            <th>Designation</th>
            <th>Status</th>
            <th style="width:500px !important;">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($all_employee as $row){ if($row['designation']!=='admin'){?>
     <tr>
         <td><?php echo $row['employee_id'] ?></td>
         <td><img style="width:80px !important;" class="employee_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['employee_image'] ?>"> </td>
         <td><?php echo $row['name'] ?></td>
 <!--        <td><?php /*echo $row['employee_type'] */?></td>-->
         <td><?php echo $row['function'] ?></td>
         <td><?php echo $row['designation'] ?></td>
         <td><?php if($row['status']==1){ ?>
                 <span class="label label-sm btn-green" onclick="change_emp_status(<?php echo $row["employee_id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star-empty"></i> Active</span>
             <?php }else{ ?>
                 <span class="label label-sm btn-red" onclick="change_emp_status(<?php echo $row["employee_id"] ?>,<?php echo $row["status"] ?>)"><i class="entypo-star"></i> Inactive</span>
             <?php }  ?>
         </td>
         <td>
             <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


             <div class="btn-group">
                 <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     Action <span class="caret"></span>
                 </button>
                 <ul class="dropdown-menu dropdown-menu-left" role="menu">
                     <li><a   onclick="loadview('edit_employee/<?php echo $row["employee_id"];?>')"><i class="entypo-pencil"></i> Edit </a> </li>
                     <li><a   onclick="loadview('print_employee/<?php echo $row["employee_id"];?>')"><i class="entypo-print"></i> Print </a> </li>
                     <li><a   onclick="loadview('qualification/<?php echo $row["employee_id"];?>')"><i class="entypo-print"></i>  Qualification </a> </li>
                     <li><a   onclick="loadview('experience/<?php echo $row["employee_id"];?>')"><i class="entypo-print"></i>  Experience </a> </li>
                     <li><a   onclick="loadview('lib_book_emp_history/<?php echo $row["employee_id"];?>')"><i class="entypo-print"></i>  Library </a> </li>
                     <li><a  data-toggle="modal" data-target="#myModal<?php echo $row['employee_id'] ?>"><i class="entypo-newspaper"></i> Detail</a>
                     </li>
                 </ul>
             </div>
             <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


             <!-----------------MODEL FOR DISPLAY DETAIL------------------->


             <!-- Modal -->
             <div class="modal fade" id="myModal<?php echo $row['employee_id'] ?>" role="dialog">
                 <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h2 class="modal-title">employee Detail</h2>
                         </div>
                         <div class="modal-body">
                             <table class="table table-responsive">
                                 <tr><th>Id</th><td><?php echo $row['employee_id'] ?></tr>
                                 <tr><th>Employee No</th><td><?php echo $row['emp_no'] ?></tr>
                                 <tr><th>Name</th><td><?php echo $row['name'] ?></td></tr>
                                 <tr><th>Father's Name</th><td><?php echo $row['father_name'] ?></td></tr>
                                 <tr><th>Gender</th><td><?php echo $row['gender'] ?></td></tr>
                                 <tr><th>Date of Birth</th><td><?php echo $row['dob'] ?></td></tr>
                                 <tr><th>Joining Date</th><td><?php echo $row['joining_date'] ?></td></tr>
                                 <tr><th>Contact No</th><td><?php echo $row['contact_no'] ?></td></tr>
                                 <tr><th>Email</th><td><?php echo $row['email'] ?></td></tr>
                                 <tr><th>Emergency person</th><td><?php echo $row['emergency_person'] ?></td></tr>
                                 <tr><th>Emergency Contact No</th><td><?php echo $row['emergency_contact_no'] ?></td></tr>
                                 <tr><th>Addhar No</th><td><?php echo $row['adhar_no'] ?></td></tr>
                                 <tr><th>Pan No</th><td><?php echo $row['pan_no'] ?></td></tr>
                                 <tr><th>Function</th><td><?php echo $row['function'] ?></td></tr>
                                 <tr><th>Designation</th><td><?php echo $row['designation'] ?></td></tr>
                                 <tr><th>Remark</th><td><?php echo $row['remark'] ?></td></tr>
                                 <tr><th>Blood Group</th><td><?php echo $row['blood_group'] ?></td></tr>
                                 <tr><th>Nationality</th><td><?php echo $row['nationality'] ?></td></tr>
                                 <tr><th>Residential Address</th><td><?php echo $row['residential_address'] ?></td></tr>
                                 <tr><th>Correspondence Address</th><td><?php echo $row['correspondence_address'] ?></td></tr>
                                 <tr><th>Login Id</th><td><?php echo $row['login_id'] ?></td></tr>
                                 <tr><th>Password</th><td><?php echo $row['password'] ?></td></tr>
                                 <tr><th>Left Date</th><td><?php echo $row['left_date'] ?></td></tr>
                                 <tr><th>Status</th><td><?php echo $row['status'] ?></td></tr>
                                 <tr><th>Type</th><td><?php echo $row['employee_type'] ?></td></tr>
                                 <img class="img-responsive image_on_modal" src="<?php echo base_url()?>/uploads/<?php echo $row['employee_image'] ?>">
                             </table>
                         </div>
                     </div>

                 </div>
             </div>

         </td>
     </tr>
    <?php }} ?>
    </tbody>

</table>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function getinstal(x) {
        loadview('all_employee/'+x);
    }
    function change_emp_status(id,status) {
        if(status==1){status=0;}else {status=1;}
      /*  alert(status);*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_employee_status',
            type:"POST",
            datatype:"json",
            data:{id:id,status:status},
            success: function (msg) {
              /*  alert(msg);*/
                if(msg==1) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
                }else{
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable Update . </span><div>");
                }
                loadview('all_employee');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }

</script>


