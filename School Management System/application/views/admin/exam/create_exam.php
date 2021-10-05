<h1 class="page-title"> Create Exam </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('create_exam')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
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
                <?php echo form_open_multipart('admin/add_exam',$data) ?>
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
                    <label class="col-xs-4">Comment :</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="comment"  required >
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Start Date :</label>
                    <div class="col-xs-8">
                        <input type="date" class="form-control" name="date_from"  required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">End Date :</label>
                    <div class="col-xs-8">
                        <input type="date" class="form-control" name="date_to"  required >
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Exam Type :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="type"  required >
                            <?php foreach($type as $row){ ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4">Grading :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="grading"  required >
                               <option value="0">No</option>
                               <option value="1">Yes</option>

                        </select>
                    </div>
                </div>

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
            <tr><th style="width: 20px"> Id </th><th style="width: 20%">Name</th><th style="width: 20%">Comment</th><th>Date</th><th>Type</th><th>Grading</th><th style="width: 80px">Action</th></tr>
            </thead>
            <tbody>
            <?php foreach($all_exam as $row){?>
            <tr>
                <td> <?php echo $row['id'];?></td>
                <td style="width: 20%"> <?php echo $row['name'];?></td>
                <td style="width: 20%"> <?php echo $row['comment'];?></td>
                <td> <?php echo $row['date_from']." - ".$row['date_to'];?></td>
                <td> <?php  $x=$this->admin_model->list_exam_type_by_id($row['type']); echo $x; ?></td>
                <td><?php if($row['grading']==1){ echo "Yes";}else{echo "No";}?></td>
                <td>
                    <!---->
                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a onclick="loadview('edit_exam/<?php echo $row["id"];?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                            <li><a onclick="loadview('allow_exam_class/<?php echo $row["id"];?>')"><i class="entypo-doc-text-inv"></i>Allow Class</a></li>
                        </ul>
                    </div>
                    <!---->
                </td>
                </tr>
            <?php }?>
            </tbody>
        </table>

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
                url: '<?php echo base_url()?>index.php/admin/add_exam',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Created Successfully <div>");
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



