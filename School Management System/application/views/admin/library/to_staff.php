
<h1 class="page-title"> Alot  Book To Staff </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('issue_book_to_staff/<?php echo $book['id'];?>')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($employee);?>
<div class="guardian">
    <div class="col-sm-8 col-sm-offset-2">
        <!-- <div id="subsmsg"></div>-->
        <div class="panel panel-success" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Allot  Book To Staff
                </div>
            </div>


            <div class="panel-body">
                <?php $data = array('id'=>"fupForm")?>
                <?php echo form_open_multipart('admin/update_issue_book_to_student',$data) ?>
                <br>
                <input type="hidden" class="form-control" name="id" value="<?php echo $book['id']; ?>"  >
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Book Name :</label>
                    <label class="col-xs-6"><?php echo $book['name']; ?></label>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Author Name :</label>
                    <label class="col-xs-6"><?php echo $book['author']; ?></label>

                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Description :</label>
                    <label class="col-xs-6"><?php echo $book['description']; ?></label>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Price :</label>
                    <label class="col-xs-6"><?php echo $book['price']; ?></label>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Class :</label>
                    <label class="col-xs-6"><?php $class= $this->admin_model->class_by_id($book['class']); echo $class['name'] ?></label>
                </div>

                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Book Code :</label>
                    <label class="col-xs-6"><?php echo $book['book_code']; ?></label>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Employee  :</label>
                    <div class="col-xs-6">
                            <select class="form-control" name="staff_id">
                                <option >Select</option>
                                <?php foreach($employee as $row){ ?>
                                    <option value="<?php echo $row['employee_id'];?>"><?php echo $row['name'];?></option>
                                <?php }?>
                            </select>
                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Date From:</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="date_from" value="<?php echo date('Y-m-d') ?>">

                    </div>
                </div>
                <!--=====================================-->
                <div class="form-group">
                    <label class="col-xs-6">Date To:</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="date_to" value="<?php echo date('Y-m-d', strtotime(' +'.$book['max_day'].' day')); ?>">

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
<script>
    function getStudent(value) {
        $.ajax({

            type: 'POST',
            url: '<?php echo base_url()?>index.php/admin/library_students/'+value,
            success: function(msg){

                $('#student').html(msg);
            },
            error: function(){

                alert("fail");
            },

        });
    }
</script>
<!--to form submit upload image-->
<script>
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/update_issue_book_to_student',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                        $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <span style='color: red'> updated successfully. </span><div>");
                     loadview('all_book');
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


