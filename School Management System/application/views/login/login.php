<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ezedu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php base_url()?>assets/login/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url()?>assets/login/css/main.css">
    <style>
        img.logo {
            width: 100px;
        }
        .form-radio
        {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            position: relative;
            background: -webkit-linear-gradient(bottom, #7579ff,white, #b224ef);
            color: #666;
            top: 10px;
            height: 30px;
            width: 30px;
            border: 0;
            border-radius: 50px;
            cursor: pointer;
            margin-right: 7px;
            outline: none;
        }
        .form-radio:checked::before
        {
            position: absolute;
            font: 13px/1 'Open Sans', sans-serif;
            left: 11px;
            top: 7px;
            content: '\02143';
            transform: rotate(40deg);
        }
        .form-radio:hover
        {
            background-color: #f7f7f7;
        }
        .form-radio:checked
        {
            background-color: #f1f1f1;
        }
        label
        {
            font: 300 16px/1.7 'Open Sans', sans-serif;
            color: #666;
            cursor: pointer;
        }

    </style>
    <!--===============================================================================================-->
</head>
<body>

<?php //print_r($setting); ?>

<div class="limiter">
    <div class="container-login100" style="background-image: url('<?php base_url()?>uploads/<?php echo $setting['background']?>');">
        <div class="wrap-login100">
              <?php $attributes = array('class' => 'login100-form validate-form');
              echo form_open('login/login', $attributes); ?>
					<span class="login100-form-logo">
						 <img class="logo" src="<?php base_url()?>uploads/<?php echo $setting['logo']?>">
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                  <!---------------------------->
            <div id="message">
                <?php if( $this->session->flashdata('item')){ ?>
                    <div class="alert alert-warning">
                        <?php echo $this->session->flashdata('item'); ?>
                    </div>
                <?php } ?>
            </div>

            <!---------------------------->
            <div class="wrap-input100" style="color: white;border-bottom: none">
                <input class="form-radio" type="radio" name="type" value="teacher" checked onclick="change1()"> Employee
                <span style="margin-left: 22%;"><input  class="form-radio" type="radio" name="type" value="Student" onclick="change2()"> Student </span>

            </div>
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input id="user" class="input100" type="text" name="username" placeholder="Username">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>



                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-30">
                    <a class="txt1" href="#">

                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
<script>
    function change1() {
        $("#user").attr("placeholder", "User Name or Phone Number");
        $("#user").attr("type", "text");
    }
    function change2() {
        $("#user").attr("placeholder", "Email or Phone Numbber");
        $("#user").attr("type", "email");
    }
</script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/vendor/bootstrap/js/popper.js"></script>
<script src="<?php base_url()?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/vendor/daterangepicker/moment.min.js"></script>
<script src="<?php base_url()?>assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url()?>assets/login/js/main.js"></script>

</body>
</html>