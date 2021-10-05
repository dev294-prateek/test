<style>
    .fee_title{text-align: center;color: darkgoldenrod;}
    .total{background-color: darkgoldenrod; color: white;text-align: center}
    input.btn.btn-success {
        padding: 4px 56px;
    }
</style>

<h1 class="page-title" >Pay Student Fee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('pay_student_fee')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<?php //print_r($_SESSION); ?>

<!--==================================-->
<div class="row">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <!--=====================================-->
        <label class="col-xs-1">Class </label>
        <div class="col-xs-3">
            <select class="form-control" id="class_id" onchange="getSection(value)" >
                <option>select</option>
                <?php foreach($all_class as $row){ ?>
                    <option value="<?php echo $row['class_id'];?>"<?php if($row['class_id']==$class)echo 'selected';?>><?php echo $row['name'];?></option>
                <?php }?>
            </select>
        </div>
        <!--=====================================-->
        <label class="col-xs-1">Section </label>
        <div class="col-xs-3">
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
        <hr>
    </div>

</div>

<?php if ($class){?>
    <div class="co-xs-10">
             <div class="panel panel-success" data-collapsed="0">
        <table class="table"><tr><td style="text-align: center">
                    Student : <span style="color: red"><?php  echo $student ; ?></span>
                    Class : <span style="color: red"><?php  echo $class ; ?></span>
                    Section : <span style="color: red"><?php  echo $section ; ?></span>

                </td></tr></table>

    </div>
    <?php $first_m=$this->admin_model->get_setting_start_month() ?>
    <!--========================================== First Month ===============================================-->
 <div class="col-sm-12">
     <div class="panel panel-success" data-collapsed="0">
         <div class="panel-heading">
             <div class="panel-title">
                 <i class="entypo-plus-circled"></i>
                 <?php  $monthName = date('F', mktime(0, 0, 0, $first_m, 10)); echo  $monthName;?>
             </div>
         </div>
         <div class="panel-body">
             <div class="col-sm-8">
                 <table class="table table-condensed">
                     <?php $amt1=0; $sn=1;foreach ($section_fee_first as $row){?>
                         <tr>
                             <td ><?php echo $sn++;?></td>
                             <td ><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></td>
                             <td><?php echo $row['amount']; $amt1 += $row['amount']; ?></td>
                         </tr>
                     <?php }?>
                     <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt1; ?></td></tr>
                 </table>
             </div>


             <div class="col-sm-4">
                 <?php $pay1=$this->admin_model->get_student_fee_of_month($section_id,$student_id,1); ?>
                 <?php if ($pay1){ ?>
                     <!------------------------------------------------------------->
                 <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay1['amount'];?>  </label> </div>
                 <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay1['discount'];?>  </label></div>
                 <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay1['payable'];?>  </label></div>
                 <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay1['date'];?>  </label></div>
                     <a class="gold-bt"  onclick="printDiv('first_fee')">Print</a>
                 <div  id="first_fee" style="display: none">
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
                          <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                          <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                          <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                      </div>
                     <div class="col-xs-12">
                         <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                         <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                         <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                     </div>
                     <div class="col-xs-12">
                         <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                             <?php $amt_1=0; $sn=1;foreach ($section_fee_first as $row){?>
                                 <div class="col-xs-5 col-xs-offset-5"><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></div>
                                 <div class="col-xs-2"><?php echo $row['amount']; $amt_1 += $row['amount']; ?></div>
                             <?php }?>
                         <hr>
                         <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                         <div class="col-xs-5  col-xs-offset-5"> Total</div>
                         <div class="col-xs-2"> <?php echo $amt_1; ?></div>
                         <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                         <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay1['amount'];?> </div>
                         <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay1['discount'];?> </div>
                         <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                         <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay1['payable'];?> </div>
                         <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                         <?php $timestamp = $pay1['date'];  ?>
                         <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                         <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                         <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                         <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                     </div>
                     <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                 </div>
                     <!------------------------------------------------------------->
                 <?php }else{ ?>
                 <?php $data = array('id'=>"fupForm")?>
                 <?php echo form_open('admin/add_class_work_data',$data) ?>
                 <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                 <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                 <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                 <input type="hidden" name="amount" id="amount1" value="<?php echo $amt1 ; ?>">
                 <input type="hidden" name="month_no" value="1">
                 <div class="form-group">
                     <label class="col-xs-3">Discount </label>
                     <div class="col-xs-9">
                         <input  type="number" class="form-control " name="discount" id="discount1" onblur="getpaysub1()" value="0" >
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-xs-3">Payable </label>
                     <div class="col-xs-9">
                         <input type="number" class="form-control" name="payable" id="payable1" value="<?php echo $amt1 ; ?>" readonly>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-xs-3"></label>
                     <div class="col-xs-9">
                         <input class="btn btn-success" type="submit" value="Pay" id="send">
                     </div>
                 </div>
                 <?php  echo form_close(); ?>
                 <?php }  ?>
             </div>
         </div>
     </div>
 </div>
    <!--========================================== Second Month ===============================================-->
    <div class="col-sm-12">
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                                   <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+1, 10)); echo  $monthName;?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <table class="table table-condensed">
                        <?php $amt2=0; $sn=1;foreach ($section_fee_middle as $row){?>
                            <tr>
                                <td ><?php echo $sn++;?></td>
                                <td ><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></td>
                                <td><?php echo $row['amount']; $amt2 += $row['amount']; ?></td>
                            </tr>
                        <?php }?>
                        <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt2; ?></td></tr>
                    </table>
                </div>


                <div class="col-sm-4">
                    <?php $pay2=$this->admin_model->get_student_fee_of_month($section_id,$student_id,2); ?>
                    <?php if ($pay2){ ?>
                        <!------------------------------------------------------------->
                        <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay2['amount'];?>  </label> </div>
                        <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay2['discount'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay2['payable'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay2['date'];?>  </label></div>
                        <a class="gold-bt"  onclick="printDiv('second_fee')">Print</a>
                        <div  id="second_fee" style="display: none">
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
                                <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                            </div>
                            <div class="col-xs-12">
                                <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                                <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                                <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                            </div>
                            <div class="col-xs-12">
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                                <?php $amt_2=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                    <div class="col-xs-5 col-xs-offset-5"><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></div>
                                    <div class="col-xs-2"><?php echo $row['amount']; $amt_2 += $row['amount']; ?></div>
                                <?php }?>
                                <hr>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5  col-xs-offset-5"> Total</div>
                                <div class="col-xs-2"> <?php echo $amt_2; ?></div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay2['amount'];?> </div>
                                <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay2['discount'];?> </div>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay2['payable'];?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <?php $timestamp = $pay2['date'];  ?>
                                <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <br><br>
                                <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                                <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                            </div>
                            <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                        </div>
                        <!------------------------------------------------------------->
                    <?php }else{ ?>
                        <?php $data = array('id'=>"fupForm")?>
                        <?php echo form_open('admin/add_class_work_data',$data) ?>
                        <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                        <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                        <input type="hidden" name="amount" id="amount2" value="<?php echo $amt2 ; ?>">
                        <input type="hidden" name="month_no" value="2">
                        <div class="form-group">
                            <label class="col-xs-3">Discount </label>
                            <div class="col-xs-9">
                                <input  type="number" class="form-control " name="discount" id="discount2" onblur="getpaysub2()" value="0" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3">Payable </label>
                            <div class="col-xs-9">
                                <input type="number" class="form-control" name="payable" id="payable2" value="<?php echo $amt2 ; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3"></label>
                            <div class="col-xs-9">
                                <input class="btn btn-success" type="submit" value="Pay" id="send">
                            </div>
                        </div>
                        <?php  echo form_close(); ?>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
    <!--========================================== Third Month ===============================================-->
    <div class="col-sm-12">
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                                  <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+2, 10)); echo  $monthName;?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <table class="table table-condensed">
                        <?php $amt3=0; $sn=1;foreach ($section_fee_middle as $row){?>
                            <tr>
                                <td ><?php echo $sn++;?></td>
                                <td ><?php $x3=$this->admin_model->fee_by_id($row['fee_id']);print_r($x3['name']); ?></td>
                                <td><?php echo $row['amount']; $amt3 += $row['amount']; ?></td>
                            </tr>
                        <?php }?>
                        <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt3; ?></td></tr>
                    </table>
                </div>


                <div class="col-sm-4">
                    <?php $pay3=$this->admin_model->get_student_fee_of_month($section_id,$student_id,3); ?>
                    <?php if ($pay3){ ?>
                        <!------------------------------------------------------------->
                        <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay3['amount'];?>  </label> </div>
                        <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay3['discount'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay3['payable'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay3['date'];?>  </label></div>
                        <a class="gold-bt"  onclick="printDiv('third_fee')">Print</a>
                        <div  id="third_fee" style="display: none">
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
                                <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                            </div>
                            <div class="col-xs-12">
                                <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                                <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                                <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                            </div>
                            <div class="col-xs-12">
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                                <?php $amt_3=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                    <div class="col-xs-5 col-xs-offset-5"><?php $x3=$this->admin_model->fee_by_id($row['fee_id']);print_r($x3['name']); ?></div>
                                    <div class="col-xs-2"><?php echo $row['amount']; $amt_3 += $row['amount']; ?></div>
                                <?php }?>
                                <hr>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5  col-xs-offset-5"> Total</div>
                                <div class="col-xs-2"> <?php echo $amt_3; ?></div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay3['amount'];?> </div>
                                <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay3['discount'];?> </div>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay3['payable'];?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <?php $timestamp = $pay3['date'];  ?>
                                <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <br><br>
                                <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                                <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                            </div>
                            <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                        </div>
                        <!------------------------------------------------------------->
                    <?php }else{ ?>
                        <?php $data = array('id'=>"fupForm")?>
                        <?php echo form_open('admin/add_class_work_data',$data) ?>
                        <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                        <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                        <input type="hidden" name="amount" id="amount3" value="<?php echo $amt3 ; ?>">
                        <input type="hidden" name="month_no" value="3">
                        <div class="form-group">
                            <label class="col-xs-3">Discount </label>
                            <div class="col-xs-9">
                                <input  type="number" class="form-control " name="discount" id="discount3" onblur="getpaysub3()" value="0" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3">Payable </label>
                            <div class="col-xs-9">
                                <input type="number" class="form-control" name="payable" id="payable3" value="<?php echo $amt3 ; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3"></label>
                            <div class="col-xs-9">
                                <input class="btn btn-success" type="submit" value="Pay" id="send">
                            </div>
                        </div>
                        <?php  echo form_close(); ?>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
    <!--========================================== Forth Month ===============================================-->
    <div class="col-sm-12">
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                                   <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+3, 10)); echo  $monthName;?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <table class="table table-condensed">
                        <?php $amt4=0; $sn=1;foreach ($section_fee_middle as $row){?>
                            <tr>
                                <td ><?php echo $sn++;?></td>
                                <td ><?php $x4=$this->admin_model->fee_by_id($row['fee_id']);print_r($x4['name']); ?></td>
                                <td><?php echo $row['amount']; $amt4 += $row['amount']; ?></td>
                            </tr>
                        <?php }?>
                        <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt4; ?></td></tr>
                    </table>
                </div>


                <div class="col-sm-4">
                    <?php $pay4=$this->admin_model->get_student_fee_of_month($section_id,$student_id,4); ?>
                    <?php if ($pay4){ ?>
                        <!------------------------------------------------------------->
                        <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay4['amount'];?>  </label> </div>
                        <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay4['discount'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay4['payable'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay4['date'];?>  </label></div>
                        <a class="gold-bt"  onclick="printDiv('forth_fee')">Print</a>
                        <div  id="forth_fee" style="display: none">
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
                                <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                            </div>
                            <div class="col-xs-12">
                                <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                                <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                                <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                            </div>
                            <div class="col-xs-12">
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                                <?php $amt_4=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                    <div class="col-xs-5 col-xs-offset-5"><?php $x4=$this->admin_model->fee_by_id($row['fee_id']);print_r($x4['name']); ?></div>
                                    <div class="col-xs-2"><?php echo $row['amount']; $amt_4 += $row['amount']; ?></div>
                                <?php }?>
                                <hr>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5  col-xs-offset-5"> Total</div>
                                <div class="col-xs-2"> <?php echo $amt_4; ?></div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay4['amount'];?> </div>
                                <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay4['discount'];?> </div>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay4['payable'];?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <?php $timestamp = $pay4['date'];  ?>
                                <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <br><br>
                                <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                                <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                            </div>
                            <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                        </div>
                        <!------------------------------------------------------------->
                    <?php }else{ ?>
                        <?php $data = array('id'=>"fupForm")?>
                        <?php echo form_open('admin/add_class_work_data',$data) ?>
                        <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                        <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                        <input type="hidden" name="amount" id="amount4" value="<?php echo $amt4 ; ?>">
                        <input type="hidden" name="month_no" value="4">
                        <div class="form-group">
                            <label class="col-xs-3">Discount </label>
                            <div class="col-xs-9">
                                <input  type="number" class="form-control " name="discount" id="discount4" onblur="getpaysub4()" value="0" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3">Payable </label>
                            <div class="col-xs-9">
                                <input type="number" class="form-control" name="payable" id="payable4" value="<?php echo $amt4 ; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3"></label>
                            <div class="col-xs-9">
                                <input class="btn btn-success" type="submit" value="Pay" id="send">
                            </div>
                        </div>
                        <?php  echo form_close(); ?>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
    <!--========================================== Fifth Month ===============================================-->
    <div class="col-sm-12">
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                                   <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+4, 10)); echo  $monthName;?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <table class="table table-condensed">
                        <?php $amt5=0; $sn=1;foreach ($section_fee_fifth as $row){?>
                            <tr>
                                <td ><?php echo $sn++;?></td>
                                <td ><?php $x5=$this->admin_model->fee_by_id($row['fee_id']);print_r($x5['name']); ?></td>
                                <td><?php echo $row['amount']; $amt5 += $row['amount']; ?></td>
                            </tr>
                        <?php }?>
                        <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt5; ?></td></tr>
                    </table>
                </div>


                <div class="col-sm-4">
                    <?php $pay5=$this->admin_model->get_student_fee_of_month($section_id,$student_id,5); ?>
                    <?php if ($pay5){ ?>
                        <!------------------------------------------------------------->
                        <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay5['amount'];?>  </label> </div>
                        <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay5['discount'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay5['payable'];?>  </label></div>
                        <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay5['date'];?>  </label></div>
                        <a class="gold-bt"  onclick="printDiv('fifth_fee')">Print</a>
                        <div  id="fifth_fee" style="display: none">
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
                                <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                                <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                            </div>
                            <div class="col-xs-12">
                                <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                                <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                                <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                            </div>
                            <div class="col-xs-12">
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                                <?php $amt_5=0; $sn=1;foreach ($section_fee_fifth as $row){?>
                                    <div class="col-xs-5 col-xs-offset-5"><?php $x5=$this->admin_model->fee_by_id($row['fee_id']);print_r($x5['name']); ?></div>
                                    <div class="col-xs-2"><?php echo $row['amount']; $amt_5 += $row['amount']; ?></div>
                                <?php }?>
                                <hr>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5  col-xs-offset-5"> Total</div>
                                <div class="col-xs-2"> <?php echo $amt_5; ?></div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay5['amount'];?> </div>
                                <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay5['discount'];?> </div>
                                <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                                <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay5['payable'];?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <?php $timestamp = $pay5['date'];  ?>
                                <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                                <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                                <br><br>
                                <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                                <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                            </div>
                            <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                        </div>
                        <!------------------------------------------------------------->
                    <?php }else{ ?>
                        <?php $data = array('id'=>"fupForm")?>
                        <?php echo form_open('admin/add_class_work_data',$data) ?>
                        <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                        <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                        <input type="hidden" name="amount" id="amount5" value="<?php echo $amt5 ; ?>">
                        <input type="hidden" name="month_no" value="5">
                        <div class="form-group">
                            <label class="col-xs-3">Discount </label>
                            <div class="col-xs-9">
                                <input  type="number" class="form-control " name="discount" id="discount5" onblur="getpaysub5()" value="0" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3">Payable </label>
                            <div class="col-xs-9">
                                <input type="number" class="form-control" name="payable" id="payable5" value="<?php echo $amt5 ; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3"></label>
                            <div class="col-xs-9">
                                <input class="btn btn-success" type="submit" value="Pay" id="send">
                            </div>
                        </div>
                        <?php  echo form_close(); ?>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
   <!--========================================== Sixth Month ===============================================-->
   <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
             <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+5, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt6=0; $sn=1;foreach ($section_fee_middle as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x6=$this->admin_model->fee_by_id($row['fee_id']);print_r($x6['name']); ?></td>
                            <td><?php echo $row['amount']; $amt6 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt6; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay6=$this->admin_model->get_student_fee_of_month($section_id,$student_id,6); ?>
                <?php if ($pay6){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay6['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay6['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay6['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay6['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('sixth_fee')">Print</a>
                    <div  id="sixth_fee" style="display: none">
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                            <?php $amt_6=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x6=$this->admin_model->fee_by_id($row['fee_id']);print_r($x6['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_6 += $row['amount']; ?></div>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_6; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay6['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay6['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay6['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay6['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount6" value="<?php echo $amt6 ; ?>">
                    <input type="hidden" name="month_no" value="6">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount6" onblur="getpaysub6()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable6" value="<?php echo $amt6 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
   <!--========================================== Seventh Month ===============================================-->
    <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
               <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+6, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt7=0; $sn=1;foreach ($section_fee_middle as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x7=$this->admin_model->fee_by_id($row['fee_id']);print_r($x7['name']); ?></td>
                            <td><?php echo $row['amount']; $amt7 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt7; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay7=$this->admin_model->get_student_fee_of_month($section_id,$student_id,7); ?>
                <?php if ($pay7){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay7['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay7['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay7['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay7['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('seventh_fee')">Print</a>
                    <div  id="seventh_fee" style="display: none">
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                            <?php $amt_7=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x7=$this->admin_model->fee_by_id($row['fee_id']);print_r($x7['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_7 += $row['amount']; ?></div>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_7; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay7['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay7['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay7['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay7['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount7" value="<?php echo $amt7 ; ?>">
                    <input type="hidden" name="month_no" value="7">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount7" onblur="getpaysub7()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable7" value="<?php echo $amt7 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
   <!--========================================== Eighth Month ===============================================-->
   <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+7, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt8=0; $sn=1;foreach ($section_fee_middle as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x8=$this->admin_model->fee_by_id($row['fee_id']);print_r($x8['name']); ?></td>
                            <td><?php echo $row['amount']; $amt8 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt8; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay8=$this->admin_model->get_student_fee_of_month($section_id,$student_id,8); ?>
                <?php if ($pay8){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay8['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay8['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay8['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay8['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('eighth_fee')">Print</a>
                    <div  id="eighth_fee" style="display: none">
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                            <?php $amt_8=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x8=$this->admin_model->fee_by_id($row['fee_id']);print_r($x8['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_8 += $row['amount']; ?></div>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_8; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay8['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay8['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay8['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay8['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount8" value="<?php echo $amt8 ; ?>">
                    <input type="hidden" name="month_no" value="8">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount8" onblur="getpaysub8()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable8" value="<?php echo $amt8 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
   <!--========================================== Ninth Month ===============================================-->
   <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+8, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt9=0; $sn=1;foreach ($section_fee_middle as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x9=$this->admin_model->fee_by_id($row['fee_id']);print_r($x9['name']); ?></td>
                            <td><?php echo $row['amount']; $amt9 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt9; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay9=$this->admin_model->get_student_fee_of_month($section_id,$student_id,9); ?>
                <?php if ($pay9){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay9['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay9['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay9['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay9['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('ninth_fee')">Print</a>
                    <div  id="ninth_fee" style="display: none">
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                            <?php $amt_9=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x9=$this->admin_model->fee_by_id($row['fee_id']);print_r($x9['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_9 += $row['amount']; ?></div>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_9; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay9['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay9['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay9['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay9['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount9" value="<?php echo $amt9 ; ?>">
                    <input type="hidden" name="month_no" value="9">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount9" onblur="getpaysub9()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable9" value="<?php echo $amt9 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
   <!--========================================== Tenth Month ===============================================-->
   <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
               <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+9, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt10=0; $sn=1;foreach ($section_fee_middle as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x10=$this->admin_model->fee_by_id($row['fee_id']);print_r($x10['name']); ?></td>
                            <td><?php echo $row['amount']; $amt10 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt10; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay10=$this->admin_model->get_student_fee_of_month($section_id,$student_id,10); ?>
                <?php if ($pay10){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay10['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay10['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay10['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay10['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('tenth_fee')">Print</a>
                    <div  id="tenth_fee" style="display: none">
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                            <?php $amt_10=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x10=$this->admin_model->fee_by_id($row['fee_id']);print_r($x10['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_10 += $row['amount']; ?></div>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_10; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay10['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay10['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay10['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay10['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount10" value="<?php echo $amt10 ; ?>">
                    <input type="hidden" name="month_no" value="10">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount10" onblur="getpaysub10()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable10" value="<?php echo $amt10 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
   <!--========================================== Eleventh Month ===============================================-->
   <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+10, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt11=0; $sn=1;foreach ($section_fee_middle as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x11=$this->admin_model->fee_by_id($row['fee_id']);print_r($x11['name']); ?></td>
                            <td><?php echo $row['amount']; $amt11 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt11; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay11=$this->admin_model->get_student_fee_of_month($section_id,$student_id,11); ?>
                <?php if ($pay11){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay11['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay11['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay11['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay11['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('eleventh_fee')">Print</a>
                    <div  id="eleventh_fee" style="display: none">
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>


                            <?php $amt_11=0; $sn=1;foreach ($section_fee_middle as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x11=$this->admin_model->fee_by_id($row['fee_id']);print_r($x11['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_11 += $row['amount']; ?></div>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_11; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay11['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay11['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay11['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay11['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount11" value="<?php echo $amt11 ; ?>">
                    <input type="hidden" name="month_no" value="11">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount11" onblur="getpaysub11()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable11" value="<?php echo $amt11 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
   <!--========================================== Twelveth Month ===============================================-->
   <div class="col-sm-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
               <?php  $monthName = date('F', mktime(0, 0, 0, $first_m+11, 10)); echo  $monthName;?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <?php $amt12=0; $sn=1;foreach ($section_fee_last as $row){?>
                        <tr>
                            <td ><?php echo $sn++;?></td>
                            <td ><?php $x12=$this->admin_model->fee_by_id($row['fee_id']);print_r($x12['name']); ?></td>
                            <td><?php echo $row['amount']; $amt12 += $row['amount']; ?></td>
                        </tr>
                    <?php }?>
                    <tr><td>*</td><td >Library Book Late Fee</td><td><?php echo $library_fee;$amt12+= $library_fee; ?></td></tr>
                    <tr><td colspan="2"  class="total">Total</td><td><?php echo $amt12; ?></td></tr>
                </table>
            </div>


            <div class="col-sm-4">
                <?php $pay12=$this->admin_model->get_student_fee_of_month($section_id,$student_id,12); ?>
                <?php if ($pay12){ ?>
                    <!------------------------------------------------------------->
                    <div class="form-group"><label class="col-xs-6">Amount  </label><label class="col-xs-6"><?php echo  $pay12['amount'];?>  </label> </div>
                    <div class="form-group"><label class="col-xs-6">Discount  </label><label class="col-xs-6"><?php echo  $pay12['discount'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Payable </label><label class="col-xs-6"><?php echo  $pay12['payable'];?>  </label></div>
                    <div class="form-group"><label class="col-xs-6">Date </label><label class="col-xs-6"><?php echo  $pay12['date'];?>  </label></div>
                    <a class="gold-bt"  onclick="printDiv('twelveth_fee')">Print</a>
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
                            <div class="col-xs-4"><h5 style="text-align: left">Serial No : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: center">Book NO : ________</h5></div>
                            <div class="col-xs-4"><h5 style="text-align: right">Date :  <?php echo date('d-m-Y');?></h5></div>
                        </div>
                        <div class="col-xs-12">
                            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
                            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
                            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
                        </div>
                        <div class="col-xs-12">
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $amt_11=0; $sn=1;foreach ($section_fee_last as $row){?>
                                <div class="col-xs-5 col-xs-offset-5"><?php $x12=$this->admin_model->fee_by_id($row['fee_id']);print_r($x12['name']); ?></div>
                                <div class="col-xs-2"><?php echo $row['amount']; $amt_11 += $row['amount']; ?></div>
                                <?php $amt_11 += $library_fee;?>
                            <?php }?>
                            <hr>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5  col-xs-offset-5"> Total</div>
                            <div class="col-xs-2"> <?php echo $amt_11; ?></div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <div class="col-xs-5 col-xs-offset-5">Amount </div> <div class="col-xs-2"><?php echo  $pay12['amount'];?> </div>
                            <div class="col-xs-5 col-xs-offset-5">Discount </div> <div class="col-xs-2">- <?php echo  $pay12['discount'];?> </div>
                            <div class="col-xs-7  col-xs-offset-5"><p style="text-align: center">....................................................................</p></div>
                            <div class="col-xs-5 col-xs-offset-5">Payable</div> <div class="col-xs-2"><?php echo  $pay12['payable'];?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <?php $timestamp = $pay12['date'];  ?>
                            <div class="col-xs-7">Payment Date</div> <div class="col-xs-5"><?php  echo date("F jS, Y", strtotime($timestamp));?> </div>
                            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------</h6>
                            <br><br>
                            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
                            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
                        </div>
                        <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
                    </div>
                    <!------------------------------------------------------------->
                <?php }else{ ?>
                    <?php $data = array('id'=>"fupForm")?>
                    <?php echo form_open('admin/add_class_work_data',$data) ?>
                    <input type="hidden" name="student_id" value="<?php echo $student_id ; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id ; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section_id ; ?>">
                    <input type="hidden" name="amount" id="amount12" value="<?php echo $amt12 ; ?>">
                    <input type="hidden" name="month_no" value="12">
                    <div class="form-group">
                        <label class="col-xs-3">Discount </label>
                        <div class="col-xs-9">
                            <input  type="number" class="form-control " name="discount" id="discount12" onblur="getpaysub12()" value="0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3">Payable </label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="payable" id="payable12" value="<?php echo $amt12 ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3"></label>
                        <div class="col-xs-9">
                            <input class="btn btn-success" type="submit" value="Pay" id="send">
                        </div>
                    </div>
                    <?php  echo form_close(); ?>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>

<?php }?>


<!--===========================================================================-->
<script>
    function getpaysub1() {
        var amount= $('#amount1').val();
        var discount= $('#discount1').val();
        var payable = amount - discount ;
        $('#payable1').val(payable);
    }
</script>
<script>
    function getpaysub2() {
        var amount= $('#amount2').val();
        var discount= $('#discount2').val();
        var payable = amount - discount ;
        $('#payable2').val(payable);
    }
</script>
<script>
    function getpaysub3() {
        var amount= $('#amount3').val();
        var discount= $('#discount3').val();
        var payable = amount - discount ;
        $('#payable3').val(payable);
    }
</script>
<script>
    function getpaysub4() {
        var amount= $('#amount4').val();
        var discount= $('#discount4').val();
        var payable = amount - discount ;
        $('#payable4').val(payable);
    }
</script>
<script>
    function getpaysub5() {
        var amount= $('#amount5').val();
        var discount= $('#discount5').val();
        var payable = amount - discount ;
        $('#payable5').val(payable);
    }
</script>
<script>
    function getpaysub6() {
        var amount= $('#amount6').val();
        var discount= $('#discount6').val();
        var payable = amount - discount ;
        $('#payable6').val(payable);
    }
</script>
<script>
    function getpaysub7() {
        var amount= $('#amount7').val();
        var discount= $('#discount7').val();
        var payable = amount - discount ;
        $('#payable7').val(payable);
    }
</script>
<script>
    function getpaysub8() {
        var amount= $('#amount8').val();
        var discount= $('#discount8').val();
        var payable = amount - discount ;
        $('#payable8').val(payable);
    }
</script>
<script>
    function getpaysub9() {
        var amount= $('#amount9').val();
        var discount= $('#discount9').val();
        var payable = amount - discount ;
        $('#payable9').val(payable);
    }
</script>
<script>
    function getpaysub10() {
        var amount= $('#amount10').val();
        var discount= $('#discount10').val();
        var payable = amount - discount ;
        $('#payable10').val(payable);
    }
</script>
<script>
    function getpaysub11() {
        var amount= $('#amount11').val();
        var discount= $('#discount11').val();
        var payable = amount - discount ;
        $('#payable11').val(payable);
    }
</script>
<script>
    function getpaysub12() {
        var amount= $('#amount12').val();
        var discount= $('#discount12').val();
        var payable = amount - discount ;
        $('#payable12').val(payable);
    }
</script>
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
                loadview('pay_student_fee/'+c_id+'/'+s_id+'/'+st_id);
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

<?php if ($class){?>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_student_fee',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");
                    loadview('pay_student_fee/<?php echo $class_id ; ?>/<?php echo $section_id ; ?>/<?php echo $student_id ; ?>');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
    /*\\\\\\\\\\\\\\\\\\\\\\\\\\\\\*/
    $("#send").click(function(){
        $(this).hide();
    });
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
<?php }?>