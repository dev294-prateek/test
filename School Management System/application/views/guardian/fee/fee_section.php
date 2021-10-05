<h1 class="page-title" > Section Fee </h1>
<?php // print_r($section); ?>


<h6 class="cent-refresh"><a class="gold-bt"  onclick="loadview('section_fee/<?php echo $section["section_id"];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<div class="col-sm-10 col-sm-offset-1">
    <div id="msg"></div>
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                Add  Fee
            </div>
        </div>
        <div class="panel-body">
            <?php $data = array('id'=>"fupForm")?>
            <?php echo form_open_multipart('admin/add_section_fee',$data) ?>
            <br>
            <input type="hidden" value="<?php echo $section['section_id'] ?>" name="section_id">
            <div class="form-group">
                <label class="col-xs-2">Sellect</label>
                <div class="col-xs-3">
                    <select  class="form-control"  name="fee_id" id="fee_id" onchange="getdetail(value)">
                        <?php foreach ($all_fee as $row){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label class="col-xs-2">Amount</label>
                <div class="col-xs-3">
                    <input type="number" id="amount" name="amount"  class="form-control" >

                </div>
                <div class="col-xs-2">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>
            <?php echo form_close() ?>
        </div>

    </div>
    <!---->
</div>

<!--==============================================================-->
<div class="col-sm-10 col-sm-offset-1">
    <table class="table table-responsive">
        <tbody>
        <tr><td  colspan="7" style="text-align: center;color: darkgoldenrod;"> Class : <span style="color: red"><?php $z=$this->admin_model->class_by_id($section['class_id']); print_r($z['name']); ?> </span> Section : <span style="color: red"><?php $x=$this->admin_model->section_by_id($section['section_id']); echo $x['name']; ?></span></td></tr>
        <tr><th style="width: 15%">S.N.</th><th  >Fee Name</th><th>Type</th><th>Last Update</th><th>Amount</th><th>Total</th><th>Action</th></tr>
        <?php $all_total=0; $sn=1;foreach ($section_fee as $row){?>
            <tr>
                <td  style="width: 15%;text-align: center;vertical-align: middle;background-color:darkgoldenrod;color: white; " ><?php echo $sn++; ?></td>
                <td><?php $x=$this->admin_model->fee_by_id($row['fee_id']);print_r($x['name']); ?></td>
                <td><span class="label label-sm btn-green" ><i class="entypo-star-empty"></i><?php $x=$this->admin_model->fee_type_name($row['type']);print_r($x); ?></span></td>
                <td><?php echo $row['last_update'];?></td>
                <td><?php echo $row['amount'];?></td>
                <td><?php echo $row['total']; $all_total +=$row['total'];?></td>
                <td>
                    <button class="label label-sm btn-red" onclick="delete_section_fee(<?php echo $row['id']; ?>,1)" ><i class="entypo-right"></i> Delete</button>

                </td>
            </tr>
        <?php }?>
        <tr><th colspan="5">Total</th><th> <?php echo $all_total; ?></th><th></th></tr>


        </tbody>
    </table>
</div>
<!--==============================================================-->
</div>
<script>
    function delete_section_fee(id) {
        if (confirm("Are you sure?")) {
            /*=======================================*/
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/delete_section_fee',
                type:"POST",
                datatype:"json",
                data:{id:id},
                success: function(msg){
                    loadview('section_fee/<?php echo $section["section_id"];?>');
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>deleted successfully. </span><div>");

                },
                error: function () { alert("fail");
                }
            })
            /*=======================================*/
        }
        return false;
    }
</script>
<script>
    function getdetail(id) {
        /*=======================================*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/find_fee_detail',
            type:"POST",
            datatype:"json",
            data:{id:id},
            success: function(msg){
                $('#msg').html(msg);
            },
            error: function () { alert("fail");
            }
        })
        /*=======================================*/
        alert(value);
    }
</script>

<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_section_fee',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    loadview('section_fee/<?php echo $section["section_id"];?>');
                    $('#subsmsg').html("<div class='alert alert-danger '> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='color: red'>Added successfully. </span><div>");
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>






