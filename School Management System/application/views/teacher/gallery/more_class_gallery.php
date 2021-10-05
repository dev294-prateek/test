<h1 class="page-title"> Add Image Galery </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('more_class_gallery')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<div class="col-sm-12" style="overflow-x:auto;">
    <table id="example"  >
        <thead>
        <tr><th style="width: 20px"> Id </th><th style="width: 30px">Image</th><th style="width: 30px">Title</th><th style="width: 30px">Description </th><th>Status</th><th style="width: 80px">Action</th></tr>
        </thead>
        <tbody>
        <?php foreach($gallery as $row){?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>
                    <img style="width:80px !important;"  class="guardian_img zoom" src="<?php echo base_url()?>/uploads/<?php echo $row['image']; ?>">
                    </td>
                 <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td style="width: 80px"><?php if($row['status']==1){ ?>
                        <span class="label label-sm btn-green" ><i class="entypo-star-empty"></i> Active</span>
                    <?php }else{ ?>
                        <span class="label label-sm btn-red" "><i class="entypo-star"></i> Inactive</span>
                    <?php } ?>
                </td>
                <td>
                    <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a   onclick="loadview('cl_image/<?php echo $row["id"]; ?>')"><i class="entypo-pencil"></i> Add More</a> </li>
                            <li><a   onclick="loadview('edit_class_gallery/<?php echo $row["id"]; ?>')"><i class="entypo-pencil"></i>  Edit </a> </li>

                        </ul>
                    </div>
                    <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
            </tr>

        <?php }?>
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


