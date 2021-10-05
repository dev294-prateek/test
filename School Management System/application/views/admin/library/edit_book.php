
<h1 class="page-title"> Add Book </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('edit_book/<?php echo $book['id'];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($book);?>
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
                <?php echo form_open_multipart('admin/update_book',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="id" value="<?php echo $book['id']; ?>"  >
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Book Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="name" required value="<?php echo $book['name']; ?>" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Author Name :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="author" required value="<?php echo $book['author']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Description :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="description" required value="<?php echo $book['description']; ?>" >
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Price :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="price" required  value="<?php echo $book['price']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class :</label>
                    <div class="col-xs-6">
                        <select  class="form-control" name="class">
                            <option value="1111">For All</option>
                            <?php foreach($class as $row){ ?>
                                <option value="<?php echo $row['class_id'];?>" <?php if($row['class_id']==$book['class']){echo "selected";}?>><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Book Code :</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="book_code"  value="<?php echo $book['book_code']; ?>">
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Max Day :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="max_day" required value="<?php echo $book['max_day']; ?>" >
                    </div>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Type :</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="type" required >
                            <option value="A" <?php if($book['type']=="A"){echo "selected";}?> >A</option>
                            <option value="B" <?php if($book['type']=="B"){echo "selected";}?>>B</option>
                            <option value="C" <?php if($book['type']=="C"){echo "selected";}?>>C</option>
                            <option value="D" <?php if($book['type']=="D"){echo "selected";}?>>D</option>
                        </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Late Fee (per Day) :</label>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="late_fee" required value="<?php echo $book['late_fee']; ?>" >
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
                url: '<?php echo base_url()?>index.php/admin/update_book',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> updated successfully. </span><div>");
                    loadview('edit_book/<?php echo $book['id'];?>');
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


