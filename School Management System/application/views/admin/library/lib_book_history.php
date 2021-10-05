
<h1 class="page-title"> Library Book History</h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('lib_book_history/<?php echo $id;?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //echo "<pre>";?>
<?php //print_r($book);?>
<div class="guardian">
    <div class="col-sm-12">
        <table id="example">
            <thead>
            <tr>
                <th style="width:40px !important;">Code</th>
                <th>Name</th>
                <th>Author</th>
                <th>Student / Staff</th>
                <th style="width: 20%" >Date</th>
                <th style="width: 20%" >Return Date</th>
                <th style="width: 20%" >Late Fee</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($book as $row){?>
                <tr >
                    <td><?php echo $row['book_code'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['author'] ?></td>
                    <td>
                        <?php if($row['student_id']) { ?>
                        <?php  $stu= $this->admin_model->list_student_by_id($row['student_id']);echo($stu['student_name']);?>&nbsp;&nbsp;&nbsp;&nbsp; <span class="label label-sm btn-green" ><?php $class= $this->admin_model->class_by_id($stu['class']); echo $class['name'] ?> : <?php $section= $this->admin_model->section_by_id($stu['section']); echo $section['name']; ?>
                            <?php } ?>
                            <?php if($row['staff_id']){  ?>
                        <?php  $staff= $this->admin_model->list_employee_by_id( $row['staff_id']); echo($staff['name']); ?>&nbsp;&nbsp;&nbsp;&nbsp; <span class="label label-sm btn-red" ><?php echo($staff['designation']); ?></span>
                            <?php } ?>
                       </td>
                    <td style="width: 20%"><?php echo date("F jS, Y", strtotime($row['date_from']))  ?> - <?php echo date("F jS, Y", strtotime($row['date_to'] ))?></td>
                    <td style="width: 20%" ><?php echo date("F jS, Y", strtotime($row['return_date'])) ;  ?></td>
                    <td style="width: 20%" ><?php echo $row['late_fee'] ;  ?></td>

                </tr>
            <?php } ?>
            </tbody>

        </table>
        <!--==================================-->

    </div>
</div>
<!--=====================================-->
<script>
    function getStudent(value) {
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/library_students/'+value,
            success: function(msg){

                $('#student').html(msg);
            },
            error: function(){

                alert("fail");
            },

        });
    }
</script>
<!--to form submit upload image-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_issue_book_to_student',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> updated successfully. </span><div>");
                    loadview('all_book');
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


