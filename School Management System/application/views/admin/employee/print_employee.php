
<h1 class="page-title">Print Employee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('print_employee/<?php echo $employee["employee_id"] ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<a class="gold-bt"  onclick="pdftDiv('guardian')">Download Pdf</a>
<a class="gold-bt float-r"  onclick="printDiv('guardian')">Print Employee</a>
<div class="col-sm-12" id="guardian">
    <h1 class="page-title">Employee  Slip</h1>
    <hr>
    <table class="table table-responsive">
        <tr><th>Id</th><td><?php echo $employee['employee_id'] ?></tr>
        <tr><th>Employee No</th><td><?php echo $employee['emp_no'] ?></tr>
        <tr><th>Name</th><td><?php echo $employee['name'] ?></td></tr>
        <tr><th>Father's Name</th><td><?php echo $employee['father_name'] ?></td></tr>
        <tr><th>Gender</th><td><?php echo $employee['gender'] ?></td></tr>
        <tr><th>Date of Birth</th><td><?php echo $employee['dob'] ?></td></tr>
        <tr><th>Joining Date</th><td><?php echo $employee['joining_date'] ?></td></tr>
        <tr><th>Contact No</th><td><?php echo $employee['contact_no'] ?></td></tr>
        <tr><th>Email</th><td><?php echo $employee['email'] ?></td></tr>
        <tr><th>Emergency person</th><td><?php echo $employee['emergency_person'] ?></td></tr>
        <tr><th>Emergency Contact No</th><td><?php echo $employee['emergency_contact_no'] ?></td></tr>
        <tr><th>Addhar No</th><td><?php echo $employee['adhar_no'] ?></td></tr>
        <tr><th>Pan No</th><td><?php echo $employee['pan_no'] ?></td></tr>
        <tr><th>Function</th><td><?php echo $employee['function'] ?></td></tr>
        <tr><th>Designation</th><td><?php echo $employee['designation'] ?></td></tr>
        <tr><th>Remark</th><td><?php echo $employee['remark'] ?></td></tr>
        <tr><th>Blood Group</th><td><?php echo $employee['blood_group'] ?></td></tr>
        <tr><th>Nationality</th><td><?php echo $employee['nationality'] ?></td></tr>
        <tr><th>Residential Address</th><td><?php echo $employee['residential_address'] ?></td></tr>
        <tr><th>Correspondence Address</th><td><?php echo $employee['correspondence_address'] ?></td></tr>
        <tr><th>Login Id</th><td><?php echo $employee['login_id'] ?></td></tr>
        <tr><th>Password</th><td><?php echo $employee['password'] ?></td></tr>
        <tr><th>Left Date</th><td><?php echo $employee['left_date'] ?></td></tr>
        <tr><th>Status</th><td><?php echo $employee['status'] ?></td></tr>
        <tr><th>Type</th><td><?php echo $employee['employee_type'] ?></td></tr>
        <img style="position: absolute;top: 115px;right: 30px;width: 200px;border-radius: 29px;" src="<?php echo base_url()?>/uploads/<?php echo $employee['employee_image'] ?>">
    </table>
    <h1 class="page-title">Qualification</h1>
    <table class="table table-responsive">
        <tr>
            <th style="width: 2%">ID</th>
            <th>Course</th>
            <th>Duration</th>
            <th>Board</th>
            <th>Year of Passing</th>
            <th>Subjects</th>
            <th>Marks Achieved</th>
            <th>Subjects Taught</th>
            <th>Specialisation</th>

        </tr>
        <?php $x=1; foreach($qualification as $row) { ?>
            <tr>
                <td><?php  echo $x++;?></td>
                <td><?php  echo $row['course'];?></td>
                <td><?php  echo $row['board'];?></td>
                <td><?php  echo $row['course_duration'];?></td>
                <td><?php  echo $row['year'];?></td>
                <td><?php  echo $row['subjects'];?></td>
                <td><?php  echo $row['marks_achieved'];?></td>
                <td><?php  echo $row['subjects_taught'];?></td>
                <td><?php  echo $row['specialisation'];?></td>
            </tr>

        <?php  } ?>
    </table>
    <?php //print_r($experience); ?>
    <h1 class="page-title">Experience</h1>
    <table class="table table-responsive">
        <tr>
            <th style="width: 2%">ID</th>
            <th>Post</th>
            <th>Organization</th>
            <th>Year From</th>
            <th>Year to</th>
            <th>Duration</th>

        </tr>
        <?php $x=1; foreach($experience as $row) { ?>
            <tr>
                <td><?php  echo $x++;?></td>
                <td><?php  echo $row['position'];?></td>
                <td><?php  echo $row['institution'];?></td>
                <td><?php  echo $row['from_year'];?></td>
                <td><?php  echo $row['to_year'];?></td>
                <td><?php  echo $row['total_duration'];?></td>
            </tr>
        <?php  } ?>
    </table>
</div>




<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

