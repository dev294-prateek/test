
<h1 class="page-title"> Update Qualification </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_qualification/<?php echo $qualification["qualification_id"]; ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($qualification); ?>
<div class="guardian">
    <div class="col-md-12">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update  Qualification
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_qualification',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="qualification_id" value="<?php echo $qualification['qualification_id']; ?>" >
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
                        <input type="text" class="form-control" name="course" value="<?php echo $qualification['course']; ?>">
                    </div>
                    <label class="col-sm-2">Board :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"  name="board" value="<?php echo $qualification['board']; ?>">
                    </div>

                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Course Duration :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="course_duration" value="<?php echo $qualification['course_duration']; ?>">
                    </div>
                    <label class="col-sm-2">Completion Year :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control date-own" name="year" value="<?php echo $qualification['year']; ?>" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Subjects :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="subjects" value="<?php echo $qualification['subjects']; ?>" id="subjects">
                    </div>
                    <label class="col-sm-2">Marks Achieved (%) :</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="marks_achieved"  value="<?php echo $qualification['marks_achieved']; ?>" max="100">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Subjects Taught :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" name="subjects_taught" value="<?php echo $qualification['subjects_taught']; ?>">
                    </div>
                    <label class="col-sm-2">Specialisation :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="specialisation" value="<?php echo $qualification['specialisation']; ?>">

                    </div>
                </div>
                <div class="col-sm-12 ch" style="text-align:center">
                    <!---->

                    <img   id="image_upload_preview" src="<?php echo base_url() ?>uploads/<?php echo $qualification['certificate_image']; ?>"
                         alt="your image"/>
                  <!--  <div class="centered">Certificate</div>-->

                    <input type="file" name="certificate_image" size="20" id="inputFile"/>
                    <!---->
                    <!--=====================================-->
                </div>
    
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('qualification/<?php echo $employee['employee_id']?>')">
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
                url: '<?php echo base_url()?>index.php/admin/update_qualification',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div  class='alert alert-danger '> <span style='color: red'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated successfully. <div>");
                   loadview('edit_qualification/<?php echo $qualification["qualification_id"]; ?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>
<!--<script>
    function chkcomma() {
        if ($('#subjects').val().indexOf(',') !== -1)
        {
            alert('comma is not allow');
            $('#subjects').val('');
        }

    }

</script>-->
