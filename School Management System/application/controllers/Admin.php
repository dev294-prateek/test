<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('admin_model');
        $this->load->model('teacher_model');

    }
   /*============================change session=================================*/
    function change_session(){
        $ses=$this->input->post('session');
        $this->session->set_userdata('dynamic_db',$ses);
        if($ses=="school_erp"){$this->session->set_userdata('running_year','2019-2020');}
        elseif ($ses=="school_erp_1"){$this->session->set_userdata('running_year','2020-2021');}
        elseif ($ses=="school_erp_2"){$this->session->set_userdata('running_year','2021-2022');}
     }
    /*============================end change session============================*/
    public function index()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['setting']=$this->admin_model->get_setting();
        $this->load->view('admin/header',$data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/container');
        $this->load->view('admin/footer');
    }
    /*==================================================================*/
    /*                             PROFILE                              */
    /*==================================================================*/
    function profile()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['profile_image'] = $this->admin_model->profile($_SESSION ['user_id']);
        $this->load->view('admin/profile', $data);
    }
    function upload_profile_image()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('userfile');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        if ($new_image_name) {
            $this->$this->admin_model->update_profile_image($_SESSION ['user_id'], $new_image_name);
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
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $this->load->view('admin/dashboard');
	}
	public function dashboard2()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $this->load->view('admin/attendance_summary');
    }
    public function fee_summary()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $this->load->view('admin/fee_summary');
    }
    public function fee_summary_detail($sec_id)
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['section_id']=$sec_id;
        $this->load->view('admin/fee_summary_detail',$data);
    }
    /*==================================================================*/
    /*                             GUARDIAN                             */
    /*==================================================================*/
    function chk_guardian_email_exist(){
        $data=$this->input->post();
       $x =$this->admin_model->chk_guardian_email_exist($data);
       print_r($x);
    }
        function bulk_guardian_csv()
    {
        $data['students']=$this->admin_model->list_last_10_student();
        $this->load->view('admin/guardian/bulk_guardian_csv',$data);
    }
   function bulk_guardian_csv_import()
    {
          $this->load->library('csvimport');
          $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
          $x= $this->admin_model->add_guardian_csv($file_data);
          print_r($x);
    }
     public function guardian()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['nationality']=$this->admin_model->list_nationality();
        $this->load->view('admin/guardian/add_guardian',$data);
    }
    public function all_guardian()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['all_guardian']=$this->admin_model->list_all_guardian();
        $this->load->view('admin/guardian/all_guardian',$data);
    }
    public function add_guardian()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $ret=$this->admin_model->add_guardian($data);
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
            if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
            $data['guardian']=$this->admin_model->list_guardian_by_id($id);
            $data['nationality']=$this->admin_model->list_nationality();
            $this->load->view('admin/guardian/edit_guardian',$data);
        }
    public function print_guardian($id='')
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['guardian']=$this->admin_model->list_guardian_by_id($id);
        $this->load->view('admin/guardian/print_guardian',$data);
    }

    public function update_guardian()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $this->admin_model->update_guardian($data);
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
                $this->admin_model->update_guardian($data);
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
       $section=$this->admin_model->list_section_by_class_id($id);
      print_r(json_encode($section));

    }
    public function section_by_class_id2($id=''){
        $section=$this->admin_model->list_section_by_class_id($id);
        $section=$this->admin_model->list_section_subject_by_id($id);
        echo "<option >select</option>";
        foreach ($section as $row) {
           echo "<option value='" . $row['section_id'] . "'>" . $row['name'] . "</option>";
        }

    }

    public  function student(){
    if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['guardains']=$this->admin_model->list_all_guardian();
        $data['nationality']=$this->admin_model->list_nationality();
         $this->load->view('admin/student/admit_student',$data);
    }
    public  function bulk_student(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['guardains']=$this->admin_model->list_all_guardian();
        $data['nationality']=$this->admin_model->list_nationality();
        $data['students']=$this->admin_model->list_last_10_student();
        $this->load->view('admin/student/admit_bulk_student',$data);
    }
    /*---------------------*/
    function bulk_student_csv()
    {
        $data['students']=$this->admin_model->list_last_10_student();
        $this->load->view('admin/student/bulk_student_csv',$data);
    }
   function bulk_student_csv_import()
    {
         $this->load->library('csvimport');
         $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
         $x= $this->admin_model->add_student_csv($file_data);
         print_r($x);
    }
    public  function all_student_export(){
        $data['students'] = $this->admin_model->list_all_student();
        $this->load->view('admin/student/all_student_export',$data);
    }
    public  function all_student($class=1){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        if($class){
            $data['students']=$this->admin_model->list_all_student_by_class($class);
            $c=$this->admin_model->class_by_id($class);
            $data['class_name']=$c['name'];
        }
        else {
            $data['students'] = $this->admin_model->list_all_student();
            $data['class_name']="All Class";
        }

        $data['class']=$this->admin_model->list_all_class();
        $this->load->view('admin/student/all_student',$data);
    }
    public  function promotion($class=1){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        if($class){
            $data['students']=$this->admin_model->list_all_student_by_class($class);
            $c=$this->admin_model->class_by_id($class);
            $data['class_name']=$c['name'];
        }
        else {
            $data['students'] = $this->admin_model->list_all_student();
            $data['class_name']="All Class";
        }

        $data['class']=$this->admin_model->list_all_class();
        $this->load->view('admin/student/promotion',$data);
    }
    public  function alot_route($class=1){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        if($class){
            $data['students']=$this->admin_model->list_all_student_by_class($class);
            $c=$this->admin_model->class_by_id($class);
            $data['class_name']=$c['name'];
        }
        else {
            $data['students'] = $this->admin_model->list_all_student();
            $data['class_name']="All Class";
        }

        $data['class']=$this->admin_model->list_all_class();
        $data['route']=$this->admin_model->all_route();
        $this->load->view('admin/transport/all_student',$data);
    }
    /*==========================================*/
    function birth_certificate($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $this->load->view('admin/student/birth_certificate',$data);
    }
    function leaving_certificate($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $this->load->view('admin/student/leaving_certificate',$data);
    }
    function character_certificate($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $this->load->view('admin/student/character_certificate',$data);
    }
    function medical_certificate($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $this->load->view('admin/student/medical_certificate',$data);
    }
    function sc_st_certificate($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $this->load->view('admin/student/sc_st_certificate',$data);
    }
/*=============================================================================================*/
    public function admit_bulk_student()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->admin_model->add_student($data);
        echo $x;

    }
