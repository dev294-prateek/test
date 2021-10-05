
<h1 class="page-title"> Update Experience </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_experience/<?php echo $experience['experience_id']?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<!--=====================================-->
<?php  //print_r($experience) ?>
<?php //print_r($employee) ?>
<?php ?>

<div class="guardian">
    <div class="col-md-12">
        <div id="subsmsg"></div>
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Update  experience
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_experience',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="experience_id" value="<?php echo $experience['experience_id']; ?>" >
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
                        <input type="text" class="form-control" name="institution" value="<?php echo $experience['institution']; ?>">
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">From :</label>
                    <div class="col-sm-4">
                        <input type="text" id="from" class="form-control date-own"value="<?php echo $experience['from_year']; ?>" name="from_year" onblur="calculateduration()" >
                    </div>
                    <label class="col-sm-2">To :</label>
                    <div class="col-sm-4">
                        <input type="text" id="to" class="form-control date-own" value="<?php echo $experience['to_year']; ?>" name="to_year" onblur="calculateduration()">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-sm-2">Total Duration :</label>
                    <div class="col-sm-4">
                        <input type="number"  class="form-control" value="<?php echo $experience['total_duration']; ?>" name="total_duration" id="total"  >
                    </div>
                    <label class="col-sm-2">Position :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="position" value="<?php echo $experience['position']; ?>" >

                    </div>
                </div>
                <!--=====================================-->
                <div class="col-sm-6 ch">
                    <div class="form-group">
                        <a  class=" btn btn-danger " onclick="loadview('experience/<?php echo $employee['employee_id']?>')">
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


<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_experience',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                   /* alert(msg);*/
                    loadview('edit_experience/<?php echo $experience['experience_id']?>')
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated successfully</span><div>");

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

