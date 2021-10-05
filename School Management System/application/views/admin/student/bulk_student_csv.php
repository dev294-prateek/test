<style>
    th{width: 16%!important;}
</style>
<h1 class="page-title"> Admit Bulk Student </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('bulk_student_csv')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<!--=====================================-->
<div class="guardian">    <hr>
    <div class="col-xs-6">
    
        <!--==================================================================================================-->
        <?php $data = array('id'=>"fupForm", 'enctype'=>"multipart/form-data")?>
        <?php echo form_open_multipart('admin/bulk_student_csv_import',$data) ?>
            <div class="form-group">
                <label>Select CSV File</label>
                <input type="file" name="csv_file" id="csv_file" required accept=".csv" />
            </div>
            <br />
            <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
        <?php echo form_close() ?>
       
       
        <!--==================================================================================================-->

    </div>
    <div class="col-xs-6"> <a style="float:right"  class="btn btn-info"  href="<?php echo base_url(); ?>/assets/download/student.xlsx" >Download CSV </a></div>
</div><!--=====================================-->

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/bulk_student_csv_import',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                  $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'> Imported Successfully</span><div>");

                    loadview('all_student');

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



