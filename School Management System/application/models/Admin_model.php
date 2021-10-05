<?php

if (!defined('BASEPATH'))
    exit('Ohhh... This is Cheating you are not suppose to do this.Cheater :)');

class Admin_model extends CI_Model
{
   /*============================change session=================================*/
    function __construct()
    {
        parent::__construct();
        $database=$_SESSION['dynamic_db'];
        $this->load->database($database);
    }
    function validate_login(){
        $data= array('designation' =>'admin' );
        $x= $this->db->get_where("employee",$data)->row_array();
        return $x;
    }
    function get_setting_new(){
        $x= $this->db->get("setting")->row_array();
        return $x;
    }
    /*============================end change session============================*/
    /*==================================================================*/
    /*                           DASHBOARD ICON                        */
    /*==================================================================*/
        public function all_student_count()
    {
        return $this->db->get('student')->num_rows();
    }

            public function all_guardian_count()
    {
        return $this->db->get('guardian')->num_rows();
    }
               public function all_teacher_count()
    {
        return $this->db->get('teacher')->num_rows();
    }
                   public function all_employee_count()
    {
        return $this->db->get('employee')->num_rows();
    }

            public function all_section_count()
    {
        return $this->db->get('section')->num_rows();
    }

         public function all_exam_count()
    {
        return $this->db->get('exam')->num_rows();
    }
             public function all_book_count()
    {
        return $this->db->get('library_book')->num_rows();
    }
    public function all_book_issue_count()
    {
        $data = array('status' => 0);
        return $this->db->get_where('library_book',$data)->num_rows();
    }
                 public function all_vehicle_count()
    {
        return $this->db->get('vehicle')->num_rows();
    }
    public function all_driver_count()
    {
        return $this->db->get('driver')->num_rows();
    }
    /*------------------------------------------*/
    public function all_event_count()
    {
        return $this->db->get('events')->num_rows();
    }
    public function all_class_g_count()
    {
        return $this->db->get('class_gallery')->num_rows();
    }
    public function all_school_g_count()
    {
        return $this->db->get('school_gallery')->num_rows();
    }
    public function all_video_count()
    {
        return $this->db->get('school_v_gallery')->num_rows();
    }
    public function all_route_count()
    {
        return $this->db->get('route')->num_rows();
    }

