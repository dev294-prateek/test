<body class="page-body  page-fade" >

<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">
        <div class="scroll">
        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="index.html">
                        <img class="logo" src="<?php echo base_url(); ?>assets/images/logo2.png" width="120" alt="">

                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse ">
                    <a href="#" class="sidebar-collapse-icon ">
                        <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>

            <!--=======================================================================================-->
            <ul id="main-menu" class="" style="">
                <li class="root-level">
                    <a onclick="loadview('dashboard')" >
                        <i class="entypo-flow-parallel"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>
                 <?php  $data=$this->guardian_model->all_student($_SESSION['user_id']); ?>
                <?php foreach ($data as $row){ ?>
                    <li class="root-level">
                        <a href="#">
                            <i class="entypo-user"></i>
                            <span> <?php  echo $row['student_name'] ?></span>

                        </a>
                        <ul class="" style="opacity: 0.2; height: 0px;">

<!--                            <li class="">
                                <a  onclick="loadview('student_dashboard/<?php /* echo $row["student_id"] */?>')" >
                                    <i class="entypo-flow-parallel"></i>
                                    <span></i>Dashboard</span>
                                </a>
                            </li>-->
                            <li class="">
                                <a  onclick="loadview('all_period/<?php  echo $row["section"] ?>')" >
                                    <i class="entypo-lifebuoy"></i>
                                    <span class="title">Period</span>
                                </a>
                            </li>
                            <li class="">
                                <a onclick="loadview('class_work/<?php  echo $row["section"] ?>')" >
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Class work</span>
                                </a>
                            </li>
                            <li class="">
                                <a onclick="loadview('home_work/<?php  echo $row["section"] ?>')" >
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Home Work</span>
                                </a>
                            </li>
                            <li class="">
                                <a  onclick="loadview('attendance_report/<?php  echo $row["student_id"] ?>/<?php  echo $row["class"] ?>/<?php  echo $row["section"] ?>')" >
                                    <i class="entypo-right-bold"></i>
                                    <span>Report</span>
                                </a>
                            </li>

                            <li style="display:none">
                                <a onclick="loadview('all_lesson_plan/<?php  echo $row["section"] ?>')">
                                    <i class="entypo-plus-circled"></i>
                                    <span class="title">Lesson Plan</span>
                                </a>
                            </li>
                            <li>
                                <a onclick="loadview('all_class_gallery/<?php  echo $row["section"] ?>')" >
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Class Gallery</span>
                                </a>
                            </li>
                            <li>
                                <a onclick="loadview('lib_book_stu_history/<?php  echo $row["student_id"] ?>')" >
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Library</span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('tabulation/<?php  echo $row["student_id"] ?>/<?php  echo $row["class"] ?>/<?php  echo $row["section"] ?>')">
                                    <i class="entypo-plus-circled"></i>
                                    <span class="title">Exam Marks </span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('student_fee/<?php  echo $row["class"] ?>/<?php  echo $row["section"] ?>/<?php  echo $row["student_id"] ?>')">
                                    <i class="entypo-plus-circled"></i>
                                    <span class="title">Fee </span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('pay_student_fee/<?php  echo $row["class"] ?>/<?php  echo $row["section"] ?>/<?php  echo $row["student_id"] ?>')">
                                    <i class="entypo-plus-circled"></i>
                                    <span class="title">Payment History  </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } ?>
                <li class="root-level">
                    <a onclick="loadview('all_school_gallery')" >
                        <i class="entypo-flow-parallel"></i>
                        <span class="title">School Gallery</span>
                    </a>

                </li>
                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++-->

                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <li class="root-level">
                    <a onclick="loadview('all_videos_gallery')" >
                        <i class="entypo-flow-parallel"></i>
                        <span class="title">School Video Gallery</span>
                    </a>
                </li>
                <li class="root-level">
                    <a onclick="loadview('view_noticeboard')" >
                        <i class="entypo-doc"></i>
                        <span>Noticeboard</span>
                    </a>
                </li>
                <li class="root-level">
                    <a onclick="loadview('event')">
                        <i class="entypo-plus-circled"></i>
                        <span class="title">Event Calender</span>
                    </a>
                </li>
           </ul>
            <!--=======================================================================================-->

        </div>
        </div>
    </div>

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-4 col-sm-4 clearfix">

                <ul class="user-info pull-left pull-none-xsm">
                    <li> <span class="user-title"><?php echo $_SESSION['running_year']; ?></span></li>

                </ul>


            </div>
            <div class="col-md-4 col-sm-4 clearfix" style="text-align: center;">
                <!------------------------------>
                <img class="logo" src="<?php echo base_url(); ?>uploads/<?php echo $setting['logo']; ?>" width="120" alt="">

                <!------------------------------>
            </div>


            <!-- Raw Links -->
            <div class="col-md-4 col-sm-4 clearfix hidden-xs">

                <ul class="list-inline links-list pull-right">

                  <!---->
                    <li class="dropdown language-selector">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                            <i class="entypo-user"></i> <?php echo $_SESSION['username']; ?><i class="entypo-down-open-mini"></i>
                        </a>

                        <ul class="dropdown-menu pull-left">
                            <li>  <a>
                                    <img src="<?php echo base_url() ?>uploads/<?php echo $_SESSION['profile_image']; ?>" alt=""
                                         class="img-circle" width="150"/>
                                </a></li>

                        </ul>
                    </li>
                  <!---->
                    <li>
                        <a href="<?php echo base_url('login/logout') ?>">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>

            </div>

        </div>
		<h5 style="text-align:center;color: darkgoldenrod;" class="page-title"><?php echo $_SESSION['school_name'] ?></h5>

        <hr/>
