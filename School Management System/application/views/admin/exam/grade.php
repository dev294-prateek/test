<h1 class="page-title"> Exam Grade </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('exam_grade')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($all_grade);?>
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
                <?php echo form_open_multipart('admin/add_exam_grade',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Name :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="name"  required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Grade Point :</label>
                    <div class="col-xs-8">
                        <input type="number" class="form-control" name="grade_point"  required >
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Mark From :</label>
                    <div class="col-xs-8">
                        <input type="number" class="form-control" name="mark_from"  required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Mark To:</label>
                    <div class="col-xs-8">
                        <input type="number" class="form-control" name="mark_to"  required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Comment :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="comment"  required >
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
    <div class="col-sm-12">
        <table id="example"  >
            <thead>
            <tr><th style="width: 20px"> Id </th><th style="width: 30px">Name</th><th style="width: 30px">Mark Range</th><th style="width: 30px">Comment</th><th style="width: 30px">Action</th></tr>
            </thead>
            <tbody>
            <?php foreach($all_grade as $row){?>
                <tr>
                    <td> <?php echo $row['id'];?></td>
                    <td> <?php echo $row['name'];?></td>

                    <td> <?php echo $row['mark_from']." - ".$row['mark_to'];?></td>
                    <td> <?php echo $row['comment'];?></td>
                    <td>
                        <button class="btn btn-success" onclick="loadview('edit_exam_grade/<?php echo $row["id"];?>')">Edit</button>

                    </td>

                </tr>
            <?php }?>
            </tbody>
        </table>

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
                url: '<?php echo base_url()?>index.php/admin/add_exam_grade',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Created Successfully <div>");
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