    public function employee_p_count()
    {
        $data = array('date' => date('Y-m-d'),'attendance'=>1);
        return $this->db->get_where('employee_attendance',$data)->num_rows();
    }
    public function employee_a_count()
    {
        $data = array('date' => date('Y-m-d'),'attendance'=>3);
        return $this->db->get_where('employee_attendance',$data)->num_rows();
    }
    public function employee_l_count()
    {
        $data = array('date' => date('Y-m-d'),'attendance'=>2);
        return $this->db->get_where('employee_attendance',$data)->num_rows();
    }
    function lesson_plan_count(){
        $data=array();
        $work_data = $this->db->get_where('lesson_plan',$data)->num_rows();
        return $work_data;
    }
    function lesson_plan_p_count(){
        $data=array('approve_status'=>0);
        $work_data = $this->db->get_where('lesson_plan',$data)->num_rows();
        return $work_data;
    }
    function lesson_plan_a_count(){
        $data=array('approve_status'=>1);
        $work_data = $this->db->get_where('lesson_plan',$data)->num_rows();
        return $work_data;
    }
    function expanse_this_month(){
        $data=array('running_year'=>$_SESSION['running_year'],'month'=>date('m'));
        $this->db->select_sum('amt');
        $x = $this->db->get_where('expanse_detail', $data)->row_array();
        return $x['amt'];
    }
    function expanse_this_year(){
        $data=array('running_year'=>$_SESSION['running_year']);
        $this->db->select_sum('amt');
        $x = $this->db->get_where('expanse_detail', $data)->row_array();
        return $x['amt'];
    }
    function expanse_today(){
        $data=array('running_year'=>$_SESSION['running_year'],'date'=>date('Y-m-d'));
        $this->db->select_sum('amt');
        $x = $this->db->get_where('expanse_detail', $data)->row_array();
        return $x['amt'];
    }
    function fee_coll_this_month(){
        $data=array('running_year'=>$_SESSION['running_year'],'month_no'=>date('m'));
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    function fee_coll_this_session(){
        $data=array('running_year'=>$_SESSION['running_year']);
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    function fee_coll_this_today(){
        $data=array('running_year'=>$_SESSION['running_year'],'date'=>date('Y-m-d'));
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    /*-------------------------*/
    function fee_coll_this_month_by_section($sec_id){
        $data=array('running_year'=>$_SESSION['running_year'],'section_id' => $sec_id);
        $this->db->like('date',date('Y-m'));
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    function fee_coll_this_session_by_section($sec_id){
        $data=array('section_id' => $sec_id,'running_year'=>$_SESSION['running_year']);
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    function fee_coll_this_today_by_section($sec_id){
        $data=array('section_id' => $sec_id,'running_year'=>$_SESSION['running_year'],'date'=>date('Y-m-d'));
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    /*-------------------------*/
    function fee_coll_this_month_by_student($sec_id,$stu_id){
        $data=array('student_id' => $stu_id,'running_year'=>$_SESSION['running_year'],'section_id' => $sec_id);
        $this->db->like('date',date('Y-m'));
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    function fee_coll_this_session_by_student($sec_id,$stu_id){
        $data=array('student_id' => $stu_id,'section_id' => $sec_id,'running_year'=>$_SESSION['running_year']);
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    function fee_coll_this_today_by_student($sec_id,$stu_id){
        $data=array('student_id' => $stu_id,'section_id' => $sec_id,'running_year'=>$_SESSION['running_year'],'date'=>date('Y-m-d'));
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
    /*==================================================================*/
    /*                              OTHER                               */
    /*==================================================================*/
    public function list_nationality()
    {
        return $this->db->get('nationality')->result_array();
    }
    /*==================================================================*/
    /*                              PROFILE                             */
    /*==================================================================*/
    function update_profile_image($id, $image)
    {
        $data = array('profile_image' => $image);
        $this->db->where('user_id', $id);
        $x = $this->db->update('users', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function profile($id)
    {
        $data = array('user_id' => $id);
        $x = $this->db->get_where('users', $data)->row_array();
        return $x;
    }
    /*==================================================================*/
    /*                             GUARDIAN                             */
    /*==================================================================*/
    function chk_guardian_email_exist($data){
        return $this->db->get_where('guardian', $data)->num_rows();
    }
        function add_guardian_csv($data)
    {
		$this->db->insert_batch('guardian', $data);
		$data= array('guardian_image'=>'gurd.jpg','	created_at'=>date('Y-m-d'),'day'=>date('d'),'year'=>date('Y'),'month'=>date('m'),'status'=>1);
		$this->db->update('guardian', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function add_guardian($data)
    {
         $data['password'] = md5($data['password']);
         $data['created_at'] = date('Y-m-d');
        $data['day'] = date('d');
        $data['year'] = date('Y');
        $data['month'] = date('m');
        $this->db->insert('guardian', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_all_guardian()
    {
        return $this->db->get('guardian')->result_array();
    }

    public function list_all_guardian_name()
    {
        $this->db->select('guardian_id');
        $this->db->select('guardian_name');
        $this->db->select('guardian_image');
        $this->db->select('online');
        $this->db->select('last_update');
        return $this->db->get('guardian')->result_array();
    }

    public function list_guardian_by_id($id)
    {
        $data = array('guardian_id' => $id);
        return $this->db->get_where('guardian', $data)->row_array();
    }

    function update_guardian($data)
    {
        if(strlen($data['password']) < 20) {
            $data['password'] = md5($data['password']);
        }
        $this->db->where('guardian_id', $data['guardian_id']);
        unset($data['guardian_id']);
        $this->db->update('guardian', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                             EMPLOYEE                             */
    /*==================================================================*/
    function chk_employee_login_exist($data){
        return $this->db->get_where('employee', $data)->num_rows();
    }
    function add_employee($data)
    {
        $data['password'] = md5($data['password']);
        $this->db->insert('employee', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_all_employee()
    {
        return $this->db->get('employee')->result_array();
    }

    public function list_all_employee_name()
    {
        $this->db->select('employee_id');
        $this->db->select('name');
        $this->db->where('designation !=', 'admin');
        return $this->db->get('employee')->result_array();
    }

    public function list_all_employee_by_des($des)
    {
        $data = array('designation' => $des);
        return $this->db->get_where('employee', $data)->result_array();
    }

    public function list_all_employee_teacher_not_used()
    {
        $data = array('designation' => "teacher", 'used' => 0);
        $this->db->select("employee_id,name");
        return $this->db->get_where('employee', $data)->result_array();
    }

    public function list_all_employee_teacher()
    {
        $data = array('designation' => "teacher");
        $this->db->select("employee_id,name");
        return $this->db->get_where('employee', $data)->result_array();
    }

    function list_designation()
    {
        $this->db->distinct();
        $this->db->select('designation');
        return $this->db->get('employee')->result_array();
    }

    public function list_employee_by_id($id)
    {
        $data = array('employee_id' => $id);
        return $this->db->get_where('employee', $data)->row_array();
    }
    public function list_employee_by_id_for_chat($id)
    {
        $data = array('employee_id' => $id);
        $this->db->select('employee_id');
        $this->db->select('name');
        $this->db->select('online');
        $this->db->select('employee_image');
        return $this->db->get_where('employee', $data)->row_array();
    }

    function update_employee($data)
    {    if(strlen($data['password']) < 20) {
        $data['password'] = md5($data['password']);
             }
        $this->db->where('employee_id', $data['employee_id']);
        unset($data['employee_id']);
        $this->db->update('employee', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function change_employee_status($data)
    {
        $this->db->where('employee_id', $data['id']);
        unset($data['id']);
        $this->db->update('employee', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function list_all_emp_designation()
    {
        return $this->db->get('emp_designation')->result_array();
    }

    function employee_name_mobile_sms($id)
    {
        $data = array('employee_id' => $id);
        $this->db->select('name');
        $this->db->select('contact_no');
        $x = $this->db->get_where('employee', $data)->row_array();
        return $x;
    }
    /*==================================================================*/
    /*                      EMPLOYEE  QUALIFICATION                     */
    /*==================================================================*/
    function add_emp_qualification($data)
    {
        $this->db->insert('emp_qualification', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_emp_qualification_by_employee_id($id)
    {
        $data = array('employee_id' => $id);
        return $this->db->get_where('emp_qualification', $data)->result_array();
    }

    public function list_emp_qualification_by_qualification_id($id)
    {
        $data = array('qualification_id' => $id);
        return $this->db->get_where('emp_qualification', $data)->row_array();
    }

    function update_qualification($data)
    {
        $this->db->where('qualification_id', $data['qualification_id']);
        unset($data['qualification_id']);
        $this->db->update('emp_qualification', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_qualification($data)
    {
        $this->db->where('qualification_id', $data);
        $this->db->delete('emp_qualification');
    }
    /*==================================================================*/
    /*                      EMPLOYEE  EXPERIENCE                     */
    /*==================================================================*/
    function add_emp_experience($data)
    {
        $this->db->insert('emp_experience', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_emp_experience_by_employee_id($id)
    {
        $data = array('employee_id' => $id);
        return $this->db->get_where('emp_experience', $data)->result_array();
    }

    public function list_emp_experience_by_experience_id($id)
    {
        $data = array('experience_id' => $id);
        return $this->db->get_where('emp_experience', $data)->row_array();
    }

    function update_experience($data)
    {
        $this->db->where('experience_id', $data['experience_id']);
        unset($data['experience_id']);
        $this->db->update('emp_experience', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_experience($data)
    {
        $this->db->where('experience_id', $data);
        $this->db->delete('emp_experience');
    }
    /*==================================================================*/
    /*                             ENROLL                              */
    /*==================================================================*/
    function add_enroll($data)
    {
        $data['running_year'] = $_SESSION['running_year'];
        $data['date'] = date('Y-m-d');
        $data['day'] = date('d');
        $data['year'] = date('Y');
        $data['month'] = date('m');
        /*----------------*/
        $x = $this->admin_model->list_section_subject_by_id($data['section_id']);
        $y = json_encode($x);
        /*----------------*/
        $data['subjects'] = $y;
        $this->db->insert('enroll', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_enroll($data)
    {
        $this->db->where('student_id', $data['student_id']);
        unset($data['student_id']);
        $this->db->update('enroll', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_enroll_by_student_id($id)
    {
        $data = array('student_id' => $id, 'running_year' => $_SESSION['running_year']);
        return $this->db->get_where('enroll', $data)->row_array();
    }

    function student_subject($id)
    {
        $data = array('student_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->select('subjects');
        $x = $this->db->get_where('enroll', $data)->row_array();
        return $x['subjects'];
    }

    function list_student_by_class_section_id($c_id, $s_id)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'running_year' => $_SESSION['running_year']);
        return $this->db->get_where('enroll', $data)->result_array();
    }
    /*==================================================================*/
    /*                    STUDENT ATTENDANCE                            */
    /*==================================================================*/
	/*==================================================== Dashboard Attendnce =====================================================================*/
	function  get_attendance_p_for_dashboard1($c_id){
        $data = array('class_id' => $c_id,'attendance' => 1, 'date' =>date('Y-m-d') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_p_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 1, 'date' =>date('Y-m-d') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_l_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 2, 'date' =>date('Y-m-d') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_a_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 3, 'date' =>date('Y-m-d') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_pm_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 1, 'month' =>date('m') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_lm_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 2, 'month' =>date('m') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_am_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 3, 'month' =>date('m') , 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_ps_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 1, 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_ls_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 2, 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function  get_attendance_as_for_dashboard($c_id,$s_id){
        $data = array('class_id' => $c_id, 'section_id' => $s_id,'attendance' => 3,  'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function fee_rate_section($sec_id){
        $data=array('section_id'=>$sec_id);
        $this->db->select_sum('amount');
        $x = $this->db->get_where('fee_section', $data)->row_array();
        return $x['amount'];
    }
    function fee_coll_section($sec_id){
        $data=array('section_id'=>$sec_id);
        $this->db->select_sum('payable');
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x['payable'];
    }
/*==========================================================================================*/
    function get_data_from_enroll($c_id, $s_id)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('enroll', $data)->result_array();
        return $x;
    }

    function insert_attendance($st_id, $c_id, $s_id, $d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $data = array('student_id' => $st_id, 'class_id' => $c_id, 'section_id' => $s_id, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'], 'date' => $d);
        $table = 'class_id_' . $c_id . '_attendance';
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function chk_before_insert_attendance($c_id, $s_id, $d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->num_rows();
        return $x;
    }

    function get_attendance($c_id, $s_id, $d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'],);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->result_array();
        return $x;
    }

    function get_attendance_individual($c_id, $s_id, $stu, $day, $month, $year)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'student_id' => $stu, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'],);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->row_array();
        return $x['attendance'];
    }

    function get_attendance_individual_marksheet($c_id, $s_id, $stu)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'student_id' => $stu, 'running_year' => $_SESSION['running_year'],);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->result_array();
        return $x;
    }

    function get_assessment_individual($c_id, $s_id, $stu, $day, $month, $year)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'student_id' => $stu, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'],);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->row_array();
        return $x;
    }

    function get_attendance_report_year($c_id, $s_id, $month)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'month' => $month, 'running_year' => $_SESSION['running_year']);
        $table = 'class_id_' . $c_id . '_attendance';
        $this->db->select('year');
        $x = $this->db->get_where($table, $data)->row_array();
        return $x['year'];
    }

    function get_attendance_for_sms($c_id, $s_id, $d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $this->db->select('student_id');
        $this->db->select('attendance');
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'],);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->result_array();
        return $x;
    }

    function update_attendance($id, $c_id, $data)
    {
        $this->db->where('id', $id);
        $table = 'class_id_' . $c_id . '_attendance';
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                    EMPLOYEE ATTENDANCE                           */
    /*==================================================================*/
    function get_emp_attendance_report_year($month)
    {
        $data = array('month' => $month, 'running_year' => $_SESSION['running_year']);
        $this->db->select('year');
        $x = $this->db->get_where("employee_attendance", $data)->row_array();
        return $x['year'];
    }

    function get_emp_attendance_individual($employee_id, $day, $month, $year)
    {
        $data = array('employee_id' => $employee_id, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where("employee_attendance", $data)->row_array();
        return $x['attendance'];
    }

    function chk_before_insert_emp_attendance($d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $data = array('day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where("employee_attendance", $data)->num_rows();
        return $x;
    }

    function get_data_from_employee()
    {
        $data = array('ststus' == 1);
        $x = $this->db->get_where('employee', $data)->result_array();
        return $x;
    }

    function insert_emp_attendance($emp_id, $d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $data = array('employee_id' => $emp_id, 'day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'], 'date' => $d);
        $this->db->insert("employee_attendance", $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_emp_attendance($d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $data = array('day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where("employee_attendance", $data)->result_array();
        return $x;
    }

    function update_emp_attendance($id, $val)
    {
        $this->db->where('id', $id);
        $data = array('attendance' => $val);
        $this->db->update("employee_attendance", $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_attendance_for_emp_sms($d)
    {
        $y = explode("-", $d);
        $year = $y[0];
        $month = $y[1];
        $day = $y[2];
        $this->db->select('employee_id');
        $this->db->select('attendance');
        $data = array('day' => $day, 'month' => $month, 'year' => $year, 'running_year' => $_SESSION['running_year'],);
        $x = $this->db->get_where("employee_attendance", $data)->result_array();
        return $x;
    }

    function employee_name($id)
    {
        $data = array('employee_id' => $id);
        $this->db->select('name');
        $x = $this->db->get_where('employee', $data)->row_array();
        return $x['name'];
    }
    /*==================================================================*/
    /*                             STUDENT                              */
	/*==================================================================*/
	function last_id(){
	
   return $this->db->get('student')->last_row()->student_id;
	}
        function add_student_csv($data)
    {   
		$last_id = $this->admin_model->last_id();
		$this->db->insert_batch('student', $data);

		$data= array('student_image'=>'stu.jpg','birth_certificate'=>'certificate.jpg','leaving_certificate'=>'certificate.jpg','character_certificate'=>'certificate.jpg','medical_certificate'=>'certificate.jpg','sc_st_certificate'=>'certificate.jpg','status'=>1);
		$this->db->update('student', $data);

		if(!$last_id){$last_id=0;}
        $data1 = array('student_id >' =>$last_id);
        $this->db->select('student_id');
        $this->db->select('class');
        $this->db->select('section');
        $all_stu = $this->db->get_where('student', $data1)->result_array();
        foreach($all_stu as $row){
            $data2['student_id'] =  $row['student_id'];
            $data2['class_id'] =  $row['class'];
            $data2['section_id'] =  $row['section'];
            $this->admin_model->add_enroll($data2);
		}		
		return  $all_stu;
		
    }

    function add_student($data)
    {
        $data2 = array('class_id' => $data['class'], 'section_id' => $data['section'], 'roll_no' => $data['roll_no']);
        /*  unset($data['section']);*/
        unset($data['roll_no']);
        $this->db->insert('student', $data);
        $data2['student_id'] = $this->db->insert_id();
        $this->admin_model->add_enroll($data2);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete_student($student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->delete('student');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete_enroll($student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->delete('enroll');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function update_student($data)
    {
        $this->db->where('student_id', $data['student_id']);
        $data2 = array('student_id' => $data['student_id'], 'roll_no' => $data['roll_no'], 'class_id' => $data['class'], 'section_id' => $data['section']);
        unset($data['student_id']);
        /*  unset($data['section']);*/
        unset($data['roll_no']);
        $this->db->update('student', $data);
        $x = $this->admin_model->update_enroll($data2);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function update_student_transport($data)
    {
        $this->db->where('student_id', $data['student_id']);
        unset($data['student_id']);
        $this->db->update('student', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
    public function list_last_10_student()
    {

        $this->db->select('student_id');
        $this->db->select('student_name');
        $this->db->select('class');
        $this->db->select('section');
        $this->db->select('admission_no');
        $this->db->select('guardian');

        $this->db->order_by('student_id', 'DESC');
        $this->db->limit('5');
        $x = $this->db->get('student')->result_array();
        $temp = 0;
        foreach ($x as $z) {
            $y = $this->admin_model->list_enroll_by_student_id($x[$temp]['student_id']);
            $x[$temp]['class'] = $y['class_id'];
            $x[$temp]['section'] = $y['section_id'];
            $x[$temp]['roll_no'] = $y['roll_no'];
            $temp++;
        }

        return $x;
    }

    public function list_all_student_by_route_id($id)
    {
        $data = array('route_id' => $id);
        $x = $this->db->get_where('student', $data)->result_array();
        return $x;
    }
    public function list_all_student()
    {
        $x = $this->db->get('student')->result_array();
        $temp = 0;
        foreach ($x as $z) {
            $y = $this->admin_model->list_enroll_by_student_id($x[$temp]['student_id']);
            $x[$temp]['class'] = $y['class_id'];
            $x[$temp]['section'] = $y['section_id'];
            $x[$temp]['roll_no'] = $y['roll_no'];
            $temp++;
        }

        return $x;
    }

    public function list_all_student_by_class($class)
    {
        $data = array('class' => $class);
        $x = $this->db->get_where('student', $data)->result_array();
        $temp = 0;
        foreach ($x as $z) {
            $y = $this->admin_model->list_enroll_by_student_id($x[$temp]['student_id']);
            $x[$temp]['class'] = $y['class_id'];
            $x[$temp]['section'] = $y['section_id'];
            $x[$temp]['roll_no'] = $y['roll_no'];
            $temp++;
        }

        return $x;
    }

    public function list_student_by_id($id)
    {
        $data = array('student_id' => $id);
        $x = $this->db->get_where('student', $data)->row_array();
        $y = $this->admin_model->list_enroll_by_student_id($id);
        $x['class'] = $y['class_id'];
        $x['section'] = $y['section_id'];
        $x['roll_no'] = $y['roll_no'];
        return $x;
    }

    function student_name($id)
    {
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $x = $this->db->get_where('student', $data)->row_array();
        return $x['student_name'];
    }

    function all_student_by_section_id($id)
    {
        $data = array('section' => $id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $x = $this->db->get_where('student', $data)->result_array();
        return $x;
    }
    function all_student_detail_by_section_id($id)
    {
        $data = array('section' => $id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $this->db->select('class');
        $this->db->select('section');
        $x = $this->db->get_where('student', $data)->result_array();
        return $x;
    }
    function all_student_by_student_id($id)
    {
        $data = array('student_id' => $id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $x = $this->db->get_where('student', $data)->result_array();
        return $x;
    }

    function student_name_mobile_sms($id)
    {
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $this->db->select('mobile_no_for_sms');
        $x = $this->db->get_where('student', $data)->row_array();
        return $x;
    }

    function update_student_certificate($data)
    {
        $this->db->where('student_id', $data['id']);
        unset($data['id']);
        $this->db->update('student', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function change_student_status($data)
    {
        $this->db->where('student_id', $data['id']);
        unset($data['id']);
        $this->db->update('student', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*==================================================================*/
    /*                      SECTION   SUBJECTS                          */
    /*==================================================================*/
    function add_section_subject($data)
    {
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('section_subject', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_section_subject($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('section_subject', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_section_subject_by_section_id($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('section_subject', $data)->result_array();
        return $x;
    }

    function list_active_section_subject_by_section_id($id)
    {
        $data = array('section_id' => $id, 'status' => 1, 'running_year' => $_SESSION['running_year']);
        $this->db->select('subject_id');
        $x = $this->db->get_where('section_subject', $data)->result_array();
        return $x;
    }

    function list_section_subject_by_id($id)
    {
        $data = array('section_id' => $id, 'status' => 1, 'running_year' => $_SESSION['running_year']);
        $this->db->select('subject_id');
        $this->db->select('type');
        $x = $this->db->get_where('section_subject', $data)->result_array();
        return $x;
    }

    function delete_section_subject($id)
    {
        $data = array('id' => $id);
        $x = $this->db->delete('section_subject', $data);
        return $x;
    }

    /*==================================================================*/
    /*                               CLASS                              */
    /*==================================================================*/
    function add_class($data)
    {
        $this->db->insert('class', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_class($data)
    {
        $this->db->where('class_id', $data['class_id']);
        unset($data['class_id']);
        $this->db->update('class', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function class_by_id($id)
    {
        $data = array('class_id' => $id);
        return $this->db->get_where('class', $data)->row_array();
    }

    function class_teacher_by_section_id($id)
    {
        $data = array('section_id' => $id);
        $this->db->select('teacher_id');
        $x = $this->db->get_where('section', $data)->row_array();
        $y = $this->admin_model->teacher_name($x['teacher_id']);
        return $y;
    }

    public function list_all_class()
    {
        return $this->db->get('class')->result_array();
    }

    public function list_all_active_class()
    {
        $data = array('status' => 1);
        return $this->db->get_where('class', $data)->result_array();
    }


    /*==================================================================*/
    /*                             SECTION                              */
    /*==================================================================*/
    function add_section($data)
    {
        $this->db->insert('section', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_section($data)
    {
        $this->db->where('section_id', $data['section_id']);
        unset($data['section_id']);
        $this->db->update('section', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_all_section()
    {
        return $this->db->get('section')->result_array();
    }

    public function list_all_active_section()
    {
        $data = array('status' => 1);
        $this->db->order_by('class_id','asc') ;
        return $this->db->get_where('section', $data)->result_array();
    }

    public function list_all_active_section_id()
    {
        $this->db->select(array('section_id'));
        $data = array('status' => 1);
        $x = $this->db->get_where('section', $data)->result_array();
        $y = array();
        foreach ($x as $row) {
            $y[] = $row['section_id'];
        }
        return json_encode($y);
    }

    function section_by_id($id)
    {
        $data = array('section_id' => $id);
        return $this->db->get_where('section', $data)->row_array();
    }

    public function list_section_by_class_id($id)
    {
        $data = array('class_id' => $id, 'status' => 1);
        $this->db->select(array('section_id', 'name'));
        return $this->db->get_where('section', $data)->result_array();
    }

    public function list_all_section_by_class_id($id)
    {
        $data = array('class_id' => $id);
        $this->db->select(array('section_id', 'name'));
        return $this->db->get_where('section', $data)->result_array();
    }
    /*==================================================================*/
    /*                            TEACHER                               */
    /*==================================================================*/
    public function list_all_teacher()
    {
        return $this->db->get('teacher')->result_array();
    }

    public function list_all_teacher_type()
    {
        return $this->db->get('teacher_type')->result_array();
    }

    public function teacher_type_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('teacher_type', $data)->row_array();
        return $x;
    }

    public function teacher_by_id($id)
    {
        $data = array('teacher_id' => $id);
        $x = $this->db->get_where('teacher', $data)->row_array();
        return $x;
    }

    function teacher_name($id)
    {
        $data = array('teacher_id' => $id);
        $x = $this->db->get_where('teacher', $data)->row_array();
        $y = $this->admin_model->employee_name($x['employee_id']);
        return $y;
    }
    function all_teacher_name()
    {
        $x = $this->db->get('teacher')->result_array();
        $y=array(); $i=0;
        foreach ($x as $row){
            $y[$i]= $this->admin_model->list_employee_by_id_for_chat($row['employee_id']);
            $i++;
        }

        return $y;
    }

    public function teacher_by_employee_id($id)
    {
        $data = array('employee_id' => $id);
        $x = $this->db->get_where('teacher', $data)->row_array();
        return $x;
    }

    function add_teacher($data)
    {
        $this->db->where('employee_id', $data['employee_id']);
        $data2 = array('used' => 1);
        $this->db->update('employee', $data2);
        $this->db->insert('teacher', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_teacher($data)
    {
        $this->db->where('teacher_id', $data['teacher_id']);
        unset($data['teacher_id']);
        $this->db->update('teacher', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*==================================================================*/
    /*                      SECTION PERIOD                              */
    /*==================================================================*/
    function add_period($data)
    {
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('period_allotment', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_period($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('period_allotment', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_all_period()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        return $this->db->get_where('period_allotment', $data)->result_array();
    }

    public function list_period_by_class($id)
    {
        $data = array('class_id' => $id, 'running_year' => $_SESSION['running_year']);
        return $this->db->get_where('period_allotment', $data)->result_array();
    }

    public function list_period_by_section($c_id, $s_id)
    {
        $data = array('class_id' => $c_id, 'section_id' => $s_id, 'running_year' => $_SESSION['running_year']);
        return $this->db->get_where('period_allotment', $data)->result_array();
    }

    public function list_period_by_teacher($t_id)
    {
        $data = array('teacher_id' => $t_id, 'status' => 1, 'running_year' => $_SESSION['running_year']);
        return $this->db->get_where('period_allotment', $data)->result_array();
    }

    public function list_period_allotment_by_id($id)
    {
        $data = array('id' => $id, 'running_year' => $_SESSION['running_year']);
        return $this->db->get_where('period_allotment', $data)->row_array();
    }

    function change_period_status($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('period_allotment', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_period()
    {
        return $this->db->get('period_list')->result_array();
    }

    public function list_period_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('period_list', $data)->row_array();
    }
    /*==================================================================*/
    /*                           CLASS WORK                             */
    /*==================================================================*/
    function class_work()
    {
        $data = array('status' => 1);
        $work_data = $this->db->get_where('class_work', $data)->result_array();
        return $work_data;
    }

    function add_class_work($data)
    {
        $data['date'] = date('Y-m-d');
         $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('class_work', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                           HOME WORK                             */
    /*==================================================================*/
    function home_work()
    {
        $data = array('status' => 1);
        $work_data = $this->db->get_where('home_work', $data)->result_array();
        return $work_data;
    }

    function add_home_work($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('home_work', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                          CLASS GALLERY                           */
    /*==================================================================*/
    function add_class_gallery($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('class_gallery', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_class_gallery($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('class_gallery', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_class_gallery()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        $gal = $this->db->get_where('class_gallery', $data)->result_array();
        return $gal;
    }

    function list_class_gallery_by_id($id)
    {
        $data = array('running_year' => $_SESSION['running_year'], 'id' => $id);
        $gal = $this->db->get_where('class_gallery', $data)->row_array();
        return $gal;
    }

    function list_class_gallery_by_teacher_id()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        $gal = $this->db->get_where('class_gallery', $data)->result_array();
        return $gal;
    }

    function list_class_gallery_by_teacher_id_active()
    {
        $data = array('running_year' => $_SESSION['running_year'], 'status' => 1);
        $gal = $this->db->get_where('class_gallery', $data)->result_array();
        return $gal;
    }

    function add_class_gallery_photo($id, $image_name)
    {
        $data = array('class_gallery_id' => $id, 'image' => $image_name);
        $this->db->insert('class_gallery_photo', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_image_by_class_gallery_id($id)
    {
        $data = array('class_gallery_id' => $id);
        $x = $this->db->get_where('class_gallery_photo', $data)->result_array();
        return $x;
    }

    function delete_class_image($id)
    {
        $data = array('id' => $id);
        $x = $this->db->delete('class_gallery_photo', $data);
        return $x;
    }
    /*==================================================================*/
    /*                             EXAM                                 */
    /*==================================================================*/
    function list_all_exam()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('exam', $data)->result_array();
        return $x;
    }

    function add_exam($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('exam', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_exam($data)
    {
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_exam_type()
    {
        $x = $this->db->get('exam_type')->result_array();
        return $x;
    }

    function list_exam_type_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('exam_type', $data)->row_array();
        return $x['name'];
    }
    /*==================================================================*/
    /*                            SUBJECTS                              */
    /*==================================================================*/
    public function list_subject_option()
    {
        return $this->db->get('subject_option')->result_array();
    }

    public function list_subjects()
    {
        $this->db->order_by('name','asc');
        return $this->db->get('subjects_list')->result_array();
    }

    public function list_subjects_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('subjects_list', $data)->row_array();
    }

    function add_subject_list($data)
    {
        $this->db->insert('subjects_list', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_subject_list($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('subjects_list', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                 EXAM ALLOWED SECTION                         */
    /*==================================================================*/
    function add_exam_allowed_section($data)
    {
        $this->db->insert('exam_allowed_section', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_exam_allowed_section($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam_allowed_section', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_all_exam_allowed_by_exam_id($id)
    {
        $data = array('exam_id' => $id);
        return $this->db->get_where('exam_allowed_section', $data)->result_array();
    }

    public function list_exam_allowed_section_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('exam_allowed_section', $data)->row_array();
    }

    public function list_exam_allowed_section_by_section_id($id)
    {
        $data = array('section_id' => $id);
        $this->db->select('exam_id');
        return $this->db->get_where('exam_allowed_section', $data)->result_array();
    }
    /*==================================================================*/
    /*                EXAM ALLOWED SECTION  SUBJECT                     */
    /*==================================================================*/
    function add_exam_allowed_section_subject($data)
    {
        $this->db->insert('exam_allowed_section_subject', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_exam_allowed_section_subject($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam_allowed_section_subject', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_all_exam_allowed_section_subject($exam_id, $class_id, $section_id)
    {
        $data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id);
        $this->db->order_by("subject_id", "asc");
        return $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
    }

    public function list_all_exam_allowed_section_subject_tabulation($exam_id, $class_id, $section_id)
    {
        $data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id);
        $this->db->select("subject_id");
        $this->db->distinct();
        return $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
    }

    public function list_all_exam_allowed_section_paper_tabulation($exam_id, $class_id, $section_id, $subject_id)
    {
        $data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id);
        $this->db->select("paper_id");
        $x = $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
        return $x;
    }

    public function list_exam_allowed_section_subject_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('exam_allowed_section_subject', $data)->row_array();
    }

    /*==================================================================*/
    /*                             EXAM GRADE                           */
    /*==================================================================*/
    function add_exam_grade($data)
    {
        $this->db->insert('exam_grade', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_exam_grade($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam_grade', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function list_exam_grade_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('exam_grade', $data)->row_array();
    }

    public function list_exam_grade()
    {
        return $this->db->get('exam_grade')->result_array();
    }

    function list_enroll_by_section_id($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->select('student_id');
        $this->db->select('subjects');
        return $this->db->get_where('enroll', $data)->result_array();
    }

    public function list_all_exam_allowed_section($class_id, $section_id)
    {
        $data = array('class_id' => $class_id, 'section_id' => $section_id);
        $x = $this->db->get_where('exam_allowed_section', $data)->result_array();
        return $x;
    }

    function get_exam_paper($data)
    {
        $data = array('exam_id' => $data['exam_id'], 'class_id' => $data['cl_id'], 'section_id' => $data['sec_id'], 'subject_id' => $data['sub_id']);
        $this->db->select('paper_id');
        return $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
    }

    function exam_by_id($id)
    {
        $data = array('running_year' => $_SESSION['running_year'], 'id' => $id);
        $x = $this->db->get_where('exam', $data)->row_array();
        return $x;
    }

    function exam_by_id_type($id)
    {
        $data = array('running_year' => $_SESSION['running_year'], 'id' => $id);
        $this->db->select('id');
        $this->db->select('type');
        $x = $this->db->get_where('exam', $data)->row_array();
        return $x;
    }

    function paper_name($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('subject_option', $data)->row_array();
        return $x['name'];
    }

    /*--------------------*/
    function find_min_max_marks($data)
    {
        unset($data['student_id']);
        unset($data['running_year']);
        $this->db->select('min');
        $this->db->select('max');
        $x = $this->db->get_where('exam_allowed_section_subject', $data)->row_array();
        return $x;
    }

    function check_row_already_inserted($data)
    {
        $x = $this->db->get_where('exam_marks', $data)->num_rows();
        return $x;
    }

    function add_exam_marks($data)
    {
        $chk = $this->teacher_model->check_row_already_inserted($data);
        $data['running_year'] = $_SESSION['running_year'];
        if ($chk == 0) {
            $xx = $this->teacher_model->find_min_max_marks($data);
            $data['max'] = $xx['max'];
            $data['min'] = $xx['min'];
            $this->db->insert('exam_marks', $data);
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function update_exam_marks($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam_marks', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function exam_mark_data($data)
    {
        $x = $this->db->get_where('exam_marks', $data)->result_array();
        return $x;
    }

    function exam_mark_data_tabulation($data)
    {
        $this->db->select('student_id');
        $this->db->select('subject_id');
        $this->db->select('paper_id');
        $this->db->select('marks');
        $x = $this->db->get_where('exam_marks', $data)->result_array();
        return $x;
    }

    function student_name_by_id($id)
    {
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $x = $this->db->get_where('student', $data)->row_array();
        return $x['student_name'];
    }

    function student_detail_by_id($id)
    {
        $data = array('student_id' => $id);
        $x = $this->db->get_where('student', $data)->row_array();
        return $x;
    }

    public function list_subject_option_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('subject_option', $data)->row_array();
    }

    function list_all_exam_by_id($id)
    {
        $data = array('running_year' => $_SESSION['running_year'], 'id' => $id);
        $x = $this->db->get_where('exam', $data)->row_array();
        return $x;
    }

    function subject_paper_mark($exam_id, $class_id, $section_id, $student_id, $subject_id, $paper_id)
    {
        $data = array(
            'exam_id' => $exam_id,
            'class_id' => $class_id,
            'section_id' => $section_id,
            'student_id' => $student_id,
            'subject_id' => $subject_id,
            'paper_id' => $paper_id,
            'running_year' => $_SESSION['running_year']
        );
        $x = $this->db->get_where('exam_marks', $data)->row_array();
        return $x;
    }

    function subject_mark_for_result($exam_id, $class_id, $section_id, $student_id, $subject_id)
    {
        $data = array(
            'exam_id' => $exam_id,
            'class_id' => $class_id,
            'section_id' => $section_id,
            'student_id' => $student_id,
            'subject_id' => $subject_id,
            'running_year' => $_SESSION['running_year']
        );
        $this->db->select('marks');
        $this->db->select('min');
        $this->db->select('max');
        $x = $this->db->get_where('exam_marks', $data)->result_array();
        return $x;
    }
    /*==================================================================*/
    /*                             LIBRARY                              */
    /*==================================================================*/
    function add_book($data)
    {
        $data['added_date'] = date('Y-m-d');
        $this->db->insert('library_book', $data);
        $insert_id = $this->db->insert_id();
        $code = $x = str_pad($insert_id, 7, "0", STR_PAD_LEFT);
        $data1 = array('id' => $insert_id, 'book_code' => "BOOK" . $code);
        $this->admin_model->update_book($data1);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function update_book($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('library_book', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_all_book()
    {
        $x = $this->db->get('library_book')->result_array();
        return $x;
    }

    public function list_all_book_by_class($class)
    {
        $data = array('class' => $class);
        $x = $this->db->get_where('library_book', $data)->result_array();
        return $x;
    }

    public function list_book_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('library_book', $data)->row_array();
        return $x;
    }

    public function list_book_by_id_for_history($id)
    {
        $data = array('id' => $id);
        $this->db->select('id');
        $this->db->select('book_code');
        $this->db->select('name');
        $this->db->select('author');
        $this->db->select('student_id');
        $this->db->select('staff_id');
        $this->db->select('date_from');
        $this->db->select('date_to');
        $this->db->select('late_fee');
        $this->db->select('max_day');
        $x = $this->db->get_where('library_book', $data)->row_array();
        return $x;
    }

    function update_relese_history($data)
    {
        $date_from = strtotime($data['date_from']);
        $date_to = $data['return_date'] = date('Y-m-d');
        $max_day = $data['max_day'];
        $diff = ($date_to - $date_from) / (60 * 60 * 24);
        $penel_day = $diff - $max_day;
        if ($diff > $max_day) {
            $data['late_fee'] = $penel_day * $data['late_fee'];
        } else {
            $data['late_fee'] = 0;
        }
        $data['book_id'] = $data['id'];
        unset($data['id']);
        unset($data['max_day']);
        $data['running_year'] = $_SESSION['running_year'];
        $data['year'] = date('Y');
        $data['month'] = date('m');
        $this->db->insert('book_issue_history', $data);
    }

    public function book_history_by_book_id($id)
    {
        $data = array('book_id' => $id, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('book_issue_history', $data)->result_array();
        return $x;
    }

    public function book_history_by_stu_id($id)
    {
        $data = array('student_id' => $id, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('book_issue_history', $data)->result_array();
        return $x;
    }

    public function book_history_by_emp_id($id)
    {
        $data = array('staff_id' => $id, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('book_issue_history', $data)->result_array();
        return $x;
    }

    public function library_late_fee_for_student($id)
    {
        $data = array('student_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->select_sum('late_fee');
        $x = $this->db->get_where('book_issue_history', $data)->row_array();
        return $x['late_fee'];
    }

    /*==================================================================*/
    /*                           NOTICE BOARD                           */
    /*==================================================================*/
    function add_noticeboard($data)
    {   $data['date'] = date('Y-m-d');
        $this->db->insert('noticeboard', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_noticeboard($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $data['date'] = date('Y-m-d');
        $this->db->update('noticeboard', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_noticeboard($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('noticeboard');
    }

    function noticeboard_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('noticeboard', $data)->row_array();
        return $x;
    }

    function all_noticeboard()
    {
        $x = $this->db->get('noticeboard')->result_array();
        return $x;
    }

    function add_event($data)
    {
        $data['running_year	'] = $_SESSION['running_year'];
        $this->db->insert('events', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_event($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('events', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_event($id)
    {
        $data = array('id' => $id);
        $x = $this->db->delete('events', $data);
        return $x;
    }

    function all_event()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        return $this->db->get_where("events",$data)->result();
    }
    function all_events()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        return $this->db->get_where("events",$data)->result_array();
    }
    function event_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where("events",$data)->row_array();
    }
    /*==================================================================*/
    /*                              TRANSPORT                           */
    /*==================================================================*/
    function add_vehicle($data)
    {
        $this->db->insert('vehicle', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_vehicle($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('vehicle', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function all_vehicle()
    {
        $x = $this->db->get('vehicle')->result_array();
        return $x;
    }

    function vehicle_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('vehicle', $data)->row_array();
        return $x;
    }
    /*==================================================================*/
    /*                           LESSON PLAN                             */
    /*==================================================================*/
    function lesson_plan()
    {
		$this->db->order_by('approve_status', 'ASC');      
        $work_data = $this->db->get('lesson_plan')->result_array();
        return $work_data;
    }

    function add_lesson_plan($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year	'] = $_SESSION['running_year'];
        $this->db->insert('lesson_plan', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_lesson_plan($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        if ($data['attachment'] == '') {
            unset($data['attachment']);
        }
        $data['date'] = date('Y-m-d');
        $this->db->update('lesson_plan', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function lesson_plan_by_id($id)
    {
        $data = array('id' => $id);
        $work_data = $this->db->get_where('lesson_plan', $data)->row_array();
        return $work_data;
    }
    /*==================================================================*/
    /*                          SCHOOL GALLERY                          */
    /*==================================================================*/
    function add_school_gallery($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('school_gallery', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_school_gallery($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('school_gallery', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_school_gallery()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        $gal = $this->db->get_where('school_gallery', $data)->result_array();
        return $gal;
    }

    function list_school_gallery_by_id($id)
    {
        $data = array('running_year' => $_SESSION['running_year'], 'id' => $id);
        $gal = $this->db->get_where('school_gallery', $data)->row_array();
        return $gal;
    }

    function list_school_gallery_by_teacher_id()
    {
        $data = array('running_year' => $_SESSION['running_year']);
        $gal = $this->db->get_where('school_gallery', $data)->result_array();
        return $gal;
    }

    function list_school_gallery_by_teacher_id_active()
    {
        $data = array('running_year' => $_SESSION['running_year'], 'status' => 1);
        $gal = $this->db->get_where('school_gallery', $data)->result_array();
        return $gal;
    }

    function add_school_gallery_photo($id, $image_name)
    {
        $data = array('class_gallery_id' => $id, 'image' => $image_name);
        $this->db->insert('school_gallery_photo', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_image_by_school_gallery_id($id)
    {
        $data = array('class_gallery_id' => $id);
        $x = $this->db->get_where('school_gallery_photo', $data)->result_array();
        return $x;
    }

    function delete_school_image($id)
    {
        $data = array('id' => $id);
        $x = $this->db->delete('school_gallery_photo', $data);
        return $x;
    }
    /*==================================================================*/
    /*                        SCHOOL VIDEOS GALLERY                     */
    /*==================================================================*/
    function all_videos_gallery()
    {
        $v = $this->db->get('school_v_gallery')->result_array();
        return $v;
    }

    function videos_gallery_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('school_v_gallery', $data)->row_array();
        return $x;
    }

    function add_videos_gallery($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('school_v_gallery', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_videos_gallery($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('school_v_gallery', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                                 FEE                              */
    /*==================================================================*/
    function fee_type()
    {
        $v = $this->db->get('fee_type')->result_array();
        return $v;
    }

    function fee_type_name($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee_type', $data)->row_array();
        return $x['name'];
    }

    function fee_type_mult($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee_type', $data)->row_array();
        return $x['mult'];
    }

    function all_fee()
    {
        $v = $this->db->get('fee')->result_array();
        return $v;
    }

    function fee_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee', $data)->row_array();
        return $x;
    }

    function fee_by_type($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee', $data)->row_array();
        return $x['type'];
    }

    function add_fee($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('fee', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_fee($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('fee', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                          FEE  SECTION                            */
    /*==================================================================*/
    function delete_section_fee($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('fee_section');
    }

    function fee_section()
    {
        $v = $this->db->get('fee_section')->result_array();
        return $v;
    }

    function fee_section_name($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee_section', $data)->row_array();
        return $x['name'];
    }

    function all_fee_section()
    {
        $v = $this->db->get('fee_section')->result_array();
        return $v;
    }

    function fee_section_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee_section', $data)->row_array();
        return $x;
    }

    function add_section_fee($data)
    {
        $t = $this->admin_model->fee_by_type($data['fee_id']);
        $data['type'] = $t['type'];
        $x = $this->admin_model->fee_type_mult($t);
        $data['total'] = $x * $data['amount'];
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('fee_section', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_section_fee($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('fee_section', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function list_section_fee_by_section_id($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('fee_section', $data)->result_array();
        return $x;
    }

    function first_month_fee($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->where_in('type', array(1,4));
        
        $x = $this->db->get_where('fee_section', $data)->result_array();
        return $x;
    }

    function middle_month_fee($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->where('type', 4);
        $x = $this->db->get_where('fee_section', $data)->result_array();
        return $x;
    }

    function fifth_month_fee($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->where('type', 4);
        $this->db->or_where('type', 2);
        $x = $this->db->get_where('fee_section', $data)->result_array();
        return $x;
    }

    function last_month_fee($id)
    {
        $data = array('section_id' => $id, 'running_year' => $_SESSION['running_year']);
        $this->db->where_in('type', array(3,4));
        $x = $this->db->get_where('fee_section', $data)->result_array();
        return $x;
    }

    function add_student_fee($data)
    {
        $data['date'] = date('Y-m-d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('student_fee', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_student_fee_of_month($s_id, $st_id, $month)
    {
        $data = array('section_id' => $s_id, 'student_id' => $st_id, 'month_no' => $month, 'running_year' => $_SESSION['running_year']);
        $x = $this->db->get_where('student_fee', $data)->row_array();
        return $x;
    }




     /*==================================================================*/
    /*                       Driver profile                             */
    /*==================================================================*/
    function add_driver($data)
    {
        $this->db->insert('driver', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_driver($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('driver', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function all_driver()
    {
        $x = $this->db->get('driver')->result_array();
        return $x;
    }

    function driver_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('driver', $data)->row_array();
        return $x;
    }
    /*==================================================================*/
    /*                           route                                  */
    /*==================================================================*/
    function add_route($data)
    {
        $this->db->insert('route', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_route($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('route', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function all_route()
    {
        $x = $this->db->get('route')->result_array();
        return $x;
    }

    function route_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('route', $data)->row_array();
        return $x;
    }
    /*==================================================================*/
    /*                           route  location                                  */
    /*==================================================================*/
    function add_route_location($data)
    {
        $this->db->insert('route_location', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_route_location($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('route_location', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function all_route_location($id)
    {   $data = array('route_id' => $id);
        $x = $this->db->get_where('route_location', $data)->result_array();

        return $x;
    }

    function route_location_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('route_location', $data)->row_array();
        return $x;
    }

 function all_active_driver()
    {
        $data = array('status' =>1);
        $x = $this->db->get_where('driver',$data)->result_array();
        return $x;
    }
    function all_active_helper()
    {
        $data = array('status' =>1);
        $x = $this->db->get_where('driver',$data)->result_array();
        return $x;
    }
    function all_active_vehicle()
    {
        $data = array('status' =>1);
        $x = $this->db->get_where('vehicle', $data)->result_array();
        return $x;
    }
    function update_route_histry($data){
        $data['date'] = date('Y-m-d');
        $route=$this->admin_model->route_by_id($data['id']);
        $this->admin_model->update_route($data);
        if($route['driver_id']) {
            $data2['route_id'] = $route['id'];
            $data2['driver_id'] = $route['driver_id'];
            $data2['helper_id'] = $route['helper_id'];
            $data2['vechiles_id'] = $route['vechiles_id'];
            $data2['date_from'] = $route['date'];
            $data2['date_to'] = date('Y-m-d');
            $this->db->insert('route_histry', $data2);
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

    }
    function all_route_history_by_id($id)
    {
        $data = array('route_id' =>$id);
        $x = $this->db->get_where('route_histry', $data)->result_array();
        return $x;
    }

    /*==================================================================*/
    /*                           MANAGE EVENT                        */
    /*==================================================================*/
    function add_event_teacher($data)
    {
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('event_teacher', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_event_teacher($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('event_teacher');
    }
    function event_teacher_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('event_teacher', $data)->row_array();
        return $x;
    }

    function all_event_teacher($id)
    {
        $data = array('event_id' => $id);
        $x = $this->db->get_where('event_teacher',$data)->result_array();
        return $x;
    }
    /*=============================================*/
    function add_event_student($data)
    {
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('event_student', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_event_student($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('event_student');
    }
    function event_student_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('event_student', $data)->row_array();
        return $x;
    }

    function all_event_student($id)
    {
        $data = array('event_id' => $id);
        $x = $this->db->get_where('event_student',$data)->result_array();
        return $x;
    }
    function get_setting(){
        $x = $this->db->get('setting')->row_array();
        return $x;
    }
    function get_setting_start_month(){
        $this->db->select('start_month');
        $x = $this->db->get('setting')->row_array();
        return $x['start_month'];
    }
    function update_setting($data){
        $this->db->where('id',1);
        $this->db->update('setting', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                       Admin Teacher  chat                        */
    /*==================================================================*/
    function admin_teacher_chat_add($data)
    {
        $data['date'] = date('Y-m-d');
        $data['time'] = date('h:i:a');
        $data['from_id'] = $_SESSION['user_id'];
        $data['from_name'] = $_SESSION['username'];
        $this->db->insert('admin_teacher_chat', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function list_admin_teacher_chat($id,$limit,$offset){
        $wh= "from_id=".$id." AND to_id=".$_SESSION['user_id']." OR to_id=".$id." AND from_id=".$_SESSION['user_id'];
        $this->db->where( $wh);
        $this->db->order_by('id', 'DESC');
        $x = $this->db->get('admin_teacher_chat',$limit,$offset)->result_array();
        return array_reverse($x);
    }
    function list_admin_last_chat($id){
        $wh="to_id=".$id." AND from_id=".$_SESSION['user_id'];
        $this->db->where( $wh);
        $x = $this->db->get('admin_teacher_chat')->last_row();
        return $x;
    }
    function list_teacher_last_chat($id){
        $wh="from_id=".$id." AND to_id=".$_SESSION['user_id'];
        $this->db->where( $wh);
        $x = $this->db->get('admin_teacher_chat')->last_row();
        return $x;
    }
    function count_admin_teacher_chat($id){
        $wh= "from_id=".$id." AND to_id=".$_SESSION['user_id']." OR to_id=".$id." AND from_id=".$_SESSION['user_id'];
        $this->db->where( $wh);
        $x = $this->db->get('admin_teacher_chat')->num_rows();
        return $x;
    }

    function admin_guardian_chat_add($data)
    {
        $data['date'] = date('Y-m-d');
        $data['time'] = date('h:i:a');
        $data['from_id'] = $_SESSION['user_id'];
        $data['from_name'] = $_SESSION['username'];
        $this->db->insert('admin_guardian_chat', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function list_admin_guardian_chat(){
        $data = array('from_name' => $_SESSION['username']);
        $x = $this->db->get_where('admin_guardian_chat', $data)->row_array();
        return $x;
    }

    /*==================================================================*/
    /*                                EXPANSE                           */
    /*==================================================================*/
    function list_expanse(){
        return $this->db->get('expanse')->result_array();
    }

    public function list_expanse_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('expanse', $data)->row_array();
    }

    function add_expanse($data)
    {
        $this->db->insert('expanse', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_expanse($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('expanse', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*==================================================================*/
    /*                       EXPANSE    DETAIL                          */
    /*==================================================================*/
    function add_expanse_detail($data)
    {
        $data['date'] = date('Y-m-d');
        $data['month'] = date('m');
        $data['year'] = date('Y');
        $data['day'] = date('d');
        $data['running_year'] = $_SESSION['running_year'];
        $this->db->insert('expanse_detail', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function update_expanse_detail($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('expanse_detail', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function list_expanse_detail(){

        return $this->db->get('expanse_detail')->result_array();
    }
    function list_expanse_detail_by_day($d){
        $data['date'] = $d;
        return $this->db->get_where('expanse_detail',$data)->result_array();
    }
    function list_expanse_detail_by_month($d){
        $data['month'] = $d;
        return $this->db->get_where('expanse_detail',$data)->result_array();
    }
    public function list_expanse_detail_by_id($id)
    {
        $data = array('id' => $id);
        return $this->db->get_where('expanse_detail', $data)->row_array();
    }


}
