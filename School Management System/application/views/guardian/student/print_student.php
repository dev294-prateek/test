<h1 class="page-title">Print Student Slip </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('print_student/<?php echo $student["student_id"];?>')""><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>

<hr>

<a class="gold-bt"  onclick="pdftDiv('guardian')">Download Pdf</a>
<a class="gold-bt float-r"  onclick="printDiv('guardian')">Print Student Slip</a>


<div class="col-sm-12" id="guardian">
    <h1 class="page-title">Student Slip</h1>
    <hr>
    <table class="table table-responsive">
        <tr><th>Id</th><td><?php echo $student['student_id'] ?></td><td rowspan="8"><img style="position: absolute;right: 5px;width: 200px;border-radius: 20px;border: 1px solid gray;padding: 4px;" src="<?php echo base_url()?>/uploads/<?php echo $student['student_image'] ?>"></td></tr>
        <tr><th>Admission No</th><td><?php echo $student['admission_no'] ?></tr>
        <tr><th>Session</th><td><?php echo $_SESSION['running_year']; ?></tr>
        <tr><th>Name</th><td><?php echo $student['student_name'] ?></tr>
        <tr><th>Gender</th><td><?php echo $student['gender'] ?></tr>
        <tr><th>DOB</th><td><?php echo $student['birthday'] ?></tr>
        <tr><th>Aadhaar No</th><td><?php echo $student['aadhaar_no'] ?></tr>
        <tr><th>Class</th><td><?php $class= $this->guardian_model->class_by_id($student['class']); echo $class['name'] ?></tr>
        <tr><th>Section</th><td><?php $section= $this->guardian_model->section_by_id($student['section']); echo $section['name']; ?></tr>
        <tr><th>Nationality</th><td><?php echo $student['nationality'] ?></tr>
        <tr><th>Religion</th><td><?php echo $student['Religion'] ?></tr>
        <tr><th>Guardian</th><td><?php $guardian= $this->guardian_model->list_guardian_by_id($student['guardian']); echo $guardian['guardian_name']; ?></tr>
        <tr><th>Relation To Guardian</th><td><?php echo $student['relation_to_guardian'] ?></tr>
        <tr><th>Father's Name</th><td><?php echo $student['father'] ?></tr>
        <tr><th>Mother's Name</th><td><?php echo $student['mother'] ?></tr>
        <tr><th>Category</th><td><?php echo $student['sc_st'] ?></tr>
        <tr><th>Language Known </th><td><?php echo $student['language1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['language2']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['language3']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['language4']; ?></tr>

        <tr><th>Residential Address</th><td><?php echo $student['resident_address1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['resident_address2']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['resident_address3'];echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['resident_address_pin']; ?></tr>
        <tr><th>Correspondence Address</th><td><?php echo $student['correspond_address1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['correspond_address2']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['correspond_address3'];echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;'; echo $student['correspond_address_pin']; ?></tr>

        <tr><th>Distance from school (in kms)</th><td><?php echo $student['distance_from_school'] ?></tr>
        <tr><th>Preferred Phone no. for School SMS</th><td><?php echo $student['mobile_no_for_sms'] ?></tr>
        <tr><th>Scholastic Activities :</th><td><?php echo $student['scholastic_activities'] ?></tr>
        <tr><th>Co-Scholastic Activities (hobbies)</th><td><?php $x= json_decode($student['coscholastic_activities']); $length=count($x);
                for($i=0; $i<$length;$i++){
                    echo ($i+1)." :- ".$x[$i]."&nbsp;&nbsp;&nbsp;&nbsp;";
                }

                ?></td></tr>

        <tr><th>Emergency Contact I </th><td><?php echo $student['emergency_contact_name_1']; echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $student['emergency_contact_mobile_1'];  echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $student['emergency_contact_relation_1']; ?></tr>


        <tr><th>Emergency Contact II </th><td><?php echo $student['emergency_contact_name_2'];  echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $student['emergency_contact_mobile_2'];  echo '&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;';  echo $student['emergency_contact_relation_2']; ?></tr>


    </table>
    <hr>

    <img style="width: 100%" src="<?php echo base_url()?>/uploads/<?php echo $student['birth_certificate'] ?>">
    <hr>
    <h1 class="page-title">Birth Certificate </h1>
    <hr>
    <img style="width: 100%" src="<?php echo base_url()?>/uploads/<?php echo $student['character_certificate'] ?>">
    <hr>
    <h1 class="page-title">Character Certificate </h1>
    <hr>
    <img style="width: 100%" src="<?php echo base_url()?>/uploads/<?php echo $student['medical_certificate'] ?>">
    <hr>
     <h1 class="page-title">Medical Certificate</h1>
    <hr>
    <img style="width: 100%" src="<?php echo base_url()?>/uploads/<?php echo $student['leaving_certificate'] ?>">
    <hr>
    <h1 class="page-title">Leaving Certificate</h1>
    <hr>
    <img style="width: 100%" src="<?php echo base_url()?>/uploads/<?php echo $student['sc_st_certificate'] ?>">
    <hr>
    <h1 class="page-title">Category Certificate</h1>

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

