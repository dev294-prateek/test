
<script>
    var x = 0;
    $(document).ready(function(){
        var y = $(".msg_card_body");
        y.scroll(function(){
            var z =  y.scrollTop();
            if(z==0){
                <?php if($chat_count >= $limit){?>
                loadview_chat_data('admin_teacher_chat_data_data/<?php echo $id; ?>/<?php echo $name; ?>/<?php echo $img; ?>/<?php echo $limit+10;?>/0');
                <?php } ?>
            }
        });
    });
</script>
                    <script>
                     var doStuff = function () {
                            var id = <?php echo $id; ?>;
                            var chat_count = <?php echo $chat_count;?>;
                            console.log(chat_count);
                            $.ajax({
                                url: '<?php echo base_url()?>index.php/admin/admin_teacher_new_chat_data',
                                type: "POST",
                                datatype: "json",
                                data: {id:id,chat_count:chat_count},
                                success: function (msg) { 
                                    if(msg > 0){
                                    loadview_chat_data('admin_teacher_chat_data_data/<?php echo $id; ?>/<?php echo $name; ?>/<?php echo $img; ?>/7/0');
                                } }
                            });
                             setTimeout(doStuff, 3000); 
                            };
                            setTimeout(doStuff, 3000);
                    </script>



