<style xmlns="http://www.w3.org/1999/html">
    #img-message {
        position: absolute;
        top: 88%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .panel-heading {
        /* background-color: black; */
        background-color: black !important;
        color: white !important;
    }

    .col-sm-12.ch, .col-sm-6.ch {
        text-align: center;
    }

    .centered {
        font-size: 30px;
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    img#image_upload_preview {
        width: 200px;
        height: 200px;
        /* width: 300px; */
    }

    .col-sm-6.ch {
        text-align: center;
    }

    input#inputFile {
        width: 200px;
        margin: 10px auto;
        border: 1px dotted yellowgreen;
        color: white;
        padding: 10px;
    }

    /*========*/
    .panel-body {
        background-color: #fafad23b;
    }

    label.radio-inline.ch {
        margin-right: 40px;
    }

    .form-group {
        border-bottom: 1px dotted yellowgreen;
    }
    . {
        padding: 6px 40px;
        font-size: 12px;
    }
    label {
        margin-top: 7px;
        color: darkgoldenrod;

    }
</style>
<style>
    .table-scroll {
        position:relative;
        /* max-width:600px;*/
        margin:auto;
        overflow:hidden;
        border:1px solid #000;
    }
    .table-wrap {
        width:100%;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        padding:5px 10px;
        /*        border:1px solid #000;
                background:#fff;*/
        white-space:nowrap;
        vertical-align:top;
    }

    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
    }
    .clone th, .clone td {
        visibility:hidden
    }
    .clone td, .clone th {
        border-color:transparent
    }
    .clone tbody th {
        visibility:visible;
        /*  color:red;*/
    }
    .clone .fixed-side {
        visibility:visible;
    }
    .clone thead, .clone tfoot{background:transparent;}
    .fixed{
        background-color: darkgoldenrod;border-bottom: 1px solid black !important;vertical-align: middle !important;
    }
    .alert.alert-warning {
        width: 300px;
        text-align: center;
        margin: 10px auto;
    }
    .alert-neon{
        margin-bottom: 10px;
        padding: 10px 20px;
        background-color:wheat ;
    }
    .edate{
        color: darkgoldenrod;
        background-color: palegoldenrod;
        padding: 10px 20px;
        border: 1px solid goldenrod;
    }
</style>
<h1 class="page-title"> Daily Attendance </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('attendance')"><i class="entypo-arrows-ccw"></i>Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($cl);?>

    <div class="col-xs-12" style="border: 1px solid white;">
        <!--=====================================-->
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px;display: none">Class :</label>
        <div class="col-sm-2 col-xs-8" style="margin-bottom: 10px;display: none">
            <?php $x=$this->teacher_model->class_by_id($cl); ?>
            <select class="form-control" id="class" <!--onChange="getSection(value);"-->>
                <option ><?php echo $x['name'];?></option>

            </select>
        </div>
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px;display: none">Section :</label>
        <div class="col-sm-2 col-xs-8" style="margin-bottom: 10px;display: none">
            <select id="section" class="form-control" >
                <option value="<?php echo $sec;?>"><?php $x=$this->teacher_model->section_by_id($sec); echo $x['name'];?></option>
            </select>
        </div>
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px;display: none">Date :</label>
        <div class="col-sm-2 col-xs-8" style="margin-bottom: 10px;display: none">
            <input type="date" id="date" class="form-control"  onchange="getdata(value)" value="<?php echo $d ; ?>">

        </div>
        <div class="col-sm-3 col-xs-12" style="margin-bottom: 10px">
            <?php if($students) { ?>
            <button style="float: right" type="button" class=" btn btn-green" onclick="send_sms(<?php echo $cl ; ?>,<?php echo $sec ; ?>,'<?php echo $d ; ?>')">Send SMS</button>
            <?php  } ?>
        </div><br>        <!--=====================================-->
    </div>
<?php //print_r($students)?>
<!--=====================================-->
<?php if($students) { ?>
<div class="col-xs-12">
    <div class="edate " style="text-align: center" >
        <?php echo date("j F , Y", strtotime($d));  ?><br>
         <span style="color: red">class</span> : <?php $xy=$this->teacher_model->class_by_id($cl); echo $xy['name'];?> <span style="color: red">Section</span> : <?php echo $x['name'];?>
    </div>
</div>
<?php } ?>
<!--=====================================-->

