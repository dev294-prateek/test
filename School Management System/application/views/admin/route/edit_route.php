
<h1 class="page-title" > Route </h1>
<?php //print_r($student_sub_list); ?>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('edit_route/<?php echo $route['id'];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Add  Route
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/update_route',$data) ?>
            <br>
            <input type="hidden" class="form-control" name="id" value="<?php echo $route['id'];?>">
            <div class="form-group">

                <div class="col-xs-5">
                    <input type="text" class="form-control" name="name"  value="<?php echo $route['name'];?>">
                </div>
                <div class="col-xs-5">
                    <input type="text" class="form-control" name="url"  value="<?php echo $route['url'];?>">
                </div>
                <div class="col-xs-2">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>


            <?php echo form_close() ?>
        </div>

    </div>
    <!---->
</div>

</div>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_route',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    /*  alert(msg);*/
                    loadview('route');
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




