<?php

require(APPPATH . '/libraries/REST_Controller.php');

class V1 extends REST_Controller
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('sch_model');
        $this->load->helper('url');
    }
    /*############################################################################################*/
    /*###################################  PARENT CONTROLLER #####################################*/
    /*############################################################################################*/

//  http://localhost/school/v1/parentlogin
    function parentlogin_get()
    {
        $email = $this->get('email');
        $password = $this->get('password');
        $x = $this->sch_model->parentLogin($email, $password);
        if ($x) {
            $parent = $this->sch_model->getParent($email, $password);

            $response['status'] = "1";
            $response['error_msg'] = "";

            $ss['parent_id'] = $parent['guardian_id'];
            $ss['name'] = $parent['guardian_name'];
            $ss['email'] = $parent['email'];
            $ss['phone'] = $parent['guardian_mobile'];
            $ss['address'] = $parent['guardian_home_address'];
            $ss['profession'] = $parent['guardian_occupation'];

            $response['data'] = [$ss];
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "Invalid username or password";
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/childList
    function childList_get()
    {
        $guardian_id = $this->get('guardian_id');
        $guardian = $this->sch_model->getChildList($guardian_id);
        if ($guardian) {

            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($guardian as $row1) {
                $temp1 = array();
                $temp1['student_id'] = $row1['student_id'];
                $temp1['student_code'] = $row1['admission_no'];
                $temp1['name'] = $row1['student_name'];
                $temp1['roll'] = $this->sch_model->roll_no($row1['student_id']);
                $temp1['class_id'] = $row1['class'];
                $temp1['class'] = $this->sch_model->class_name($row1['class']);
                $temp1['section_id'] = $row1['section'];
                $temp1['section'] = $this->sch_model->section_name($row1['section']);
                $temp1['image'] = base_url().'uploads/'.$row1['student_image'];
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/class_teacher
    function class_teacher_get()
    {
        $student_id = $this->get('student_id');
        $response = array();
        $teacher_id = $this->sch_model->class_teacher_list($student_id);
        $response1['data'] = array();
        $response['teacher_id'] = $teacher_id;
        $response['teacher_name'] = $this->sch_model->class_teacher_name($teacher_id);
        $response['account_type'] = "Teacher";
        array_push($response1['data'], $response);
        $this->response($response, 200);
    }
//  http://localhost/school/v1/update_token
    function update_token_get()
    {
        $parent_id = $this->get('parent_id');
        $token = $this->get('token');
        $response = array();
        $res = $this->sch_model->update_token($parent_id, $token);
        if ($res) {
            $response["error"] = false;
            $response["message"] = "Token update successfully.";
            $this->response($response, 201);
        } else {
            $response["error"] = true;
            $response["message"] = "Oops! An error occurred while updating Token.";
            $this->response($response, 200);
        }
        return $res;
    }
//  http://localhost/school/v1/homeWork
    function homeWork_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $home_work = $this->sch_model->getHomeWork($student_id);
        if ($home_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($home_work as $row1) {
                $temp1 = array();
                $temp1['home_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];

                //$temp1['attachment'] = $row1['attachment'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }

                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/homeWorkToday
    function homeWorkToday_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $home_work = $this->sch_model->getHomeWorkToday($student_id);
        if ($home_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($home_work as $row1) {
                $temp1 = array();
                $temp1['home_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];

                //$temp1['attachment'] = $row1['attachment'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }

                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);

    }
//  URL: http://localhost/school/v1/classWork
    function classWork_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $class_work = $this->sch_model->getClassWork($student_id);
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($class_work as $row1) {
                $temp1 = array();
                $temp1['class_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];

                //$temp1['attachment'] = $row1['attachment'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }

                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/classWorkToday
    function classWorkToday_post()
    {

        $student_id = $this->post('student_id');
        $response = array();
        $class_work = $this->sch_model->getClassWorkToday($student_id);
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($class_work as $row1) {
                $temp1 = array();
                $temp1['home_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];

                //$temp1['attachment'] = $row1['attachment'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }

                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);

    }
//  http://localhost/school/v1/studentSubject
    function studentSubject_get()
    {
        $student_id = $this->get('student_id');
        $response = array();
        $subjects = $this->sch_model->student_subject($student_id);
        if ($subjects) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($subjects as $row1) {
                $temp1 = array();
                $temp1['subject_id'] = $row1['subject_id'];
                $temp1['subject_name'] = $this->sch_model->subject_name($row1['subject_id']);

                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);

    }
//  http://localhost/school/v1/lessonPlan
    function lessonPlan_get()
    {
        $student_id = $this->get('student_id');
        $subject_id = $this->get('subject_id');
        $response = array();
        $lessonPlan = $this->sch_model->lessonPlan($student_id, $subject_id);

        if ($lessonPlan) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();
            foreach ($lessonPlan as $row1) {
                $temp1 = array();
                $temp1['home_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['objective'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }
                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/timeTable
    function timeTable_post()
    {
        $student_id = $this->post('student_id');
        $response = array();

        $time_table = $this->sch_model->getTimeTable($student_id);
        if ($time_table) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($time_table as $row1) {
                $temp1 = array();

                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);

                $temp1['day'] = $row1['day'];
                $temp1['time'] = date('h:ia', strtotime($row1['start_time'])) . " - " . date('h:ia', strtotime($row1['end_time']));
                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);

    }
//  http://localhost/school/v1/noticeBoard
    function noticeBoard_get()
    {

        $noticeboard = $this->sch_model->getNoticeBoard();
        if ($noticeboard) {
            $response = array();
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($noticeboard as $row1) {
                $temp1 = array();

                $temp1['title'] = $row1['title'];
                $temp1['notice'] = $row1['notice'];
                $temp1['date'] = $row1['date'];
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/noticeBoardToday
    function noticeBoardToday_post()
    {

        $noticeboard = $this->sch_model->getNoticeBoardToday();
        if ($noticeboard) {
            $response = array();
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();


            foreach ($noticeboard as $row1) {
                $temp1 = array();
                $temp1['title'] = $row1['title'];
                $temp1['notice'] = $row1['notice'];
                $temp1['date'] = $row1['date'];

                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/schoolGallery
    function schoolGallery_get()
    {

        $school_gallery = $this->sch_model->getSchoolGallery();
        if ($school_gallery) {
            $response = array();
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($school_gallery as $row1) {
                $temp1 = array();
                $temp1['school_gallery_id'] = $row1['id'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];
                if ($row1['image'] != '') {
                    $temp1['thumb'] =  base_url() . 'uploads/'  . $row1['image'];
                } else {
                    $temp1['thumb'] = '';
                }

                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/schoolGalleryPhotos
    function schoolGalleryPhotos_post()
    {
        $school_gallery_id = $this->post('school_gallery_id');
        $response = array();
        $school_gallery_photos = $this->sch_model->getschoolGalleryPhotos($school_gallery_id);


        if ($school_gallery_photos) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($school_gallery_photos as $row1) {
                $temp1 = array();
                $temp1['school_gallery_id'] = $row1['class_gallery_id'];
                if ($row1['image'] != '') {
                    $temp1['photo'] =  base_url() . 'uploads/'  . $row1['image'];
                } else {
                    $temp1['photo'] = '';
                }

                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/classGallery
    function classGallery_post()
    {

        $student_id = $this->post('student_id');

        $class_gallery = $this->sch_model->getClassGallery($student_id);
        if ($class_gallery) {
            $response = array();
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($class_gallery as $row1) {
                $temp1 = array();
                $temp1['school_gallery_id'] = $row1['id'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];
                if ($row1['image'] != '') {
                    $temp1['thumb'] =  base_url() . 'uploads/'  . $row1['image'];
                } else {
                    $temp1['thumb'] = '';
                }

                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/classGalleryPhotos
    function classGalleryPhotos_post()
    {


        $class_gallery_id = $this->post('class_gallery_id');
        $response = array();
        $class_gallery_photos = $this->sch_model->getClassGalleryPhotos($class_gallery_id);


        if ($class_gallery_photos) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($class_gallery_photos as $row1) {
                $temp1 = array();
                $temp1['class_gallery_id'] = $row1['class_gallery_id'];
                if ($row1['image'] != '') {
                    $temp1['photo'] =  base_url() . 'uploads/'  . $row1['image'];
                } else {
                    $temp1['photo'] = '';
                }

                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/attendanceAll
    function attendanceAll_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $attendance = $this->sch_model->all_attendance($student_id);

        if ($attendance) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($attendance as $row1) {
                $temp1 = array();

                if ($row1['attendance'] == '1') {
                    $status = "Present";
                } else if ($row1['attendance'] == '3') {
                    $status = "Absent";
                } else if ($row1['attendance'] == '2') {
                    $status = "Leave";
                } else {
                    $status = "";
                }

                $temp1['timestamp'] = strtotime($row1['date']);
                $temp1['date'] = $row1['date'];

                $temp1['status'] = $status;
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/attendance
    function attendance_post()
    {
        $student_id = $this->post('student_id');
        $month = $this->post('month');

        $response = array();
        $attendance = $this->sch_model->get_attendance($student_id, $month);

        if ($attendance) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($attendance as $row1) {
                $temp1 = array();

                if ($row1['attendance'] == '1') {
                    $status = "Present";
                } else if ($row1['attendance'] == '3') {
                    $status = "Absent";
                } else if ($row1['attendance'] == '2') {
                    $status = "Leave";
                } else {
                    $status = "";
                }

                $temp1['timestamp'] = strtotime($row1['date']);
                $temp1['date'] = $row1['date'];

                $temp1['status'] = $status;
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/attendance
    function attendanceCount_post()
    {
        $student_id = $this->post('student_id');
        $month = $this->post('month');

        $response = array();
        $attendance = $this->sch_model->get_attendance($student_id, $month);

        if ($attendance) {
            $response['status'] = "1";
            $response['error_msg'] = "";
//            $response['data'] = array();
               $present_count=0;
               $absent_count=0;
               $leave_count=0;
            foreach ($attendance as $row1) {
                $temp1 = array();

                if ($row1['attendance'] == '1') {
                    $status = "Present";
                    $present_count++;
                } else if ($row1['attendance'] == '3') {
                    $status = "Absent";
                    $absent_count++;
                } else if ($row1['attendance'] == '2') {
                    $status = "Leave";
                    $leave_count++;
                } else {
                    $status = "";
                }
                $temp1['timestamp'] = strtotime($row1['date']);
                $temp1['date'] = $row1['date'];

                $temp1['status'] = $status;
//                array_push($response['data'], $temp1);
            }
            $response['present']=$present_count;
            $response['absent']=$absent_count;
            $response['leave']=$leave_count;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/assessmentAll
    function assessmentAll_get()
    {
        $student_id = $this->get('student_id');
        $response = array();
        $attendance = $this->sch_model->all_attendance($student_id);

        if ($attendance) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($attendance as $row1) {
                $temp1 = array();
                $temp1['punctuality'] = $row1['punctuality'];
                $temp1['cleanliness'] = $row1['cleanliness'];
                $temp1['attentiveness'] = $row1['attentiveness'];
                $temp1['handwriting'] = $row1['handwriting'];
                $temp1['interactive'] = $row1['interactive'];
                $temp1['homework'] = $row1['homework'];
                $temp1['classwork'] = $row1['classwork'];
                $temp1['remark'] = $row1['remark'];
                $temp1['timestamp'] = strtotime($row1['date']);
                $temp1['date'] = $row1['date'];
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/assessment
    function assessment_get()
    {
        $student_id = $this->get('student_id');
        $month = $this->get('month');

        $response = array();
        $attendance = $this->sch_model->get_attendance($student_id, $month);

        if ($attendance) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($attendance as $row1) {
                $temp1 = array();
                $temp1['punctuality'] = $row1['punctuality'];
                $temp1['cleanliness'] = $row1['cleanliness'];
                $temp1['attentiveness'] = $row1['attentiveness'];
                $temp1['handwriting'] = $row1['handwriting'];
                $temp1['interactive'] = $row1['interactive'];
                $temp1['homework'] = $row1['homework'];
                $temp1['classwork'] = $row1['classwork'];
                $temp1['remark'] = $row1['remark'];
                $temp1['timestamp'] = strtotime($row1['date']);
                $temp1['date'] = $row1['date'];
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/studentProfile
    function studentProfile_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $student_profile = $this->sch_model->getStudentProfile($student_id);
        if ($student_profile) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();
            $image_url = "";
            $temp1 = array();
            $temp1['student_id'] = $student_profile['student_id'];
            $temp1['admission_no'] = $student_profile['admission_no'];
            $temp1['student_name'] = $student_profile['student_name'];
            $temp1['class'] = $this->sch_model->class_name($student_profile['class']);
            $temp1['section'] = $this->sch_model->section_name($student_profile['section']);
            $temp1['gender'] = $student_profile['gender'];
            $temp1['birthday'] = $student_profile['birthday'];
            $temp1['aadhaar_no'] = $student_profile['aadhaar_no'];
            $temp1['nationality'] = $student_profile['nationality'];
            $temp1['Religion'] = $student_profile['Religion'];
            $temp1['guardian'] = $student_profile['guardian'];
            $temp1['relation_to_guardian'] = $student_profile['relation_to_guardian'];
            $temp1['mother'] = $student_profile['mother'];
            $temp1['father'] = $student_profile['father'];
            $temp1['sc_st'] = $student_profile['sc_st'];
            $temp1['language_known'] = $student_profile['language1'] . ',' . $student_profile['language2'] . ',' . $student_profile['language3'] . ',' . $student_profile['language4'];
            $temp1['distance_from_school'] = $student_profile['distance_from_school'];
            $temp1['mobile_no_for_sms'] = $student_profile['mobile_no_for_sms'];
            if ($student_profile['student_image']) {
                $temp1['image'] = base_url() . 'uploads/' . $student_profile['student_image'];
            } else {
                $temp1['image'] = base_url() . 'uploads/stu.jpg';
            }


            array_push($response['data'], $temp1);


        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);

    }
//  http://localhost/school/v1/studentProfile
    function eventCalander_post()
    {
        $response = array();
        $all_event = $this->sch_model->all_event();
        if ($all_event) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();
            foreach ($all_event as $row1) {

                $temp1 = array();
                $temp1['id'] = $row1['id'];
                $temp1['title'] = $row1['title'];
                $temp1['start_date'] = $row1['start_date'];
                $temp1['end_date'] = $row1['end_date'];
                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function annualFee_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $section_fee = $this->sch_model->list_section_fee_by_section_id($student_id);
        if ($section_fee) {
            $response['status'] = "1";
            $response['error_msg'] = "";

            $response['data'] = array();
            $total = 0;
            $id = 1;
            foreach ($section_fee as $row1) {

                $temp1 = array();
                $temp1['id'] = $id++;
                $temp1['fee_name'] = $this->sch_model->fee_by_id($row1['fee_id']);
                $temp1['type'] =$this->sch_model->fee_type_name($row1['type']);
                $temp1['amount'] = $row1['total'];
                $total += $row1['total'];
                array_push($response['data'], $temp1);
            }
            $response['grand_total'] = $total;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function paymentHistory_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $payment_history = $this->sch_model->payment_history($student_id);
        if ($payment_history) {
            $response['status'] = "1";
            $response['error_msg'] = "";

            $response['data'] = array();
            $total = 0;
            $id = 1;
            foreach ($payment_history as $row1) {

                $temp1 = array();
                $temp1['id'] = $id++;
                $temp1['amount'] = $row1['amount'];
                $temp1['discount'] = $row1['discount'];
                $temp1['penalty'] = $row1['penalty'];
                $temp1['payable'] = $row1['payable'];
                $total += $row1['payable'];
                $temp1['late_fee'] = $row1['late_fee'];
                $temp1['month_no'] = $row1['month_no'];
                $temp1['date'] = $row1['date'];

                array_push($response['data'], $temp1);
            }
            $response['grand_total'] = $total;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function examSchedule_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $list_all_exam = $this->sch_model->list_all_exam($student_id);
        if ($list_all_exam) {
            $response['status'] = "1";
            $response['error_msg'] = "";

            $response['data'] = array();
            foreach ($list_all_exam as $row1) {
                $temp1 = array();
                $temp1['id'] = $row1['id'];
                $temp1['name'] = $row1['name'];
                $temp1['date_from'] = $row1['date_from'];
                $temp1['date_to'] = $row1['date_to'];
                $temp1['type'] = $this->sch_model->list_exam_type_by_id($row1['type']);
                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function listAllExam_post()
    {
        $student_id = $this->post('student_id');
        $response = array();
        $list_all_exam = $this->sch_model->list_all_exam($student_id);
        if ($list_all_exam) {
            $response['status'] = "1";
            $response['error_msg'] = "";

            $response['data'] = array();
            foreach ($list_all_exam as $row1) {
                $temp1 = array();
                $temp1['id'] = $row1['id'];
                $temp1['name'] = $row1['name'];
                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function examTimeTable_get()
    {
        $student_id = $this->get('student_id');
        $exam_id = $this->get('exam_id');
        $response = array();
        $list_all_exam = $this->sch_model->list_all_exam_allowed_section_subject($student_id,$exam_id);
        if ($list_all_exam) {
            $response['status'] = "1";
            $response['error_msg'] = "";

            $response['data'] = array();
            $id=1;
            foreach ($list_all_exam as $row1) {
                $temp1 = array();
                $temp1['id'] = $id++;
                $temp1['subject'] = $this->sch_model->list_subjects_by_id($row1['subject_id']);
                $temp1['paper_id'] =  $this->sch_model->paper_name($row1['paper_id']);
                $temp1['max'] = $row1['max'];
                $temp1['min'] = $row1['min'];
                $temp1['syllabus'] =base_url() . 'uploads/' . $row1['syllabus'];
                $temp1['study_material'] = base_url() . 'uploads/' .$row1['study_material'];
                $temp1['exam_date'] = $row1['exam_date'];
                $temp1['start_time'] = $row1['start_time'];
                $temp1['end_time'] = $row1['end_time'];
                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function markTabulation_post()
    {
        $student_id = $this->post('student_id');
        $exam_id = $this->post('exam_id');
        $response = array();
        $list_all_exam = $this->sch_model->exam_mark_data_tabulation($student_id,$exam_id);
        if ($list_all_exam) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();
            $id=1; $total=0;
            foreach ($list_all_exam as $row1) {
                $temp1 = array();
                $temp1['id'] = $id++;
                $temp1['subject'] = $this->sch_model->list_subjects_by_id($row1['subject_id']);
                $temp1['paper_id'] =  $this->sch_model->paper_name($row1['paper_id']);
                $temp1['marks'] = $row1['marks'];
                $total += $row1['marks'];
                $temp1['max'] = $row1['max'];
                $temp1['min'] = $row1['min'];
                array_push($response['data'], $temp1);
            }
            $response['grand_total'] = $total;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/annualFee
    function libHistory_get(){
        $id = $this->get('student_id');
        $data=$this->sch_model->book_history_by_stu_id($id);
        if ($data) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = $data;

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);

    }

    /*############################################################################################*/
    /*################################### TEACHER CONTROLLER #####################################*/
    /*############################################################################################*/
//  http://localhost/school/v1/teacherlogin
    function teacherlogin_get()
    {
        $username = $this->get('username');
        $password = $this->get('password');
        $x = $this->sch_model->validate_login($username, $password);
        if ($x) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $y['employee_image'] = base_url().'uploads/'.$x['employee_image'];
            $y['teacher_id']=$this->sch_model->teacher_id_by_employee_id($x['employee_id']);
            $y['employee_id']=$x['employee_id'];
            $y['name']=$x['employee_id'];
            $y['employee_type']=$x['employee_type'];
            $y['name']=$x['name'];
            $y['gender']=$x['gender'];
            $y['joining_date']=$x['joining_date'];
            $y['contact_no']=$x['contact_no'];
            $y['email']=$x['email'];

            $response['data'] = [$y];
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "Invalid username or password";
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/teacherProfile
    function teacherProfile_get()
    {
        $employee_id = $this->get('employee_id');
        $x = $this->sch_model->teacher_rofile($employee_id);
        if ($x) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $y['employee_image'] = base_url().'uploads/'.$x['employee_image'];
            $y['teacher_id']=$this->sch_model->teacher_id_by_employee_id($x['employee_id']);
            $y['employee_id']=$x['employee_id'];
            $y['name']=$x['employee_id'];
            $y['employee_type']=$x['employee_type'];
            $y['name']=$x['name'];
            $y['gender']=$x['gender'];
            $y['joining_date']=$x['joining_date'];
            $y['contact_no']=$x['contact_no'];
            $y['email']=$x['email'];

            $response['data'] = $y;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "no result found";
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/teacherSection
    function teacherSection_get()
    {
        $employee_id = $this->get('employee_id');
        $x = $this->sch_model->class_section($employee_id);
        if ($x) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $y['class']=$this->sch_model->class_name_by_id($x['class_id']);
            $y['section']=$x['name'];

            $response['data'] = $y;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "no result found";
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/allStudent
    function allStudent_get()
    {
        $teacher_id = $this->get('teacher_id');
        $x = $this->sch_model->all_student($teacher_id);
        if ($x) {

            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach($x as $row1) {
                $temp1 = array();
                $temp1['student_id'] = $row1['student_id'];
                $temp1['student_code'] = $row1['admission_no'];
                $temp1['name'] = $row1['student_name'];
                $temp1['roll_no'] = $this->sch_model->roll_no($row1['student_id']);
                $temp1['class'] = $this->sch_model->class_name($row1['class']);
                $temp1['section'] = $this->sch_model->section_name($row1['section']);
                $temp1['image'] = base_url().'uploads/'.$row1['student_image'];

                array_push($response['data'], $temp1);
            }
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/attendance
    function attendance_get(){
        $teacher_id = $this->get('teacher_id');
        $y=$this->sch_model->class_section($teacher_id);
        $cl=$y['class_id'];
        $sec=$y['section_id'];
        $d=date('Y-m-d');

        if($d==''){$d=date('Y-m-d');}
        $response['status'] = "1";
        $response['error_msg'] = "";
        $response['data'] = array();
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->sch_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->sch_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->sch_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->sch_model->get_attendance_teach($cl, $sec,$d);

            foreach($xx as $row){
                $temp=array();
                $temp['student_name']=$this->sch_model->student_name($row['student_id']);
                $temp ['id'] = $row['id'];
                $temp ['class_id'] = $row['class_id'];
                $temp ['attendance'] = $row['attendance'];
                $temp ['punctuality'] = $row['punctuality'];
                $temp ['cleanliness'] =  $row['cleanliness'];
                $temp ['attentiveness'] =  $row['attentiveness'];
                $temp ['handwriting'] = $row['handwriting'];
                $temp ['homework'] =  $row['homework'];
                $temp ['classwork'] =  $row['classwork'];
                $temp ['remark'] =  $row['remark'];
                $temp ['date'] =  $row['date'];
                array_push($response['data'],$temp);
            }

        }
        else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/updateAttendance
    function updateAttendance_get(){
        $c_id=$this->get('c_id');
        $id=$this->get('id');
        $attr=$this->get('attr');
        $value=$this->get('value');
        $name=$this->get('name');
        $data=array($attr=>$value);
        if($data){
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();
            $x=$this->sch_model->update_attendance($id, $c_id,$data);
            if($x==1){
                $response['data']= $attr.' of Mr '. $name .' updated Successfully';
            }else{
                $response['data']= 'unable to update '.$attr.'  of Mr '. $name;
            }
        }
        else{
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/smsAttendance
    function smsAttendance_get(){
        $teacher_id = $this->get('teacher_id');
        $y=$this->sch_model->class_section($teacher_id);
        $cl=$y['class_id'];
        $sec=$y['section_id'];
        $d=date('Y-m-d');
        $sms_data = $this->sch_model->get_attendance_for_sms($cl, $sec,$d);
        foreach ($sms_data as $row ){
            $status='';
            $data=$this->sch_model->student_name_mobile_sms($row['student_id']);
            $mobile=$data['mobile_no_for_sms'];
            $name=$data['student_name'];
            if($row['attendance']==1){$status="Present";}
            if($row['attendance']==0){$status="Absent";}
            if($row['attendance']==2){$status="On Leave";}
            $msg= 'Mr '. $name . ' is ' . $status . ' on '. $d ;
            $response['data']="success";
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/attendanceReport1
    function attendanceReport1_get(){
        $teacher_id = $this->get('teacher_id');
        $month = $this->get('month');
        $y=$this->sch_model->class_section($teacher_id);
        $cl=$y['class_id'];
        $sec=$y['section_id'];
        $data['year']='';
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
            $data['students']=$this->sch_model->all_student_by_section_id($sec);
            $data['year']=$this->sch_model->get_attendance_report_year($cl,$sec,$month);
            print_r($data);
        }else{
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

    }
//  http://localhost/school/v1/assessmentReport
    function attendanceReport_get(){
        $teacher_id = $this->get('teacher_id');
        $month = $this->get('month');
        $y=$this->sch_model->class_section($teacher_id);
        $cl=$y['class_id'];
        $sec=$y['section_id'];
        $d=date('Y-m-d');
        if($d==''){$d=date('Y-m-d');}
        $response['status'] = "1";
        $response['error_msg'] = "";
        $response['data'] = array();
        $year=$this->sch_model->get_attendance_report_year($cl,$sec,$month);
        if($year) {
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }else{$day=0;}
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->sch_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->sch_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->sch_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->sch_model->get_attendance_teach($cl, $sec,$d);
             $temp2=array();
            foreach($xx as $row){
                $temp=array();
                $temp['student_name']=$this->sch_model->student_name($row['student_id']);
                for($d=1; $d<=$day; $d++)
                {
                    $att= $this->sch_model->get_attendance_individual($cl,$sec,$row['student_id'],$d,$month,$year);
                    if($att==1){$att="P";}
                    elseif($att==2){$att= "L";}
                    elseif($att==3){$att= "A";}
                    elseif($att==null){$att= "";}
                    $temp ['attandance'][$d]= $att;
                }
                if($temp){
                    $temp2[]=$temp;
                }

            }

            if($temp2 && $year){
                $response['status'] = "1";
                $response['error_msg'] = "";
                $response['data'] = array();
                $response['data']=$temp2;
            }
            else {
                $response['status'] = "0";
                $response['error_msg'] = "No data found";
                $response['data'] = array();
            }


        }
        else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/assessmentReport
    function assessmentReport_get(){
        $teacher_id = $this->get('teacher_id');
        $month = $this->get('month');
        $y=$this->sch_model->class_section($teacher_id);
        $cl=$y['class_id'];
        $sec=$y['section_id'];
        $d=date('Y-m-d');
        if($d==''){$d=date('Y-m-d');}
        $response['status'] = "1";
        $response['error_msg'] = "";
        $response['data'] = array();
        $year=$this->sch_model->get_attendance_report_year($cl,$sec,$month);
        if($year) {
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }else{$day=0;}
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->sch_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->sch_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->sch_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->sch_model->get_attendance_teach($cl, $sec,$d);
            $temp2=array();
            foreach($xx as $row){
                $temp=array();
                $temp['student_name']=$this->sch_model->student_name($row['student_id']);
                for($d=1; $d<=$day; $d++)
                {
                    $att= $this->sch_model->get_assessment_individual($cl,$sec,$row['student_id'],$d,$month,$year);
                    $tot=$att['punctuality']+$att['cleanliness']+$att['attentiveness']+$att['handwriting']+$att['interactive']+$att['homework']+$att['classwork'];
                    $tot1=floor(($tot/70)*100);
                    $temp ['assessment'][$d]= $tot1.'%';
//                    $temp ['remark']= $att['remark'];
                }
                if($temp){
                    $temp2[]=$temp;
                }

            }

            if($temp2 && $year){
                $response['status'] = "1";
                $response['error_msg'] = "";
                $response['data'] = array();
                $response['data']=$temp2;
            }
            else {
                $response['status'] = "0";
                $response['error_msg'] = "No data found";
                $response['data'] = array();
            }


        }
        else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/attendanceAnalysis
    function attendanceAnalysis_get(){
        $teacher_id = $this->get('teacher_id');
        $month = $this->get('month');
        $y=$this->sch_model->class_section($teacher_id);
        $cl=$y['class_id'];
        $sec=$y['section_id'];
        $d=date('Y-m-d');
        if($d==''){$d=date('Y-m-d');}
        $response['status'] = "1";
        $response['error_msg'] = "";
        $response['data'] = array();
        $year=$this->sch_model->get_attendance_report_year($cl,$sec,$month);
        if($year) {
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }else{$day=0;}
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->sch_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->sch_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->sch_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->sch_model->get_attendance_teach($cl, $sec,$d);
            $temp2=array();
            foreach($xx as $row){
                $temp=array();
                $temp['student_name']=$this->sch_model->student_name($row['student_id']);
                $present=0;
                $absent=0;
                $leave=0;
                for($d=1; $d<=$day; $d++)
                {
                    $att= $this->sch_model->get_attendance_individual($cl,$sec,$row['student_id'],$d,$month,$year);
                    if($att==1){$present++;}
                    elseif($att==2){$leave++;}
                    elseif($att==3){$absent++;}
                }
                if($temp){
                    $working_day=$present+$absent+$leave;
                    $temp ['present']= $present;
                    $temp ['present_percent']= number_format($present/($present+$absent)*100, 2, '.', '').' %' ;
                    $temp ['absent']= $absent;
                    $temp ['absent_percent']= number_format($absent/($present+$absent)*100, 2, '.', '').' %' ;

                    $temp ['leave']= $leave;
                    $temp ['working_day']= $working_day;
                    $temp ['holidays']= $day-$working_day;
                    $temp ['total_day']= $day;
                    $temp2[]=$temp;
                }

            }

            if($temp2 && $year){
                $response['status'] = "1";
                $response['error_msg'] = "";
                $response['data'] = array();
                $response['data']=$temp2;
            }
            else {
                $response['status'] = "0";
                $response['error_msg'] = "No data found";
                $response['data'] = array();
            }


        }
        else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);
    }
//  http://localhost/school/v1/teacherTimeTable
    function teacherTimeTable_get()
    {
        $teacher_id = $this->get('teacher_id');
        $response = array();

        $time_table = $this->sch_model->getTeacherTimeTable($teacher_id);
        if ($time_table) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($time_table as $row1) {
                $temp1 = array();

                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);

                $temp1['day'] = $row1['day'];
                $temp1['time'] = date('h:ia', strtotime($row1['start_time'])) . " - " . date('h:ia', strtotime($row1['end_time']));
                array_push($response['data'], $temp1);

            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }

        $this->response($response, 200);

    }
//  http://localhost/school/v1/teacherClassWork
    function teacherClassWork_get()
    {
        $teacher_id = $this->get('teacher_id');
        $response = array();
        $class_work = $this->sch_model->getTeacherClassWork($teacher_id );
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($class_work as $row1) {
                $temp1 = array();
                $temp1['class_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];

                //$temp1['attachment'] = $row1['attachment'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }

                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
// URL: http://localhost/school/v1/addClassWork
    function addClassWork_post()
    {
        $data['class_id'] = $this->post('class_id');
        $data['section_id'] = $this->post('section_id');
        $data['teacher_id'] = $this->post('teacher_id');
        $data['subject_id'] = $this->post('subject_id');
        $data['title'] = $this->post('title');
        $data['description'] = $this->post('description');
//      ---------------------------------------------------------------
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
//        ---------------------------------------------------------------
        $data['attachment'] = $image_name;
        $response = array();
        $class_work = $this->sch_model->add_class_work($data);
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = 'added successfully';
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = 'unable to add';
        }
        $this->response($response, 200);
    }
// URL: http://localhost/school/v1/updateHomeWork
    function updateClassWork_post()
    {
        $data['id'] = $this->post('id');
        $data['title'] = $this->post('title');
        $data['description'] = $this->get('description');
//      ---------------------------------------------------------------
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
//        ---------------------------------------------------------------
        $data['attachment'] = $image_name;
        $response = array();
        $class_work = $this->sch_model->update_class_work($data);
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = 'updated successfully';
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = 'unable to add';
        }
        $this->response($response, 200);
    }
// URL: http://localhost/school/v1/classWorkById
    function classWorkById_get()
    {
        $id = $this->get('id');
        $response = array();
        $class_work = $this->sch_model-> class_work_by_id($id);
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $class_work['attachment'] = base_url().'uploads/'.$class_work['attachment'];
            $response['data'] = $class_work;
        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = '';
        }
        $this->response($response, 200);
    }
//  http://localhost/school/v1/teacherHomeWork
    function teacherHomeWork_get()
    {
        $teacher_id = $this->get('teacher_id');
        $response = array();
        $class_work = $this->sch_model->getTeacherHomeWork($teacher_id );
        if ($class_work) {
            $response['status'] = "1";
            $response['error_msg'] = "";
            $response['data'] = array();

            foreach ($class_work as $row1) {
                $temp1 = array();
                $temp1['home_work_id'] = $row1['id'];
                $temp1['class'] = $this->sch_model->class_name($row1['class_id']);
                $temp1['section'] = $this->sch_model->section_name($row1['section_id']);
                $temp1['subject'] = $this->sch_model->subject_name($row1['subject_id']);
                $temp1['teacher'] = $this->sch_model->class_teacher_name($row1['teacher_id']);
                $temp1['date'] = $row1['date'];
                $temp1['title'] = $row1['title'];
                $temp1['description'] = $row1['description'];

                //$temp1['attachment'] = $row1['attachment'];
                if ($row1['attachment'] != '') {
                    $temp1['attachment'] =  base_url() . 'uploads/'  . $row1['attachment'];
                } else {
                    $temp1['attachment'] = $row1['attachment'];
                }

                array_push($response['data'], $temp1);
            }

        } else {
            $response['status'] = "0";
            $response['error_msg'] = "No data found";
            $response['data'] = array();
        }
        $this->response($response, 200);
    }
}