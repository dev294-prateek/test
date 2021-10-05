

<h1 class="page-title" >Update Subject </h1>
<?php //print_r($student_sub_list); ?>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('edit_subjects/<?php echo $subject['id'] ?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

 <div class="col-sm-6 col-sm-offset-3">
         <div class="panel panel-success" data-collapsed="0">
             <div class="panel-heading">
                 <div class="panel-title">
                     <i class="entypo-plus-circled"></i>
                     Update Subject
                 </div>
             </div>
             <div class="panel-body">
                 <?php $data = array('id'=>"fupForm")?>
                 <?php echo form_open_multipart('admin/update_subject_list',$data) ?>
                 <br>
                  <input type="hidden" name="id" value="<?php echo $subject['id'] ?>">
                 <div class="form-group">
                     <label class="col-xs-4">Subject</label>
                     <div class="col-xs-5">
                         <input type="text" class="form-control" name="name" value="<?php echo $subject['name'] ?>">
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


 </div>

<script>
    $(document).ready(function(e){
        $("#fupForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_subject_list',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('subjects');
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>updated successfully. </span><div>");
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




