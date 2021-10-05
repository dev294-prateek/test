<h1 class="page-title"> All Section </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_section')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_class);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2">
       <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Section

                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_section',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Section Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class Name :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="class_id" value="" required >
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>
                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
             <div class="form-group">
                    <label class="col-xs-6">Medium :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="medium" value="" required >
                            <option>Select</option>
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>

                        </select>

                    </div>
                </div>
                <!--=====================================-->
                <?php //print_r($emp_teacher); ?>
                <div class="form-group">
                    <label class="col-xs-6">Class Teacher :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="teacher_id" value="" >
                            <option>Select</option>
                            <?php foreach($emp_teacher as $row){?>
     <option value="<?php $x=$this->teacher_model->teacher_by_employee_id($row['employee_id']); echo $x['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>

                        </select>

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success "  value="Submit" id="submit">
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
<div class="col-sm-8 col-sm-offset-2" style="overflow-x:auto;">
<table id="example"  >
    <thead>
    <tr><td style="width: 20px"> Id </td><td style="width: 50px" >Section</td><td style="width: 50px" >Class </td><td>Class Teacher</td><td>Medium</td><td>Status</td><td>Action</td></tr>
    </thead>
    <tbody>
    <?php foreach ( $all_section as $row) { ?>
        <tr>
            <td style="width: 50px" ><?php  echo $row['section_id']?></td>
            <td style="width: 50px" ><?php echo $row['name']?></td>
            <td style="width: 20px" ><?php $x=$this->teacher_model->class_by_id($row['class_id']); echo $x['name']?></td>
           <td><?php $teach=$this->teacher_model->teacher_name($row['teacher_id']); print_r($teach);?></td>
           <td><span class="badge"><?php echo $row['medium']?></span></td>
            <td><?php if($row['status']==1){ ?>
                    <span class="label label-sm btn-green" onclick="loadview('edit_section/<?php echo $row['section_id']; ?>')"><i class="entypo-star-empty"></i> Active</span>
                <?php }else{ ?>
                    <span class="label label-sm btn-red" onclick="loadview('edit_section/<?php echo $row['section_id']; ?>')"><i class="entypo-star"></i> Inactive</span>
                <?php } ?>
            </td>

            <td><a class="gold-bt" onclick="loadview('edit_section/<?php echo $row['section_id']; ?>')"><i class="entypo-pencil"></i>  Edit</a></td>

        </tr>
    <?php }?>
    </tbody>
</table>
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
                url: '<?php echo base_url()?>index.php/teacher/add_section',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                  /*  alert(msg);*/
                    if(msg) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> One record inserted successfully. </span><div>");

                    }else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable to insert record . </span><div>");

                    }
                    loadview('all_section');
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


