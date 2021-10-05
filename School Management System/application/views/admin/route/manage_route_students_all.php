<style>
    .chhhh {
        margin-bottom: 10px;
    }
</style>
<h1 class="page-title" >SMS </h1>

<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('manage_route_students_all/<?php echo $route_id;?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<?php //print_r($students)?>
<div class="col-sm-12">

    <!---->

    <div class="col-sm-12">
        <div class="col-sm-6 col-sm-offset-3">
            <!-- <div id="subsmsg"></div>-->
            <div class="panel panel-success" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="entypo-plus-circled"></i>
                      Send Message To      <?php $xx =$this->admin_model->route_by_id($route_id); print_r($xx['name']);?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open_multipart('admin/send_all_student_route_sms',$data) ?>
                    <br>

                    <!--=====================================-->
                    <input type="hidden" name="route_id" class="form-control" value="<?php echo $route_id; ?>">
                    <label class="col-xs-12">Description :</label>
                    <textarea style="width: 100%" rows="10" name="sms"></textarea>
                    <div class="form-group">

                        <div class="col-xs-12">
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

</div>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/send_all_student_route_sms',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    alert(msg)
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Updated successfully. </span><div>");
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

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




