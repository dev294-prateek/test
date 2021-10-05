<h1 class="page-title">All Expenditure </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_expanse')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($expanse);?>
<div class="guardian">
    <!--=====================================-->
    <div class="col-sm-12" style="overflow-x:auto;">
        <table id="example"  >
            <thead>
            <tr><th style="width: 20px"> Id </th><th >Type</th><th  >Amount</th><th >Date</th><th >Material</th><th >Use</th><th >Mode</th><th >Bill No</th><th >Action</th></tr>
            </thead>
            <tbody>
            <?php $sn=1;foreach ( $all_expanse as $row) { ?>
                <tr>

                    <td style="width: 20px" ><?php echo $sn++; ?></td>
                    <td  ><?php $x=$this->admin_model->list_expanse_by_id($row['exp_id']) ;  echo $x['name'] ?></td>
                    <td  ><?php echo $row['amt']?></td>
                    <td  ><?php echo date("F jS, Y", strtotime($row['date'])) ?></td>
                    <td  ><?php echo $row['material']?></td>
                    <td  ><?php echo $row['use']?></td>
                    <td  ><?php echo $row['p_mode']?></td>
                    <td  ><?php echo $row['bill_no']?></td>

                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a onclick="loadview('edit_expanse_detail/<?php  echo  $row['id'] ?>')"><i class="entypo-pencil"></i>  Edit </a> </li>

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
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_expanse_detail',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");
                    loadview('manage_expanse');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



