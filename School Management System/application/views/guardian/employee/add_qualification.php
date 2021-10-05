

<h1 class="page-title"> Add Qualification </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('qualification/<?php echo $employee['employee_id']?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<a class="gold-bt" onclick="loadview('edit_employee/<?php echo $employee["employee_id"];?>')" ><i class="entypo-reply"></i>Prev</a>
<a class="gold-bt float-r" onclick="loadview('experience/<?php echo $employee["employee_id"];?>')">Next<i class="entypo-forward"></i></a>
<hr>
<!--=====================================-->

<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add  Qualification
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_qualification',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="employee_id" value="<?php echo $employee['employee_id']; ?>" >
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Employee No :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?php echo $employee['emp_no']; ?>" disabled>
                    </div>
                    <label class="col-sm-2">Name : </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?php echo $employee['name']; ?>" disabled >

                    </div>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Course :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="course" >
                    </div>
                    <label class="col-sm-2">Board :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"  name="board" >
                    </div>

                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Course Duration :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="course_duration" >
                    </div>
                    <label class="col-sm-2">Completion Year :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control date-own" name="year" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Subjects :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="subjects" id="subjects" onblur="chkcomma()">
                    </div>
                    <label class="col-sm-2">Marks Achieved (%) :</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="marks_achieved" max="100">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Subjects Taught :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" name="subjects_taught">
                    </div>
                    <label class="col-sm-2">Specialisation :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="specialisation">
                    </div>
                </div>

                <div class="col-sm-12 ch">
                    <!---->

                    <img  class="img-responsive" id="image_upload_preview" src="<?php echo base_url() ?>assets/images/certificate.png"
                         alt="your image"/>
                  <!--  <div class="centered">Certificate</div>-->

                    <input type="file" name="certificate_image" size="20" id="inputFile"/>
                    <!---->
                    <!--=====================================-->
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('all_employee')">
                            <span class="title">Back</span>
                        </a>
                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <input type="submit"  class=" btn btn-success "  value="Submit">
                    </div>
                </div>
                <!--=====================================-->


                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div><!--=====================================-->


<div class="col-sm-12">
    <table class="table table-responsive">
        <tr>
            <th>ID</th>
            <th>Course</th>
            <th>Board</th>
            <th>Course Duration</th>
            <th>Action</th>

        </tr>
        <?php $x=1; foreach($qualification as $row) { ?>
            <tr>
                <td><?php  echo $x++;?></td>
                <td><?php  echo $row['course'];?></td>
                <td><?php  echo $row['board'];?></td>
                <td><?php  echo $row['course_duration'];?></td>
                <td>
                <!--=====================================-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a   onclick="loadview('edit_qualification/<?php echo $row["qualification_id"];?>')"><i class="entypo-pencil"></i> Edit </a> </li>
                            <li><a  <a onClick="return doconfirm('<?php echo $row["qualification_id"];?>');"><i class="entypo-newspaper"></i> Delete</a></li>
                            <li><a  data-toggle="modal" data-target="#myModal<?php echo $row['qualification_id'] ?>"><i class="entypo-newspaper"></i> Detail</a></li>
                        </ul>
                    </div>
                    <!-----------------MODEL FOR DISPLAY DETAIL------------------->


                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $row['qualification_id'] ?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2 class="modal-title">Qualification Detail</h2>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-responsive">
                                        <tr><th>Course</th><td><?php echo $row['course'] ?></tr>
                                        <tr><th>Board</th><td><?php echo $row['board'] ?></tr>
                                        <tr><th>Course Duration</th><td><?php echo $row['course_duration'] ?></td></tr>
                                        <tr><th>Year</th><td><?php echo $row['year'] ?></td></tr>
                                        <tr><th>Subjects</th><td><?php echo $row['subjects'] ?></td></tr>
                                        <tr><th>Marks Achieved</th><td><?php echo $row['marks_achieved'] ?></td></tr>
                                        <tr><th>Subjects Taught</th><td><?php echo $row['subjects_taught'] ?></td></tr>
                                        <tr><th>Specialisation</th><td><?php echo $row['specialisation'] ?></td></tr>
                                        <tr><td colspan="2">
                                                <img class="img-responsive image_on_modal" src="<?php echo base_url()?>/uploads/<?php echo $row['certificate_image'] ?>">
                                            </td></tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                <!--=====================================-->
                </td>
            </tr>

        <?php  } ?>
    </table>
</div>
<script type="text/javascript">
    $('.date-own').datepicker({
        minViewMode: 2,
        format: 'yyyy'
    });
</script>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_qualification',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('qualification/<?php echo $employee['employee_id']?>')
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Added successfully</span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>
<!-- confirm before delete-->
<script>
    function doconfirm(x) {
        job = confirm("Are you sure to delete permanently?");
        if (job != true) {
            return false;
        }else{

            /*=======================================*/
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/delete_qualification',
                type:"POST",
                datatype:"json",
                data:{id:x},
                success: function(msg){
                   /* alert(msg);*/
                    loadview('qualification/<?php echo $employee['employee_id']?>')
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'> Deleted successfully. </span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Unable To delete <span style='color: red'> Try again</span><div>");

                },
                error: function () { alert("fail");
                }
            })
            /*=======================================*/
        }
    }
</script>
