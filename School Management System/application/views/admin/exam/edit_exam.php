<h1 class="page-title"> Update Exam </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_exam/<?php echo $exam['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($exam);?>
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
                <?php echo form_open_multipart('admin/update_exam',$data) ?>
                <br>
                <input type="hidden" name="id" value="<?php echo $exam['id'];?>">
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Name :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="name"  required  value="<?php echo $exam['name'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Comment :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="comment"  required  value="<?php echo $exam['comment'];?>">
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Start Date :</label>
                    <div class="col-xs-8">
                        <input type="date" class="form-control" name="date_from"  required value="<?php echo $exam['date_from'];?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">End Date :</label>
                    <div class="col-xs-8">
                        <input type="date" class="form-control" name="date_to"  required value="<?php echo $exam['date_to'];?>">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Exam Type :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="type"  required >
                            <?php foreach($type as $row){ ?>
                                <option value="<?php echo $row['id'];?>" <?php if($exam['type']){echo 'selected';}?>><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4">Grading :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="grading"  required >
                            <option value="0" <?php if ($exam['grading']==0){echo 'selected';}?>>No</option>
                            <option value="1" <?php if ($exam['grading']==1){echo 'selected';}?>>Yes</option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4"></label>
                    <div class="col-xs-8">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
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
<!--to form submit upload image-->

<script>

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_exam',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                   /* alert(msg);*/
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Updated  Successfully <div>");
                    loadview('create_exam')
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