/*=============================================================================================*/
    public function admit_student()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $this->admin_model->add_student($data);
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
    function delete_student(){
        $student_id=$this->input->post('student_id');

        $x=  $this->admin_model->delete_student($student_id);
        $y=  $this->admin_model->delete_enroll($student_id);
        if($x && $y){echo 'deleted Successfully';}
        else{ echo 'Something went Wrong ';}
    }
    function update_promotion(){
        $data['student_id']=$this->input->post('student_id');
        $data['class']=$this->input->post('class');
        $data['section']=$this->input->post('section');
        $data['roll_no']=$this->input->post('roll_no');
        $x=  $this->admin_model->update_student($data);
        if($x){echo 'Promoted Successfully';}
        else{ echo 'Something went Wrong ';}
    }
    public function update_student()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $this->admin_model->update_student($data);
            print_r($data);
        }
        /*--------------------*/
      else {
            $this->admin_model->update_student($data);
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
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $data['class']=$this->admin_model->list_all_class();
        $data['guardains']=$this->admin_model->list_all_guardian();
        $data['nationality']=$this->admin_model->list_nationality();
        $this->load->view('admin/student/edit_student',$data);
    }
    public function print_student($id='')
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $data['class']=$this->admin_model->list_all_class();
        $data['guardains']=$this->admin_model->list_all_guardian();
        $this->load->view('admin/student/print_student',$data);
    }

  /*==========================Uplod  Certificate================================================*/
    function update_student_certificate(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
        $this->admin_model->update_student_certificate($data);
        print_r($data) ;
    }
    function change_student_status()
    {
        $data=$this->input->post();
       $x=$this->admin_model->change_student_status($data);
        print_r($x);

    }
    function st_subject($id){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['student']=$this->admin_model->list_student_by_id($id);
        $student_subject=$this->admin_model->student_subject($id);
        $data['student_subject']=json_decode($student_subject,true);
    /*    $data['student_sub_list']=$this->admin_model->list_student_subject_by_student_id($id);*/
/*        $data['sub_list']=$this->admin_model->admin_model->list_subjects();*/
        $this->load->view('admin/student/student_subject',$data);
    }
    function reset_student_subject(){
        $st_id=$this->input->post('st_id');
        $section_id=$this->input->post('section_id');
        $x=$this->admin_model->list_section_subject_by_id($section_id);
        $y=json_encode($x);
        $data2=array('student_id'=>$st_id,'subjects'=>$y);
        $z=$this->admin_model->update_enroll($data2);
        print_r($z);
    }
    function delete_student_subject(){
        $st_id=$this->input->post('st_id');
        $offset=$this->input->post('offset');
        $student_subject=$this->admin_model->student_subject($st_id);
        $student_subject=json_decode($student_subject,true);
       array_splice($student_subject, $offset, 1);
        $y=json_encode($student_subject);
        $data2=array('student_id'=>$st_id,'subjects'=> $y);
        $z=$this->admin_model->update_enroll($data2);
        print_r($z);
    }
    /*==================================================================*/
    /*                             EMPLOYEE                             */
    /*==================================================================*/
    function chk_employee_login_exist(){
        $data=$this->input->post();
        $x =$this->admin_model->chk_employee_login_exist($data);
        print_r($x);
    }

    function change_employee_status()
    {
        $data=$this->input->post();
        $x=$this->admin_model->change_employee_status($data);
        print_r($x);

    }
    public function employee()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['nationality']=$this->admin_model->list_nationality();
        $data['designation']=$this->admin_model->list_all_emp_designation();
        $this->load->view('admin/employee/add_employee',$data);
    }
    public function all_employee($x='')
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        if($x){$data['all_employee']=$this->admin_model->list_all_employee_by_des($x);
            $x = str_replace("-", " ", $x);
            $data['title']=$x;
        }
        else {$data['all_employee']=$this->admin_model->list_all_employee();$data['title']="All Employee";}
        $data['designation']=$this->admin_model->list_designation();
        $this->load->view('admin/employee/all_employee',$data);
    }

    public function add_employee()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $this->admin_model->add_employee($data);
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
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['employee']=$this->admin_model->list_employee_by_id($id);
        $data['nationality']=$this->admin_model->list_nationality();
        $data['designation']=$this->admin_model->list_all_emp_designation();
        $this->load->view('admin/employee/edit_employee',$data);
    }
    public function print_employee($id='')
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');

        $data['employee']=$this->admin_model->list_employee_by_id($id);
        $data['experience']=$this->admin_model->list_emp_experience_by_employee_id($id);
        $data['qualification']=$this->admin_model->list_emp_qualification_by_employee_id($id);
        $this->load->view('admin/employee/print_employee',$data);

    }

    public function update_employee()
    {
        /* dont chk session*/
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
            $this->admin_model->update_employee($data);
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
                $this->admin_model->update_employee($data);
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
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('certificate_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['certificate_image'] =  $image_name;
        $this->admin_model->add_emp_qualification($data);
    }
    function qualification($id=''){
        $data['employee']=$this->admin_model->list_employee_by_id($id);
        $data['qualification']=$this->admin_model->list_emp_qualification_by_employee_id($id);
        $this->load->view('admin/employee/add_qualification',$data);
    }
    function edit_qualification($id=''){

        $x=$data['qualification']=$this->admin_model->list_emp_qualification_by_qualification_id($id);
        $data['employee']=$this->admin_model->list_employee_by_id($x['employee_id']);
        $this->load->view('admin/employee/edit_qualification',$data);
    }
    function update_qualification(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('certificate_image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['certificate_image'] =  $image_name;
        if( $data['certificate_image'] == '' )  { unset($data['certificate_image']); }
        $this->admin_model->update_qualification($data);
        print_r($data);

    }
    function delete_qualification(){
        $data=$this->input->post('id');
        if($this->admin_model->delete_qualification($data));
        {echo $data;}
    }
    /*==================================================================*/
    /*                      EMPLOYEE  EXPERIENCE                        */
    /*==================================================================*/
    function add_experience(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        if($this->admin_model->add_emp_experience($data)){
            print_r($data);
        }
    }
    function experience($id=''){
        $data['employee']=$this->admin_model->list_employee_by_id($id);
        $data['experience']=$this->admin_model->list_emp_experience_by_employee_id($id);
        $this->load->view('admin/employee/add_experience',$data);
    }

    function edit_experience($id=''){
        $x=$data['experience']=$this->admin_model->list_emp_experience_by_experience_id($id);
       $data['employee']=$this->admin_model->list_employee_by_id($x['employee_id']);
      $this->load->view('admin/employee/edit_experience',$data);
    }

    function update_experience(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

       if( $this->admin_model->update_experience($data))
       {print_r($data);}
    }
    function delete_experience(){
        $data=$this->input->post('id');
        if($this->admin_model->delete_experience($data));
        {echo $data;}
    }
    /*==================================================================*/
    /*                             CLASS                                */
    /*==================================================================*/
    function  all_class(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['all_class']= $this->admin_model->list_all_class();
        $this->load->view('admin/class/all_class',$data);
    }
    function add_class()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();

        $x= $this->admin_model->add_class($data);
       print_r($x);
    }
    function update_class()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->admin_model->update_class($data);
        print_r($x);
    }
    function edit_class($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']= $this->admin_model->class_by_id($id);
        $this->load->view('admin/class/edit_class',$data);
    }
    /*==================================================================*/
    /*                              SECTION                             */
    /*==================================================================*/
    function  section(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['all_section']= $this->admin_model->list_all_section();
        $data['class']= $this->admin_model->list_all_active_class();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/class/section',$data);
    }
    function all_section(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['title']=" All Section";
        $data['flag']="section";
        $data['all_section']= $this->admin_model->list_all_section();
        $data['class']= $this->admin_model->list_all_active_class();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/class/all_section',$data);
    }
    function add_section()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->admin_model->add_section($data);
        print_r($x);
    }
    function update_section()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x= $this->admin_model->update_section($data);
        print_r($x);
    }
    function edit_section($id=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['section']= $this->admin_model->section_by_id($id);
        $data['class']= $this->admin_model->list_all_class();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/class/edit_section',$data);
    }
    /*==================================================================*/
    /*                              TEACHER                             */
    /*==================================================================*/
    function teacher(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['teacher']=$this->admin_model->list_all_teacher();
        $data['teacher_type']=$this->admin_model->list_all_teacher_type();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher_not_used();
        $this->load->view('admin/teacher/all_teacher',$data);
    }
  function edit_teacher($id){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['teacher']=$this->admin_model->teacher_by_id($id);
        $data['teacher_type']=$this->admin_model->list_all_teacher_type();
        $data['teacher_detail']=$this->admin_model->list_employee_by_id($id);
        $this->load->view('admin/teacher/edit_teacher',$data);
    }
    function show_teacher_detail(){
        $id=$this->input->post('id');
        $row=$this->admin_model->list_employee_by_id($id);
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
       $x= $this->admin_model->add_teacher($data);
       print_r($x);

    }
    function update_teacher(){
       $data=$this->input->post();
       $x= $this->admin_model->update_teacher($data);
       print_r($x);

    }
    function teacher_period($t_id=''){
        if($t_id ){
            $data['all_period'] = $this->admin_model->list_period_by_teacher($t_id);
        }
        else {
            $data['all_period'] = $this->admin_model->list_all_period();
        }
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/teacher/teacher_period',$data);
    }

    /*==================================================================*/
    /*                              PERIOD                              */
    /*==================================================================*/
    function show_teacher_detail_for_period(){
        $t_id=$this->input->post('id');
        $xx=$this->admin_model->teacher_by_id($t_id);
        $id=$xx['employee_id'];
        $tea_id=$this->admin_model->teacher_by_employee_id($id);
        $row=$this->admin_model->list_employee_by_id($id);
        $t_period=$this->admin_model->list_period_by_teacher( $tea_id['teacher_id']);
        $teacher=$this->admin_model->teacher_by_employee_id($id);
        $type=$this->admin_model->teacher_type_by_id($teacher['type']);
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
        print_r( "<tr><td colspan='4'style='text-align: center;color: darkgoldenrod;'>Teacher Period Allotted List </td></tr>");
        print_r( "<tr><th>Period</th><th style='width: 200px'>Time</th><th>Class</th><th>Section</th></tr>");
          foreach ($t_period as $row){
              $class=$this->admin_model->class_by_id($row['class_id']); $class=$class['name'];
              $period=$this->admin_model->list_period_by_id($row['name']); $period=$period['name'];
              $section=$this->admin_model->section_by_id($row['section_id']); $section=$section['name'];
        print_r( "<tr><td>".$period."</td><td style='width: 200px'>".date('h:ia', strtotime($row['start_time']))." - ".date('h:ia', strtotime($row['end_time']))."</td><td>".$class."</td><td>".$section."</td></tr>");
          }
        print_r('</table>');
    }

    function period(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['subject']=$this->admin_model->list_subjects();
        $data['subject_option']=$this->admin_model->list_subject_option();
        $data['period']=$this->admin_model->list_period();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/period/add_period',$data);
    }
    function edit_period($id){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['subject']=$this->admin_model->list_subjects();
        $data['subject_option']=$this->admin_model->list_subject_option();
        $data['period']=$this->admin_model->list_period();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $data['per']=$this->admin_model->list_period_allotment_by_id($id);
        $this->load->view('admin/period/edit_period',$data);
    }
    function alot_period(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->admin_model->add_period($data);
        print_r($x);
    }

    function update_period(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->admin_model->update_period($data);
        print_r($x);
    }
    function period_class_detail(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $c_id=$this->input->post('c_id');
        $s_id=$this->input->post('s_id');
        $x=$this->admin_model->list_period_by_section($c_id,$s_id);
       // print_r($x);
        print_r('<table class="table table-responsive">');
        print_r( "<tr><td colspan='4'style='text-align: center;color: darkgoldenrod;'>Class Period Allotted List</td></tr>");
        print_r( "<tr><th>Period</th><th style='width: 200px'>Time</th><th>Class</th><th>Section</th></tr>");
          foreach ($x as $row){
              $class=$this->admin_model->class_by_id($row['class_id']); $class=$class['name'];
              $period=$this->admin_model->list_period_by_id($row['name']); $period=$period['name'];
              $section=$this->admin_model->section_by_id($row['section_id']); $section=$section['name'];
              print_r( "<tr><td>".$period."</td><td style='width: 200px'>".date('h:ia', strtotime($row['start_time']))." - ".date('h:ia', strtotime($row['end_time']))."</td><td>".$class."</td><td>".$section."</td></tr>");
          }
        print_r('</table>');
    }
    /*---------------------*/
    function time_table($c=1,$s=17){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['cl']=$c;
        $data['sec']=$s;
        if($c && $s ){
            $data['all_period'] = $this->admin_model->list_period_by_section($c,$s);
        }
        else {
            $data['all_period'] = $this->admin_model->list_all_period();
        }
        $data['class']=$this->admin_model->list_all_class();
        $this->load->view('admin/period/time_table',$data);
    }
    /*---------------------*/
    function all_period($c='',$s=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['cl']=$c;
        $data['sec']=$s;
        if($c && $s ){
            $data['all_period'] = $this->admin_model->list_period_by_section($c,$s);
        }
        else {
            $data['all_period'] = $this->admin_model->list_all_period();
        }
        $data['class']=$this->admin_model->list_all_class();
        $this->load->view('admin/period/all_period',$data);
    }
    function change_period_status()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->admin_model->change_period_status($data);
        print_r($x);
    }

    /*==================================================================*/
    /*                          STUDENT ATTENDANCE                      */
    /*==================================================================*/
    function attendance($cl='',$sec='',$d=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['cl']=$cl; $data['sec']=$sec;$data['d']=$d;$data['students']='';
        if($cl && $sec && $d) {
            $z = $this->admin_model->chk_before_insert_attendance($cl, $sec, $d);
            if ($z == 0) {
                $y = $this->admin_model->get_data_from_enroll($cl, $sec);
                foreach ($y as $x) {
                    $st_id = $x['student_id'];
                    $c_id = $x['class_id'];
                    $s_id = $x['section_id'];
                    $this->admin_model->insert_attendance($st_id, $c_id, $s_id, $d);

                }
            }
            $xx = $this->admin_model->get_attendance($cl, $sec,$d);
            $data['students'] = $xx;
        }
        $this->load->view('admin/student/attendance',$data);
    }
    function update_attendance(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $c_id=$this->input->post('c_id');
        $id=$this->input->post('id');
        $attr=$this->input->post('attr');
        $value=$this->input->post('value');
        $name=$this->input->post('name');
        $data=array($attr=>$value);
        $x=$this->admin_model->update_attendance($id, $c_id,$data);
        if($x==1){
            echo $attr.' of Mr <span style="color: red">'. $name .'</span> updated Successfully';
        }else{
            echo 'unable to update <span style="color: red">'.$attr.'</span> of Mr '. $name;
        }
    }
    function sms_attendance(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $cl=$this->input->post('cl');
        $sec=$this->input->post('sec');
        $d=$this->input->post('d');
        $sms_data = $this->admin_model->get_attendance_for_sms($cl, $sec,$d);
        foreach ($sms_data as $row ){
            $status='';
            $data=$this->admin_model->student_name_mobile_sms($row['student_id']);
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
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['year']='';
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
         $data['students']=$this->admin_model->all_student_by_section_id($sec);
         $data['year']=$this->admin_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('admin/student/attendance_report',$data);
    }
    function attendance_analysis($cl='',$sec='',$month=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['year']='';
        $data['class']=$this->admin_model->list_all_class();
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
            $data['students']=$this->admin_model->all_student_by_section_id($sec);
            $data['year']=$this->admin_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('admin/student/attendance_analysis',$data);
    }
    function assessment_report($cl='',$sec='',$month=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['class']=$this->admin_model->list_all_class();
        $data['year']='';
        $data['cl']=$cl;
        $data['sec']=$sec;
        $data['month']=$month;
        $data['students']='';
        if($cl && $sec && $month) {
            $data['students']=$this->admin_model->all_student_by_section_id($sec);
            $data['year']=$this->admin_model->get_attendance_report_year($cl,$sec,$month);
        }
        $this->load->view('admin/student/assessment_report',$data);
    }
    /*==================================================================*/
    /*                          EMPLOYEE ATTENDANCE                      */
    /*==================================================================*/
    function emp_attendance_report($d=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['year'] ='';
        $data['month']=$d;
        $data['employee'] = '';
        if($d) {
            $data['year'] = $this->admin_model->get_emp_attendance_report_year($d);
            $data['employee'] = $this->admin_model->list_all_employee_name();
        }
        $this->load->view('admin/employee/attendance_report',$data);
    }
    function emp_attendance_analysis($d=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['year'] ='';
        $data['month']=$d;
        $data['employee'] = '';
        if($d) {
            $data['year'] = $this->admin_model->get_emp_attendance_report_year($d);
            $data['employee'] = $this->admin_model->list_all_employee_name();
        }
        $this->load->view('admin/employee/attendance_analysis',$data);
    }
    function emp_attendance($d=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['d'] =$d;$data['employee'] = '';
        if($d) {
            $z = $this->admin_model->chk_before_insert_emp_attendance($d);
            if ($z == 0) {
                $y = $this->admin_model->get_data_from_employee();
                foreach ($y as $x) {
                    if($x['designation']!='admin') {
                        $emp_id = $x['employee_id'];
                        $this->admin_model->insert_emp_attendance($emp_id, $d);
                    }
                }
            }
            $xx = $this->admin_model->get_emp_attendance($d);
            $data['employee'] = $xx;
        }
        $this->load->view('admin/employee/attendance',$data);
    }

    function update_emp_attendance(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $id=$this->input->post('id');
        $value=$this->input->post('value');
        $name=$this->input->post('name');

        $x=$this->admin_model->update_emp_attendance($id,$value);
        if($x==1){
            echo 'Attendance of Mr <span style="color: red">'. $name .'</span> updated Successfully';
        }else{
            echo 'unable to update <span style="color: red">Attendance</span> of Mr '. $name;
        }

    }
    function sms_emp_attendance(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $d=$this->input->post('d');
        $sms_data = $this->admin_model->get_attendance_for_emp_sms($d);
        foreach ($sms_data as $row ){
            $status='';
            $data=$this->admin_model->employee_name_mobile_sms($row['employee_id']);
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
        $z=$this->admin_model->chk_before_insert_attendance($c_id,$s_id);
        if($z==0) {
            $y=$this->admin_model->get_data_from_enroll(3,2);
            foreach ($y as $x) {
                $st_id = $x['student_id'];
                $c_id = $x['class_id'];
                $s_id = $x['section_id'];
                $this->admin_model->insert_attendance($st_id, $c_id, $s_id);
                echo 'success';
            }
        }
        else
        {
            $xx=$this->admin_model->get_attendance($c_id,$s_id);
            print_r($xx);
        }

    }
    function test1(){
        $data=array('employee_id'=>1,'type'=>4);
        $x=$this->admin_model->add_teacher($data);
        echo  "<pre>";
        print_r($x);
    }
    function class_work(){
        $x=$this->admin_model->class_work();
        $c_work=array(); $ind=0;
      /*  echo "<pre>";*/
        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->admin_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->admin_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['teacher']=$this->admin_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->admin_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['teacher']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['class_work']=$c_work;
        $this->load->view('admin/class/class_work',$data);
    }
    function add_class_work(){
        $data['class']=$this->admin_model->list_all_class();
        $data['subject']=$this->admin_model->list_subjects();
        $data['period']=$this->admin_model->list_period();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/class/add_class_work',$data);
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
        $x=$this->admin_model->add_class_work($data);
        print_r($x);
    }

    function home_work(){
        $x=$this->admin_model->home_work();
        $c_work=array(); $ind=0;

        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->admin_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->admin_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['teacher']=$this->admin_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->admin_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['teacher']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['class_work']=$c_work;
        $this->load->view('admin/class/home_work',$data);
    }
    function add_home_work(){
        $data['class']=$this->admin_model->list_all_class();
        $data['subject']=$this->admin_model->list_subjects();
        $data['period']=$this->admin_model->list_period();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/class/add_home_work',$data);
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
        $x=$this->admin_model->add_home_work($data);
        print_r($x);
    }

    /*==================================================================*/
    /*                          CLASS GALLERY                           */
    /*==================================================================*/
    function class_gallery(){
        $data['class']=$this->admin_model->list_all_class();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/gallery/class_gallery',$data);    }
    public function add_class_gallery()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $ret=$this->admin_model->add_class_gallery($data);
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
        $data['gallery']=$this->admin_model->list_class_gallery_by_teacher_id_active();
        $this->load->view('admin/gallery/all_class_gallery',$data);
    }
    function more_class_gallery(){
        $data['gallery']=$this->admin_model->list_class_gallery_by_teacher_id();
        $this->load->view('admin/gallery/more_class_gallery',$data);
    }
    function cl_image($id){
        $data['gallery']=$this->admin_model->list_class_gallery_by_id($id);
        $data['all_gallery']=$this->admin_model->list_image_by_class_gallery_id($id);
        $this->load->view('admin/gallery/add_cl_image',$data);
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
        $x=$this->admin_model->add_class_gallery_photo($id,$image_name);
        print_r($x);
    }
    function view_more_class_gal($id){
        $data['gallery']=$this->admin_model->list_class_gallery_by_id($id);
        $data['all_gallery']=$this->admin_model->list_image_by_class_gallery_id($id);
        $this->load->view('admin/gallery/view_more',$data);
    }
    function edit_class_gallery($id){
        $data['gallery']=$this->admin_model->list_class_gallery_by_id($id);
        $this->load->view('admin/gallery/update_class_gallery',$data);
    }
    function update_class_gallery(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $new_image_name = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
        $data=$this->input->post();
        print_r($data);
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
        $ret=$this->admin_model->update_class_gallery($data);
        return $ret;
    }
    function delete_class_image(){
        $id=$this->input->post('id');
        $ret=$this->admin_model->delete_class_image($id);
        echo $ret;
    }

    /*==================================================================*/
    /*                            SUBJECTS                              */
    /*==================================================================*/
    function subjects(){
        $data['subject_list']=$this->admin_model->list_subjects();
        $this->load->view('admin/subject/subjects',$data);
    }
    function edit_subjects($id){
        $data['subject']=$this->admin_model->list_subjects_by_id($id);
        $this->load->view('admin/subject/edit_subjects',$data);
    }
    function section_syllabus($id){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['section']=$this->admin_model->section_by_id($id);
        $data['section_sub_list']=$this->admin_model->list_section_subject_by_section_id($id);
        $data['sub_list']=$this->admin_model->admin_model->list_subjects();
        $this->load->view('admin/subject/syllabus',$data);
    }
    function update_section_syllabus(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->do_upload('syllabus');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $data=$this->input->post();
        $data['syllabus']= $image_name;
        $x=$this->admin_model->update_section($data);
        print_r($x);
    }
    function add_subject_list(){
        $data=$this->input->post();
        $x=$this->admin_model->add_subject_list($data);
        print_r($x);
    }
    function update_subject_list(){
        $data=$this->input->post();
        $x=$this->admin_model->update_subject_list($data);
        print_r($x);
    }
    /*==================================================================*/
    /*                      SECTION   SUBJECTS                          */
    /*==================================================================*/
    function section_subject($id){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['section']=$this->admin_model->section_by_id($id);
        $data['section_sub_list']=$this->admin_model->list_section_subject_by_section_id($id);
        $data['sub_list']=$this->admin_model->admin_model->list_subjects();
        $this->load->view('admin/subject/section_subject',$data);
    }
    function add_section_subject(){
        $data=$this->input->post();
        $x=$this->admin_model->admin_model->add_section_subject($data);
        print_r($x);
    }
    function  delete_section_subject(){
        $id=$this->input->post('id');
        $x=$this->admin_model->admin_model->delete_section_subject($id);
        print_r($x);
    }
    function change_section_subject_status(){
        $data=$this->input->post();
        $x=$this->admin_model->admin_model->update_section_subject($data);
        print_r($x);
    }

    /*==================================================================*/
    /*                             EXAM                                 */
    /*==================================================================*/
    function create_exam(){
        $data['type']=$this->admin_model->list_exam_type();
        $data['all_exam']=$this->admin_model->list_all_exam();
        $this->load->view('admin/exam/create_exam',$data);
    }
    function add_exam(){
        $data=$this->input->post();
        $x=$this->admin_model->add_exam($data);
        print_r($x);
    }
    function edit_exam ($id){
        $data['type']=$this->admin_model->list_exam_type();
        $data['exam']=$this->admin_model->list_all_exam_by_id($id);
        $this->load->view('admin/exam/edit_exam',$data);
    }
    function update_exam(){
        $data=$this->input->post();
        $x=$this->admin_model->update_exam($data);
        print_r($x);
    }
    function allow_exam_class($id){
        $data['class']=$this->admin_model->list_all_class();
        $data['exam']=$this->admin_model->list_all_exam_by_id($id);
        $data['all_exam']=$this->admin_model->list_all_exam_allowed_by_exam_id($id);
        $this->load->view('admin/exam/allow_exam_class',$data);
    }
    function add_allow_exam_class(){
        $data=$this->input->post();
        $x=$this->admin_model->add_exam_allowed_section($data);
        print_r($x);
    }
    function update_allow_exam_class(){
        $data=$this->input->post();
        $x=$this->admin_model->update_exam_allowed_section($data);
        print_r($data);
    }
    function edit_exam_class($id){
        $data['class']=$this->admin_model->list_all_class();
        $data['allowed_class']=$this->admin_model->list_exam_allowed_section_id($id);
        $this->load->view('admin/exam/edit_exam_class',$data);
    }

    function subject_marks($id){
        $x=$data['allowed_class']=$this->admin_model->list_exam_allowed_section_id($id);
        $data['section_subject']=$this->admin_model->list_section_subject_by_section_id($x['section_id']);
        $data['section_subject_list']=$this->admin_model->list_all_exam_allowed_section_subject($x['exam_id'],$x['class_id'],$x['section_id']);
        $data['subject_option']=$this->admin_model->list_subject_option();
        $this->load->view('admin/exam/subject_marks',$data);
    }
    function syllabus_study($id){
        $x=$data['allowed_class']=$this->admin_model->list_exam_allowed_section_id($id);
        $data['section_subject']=$this->admin_model->list_section_subject_by_section_id($x['section_id']);
        $data['section_subject_list']=$this->admin_model->list_all_exam_allowed_section_subject($x['exam_id'],$x['class_id'],$x['section_id']);
        $data['subject_option']=$this->admin_model->list_subject_option();
        $this->load->view('admin/exam/syllabus_study',$data);
    }
    function exam_time_table($id){
        $x=$data['allowed_class']=$this->admin_model->list_exam_allowed_section_id($id);
        $data['section_subject']=$this->admin_model->list_section_subject_by_section_id($x['section_id']);
        $data['section_subject_list']=$this->admin_model->list_all_exam_allowed_section_subject($x['exam_id'],$x['class_id'],$x['section_id']);
        $data['subject_option']=$this->admin_model->list_subject_option();
        $this->load->view('admin/exam/exam_time_table',$data);
    }
    function edit_subject_marks($id,$sub_id){
       $y= $data['exam_allowed_section_subject']=$this->admin_model->list_exam_allowed_section_subject_by_id($id);
        $data['section_subject']=$this->admin_model->list_section_subject_by_section_id($y['section_id']);
        $data['subject_option']=$this->admin_model->list_subject_option();
        $data['sub_id']=$sub_id;
        $this->load->view('admin/exam/edit_subject_marks',$data);
    }
    function manage_subject_marks($id){
        $x=$data['allowed_class']=$this->admin_model->list_exam_allowed_section_id($id);
        $data['section_subject']=$this->admin_model->list_section_subject_by_section_id($x['section_id']);
        $this->load->view('admin/exam/manage_subject_marks',$data);
    }

    /*==================================================================*/
    /*                EXAM ALLOWED SECTION  SUBJECT                     */
    /*==================================================================*/
    function add_exam_allowed_section_subject(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $data=$this->input->post();
        $this->upload->do_upload('syllabus');
        $upload_data = $this->upload->data();
        $syllabus = $upload_data['file_name'];
        $data['syllabus']= $syllabus;

        $this->upload->do_upload('study_material');
        $upload_data2 = $this->upload->data();
        $study_material = $upload_data2['file_name'];
        $data['study_material']= $study_material;

        $x=$this->admin_model->add_exam_allowed_section_subject($data);
        print_r($x);
    }
    function update_exam_allowed_section_subject(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $data=$this->input->post();
        $this->upload->do_upload('syllabus');
        $upload_data = $this->upload->data();
        $syllabus = $upload_data['file_name'];
        if($syllabus){
        $data['syllabus']= $syllabus;
        }

        $this->upload->do_upload('study_material');
        $upload_data2 = $this->upload->data();
        $study_material = $upload_data2['file_name'];
        if($study_material) {
            $data['study_material'] = $study_material;
        }
        $x=$this->admin_model->update_exam_allowed_section_subject($data);
        print_r($x);
    }
    /*==================================================================*/
    /*                                EXAM GRADE                        */
    /*==================================================================*/
    function exam_grade(){
        $data['all_grade']=$this->admin_model->list_exam_grade();
        $this->load->view('admin/exam/grade',$data);
    }
    function edit_exam_grade($id){
        $data['grade']=$this->admin_model->list_exam_grade_by_id($id);
        $this->load->view('admin/exam/edit_grade',$data);
    }
    function add_exam_grade(){
        $data=$this->input->post();
        $x=$this->admin_model->add_exam_grade($data);
        print_r($x);
    }
    function update_exam_grade(){
        $data=$this->input->post();
        $x=$this->admin_model->update_exam_grade($data);
        print_r($x);
    }
    function exam_marks(){
        $data['class']=$this->admin_model->list_all_active_class();
        $this->load->view('admin/exam/exam_marks',$data);
    }
    function list_section_subject($id=""){
        $section=$this->admin_model->list_section_subject_by_id($id);
        echo "<option >select</option>";
        foreach ($section as $row) {
            $x=$this->admin_model->list_subjects_by_id($row['subject_id']);
            echo "<option value='" . $row['subject_id'] . "'>" . $x['name'] . "</option>";
        }
    }
    function list_exam(){
        $data=$this->input->post();
        $x=$this->admin_model->list_all_exam_allowed_section($data['class_id'],$data['section_id']);
        echo "<option >select</option>";
        foreach ($x as $row){
            $x=$this->admin_model->exam_by_id($row['exam_id']);
            echo "<option value='" . $row['exam_id'] . "'>" . $x['name'] . "</option>";
        }
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
        $this->load->view('admin/exam/paper_marks',$data);
    }
    function update_exam_marks_value(){
        $data=$this->input->post();
        if($this->teacher_model->update_exam_marks($data)){
            print_r($data['marks']);
        }

    }

    function tabulation(){
        $data['class']=$this->admin_model->list_all_active_class();
        $this->load->view('admin/exam/tabulation',$data);
    }
    function tabulation_marks($exam_id,$class_id,$section_id){
        $data['exam_id']=$exam_id;
        $data['class_id']=$class_id;

        $data['section_id']=$section_id;
        $data['all_data']=$this->admin_model->all_student_by_section_id($section_id);
        $data['sub']=$this->admin_model->list_all_exam_allowed_section_subject_tabulation($exam_id,$class_id,$section_id);

        $this->load->view('admin/exam/tabulation_marks',$data);
    }
    function generate_tabulation_marks(){
        $data=$this->input->post();
        $section_id=$data['section_id'];
        $stu=$this->teacher_model->list_enroll_by_section_id($section_id);
        print_r($stu);
    }
    /*==================================================================*/
    /*                              LIBRARY                             */
    /*==================================================================*/
    function manage_book(){
        $data['class']=$this->admin_model->list_all_active_class();
        $this->load->view('admin/library/manage_book',$data);
    }
    function edit_book($id){
        $data['book']=$this->admin_model->list_book_by_id($id);
        $data['class']=$this->admin_model->list_all_active_class();
        $this->load->view('admin/library/edit_book',$data);
    }
    public  function all_book($class=''){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        if($class){
            $data['books']=$this->admin_model->list_all_book_by_class($class);
            $c=$this->admin_model->class_by_id($class);
            $data['class_name']=$c['name'];
        }
        else {
            $data['books'] = $this->admin_model->list_all_book();
            $data['class_name']="All Class";
        }

        $data['class']=$this->admin_model->list_all_class();
        $this->load->view('admin/library/all_book',$data);
    }
    function add_book(){
       $data=$this->input->post();
       $qty=$data['quantity'];
       unset($data['quantity']);
       for($i=1; $i<=$qty;$i++){
            $this->admin_model->add_book($data);
       }
      echo $qty ;
    }
    function update_book(){
        $data=$this->input->post();
        $x= $this->admin_model->update_book($data);
        print_r($x);
    }
    function relese_book(){
        $data=$this->input->post();
        $data2= $this->admin_model->list_book_by_id_for_history($data['id']);
        $this->admin_model->update_relese_history($data2);
        $x= $this->admin_model->update_book($data);
        print_r($x);
    }
    function issue_book_to_student($id){
        $x=$data['book']=$this->admin_model->list_book_by_id($id);
        $data['class']=$this->admin_model->list_all_active_class();
        $data['section']=$this->admin_model->list_section_by_class_id($x['class']);
        $this->load->view('admin/library/to_student',$data);
    }
    function update_issue_book_to_student(){
        $data=$this->input->post();
        $data['status']=0;
        $x= $this->admin_model->update_book($data);
        print_r($x);
    }
    function issue_book_to_staff($id){
        $x=$data['book']=$this->admin_model->list_book_by_id($id);
        $data['employee']=$this->admin_model->list_all_employee();
        $data['class']=$this->admin_model->list_all_active_class();
        $data['section']=$this->admin_model->list_section_by_class_id($x['class']);
        $this->load->view('admin/library/to_staff',$data);
    }
    function library_students($sec_id){
        $stu=$this->admin_model->all_student_by_section_id($sec_id);
        foreach ($stu as $row) {

            echo '<option value="' . $row["student_id"] . '">' . $row["student_name"]. '</option>';
        }
    }
    function lib_book_history($id){
        $data['id']=$id;
        $data['book']=$this->admin_model->book_history_by_book_id($id);
        $this->load->view('admin/library/lib_book_history',$data);
    }
    function lib_book_stu_history($id){
        $data['id']=$id;
        $data['book']=$this->admin_model->book_history_by_book_id($id);
        $this->load->view('admin/student/lib_book_history',$data);
    }
    function lib_book_emp_history($id){
        $data['id']=$id;
        $data['book']=$this->admin_model->book_history_by_emp_id($id);
        $this->load->view('admin/employee/lib_book_history',$data);
    }
    function test(){
        $x=$this->admin_model->list_section_subject_by_id(1);
        $y=json_encode($x);
        print_r($y);
    }
    /*==================================================================*/
    /*                           NOTICE BOARD                           */
    /*==================================================================*/
    function noticeboard(){
        $data['all_notice']=$this->admin_model->all_noticeboard();
        $this->load->view('admin/noticeboard/noticeboard',$data);
    }
    function view_noticeboard(){
        $data['all_notice']=$this->admin_model->all_noticeboard();
        $this->load->view('admin/noticeboard/view_noticeboard',$data);
    }
    function edit_noticeboard($id){
        $data['notice']=$this->admin_model->noticeboard_by_id($id);
        $this->load->view('admin/noticeboard/edit_noticeboard',$data);
    }
    function add_noticeboard(){
        $data=$this->input->post();
        $x= $this->admin_model->add_noticeboard($data);
        print_r($x);
    }

    function update_noticeboard(){
        $data=$this->input->post();
        $x= $this->admin_model->update_noticeboard($data);
        print_r($x);
    }

    function delete_noticeboard(){
        $id=$this->input->post('id');
        $x= $this->admin_model->delete_noticeboard($id);
        echo($x);
    }
/*    public function noticeboard_by_id($id)
    {
        $data = array('id' => $id);
        $x= $this->db->get_where('noticeboard',$data)->result_array();
        return $x;
    }*/
    /*==================================================================*/
    /*                           EVENT CALENDAR                          */
    /*==================================================================*/
    function event(){
        $data['result'] = $this->admin_model->all_event();
        foreach ($data['result'] as $key => $value) {
            $data['data'][$key]['id'] = $value->id;
            $data['data'][$key]['title'] = $value->title;
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#b8860b";
        }
        $this->load->view('admin/event/event', $data);
    }
    function add_event(){
        $data=$this->input->post();
        $x= $this->admin_model->add_event($data);
        print_r($x);
    }
    function update_event(){
        $data=$this->input->post();
        $x= $this->admin_model->update_event($data);
        print_r($x);
    }
    function delete_event(){
        $id=$this->input->post('id');
        $x= $this->admin_model->delete_event($id);
        print_r($x);
    }
    function all_event(){
        $data['events']= $this->admin_model->all_events();
        $this->load->view('admin/event/all_event', $data);
    }
    function manage_event($id){
        $data['events']= $this->admin_model->event_by_id($id);
        $data['all_event_teacher']= $this->admin_model->all_event_teacher($id);
        $data['all_event_student']= $this->admin_model->all_event_student($id);
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $data['all_class']=$this->admin_model->list_all_class();
        $this->load->view('admin/event/manage_event', $data);
    }
    function add_event_teacher(){
        $data=$this->input->post();
        $x= $this->admin_model->add_event_teacher($data);
        print_r($x);
    }
    function delete_event_teacher(){
        $id=$this->input->post('id');
        $x= $this->admin_model->delete_event_teacher($id);
        print_r($x);
    }
    function add_event_student(){
        $data=$this->input->post();
        $x= $this->admin_model->add_event_student($data);
        print_r($x);
    }
    function delete_event_student(){
        $id=$this->input->post('id');
        $x= $this->admin_model->delete_event_student($id);
        print_r($x);
    }
    /*==================================================================*/
    /*                              TRANSPORT                           */
    /*==================================================================*/
    function vehicle(){
        $this->load->view('admin/transport/add_vehicle');
    }
    function edit_vehicle($id){
        $data['vehicle']=  $x= $this->admin_model->vehicle_by_id($id);
        $this->load->view('admin/transport/edit_vehicle',$data);
    }
    function add_vehicle(){
        $data=$this->input->post();
        $x= $this->admin_model->add_vehicle($data);
        print_r($x);
    }
    function update_vehicle(){
        $data=$this->input->post();
        $x= $this->admin_model->update_vehicle($data);
        print_r($x);
    }
    function all_vehicle(){
        $data['all_vehicle']=  $x= $this->admin_model->all_vehicle();
        $this->load->view('admin/transport/all_vehicle', $data);
    }
    function get_location(){
        $data=$this->input->post();
        $y= $this->admin_model->update_student_transport($data);
        $x= $this->admin_model->all_route_location($data['route_id']);
        echo "<option >select</option>";
        foreach ($x as $row) {
          echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    }
    function update_student_start_location(){
        $data=$this->input->post();
        $x= $this->admin_model->update_student_transport($data);
        echo $x;
    }

    /*==================================================================*/
    /*                            LESSON PLAN                            */
    /*==================================================================*/

    function lesson_plan(){
        $x=$this->admin_model->lesson_plan();
        $c_work=array(); $ind=0;
        /*  echo "<pre>";*/
        foreach ($x as $row) {
            $c_work[$ind]['class']=$this->admin_model->class_by_id($row['class_id'])['name'];
            $c_work[$ind]['section']=$this->admin_model->section_by_id($row['section_id'])['name'];
            $c_work[$ind]['teacher']=$this->admin_model->teacher_name($row['teacher_id']);
            $c_work[$ind]['subject']=$this->admin_model->list_subjects_by_id($row['subject_id'])['name'];
            $c_work[$ind]['date']=$row['date'];
            $c_work[$ind]['title']=$row['title'];
            $c_work[$ind]['description']=$row['description'];
            $c_work[$ind]['attachment']=$row['attachment'];
            $c_work[$ind]['credit']="<table ><tr><td><i class='entypo-suitcase'></i> &nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['class']." </span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-minus-squared'></i>&nbsp;&nbsp; <span style='color: black'>".$c_work[$ind]['section']."</span> &nbsp;&nbsp;|&nbsp;&nbsp;<i class='entypo-user'></i>&nbsp;&nbsp;<span style='color: black'>".$c_work[$ind]['teacher']."</span> &nbsp;&nbsp;</td></tr></table>";

            $ind++;
        }

        $data['lesson_plan']=$c_work;
        $this->load->view('admin/class/lesson_plan',$data);
    }
    function add_lesson_plan($id=''){
        $data['s_period']=$this->admin_model->list_period_allotment_by_id($id);
        $this->load->view('admin/class/add_lesson_plan',$data);
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
        $x=$this->admin_model->add_lesson_plan($data);
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
        $x=$this->admin_model->update_lesson_plan($data);
        print_r($x);
    }
    function all_lesson_plan(){
        $data['lesson_plan']=$this->admin_model->lesson_plan();
        $this->load->view('admin/class/all_lesson_plan',$data);
    }
    function edit_lesson_plan($id=''){
        $data['lesson_plan']=$this->admin_model->lesson_plan_by_id($id);
        $this->load->view('admin/class/edit_lesson_plan',$data);
    }
    function approv_req_lesson_plan($id=''){
        $data['lesson_plan']=$this->admin_model->lesson_plan_by_id($id);
        $this->load->view('admin/class/approv_req_lesson_plan',$data);
    }
    function final_req_lesson_plan($id=''){
        $data['lesson_plan']=$this->admin_model->lesson_plan_by_id($id);
        $this->load->view('admin/class/final_req_lesson_plan',$data);
    }
    /*==================================================================*/
    /*                          SCHOOL GALLERY                          */
    /*==================================================================*/
    function school_gallery(){
        $this->load->view('admin/sh_gallery/school_gallery');    }
    public function add_school_gallery()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $ret=$this->admin_model->add_school_gallery($data);
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
    function all_school_gallery(){
        $data['gallery']=$this->admin_model->list_school_gallery_by_teacher_id_active();
        $this->load->view('admin/sh_gallery/all_school_gallery',$data);
    }
    function more_school_gallery(){
        $data['gallery']=$this->admin_model->list_school_gallery_by_teacher_id();
        $this->load->view('admin/sh_gallery/more_school_gallery',$data);
    }
    function sh_image($id){
        $data['gallery']=$this->admin_model->list_school_gallery_by_id($id);
        $data['all_gallery']=$this->admin_model->list_image_by_school_gallery_id($id);
        $this->load->view('admin/sh_gallery/add_cl_image',$data);
    }
    function add_school_gal(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $id=$this->input->post('id');
        $x=$this->admin_model->add_school_gallery_photo($id,$image_name);
        print_r($x);
    }
    function view_more_school_gal($id){
        $data['gallery']=$this->admin_model->list_school_gallery_by_id($id);
        $data['all_gallery']=$this->admin_model->list_image_by_school_gallery_id($id);
        $this->load->view('admin/sh_gallery/view_more',$data);
    }
    function edit_school_gallery($id){
        $data['gallery']=$this->admin_model->list_school_gallery_by_id($id);
        $this->load->view('admin/sh_gallery/update_school_gallery',$data);
    }
    function update_school_gallery(){
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
        $ret=$this->admin_model->update_school_gallery($data);
        return $ret;
    }
    function delete_school_image(){
        $id=$this->input->post('id');
        $ret=$this->admin_model->delete_school_image($id);
        echo $ret;
    }


    /*==================================================================*/
    /*                        SCHOOL VIDEOS GALLERY                     */
    /*==================================================================*/

    function videos_gallery(){
        $this->load->view('admin/videos_gallery/videos_gallery');
     }
    function add_videos_gallery(){
        $data=$this->input->post();
        $x=$this->admin_model->add_videos_gallery($data);
        echo $x;
    }
    function update_videos_gallery(){
        $data=$this->input->post();
        $x=$this->admin_model->update_videos_gallery($data);
        echo $x;
    }
    function all_videos_gallery(){
        $data['all_v_gallery']=$this->admin_model->all_videos_gallery();
        $this->load->view('admin/videos_gallery/all_videos_gallery',$data);
    }
    function edit_videos_gallery($id){
        $data['gallery']=$this->admin_model->videos_gallery_by_id($id);
        $this->load->view('admin/videos_gallery/edit_videos_gallery',$data);
    }
    /*==================================================================*/
    /*                                 FEE                              */
    /*==================================================================*/

    function fee(){
        $data['all']=$this->admin_model->all_fee();
        $data['fee_type']=$this->admin_model->fee_type();
        $this->load->view('admin/fee/add_fee',$data);
    }
    function add_fee(){
        $data=$this->input->post();
        $x=$this->admin_model->add_fee($data);
        echo $x;
    }
    function update_fee(){
        $data=$this->input->post();
        $x=$this->admin_model->update_fee($data);
        echo $x;
    }
    function edit_fee($id){
        $data['fee']=$this->admin_model->fee_by_id($id);
        $data['fee_type']=$this->admin_model->fee_type();
        $this->load->view('admin/fee/edit_fee',$data);
    }
    function fee_section(){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['title']=" Manage Section Fee";
        $data['flag']="fee";
        $data['all_section']= $this->admin_model->list_all_section();
        $data['class']= $this->admin_model->list_all_active_class();
        $data['emp_teacher']=$this->admin_model->list_all_employee_teacher();
        $this->load->view('admin/class/all_section',$data);
    }
    /*==================================================================*/
    /*                          FEE  SECTION                            */
    /*==================================================================*/
    function section_fee($id){
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data['section']=$this->admin_model->section_by_id($id);
        $data['section_fee']=$this->admin_model->list_section_fee_by_section_id($id);
        $data['all_fee']=$this->admin_model->all_fee();
        $this->load->view('admin/fee/fee_section',$data);
    }
    function add_section_fee(){
        $data=$this->input->post();
        $x=$this->admin_model->add_section_fee($data);
        print_r($data);
    }
    function delete_section_fee(){
        $id=$this->input->post('id');
        $x=$this->admin_model->delete_section_fee($id);
        print_r($x);
    }
    function find_fee_detail(){
        $id=$this->input->post('id');
        $data=$this->admin_model->fee_by_id($id);
        $type=$this->admin_model->fee_type_name($data['type']);
        echo '<div class="alert alert-warning " > <a href="#" class="close" data-dismiss="alert" aria-label="close"></a> Fee : <span style="color: red"> '.$data['name'].' </span> Type : <span style="color: red"> '.$type.'   </span> <div></div></div>';
    }
    function list_student_by_class_section_id(){
        $c_id=$this->input->post('c_id');
        $s_id=$this->input->post('s_id');
        $data=$this->admin_model->list_student_by_class_section_id($c_id,$s_id);
        echo "<option >select</option>";
        foreach ($data as $row) {
            $x=$this->admin_model->student_name($row['student_id']);
            echo "<option value='" . $row['student_id'] . "'>" . $x . "</option>";
        }
    }
    function student_fee($cl_id="",$s_id="",$st_id=""){
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
        $this->load->view('admin/fee/student_fee',$data);
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
        $this->load->view('admin/fee/pay_student_fee',$data);
    }
    function marksheet($cl_id="",$s_id="",$st_id=""){
        if($cl_id){
            $class= $this->admin_model->class_by_id($cl_id);

            $data['class']=$class['name'];
            $teacher= $this->admin_model->class_teacher_by_section_id($s_id);
            $data['class_teacher']=$teacher;
            $section= $this->admin_model->section_by_id($s_id);
            $data['section']=$section['name'];
            $data['class_id']=$cl_id;
            $data['section_id']=$s_id;
            $data['student_id']=$st_id;
            $student = $this->admin_model->student_detail_by_id($st_id);
            $data['student']=$student;
            $data['subjects']=$this->admin_model->list_active_section_subject_by_section_id($s_id);
            $exam=$this->admin_model->list_exam_allowed_section_by_section_id($s_id);
            $data['attendance']=$this->admin_model->get_attendance_individual_marksheet($cl_id,$s_id,$st_id);
            $data['unit_exam'][]='';
            $data['hf_exam']='';
            $data['an_exam']='';
            foreach ($exam as $row){
                $data['exam'][]=$d= $this->admin_model->exam_by_id_type($row['exam_id']);
                if($d['type']==3){$data['an_exam']=$d['id'];}
                elseif($d['type']==2){$data['hf_exam']=$d['id'];}
                else{$data['unit_exam'][]=$d['id'];  }
            }
            $data['library_fee']=$this->admin_model->library_late_fee_for_student($st_id);
        }else{
            $data['unit_exam']=array();
            $data['class_teacher']="";
            $data['section_id']="";
            $data['subjects']="";
            $data['class']="";
            $data['section']="";
            $data['student']="";
            $data['section_fee']="";
            $data['library_fee']=0;
        }
        $data['all_class']=$this->admin_model->list_all_class();
        $this->load->view('admin/exam/marksheet',$data);
    }
    function add_student_fee(){
        $data=$this->input->post();
        $x=$this->admin_model->add_student_fee($data);
        print_r($x);
    }


    /*==================================================================*/
    /*                              TRANSPORT                           */
    /*==================================================================*/
    function driver(){
        $this->load->view('admin/transport/add_driver');
    }
    function edit_driver($id){
        $data['driver']=  $x= $this->admin_model->driver_by_id($id);
        $this->load->view('admin/transport/edit_driver',$data);
    }
    public function add_driver()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
            $ret=$this->admin_model->add_driver($data);
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
    public function update_driver()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
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
        if( $data['image'] == '_thumb' )  {
            unset($data['image']);
            $this->admin_model->update_driver($data);
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
                $this->admin_model->update_driver($data);
                print_r($data);
            }
        }
        $source="uploads/$image_name";
        unlink ($source);
    }
    function all_driver(){
        $data['all_driver']=  $x= $this->admin_model->all_driver();
        $this->load->view('admin/transport/all_driver', $data);
    }
    function change_driver_status()
    {
        if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
        $data=$this->input->post();
        $x=$this->admin_model->update_driver($data);
        print_r($x);
    }

    /*==================================================================*/
    /*                              ROUTE                               */
    /*==================================================================*/
    function route()
    {
        $data['all_route']=$this->admin_model->all_route();
        $this->load->view('admin/route/route',$data);
    }
    function edit_route($id)
    {
        $data['route']=$this->admin_model->route_by_id($id);
        $this->load->view('admin/route/edit_route',$data);
    }
    function add_route(){
        $data= $this->input->post();
        $x= $this->admin_model->add_route($data);
        print_r($x);

    }
    function update_route(){
        $data= $this->input->post();
        $x= $this->admin_model->update_route($data);
        print_r($x);

    }
        function manage_route($id)    {
        $data['driver']=$this->admin_model->all_active_driver();
        $data['helper']=$this->admin_model->all_active_helper();
        $data['vehicle']=  $x= $this->admin_model->all_active_vehicle();
        $data['route']=$this->admin_model->route_by_id($id);
        $data['history']=$this->admin_model->all_route_history_by_id($id);
        $this->load->view('admin/route/manage_route',$data);
    }
    function manage_route_students($id) {
        $data['route_id']=$id;
        $data['students']=$this->admin_model->list_all_student_by_route_id($id);
        $this->load->view('admin/route/manage_route_students',$data);
    }
    function manage_route_students_all($id) {
        $data['route_id']=$id;
        $data['students']=$this->admin_model->list_all_student_by_route_id($id);
        $this->load->view('admin/route/manage_route_students_all',$data);
    }
    function update_route_histry(){
        $data= $this->input->post();
        $x= $this->admin_model->update_route_histry($data);
        print_r($x);
    }
    function send_sms_individual(){
        $data= $this->input->post();
        $x=$this->admin_model->list_all_student_by_route_id($data['route_id']);
        print_r($x);
    }
function send_all_student_route_sms(){
    $data= $this->input->post();
    print_r($data);
}
    /*==================================================================*/
    /*                     ROUTE   LOCATION                             */
    /*==================================================================*/
    function route_location($id)
    {
        $data['route']=$this->admin_model->route_by_id($id);
        $data['route_location']=$this->admin_model->all_route_location($id);
        $this->load->view('admin/route/route_location',$data);
    }
    function edit_route_location($id)
    {
        $data['route_location']=$this->admin_model->route_location_by_id($id);
        $this->load->view('admin/route/edit_route_location',$data);
    }
    function add_route_location(){
        $data= $this->input->post();
        $x= $this->admin_model->add_route_location($data);
        print_r($x);

    }
    function update_route_location(){
        $data= $this->input->post();
        $x= $this->admin_model->update_route_location($data);
        print_r($x);

    }
    /*==================================================================*/
    /*                               SETTING                            */
    /*==================================================================*/
    function setting(){
        $data= $this->input->post();
        $data['setting']=$this->admin_model->get_setting();
        $this->load->view('admin/setting',$data);

    }

    function update_setting(){
        $this->load->library('image_lib');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $data= $this->input->post();
        $this->load->library('upload', $config);
        $x= $this->upload->do_upload('logo');
        $logo = $this->upload->data();
        if($x) {
            $data['logo'] = $logo['file_name'];
        }
        $y = $this->upload->do_upload('background');
        $bg = $this->upload->data();
        if($y) {
            $data['background'] = $bg['file_name'];
        }
         $z= $this->admin_model->update_setting($data);
        print_r($z);


    }
    /*==================================================================*/
    /*                       Admin Teacher  chat                        */
    /*==================================================================*/
    function admin_teacher_chat($id=""){
        $data['id']=$id;

        $data['all_teacher']=$this->admin_model->all_teacher_name();
        $this->load->view('admin/chat/admin-teacher/admin_teacher_chat',$data);
    }
    function admin_teacher_chat_data($id="",$name="",$img="",$limit="",$offset=""){
        $data['id']=$id;
        $data['name']=str_replace('_', ' ', $name);
        $data['img']=$img;
        $data['limit']=$limit;
        $data['offset']=$offset;
        if($id) {
            $data['chat'] = $this->admin_model->list_admin_teacher_chat($id,$limit,$offset);
            $data['chat_count'] = $this->admin_model->count_admin_teacher_chat($id);
        }
        $data['all_teacher']=$this->admin_model->all_teacher_name();
        $this->load->view('admin/chat/admin-teacher/admin_teacher_chat_data',$data);
    }
    function admin_teacher_chat_add(){
        $data=$this->input->post();
        if($data['message']) {
            $this->admin_model->admin_teacher_chat_add($data);

        }
    }
    function admin_teacher_chat_add_bacup(){
        $data=$this->input->post();
        if($data['message']) {
            $this->admin_model->admin_teacher_chat_add($data);
            $x= $this->admin_model->list_admin_last_chat($data['to_id']);
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
        $chat_count = $this->admin_model->count_admin_teacher_chat($data['id']);
        if($chat_count > $data['chat_count']) {
            $x= $this->admin_model->list_teacher_last_chat($data['id']);
            echo '<div class="d-flex justify-content-start mb-4">';
            echo '<div class="msg_cotainer">';
            echo '<span class="wid">'. $x->message.'</span> <br>';
            echo '<span class="msg_time">'. $x->time.' ,'. $x->date. '</span>';
            echo '</div>';
            echo '</div>';
        }
    }
    function teacher_admin_chat_append_all(){
        $id=$this->input->post('id');
        $limit=$this->input->post('limit');
        $chat = $this->admin_model->list_admin_teacher_chat($id,$limit,0);
        foreach ($chat as $row) {
            if ($row['from_id'] == $id) {

                echo'<div class="d-flex justify-content-start mb-4">';
                echo'<div class="msg_cotainer">';
                echo'<span class="wid">'.$row['message'].'</span> <br>';
                echo'<span class="msg_time">'.$row['time'] . ' , ' . $row['date'].'</span>';
                echo'</div>';
                echo'</div>';
            } else {
                echo'<div class="d-flex justify-content-end mb-4">';
                echo'<div class="msg_cotainer_send">';
                echo'<span class="wid">'. $row['message']. '</span> <br>';
                echo'<span class="msg_time"> '. $row['time'] . ' , '. $row['date'].' </span>';
                echo'</div>';
                echo'</div>';
            }
        }
	}

    /*==================================================================*/
    /*                                EXPANSE                           */
    /*==================================================================*/
    function expanse(){
        $data['subject_list']=$this->admin_model->list_expanse();
        $this->load->view('admin/expanse/expanse',$data);
    }
    function edit_expanse($id){
        $data['expanse']=$this->admin_model->list_expanse_by_id($id);
        $this->load->view('admin/expanse/edit_expanse',$data);
    }
    function add_expanse(){
        $data=$this->input->post();
        $x=$this->admin_model->add_expanse($data);
        print_r($x);
    }
    function update_expanse(){
        $data=$this->input->post();
        $x=$this->admin_model->update_expanse($data);
        print_r($x);
    }
    function manage_expanse(){
        $data['expanse']=$this->admin_model->list_expanse();
        $this->load->view('admin/expanse/manage_expanse',$data);
    }
    function all_expanse(){
        $data['all_expanse']=$this->admin_model->list_expanse_detail();
        $this->load->view('admin/expanse/all_expanse',$data);
    }
    function day_expanse($d=""){
        if(!$d){$d=  date('Y-m-d');}
        $data['day']=$d;
        $data['all_expanse']=$this->admin_model->list_expanse_detail_by_day($d);
        $this->load->view('admin/expanse/day_expanse',$data);
    }
    function month_expanse($d=""){
        if(!$d){$d=  date('m');}
        $data['month']=$d;
        $data['all_expanse']=$this->admin_model->list_expanse_detail_by_month($d);
        $this->load->view('admin/expanse/month_expanse',$data);
    }
    function add_expanse_detail(){
        $data=$this->input->post();
        $x=$this->admin_model->add_expanse_detail($data);
        print_r($x);
    }
    function edit_expanse_detail($id){
        $data['expanse']=$this->admin_model->list_expanse();
        $data['exp']=$this->admin_model->list_expanse_detail_by_id($id);
        $this->load->view('admin/expanse/edit_expanse_detail',$data);
    }
    function update_expanse_detail(){
        $data=$this->input->post();
        $x=$this->admin_model->add_expanse_detail($data);
        print_r($x);
    }
}
