<style>
    HTML  CSS Result
    EDIT ON
    h2,p{
        font-size:100%;
        font-weight:normal;
    }
    ul.notice,li{
        list-style:none;
    }
    ul.notice{
        overflow:hidden;
        padding:3em;
    }
    ul.notice li a{
        text-decoration:none;
        color:#000;
        background:#ffc;
        display:block;
/*        height:20em;
        width:400px;*/
        padding:1em;
        -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
        -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        -moz-transition:-moz-transform .15s linear;
        -o-transition:-o-transform .15s linear;
        -webkit-transition:-webkit-transform .15s linear;
    }
    ul.notice li{
        margin:1em;
        float:left;
    }
    ul.notice li h2{
        font-size:140%;
        font-weight:bold;
        padding-bottom:10px;
    }
    ul.notice li p{
        font-family:"Reenie Beanie",arial,sans-serif;
        font-size:13px;
    }
    ul.notice li a{
        -webkit-transform: rotate(-6deg);
        -o-transform: rotate(-6deg);
        -moz-transform:rotate(-6deg);
    }
    ul.notice li:nth-child(even) a{
        -o-transform:rotate(4deg);
        -webkit-transform:rotate(4deg);
        -moz-transform:rotate(4deg);
        position:relative;
        top:5px;
        background:#cfc;
    }
    ul.notice li:nth-child(3n) a{
        -o-transform:rotate(-3deg);
        -webkit-transform:rotate(-3deg);
        -moz-transform:rotate(-3deg);
        position:relative;
        top:-5px;
        background:#ccf;
    }
    ul.notice li:nth-child(5n) a{
        -o-transform:rotate(5deg);
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        position:relative;
        top:-10px;
    }
    ul.notice li a:hover,ul li a:focus{
        box-shadow:10px 10px 7px rgba(0,0,0,.7);
        -moz-box-shadow:10px 10px 7px rgba(0,0,0,.7);
        -webkit-box-shadow: 10px 10px 7px rgba(0,0,0,.7);
        -webkit-transform: scale(1.25);
        -moz-transform: scale(1.25);
        -o-transform: scale(1.25);
        position:relative;
        z-index:5;
    }
    ol{text-align:center;}
    ol li{display:inline;padding-right:1em;}
    ol li a{color:#fff;}
    VIEW RESOURCES 1×
    0.5×
    0.25×
        RERUN
</style>
<h1 class="page-title">Noticeboard </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('view_noticeboard')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r("<pre>");?>
<?php //print_r($emp_teacher);?>
<div class="guardian">
    <div class="col-sm-12">
        <ul class="notice">
            <?php $sn=1;foreach ( $all_notice as $row) { ?>
            <li class="col-sm-5 col-xs-11" style="margin-left: 5%">
                <a href="#" class="notice_li_a">
                    <img style="    width: 50px;" src="<?php echo base_url()?>/assets/images/pin.png">
                    <h2><?php echo $row['title']?></h2>
                    <p><?php echo $row['notice']?></p>
                    <h6 style="text-align: right;color: red;"><?php echo  date("F jS, Y", strtotime($row['date'])) ; ?></h6>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>

</div>


<!--=====================================-->


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function(e){

        $("#fupForm").on('submit', function(e){

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>index.php/admin/add_noticeboard',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg){

                    $('#subsmsg').html("<div class='alert alert-danger '><span style='color: red'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  Added successfully.</span><div>");
                    loadview('noticeboard');
                },
                error: function(){
                    $('#subsmsg').html("<div class='alert alert-danger '><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong <span style='color: red'> Try again</span><div>");

                },

            });
        });
    });
</script>



