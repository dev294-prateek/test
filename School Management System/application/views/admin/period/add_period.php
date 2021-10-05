
<h1 class="page-title"> Period Allotment </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('period')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
<div class="guardian">
    <div class="col-sm-6">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Allot Period
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/alot_period',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-4">Name :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="name"  required >
                            <?php foreach($period as $row){?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Class :</label>

                    <div class="col-sm-8">
                        <select type="text" class="form-control" name="class_id" id="class_id" value="" onChange="getSection(value);">
                            <option>Select</option>
                            <?php foreach($class as $row){ ?>

                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Section :</label>
                    <div class="col-sm-8">
                        <select id="section" class="form-control" name="section_id">
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Day Range</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="day" id="day" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Start Time:</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control" name="start_time" id="start_time" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">End Time :</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control" name="end_time" id="end_time" onblur="chk_time()">
                    </div>
                </div>
                <!--=====================================-->

                <div class="form-group">
                    <label class="col-xs-4">Teacher :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="teacher_id" onchange="detail(value)" required >
                            <option value="">Select</option>
                            <?php foreach($emp_teacher as $row){?>
                                <option value="<?php $x=$this->admin_model->teacher_by_employee_id($row['employee_id']); echo $x['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4">Subject :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="subject"  required >
                            <?php foreach($subject as $row){?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4">Subject Option :</label>
                    <div class="col-xs-8">
                        <select class="form-control" name="opt_sub"  required >
                            <?php foreach($subject_option as $row){?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
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
    <div class="col-sm-6">
        <div  id="det">
        </div>
        <div  id="det2">
        </div>
    </div>

</div>
</div>

<!--=====================================-->
<!--to form submit upload image-->
<script>
    $(document).ready(function(){
        $("#section").change(function(){
            var s_id=$(this).val();
            var c_id=$("#class_id").val();
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/period_class_detail',
                type:"POST",
                datatype:"json",
                data:{s_id:s_id,c_id:c_id},
                success: function (msg) {
                    $("#det2").html(msg);
                },
                error: function () { alert("fail");
                }
            })

        });
    });
</script>
<script>
    function detail(id){
        /*   alert(id);*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/show_teacher_detail_for_period',
            type:"POST",
            datatype:"json",
            data:{id:id},
            success: function (msg) {

                $("#det").html(msg);
            },
            error: function () { alert("fail");
            }
        })
    }

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/alot_period',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Allotted Successfully <div>");
                    loadview('period')
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
<script>
    function getSection(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/section_by_class_id/'+value,
            success: function(data){
                obj=JSON.parse(data);
                for (var i = 0; i <obj.length; i++) {
                    msg += '<option value="'+ obj[i].section_id +'">'+obj[i].name+'</option>';

                }

                $('#section').html(msg);
            },
            error: function(){

                alert("fail");
            },

        });
        /*----------------------*/
    }
</script>
<script>

        function chk_time() {
            var end = $('#end_time').val();
            var start = $('#start_time').val();
           if( start > end)
            {
             var end = $('#end_time').val("");
                $('#end_time').val('');
                alert('End time always greater then Start time');
            }
        }

</script>


