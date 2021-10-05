<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('teacher_model');
         $this->load->model('admin_model');
    }

    public function index()
    {  if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['setting']=$this->admin_model->get_setting();
        $this->load->view('teacher/header',$data);
        $this->load->view('teacher/header');
        $this->load->view('teacher/sidebar');
        $this->load->view('teacher/container');
        $this->load->view('teacher/footer');
    }
    /*==================================================================*/
    /*                             PROFILE                              */
    /*==================================================================*/
    function profile()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['profile_image'] = $this->teacher_model->profile($_SESSION ['user_id']);
        $this->load->view('teacher/profile', $data);
    }
    function upload_profile_image()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('userfile');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        if ($new_image_name) {
            $this->$this->teacher_model->update_profile_image($_SESSION ['user_id'], $new_image_name);
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['width'] = 300;
            $config['height'] = 300;
            $config['x_axis'] = ($upload_data['image_width']/2-150);
            $config['y_axis'] = ($upload_data['image_height']/2-150);
            $config['maintain_ratio'] = FALSE;
            $config['source_image'] = './uploads/' . $image_name;
            $config['create_thumb'] = TRUE;
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
        }
        $source="uploads/$image_name"; /* Delete Original image after crop*/
        unlink ($source);
    }
    public function dashboard()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->view('teacher/dashboard');
    }
    /*==================================================================*/
    /*                             GUARDIAN                             */
    /*==================================================================*/
    public function guardian()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['nationality']=$this->teacher_model->list_nationality();
        $this->load->view('teacher/guardian/add_guardian',$data);
    }
    public function all_guardian()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['all_guardian']=$this->teacher_model->list_all_guardian();
        $this->load->view('teacher/guardian/all_guardian',$data);
    }
    public function add_guardian()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('guardian_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['guardian_image'] =  $new_image_name;
        if ($new_image_name) {
            $ret=$this->teacher_model->add_guardian($data);
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['width'] = 300;
            $config['height'] = 300;
            $config['x_axis'] = ($upload_data['image_width']/2-150);
            $config['y_axis'] = ($upload_data['image_height']/2-150);
            $config['maintain_ratio'] = FALSE;
            $config['source_image'] = './uploads/' . $image_name;
            $config['create_thumb'] = TRUE;
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            return $ret;
        }
        $source="uploads/$image_name"; /* Delete Original image after crop*/
        unlink ($source);

    }
    public function edit_guardian($id='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->teacher_model->list_guardian_by_id($id);
        $data['nationality']=$this->teacher_model->list_nationality();
        $this->load->view('teacher/guardian/edit_guardian',$data);
    }
    public function print_guardian($id='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->teacher_model->list_guardian_by_id($id);
        $this->load->view('teacher/guardian/print_guardian',$data);
    }

    public function update_guardian()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('guardian_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['guardian_image'] =  $new_image_name;
        if( $data['guardian_image'] == '_thumb' )  { unset($data['guardian_image']);
            $this->teacher_model->update_guardian($data);
            print_r($data);
        }
        else {
            if ($new_image_name) {
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['width'] = 300;
                $config['height'] = 300;
                $config['x_axis'] = ($upload_data['image_width'] / 2 - 150);
                $config['y_axis'] = ($upload_data['image_height'] / 2 - 150);
                $config['maintain_ratio'] = FALSE;
                $config['source_image'] = './uploads/' . $image_name;
                $config['create_thumb'] = TRUE;
                $this->image_lib->initialize($config);
                $this->image_lib->crop();
                $this->teacher_model->update_guardian($data);
                print_r($data);
            }
        }
        $source="uploads/$image_name";
        unlink ($source);
    }
    /*==================================================================*/
    /*                              STUDENT                             */
    /*==================================================================*/
    public function section_by_class_id($id=''){
        $section=$this->teacher_model->list_section_by_class_id($id);
        print_r(json_encode($section));

    }

    public  function student(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->teacher_model->list_all_class();
        $data['guardains']=$this->teacher_model->list_all_guardian();
        $data['nationality']=$this->teacher_model->list_nationality();
        $this->load->view('teacher/student/admit_student',$data);
    }
    /*    public  function bulk_student(){
            if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
            $data['class']=$this->teacher_model->list_all_class();
            $data['guardains']=$this->teacher_model->list_all_guardian();
            $this->load->view('teacher/student/admit_bulk_student',$data);
        }*/
    public  function all_student($class=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $class=$_SESSION['class_id'];$section=$_SESSION['section_id'];
        $data['students']=$this->teacher_model->list_all_student_by_class_section($class,$section);
        $c=$this->teacher_model->class_by_id($_SESSION['class_id']);
        $data['class_name']=$c['name'];
        $this->load->view('teacher/student/all_student',$data);
    }
    /*==========================================*/
    function birth_certificate($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $this->load->view('teacher/student/birth_certificate',$data);
    }
    function leaving_certificate($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $this->load->view('teacher/student/leaving_certificate',$data);
    }
    function character_certificate($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $this->load->view('teacher/student/character_certificate',$data);
    }
    function medical_certificate($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $this->load->view('teacher/student/medical_certificate',$data);
    }
    function sc_st_certificate($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $this->load->view('teacher/student/sc_st_certificate',$data);
    }
    /*==========================================*/
    /*    function student_certificate($id=''){
            if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
            $data['student']=$this->teacher_model->list_student_by_id($id);
            $this->load->view('teacher/student/student_certificate',$data);
        }*/
    public function admit_student()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('student_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['coscholastic_activities']=json_encode($data['coscholastic_activities']);
        $data['student_image'] =  $new_image_name;
        if ($new_image_name!='_thumb') {
            $this->teacher_model->add_student($data);
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['width'] = 300;
            $config['height'] = 300;
            $config['x_axis'] = ($upload_data['image_width']/2-150);
            $config['y_axis'] = ($upload_data['image_height']/2-150);
            $config['maintain_ratio'] = FALSE;
            $config['source_image'] = './uploads/' . $image_name;
            $config['create_thumb'] = TRUE;
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            print_r($this->db->insert_id());
        }
        if($image_name) {
            $source = "uploads/$image_name"; /* Delete Original image after crop*/
            unlink($source);
        }

    }
    /*=====================================================================================*/
    public function update_student()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('student_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['coscholastic_activities']=json_encode($data['coscholastic_activities']);
        /*      print_r($data);exit();*/
        /*--------------------*/
        $data['student_image'] =  $new_image_name;
        if( $data['student_image'] == '_thumb' )  { unset($data['student_image']);
            $this->teacher_model->update_student($data);
            print_r($data);
        }
        /*--------------------*/
        else {
            $this->teacher_model->update_student($data);
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['width'] = 300;
            $config['height'] = 300;
            $config['x_axis'] = ($upload_data['image_width']/2-150);
            $config['y_axis'] = ($upload_data['image_height']/2-150);
            $config['maintain_ratio'] = FALSE;
            $config['source_image'] = './uploads/' . $image_name;
            $config['create_thumb'] = TRUE;
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            print_r($this->db->insert_id());
        }
        if($image_name) {
            $source = "uploads/$image_name"; /* Delete Original image after crop*/
            unlink($source);
        }

    }
    /*=====================================================================================*/
    public function edit_student($id='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $data['class']=$this->teacher_model->list_all_class();
        $data['guardains']=$this->teacher_model->list_all_guardian();
        $data['nationality']=$this->teacher_model->list_nationality();
        $this->load->view('teacher/student/edit_student',$data);
    }
    public function print_student($id='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->teacher_model->list_student_by_id($id);
        $data['class']=$this->teacher_model->list_all_class();
        $data['guardains']=$this->teacher_model->list_all_guardian();
        $this->load->view('teacher/student/print_student',$data);
    }

    /*==========================Uplod  Certificate================================================*/
    function update_student_certificate(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('certificate');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $field_name=$this->input->post('field_name');
        $data['id']=$this->input->post('id');
        $data[$field_name]=$image_name ;
        $this->teacher_model->update_student_certificate($data);
        print_r($data) ;
    }
    function change_student_status()
    {
        $data=$this->input->post();
        $x=$this->teacher_model->change_student_status($data);
        print_r($x);

    }
    /*==================================================================*/
    /*                             EMPLOYEE                             */
    /*==================================================================*/

    function change_employee_status()
    {
        $data=$this->input->post();
        $x=$this->teacher_model->change_employee_status($data);
        print_r($x);

    }
    public function employee()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['nationality']=$this->teacher_model->list_nationality();
        $data['designation']=$this->teacher_model->list_all_emp_designation();
        $this->load->view('teacher/employee/add_employee',$data);
    }
    public function all_employee($x='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        if($x){$data['all_employee']=$this->teacher_model->list_all_employee_by_des($x);
            $x = str_replace("-", " ", $x);
            $data['title']=$x;
        }
        else {$data['all_employee']=$this->teacher_model->list_all_employee();$data['title']="All Employee";}
        $data['designation']=$this->teacher_model->list_designation();
        $this->load->view('teacher/employee/all_employee',$data);
    }

    public function add_employee()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('employee_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['employee_image'] =  $new_image_name;
        if ($new_image_name) {
            $this->teacher_model->add_employee($data);
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['width'] = 300;
            $config['height'] = 300;
            $config['x_axis'] = ($upload_data['image_width']/2-150);
            $config['y_axis'] = ($upload_data['image_height']/2-150);
            $config['maintain_ratio'] = FALSE;
            $config['source_image'] = './uploads/' . $image_name;
            $config['create_thumb'] = TRUE;
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            print_r($this->db->insert_id());
        }
        $source="uploads/$image_name"; /* Delete Original image after crop*/
        unlink ($source);
    }
    public function edit_employee($id='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['employee']=$this->teacher_model->list_employee_by_id($id);
        $data['nationality']=$this->teacher_model->list_nationality();
        $data['designation']=$this->teacher_model->list_all_emp_designation();
        $this->load->view('teacher/employee/edit_employee',$data);
    }
    public function print_employee($id='')
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');

        $data['employee']=$this->teacher_model->list_employee_by_id($id);
        $data['experience']=$this->teacher_model->list_emp_experience_by_employee_id($id);
        $data['qualification']=$this->teacher_model->list_emp_qualification_by_employee_id($id);
        $this->load->view('teacher/employee/print_employee',$data);

    }

    public function update_employee()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('employee_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['employee_image'] =  $new_image_name;
        if( $data['employee_image'] == '_thumb' )  { unset($data['employee_image']);
            $this->teacher_model->update_employee($data);
            print_r($data);
        }
        else {
            if ($new_image_name) {
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['width'] = 300;
                $config['height'] = 300;
                $config['x_axis'] = ($upload_data['image_width'] / 2 - 150);
                $config['y_axis'] = ($upload_data['image_height'] / 2 - 150);
                $config['maintain_ratio'] = FALSE;
                $config['source_image'] = './uploads/' . $image_name;
                $config['create_thumb'] = TRUE;
                $this->image_lib->initialize($config);
                $this->image_lib->crop();
                $this->teacher_model->update_employee($data);
                print_r($data);
            }
        }
        $source="uploads/$image_name";
        unlink ($source);
    }
    /*==================================================================*/
    /*                      EMPLOYEE  QUALIFICATION                     */
    /*==================================================================*/
    function add_qualification(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('certificate_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['certificate_image'] =  $image_name;
        $this->teacher_model->add_emp_qualification($data);
    }
    function qualification($id=''){
        $data['employee']=$this->teacher_model->list_employee_by_id($id);
        $data['qualification']=$this->teacher_model->list_emp_qualification_by_employee_id($id);
        $this->load->view('teacher/employee/add_qualification',$data);
    }
    function edit_qualification($id=''){

        $x=$data['qualification']=$this->teacher_model->list_emp_qualification_by_qualification_id($id);
        $data['employee']=$this->teacher_model->list_employee_by_id($x['employee_id']);
        $this->load->view('teacher/employee/edit_qualification',$data);
    }
    function update_qualification(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('certificate_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['certificate_image'] =  $image_name;

        if( $data['certificate_image'] == '' )  { unset($data['employee_image']); }
        $this->teacher_model->update_qualification($data);
        print_r($data);

    }
    function delete_qualification(){
        $data=$this->input->post('id');
        if($this->teacher_model->delete_qualification($data));
        {echo $data;}
    }
    /*==================================================================*/
    /*                      EMPLOYEE  EXPERIENCE                        */
    /*==================================================================*/
    function add_experience(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        if($this->teacher_model->add_emp_experience($data)){
            print_r($data);
        }
    }
    function experience($id=''){
        $data['employee']=$this->teacher_model->list_employee_by_id($id);
        $data['experience']=$this->teacher_model->list_emp_experience_by_employee_id($id);
        $this->load->view('teacher/employee/add_experience',$data);
    }

    function edit_experience($id=''){
        $x=$data['experience']=$this->teacher_model->list_emp_experience_by_experience_id($id);
        $data['employee']=$this->teacher_model->list_employee_by_id($x['employee_id']);
        $this->load->view('teacher/employee/edit_experience',$data);
    }

    function update_experience(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        if( $this->teacher_model->update_experience($data))
        {print_r($data);}
    }
    function delete_experience(){
        $data=$this->input->post('id');
        if($this->teacher_model->delete_experience($data));
        {echo $data;}
    }
    /*==================================================================*/
    /*                             CLASS                                */
    /*==================================================================*/
    function  all_class(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['all_class']= $this->teacher_model->list_all_class();
        $this->load->view('teacher/class/all_class',$data);
    }
    function add_class()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        $x= $this->teacher_model->add_class($data);
        print_r($x);
    }
    function update_class()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->teacher_model->update_class($data);
        print_r($x);
    }
    function edit_class($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['class']= $this->teacher_model->class_by_id($id);
        $this->load->view('teacher/class/edit_class',$data);
    }
    /*==================================================================*/
    /*                              SECTION                             */
    /*==================================================================*/
    function  all_section(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['all_section']= $this->teacher_model->list_all_section();
        $data['class']= $this->teacher_model->list_all_active_class();
        $data['emp_teacher']=$this->teacher_model->list_all_employee_teacher();
        $this->load->view('teacher/class/all_section',$data);
    }
    function add_section()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->teacher_model->add_section($data);
        print_r($x);
    }
    function update_section()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->teacher_model->update_section($data);
        print_r($x);
    }
    function edit_section($id=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['section']= $this->teacher_model->section_by_id($id);
        $data['class']= $this->teacher_model->list_all_class();
        $data['emp_teacher']=$this->teacher_model->list_all_employee_teacher();
        $this->load->view('teacher/class/edit_section',$data);
    }
    /*==================================================================*/
    /*                              TEACHER                             */
    /*==================================================================*/
    function teacher(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['teacher']=$this->teacher_model->list_all_teacher();
        $data['teacher_type']=$this->teacher_model->list_all_teacher_type();
        $data['emp_teacher']=$this->teacher_model->list_all_employee_teacher_not_used();
        $this->load->view('teacher/teacher/all_teacher',$data);
    }
    function edit_teacher($id){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['teacher']=$this->teacher_model->teacher_by_id($id);
        $data['teacher_type']=$this->teacher_model->list_all_teacher_type();
        $data['teacher_detail']=$this->teacher_model->list_employee_by_id($id);
        $this->load->view('teacher/teacher/edit_teacher',$data);
    }
    function show_teacher_detail(){
        $id=$this->input->post('id');
        $row=$this->teacher_model->list_employee_by_id($id);
        print_r('<table class="table table-responsive">');
        print_r( "<tr><th>Employee Id</th><td>".$row['employee_id']."</td></tr>");
        $img=$row["employee_image"];
        print_r( "<tr><th>Name</th><td>".$row['name']."</td></tr>");
        print_r( "<tr><th>Mobile No</th><td>".$row['contact_no']."</td></tr>");
        print_r( "<tr><th>Email</th><td>".$row['email']."</td></tr>");
        print_r( "<tr><th>Type</th><td>".$row['employee_type']."</td></tr>");
        print_r( "<tr><th>Designation</th><td>".$row['designation']."</td></tr>");
        print_r( '<img class="img-responsive detail" src='.base_url().'/uploads/'.$img.'>');
        print_r('</table>');
    }
    function add_teacher(){
        $data=$this->input->post();
        $x= $this->teacher_model->add_teacher($data);
        print_r($x);

    }
    function update_teacher(){
        $data=$this->input->post();
        $x= $this->teacher_model->update_teacher($data);
        print_r($x);

    }
    function teacher_period($t_id=''){
        if($t_id ){
            $data['all_period'] = $this->teacher_model->list_period_by_teacher($t_id);
        }
        else {
            $data['all_period'] = $this->teacher_model->list_all_period();
        }
        $data['emp_teacher']=$this->teacher_model->list_all_employee_teacher();
        $this->load->view('teacher/teacher/teacher_period',$data);
    }

    /*==================================================================*/
    /*                              PERIOD                              */
    /*==================================================================*/
    function show_teacher_detail_for_period(){
        $t_id=$this->input->post('id');
        $xx=$this->teacher_model->teacher_by_id($t_id);
        $id=$xx['employee_id'];
        $row=$this->teacher_model->list_employee_by_id($id);
        $t_period=$this->teacher_model->list_period_by_teacher($id);
        $teacher=$this->teacher_model->teacher_by_employee_id($id);
        $type=$this->teacher_model->teacher_type_by_id($teacher['type']);
        print_r('<table class="table table-responsive">');
        print_r( "<tr><td colspan='4'style='text-align: center;color: darkgoldenrod;'>Teacher Detail</td></tr>");
        print_r( "<tr><th>Employee Id</th><td>".$row['employee_id']."</td></tr>");
        $img=$row["employee_image"];
        print_r( "<tr><th>Name</th><td>".$row['name']."</td></tr>");
        print_r( "<tr><th>Type</th><td>".$row['employee_type']."</td></tr>");
        print_r( "<tr><th>Designation</th><td>".$row['designation']."</td></tr>");
        print_r( "<tr><th>Type</th><td>".$type['name']."</td></tr>");
        print_r( '<img class="img-responsive detail" src='.base_url().'/uploads/'.$img.'>');
        print_r('</table>');

        print_r('<table class="table table-responsive">');
        print_r( "<tr><td colspan='4'style='text-align: center;color: darkgoldenrod;'>Teacher Period Allotted List</td></tr>");
        print_r( "<tr><th>Period</th><th style='width: 200px'>Time</th><th>Class</th><th>Section</th></tr>");
        foreach ($t_period as $row){
            $class=$this->teacher_model->class_by_id($row['class_id']); $class=$class['name'];
            $period=$this->teacher_model->list_period_by_id($row['name']); $period=$period['name'];
            $section=$this->teacher_model->section_by_id($row['section_id']); $section=$section['name'];
            print_r( "<tr><td>".$period."</td><td style='width: 200px'>".date('h:ia', strtotime($row['start_time']))." - ".date('h:ia', strtotime($row['end_time']))."</td><td>".$class."</td><td>".$section."</td></tr>");
        }
        print_r('</table>');
    }

    function period(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->teacher_model->list_all_class();
        $data['subject']=$this->teacher_model->list_subjects();
        $data['period']=$this->teacher_model->list_period();
        $data['emp_teacher']=$this->teacher_model->list_all_employee_teacher();
        $this->load->view('teacher/period/add_period',$data);
    }
    function edit_period($id){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->teacher_model->list_all_class();
        $data['subject']=$this->teacher_model->list_subjects();
        $data['period']=$this->teacher_model->list_period();
        $data['emp_teacher']=$this->teacher_model->list_all_employee_teacher();
        $data['per']=$this->teacher_model->list_period_allotment_by_id($id);
        $this->load->view('teacher/period/edit_period',$data);
    }
    function alot_period(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->teacher_model->add_period($data);
        print_r($x);
    }

    function update_period(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->teacher_model->update_period($data);
        print_r($x);
    }
    function period_class_detail(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $c_id=$this->input->post('c_id');
        $s_id=$this->input->post('s_id');
        $x=$this->teacher_model->list_period_by_section($c_id,$s_id);
        // print_r($x);
        print_r('<table class="table table-responsive">');
        print_r( "<tr><td colspan='4'style='text-align: center;color: darkgoldenrod;'>Class Period Allotted List</td></tr>");
        print_r( "<tr><th>Period</th><th style='width: 200px'>Time</th><th>Class</th><th>Section</th></tr>");
        foreach ($x as $row){
            $class=$this->teacher_model->class_by_id($row['class_id']); $class=$class['name'];
            $period=$this->teacher_model->list_period_by_id($row['name']); $period=$period['name'];
            $section=$this->teacher_model->section_by_id($row['section_id']); $section=$section['name'];
            print_r( "<tr><td>".$period."</td><td style='width: 200px'>".date('h:ia', strtotime($row['start_time']))." - ".date('h:ia', strtotime($row['end_time']))."</td><td>".$class."</td><td>".$section."</td></tr>");
        }
        print_r('</table>');
    }
    function all_period($c='',$s=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['title']= 'All Period';
        $data['all_period'] = $this->teacher_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->teacher_model->list_all_class();
        $this->load->view('teacher/period/all_period',$data);
    }
    function add_class_work_t($c='',$s=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['title']= 'Add Class Work';
        $data['all_period'] = $this->teacher_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->teacher_model->list_all_class();
        $this->load->view('teacher/period/all_period',$data);
    }
    function add_lesson_plan_t($c='',$s=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['title']= 'Add Lesson Plan';
        $data['all_period'] = $this->teacher_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->teacher_model->list_all_class();
        $this->load->view('teacher/period/all_period',$data);
    }
    function add_home_work_t($c='',$s=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['title']= 'Add Home Work';
        $data['all_period'] = $this->teacher_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->teacher_model->list_all_class();
        $this->load->view('teacher/period/all_period',$data);
    }
    function change_period_status()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->teacher_model->list_enroll_by_student_id($data);
        print_r($x);
    }

    /*==================================================================*/
    /*                          STUDENT ATTENDANCE                      */
    /*==================================================================*/
    function attendance($cl='',$sec='',$d=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $cl=$_SESSION['class_id']; $sec=$_SESSION['section_id'];
        if($d==''){$d=date('Y-m-d');}
       /* $data['class']=$this->teacher_model->list_all_class();*/
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->teacher_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->teacher_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->teacher_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->teacher_model->get_attendance($cl, $sec,$d);
            $data['students'] = $xx;
        }
        $this->load->view('teacher/student/attendance',$data);
    }
    function update_attendance(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $c_id=$this->input->post('c_id');
        $id=$this->input->post('id');
        $attr=$this->input->post('attr');
        $value=$this->input->post('value');
        $name=$this->input->post('name');
        $data=array($attr=>$value);
        $x=$this->teacher_model->update_attendance($id, $c_id,$data);
        if($x==1){
            echo $attr.' of Mr <span style="color: red">'. $name .'</span> updated Successfully';
        }else{
            echo 'unable to update <span style="color: red">'.$attr.'</span> of Mr '. $name;
        }
    }
    function sms_attendance(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $cl=$this->input->post('cl');
        $sec=$this->input->post('sec');
        $d=$this->input->post('d');
        $sms_data = $this->teacher_model->get_attendance_for_sms($cl, $sec,$d);
        foreach ($sms_data as $row ){
            $status='';
            $data=$this->teacher_model->student_name_mobile_sms($row['student_id']);
            $mobile=$data['mobile_no_for_sms'];
            $name=$data['student_name'];
            if($row['attendance']==1){$status="Present";}
            if($row['attendance']==0){$status="Absent";}
            if($row['attendance']==2){$status="On Leave";}
            $msg= 'Mr '. $name . ' is ' . $status . ' on '. $d ;
            print_r($msg);
        }

    }
    function attendance_report($cl='',$sec='',$month=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['year']='';
        $cl=$_SESSION['class_id'];
        $sec=$_SESSION['section_id'];
        $data['class']=$this->teacher_model->list_all_class();
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
            $data['students']=$this->teacher_model->all_student_by_section_id($sec);
            $data['year']=$this->teacher_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('teacher/student/attendance_report',$data);
    }
    function attendance_analysis($cl='',$sec='',$month=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['year']='';
        $cl=$_SESSION['class_id'];
        $sec=$_SESSION['section_id'];
        $data['class']=$this->teacher_model->list_all_class();
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
            $data['students']=$this->teacher_model->all_student_by_section_id($sec);
            $data['year']=$this->teacher_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('teacher/student/attendance_analysis',$data);
    }

    function assessment_report($cl='',$sec='',$month=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['year']='';
        $cl=$_SESSION['class_id'];
        $sec=$_SESSION['section_id'];
        $data['class']=$this->teacher_model->list_all_class();
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
            $data['students']=$this->teacher_model->all_student_by_section_id($sec);
            $data['year']=$this->teacher_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('teacher/student/assessment_report',$data);
    }
    function get_attendance_report_year($c_id,$s_id,$month){
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'month'=>$month,'running_year'=>$_SESSION['running_year']);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->select('year');
        $x=$this->db->get_where($table, $data)->row_array();
        return $x['year'];
    }
    /*==================================================================*/
    /*                          EMPLOYEE ATTENDANCE                      */
    /*==================================================================*/
    function emp_attendance($d=''){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['d'] =$d;$data['employee'] = '';
        if($d) {
            $z = $this->teacher_model->chk_before_insert_emp_attendance($d);
            if ($z == 0) {
                $y = $this->teacher_model->get_data_from_employee();
                foreach ($y as $x) {
                    if($x['designation']!='Teacher') {
                        $emp_id = $x['employee_id'];
                        $this->teacher_model->insert_emp_attendance($emp_id, $d);
                    }
                }
            }
            $xx = $this->teacher_model->get_emp_attendance($d);
            $data['employee'] = $xx;
        }
        $this->load->view('teacher/employee/attendance',$data);
    }
    function update_emp_attendance(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $id=$this->input->post('id');
        $value=$this->input->post('value');
        $name=$this->input->post('name');

        $x=$this->teacher_model->update_emp_attendance($id,$value);
        if($x==1){
            echo 'Attendance of Mr <span style="color: red">'. $name .'</span> updated Successfully';
        }else{
            echo 'unable to update <span style="color: red">Attendance</span> of Mr '. $name;
        }

    }
    function sms_emp_attendance(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $d=$this->input->post('d');
        $sms_data = $this->teacher_model->get_attendance_for_emp_sms($d);
        foreach ($sms_data as $row ){
            $status='';
            $data=$this->teacher_model->employee_name_mobile_sms($row['employee_id']);
            $mobile=$data['contact_no'];
            $name=$data['name'];
            if($row['attendance']==1){$status="Present";}
            if($row['attendance']==0){$status="Absent";}
            if($row['attendance']==2){$status="On Leave";}
            $msg= 'Mr '. $name . ' is ' . $status . ' on '. $d ;
            print_r($msg);
        }

    }
    /*==================================================================*/
    function tes()
    {

        $c_id=3;$s_id=2;
        $z=$this->teacher_model->chk_before_insert_attendance($c_id,$s_id);
        if($z==0) {
            $y=$this->teacher_model->get_data_from_enroll(3,2);
            foreach ($y as $x) {
                $st_id = $x['student_id'];
                $c_id = $x['class_id'];
                $s_id = $x['section_id'];
                $this->teacher_model->insert_attendance($st_id, $c_id, $s_id);
                echo 'success';
            }
        }
        else
        {
            $xx=$this->teacher_model->get_attendance($c_id,$s_id);
            print_r($xx);
        }

    }
    function test1(){
        $data=array('employee_id'=>1,'type'=>4);
        $x=$this->teacher_model->add_teacher($data);
        echo  "<pre>";
        print_r($x);
    }
    /*==================================================================*/
    /*                            CLASS WORK                            */
    /*==================================================================*/

    function class_work(){
        $x=$this->teacher_model->class_work();
        $c_work=array(); $ind=0;
        /*  echo "<pre>";*/
        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->teacher_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->teacher_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['teacher']=$this->teacher_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->teacher_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['teacher']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['class_work']=$c_work;
        $this->load->view('teacher/class/class_work',$data);
    }
    function add_class_work($id=''){
        $data['s_period']=$this->teacher_model->list_period_allotment_by_id($id);
        $this->load->view('teacher/class/add_class_work',$data);
    }
    function add_class_work_data(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['attachment']= $image_name;
        $x=$this->teacher_model->add_class_work($data);
        print_r($x);
    }
    function update_class_work_data(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['attachment']= $image_name;
        $x=$this->teacher_model->update_class_work($data);
        print_r($x);
    }
    function all_class_work(){
        $data['class_work']=$this->teacher_model->class_work();
        $this->load->view('teacher/class/all_class_work',$data);
    }
    function edit_class_work($id=''){
        $data['class_work']=$this->teacher_model->class_wotk_by_id($id);
        $this->load->view('teacher/class/edit_class_work',$data);
    }
    /*==================================================================*/
    /*                            HOME WORK                            */
    /*==================================================================*/
    function home_work(){
        $x=$this->teacher_model->home_work();
        $c_work=array(); $ind=0;

        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->teacher_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->teacher_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['teacher']=$this->teacher_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->teacher_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['teacher']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['class_work']=$c_work;
        $this->load->view('teacher/class/home_work',$data);
    }
    function add_home_work($id=''){
        $data['s_period']=$this->teacher_model->list_period_allotment_by_id($id);
        $this->load->view('teacher/class/add_home_work',$data);
    }
    function add_home_work_data(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['attachment']= $image_name;
        $x=$this->teacher_model->add_home_work($data);
        print_r($x);
    }

    function update_home_work_data(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['attachment']= $image_name;
        $x=$this->teacher_model->update_home_work($data);
        print_r($x);
    }

    function all_home_work(){
        $data['class_work']=$this->teacher_model->home_work();
        $this->load->view('teacher/class/all_home_work',$data);
    }
    function edit_home_work($id=''){
        $data['class_work']=$this->teacher_model->home_wotk_by_id($id);
        $this->load->view('teacher/class/edit_home_work',$data);
    }
    /*==================================================================*/
    /*                          CLASS GALLERY                           */
    /*==================================================================*/
    function class_gallery(){
        $this->load->view('teacher/gallery/class_gallery');
    }
    public function add_class_gallery()
    {
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['image'] =  $new_image_name;
        if ($new_image_name) {
            $ret=$this->teacher_model->add_class_gallery($data);
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['width'] = 300;
            $config['height'] = 200;
            $config['x_axis'] = ($upload_data['image_width']/2-150);
            $config['y_axis'] = ($upload_data['image_height']/2-150);
            $config['maintain_ratio'] = FALSE;
            $config['source_image'] = './uploads/' . $image_name;
            $config['create_thumb'] = TRUE;
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            return $ret;
        }
        $source="uploads/$image_name"; /* Delete Original image after crop*/
        unlink ($source);

    }
    function all_class_gallery(){
        $data['gallery']=$this->teacher_model->list_class_gallery_by_teacher_id_active($_SESSION['teacher_id']);
        $this->load->view('teacher/gallery/all_class_gallery',$data);
    }
    function more_class_gallery(){
        $data['gallery']=$this->teacher_model->list_class_gallery_by_teacher_id($_SESSION['teacher_id']);
        $this->load->view('teacher/gallery/more_class_gallery',$data);
    }
    function cl_image($id){
        $data['gallery']=$this->teacher_model->list_class_gallery_by_id($id);
        $data['all_gallery']=$this->teacher_model->list_image_by_class_gallery_id($id);
        $this->load->view('teacher/gallery/add_cl_image',$data);
    }
    function add_class_gal(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $id=$this->input->post('id');
        $x=$this->teacher_model->add_class_gallery_photo($id,$image_name);
        print_r($x);
    }
    function view_more_class_gal($id){
        $data['gallery']=$this->teacher_model->list_class_gallery_by_id($id);
        $data['all_gallery']=$this->teacher_model->list_image_by_class_gallery_id($id);
        $this->load->view('teacher/gallery/view_more',$data);
    }
    function edit_class_gallery($id){
        $data['gallery']=$this->teacher_model->list_class_gallery_by_id($id);
        $this->load->view('teacher/gallery/update_class_gallery',$data);
    }
    function update_class_gallery(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        $data['image'] =  $new_image_name;
        if($data['image']=='_thumb'){ unset($data['image']);}
        else {
            if ($new_image_name) {
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['width'] = 300;
                $config['height'] = 200;
                $config['x_axis'] = ($upload_data['image_width'] / 2 - 150);
                $config['y_axis'] = ($upload_data['image_height'] / 2 - 150);
                $config['maintain_ratio'] = FALSE;
                $config['source_image'] = './uploads/' . $image_name;
                $config['create_thumb'] = TRUE;
                $this->image_lib->initialize($config);
                $this->image_lib->crop();
            }
            $source = "uploads/$image_name"; /* Delete Original image after crop*/
            unlink($source);
        }
        $ret=$this->teacher_model->update_class_gallery($data);
        return $ret;
    }
    function delete_class_image(){
        $id=$this->input->post('id');
        $ret=$this->teacher_model->delete_class_image($id);
        echo $ret;
    }
    /*================================================*/
    function all_school_gallery(){
        $data['gallery']=$this->admin_model->list_school_gallery_by_teacher_id_active();
        $this->load->view('admin/sh_gallery/all_school_gallery',$data);
    }
    function more_school_gallery(){
        $data['gallery']=$this->admin_model->list_school_gallery_by_teacher_id();
        $this->load->view('admin/sh_gallery/more_school_gallery',$data);
    }
    function view_more_school_gal($id){
        $this->load->model('admin_model');
        $data['gallery']=$this->admin_model->list_school_gallery_by_id($id);
        $data['all_gallery']=$this->admin_model->list_image_by_school_gallery_id($id);
        $this->load->view('admin/sh_gallery/view_more',$data);
    }
    /*==================================================================*/
    /*                               EXAM                               */
    /*==================================================================*/
    function  exam(){
        if ($_SESSION["user_role"] != 'Teacher') redirect(base_url() . "login", 'refresh');
        $data['all_period'] = $this->teacher_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->teacher_model->list_all_class();
        $this->load->view('teacher/exam/exam',$data);
    }
