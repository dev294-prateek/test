
<h1 class="page-title"> Monthly Attendance Analysis </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('attendance_analysis')">Page Refresh</a></h6>
<hr>
<!--=====================================-->
<div style="<?php if($year) {echo 'display:none';} ?>">
<div class="col-xs-12" style="border: 1px solid white;">
        <!--=====================================-->
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px;display: none">Class :</label>
        <div class="col-sm-2 col-xs-8" style="margin-bottom: 10px;display: none">
            <select class="form-control" id="class" onChange="getSection(value);">
                <option value="">select</option>
                <?php foreach($class as $row){ ?>
                    <option value="<?php echo $row['class_id'];?>" <?php if($cl==$row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                <?php }?>
            </select>
        </div>
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px;display: none">Section :</label>
        <div class="col-sm-2 col-xs-8" style="margin-bottom: 10px;display: none">
            <select id="section" class="form-control" >
                <option value="<?php echo $sec;?>"><?php $x=$this->admin_model->section_by_id($sec); echo $x['name'];?></option>
            </select>
        </div>
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Date :</label>
        <div class="col-sm-2 col-xs-8" style="margin-bottom: 10px">
            <select id="month" class="form-control"  onchange="getdata(value)">
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
</div>
<!--=====================================-->
<?php if($year) { ?>
<div class="col-sm-8 col-sm-offset-2">
    <div class="edate " style="text-align: center" >
         <span style="color: red">class</span> : <?php $xy=$this->admin_model->class_by_id($cl); echo $xy['name'];?>
        <span style="color: red">Section</span> : <?php echo $x['name'];?>
        <span style="color: red">Month</span> :<?php echo date('F', mktime(0, 0, 0,  $month, 10));?>
    </div>
</div>
<?php } ?>
<!--=====================================-->

<div class="col-sm-8 col-sm-offset-2">
    <!---->
    <?php if($year) { ?>
    <div id="table-scroll" class="table-scroll">
        <div class="table-wrap">
            <table class="main-table">
                <thead>
                <tr>
                    <th class="fixed-side" scope="col" style="width: 20px">S.N</th>
                    <th class="fixed-side" scope="col">Name</th>
                    <th colspan="2">Present</th>
                    <th colspan="2">Absent</th>
                    <th>On leave</th>
                    <th>Holidays</th>
                    <th>Working Day</th>
                    <th>Total Day </th>
                    <?php
                    $day=cal_days_in_month(CAL_GREGORIAN,$month,$year);


                    ?>
                </tr>
                </thead>
                <tbody>
                <?php $s=1; ?>
                <?php foreach($students as $row){?>
                <tr>
                    <th class="fixed" style="width: 20px;"><?php echo $s++; ?> <i class="entypo-right-dir"></i></th>
                    <th class="fixed-side fixed" ><?php $x=$this->admin_model->student_name($row['student_id']); echo $x ?>
                    </th>
                  <?php
                  $t=$p=$l=$a=0;
                  for($d=1; $d<=$day; $d++){
                      $att=$this->admin_model->get_attendance_individual($cl,$sec,$row['student_id'],$d,$month,$year);
                      $t++;
                      if($att==1){$p++;}
                      elseif($att==2){$l++;}
                      elseif($att==3){$a++;}

                  } ?>
                    <td><?php echo $p  ?></td>
                    <td><?php echo number_format($p/($p+$a)*100, 2, '.', '') ?> <span style="color: red">%</span></td>
                    <td><?php echo $a ?></td>
                    <td><?php echo number_format($a/($p+$a)*100, 2, '.', '') ?> <span style="color: red">%</span></td>
                    <td><?php echo $l ?></td>
                    <td><?php echo $t-($p+$a+$l) ?></td>
                    <td><?php echo ($p+$a) ?></td>
                    <td><?php echo $t ?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>

    <?php } ?>
    <!---->

</div>
<!--=====================================-->
<script>
    jQuery(document).ready(function() {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
</script>
<script>
    function getdata(month) {
       var cl = $("#class").val();
       var sec = $("#section").val();
       loadview('attendance_analysis/'+cl+'/'+sec+'/'+month);
    }


</script>

<!--to form submit upload image-->

<script>
    $(document).ready(function () {
        $('#message').delay(4000).fadeOut();
    });
    function getSection(value){
        var msg='<option>Select</option>';
        /*----------------------*/
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/section_by_class_id/'+value,
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


