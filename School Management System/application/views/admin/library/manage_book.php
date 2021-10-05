
<h1 class="page-title"> Add Book </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('manage_book')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_class);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Add Book

                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/add_book',$data) ?>
                <br>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Book Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Author Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="author" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Description :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="description" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Price :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="price" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="class">
                            <option value="1111">For All</option>
                            <?php foreach($class as $row){ ?>

                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Quantity :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="quantity" required >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Max Day :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="max_day" required >
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Type :</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="type" required >
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Late Fee (per Day) :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="late_fee" required >
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group" style="border: none">
                    <label class="col-xs-6"></label>
                    <div class="col-xs-6">
                        <input type="submit" class=" btn btn-success"  value="Submit" id="submit">
                    </div>
                </div>

                <!--=====================================-->

                <?php echo form_close() ?>
            </div>

            <!--end panal body-->
        </div>

    </div>
</div>
<!--=====================================-->
<!--to form submit upload image-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_book',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> " + msg + " Book added successfully. </span><div>");

                    loadview('manage_book');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


