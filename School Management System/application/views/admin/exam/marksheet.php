<style>
    th {
        text-align: center;
        border-right: 1px solid;
        vertical-align: middle !important;
    }
</style>

<?php //print_r($student); ?>
<h1 class="page-title" > Progress Reeport </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('marksheet')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>

<!--==================================-->
<div class="row">

    <div class="col-md-12" style="margin-bottom: 10px;">
        <!--=====================================-->
        <label class="col-xs-1">Class </label>
        <div class="col-xs-2">
            <select class="form-control" id="class_id" onchange="getSection(value)" >
                <option>select</option>
                <?php foreach($all_class as $row){ ?>
               <option value="<?php echo $row['class_id'];?>"<?php if($row['class_id']==$class)echo 'selected';?>><?php echo $row['name'];?></option>
                <?php }?>
            </select>
        </div>
        <!--=====================================-->
        <label class="col-xs-1">Section </label>
        <div class="col-xs-2">
            <select id="section" class="form-control" name="section_id"  onchange="getStudents(value)">
            </select>
        </div>
        <!--=====================================-->
        <label class="col-xs-1">Student </label>
        <div class="col-xs-3">
            <select id="students" class="form-control" name="students" onchange="getfeedata(value)">
            </select>
        </div>
        <!--=====================================-->
        <div class="col-xs-2"><a class="gold-bt float-r" onclick="printDiv('twelveth_fee')">Print</a></div>
        <hr>
    </div>

