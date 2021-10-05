<h1 class="page-title">Exam Time Table</h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('exam_time_table/<?php echo $allowed_class['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($section_subject_list); ?>
<div class="guardian">
    <div class="col-sm-10 col-sm-offset-1" >
    <!---------------------------->
    <table id="example" >
        <thead>
        <tr><th style="width:20px">Sn</th><th >Subjects</th><th >Paper</th><th >Exam Date</th><th style="width: 20%" >Exam Time</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php $sn=1;foreach ($section_subject_list as $row) { ?>
            <tr>
                <td style="width: 10%"><?php echo $sn++; ?></td>
                <td  ><?php $x=$this->admin_model->list_subjects_by_id($row['subject_id']);print_r($x['name']); ?></td>
                <td  ><?php $x=$this->admin_model->list_subject_option_by_id($row['paper_id']);print_r($x['name']); ?></td>
                <td  ><?php echo $row['exam_date'] ?></td>
                <td style="width: 20%"  ><?php echo date('h:ia', strtotime($row['start_time'])). " - " .date('h:ia', strtotime($row['end_time'])) ?></td>
                <td><button onclick="loadview('edit_subject_marks/<?php echo $row["id"];?>/<?php echo $allowed_class["id"];?>')"class="btn btn-success" ><i class="entypo-pencil"></i> Edit</button></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--=====================================-->
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
                url: '<?php echo base_url()?>index.php/admin/add_exam_allowed_section_subject',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    if(msg) {
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> One record inserted successfully. </span><div>");

                    }else{
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable to insert record . </span><div>");

                    }
                    loadview('subject_marks/<?php echo $allowed_class['id'];?>');
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

