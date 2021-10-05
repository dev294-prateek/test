<style>
    button{button.btn.btn-default.xls,button.btn.btn-default.csv,button.btn.btn-default.txt{
               background-color: darkgoldenrod;
               color: white;
           }}
</style>
<h1 class="page-title" > All Student Excel Export </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_student_export')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<!--==================================-->

<table   class="table table-striped table-bordered" data-name="cool-table">
        <thead style="display: none">
        <tr>
            <th style="width:40px !important;">ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Admission No</th>
            <th>Session</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Aadhaar No</th>
            <th>Class</th>
            <th>Section</th>
            <th>Nationality</th>
            <th>Religion</th>
            <th>Guardian</th>
            <th>Relation To Guardian</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Category</th>
            <th>Language Known</th>
            <th>Residential Address</th>
            <th>Correspondence Address</th>
            <th>Distance from school (in kms)</th>
            <th>Preferred Phone no. for School SMS</th>
            <th>Scholastic Activities :</th>
            <th>Co-Scholastic Activities (hobbies)</th>
            <th>Emergency Contact I </th>
            <th>Emergency Contact II </th>
        </tr>
        </thead>
        <tbody style="display: none">
        <?php foreach($students as $row){?>
            <td><?php echo $row['student_id'] ?></td>
            <td><?php echo $row['student_name'] ?></td>
            <td><?php if($row['status']==1){echo 'Active';}else {echo 'inactive';} ?></td>
            <td><?php echo $row['admission_no'] ?></td>
            <td><?php echo $_SESSION['running_year']; ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['birthday'] ?></td>
            <td><?php echo $row['aadhaar_no'] ?></td>
            <td><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?></td>
            <td><?php $section= $this->admin_model->section_by_id($row['section']); echo $section['name']; ?></td>
            <td><?php echo $row['nationality'] ?></td>
            <td><?php echo $row['Religion'] ?></td>
            <td><?php $guardian= $this->admin_model->list_guardian_by_id($row['guardian']); echo $guardian['guardian_name']; ?></td>
            <td><?php echo $row['relation_to_guardian'] ?></td>
            <td><?php echo $row['father'] ?></td>
            <td><?php echo $row['mother'] ?></td>
            <td><?php echo $row['sc_st'] ?></td>
            <td><?php echo $row['language1']; echo ',&nbsp;'; echo $row['language2']; echo ',&nbsp;'; echo $row['language3']; echo ',&nbsp;'; echo $row['language4']; ?></td>
            <td><?php echo $row['resident_address1']; echo ',&nbsp;'; echo $row['resident_address2']; echo ',&nbsp;'; echo $row['resident_address3'];echo ',&nbsp;'; echo $row['resident_address_pin']; ?></td>
            <td><?php echo $row['correspond_address1']; echo ',&nbsp;'; echo $row['correspond_address2']; echo ',&nbsp;'; echo $row['correspond_address3'];echo ',&nbsp;'; echo $row['correspond_address_pin']; ?></td>
            <td><?php echo $row['distance_from_school'] ?></td>
            <td><?php echo $row['mobile_no_for_sms'] ?></td>
            <td><?php echo $row['scholastic_activities'] ?></td>
            <td> <?php $x= json_decode($row['coscholastic_activities']);
                if($x !='') {
                    $length=count($x);
                    for ($i = 0; $i < $length; $i++) {
                        echo ($i + 1) . " :- " . $x[$i] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                }
                ?></td>
            <td><?php echo $row['emergency_contact_name_1']; echo ',&nbsp;';  echo $row['emergency_contact_mobile_1'];  echo ',&nbsp;';  echo $row['emergency_contact_relation_1']; ?></td>
            <td><?php echo $row['emergency_contact_name_2'];  echo ',&nbsp;';  echo $row['emergency_contact_mobile_2'];  echo ',&nbsp;';  echo $row['emergency_contact_relation_2']; ?></td>

            </tr>
        <?php } ?>
        </tbody>


</table>

<script src="<?php echo  base_url();?>/assets/table-export/FileSaver.min.js.download"></script>
<script src="<?php echo  base_url();?>/assets/table-export/Blob.min.js.download"></script>
<script src="<?php echo  base_url();?>/assets/table-export/xls.core.min.js.download"></script>

<script src="<?php echo  base_url();?>/assets/table-export/tableexport.js.download"></script>
<script>
    $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
</script>


