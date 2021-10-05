
<?php //print_r($all_driver);?>
<h1 class="page-title" > All driver </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_driver')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--==================================-->
<table id="example">
    <thead>
    <tr>
        <th style="width:40px !important;">Id</th>
        <th>image</th>
        <th>Name</th>
        <th>Father Name</th>
        <th>Gender</th>
        <th>Type</th>
        <th>DL No </th>
        <th>DL Expire Date </th>
        <th>Aadhar  No </th>
        <th>Votarcard No </th>
        <th>Status </th>
        <th style="width:500px !important;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($all_driver as $row){?>
        <tr >
            <td><?php echo $row['id'] ?></td>
            <td><img style="width:80px !important;"  class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['image'] ?>"> </td>

            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['father'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['type'] ?></td>
            <td><?php echo $row['licence_no'] ?></td>
            <td><?php echo $row['exp_date'] ?></td>
            <td><?php echo $row['addhar_no'] ?></td>
            <td><?php echo $row['votar_card_no'] ?></td>
            <td><?php if($row['status']==1){ ?>
                <span class="label label-sm btn-green" onclick="change_status(<?php echo $row['id'] ?>,<?php echo $row['status'] ?>)" ><i class="entypo-star-empty"></i>Active</span>
                <?php }else{ ?>
                <span class="label label-sm btn-red" onclick="change_status(<?php echo $row['id'] ?>,<?php echo $row['status'] ?>)" ><i class="entypo-star"></i>Inactive</span>
                <?php } ?>
            </td>
            <td>

           <a class="btn btn-success"  onclick="loadview('edit_driver/<?php echo $row["id"];?>')"><i class="entypo-pencil"></i>  Edit </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>

</table>
<!--==================================-->
<script>
    function relese_book(id) {

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/relese_book',
            type:"POST",
            datatype:"json",
            data:{id:id,status:1,student_id:0,staff_id:0,date_from:0,date_to:0},
            success: function (msg) {

                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
                loadview('all_book');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}
    }
</script>

<script>
    function downlod_exel() {
        $("#expoet_table").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}

        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_driver_status',
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
                loadview('all_driver');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }
</script>
