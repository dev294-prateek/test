<h1 class="page-title">Day Wise Expenditure </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('day_expanse')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($expanse);?>
<div class="guardian">
    <!--=====================================-->
    <div class="col-sm-12">
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Date :</label>
        <div class="col-sm-4" style="margin-bottom: 10px">
            <input type="date" id="date" class="form-control"  onchange="getdata(value)" >

        </div>
        <div class="col-sm-4 col-sm-offset-3"><span class="bladge"><?php echo date("F jS, Y", strtotime($day)) ?></span> </div>
    </div>
    <div class="col-sm-12" style="overflow-x:auto;">
        <table  class="table table-bordered"  >
            <thead>
            <tr><th style="width: 20px"> Id </th><th >Type</th><th  >Amount</th><th >Date</th><th >Material</th><th >Use</th><th >Mode</th><th >Bill No</th></tr>
            </thead>
            <tbody>
            <?php $am=0;$sn=1;foreach ( $all_expanse as $row) { ?>
                <tr>

                    <td style="width: 20px" ><?php echo $sn++; ?></td>
                    <td  ><?php $x=$this->admin_model->list_expanse_by_id($row['exp_id']) ;  echo $x['name'] ?></td>
                    <td  ><?php $am+=$row['amt']; echo $row['amt']?></td>
                    <td  ><?php echo date("F jS, Y", strtotime($row['date'])) ?></td>
                    <td  ><?php echo $row['material']?></td>
                    <td  ><?php echo $row['use']?></td>
                    <td  ><?php echo $row['p_mode']?></td>
                    <td  ><?php echo $row['bill_no']?></td>

                </tr>
            <?php }?>
               <tr><th colspan="2">Total</th><td colspan="6"><?php echo $am?></td></tr>

            </tbody>
        </table>
    </div>
    <!--=====================================-->

</div>


<!--=====================================-->


<script>
    function getdata(x) {
        var y= 'day_expanse'+'/'+x;
         loadview(y);
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>



