
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!-- Bottom scripts (common) -->
<script src="<?php echo  base_url();?>assets/js/gsap/TweenMax.min.js"></script>
<script src="<?php echo  base_url();?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="<?php echo  base_url();?>assets/js/bootstrap.js"></script>
<script src="<?php echo  base_url();?>assets/js/joinable.js"></script>
<script src="<?php echo  base_url();?>assets/js/resizeable.js"></script>
<script src="<?php echo  base_url();?>assets/js/neon-api.js"></script>
<script src="<?php echo  base_url();?>assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?php echo  base_url();?>assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>




<script src="<?php echo  base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/rickshaw/rickshaw.min.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/raphael-min.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/morris.min.js"></script>


<script src="<?php echo  base_url();?>assets/js/toastr.js"></script>
<!--<script src="<?php /*echo  base_url();*/?>assets/js/neon-chat.js"></script>-->
<!--<script src="<?php /*echo  base_url();*/?>assets/js/dropzone/dropzone.js"></script>-->

<!-- JavaScripts initializations and stuff -->
<script src="<?php echo  base_url();?>assets/js/neon-custom.js"></script>


<!-- Dte picker  -->
<!--<script src="<?php /*echo  base_url();*/?>assets/js/datepicker.js"></script>-->


<script>
    /*================load Page==================*/
    function  loadview(page) {
        $("#main_container").html('<div id="loader"></div>');
        var url='<?php echo base_url() ?>index.php/teacher/'+page;
        /*  alert(url);*/
        $("#main_container").load(url);
    }
    /*================Default dasgboard load==================*/
    $(document).ready(function(){
     $("#main_container").html('<div id="loader"></div>');
        var page = 'dashboard';
        var url="<?php echo base_url() ?>index.php/teacher/"+page;
        $("#main_container").load(url);
    });
</script>
<!--================export exel==================-->


</body>
</html>