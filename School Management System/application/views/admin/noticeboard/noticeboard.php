<h1 class="page-title">Edit Noticeboard </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('noticeboard')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
<div class="guardian">
    <div class="col-sm-6 col-sm-offset-3">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Class Work
                </div>
            </div>

            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_noticeboard',$data) ?>
                <br>

                <!--=====================================-->
                <label class="col-xs-12">Title :</label>
                <input type="text" name="title" class="form-control">
                <label class="col-xs-12">Description :</label>
                <textarea style="width: 100%" rows="10" name="notice"></textarea>
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
    <!--=====================================-->
    <div class="col-sm-12" style="overflow-x:auto;">
        <table id="example"  >
            <thead>
            <tr><th style="width: 20px"> Id </th><th style="width: 15%">Title</th><th style="width: 60%" >Notice</th><th style="width: 15%" >Date</th><th style="width: 80px">Action</th></tr>
            </thead>
            <tbody>
            <?php $sn=1;foreach ( $all_notice as $row) { ?>
                <tr>
                    <td style="width: 20px" ><?php echo $sn++; ?></td>
                    <td style="width: 15%" ><?php echo $row['title']?></td>
                    <td style="width: 60%" ><?php echo $row['notice']?></td>
                    <td style="width: 15%" ><?php echo date("F jS, Y", strtotime($row['date'])) ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a onclick="loadview('edit_noticeboard/<?php  echo  $row['id'] ?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                                <li><a onclick="del(<?php  echo  $row['id'] ?>)"><i class="entypo-doc-text-inv"></i>Delete</a></li>
                            </ul>
                        </div>
                        <!---->
                    </td>


                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    <!--=====================================-->
</div>


<!--=====================================-->
<script>
    function del(id){
     /*   alert(id);*/
     var x=   confirm("Are You Sure  ?");
     if(x==true){
         $.ajax({
             url: 'https://ezedu.tech/RRSGS-AMTI-01/index.php/admin/delete_noticeboard',
             type:"POST",
             datatype:"json",
             data:{id:id},
             success: function (msg) {
                 $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Deleted Successfully <div>");
                 loadview('noticeboard');
                 },
             error: function () { alert("fail");
             }
         })
     }else{
     }

    }
</script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_noticeboard',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");
                    loadview('noticeboard');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



