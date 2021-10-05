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
                        <i class="entypo-gauge"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!--$$$$$$$$$$$$$$$---STUDENT----$$$$$$$$$$$$$$$$-->
                <?php if($_SESSION['class_id'] && $_SESSION['sub_user_role']=='Teacher') { ?> 
                <li class="root-level">
                    <a href="#">
                        <i class="entypo-user"></i>
                        <span> Student</span>

                    </a>
                    <ul class="" style="opacity: 0.2; height: 0px;">

                        <li class="">
                            <a  onclick="loadview('all_student')" >
                                <i class="entypo-flow-parallel"></i>
                                <span></i>All Student</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('attendance')" >
                                <i class="entypo-right-bold"></i>
                                <span>Daily Attendance </span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('attendance_report')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Attendance Report</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('assessment_report')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Assessment Report</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('attendance_analysis')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Attendance Analysis</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <!--================================================ Period===========================================-->
                <li class="has-sub root-level">
                    <a  onclick="loadview('all_period')" >
                        <i class="entypo-lifebuoy"></i>
                        <span class="title">Period</span>
                    </a>
                </li>
                <!--================================================ Class work ===========================================-->

                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-globe"></i>
                        <span class="title">Class Work</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('add_class_work_t')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Class Work</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_class_work')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">All Class Work</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('class_work')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">Calendar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--================================================ home Work ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-network"></i>
                        <span class="title">Home Work</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('add_home_work_t')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Home Work</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_home_work')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">All Home Work</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('home_work')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">Calendar</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <!--================================================ Exam===========================================-->
                <li class="has-sub root-level">
                    <a  onclick="loadview('exam')" >
                        <i class="entypo-lifebuoy"></i>
                        <span class="title">Exam</span>
                    </a>
                </li>
                <li class="has-sub root-level">
                    <a onclick="loadview('tabulation')">
                        <i class="entypo-plus-circled"></i>
                        <span class="title">Tabulation Sheet </span>
                    </a>
                </li>
                <!--================================================ Lesson Plan =====================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-network"></i>
                        <span class="title">Lesson Plan</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                <li>
                    <a onclick="loadview('add_lesson_plan_t')">
                        <i class="entypo-plus-circled"></i>
                        <span class="title">Add Lesson Plan</span>
                    </a>
                </li>
                <li>
                    <a onclick="loadview('all_lesson_plan')">
                        <i class="entypo-plus-circled"></i>
                        <span class="title">All Lesson Plan</span>
                    </a>
                </li>
                    </ul>
                </li>
                <!--================================================ CLASS GELLERY ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-network"></i>
                        <span class="title">Class Gallery</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('class_gallery')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('more_class_gallery')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Gallery Image</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_class_gallery')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">All Gallery</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <li class="root-level">
                    <a onclick="loadview('all_school_gallery')" >
                        <i class="entypo-flow-parallel"></i>
                        <span class="title">School Gallery</span>
                    </a>
                </li>

                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <li class="root-level">
                    <a onclick="loadview('all_videos_gallery')" >
                        <i class="entypo-flow-parallel"></i>
                        <span class="title">School Video Gallery</span>
                    </a>
                </li>
                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <li class="root-level">
                    <a onclick="loadview('event')">
                        <i class="entypo-plus-circled"></i>
                        <span class="title">Event Calender</span>
                    </a>
                </li>
                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-user"></i>
                        <span class="title">Chat</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li >
                            <a onclick="loadview('admin_teacher_chat')" >
                                <i class="entypo-info"></i>
                                <span>Chat with Admin</span>
                            </a>
                        </li>
<!--                        <li >
                            <a onclick="loadview('guardian_teacher_chat/<?php /*echo($_SESSION["user_id"]); */?>')" >
                                <i class="entypo-info"></i>
                                <span>Chat with Guardian</span>
                            </a>
                        </li>-->
                    </ul>
                </li>
                <!--=======================================================================================================-->
                <li>
                    <a onclick="loadview('lib_book_emp_history/<?php echo($_SESSION["user_id"]); ?>')" >
                        <i class="entypo-flow-parallel"></i>
                        <span class="title">Library</span>
                    </a>
                </li>
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-user"></i>
                        <span class="title">Profile</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                <li >
                    <a onclick="loadview('edit_employee/<?php echo($_SESSION["user_id"]); ?>')" >
                        <i class="entypo-info"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li >
                    <a href="<?php echo base_url(); ?>/login/logout" >
                         <i class="entypo-logout right"></i>
                        <span>Log Out</span>
                    </a>
                </li>
                    </ul>
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
                            <li>
                                <a onclick="loadview('edit_employee/<?php echo($_SESSION["user_id"]); ?>')" >
                                    <i class="entypo-info"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a onclick="loadview('edit_employee/<?php echo($_SESSION["user_id"]); ?>')" >
                                    <i class="entypo-key"></i>
                                    <span>Change Password</span>
                                </a>
                            </li>
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
