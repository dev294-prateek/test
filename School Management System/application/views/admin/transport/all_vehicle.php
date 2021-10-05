
<?php //print_r($all_vehicle);?>
<h1 class="page-title" > All Vehicle </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_vehicle')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--==================================-->
<table id="example">
    <thead>
    <tr>
        <th style="width:40px !important;">Id</th>
        <th>Vehicle No</th>
        <th>Nick Name</th>
        <th>Vehicle Type</th>
        <th>Make</th>
        <th>Year </th>
        <th>Registration No </th>
        <th>Seating Capacity </th>
        <th>Status </th>
        <th style="width:500px !important;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($all_vehicle as $row){?>
        <tr >
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['vehicle_no'] ?></td>
            <td><?php echo $row['nick_name'] ?></td>
            <td><?php echo $row['type'] ?></td>
            <td><?php echo $row['make'] ?></td>
            <td><?php echo $row['year'] ?></td>
            <td><?php echo $row['registration_no'] ?></td>
            <td><?php echo $row['seating_capacity'] ?></td>

            <td><?php if($row['status']==1){ ?>
                <span class="label label-sm btn-green" ><i class="entypo-star-empty"></i>Available</span>
                <?php }else{ ?>
                <span class="label label-sm btn-red" onclick="relese_book(<?php echo $row['id'] ?>)" ><i class="entypo-star"></i>Issued</span>
                <?php } ?>
            </td>
            <td>

           <a class="btn btn-success"  onclick="loadview('edit_vehicle/<?php echo $row["id"];?>')"><i class="entypo-pencil"></i>  Edit </a>
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


