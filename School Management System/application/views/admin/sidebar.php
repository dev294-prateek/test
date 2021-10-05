<body class="page-body  page-fade" >

<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">
      <div class="scroll">
        <div class="sidebar-menu-inner">

            <header class="logo-env">
                <!-- logo -->
                <div class="logo">
                    <a href="<?php echo base_url(); ?>/index.php/admin">
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
            <?php if($_SESSION['sub_user_role']=='admin') {?>
            <ul id="main-menu" class="" style="">
                 <li class="root-level">
                    <a onclick="loadview('dashboard')" >
                        <i class="entypo-gauge"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
				<li class="root-level">
                    <a onclick="loadview('dashboard2')" >
                        <i class="entypo-gauge"></i>
                        <span>Attendance Summary</span>
                    </a>
                </li>
                <li class="root-level">
                    <a onclick="loadview('fee_summary')" >
                        <i class="entypo-gauge"></i>
                        <span>Fee Summary</span>
                    </a>
                </li>

                <!--================================================ noticeboard =======================================================-->

                <li class="root-level">
                    <a href="#">
                        <i class="entypo-user"></i>
                        <span>Noticeboard</span>

                    </a>
                <ul class="" style="opacity: 0.2; height: 0px;">
                <li >
                    <a onclick="loadview('view_noticeboard')" >
                        <i class="entypo-doc"></i>
                        <span>Noticeboard</span>
                    </a>
                </li>
                <li >
                    <a onclick="loadview('noticeboard')" >
                        <i class="entypo-plus-circled"></i>
                        <span>Add Noticeboard</span>
                    </a>
                </li>
                </ul>
                <!--------------------------------------->

                <li class="root-level">
                    <a href="#">
                        <i class="entypo-monitor"></i>
                        <span>Expenditure</span>

                    </a>
                    <ul class="" style="opacity: 0.2; height: 0px;">
                        <li >
                            <a onclick="loadview('expanse')" >
                                <i class="entypo-doc"></i>
                                <span>Expenditure</span>
                            </a>
                        </li>
                        <li >
                            <a onclick="loadview('manage_expanse')" >
                                <i class="entypo-plus-circled"></i>
                                <span>Manage Expenditure</span>
                            </a>
                        </li>
                        <li >
                            <a onclick="loadview('all_expanse')" >
                                <i class="entypo-plus-circled"></i>
                                <span>All Expenditure</span>
                            </a>
                        </li>
                        <li >
                            <a onclick="loadview('day_expanse')" >
                                <i class="entypo-plus-circled"></i>
                                <span>Day Wise Expenditure</span>
                            </a>
                        </li>
                        <li >
                            <a onclick="loadview('month_expanse')" >
                                <i class="entypo-plus-circled"></i>
                                <span>Monthly Expenditure</span>
                            </a>
                        </li>
                    </ul>
                
                <!--$$$$$$$$$$$$$$$---STUDENT----$$$$$$$$$$$$$$$$-->
                <li class="root-level">
                    <a href="#">
                        <i class="entypo-user"></i>
                        <span> Student</span>

                    </a>
                    <ul class="" style="opacity: 0.2; height: 0px;">
                        <!-- STUDENT ADMISSION -->
                        <li class="">
                            <a  onclick="loadview('student')" >
                                <i class="entypo-plus-circled"></i>
                                <span> Admit Student</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('bulk_student')" >
                                <i class="entypo-plus-circled"></i>
                                <span> Admit Bulk Student</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('bulk_student_csv')" >
                                <i class="entypo-plus-circled"></i>
                                <span> Admit CSV Bulk Student</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('all_student_export')" >
                                <i class="entypo-plus-circled"></i>
                                <span> All Student Excel Export</span>
                            </a>
                        </li>
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
                            <a  onclick="loadview('attendance_analysis')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Attendance Analysis</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('assessment_report')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Assessment Report</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('promotion')" >
                                <i class="entypo-flow-parallel"></i>
                                <span></i>Promotion</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <!--=======================================================================================================-->

                                <!--$$$$$$$$$$$$$$$---Guardian-----$$$$$$$$$$$$$$$$-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-newspaper"></i>
                        <span class="title">Guardian</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('guardian')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Guardian</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_guardian')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> All Guardian</span>
                            </a>
                        </li>
                                                <li class="">
                            <a  onclick="loadview('bulk_guardian_csv')" >
                                <i class="entypo-plus-circled"></i>
                                <span>Bulk Guardian</span>
                            </a>
                        </li>
                    </ul>
                </li>
                                <!--================================================ employee ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-users"></i>
                        <span class="title">Employee</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('employee')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Employee</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_employee')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> All Employee</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('emp_attendance')" >
                                <i class="entypo-right-bold"></i>
                                <span>Daily Attendance </span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('emp_attendance_report')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Attendance Report</span>
                            </a>
                        </li>
                        <li class="">
                            <a  onclick="loadview('emp_attendance_analysis')" >
                                <i class="entypo-right-bold"></i>
                                <span>Monthly Attendance Analysis</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--================================================ Teacher ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-newspaper"></i>
                        <span class="title">Teacher</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('teacher')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Teacher</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('teacher_period')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> Teacher Period</span>
                            </a>
                        </li>
                    </ul>
                </li>


                                <!--================================================ Class ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-target"></i>
                        <span class="title">Class</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('all_class')">
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">All Class</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--================================================ Section ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-target"></i>
                        <span class="title">Section</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('section')">
                                <i class="entypo-plus"></i>
                                <span class="title">Add Section</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_section')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> All Section</span>
                            </a>
                        </li>

                    </ul>
                </li>




                <!--================================================ Class Work ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-globe"></i>
                        <span class="title">Class Work</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('add_class_work')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Class Work</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('class_work')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">Class Work</span>
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
                            <a onclick="loadview('add_home_work')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Home Work</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('home_work')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">Home Work</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--================================================ Period===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-lifebuoy"></i>
                        <span class="title">Period</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('period')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Period</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_period')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> All Period</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('time_table')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> Time Table</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-------------------------subjects-------------------------------------->
                <li class="root-level">
                    <a onclick="loadview('subjects')" >
                        <i class="entypo-address"></i>
                        <span>Subjects</span>
                    </a>
                </li>
                <!--================================================ Fee ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-lifebuoy"></i>
                        <span class="title">Fee</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('fee')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Fee</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('fee_section')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> Section Fee</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('student_fee')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title"> Student Fee</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('pay_student_fee')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">Pay Student Fee</span>
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
                <!--================================================ SCHOOL GELLERY ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-network"></i>
                        <span class="title">School Gallery</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('school_gallery')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('more_school_gallery')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Gallery Image</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_school_gallery')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">All Gallery</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--================================================ SCHOOL VIDEOS GELLERY ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-network"></i>
                        <span class="title">School Video Gallery</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('videos_gallery')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_videos_gallery')" >
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">All Gallery</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--================================================ Lesson Plan =====================================-->
                
                <li class="root-level">
                    <a  onclick="loadview('all_lesson_plan')" >
                        <i class="entypo-lifebuoy"></i>
                        <span class="title">Lesson Plan</span>
                    </a>
                </li>

                
                <!--================================================ Exam ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-newspaper"></i>
                        <span class="title">Exam</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('exam_grade')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Exam Grade</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('create_exam')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Create Exam</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('exam_marks')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Exam Marks</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('tabulation')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Tabulation Sheet </span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('marksheet')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Progress Reeport</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--================================================ Library ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-newspaper"></i>
                        <span class="title">Library</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('manage_book')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Book</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_book')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">All Book</span>
                            </a>
                        </li>


                    </ul>
                </li>
                <!--================================================ Transport ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-newspaper"></i>
                        <span class="title">Transport</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('vehicle')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Vehicle</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_vehicle')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">All Vehicle</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('driver')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Add Driver</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_driver')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">All Driver</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('route')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Route</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('alot_route')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Route Allotment</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--================================================================== Event =================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-newspaper"></i>
                        <span class="title">Event</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li>
                            <a onclick="loadview('event')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">Calender</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="loadview('all_event')">
                                <i class="entypo-plus-circled"></i>
                                <span class="title">All Event</span>
                            </a>
                        </li>


                    </ul>
                </li>
                 <!--================================================ Chat ===========================================-->
                <li class="has-sub root-level">
                    <a >
                        <i class="entypo-user"></i>
                        <span class="title">Chat</span>
                    </a>
                    <ul style="opacity: 0.2; height: 0px;">
                        <li >
                            <a onclick="loadview('admin_teacher_chat')" >
                                <i class="entypo-info"></i>
                                <span>Chat with teacher</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--=======================================================================================================-->
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
				<li class="root-level">
                    <a onclick="loadview('setting')" >
                        <i class="entypo-github"></i>
                        <span>Setting</span>
                    </a>
                </li>

            </ul>
            <?php } ?>

            <!--=======================================================================================-->
            <?php if($_SESSION['sub_user_role']=='Account Officer') {?>
                <ul id="main-menu" class="" style="">
                    <li class="root-level">
                        <a onclick="loadview('dashboard')" >
                            <i class="entypo-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!--------------------------------------->

                    <li class="root-level">
                        <a href="#">
                            <i class="entypo-monitor"></i>
                            <span>Expenditure</span>

                        </a>
                        <ul class="" style="opacity: 0.2; height: 0px;">
                            <li >
                                <a onclick="loadview('expanse')" >
                                    <i class="entypo-doc"></i>
                                    <span>Expenditure</span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('manage_expanse')" >
                                    <i class="entypo-plus-circled"></i>
                                    <span>Manage Expenditure</span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('all_expanse')" >
                                    <i class="entypo-plus-circled"></i>
                                    <span>All Expenditure</span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('day_expanse')" >
                                    <i class="entypo-plus-circled"></i>
                                    <span>Day Wise Expenditure</span>
                                </a>
                            </li>
                            <li >
                                <a onclick="loadview('month_expanse')" >
                                    <i class="entypo-plus-circled"></i>
                                    <span>Monthly Expenditure</span>
                                </a>
                            </li>
                        </ul>
                    <!--================================================ Fee ===========================================-->

                    <li class="root-level">
                        <a onclick="loadview('fee')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Add Fee</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('fee_section')" >
                            <i class="entypo-flow-parallel"></i>
                            <span class="title"> Section Fee</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('student_fee')" >
                            <i class="entypo-flow-parallel"></i>
                            <span class="title"> Student Fee</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('pay_student_fee')" >
                            <i class="entypo-flow-parallel"></i>
                            <span class="title">Pay Student Fee</span>
                        </a>
                    </li>

                    <li class="root-level">
                        <a onclick="loadview('fee_summary')" >
                            <i class="entypo-gauge"></i>
                            <span>Fee Summary</span>
                        </a>
                    </li>

                   <!--=======================================================================================================-->
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

            <?php } ?>
            <!--=======================================================================================-->
            <?php if($_SESSION['sub_user_role']=='Exam Incharge') {?>
                <ul id="main-menu" class="" style="">
                    <li class="root-level">
                        <a onclick="loadview('dashboard')" >
                            <i class="entypo-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!--================================================ Exam ===========================================-->

                    <li class="root-level">
                        <a onclick="loadview('exam_grade')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Exam Grade</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('create_exam')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Create Exam</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('exam_marks')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Exam Marks</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('tabulation')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Tabulation Sheet </span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('marksheet')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Progress Reeport</span>
                        </a>
                    </li>


                    <!--=======================================================================================================-->
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
            <?php } ?>
            <!--=======================================================================================-->
            <?php if($_SESSION['sub_user_role']=='Transport Incharge') {?>
                <ul id="main-menu" class="" style="">
                    <li class="root-level">
                        <a onclick="loadview('dashboard')" >
                            <i class="entypo-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!--================================================ Transport ===========================================-->
                    <li class="root-level">
                        <a onclick="loadview('vehicle')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Add Vehicle</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('all_vehicle')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">All Vehicle</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('driver')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Add Driver</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('all_driver')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">All Driver</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('route')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Route</span>
                        </a>
                    </li>

                    <!--=======================================================================================================-->
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
            <?php } ?>
            <!--=======================================================================================-->
            <?php if($_SESSION['sub_user_role']=='Librarian') {?>
                <ul id="main-menu" class="" style="">
                    <li class="root-level">
                        <a onclick="loadview('dashboard')" >
                            <i class="entypo-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!--================================================ Library ===========================================-->
                    <li class="root-level">
                        <a onclick="loadview('manage_book')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">Add Book</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a onclick="loadview('all_book')">
                            <i class="entypo-plus-circled"></i>
                            <span class="title">All Book</span>
                        </a>
                    </li>

                    <!--=======================================================================================================-->
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
            <?php } ?>
            <!--=======================================================================================-->
            <?php if($_SESSION['sub_user_role']=='Academic Head') {?>
                <ul id="main-menu" class="" style="">
                    <li class="root-level">
                        <a onclick="loadview('dashboard')" >
                            <i class="entypo-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="root-level">
                        <a  onclick="loadview('all_lesson_plan')" >
                            <i class="entypo-lifebuoy"></i>
                            <span class="title">Lesson Plan</span>
                        </a>
                    </li>


                </ul>
            <?php } ?>
            <!--=======================================================================================-->

        </div>
      </div>
    </div>

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-4 col-sm-4 clearfix">
                <ul class="user-info pull-left pull-none-xsm">
                   <li>  
                   <!-- ============================change session================================= -->
                        <select class="form-control" onchange="change_session(this.value)">
                        <option value="ezedu_RRSGS-AMTI-01_2019_2020" <?php if($_SESSION['dynamic_db']=="ezedu_RRSGS-AMTI-01_2019_2020"){ echo'selected';} ?> >2019-2020</option>
                        <option value="ezedu_RRSGS-AMTI-01_2020_2021" <?php if($_SESSION['dynamic_db']=="ezedu_RRSGS-AMTI-01_2020_2021"){ echo'selected';} ?> >2020-2021</option>
                        <option value="ezedu_RRSGS-AMTI-01_2021_2022" <?php if($_SESSION['dynamic_db']=="ezedu_RRSGS-AMTI-01_2021_2022"){ echo'selected';} ?> >2021-2022</option>
                        </select>
                  <!-- ============================endchange session================================= -->                    
                </li>
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
    
<script>
// ============================change session=================================
    function change_session(v){
        $.ajax({
            url: '<?php echo base_url()?>index.php/admin/change_session',
            type:"POST",
            datatype:"json",
            data:{session:v},
            success: function (msg) {
                location.reload();
                // alert(msg);
            },
            error: function () {
                alert('error')

            }
        })
    }
    // ============================ End change session=================================
</script>

