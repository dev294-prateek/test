<?php

if (!defined('BASEPATH'))
    exit('Ohhh... This is Cheating you are not suppose to do this.Cheater :)');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('login_model');
        $this->load->library('session');
    }

    function index()
    {   $data['setting'] = $this->login_model->get_setting();
        $this->load->view('login/login',$data);
    }

    function login()
    {   
         /*============================change session=================================*/  
        $db = 'school_erp';
        $this->session->set_userdata('dynamic_db',$db);
           /*============================end change session=================================*/
        
        $type = $this->input->post('type');
        $user = $this->input->post('username');
		//echo  $type,$user;die();
        $password = md5($this->input->post('pass'));
        if($type=='teacher'){
			
        $result = $this->login_model->validate_login($user, $password);
			//print_r($result);die();
        if ($result) {
            $setting = $this->login_model->get_setting();
            if ($result['designation']=='admin' || $result['designation']=='Teacher') {
                $newdata = array(
                    'user_id' => $result['employee_id'],
                    'username' => $result['name'],
                    'email' => $result['email'],
                    'user_role' => $result['designation'],
                    'sub_user_role' => $result['designation'],
                    'mobile_no' => $result['contact_no'],
                    'profile_image' => $result['employee_image'],
                    'school_name' => $setting['school_name'],
                    'logo' => $setting['logo'],
                    'address' => $setting['address'],
                    'running_year' => $setting['running_year'],
                    'logged_in' => TRUE
                );
            }
            else{
                $newdata = array(
                    'user_id' => $result['employee_id'],
                    'username' => $result['name'],
                    'email' => $result['email'],
                    'user_role' => 'admin',
                    'sub_user_role' => $result['designation'],
                    'mobile_no' => $result['contact_no'],
                    'profile_image' => $result['employee_image'],
                    'school_name' => $setting['school_name'],
                    'logo' => $setting['logo'],
                    'address' => $setting['address'],
                    'running_year' => $setting['running_year'],
                    'logged_in' => TRUE
                );
            }
            $this->session->set_userdata($newdata);

            $this->session->set_flashdata('item', 'login Successfully.');
            if ($_SESSION['user_role']=='admin'){redirect(base_url() . "admin");}
            if ($_SESSION['user_role']=='Teacher'){
                $teacher_id = $this->login_model->teacher_by_employee_id($_SESSION['user_id']);
                $section = $this->login_model->list_section_by_teacher_id($teacher_id);
                $this->session->set_userdata('teacher_id',$teacher_id);
                $this->session->set_userdata('class_id',$section['class_id']);
                $this->session->set_userdata('section_id',$section['section_id']);
                redirect(base_url() . "teacher");
            }


        } else {
            $this->session->set_flashdata('item', 'Wrong username or password.');
            redirect(base_url() . "login");
        }
        }
        else {
            $result = $this->login_model->validate_s_login($user, $password);
            if ($result) {
            /*===============================*/

                $setting = $this->login_model->get_setting();
                $newdata = array(
                    'user_id' => $result['guardian_id'],
                    'username' => $result['guardian_name'],
                    'email' => $result['email'],
                    'user_role' => 'guardian',
                    'mobile_no' => $result['guardian_mobile'],
                    'profile_image' => $result['guardian_image'],
                    'school_name' => $setting['school_name'],
                    'logo' => $setting['logo'],
                    'address' => $setting['address'],
                    'running_year' => $setting['running_year'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                redirect(base_url() . "guardian");
            /*===============================*/
            } else {
                $this->session->set_flashdata('item', 'Wrong username or password.');
                redirect(base_url() . "login");
            }
        }


    }
    function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('item', 'Log Out  Successfully .');
        redirect(base_url() . "login");
    }

} fdgfdgfghfjhg