<div class="col-xs-12">
    <!---->
    <?php if($students) { ?>
    <div id="table-scroll" class="table-scroll">
        <div class="table-wrap">
            <table class="main-table">
                <thead>
                <tr>
                    <th class="fixed-side" scope="col" style="width: 20px">S.N</th>
                    <th class="fixed-side" scope="col">Name</th>
                    <th >Attendance</th>
                    <th >Punctuality</th>
                    <th >Cleanliness</th>
                    <th >handwriting</th>
                    <th >Handwriting</th>
                    <th >Interactiveness</th>
                    <th >Home Work</th>
                    <th >Class Work</th>
                    <th style="width: 400px;">Remark</th>
                </tr>
                </thead>
                <tbody>
                <?php $s=1; ?>
                <?php foreach($students as $row){?>
                <tr>
                    <th class="fixed" style="width: 20px;"><?php echo $s++; ?> <i class="entypo-right-dir"></i></th>
                    <th class="fixed-side fixed" ><?php $x=$this->teacher_model->student_name($row['student_id']); echo $x ?>
                    </th>
                    <td >
                        <select id="attendance" name="attendance" class="form-control" style="width: 125px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">
                            <option value="1" <?php if($row['attendance']==1){ echo 'selected';} ?>>Present</option>
                            <option value="2" <?php if($row['attendance']==2){ echo 'selected';} ?>>On Leave</option>
                            <option value="3" <?php if($row['attendance']==3){ echo 'selected';} ?>>Absent</option>
                        </select>
                    </td>
                    <td >
                        <select id="punctuality" name="punctuality" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">
                            <option value="10" <?php if($row['punctuality']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['punctuality']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['punctuality']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['punctuality']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['punctuality']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['punctuality']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['punctuality']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['punctuality']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['punctuality']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['punctuality']==1){ echo 'selected';} ?>>01</option>
                       </select>
                    </td>
                    <td >
                        <select id="cleanliness" name="cleanliness" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">
                            <option value="10" <?php if($row['cleanliness']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['cleanliness']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['cleanliness']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['cleanliness']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['cleanliness']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['cleanliness']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['cleanliness']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['cleanliness']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['cleanliness']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['cleanliness']==1){ echo 'selected';} ?>>01</option>
                        </select>
                    </td >
                    <td>
                        <select id="attentiveness" name="attentiveness" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">

                            <option value="10" <?php if($row['attentiveness']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['attentiveness']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['attentiveness']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['attentiveness']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['attentiveness']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['attentiveness']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['attentiveness']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['attentiveness']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['attentiveness']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['attentiveness']==1){ echo 'selected';} ?>>01</option>

                        </select>
                    </td>
                    <td >
                        <select id="handwriting" name="handwriting" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">
                            <option value="10" <?php if($row['handwriting']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['handwriting']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['handwriting']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['handwriting']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['handwriting']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['handwriting']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['handwriting']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['handwriting']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['handwriting']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['handwriting']==1){ echo 'selected';} ?>>01</option>
                        </select>
                    </td>
                    <td >
                        <select id="interactive" name="interactive" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">
                            <option value="10" <?php if($row['interactive']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['interactive']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['interactive']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['interactive']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['interactive']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['interactive']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['interactive']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['interactive']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['interactive']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['interactive']==1){ echo 'selected';} ?>>01</option>
                        </select>
                    </td>
                    <td >
                        <select id="homework" name="homework" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">
                            <option value="10" <?php if($row['homework']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['homework']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['homework']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['homework']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['homework']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['homework']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['homework']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['homework']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['homework']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['homework']==1){ echo 'selected';} ?>>01</option>
                        </select>
                    </td>
                    <td >
                        <select id="classwork" name="classwork" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">

                            <option value="10" <?php if($row['classwork']==10){ echo 'selected';} ?>>10</option>
                            <option value="9" <?php if($row['classwork']==9){ echo 'selected';} ?>>09</option>
                            <option value="8" <?php if($row['classwork']==8){ echo 'selected';} ?>>08</option>
                            <option value="7" <?php if($row['classwork']==7){ echo 'selected';} ?>>07</option>
                            <option value="6" <?php if($row['classwork']==6){ echo 'selected';} ?>>06</option>
                            <option value="5" <?php if($row['classwork']==5){ echo 'selected';} ?>>05</option>
                            <option value="4" <?php if($row['classwork']==4){ echo 'selected';} ?>>04</option>
                            <option value="3" <?php if($row['classwork']==3){ echo 'selected';} ?>>03</option>
                            <option value="2" <?php if($row['classwork']==2){ echo 'selected';} ?>>02</option>
                            <option value="1" <?php if($row['classwork']==1){ echo 'selected';} ?>>01</option>
                        </select>
                    </td>
                    <td >
                        <input value="<?php echo $row['remark']; ?>" type="text" id="remark" name="remark" class="form-control" style="width: 80px;" onchange="update_data(this.id,value ,<?php echo $row['id'];?>,<?php echo $row['class_id'];?>,'<?php echo $x ?>')">

                    </td>
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
    function getdata(x) {
       var cl = $("#class").val();
       var sec = $("#section").val();
       loadview('attendance/'+cl+'/'+sec+'/'+x);
    }
    function send_sms(cl,sec,d) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/sms_attendance',
            type:"POST",
            datatype:"json",
            data:{cl:cl,sec:sec,d:d},
            success: function (msg) {
               /* alert(msg)*/

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+ msg +"</span><div>");


            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }
</script>
<script>
    function update_data(attr,v,id,c_id,n) {
/*        alert(id);
        alert(v);
        alert(attr);*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/teacher/update_attendance',
            type:"POST",
            datatype:"json",
            data:{attr:attr,value:v,id:id,c_id:c_id,name:n},
            success: function (msg) {
               /* alert(msg)*/
                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+ msg +"</span><div>");

            },
            error: function () {

                $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

            }
        })
    }
</script>
<!--to form submit upload image-->
<script>
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


