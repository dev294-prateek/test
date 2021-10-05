<h1 class="page-title" > Section Syllabus </h1>
<?php // print_r($section); ?>
<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('section_syllabus/<?php echo $section["section_id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Add  Subject
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/update_section_syllabus',$data) ?>
            <br>
            <input type="hidden" value="<?php echo $section['section_id'] ?>" name="section_id">
            <div class="form-group">
                <label class="col-xs-4">Syllabus</label>
                <div class="col-xs-5">
                    <input type="file" name="syllabus" id="syllabus">
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


<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_section_syllabus',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('section_syllabus/<?php echo $section["section_id"];?>')
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Added successfully. </span><div>");

                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>






