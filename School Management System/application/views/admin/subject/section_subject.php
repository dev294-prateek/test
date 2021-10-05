<h1 class="page-title" > Section Subject </h1>
<?php // print_r($section); ?>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('section_subject/<?php echo $section["section_id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<div class="col-sm-8 col-sm-offset-2">
    <div class="alert alert-warning "> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> This Section required <span style="color: red"> <?php echo $section['s_compulsory'] ?>  </span> Compulsory Subjects & <span style="color: red"> <?php echo $section['s_optional'] ?>  </span> Optional Subjects<div></div></div>
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Add  Subject
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/add_section_subject',$data) ?>
            <br>
            <input type="hidden" value="<?php echo $section['section_id'] ?>" name="section_id">
            <div class="form-group">
                <label class="col-xs-4">Sellect</label>
                <div class="col-xs-5">
                    <select  class="form-control"  name="subject_id">
                        <?php foreach ($sub_list as $row){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>


            <?php echo form_close() ?>
        </div>

    </div>
    <!---->
</div>
<div class="col-sm-8 col-sm-offset-2">
    <table class="table table-responsive">
        <tbody>
        <tr><td  colspan="5" style="text-align: center;color: darkgoldenrod;">Student Subjects</td></tr>
        <tr><th style="width: 15%">S.N.</th><th  >Student Subjects</th><th>Type</th><th>Last Update</th><th>Status</th></tr>
        <?php $sn=1;foreach ($section_sub_list as $row){?>
            <tr>
                <td  style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $sn++; ?></td>
                <td><?php $x=$this->admin_model->list_subjects_by_id($row['subject_id']);print_r($x['name']); ?></td>
                <td><?php if($row['type']==1){ ?>
                        <span class="label label-sm btn-green" onclick="subject_status(<?php echo $row['id']; ?>,0)"><i class="entypo-star-empty"></i> Compulsory</span>
                    <?php }else{ ?>
                        <span class="label label-sm btn-red" onclick="subject_status(<?php echo $row['id']; ?>,1)" ><i class="entypo-star"></i>Optional</span>
                    <?php } ?>
                </td>
                <td><?php echo $row['last_update'];?></td>
                <td><?php if($row['status']==1){ ?>
                        <span class="label label-sm btn-green" onclick="section_status(<?php echo $row['id']; ?>,0)"><i class="entypo-star-empty"></i> Active</span>
                    <?php }else{ ?>
                        <span class="label label-sm btn-red" onclick="section_status(<?php echo $row['id']; ?>,1)" ><i class="entypo-star"></i> Inactive</span>
                    <?php } ?>
                </td>
            </tr>
        <?php }?>


        </tbody>
    </table>
</div>

</div>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_section_subject',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('section_subject/<?php echo $section["section_id"];?>')
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Added successfully. </span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>
<script>
    function section_status(id,status) {
        /*=======================================*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_section_subject_status',
            type:"POST",
            datatype:"json",
            data:{id:id,status:status},
            success: function(msg){
                loadview('section_subject/<?php echo $section["section_id"];?>')
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'> Updated successfully. </span><div>");

            },
            error: function () { alert("fail");
            }
        })
        /*=======================================*/
    }
    function subject_status(id,type) {
        /*=======================================*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_section_subject_status',
            type:"POST",
            datatype:"json",
            data:{id:id,type:type},
            success: function(msg){
                loadview('section_subject/<?php echo $section["section_id"];?>')
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'> Updated successfully. </span><div>");

            },
            error: function () { alert("fail");
            }
        })
        /*=======================================*/
    }
</script>





