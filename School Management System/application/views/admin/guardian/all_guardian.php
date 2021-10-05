<h1 class="page-title" > All Gaurdian </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_guardian')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<?php //print_r($all_guardian);?>

<!--==================================-->
<table id="example">
    <thead>
        <tr>
            <th style="width:40px !important;">ID</th>
            <th >Image</th>
            <th>Name</th>
            <th>Type</th>
            <th>Mobile No</th>
            <th style="width:500px !important;">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($all_guardian as $row){?>
     <tr>
         <td><?php echo $row['guardian_id'] ?></td>
         <td><img style="width:80px !important;" class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['guardian_image'] ?>"> </td>
         <td><?php echo $row['guardian_name'] ?></td>
         <td><?php echo $row['guardian_type'] ?></td>
         <td><?php echo $row['guardian_mobile'] ?></td>
         <td>
             <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


             <div class="btn-group">
                 <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     Action <span class="caret"></span>
                 </button>
                 <ul class="dropdown-menu dropdown-menu-left" role="menu">
                     <li><a   onclick="loadview('edit_guardian/<?php echo $row["guardian_id"];?>')"><i class="entypo-pencil"></i> Edit </a> </li>
                     <li><a   onclick="loadview('print_guardian/<?php echo $row["guardian_id"];?>')"><i class="entypo-print"></i> Print </a> </li>
                     <li><a  data-toggle="modal" data-target="#myModal<?php echo $row['guardian_id'] ?>"><i class="entypo-newspaper"></i> Detail</a>
                     </li>
                 </ul>
             </div>
             <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


             <!-----------------MODEL FOR DISPLAY DETAIL------------------->


             <!-- Modal -->
             <div class="modal fade" id="myModal<?php echo $row['guardian_id'] ?>" role="dialog">
                 <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h2 class="modal-title">Guardian Detail</h2>
                         </div>
                         <div class="modal-body">
                             <table class="table table-responsive">
                                 <tr><th>Id</th><td><?php echo $row['guardian_id'] ?></tr>
                                 <tr><th>Name</th><td><?php echo $row['guardian_name'] ?></td></tr>
                                 <tr><th>Type</th><td><?php echo $row['guardian_type'] ?></td></tr>
                                 <tr><th>Age</th><td><?php echo $row['guardian_age'] ?></td></tr>
                                 <tr><th>Mobile</th><td><?php echo $row['guardian_mobile'] ?></td></tr>
                                 <tr><th>Aadhaar No</th><td><?php echo $row['aadhaar_no'] ?></td></tr>
                                 <tr><th>Nationality</th><td><?php echo $row['nationality'] ?></td></tr>
                                 <tr><th>Qualifications</th><td><?php echo $row['guardian_qualifications'] ?></td></tr>
                                 <tr><th>Instituion</th><td><?php echo $row['guardian_instituion'] ?></td></tr>
                                 <tr><th>Occupation</th><td><?php echo $row['guardian_occupation'] ?></td></tr>
                                 <tr><th>Designation</th><td><?php echo $row['guardian_designation'] ?></td></tr>
                                 <tr><th>Annual Income</th><td><?php echo $row['guardian_annual_income'] ?></td></tr>
                                 <tr><th>Address (Office)</th><td><?php echo $row['guardian_office_address'] ?></td></tr>
                                 <tr><th>Address (Home)</th><td><?php echo $row['guardian_home_address'] ?></td></tr>
                                 <tr><th>Email</th><td><?php echo $row['email'] ?></td></tr>
                                 <tr><th>Password</th><td><?php echo $row['password'] ?></td></tr>
                                 <img class="img-responsive image_on_modal" src="<?php echo base_url()?>/uploads/<?php echo $row['guardian_image'] ?>">
                             </table>
                         </div>
                     </div>

                 </div>
             </div>

         </td>
     </tr>
    <?php } ?>
    </tbody>

</table>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


