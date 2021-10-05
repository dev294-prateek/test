<h1 class="page-title"> Update Exam Grade </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_exam_grade/<?php echo $grade['id'] ?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($grade);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    New Exam
                </div>
            </div>
            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_exam_grade',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="id"  value="<?php echo $grade['id'] ?>" >
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Name :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="name"  required   value="<?php echo $grade['name'] ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Grade Point :</label>
                    <div class="col-xs-8">
                        <input type="number" class="form-control" name="grade_point"  required value="<?php echo $grade['grade_point'] ?>" >
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Mark From :</label>
                    <div class="col-xs-8">
                        <input type="number" class="form-control" name="mark_from"  required  value="<?php echo $grade['mark_from'] ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Mark To:</label>
                    <div class="col-xs-8">
                        <input type="number" class="form-control" name="mark_to"  required  value="<?php echo $grade['mark_to'] ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Comment :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="comment"  required  value="<?php echo $grade['comment'] ?>">
                    </div>
                </div>

                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success"  value="Submit" id="submit">
                    </div>
                </div>
            </div>
            <!--=====================================-->

            <?php echo form_close() ?>
        </div>

        <!--end panal body-->
    </div>


</div>
</div>

<!--=====================================-->

<script>

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_exam_grade',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                   /* alert(msg);*/
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Updated Successfully <div>");
                    loadview('exam_grade')
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>



