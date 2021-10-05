
<?php //print_r($library_fee); ?>
<h1 class="page-title" > Student Fee </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('student_fee')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
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
<div class="col-sm-10 col-sm-offset-1">
    <table class="table table-responsive">
        <tbody>
        <tr><td  colspan="7" style="text-align: center;color: darkgoldenrod;">Student : <span style="color: red"><?php print_r($student); ?></span> Class : <span style="color: red"><?php print_r($class); ?></span> Section : <span style="color: red"><?php print_r($section); ?></span> </td></tr>
        <tr><th style="width: 15%">S.N.</th><th  >Fee Name</th><th>Type</th><th>Amount</th><th>Total</th></tr>
        <?php $total=0; $sn=1;foreach ($section_fee as $row){?>
            <tr>
                <td  style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $sn++; ?></td>
                <td><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></td>
                <td><span class="label label-sm btn-green" ><i class="entypo-star-empty"></i><?php $x=$this->admin_model->fee_type_name($row['type']);print_r($x); ?></span></td>
                <td><?php echo $row['amount'];?></td>
                <td><?php echo $row['total']; $total += $row['total']; ?></td>

            </tr>
        <?php }?>

         <tr><td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " >*</td><td colspan="2">Library Book Late Fee</td><td><?php echo($library_fee); ?></td><td><?php echo($library_fee); $total += $library_fee;?></td></tr>
         <tr><td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ></td><td colspan="3"> <span style="color: darkgoldenrod;font-size: 17px;">Total</span></td><td><?php echo $total; ?></td></tr>
        </tbody>
    </table>
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
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></h5></div>
        </div>
        <div class="col-xs-12">
            <h3 style="text-align: center"> <?php  echo $student ; ?></h3>
            <div class="col-xs-6"><h4 style="text-align: left">Class :  <?php  echo $class ; ?></h4></div>
            <div class="col-xs-6"><h4 style="text-align: right">Section :  <?php echo $section ; ?></h4></div>
        </div>
        <div class="col-xs-12">
            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>
            <!--============================-->
            <table class="table table-responsive">
                <tbody>
                <tr><td style="width: 15%">S.N.</td><td  >Fee Name</td><td>Type</td><td>Amount</td><td>Total</td></tr>
                <?php $total=0; $sn=1;foreach ($section_fee as $row){?>
                    <tr>
                        <td  style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $sn++; ?></td>
                        <td><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></td>
                        <td><span class="label label-sm btn-green" ><i class="entypo-star-empty"></i><?php $x=$this->admin_model->fee_type_name($row['type']);print_r($x); ?></span></td>
                        <td><?php echo $row['amount'];?></td>
                        <td><?php echo $row['total']; $total += $row['total']; ?></td>

                    </tr>
                <?php }?>

                <tr><td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " >*</td><td colspan="2">Library Book Late Fee</td><td><?php echo($library_fee); ?></td><td><?php echo($library_fee); $total += $library_fee;?></td></tr>
                <tr><td style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ></td><td colspan="3"> <span style="color: darkgoldenrod;font-size: 17px;">Total</span></td><td><?php echo $total; ?></td></tr>
                </tbody>
            </table>
            <!--============================-->
            <h6 style="text-align: center">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>
            <br><br>
            <div class="col-xs-6"><h4 style="text-align: center">Stamp</h4></div>
            <div class="col-xs-6"><h4 style="text-align: center">Signature</h4></div>
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
                loadview('student_fee/'+c_id+'/'+s_id+'/'+st_id);
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