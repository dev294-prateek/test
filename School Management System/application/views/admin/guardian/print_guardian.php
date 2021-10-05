
<h1 class="page-title">Print Guardian </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('print_guardian/<?php echo $guardian["guardian_id"] ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>

<hr>

<a class="gold-bt"  onclick="pdftDiv('guardian')">Download Pdf</a>
<a class="gold-bt float-r"  onclick="printDiv('guardian')">Print Guardian</a>


<div class="col-sm-12" id="guardian">
    <h1 class="page-title">Guardian  Slip</h1>
    <hr>
    <table class="table table-responsive">
        <tr><th>Id</th><td><?php echo $guardian['guardian_id'] ?></td><td rowspan="5"><img style="position: absolute;right: 5px;width: 200px;border-radius: 20px;border: 1px solid gray;padding: 4px;" src="<?php echo base_url()?>/uploads/<?php echo $guardian['guardian_image'] ?>"></td></tr>
        <tr><th>Name</th><td><?php echo $guardian['guardian_name'] ?></td></tr>
        <tr><th>Type</th><td><?php echo $guardian['guardian_type'] ?></td></tr>
        <tr><th>Age</th><td><?php echo $guardian['guardian_age'] ?></td></tr>
        <tr><th>Mobile</th><td><?php echo $guardian['guardian_mobile'] ?></td></tr>
        <tr><th>Aadhaar No</th><td colspan="2"><?php echo $guardian['aadhaar_no'] ?></td></tr>
        <tr><th>Nationality</th><td colspan="2"><?php echo $guardian['nationality'] ?></td></tr>
        <tr><th>Qualifications</th><td colspan="2"><?php echo $guardian['guardian_qualifications'] ?></td></tr>
        <tr ><th>Instituion</th><td colspan="2"><?php echo $guardian['guardian_instituion'] ?></td></tr>
        <tr><th>Occupation</th><td colspan="2"><?php echo $guardian['guardian_occupation'] ?></td></tr>
        <tr><th>Designation</th><td colspan="2"><?php echo $guardian['guardian_designation'] ?></td></tr>
        <tr><th>Annual Income</th><td colspan="2"><?php echo $guardian['guardian_annual_income'] ?></td></tr>
        <tr><th>Address (Office)</th><td colspan="2"><?php echo $guardian['guardian_office_address'] ?></td></tr>
        <tr><th>Address (Home)</th><td colspan="2"><?php echo $guardian['guardian_home_address'] ?></td></tr>
        <tr><th>Email</th><td colspan="2"><?php echo $guardian['email'] ?></td></tr>
        <tr><th>Password</th><td colspan="2"><?php echo $guardian['password'] ?></td></tr>

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

