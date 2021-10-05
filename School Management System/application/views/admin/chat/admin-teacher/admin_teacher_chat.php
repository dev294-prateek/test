    <link rel="stylesheet" href="<?php echo  base_url();?>assets/css/chat_custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

<!--========================================================-->

              <h1><span id="span"></span></h1>
            <div class="col-md-4 col-xl-4 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                    </div>
                    <div class="card-body contacts_body">
                        <ui class="contacts">
                            <?php foreach($all_teacher as $row){ ?>
                            <li class="add <?php if($id==$row['employee_id']){echo 'active';} ?>" onclick="loadview_chat('admin_teacher_chat_data/<?php echo $row['employee_id']; ?>/<?php echo str_replace(' ', '_', $row['name']); ?>/<?php echo $row['employee_image']; ?>/7/0')">
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img src="<?php echo base_url()?>uploads/<?php echo $row['employee_image']?>"class="rounded-circle user_img">
                                        <?php if($row['online']==1){?><span class="online_icon"></span><?php } else {?><span class="online_icon offline"></span> <?php } ?>
                                    </div>
                                    <div class="user_info">
                                        <span><?php echo $row['name']?></span>
                                       <?php if($row['online']==1){?> <p><?php echo $row['name']?> is online</p><?php } else {?><p><?php echo $row['name']?> is offline</p></span> <?php } ?>
                                    </div>
                                   
                                </div>
                            </li>
                            <?php } ?>
                        </ui>
                    </div>
                    <div class="card-footer"></div>
                </div></div>
            <div class="col-md-8 col-xl-8 chat">
                <div class="card" id="dddd">
                </div>
            </div>
    <!--===========================================================-->

<script>
    function  loadview_chat(page) {
        var url='<?php echo base_url() ?>index.php/admin/'+page;
        $("#dddd").load(url);
    }
</script>


