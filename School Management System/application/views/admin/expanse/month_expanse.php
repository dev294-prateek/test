<h1 class="page-title">Month Expenditure </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('month_expanse')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($expanse);?>
<div class="guardian">
    <!--=====================================-->
    <div class="col-sm-12">
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Date :</label>
        <div class="col-sm-3 col-xs-8" style="margin-bottom: 10px">
            <select id="month" class="form-control"  onchange="getdata(value)">
                <option > Select </option>
                <option value="1" <?php if($month==1){echo "selected";}?>> January </option>
                <option value="2" <?php if($month==2){echo "selected";}?>> February  </option>
                <option value="3" <?php if($month==3){echo "selected";}?>> March </option>
                <option value="4" <?php if($month==4){echo "selected";}?>> April </option>
                <option value="5" <?php if($month==5){echo "selected";}?>> May  </option>
                <option value="6" <?php if($month==6){echo "selected";}?>> June </option>
                <option value="7" <?php if($month==7){echo "selected";}?>> July </option>
                <option value="8" <?php if($month==8){echo "selected";}?>> August  </option>
                <option value="9" <?php if($month==9){echo "selected";}?>> September</option>
                <option value="10" <?php if($month==10){echo "selected";}?>> October  </option>
                <option value="11" <?php if($month==11){echo "selected";}?>> November  </option>
                <option value="12" <?php if($month==12){echo "selected";}?>> December  </option>
            </select>

        </div>
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
        var y= 'month_expanse'+'/'+x;
         loadview(y);
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>



