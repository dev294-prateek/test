<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('guardian_model');
         $this->load->model('admin_model');

    }

    public function index()
    {  if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['setting']=$this->admin_model->get_setting();
        $this->load->view('admin/header',$data);
        $this->load->view('guardian/header');
        $this->load->view('guardian/sidebar'); ;
        $this->load->view('guardian/container');
        $this->load->view('guardian/footer');
    }
    function select_student($id){
        $this->load->view('guardian/profile');

    }
    /*==================================================================*/
    /*                             PROFILE                              */
    /*==================================================================*/
    function profile()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['profile_image'] = $this->guardian_model->profile($_SESSION ['user_id']);
        $this->load->view('guardian/profile', $data);
    }
    public function dashboard()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['all_student']=$this->guardian_model->all_student($_SESSION['user_id']);
        $this->load->view('guardian/dashboard',$data);
    }
    public function student_dashboard($id)
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['all_student']=$this->guardian_model->all_student($_SESSION['user_id']);
        $this->load->view('guardian/student_dashboard',$data);
    }
    /*==================================================================*/
    /*                             GUARDIAN                             */
    /*==================================================================*/
    public function guardian()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['nationality']=$this->guardian_model->list_nationality();
        $this->load->view('guardian/guardian/add_guardian',$data);
    }
    public function all_guardian()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['all_guardian']=$this->guardian_model->list_all_guardian();
        $this->load->view('guardian/guardian/all_guardian',$data);
    }
    public function add_guardian()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $ret=$this->guardian_model->add_guardian($data);
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
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->guardian_model->list_guardian_by_id($id);
        $data['nationality']=$this->guardian_model->list_nationality();
        $this->load->view('guardian/guardian/edit_guardian',$data);
    }
    public function print_guardian($id='')
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->guardian_model->list_guardian_by_id($id);
        $this->load->view('guardian/guardian/print_guardian',$data);
    }

    public function update_guardian()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $this->guardian_model->update_guardian($data);
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
                $this->guardian_model->update_guardian($data);
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
        $section=$this->guardian_model->list_section_by_class_id($id);
        print_r(json_encode($section));

    }

    public  function student(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->guardian_model->list_all_class();
        $data['guardains']=$this->guardian_model->list_all_guardian();
        $data['nationality']=$this->guardian_model->list_nationality();
        $this->load->view('guardian/student/admit_student',$data);
    }
    /*    public  function bulk_student(){
            if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
            $data['class']=$this->guardian_model->list_all_class();
            $data['guardains']=$this->guardian_model->list_all_guardian();
            $this->load->view('guardian/student/admit_bulk_student',$data);
        }*/
    public  function all_student($class=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $class=$_SESSION['class_id'];$section=$_SESSION['section_id'];
        $data['students']=$this->guardian_model->list_all_student_by_class_section($class,$section);
        $c=$this->guardian_model->class_by_id($_SESSION['class_id']);
        $data['class_name']=$c['name'];
        $this->load->view('guardian/student/all_student',$data);
    }
    /*==========================================*/
    function birth_certificate($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $this->load->view('guardian/student/birth_certificate',$data);
    }
    function leaving_certificate($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $this->load->view('guardian/student/leaving_certificate',$data);
    }
    function character_certificate($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $this->load->view('guardian/student/character_certificate',$data);
    }
    function medical_certificate($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $this->load->view('guardian/student/medical_certificate',$data);
    }
    function sc_st_certificate($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $this->load->view('guardian/student/sc_st_certificate',$data);
    }
    /*==========================================*/
    /*    function student_certificate($id=''){
            if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
            $data['student']=$this->guardian_model->list_student_by_id($id);
            $this->load->view('guardian/student/student_certificate',$data);
        }*/
    public function admit_student()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $this->guardian_model->add_student($data);
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
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $this->guardian_model->update_student($data);
            print_r($data);
        }
        /*--------------------*/
        else {
            $this->guardian_model->update_student($data);
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
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $data['class']=$this->guardian_model->list_all_class();
        $data['guardains']=$this->guardian_model->list_all_guardian();
        $data['nationality']=$this->guardian_model->list_nationality();
        $this->load->view('guardian/student/edit_student',$data);
    }
    public function print_student($id='')
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->guardian_model->list_student_by_id($id);
        $data['class']=$this->guardian_model->list_all_class();
        $data['guardains']=$this->guardian_model->list_all_guardian();
        $this->load->view('guardian/student/print_student',$data);
    }

    /*==========================Uplod  Certificate================================================*/
    function update_student_certificate(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
        $this->guardian_model->update_student_certificate($data);
        print_r($data) ;
    }
    function change_student_status()
    {
        $data=$this->input->post();
        $x=$this->guardian_model->change_student_status($data);
        print_r($x);

    }
    /*==================================================================*/
    /*                             EMPLOYEE                             */
    /*==================================================================*/

    function change_employee_status()
    {
        $data=$this->input->post();
        $x=$this->guardian_model->change_employee_status($data);
        print_r($x);

    }
    public function employee()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['nationality']=$this->guardian_model->list_nationality();
        $data['designation']=$this->guardian_model->list_all_emp_designation();
        $this->load->view('guardian/employee/add_employee',$data);
    }
    public function all_employee($x='')
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        if($x){$data['all_employee']=$this->guardian_model->list_all_employee_by_des($x);
            $x = str_replace("-", " ", $x);
            $data['title']=$x;
        }
        else {$data['all_employee']=$this->guardian_model->list_all_employee();$data['title']="All Employee";}
        $data['designation']=$this->guardian_model->list_designation();
        $this->load->view('guardian/employee/all_employee',$data);
    }

    public function add_employee()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $this->guardian_model->add_employee($data);
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
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['employee']=$this->guardian_model->list_employee_by_id($id);
        $data['nationality']=$this->guardian_model->list_nationality();
        $data['designation']=$this->guardian_model->list_all_emp_designation();
        $this->load->view('guardian/employee/edit_employee',$data);
    }
    public function print_employee($id='')
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');

        $data['employee']=$this->guardian_model->list_employee_by_id($id);
        $data['experience']=$this->guardian_model->list_emp_experience_by_employee_id($id);
        $data['qualification']=$this->guardian_model->list_emp_qualification_by_employee_id($id);
        $this->load->view('guardian/employee/print_employee',$data);

    }

    public function update_employee()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $this->guardian_model->update_employee($data);
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
                $this->guardian_model->update_employee($data);
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
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('certificate_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['certificate_image'] =  $image_name;
        $this->guardian_model->add_emp_qualification($data);
    }
    function qualification($id=''){
        $data['employee']=$this->guardian_model->list_employee_by_id($id);
        $data['qualification']=$this->guardian_model->list_emp_qualification_by_employee_id($id);
        $this->load->view('guardian/employee/add_qualification',$data);
    }
    function edit_qualification($id=''){

        $x=$data['qualification']=$this->guardian_model->list_emp_qualification_by_qualification_id($id);
        $data['employee']=$this->guardian_model->list_employee_by_id($x['employee_id']);
        $this->load->view('guardian/employee/edit_qualification',$data);
    }
    function update_qualification(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
        $this->guardian_model->update_qualification($data);
        print_r($data);

    }
    function delete_qualification(){
        $data=$this->input->post('id');
        if($this->guardian_model->delete_qualification($data));
        {echo $data;}
    }
    /*==================================================================*/
    /*                      EMPLOYEE  EXPERIENCE                        */
    /*==================================================================*/
    function add_experience(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        if($this->guardian_model->add_emp_experience($data)){
            print_r($data);
        }
    }
    function experience($id=''){
        $data['employee']=$this->guardian_model->list_employee_by_id($id);
        $data['experience']=$this->guardian_model->list_emp_experience_by_employee_id($id);
        $this->load->view('guardian/employee/add_experience',$data);
    }

    function edit_experience($id=''){
        $x=$data['experience']=$this->guardian_model->list_emp_experience_by_experience_id($id);
        $data['employee']=$this->guardian_model->list_employee_by_id($x['employee_id']);
        $this->load->view('guardian/employee/edit_experience',$data);
    }

    function update_experience(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        if( $this->guardian_model->update_experience($data))
        {print_r($data);}
    }
    function delete_experience(){
        $data=$this->input->post('id');
        if($this->guardian_model->delete_experience($data));
        {echo $data;}
    }
    /*==================================================================*/
    /*                             CLASS                                */
    /*==================================================================*/
    function  all_class(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['all_class']= $this->guardian_model->list_all_class();
        $this->load->view('guardian/class/all_class',$data);
    }
    function add_class()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        $x= $this->guardian_model->add_class($data);
        print_r($x);
    }
    function update_class()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->guardian_model->update_class($data);
        print_r($x);
    }
    function edit_class($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['class']= $this->guardian_model->class_by_id($id);
        $this->load->view('guardian/class/edit_class',$data);
    }
    /*==================================================================*/
    /*                              SECTION                             */
    /*==================================================================*/
    function  all_section(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['all_section']= $this->guardian_model->list_all_section();
        $data['class']= $this->guardian_model->list_all_active_class();
        $data['emp_teacher']=$this->guardian_model->list_all_employee_teacher();
        $this->load->view('guardian/class/all_section',$data);
    }
    function add_section()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->guardian_model->add_section($data);
        print_r($x);
    }
    function update_section()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->guardian_model->update_section($data);
        print_r($x);
    }
    function edit_section($id=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['section']= $this->guardian_model->section_by_id($id);
        $data['class']= $this->guardian_model->list_all_class();
        $data['emp_teacher']=$this->guardian_model->list_all_employee_teacher();
        $this->load->view('guardian/class/edit_section',$data);
    }
    /*==================================================================*/
    /*                              TEACHER                             */
    /*==================================================================*/
    function teacher(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->guardian_model->list_all_teacher();
        $data['teacher_type']=$this->guardian_model->list_all_teacher_type();
        $data['emp_teacher']=$this->guardian_model->list_all_employee_teacher_not_used();
        $this->load->view('guardian/guardian/all_teacher',$data);
    }
    function edit_teacher($id){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->guardian_model->teacher_by_id($id);
        $data['teacher_type']=$this->guardian_model->list_all_teacher_type();
        $data['teacher_detail']=$this->guardian_model->list_employee_by_id($id);
        $this->load->view('guardian/guardian/edit_teacher',$data);
    }
    function show_teacher_detail(){
        $id=$this->input->post('id');
        $row=$this->guardian_model->list_employee_by_id($id);
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
        $x= $this->guardian_model->add_teacher($data);
        print_r($x);

    }
    function update_teacher(){
        $data=$this->input->post();
        $x= $this->guardian_model->update_teacher($data);
        print_r($x);

    }
    function teacher_period($t_id=''){
        if($t_id ){
            $data['all_period'] = $this->guardian_model->list_period_by_teacher($t_id);
        }
        else {
            $data['all_period'] = $this->guardian_model->list_all_period();
        }
        $data['emp_teacher']=$this->guardian_model->list_all_employee_teacher();
        $this->load->view('guardian/guardian/teacher_period',$data);
    }

    /*==================================================================*/
    /*                              PERIOD                              */
    /*==================================================================*/
    function show_teacher_detail_for_period(){
        $t_id=$this->input->post('id');
        $xx=$this->guardian_model->teacher_by_id($t_id);
        $id=$xx['employee_id'];
        $row=$this->guardian_model->list_employee_by_id($id);
        $t_period=$this->guardian_model->list_period_by_teacher($id);
        $teacher=$this->guardian_model->teacher_by_employee_id($id);
        $type=$this->guardian_model->teacher_type_by_id($teacher['type']);
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
            $class=$this->guardian_model->class_by_id($row['class_id']); $class=$class['name'];
            $period=$this->guardian_model->list_period_by_id($row['name']); $period=$period['name'];
            $section=$this->guardian_model->section_by_id($row['section_id']); $section=$section['name'];
            print_r( "<tr><td>".$period."</td><td style='width: 200px'>".date('h:ia', strtotime($row['start_time']))." - ".date('h:ia', strtotime($row['end_time']))."</td><td>".$class."</td><td>".$section."</td></tr>");
        }
        print_r('</table>');
    }

    function period(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->guardian_model->list_all_class();
        $data['subject']=$this->guardian_model->list_subjects();
        $data['period']=$this->guardian_model->list_period();
        $data['emp_teacher']=$this->guardian_model->list_all_employee_teacher();
        $this->load->view('guardian/period/add_period',$data);
    }
    function edit_period($id){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->guardian_model->list_all_class();
        $data['subject']=$this->guardian_model->list_subjects();
        $data['period']=$this->guardian_model->list_period();
        $data['emp_teacher']=$this->guardian_model->list_all_employee_teacher();
        $data['per']=$this->guardian_model->list_period_allotment_by_id($id);
        $this->load->view('guardian/period/edit_period',$data);
    }
    function alot_period(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->guardian_model->add_period($data);
        print_r($x);
    }

    function update_period(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->guardian_model->update_period($data);
        print_r($x);
    }
    function period_class_detail(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $c_id=$this->input->post('c_id');
        $s_id=$this->input->post('s_id');
        $x=$this->guardian_model->list_period_by_section($c_id,$s_id);
        // print_r($x);
        print_r('<table class="table table-responsive">');
        print_r( "<tr><td colspan='4'style='text-align: center;color: darkgoldenrod;'>Class Period Allotted List</td></tr>");
        print_r( "<tr><th>Period</th><th style='width: 200px'>Time</th><th>Class</th><th>Section</th></tr>");
        foreach ($x as $row){
            $class=$this->guardian_model->class_by_id($row['class_id']); $class=$class['name'];
            $period=$this->guardian_model->list_period_by_id($row['name']); $period=$period['name'];
            $section=$this->guardian_model->section_by_id($row['section_id']); $section=$section['name'];
            print_r( "<tr><td>".$period."</td><td style='width: 200px'>".date('h:ia', strtotime($row['start_time']))." - ".date('h:ia', strtotime($row['end_time']))."</td><td>".$class."</td><td>".$section."</td></tr>");
        }
        print_r('</table>');
    }
    function all_period($s_id){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['title']= 'All Period';
        $data['all_period'] = $this->guardian_model->list_period_by_section_new($s_id);
        $data['class']=$this->guardian_model->list_all_class();
        $this->load->view('guardian/period/all_period',$data);
    }

    function add_class_work_t($c='',$s=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['title']= 'Add Class Work';
        $data['all_period'] = $this->guardian_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->guardian_model->list_all_class();
        $this->load->view('guardian/period/all_period',$data);
    }
    function add_lesson_plan_t($c='',$s=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['title']= 'Add Lesson Plan';
        $data['all_period'] = $this->guardian_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->guardian_model->list_all_class();
        $this->load->view('guardian/period/all_period',$data);
    }
    function add_home_work_t($c='',$s=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['title']= 'Add Home Work';
        $data['all_period'] = $this->guardian_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->guardian_model->list_all_class();
        $this->load->view('guardian/period/all_period',$data);
    }
    function change_period_status()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->guardian_model->list_enroll_by_student_id($data);
        print_r($x);
    }

    /*==================================================================*/
    /*                          STUDENT ATTENDANCE                      */
    /*==================================================================*/
    function attendance($cl='',$sec='',$d=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $cl=$_SESSION['class_id']; $sec=$_SESSION['section_id'];
        if($d==''){$d=date('Y-m-d');}
       /* $data['class']=$this->guardian_model->list_all_class();*/
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->guardian_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->guardian_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->guardian_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->guardian_model->get_attendance($cl, $sec,$d);
            $data['students'] = $xx;
        }
        $this->load->view('guardian/student/attendance',$data);
    }
    function attendance_report($stu='',$cl='',$sec='',$month=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['year']='';
        $data['class']=$this->guardian_model->list_all_class();
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        $data['st']=$stu;
        if($cl && $sec && $month) {
            $data['students']=$this->guardian_model->all_student_by_section_id_student_id($sec,$stu);
            $data['year']=$this->guardian_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('guardian/student/attendance_report',$data);
    }
     /*==================================================================*/
    /*                          EMPLOYEE ATTENDANCE                      */
    /*==================================================================*/
    function emp_attendance($d=''){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['d'] =$d;$data['employee'] = '';
        if($d) {
            $z = $this->guardian_model->chk_before_insert_emp_attendance($d);
            if ($z == 0) {
                $y = $this->guardian_model->get_data_from_employee();
                foreach ($y as $x) {
                    if($x['designation']!='guardian') {
                        $emp_id = $x['employee_id'];
                        $this->guardian_model->insert_emp_attendance($emp_id, $d);
                    }
                }
            }
            $xx = $this->guardian_model->get_emp_attendance($d);
            $data['employee'] = $xx;
        }
        $this->load->view('guardian/employee/attendance',$data);
    }
    function update_emp_attendance(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $id=$this->input->post('id');
        $value=$this->input->post('value');
        $name=$this->input->post('name');

        $x=$this->guardian_model->update_emp_attendance($id,$value);
        if($x==1){
            echo 'Attendance of Mr <span style="color: red">'. $name .'</span> updated Successfully';
        }else{
            echo 'unable to update <span style="color: red">Attendance</span> of Mr '. $name;
        }

    }
    function sms_emp_attendance(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $d=$this->input->post('d');
        $sms_data = $this->guardian_model->get_attendance_for_emp_sms($d);
        foreach ($sms_data as $row ){
            $status='';
            $data=$this->guardian_model->employee_name_mobile_sms($row['employee_id']);
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
        $z=$this->guardian_model->chk_before_insert_attendance($c_id,$s_id);
        if($z==0) {
            $y=$this->guardian_model->get_data_from_enroll(3,2);
            foreach ($y as $x) {
                $st_id = $x['student_id'];
                $c_id = $x['class_id'];
                $s_id = $x['section_id'];
                $this->guardian_model->insert_attendance($st_id, $c_id, $s_id);
                echo 'success';
            }
        }
        else
        {
            $xx=$this->guardian_model->get_attendance($c_id,$s_id);
            print_r($xx);
        }

    }
    function test1(){
        $data=array('employee_id'=>1,'type'=>4);
        $x=$this->guardian_model->add_teacher($data);
        echo  "<pre>";
        print_r($x);
    }
    /*==================================================================*/
    /*                            CLASS WORK                            */
    /*==================================================================*/

    function class_work($sec_id){
        $x=$this->guardian_model->class_work($sec_id);
        $c_work=array(); $ind=0;
        /*  echo "<pre>";*/
        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->guardian_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->guardian_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['guardian']=$this->guardian_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->guardian_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['guardian']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['class_work']=$c_work;
        $this->load->view('guardian/class/class_work',$data);
    }
    function add_class_work($id=''){
        $data['s_period']=$this->guardian_model->list_period_allotment_by_id($id);
        $this->load->view('guardian/class/add_class_work',$data);
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
        $x=$this->guardian_model->add_class_work($data);
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
        $x=$this->guardian_model->update_class_work($data);
        print_r($x);
    }
    function all_class_work(){
        $data['class_work']=$this->guardian_model->class_work();
        $this->load->view('guardian/class/all_class_work',$data);
    }
    function edit_class_work($id=''){
        $data['class_work']=$this->guardian_model->class_wotk_by_id($id);
        $this->load->view('guardian/class/edit_class_work',$data);
    }
    /*====================================================================================================================================================================*/
    function view_noticeboard(){
        $data['all_notice']=$this->admin_model->all_noticeboard();
        $this->load->view('admin/noticeboard/view_noticeboard',$data);
    }
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
    /*==================================================================*/
    /*                            HOME WORK                            */
    /*==================================================================*/
    function home_work($sec_id){
        $x=$this->guardian_model->home_work($sec_id);
        $c_work=array(); $ind=0;

        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->guardian_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->guardian_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['guardian']=$this->guardian_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->guardian_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['guardian']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['class_work']=$c_work;
        $this->load->view('guardian/class/home_work',$data);
    }
    function add_home_work($id=''){
        $data['s_period']=$this->guardian_model->list_period_allotment_by_id($id);
        $this->load->view('guardian/class/add_home_work',$data);
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
        $x=$this->guardian_model->add_home_work($data);
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
        $x=$this->guardian_model->update_home_work($data);
        print_r($x);
    }

    function all_home_work(){
        $data['class_work']=$this->guardian_model->home_work();
        $this->load->view('guardian/class/all_home_work',$data);
    }
    function edit_home_work($id=''){
        $data['class_work']=$this->guardian_model->home_wotk_by_id($id);
        $this->load->view('guardian/class/edit_home_work',$data);
    }
    /*==================================================================*/
    /*                          CLASS GALLERY                           */
    /*==================================================================*/
    function class_gallery(){
        $this->load->view('guardian/gallery/class_gallery');
    }
    public function add_class_gallery()
    {
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
            $ret=$this->guardian_model->add_class_gallery($data);
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
    function all_class_gallery($sec){
        $data['gallery']=$this->guardian_model->list_class_gallery_by_teacher_id_active($sec);
        $this->load->view('guardian/gallery/all_class_gallery',$data);
    }
    function more_class_gallery(){
        $data['gallery']=$this->guardian_model->list_class_gallery_by_teacher_id($_SESSION['teacher_id']);
        $this->load->view('guardian/gallery/more_class_gallery',$data);
    }
    /*==========================================*/
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
    /*==========================================*/

    function cl_image($id){
        $data['gallery']=$this->guardian_model->list_class_gallery_by_id($id);
        $data['all_gallery']=$this->guardian_model->list_image_by_class_gallery_id($id);
        $this->load->view('guardian/gallery/add_cl_image',$data);
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
        $x=$this->guardian_model->add_class_gallery_photo($id,$image_name);
        print_r($x);
    }
    function view_more_class_gal($id){
        $data['gallery']=$this->guardian_model->list_class_gallery_by_id($id);
        $data['all_gallery']=$this->guardian_model->list_image_by_class_gallery_id($id);
        $this->load->view('guardian/gallery/view_more',$data);
    }
    function edit_class_gallery($id){
        $data['gallery']=$this->guardian_model->list_class_gallery_by_id($id);
        $this->load->view('guardian/gallery/update_class_gallery',$data);
    }
    function update_class_gallery(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
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
        $ret=$this->guardian_model->update_class_gallery($data);
        return $ret;
    }
    function delete_class_image(){
        $id=$this->input->post('id');
        $ret=$this->guardian_model->delete_class_image($id);
        echo $ret;
    }
    /*==================================================================*/
    /*                               EXAM                               */
    /*==================================================================*/
    function  exam(){
        if ($_SESSION["user_role"] != 'guardian') redirect(base_url() . "login", 'refresh');
        $data['all_period'] = $this->guardian_model->list_period_by_teacher($_SESSION['teacher_id']);
        $data['class']=$this->guardian_model->list_all_class();
        $this->load->view('guardian/exam/exam',$data);
    }
function getpaper()
{
    $data = $this->input->post();
    $ret = $this->guardian_model->get_exam_paper($data);
    echo '<option>Select</option>';
    foreach ($ret as $row) {
        $paper = $this->guardian_model->paper_name($row["paper_id"]);

        echo '<option value="' . $row["paper_id"] . '">' . $paper . '</option>';
    }
}
    function generate_exam_marks(){
        $data=$this->input->post();
        $section_id=$data['section_id'];
        $subject_id=$data['subject_id'];
        $stu=$this->guardian_model->list_enroll_by_section_id($section_id);
        foreach($stu as $row){
            $student_id=$row['student_id'];
            $data['student_id']=$student_id;
            $subjects=json_decode($row['subjects'],True);
            foreach ($subjects as $col){
                if($col['subject_id']==$subject_id){
                $this->guardian_model->add_exam_marks($data);
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
        $data['all_data']=$this->guardian_model->exam_mark_data($data);
        $this->load->view('guardian/exam/paper_marks',$data);
    }
    function update_exam_marks_value(){
        $data=$this->input->post();
       if($this->guardian_model->update_exam_marks($data)){
           print_r($data['marks']);
       }

    }
    /*==================================================================*/
    /*                            LESSON PLAN                            */
    /*==================================================================*/

    function lesson_plan(){
        $x=$this->guardian_model->lesson_plan();
        $c_work=array(); $ind=0;
        /*  echo "<pre>";*/
        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->guardian_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->guardian_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['guardian']=$this->guardian_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->guardian_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['guardian']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['lesson_plan']=$c_work;
        $this->load->view('guardian/class/lesson_plan',$data);
    }
    function add_lesson_plan($id=''){
        $data['s_period']=$this->guardian_model->list_period_allotment_by_id($id);
        $this->load->view('guardian/class/add_lesson_plan',$data);
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
        $x=$this->guardian_model->add_lesson_plan($data);
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
        $x=$this->guardian_model->update_lesson_plan($data);
        print_r($x);
    }
    function all_lesson_plan($sec){
        $data['lesson_plan']=$this->guardian_model->lesson_plan($sec);
        $this->load->view('guardian/class/all_lesson_plan',$data);
    }
    function edit_lesson_plan($id=''){
        $data['lesson_plan']=$this->guardian_model->lesson_plan_by_id($id);
        $this->load->view('guardian/class/edit_lesson_plan',$data);
    }
    /*------------------------------------------------------------------------------*/
    function approv_req_lesson_plan($id=''){
        $data['lesson_plan']=$this->guardian_model->lesson_plan_by_id($id);
        $this->load->view('guardian/class/approv_req_lesson_plan',$data);
    }
    function final_req_lesson_plan($id=''){
        $data['lesson_plan']=$this->guardian_model->lesson_plan_by_id($id);
        $this->load->view('guardian/class/final_req_lesson_plan',$data);
    }
    /*------------------------------------------------------------------------------*/
    function test(){
        $paper=$this->guardian_model->list_enroll_by_section_id(1);
        print_r($paper);
    }
    function student_fee($cl_id="",$s_id="",$st_id=""){
        $this->load->model('admin_model');
        if($cl_id){
            $class= $this->admin_model->class_by_id($cl_id);
            $data['class']=$class['name'];
            $section= $this->admin_model->section_by_id($s_id);
            $data['section']=$section['name'];
            $student = $this->admin_model->student_name_by_id($st_id);
            $data['student']=$student;
            $data['section_fee']=$this->admin_model->list_section_fee_by_section_id($s_id);
            $data['library_fee']=$this->admin_model->library_late_fee_for_student($st_id);
        }else{
            $data['class']="";
            $data['section']="";
            $data['student']="";
            $data['section_fee']="";
            $data['library_fee']=0;
        }
        $data['all_class']=$this->admin_model->list_all_class();
        $this->load->view('guardian/fee/student_fee',$data);
    }
    function pay_student_fee($cl_id="",$s_id="",$st_id=""){
        if($cl_id){
            $class= $this->admin_model->class_by_id($cl_id);
            $data['class']=$class['name'];
            $section= $this->admin_model->section_by_id($s_id);
            $data['section']=$section['name'];
            $student = $this->admin_model->student_name_by_id($st_id);
            $data['student']=$student;
            $data['section_fee_first']=$this->admin_model->first_month_fee($s_id);
            $data['section_fee_middle']=$this->admin_model->middle_month_fee($s_id);
            $data['section_fee_fifth']=$this->admin_model->fifth_month_fee($s_id);
            $data['section_fee_last']=$this->admin_model->last_month_fee($s_id);
            $data['library_fee']=$this->admin_model->library_late_fee_for_student($st_id);
            $data['class_id']=$cl_id;
            $class = $this->admin_model->class_by_id($cl_id);
            $data['class']= $class['name'];
            $section = $this->admin_model->section_by_id($s_id);
            $data['section']=$section['name'];
            $data['section_id']=$s_id;
            $data['student_id']=$st_id;
        }else{
            $data['class']="";
            $data['section']="";
            $data['student']="";
            $data['section_fee']="";
            $data['library_fee']=0;
        }
        $data['all_class']=$this->admin_model->list_all_class();
        $this->load->view('guardian/fee/pay_student_fee',$data);
    }

    /*==================================================================*/
    /*                       Admin Teacher  chat                        */
    /*==================================================================*/
    function admin_teacher_chat($id=""){
        $data['id']=$id;

        $data['all_teacher']=$this->guardian_model->admin_name();
        $this->load->view('admin/chat/admin-guardian/admin_teacher_chat',$data);
    }
    function admin_teacher_chat_data($id="",$name="",$img="",$limit="",$offset=""){
        $data['id']=$id;
        $data['name']=$name;
        $data['img']=$img;
        $data['limit']=$limit;
        $data['offset']=$offset;
        if($id) {
            $data['chat'] = $this->guardian_model->list_admin_teacher_chat($id,$limit,$offset);
            $data['chat_count'] = $this->guardian_model->count_admin_teacher_chat($id);
        }
        $data['all_teacher']=$this->guardian_model->all_teacher_name();
        $this->load->view('admin/chat/admin-guardian/admin_teacher_chat_data',$data);
    }

    function admin_teacher_chat_add(){
        $data=$this->input->post();
        if($data['message']) {
            $this->guardian_model->admin_teacher_chat_add($data);
        }
    }
        function admin_teacher_chat_add_bacup(){
        $data=$this->input->post();
        if($data['message']) {
            $this->guardian_model->admin_teacher_chat_add($data);
            $x= $this->guardian_model->list_admin_last_chat($data['to_id']);
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
        $chat_count = $this->guardian_model->count_admin_teacher_chat($data['id']);
        if($chat_count > $data['chat_count']) {
            $x= $this->guardian_model->list_teacher_last_chat($data['id']);
            echo '<div class="d-flex justify-content-start mb-4">';
            echo '<div class="msg_cotainer">';
            echo '<span class="wid">'. $x->message.'</span> <br>';
            echo '<span class="msg_time">'. $x->time.' ,'. $x->date. '</span>';
            echo '</div>';
            echo '</div>';
        }
    }
    function all_videos_gallery(){
        $this->load->model('admin_model');
        $data['all_v_gallery']=$this->admin_model->all_videos_gallery();
        $this->load->view('teacher/videos_gallery/all_videos_gallery',$data);
    }
    function tabulation($stu,$class,$section){
        $this->load->model('admin_model');
        $data['student_id']=$stu;
        $data['class_id']=$class;
        $data['section_id']=$section;
        $data['exam']=$this->admin_model->list_all_exam_allowed_section($class,$section);
        $data['class']=$this->admin_model->list_all_active_class();
        $this->load->view('guardian/exam/tabulation',$data);
    }
    function tabulation_marks($exam_id,$class_id,$section_id,$stu_id){
        $this->load->model('admin_model');
        $data['exam_id']=$exam_id;
        $data['class_id']=$class_id;
        $data['section_id']=$section_id;
        $data['all_data']=$this->admin_model->all_student_by_student_id($stu_id);
        $data['sub']=$this->admin_model->list_all_exam_allowed_section_subject_tabulation($exam_id,$class_id,$section_id);

        $this->load->view('guardian/exam/tabulation_marks',$data);
    }
    function lib_book_stu_history($id){
        $this->load->model('admin_model');
        $data['id']=$id;
        $data['book']=$this->admin_model->book_history_by_stu_id($id);
        $this->load->view('admin/student/lib_book_history',$data);
    }
}