function getpaper()
{
    $data = $this->input->post();
    $ret = $this->teacher_model->get_exam_paper($data);
    echo '<option>Select</option>';
    foreach ($ret as $row) {
        $paper = $this->teacher_model->paper_name($row["paper_id"]);

        echo '<option value="' . $row["paper_id"] . '">' . $paper . '</option>';
    }
}
    function generate_exam_marks(){
        $data=$this->input->post();
        $section_id=$data['section_id'];
        $subject_id=$data['subject_id'];
        $stu=$this->teacher_model->list_enroll_by_section_id($section_id);
        foreach($stu as $row){
            $student_id=$row['student_id'];
            $data['student_id']=$student_id;
            $subjects=json_decode($row['subjects'],True);
            foreach ($subjects as $col){
                if($col['subject_id']==$subject_id){
                $this->teacher_model->add_exam_marks($data);
                }

            }

        }

    }
    function paper_marks($exam_id,$class_id,$section_id,$subject_id,$paper_id){
        $data['exam_id']=$exam_id;
        $data['class_id']=$class_id;
        $data['section_id']=$section_id;
        $data['subject_id']=$subject_id;
        $data['paper_id']=$paper_id;
        $data['all_data']=$this->teacher_model->exam_mark_data($data);
        $this->load->view('teacher/exam/paper_marks',$data);
    }
    function update_exam_marks_value(){
        $data=$this->input->post();
       if($this->teacher_model->update_exam_marks($data)){
           print_r($data['marks']);
       }

    }
    /*==================================================================*/
    /*                            LESSON PLAN                            */
    /*==================================================================*/

    function lesson_plan(){
        $x=$this->teacher_model->lesson_plan();
        $c_work=array(); $ind=0;
        /*  echo "<pre>";*/
        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->teacher_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->teacher_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['teacher']=$this->teacher_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->teacher_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['teacher']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['lesson_plan']=$c_work;
        $this->load->view('teacher/class/lesson_plan',$data);
    }
    function add_lesson_plan($id=''){
        $data['s_period']=$this->teacher_model->list_period_allotment_by_id($id);
        $this->load->view('teacher/class/add_lesson_plan',$data);
    }
    function add_lesson_plan_data(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['attachment']= $image_name;
        $x=$this->teacher_model->add_lesson_plan($data);
        print_r($x);
    }
    function update_lesson_plan_data(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('attachment');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['attachment']= $image_name;
        $x=$this->teacher_model->update_lesson_plan($data);
        print_r($x);
    }
    function all_lesson_plan(){
        $data['lesson_plan']=$this->teacher_model->lesson_plan();
        $this->load->view('teacher/class/all_lesson_plan',$data);
    }
    function edit_lesson_plan($id=''){
        $data['lesson_plan']=$this->teacher_model->lesson_plan_by_id($id);
        $this->load->view('teacher/class/edit_lesson_plan',$data);
    }
    /*------------------------------------------------------------------------------*/
    function approv_req_lesson_plan($id=''){
        $data['lesson_plan']=$this->teacher_model->lesson_plan_by_id($id);
        $this->load->view('teacher/class/approv_req_lesson_plan',$data);
    }
    function final_req_lesson_plan($id=''){
        $data['lesson_plan']=$this->teacher_model->lesson_plan_by_id($id);
        $this->load->view('teacher/class/final_req_lesson_plan',$data);
    }
    /*------------------------------------------------------------------------------*/
    function test(){
        $paper=$this->teacher_model->list_enroll_by_section_id(1);
        print_r($paper);
    }



    /*==========================================================================================================================*/
    function event(){
        $this->load->model('admin_model');
        $data['result'] = $this->admin_model->all_event();
        foreach ($data['result'] as $key => $value) {
            $data['data'][$key]['id'] = $value->id;
            $data['data'][$key]['title'] = $value->title;
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#b8860b";
        }
        $this->load->view('teacher/event/event', $data);
    }
    function all_videos_gallery(){
        $this->load->model('admin_model');
        $data['all_v_gallery']=$this->admin_model->all_videos_gallery();
        $this->load->view('teacher/videos_gallery/all_videos_gallery',$data);
    }
    function tabulation(){
        $this->load->model('admin_model');
        $class=$_SESSION['class_id'];$section=$_SESSION['section_id'];
        $data['exam']=$this->admin_model->list_all_exam_allowed_section($class,$section);
        $data['class']=$this->admin_model->list_all_active_class();
        $this->load->view('teacher/exam/tabulation',$data);
    }
    function tabulation_marks($exam_id,$class_id,$section_id){
        $this->load->model('admin_model');
        $data['exam_id']=$exam_id;
        $data['class_id']=$class_id;

        $data['section_id']=$section_id;
        $data['all_data']=$this->admin_model->all_student_by_section_id($section_id);
        $data['sub']=$this->admin_model->list_all_exam_allowed_section_subject_tabulation($exam_id,$class_id,$section_id);

        $this->load->view('teacher/exam/tabulation_marks',$data);
    }
    function lib_book_emp_history($id){
        $this->load->model('admin_model');
        $data['id']=$id;
        $data['book']=$this->admin_model->book_history_by_emp_id($id);
        $this->load->view('admin/employee/lib_book_history',$data);
    }
    /*==================================================================*/
    /*                       Admin Teacher  chat                        */
    /*==================================================================*/
    function admin_teacher_chat($id=""){
        $data['id']=$id;

        $data['all_teacher']=$this->teacher_model->admin_name();
        $this->load->view('admin/chat/admin-teacher/admin_teacher_chat',$data);
    }
    function admin_teacher_chat_data($id="",$name="",$img="",$limit="",$offset=""){
        $data['id']=$id;
        $data['name']=str_replace('_', ' ', $name);
        $data['img']=$img;
        $data['limit']=$limit;
        $data['offset']=$offset;
        if($id) {
            $data['chat'] = $this->teacher_model->list_admin_teacher_chat($id,$limit,$offset);
            $data['chat_count'] = $this->teacher_model->count_admin_teacher_chat($id);
        }
        $data['all_teacher']=$this->teacher_model->all_teacher_name();
        $this->load->view('admin/chat/admin-teacher/admin_teacher_chat_data',$data);
    }

    function admin_teacher_chat_add(){
        $data=$this->input->post();
        if($data['message']) {
            $this->teacher_model->admin_teacher_chat_add($data);
        }
    }
    function admin_teacher_chat_add_bacup(){
        $data=$this->input->post();
        if($data['message']) {
            $this->teacher_model->admin_teacher_chat_add($data);
            $x= $this->teacher_model->list_admin_last_chat($data['to_id']);
            echo '<div class="d-flex justify-content-end mb-4">';
            echo '<div class="msg_cotainer_send">';
            echo '<span class="wid">'. $x->message.'</span> <br>';
            echo '<span class="msg_time">'. $x->time.' ,'. $x->date. '</span>';
            echo '</div>';
            echo '</div>';
        }
    }
    function teacher_admin_chat_append(){
        $data=$this->input->post();
        $chat_count = $this->teacher_model->count_admin_teacher_chat($data['id']);
        if($chat_count > $data['chat_count']) {
            $x= $this->teacher_model->list_teacher_last_chat($data['id']);
            echo '<div class="d-flex justify-content-start mb-4">';
            echo '<div class="msg_cotainer">';
            echo '<span class="wid">'. $x->message.'</span> <br>';
            echo '<span class="msg_time">'. $x->time.' ,'. $x->date. '</span>';
            echo '</div>';
            echo '</div>';
        }
    }
}
