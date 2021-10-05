
<?php //print_r($books);?>
<h1 class="page-title" > All Book </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_book')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
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
            <button style="    float: right;" class="btn btn-green" onclick="downlod_exel()"><i class="entypo-install"></i> Export Excel </button>
        </div>

        <!--=====================================-->
    </div>

</div>
<br>
<!--==================================-->
<table id="example">
    <thead>
    <tr>
        <th style="width:40px !important;">Code</th>
        <th>Name</th>
        <th>Author</th>
        <th>Description</th>
        <th>Class</th>
        <th>Status</th>
        <th style="width:500px !important;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($books as $row){?>
        <tr >
            <td><?php echo $row['book_code'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['author'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?></td>
            <td><?php if($row['status']==1){ ?>
                <span class="label label-sm btn-green" ><i class="entypo-star-empty"></i>Available</span>
                <?php }else{ ?>
                <span class="label label-sm btn-red" onclick="relese_book(<?php echo $row['id'] ?>)" ><i class="entypo-star"></i>Issued</span>
                <?php } ?>
            </td>
            <td>
                <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
                <div class="btn-group">
                    <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">
                        <li><a   onclick="loadview('edit_book/<?php echo $row["id"];?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                        <li><a  data-toggle="modal" data-target="#myModal<?php echo $row['id'] ?>"><i class="entypo-newspaper"></i>Detail</a></li>
                        <?php if($row['status']==1){ ?>
                        <li><a  onclick="loadview('issue_book_to_student/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i> To Student</a></li>
                        <li><a  onclick="loadview('issue_book_to_staff/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i> To Staff</a></li>
                        <?php } ?>
                        <li><a  onclick="loadview('lib_book_history/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i>History</a></li>

                    </ul>
                </div>
                <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->


                <!-----------------MODEL FOR DISPLAY DETAIL------------------->


                <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $row['id'] ?>" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2 class="modal-title">Book Detail</h2>
                            </div>
                            <div class="modal-body">
                                <table class="table table-responsive">
                                    <tr><th>Id</th><td><?php echo $row['id'] ?></td></tr>
                                    <tr><th>Book Code</th><td><?php echo $row['book_code'] ?></td></tr>
                                    <tr><th>Name</th><td><?php echo $row['name'] ?></td></tr>
                                    <tr><th>Author</th><td><?php echo $row['author'] ?></td></tr>
                                    <tr><th>Type</th><td><?php echo $row['type'] ?></td></tr>
                                    <tr><th>Max Day</th><td><?php echo $row['max_day'] ?></td></tr>
                                    <tr><th>Description</th><td><?php echo $row['description'] ?></td></tr>
                                    <tr><th>Class</th><td><?php $class= $this->admin_model->class_by_id($row['class']); echo $class['name'] ?></tr>


                                    <tr><th>Status</th><td>
                                            <?php if($row['status']==1){ ?>
                                                <span class="label label-sm btn-green" ><i class="entypo-star-empty"></i>Available</span>
                                            <?php }else{ ?>
                                                <span class="label label-sm btn-red" ><i class="entypo-star"></i>Issued</span>
                                            <?php } ?>
                                        </td></tr>
                                    <tr><th>Price</th><td><?php echo $row['price'] ?></td></tr>
                                    <tr><th>Added Date</th><td><?php echo $row['added_date'] ?></td></tr>
                                    <?php if($row['student_id'] > 0){ ?>
                                        <tr><th>Issued To Student</th><td><?php  $stu= $this->admin_model->list_student_by_id($row['student_id']);echo($stu['student_name']);?>&nbsp;&nbsp;&nbsp;&nbsp; <span class="label label-sm btn-green" >Class : <?php $class= $this->admin_model->class_by_id($stu['class']); echo $class['name'] ?></span><span class="label label-sm btn-green" >Section : <?php $section= $this->admin_model->section_by_id($stu['section']); echo $section['name']; ?></span></td></tr>
                                    <?php } ?>
                                    <?php if($row['staff_id'] > 0){ ?>
                                    <tr><th>Issued To Staff </th><td><?php  $staff= $this->admin_model->list_employee_by_id( $row['staff_id']); echo($staff['name']); ?>&nbsp;&nbsp;&nbsp;&nbsp; <span class="label label-sm btn-red" ><?php echo($staff['designation']); ?></span></td></tr>
                                    <?php } ?>
                                    <?php if(($row['staff_id'] > 0 )||($row['student_id'] > 0) ){ ?>
                                    <tr><th>Date From</th><td><?php echo $row['date_from'] ?></td></tr>
                                    <tr><th>Date To</th><td><?php echo $row['date_to'] ?></td></tr>
                                    <?php } ?>
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