</div>
<?php if ($class){?>
    <?php  // print_r($attendance); ?>
    <?php // print_r($unit_exam); ?>
    <?php  //print_r($an_exam); ?>
    <?php // print_r($hf_exam); ?>

    <div class="col-sm-10 col-sm-offset-1">
        <table  class="table table-responsive">
            <tr> <th>Student's Name</th><td><?php echo $student['student_name']; ?></td> <th>Class & Section </th><td><?php echo $class;echo " ".$section; ?></td> </tr>
            <tr> <th> Date Of Birth</th><td><?php echo $student['birthday']; ?></td> <th> S-R Number </th><td><?php echo $student['admission_no']; ?></td> </tr>
            <tr> <th>Fathers'Name </th><td><?php echo $student['father']; ?></td> <th>Mothers' Name </th><td><?php echo $student['mother']; ?></td> </tr>
            <tr> <th>Class Teacher's Name </th><td><?php echo  $class_teacher  ; ?></td> <th>Mobile No </th><td><?php echo $student['mobile_no_for_sms']; ?></td> </tr>
            <tr> <th>Address </th><td colspan="3"><?php echo $student['resident_address1'];echo " ".$student['resident_address2'];echo " ".$student['resident_address2']; ?></td>  </tr>
        </table>
        <br>
        <table class="table table-responsive">
            <tbody>
            <tr><th style="width: 15%" rowspan="2">S.N.</th><th  rowspan="2" >Subject</th><th colspan="2">Monthly Test </th><th colspan="2">Half Yearly </th><th colspan="2">Anual </th><th colspan="2">Total</th></tr>
            <tr> <th>MaxMarks</th> <th>Obtained</th><th>MaxMarks</th> <th>Obtained</th><th>MaxMarks</th> <th>Obtained</th><th>MaxMarks</th> <th>Obtained</th> </tr>
            <?php $sn=1;$marks_total=0;$max_total=0;$marks_total_u=0;$max_total_u=0;$marks_total_h=0;$max_total_h=0;$marks_total_a=0;$max_total_a=0; foreach( $subjects as $row){ ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php $m =$this->admin_model->list_subjects_by_id($row['subject_id']);print_r($m['name']); ?></td>
                    <!--++++++++++++++++++++++++++-->
                    <?php if($unit_exam) {$l=sizeof($unit_exam); }?>
                    <?php $t_max_u=0;$t_marks_u=0; for($ex=0;$ex < $l;$ex++){ ?>
                        <?php $un =$this->admin_model->subject_mark_for_result($ex,$class_id,$section_id,$student_id,$row['subject_id']); ?>
                        <?php $max_u=0;$min_u=0;$marks_u=0;foreach($un as $col){$max_u +=$col['max'];$min_u +=$col['min'];$marks_u +=$col['marks'];}  ?>
                        <?php $t_max_u += $max_u; ?>
                        <?php $t_marks_u += $marks_u; ?>
                    <?php } ?>
                    <td><?php $t_max_u=round($t_max_u/$l); if( $t_max_u >0)echo $t_max_u; $max_total_u += $t_max_u; ?></td>
                    <td><?php $t_marks_u=round($t_marks_u/$l); if( $t_max_u >0) echo $t_marks_u;$marks_total_u+=$t_marks_u;  ?></td>
                    <!--++++++++++++++++++++++++++-->
                    <?php $hf =$this->admin_model->subject_mark_for_result($hf_exam,$class_id,$section_id,$student_id,$row['subject_id']); ?>
                    <?php $max_h=0;$min_h=0;$marks_h=0;foreach($hf as $col){$max_h +=$col['max'];$min_h +=$col['min'];$marks_h +=$col['marks'];}  ?>
                    <td><?php if( $max_h >0) echo $max_h;  $max_total_h += $max_h; ?></td>
                    <td><?php if( $max_h >0) echo $marks_h;  $marks_total_h += $marks_h;?></td>
                    <?php $an =$this->admin_model->subject_mark_for_result($an_exam,$class_id,$section_id,$student_id,$row['subject_id']); ?>
                    <?php $max_a=0;$min_a=0;$marks_a=0;foreach($an as $col){$max_a +=$col['max'];$min_a +=$col['min'];$marks_a +=$col['marks'];}  ?>
                    <td><?php if ($max_a >0)  echo $max_a; $max_total_a += $max_a; ?></td>
                    <td><?php if ($max_a >0)  echo $marks_a;  $marks_total_a += $marks_a; ?></td>
                    <td><?php $max= $max_h + $max_a+$t_max_u ; if ($max >0) echo $max; $max_total +=  $max; ?></td>
                    <td><?php $marks= $marks_h + $marks_a + $t_marks_u ;if ($max >0) echo $marks; $marks_total +=  $marks; ?></td>
                </tr>
            <?php } ?>
            <tr><td colspan="2" style="background-color: darkgoldenrod;color: white;text-align: center"> Grand Total</td>
                <td><?php echo $max_total_u;?></td><td><?php echo $marks_total_u;?></td>
                <td><?php echo $max_total_h;?></td><td><?php echo $marks_total_h;?></td>
                <td><?php echo $max_total_a;?></td><td><?php echo $marks_total_a;?></td>
                <td><?php echo $max_total;?></td><td><?php echo $marks_total;?></td>
            </tr>
            </tbody>
        </table>
        <div class="col-xs-12">
            <div class="col-xs-3">Percentage : <?php $per=round(($marks_total * 100 )/$max_total,2); echo  $per ." %";?>  </div>
            <div class="col-xs-3"> Position : </div>
            <div class="col-xs-3"> Rank :</div>
            <div class="col-xs-3"> Division  : <?php  if($per >=60){echo "I";}elseif($per >=45){echo "II";}elseif($per >=33){echo "III";}?></div>
        </div>
        <div class="col-xs-12">
            <?php $p=$a=$l=$t=0; foreach($attendance as $att){$t++; if($att['attendance']==1){$p++;}if($att['attendance']==2){$l++;}if($att['attendance']==3){$a++;}}?>
            <div class="col-xs-3">Total Working Day : <?php echo $t;?> Days  </div>
            <div class="col-xs-3"> Present : <?php  echo $p;?> Days ( <?php  echo round(($p/$t)*100,2);?> %)  </div>
            <div class="col-xs-3"> Absent :<?php  echo $a;?> Days ( <?php  echo round(($a/$t)*100,2);?> %)  </div>
            <div class="col-xs-3"> On leave : <?php  echo $l;?> Days ( <?php  echo round(($l/$t)*100,2);?> %)  </div>
        </div>
        <div class="col-xs-12">
            <?php $pun=$tot=$cle=$atten=$han=$int=$hom=$cla=0; foreach($attendance as $att){$tot=$tot+10;

                         $pun +=$att['punctuality'];
                          $cle +=$att['cleanliness'];
                         $atten +=$att['attentiveness'];
                          $han +=$att['handwriting'];
                          $int +=$att['interactive'];
                          $hom +=$att['homework'];
                          $cla +=$att['classwork'];
            }?>

            <div class="col-xs-3">Punctuality : <?php echo round(($pun/$tot)*100,2); ?> %</div>
            <div class="col-xs-3">Cleanliness : <?php echo round(($cle/$tot)*100,2); ?> %</div>
            <div class="col-xs-3">Attentiveness : <?php echo round(($atten/$tot)*100,2); ?> % </div>
            <div class="col-xs-3">Handwriting : <?php echo round(($han/$tot)*100,2); ?> % </div>
            <div class="col-xs-3">Interactiveness : <?php echo round(($int/$tot)*100,2); ?> %</div>
            <div class="col-xs-3">Home Work :  <?php echo round(($hom/$tot)*100,2); ?> %</div>
            <div class="col-xs-3">Class Work : <?php echo round(($cla/$tot)*100,2); ?> %</div>
        </div>
    </div>
    <!--=======================================================================================================-->
    <div  id="twelveth_fee" style="display: none">
        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
        <br> <br>
        <div class="col-xs-12" style="margin-bottom: 20px">
            <div class="col-xs-10">
                <h2 style="text-align: center"><?php echo ($_SESSION['school_name']); ?></h2>
                <h3 style="text-align: center"><?php echo ($_SESSION['address']); ?></h3>
                <h4 style="text-align: center"> ( <?php echo ($_SESSION['running_year']); ?> ) </h4>
            </div>
            <div class="col-xs-2">
                <img style="width:100px;float: right" id="image_logo" src="<?php echo base_url() ?>uploads/<?php echo ($_SESSION['logo']); ?>"alt="logo"/>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-2">Student's Name</div><div class="col-xs-4"><?php echo $student['student_name']; ?></div><div class="col-xs-2">Class & Section</div><div class="col-xs-4"><?php echo $class;echo " ".$section; ?></div>
            <div class="col-xs-2">Date Of Birth</div><div class="col-xs-4"><?php echo $student['birthday']; ?></div><div class="col-xs-2"> S-R Number </div><div class="col-xs-4"><?php echo $student['admission_no']; ?></div>
            <div class="col-xs-2">Fathers'Name</div><div class="col-xs-4"><?php echo $student['father']; ?></div><div class="col-xs-2">Mothers' Name</div><div class="col-xs-4"><?php echo $student['mother']; ?></div>
            <div class="col-xs-2">Class Teacher</div><div class="col-xs-4"><?php echo  $class_teacher  ; ?></div><div class="col-xs-2">Mobile No</div><div class="col-xs-4"><?php echo $student['mobile_no_for_sms']; ?></div>
            <div class="col-xs-2">Address </div><div class="col-xs-10"><?php echo $student['resident_address1'];echo " ".$student['resident_address2'];echo " ".$student['resident_address2']; ?></div>

        </div>
        <div class="col-xs-12">
            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>
            <!--============================-->
            <table class="table table-responsive">
                <tbody>
                <tr><td style="width: 15%" rowspan="2">S.N.</td><td  rowspan="2" >Subject</td><td colspan="2">Monthly Test </td><td colspan="2">Half Yearly </td><td colspan="2">Anual </td><td colspan="2">Total</td></tr>
                <tr> <td>MaxMarks</td> <td>Obtained</td><td>MaxMarks</td> <td>Obtained</td><td>MaxMarks</td> <td>Obtained</td><td>MaxMarks</td> <td>Obtained</td> </tr>
                <?php $sn=1;$marks_total=0;$max_total=0;$marks_total_u=0;$max_total_u=0;$marks_total_h=0;$max_total_h=0;$marks_total_a=0;$max_total_a=0; foreach( $subjects as $row){ ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php $m =$this->admin_model->list_subjects_by_id($row['subject_id']);print_r($m['name']); ?></td>
                        <!--++++++++++++++++++++++++++-->
                        <?php if($unit_exam) {$l=sizeof($unit_exam); }?>
                        <?php $t_max_u=0;$t_marks_u=0; for($ex=0;$ex < $l;$ex++){ ?>
                            <?php $un =$this->admin_model->subject_mark_for_result($ex,$class_id,$section_id,$student_id,$row['subject_id']); ?>
                            <?php $max_u=0;$min_u=0;$marks_u=0;foreach($un as $col){$max_u +=$col['max'];$min_u +=$col['min'];$marks_u +=$col['marks'];}  ?>
                            <?php $t_max_u += $max_u; ?>
                            <?php $t_marks_u += $marks_u; ?>
                        <?php } ?>
                        <td><?php $t_max_u=round($t_max_u/$l); if( $t_max_u >0)echo $t_max_u; $max_total_u += $t_max_u; ?></td>
                        <td><?php $t_marks_u=round($t_marks_u/$l); if( $t_max_u >0) echo $t_marks_u;$marks_total_u+=$t_marks_u;  ?></td>
                        <!--++++++++++++++++++++++++++-->
                        <?php $hf =$this->admin_model->subject_mark_for_result($hf_exam,$class_id,$section_id,$student_id,$row['subject_id']); ?>
                        <?php $max_h=0;$min_h=0;$marks_h=0;foreach($hf as $col){$max_h +=$col['max'];$min_h +=$col['min'];$marks_h +=$col['marks'];}  ?>
                        <td><?php if( $max_h >0) echo $max_h;  $max_total_h += $max_h; ?></td>
                        <td><?php if( $max_h >0) echo $marks_h;  $marks_total_h += $marks_h;?></td>
                        <?php $an =$this->admin_model->subject_mark_for_result($an_exam,$class_id,$section_id,$student_id,$row['subject_id']); ?>
                        <?php $max_a=0;$min_a=0;$marks_a=0;foreach($an as $col){$max_a +=$col['max'];$min_a +=$col['min'];$marks_a +=$col['marks'];}  ?>
                        <td><?php if ($max_a >0)  echo $max_a; $max_total_a += $max_a; ?></td>
                        <td><?php if ($max_a >0)  echo $marks_a;  $marks_total_a += $marks_a; ?></td>
                        <td><?php $max= $max_h + $max_a+$t_max_u ; if ($max >0) echo $max; $max_total +=  $max; ?></td>
                        <td><?php $marks= $marks_h + $marks_a + $t_marks_u ;if ($max >0) echo $marks; $marks_total +=  $marks; ?></td>
                    </tr>
                <?php } ?>
                <tr><td colspan="2" style="background-color: darkgoldenrod;color: white;text-align: center"> Grand Total</td>
                    <td><?php echo $max_total_u;?></td><td><?php echo $marks_total_u;?></td>
                    <td><?php echo $max_total_h;?></td><td><?php echo $marks_total_h;?></td>
                    <td><?php echo $max_total_a;?></td><td><?php echo $marks_total_a;?></td>
                    <td><?php echo $max_total;?></td><td><?php echo $marks_total;?></td>
                </tr>
                </tbody>
            </table>
            <!--============================-->
            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>
            <div class="col-xs-12">
                <div class="col-xs-3">Percentage : <?php $per=round(($marks_total * 100 )/$max_total,2); echo  $per ." %";?>  </div>
                <div class="col-xs-3"> Position : </div>
                <div class="col-xs-3"> Rank :</div>
                <div class="col-xs-3"> Division  : <?php  if($per >=60){echo "I";}elseif($per >=45){echo "II";}elseif($per >=33){echo "III";}?></div>
            </div>
            <div class="col-xs-12">
                <?php $p=$a=$l=$t=0; foreach($attendance as $att){$t++; if($att['attendance']==1){$p++;}if($att['attendance']==2){$l++;}if($att['attendance']==3){$a++;}}?>
                <div class="col-xs-3">Total Day : <?php echo $t;?> D  </div>
                <div class="col-xs-3"> Present : <?php  echo $p;?> D ( <?php  echo round(($p/$t)*100,2);?> %)  </div>
                <div class="col-xs-3"> Absent :<?php  echo $a;?> D ( <?php  echo round(($a/$t)*100,2);?> %)  </div>
                <div class="col-xs-3"> On leave : <?php  echo $l;?> D ( <?php  echo round(($l/$t)*100,2);?> %)  </div>
            </div>
            <div class="col-xs-12">
                <?php $pun=$tot=$cle=$atten=$han=$int=$hom=$cla=0; foreach($attendance as $att){$tot=$tot+10;

                    $pun +=$att['punctuality'];
                    $cle +=$att['cleanliness'];
                    $atten +=$att['attentiveness'];
                    $han +=$att['handwriting'];
                    $int +=$att['interactive'];
                    $hom +=$att['homework'];
                    $cla +=$att['classwork'];
                }?>

                <div class="col-xs-3">Punctuality : <?php echo round(($pun/$tot)*100,2); ?> %</div>
                <div class="col-xs-3">Cleanliness : <?php echo round(($cle/$tot)*100,2); ?> %</div>
                <div class="col-xs-3">Attentiveness : <?php echo round(($atten/$tot)*100,2); ?> % </div>
                <div class="col-xs-3">Handwriting : <?php echo round(($han/$tot)*100,2); ?> % </div>
                <div class="col-xs-3">Interactiveness : <?php echo round(($int/$tot)*100,2); ?> %</div>
                <div class="col-xs-3">Home Work :  <?php echo round(($hom/$tot)*100,2); ?> %</div>
                <div class="col-xs-3">Class Work : <?php echo round(($cla/$tot)*100,2); ?> %</div>
            </div>
            <br><br>
            <br><br>
            <br><br>
            <div class="col-xs-4"><h4 style="text-align: center">Class Teacher</h4></div>
            <div class="col-xs-4"><h4 style="text-align: center">Principal</h4></div>
            <div class="col-xs-4"><h4 style="text-align: center">Parent/Guardian</h4></div>
        </div>
        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
    </div>
    <!--=======================================================================================================-->

<?php }?>

<script>
    function getfeedata(st_id) {
        var c_id= $('#class_id').val();
        var s_id= $('#section').val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/list_student_by_class_section_id',
            type:"POST",
            datatype:"json",
            data:{c_id:c_id,s_id:s_id,st_id},
            success: function (msg) {
                loadview('marksheet/'+c_id+'/'+s_id+'/'+st_id);
            },
            error: function () { alert("fail");
            }
        })
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>
<script>
    function getStudents(s_id) {
        var c_id= $('#class_id').val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/list_student_by_class_section_id',
            type:"POST",
            datatype:"json",
            data:{c_id:c_id,s_id:s_id},
            success: function (msg) {
                $('#students').html(msg);
            },
            error: function () { alert("fail");
            }
        })
    }
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>
<script>
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


<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>