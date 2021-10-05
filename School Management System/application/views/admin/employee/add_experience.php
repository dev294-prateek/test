
<h1 class="page-title"> Add Experience </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('experience/<?php echo $employee['employee_id']?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<a class="gold-bt" onclick="loadview('qualification/<?php echo $employee["employee_id"];?>')" ><i class="entypo-reply"></i>Prev</a>
<a class="gold-bt float-r" style="visibility:hidden">Next<i class="entypo-forward"></i></a>
<hr>
<!--=====================================-->

<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add  experience
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_experience',$data) ?>
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
                    <label class="col-sm-2">Institution : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="institution" >
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">From :</label>
                    <div class="col-sm-4">
                        <input type="text" id="from" class="form-control date-own" name="from_year" onblur="calculateduration()" >
                    </div>
                    <label class="col-sm-2">To :</label>
                    <div class="col-sm-4">
                        <input type="text" id="to" class="form-control date-own" name="to_year" onblur="calculateduration()">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Total Duration :</label>
                    <div class="col-sm-4">
                        <input type="number"  class="form-control" name="total_duration" id="total" >
                    </div>
                    <label class="col-sm-2">Position :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="position" >

                    </div>
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
            <th>Institution</th>
            <th>From </th>
            <th>To</th>
            <th>Total Duration</th>
            <th>Position</th>
            <th>Action</th>

        </tr>
        <?php $x=1; foreach($experience as $row) { ?>
            <tr>
                <td><?php  echo $x++;?></td>
                <td><?php  echo $row['institution'];?></td>
                <td><?php  echo $row['from_year'];?></td>
                <td><?php  echo $row['to_year'];?></td>
                <td><?php  echo $row['total_duration'];?></td>
                <td><?php  echo $row['position'];?></td>
                <td>
                <!--=====================================-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a   onclick="loadview('edit_experience/<?php echo $row["experience_id"];?>')"><i class="entypo-pencil"></i> Edit </a> </li>
                            <li><a  <a onClick="return doconfirm('<?php echo $row["experience_id"];?>');"><i class="entypo-newspaper"></i> Delete</a></li>
                        </ul>
                    </div>

                </td>
            </tr>

        <?php  } ?>
    </table>
</div>
<!--to preview image-->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
</script>
<!--to form submit upload image-->

<!--dismis message after 4 second-->
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
</script>


<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_experience',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    loadview('experience/<?php echo $employee['employee_id']?>')
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
    function calculateduration() {
var to = $("#to").val();
var from = $("#from").val();
 $("#total").val(to - from);
    }
</script>
<script>
    function doconfirm(x) {

        job = confirm("Are you sure to delete permanently?");
        if (job != true) {
            return false;
        }else{

            /*=======================================*/
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/delete_experience',
                type:"POST",
                datatype:"json",
                data:{id:x},
                success: function(msg){
                /*   alert(msg);*/
                    loadview('experience/<?php echo $employee['employee_id']?>')
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
