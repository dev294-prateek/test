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
<h1 class="page-title"> Monthly  Attendance Report </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('emp_attendance_report')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($cl);?>
<?php if($year) { ?>
    <div class="col-sm-12">
        <div class="edate " style="text-align: center" >
            <span style="color: red">Month</span> :<?php echo date('F', mktime(0, 0, 0,  $month, 10));?>
        </div>
    </div>
<?php } ?>
    <div class="col-xs-12" style="border: 1px solid white;display: <?php if($year) { echo "none";}?>">
        <!--=====================================-->
        <label class="col-sm-1 col-xs-4" style="margin-bottom: 10px">Month :</label>
        <div class="col-sm-2  col-xs-8" style="margin-bottom: 10px">
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


       <div class="col-sm-3  col-sm-offset-6 col-xs-12" style="margin-bottom: 10px">

        </div><br>        <!--=====================================-->
    </div>
<?php //print_r($employee)?>
<!--=====================================-->

<div class="col-xs-12 col-sm-12">
    <!---->
    <?php if($year) { ?>
        <div id="table-scroll" class="table-scroll">
            <div class="table-wrap">
                <table class="main-table">
                    <thead>
                    <tr>
                        <th class="fixed-side" scope="col" style="width: 20px">S.N</th>
                        <th class="fixed-side" scope="col" style="width: 200px">Name</th>
                        <?php
                        $day=cal_days_in_month(CAL_GREGORIAN,$month,$year);
                        for($d=1; $d<=$day; $d++)
                        {  echo "<th>".$d."</th>";  }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $s=1; ?>
                    <?php foreach($employee as $row){?>
                        <tr>
                            <th class="fixed" style="width: 20px;"><?php echo $s++; ?> <i class="entypo-right-dir"></i></th>
                            <th class="fixed-side fixed" style="width: 200px"><?php $x=$this->admin_model->employee_name($row['employee_id']); echo $x ?>
                            </th>
                         <?php
                         for($d=1; $d<=$day; $d++){
                             $att=$this->admin_model->get_emp_attendance_individual($row['employee_id'],$d,$month,$year);
                             echo "<td>";
                             if($att==1){echo "P";}
                             elseif($att==2){echo "L";}
                             elseif($att==3){echo "A";}
                             echo "</td>";
                         } ?>
                        </tr>
                    <?php }?>
                </table>
            </div>
        </div>

    <?php } ?>
    <!---->

</div>
<!--=====================================-->

<!--=====================================-->
<script>
    jQuery(document).ready(function() {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
</script>
<script>
    function getdata(x) {

       loadview('emp_attendance_report/'+x);
    }
    function send_sms(d) {
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/sms_emp_attendance',
            type:"POST",
            datatype:"json",
            data:{d:d},
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
    function update_data(id,v,n) {
/*        alert(id);
        alert(v);
        alert(attr);*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/update_emp_attendance',
            type:"POST",
            datatype:"json",
            data:{value:v,id:id,name:n},
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
            url: '<?php echo base_url()?>index.php/admin/change_period_status',
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


