<?php if ($id) { ?>
    <div class="card-header msg_head">
        <div class="d-flex bd-highlight">
            <div class="img_cont">
                <img src="<?php echo base_url() ?>uploads/<?php echo $img; ?>" class="rounded-circle user_img">
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span>Chat with <?php echo $name; ?></span>
                <p><span id="chat_count"><?php echo $chat_count; ?></span> Messages</p>
            </div>
            <div class="video_cam">
                <!--                                <span><i class="fas fa-video"></i></span>
                                                <span><i class="fas fa-phone"></i></span>-->
            </div>
        </div>
        <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
        <div class="action_menu">
            <ul>
                <li><i class="fas fa-user-circle"></i> View profile</li>
                <li><i class="fas fa-users"></i> Add to close friends</li>
                <li><i class="fas fa-plus"></i> Add to group</li>
                <li><i class="fas fa-ban"></i> Block</li>
            </ul>
        </div>
    </div>
    <div class="card-body msg_card_body" id="contact">
        <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <?php foreach ($chat as $row) { ?>
            <?php if ($row['from_id'] == $id) { ?>

                <div class="d-flex justify-content-start mb-4">
                    <div class="msg_cotainer">
                        <span class="wid"><?php echo $row['message'] ?></span> <br>
                        <span class="msg_time"><?php echo $row['time'] ?> , <?php echo $row['date'] ?></span>
                    </div>
                </div>
            <?php } else { ?>
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                        <span class="wid"><?php echo $row['message'] ?></span> <br>
                        <span class="msg_time"><?php echo $row['time'] ?> , <?php echo $row['date'] ?></span>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    </div>
    <!--\\\\\\\\\\-->
    <?php $data = array('id' => "fupForm") ?>
    <?php echo form_open_multipart('admin/add_allow_exam_class', $data) ?>
    <div class="card-footer">
        <div class="input-group">
            <input type="hidden" name="to_id" value="<?php echo $id ?>">
            <input type="hidden" name="to_name" value="<?php echo $name ?>">
            <div class="input-group-append">
                <span class="input-group-text attach_btn"></i></span>
            </div>
            <input type="text" name="message" class="form-control type_msg" placeholder="Type your message...">
            <div class="input-group-append">
                <button type="submit" class="input-group-text send_btn"><i class="fas fa-2x fa-location-arrow"></i>
                </button>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
<?php } ?>
<?php if ($id) { ?>
    <script>

        $(document).ready(function (e) {

            $("#fupForm").on('submit', function (e) {
                var chat_count = parseInt($("#chat_count").text());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url()?>index.php/admin/admin_teacher_chat_add',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (msg) {
                        $("#contact").append(msg);
                        $("#chat_count").text(chat_count = chat_count + 1);

                    },
                    error: function () {

                    },

                });
            });
        });
    </script>

    <script>
        var x = 0;
        $(document).ready(function () {
            var y = $(".msg_card_body");
            y.scroll(function () {
                var z = y.scrollTop();
                if (z == 0) {
                    <?php if($chat_count >= $limit){?>
                    loadview_chat('admin_teacher_chat_data/<?php echo $id; ?>/<?php echo $name; ?>/<?php echo $img; ?>/<?php echo $limit + 10;?>/0');
                    <?php } ?>
                }
            });
        });
    </script>

<?php } ?>