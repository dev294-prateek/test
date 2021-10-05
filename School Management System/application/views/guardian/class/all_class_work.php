<h1 class="page-title"> All Class Work </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_class_work')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<?php //print_r($class_work) ?>
<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
<table id="example"  >
    <thead>
    <tr><th style="width: 20px"> Id </th><th style="width: 30px">Class</th><th style="width: 30px">Section</th><th style="width: 80px" >Subject</th><th>Date</th><th>Title</th><th>Description</th><th>Attachment</th><th style="width: 80px">Action</th></tr>
    </thead>
    <tbody>
    <?php foreach ( $class_work as $row) { ?>
        <?php
        $class=$this->guardian_model->class_by_id($row['class_id']); $class=$class['name'];
        $section=$this->guardian_model->section_by_id($row['section_id']); $section=$section['name'];
        $subject=$this->guardian_model->list_subjects_by_id($row['subject_id']); $subject=$subject['name'];

        ?>
    <tr>
        <td style="width: 20px" ><?php echo $row['id']?></td>
        <td style="width: 20px" ><?php echo $class; ?></td>
        <td style="width: 20px" ><?php echo $section; ?></td>
        <td style="width: 20px" ><?php echo  $subject; ?></td>
        <td style="width: 20px" ><?php echo $row['date']?></td>
        <td style="width: 20px" ><?php echo $row['title']?></td>
        <td style="width: 20px" ><?php echo $row['description']?></td>
        <td style="width: 20px" ><a class="gold-bt" href="<?php echo base_url() ?>/uploads/<?php echo $row['attachment']?>" target="_blank">Attachment</a></td>
        <td style="width:80px"><a class="gold-bt" onclick="loadview('edit_class_work/<?php echo $row['id']; ?>')"><i class="entypo-pencil"></i>  <span class="hidden-xs">Edit</span></a></td>

    </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<!--=====================================-->
<script>
    function getdata() {
       var cl = $("#class").val();
       var sec = $("#section").val();
       loadview('all_period/'+cl+'/'+sec);

    }
</script>
<!--to form submit upload image-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function change_status(id,status) {
        if(status==1){status=0;}else {status=1;}

        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/change_period_status',
            type:"POST",
            datatype:"json",
            data:{id:id,status:status},
            success: function (msg) {
                /*  alert(msg)*/
                if(msg==1) {
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Updated successfully.  </span><div>");
                }else{
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> Unable Update . </span><div>");
                }
                loadview('all_period');
            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })



    }
</script>
<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
    function getSection(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/teacher/section_by_class_id/'+value,
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


