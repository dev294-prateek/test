<h1 class="page-title">All School Gallery </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_school_gallery')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php // print_r($gallery);?>
<div >
    <div class="col-sm-12">
<!---->
        <?php foreach($gallery as $row){?>
            <div class="col-sm-4" style="margin-bottom: 10px">
                <img style="width: 100%" src="<?php echo base_url()?>/uploads/<?php echo $row['image']; ?>" class="img-thumbnail" alt="Cinque Terre">
                <div id="title" class="img-thumbnail"><?php echo $row['title']; ?></div>
                <div id="description" class="img-thumbnail"><?php echo $row['description']; ?></div>
                <button id="view" style="float: right" class="btn btn-success" onclick="loadview('view_more_school_gal/<?php echo $row["id"]; ?>')">View More </button>


            </div>
<!---->

<!---->
        <?php } ?>
<!---->
    </div>


</div>
<div>
    <!---------------------------->

    <!---------------------------->
</div>
</div>

<!--=====================================-->
<!--to form submit upload image-->
<script>
    $(document).ready(function(){
        $("#section").change(function(){
            var s_id=$(this).val();
            var c_id=$("#class_id").val();
            $.ajax({
                url: '<?php echo base_url()?>index.php/admin/period_class_detail',
                type:"POST",
                datatype:"json",
                data:{s_id:s_id,c_id:c_id},
                success: function (msg) {
                    $("#det2").html(msg);
                },
                error: function () { alert("fail");
                }
            })

        });
    });
</script>
<script>
    function detail(id){
        /*   alert(id);*/
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/show_teacher_detail_for_period',
            type:"POST",
            datatype:"json",
            data:{id:id},
            success: function (msg) {

                $("#det").html(msg);
            },
            error: function () { alert("fail");
            }
        })
    }

    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){
            $("#submit").hide();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_class_gallery',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Allotted Successfully <div>");
                    loadview('class_gallery')
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

        function chk_time() {
            var end = $('#end_time').val();
            var start = $('#start_time').val();
           if( start > end)
            {
             var end = $('#end_time').val("");
                $('#end_time').val('');
                alert('End time always greater then Start time');
            }
        }

</script>
<!--to preview image-->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
</script>

