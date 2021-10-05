<?php

if (!defined('BASEPATH'))
    exit('Ohhh... This is Cheating you are not suppose to do this.Cheater :)');

class Guardian_model extends CI_Model
{
        function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /*==================================================================*/
    /*                              Dashboard                           */
    /*==================================================================*/
    function  all_student($id){
        $data = array('guardian' => $id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $this->db->select('class');
        $this->db->select('section');
        $this->db->select('student_image');
        $x = $this->db->get_where('student', $data)->result_array();
        return $x;
    }
    function  get_attendance_of_student($c_id,$st_id){
        $data = array('student_id' => $st_id, 'date' =>date('Y-m-d'));
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->row_array();
        return $x;
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
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
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
    function add_guardian($data)
    {
        $data['created_at']=date('Y-m-d');
        $data['day']=date('d');
        $data['year']=date('Y');
        $data['month']=date('m');
        $this->db->insert('guardian', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    public function list_all_guardian()
    {
        return $this->db->get('guardian')->result_array();
    }

    public function list_guardian_by_id($id)
    {
        $data = array('guardian_id' => $id);
        return $this->db->get_where('guardian', $data)->row_array();
    }

    function update_guardian($data)
    {
        $this->db->where('guardian_id', $data['guardian_id']);
        unset($data['guardian_id']);
        $this->db->update('guardian', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    /*==================================================================*/
    /*                             EMPLOYEE                             */
    /*==================================================================*/
    function add_employee($data)
    {
        $this->db->insert('employee', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    public function list_all_employee()
    {
        return $this->db->get('employee')->result_array();
    }

    public function list_all_employee_by_des($des)
    {
        $data = array('designation' => $des);
        return $this->db->get_where('employee',$data)->result_array();
    }
    public function list_all_employee_teacher_not_used()
    {
        $data = array('designation' => "teacher",'used' =>0);
        $this->db->select("employee_id,name");
        return $this->db->get_where('employee',$data)->result_array();
    }
    public function list_all_employee_teacher()
    {
        $data = array('designation' => "teacher");
        $this->db->select("employee_id,name");
        return $this->db->get_where('employee',$data)->result_array();
    }
    function list_designation(){
        $this->db->distinct();
        $this->db->select('designation');
        return $this->db->get('employee')->result_array();
    }

    public function list_employee_by_id($id)
    {
        $data = array('employee_id' => $id);
        return $this->db->get_where('employee', $data)->row_array();
    }

    function update_employee($data)
    {
        if(strlen($data['password']) < 20) {
            $data['password'] = md5($data['password']);
        }
        $this->db->where('employee_id', $data['employee_id']);
        unset($data['employee_id']);
        $this->db->update('employee', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function change_employee_status($data){
        $this->db->where('employee_id', $data['id']);
        unset($data['id']);
        $this->db->update('employee', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}

    }
    public function list_all_emp_designation()
    {
        return $this->db->get('emp_designation')->result_array();
    }
    function employee_name_mobile_sms($id){
        $data = array('employee_id' => $id);
        $this->db->select('name');
        $this->db->select('contact_no');
        $x=$this->db->get_where('employee', $data)->row_array();
        return $x;
    }
    /*==================================================================*/
    /*                      EMPLOYEE  QUALIFICATION                     */
    /*==================================================================*/
    function add_emp_qualification($data)
    {
        $this->db->insert('emp_qualification', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
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
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
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
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
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
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    function delete_experience($data)
    {
        $this->db->where('experience_id', $data);
        $this->db->delete('emp_experience');
    }
    /*==================================================================*/
    /*                             ENROLL                              */
    /*==================================================================*/
    function add_enroll($data){
        $data['running_year']=$_SESSION['running_year'];
        $data['date']=date('Y-m-d');
        $data['day']=date('d');
        $data['year']=date('Y');
        $data['month']=date('m');
        $this->db->insert('enroll', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function update_enroll($data){
        $this->db->where('student_id', $data['student_id']);
        unset($data['student_id']);
        $this->db->update('enroll', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function list_enroll_by_student_id($id){
        $data = array('student_id' => $id,'running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('enroll',$data)->row_array();
    }
    function list_enroll_by_section_id($id){
        $data = array('section_id' => $id,'running_year'=>$_SESSION['running_year']);
        $this->db->select('student_id');
        $this->db->select('subjects');
        return $this->db->get_where('enroll',$data)->result_array();
    }
    function all_student_by_section_id($id){
        $data = array('section' => $id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $x=$this->db->get_where('student', $data)->result_array();
        return $x;
    }
    function all_student_by_section_id_student_id($sec_id,$st_id){
        $data = array('section' => $sec_id,'student_id' => $st_id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $x=$this->db->get_where('student', $data)->result_array();
        return $x;
    }
    /*==================================================================*/
    /*                    STUDENT ATTENDANCE                            */
    /*==================================================================*/

    function get_data_from_enroll($c_id,$s_id){
        $data = array('class_id'=>$c_id,'section_id'=>$s_id,'running_year'=>$_SESSION['running_year']);
        $x= $this->db->get_where('enroll',$data)->result_array();
        return $x;
    }
    function insert_attendance($st_id,$c_id,$s_id,$d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('student_id'=>$st_id,'class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],'date'=>$d);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function chk_before_insert_attendance($c_id,$s_id,$d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year']);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    function get_attendance($c_id,$s_id,$d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->result_array();
        return $x;
    }
    function get_attendance_for_sms($c_id,$s_id,$d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $this->db->select('student_id');
        $this->db->select('attendance');
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->result_array();
        return $x;
    }
    function update_attendance($id, $c_id,$data){
        $this->db->where('id', $id);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    /*==================================================================*/
    /*                    EMPLOYEE ATTENDANCE                           */
    /*==================================================================*/
    function chk_before_insert_emp_attendance($d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year']);
        $x=$this->db->get_where("employee_attendance", $data)->num_rows();
        return $x;
    }
    function get_data_from_employee(){
        $data=array('ststus'==1);
        $x = $this->db->get_where('employee',$data)->result_array();
        return $x;
    }
    function insert_emp_attendance($emp_id,$d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('employee_id'=>$emp_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],'date'=>$d);
        $this->db->insert("employee_attendance", $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function get_emp_attendance($d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year']);
        $x=$this->db->get_where("employee_attendance", $data)->result_array();
        return $x;
    }
    function update_emp_attendance($id,$val){
        $this->db->where('id', $id);
        $data=array('attendance'=>$val);
        $this->db->update("employee_attendance", $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function get_attendance_for_emp_sms($d){
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $this->db->select('employee_id');
        $this->db->select('attendance');
        $data=array('day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],);
        $x=$this->db->get_where("employee_attendance", $data)->result_array();
        return $x;
    }
    function employee_name($id){
        $data = array('employee_id' => $id);
        $this->db->select('name');
        $x=$this->db->get_where('employee', $data)->row_array();
        return $x['name'];
    }
    /*==================================================================*/
    /*                             STUDENT                              */
    /*==================================================================*/

    function add_student($data)
    {
        $data2=array('class_id'=>$data['class'],'section_id'=>$data['section'],'roll_no'=>$data['roll_no'] );
       /* unset($data['section']);*/
        unset($data['roll_no']);
        $this->db->insert('student', $data);
        $data2['student_id']=$this->db->insert_id();
        $this->guardian_model->add_enroll( $data2);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    function update_student($data)
    {
        $this->db->where('student_id', $data['student_id']);
        $data2=array('student_id'=>$data['student_id'],'roll_no'=>$data['roll_no'],'class_id'=>$data['class'],'section_id'=>$data['section']);
        unset($data['student_id']);
  /*      unset($data['section']);*/
        unset($data['roll_no']);
        $this->db->update('student', $data);
        $x=$this->guardian_model->update_enroll($data2);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    public function list_all_student()
    {
        $x=$this->db->get('student')->result_array();
        $temp=0;
        foreach ($x as $z)
        {
            $y=$this->guardian_model->list_enroll_by_student_id($x[$temp]['student_id']);
            $x[$temp]['class']=$y['class_id'];
            $x[$temp]['section']=$y['section_id'];
            $x[$temp]['roll_no']=$y['roll_no'];
            $temp++;
        }

        return $x;
    }
    public function list_all_student_by_class_section($class,$section)
    {
        $data = array('class' => $class,'section' =>$section);
        $x= $this->db->get_where('student',$data)->result_array();
        $temp=0;
        foreach ($x as $z)
        {
            $y=$this->guardian_model->list_enroll_by_student_id($x[$temp]['student_id']);
            $x[$temp]['class']=$y['class_id'];
            $x[$temp]['section']=$y['section_id'];
            $x[$temp]['roll_no']=$y['roll_no'];
            $temp++;
        }
        return $x;
    }

    public function list_student_by_id($id)
    {
        $data = array('student_id' => $id);
        $x=$this->db->get_where('student', $data)->row_array();
        $y=$this->guardian_model->list_enroll_by_student_id($id);
        $x['class']=$y['class_id'];
        $x['section']=$y['section_id'];
        $x['roll_no']=$y['roll_no'];
        return $x;
    }
    function student_name($id){
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $x=$this->db->get_where('student', $data)->row_array();
        return $x['student_name'];
    }
    function student_name_mobile_sms($id){
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $this->db->select('mobile_no_for_sms');
        $x=$this->db->get_where('student', $data)->row_array();
        return $x;
    }
    function update_student_certificate($data)
    {
        $this->db->where('student_id', $data['id']);
        unset($data['id']);
        $this->db->update('student', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function change_student_status($data){
        $this->db->where('student_id', $data['id']);
        unset($data['id']);
        $this->db->update('student', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }


    /*==================================================================*/
    /*                               CLASS                              */
    /*==================================================================*/
    function add_class($data)
    {
        $this->db->insert('class', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function update_class($data)
    {
        $this->db->where('class_id', $data['class_id']);
        unset($data['class_id']);
        $this->db->update('class', $data);

        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function class_by_id($id)
    {
        $data = array('class_id' => $id);
        return $this->db->get_where('class', $data)->row_array();
    }

    public function list_all_class()
    {
        return $this->db->get('class')->result_array();
    }
    public function list_all_active_class()
    {      $data=array('status'=>1);
        return $this->db->get_where('class',$data)->result_array();
    }


    /*==================================================================*/
    /*                             SECTION                              */
    /*==================================================================*/
    function add_section($data)
    {
        $this->db->insert('section', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function update_section($data)
    {
        $this->db->where('section_id', $data['section_id']);
        unset($data['section_id']);
        $this->db->update('section', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    public function list_all_section()
    {
        return $this->db->get('section')->result_array();
    }
    public function list_all_active_section()
    {   $data=array('status'=>1);

        return $this->db->get_where('section',$data)->result_array();
    }
    function section_by_id($id)
    {
        $data = array('section_id' => $id);
        return $this->db->get_where('section', $data)->row_array();
    }

    public function list_section_by_class_id($id)
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
    {   $data=array('id'=>$id);
        $x=$this->db->get_where('teacher_type',$data)->row_array();
        return $x;
    }
    public function teacher_by_id($id)
    {
        $data=array('teacher_id'=>$id);
        $x=$this->db->get_where('teacher',$data)->row_array();
        return $x;
    }
    function teacher_name($id){
        $data=array('teacher_id'=>$id);
        $x=$this->db->get_where('teacher',$data)->row_array();
        $y=$this->guardian_model->employee_name($x['employee_id']);
        return $y;
    }
    public function teacher_by_employee_id($id)
    {   $data=array('employee_id'=>$id);
        $x=$this->db->get_where('teacher',$data)->row_array();
        return $x;
    }

    function add_teacher($data){
        $this->db->where('employee_id', $data['employee_id']);
        $data2=array('used'=>1);
        $this->db->update('employee', $data2);
        $this->db->insert('teacher', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function update_teacher($data){
        $this->db->where('teacher_id',$data['teacher_id']);
        unset($data['teacher_id']);
        $this->db->update('teacher', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    /*==================================================================*/
    /*                            SUBJECTS                              */
    /*==================================================================*/
    public function list_subjects()
    {
        return $this->db->get('subjects_list')->result_array();
    }
    public function list_subjects_by_id($id)
    {
        $data=array('id'=>$id);
        return $this->db->get_where('subjects_list',$data)->row_array();
    }

    public function list_period()
    {
        return $this->db->get('period_list')->result_array();
    }
    public function list_period_by_id($id)
    {   $data=array('id'=>$id);
        return $this->db->get_where('period_list',$data)->row_array();
    }
    /*==================================================================*/
    /*                      SECTION PERIOD                              */
    /*==================================================================*/
    function add_period($data){
        $data['running_year']=$_SESSION['running_year'];
        $this->db->insert('period_allotment', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    function update_period($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('period_allotment', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    public function list_all_period()
    {
        $data=array('running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }
    public function list_period_by_class($id)
    {
        $data=array('class_id'=>$id,'running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }
    public function list_period_by_section_new($s_id)
    {
        $data=array('status'=>1,'section_id'=>$s_id,'running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }
    public function list_period_by_section($c_id,$s_id)
    {
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }
    public function list_period_by_teacher($t_id)
    {
        $data=array('teacher_id'=>$t_id,'status'=>1,'running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }
    public function list_period_allotment_by_id($id)
    {
        $data=array('id'=>$id,'running_year'=>$_SESSION['running_year']);
        return $this->db->get_where('period_allotment',$data)->row_array();
    }

    function change_period_status($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('period_allotment', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    /*==================================================================*/
    /*                           CLASS WORK                             */
    /*==================================================================*/
    function class_work($sec_id){
        $data=array('status'=>1,'section_id'=>$sec_id);
        $work_data = $this->db->get_where('class_work',$data)->result_array();
        return $work_data;
    }
    function  add_class_work($data){
        $data['date']=date('Y-m-d');
        $data['running_year	']=$_SESSION['running_year'];
        $this->db->insert('class_work', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function  update_class_work($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        if($data['attachment']==''){ unset($data['attachment']);}
        $data['date']=date('Y-m-d');
        $this->db->update('class_work', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function class_wotk_by_id($id){
        $data=array('status'=>1,'id'=>$id);
        $work_data = $this->db->get_where('class_work',$data)->row_array();
        return $work_data;
    }
    /*==================================================================*/
    /*                           HOME WORK                             */
    /*==================================================================*/
    function home_work($sec_id){
        $data=array('status'=>1,'section_id'=>$sec_id);
        $work_data = $this->db->get_where('home_work',$data)->result_array();
        return $work_data;
    }
    function  add_home_work($data){
        $data['date']=date('Y-m-d');
        $data['running_year	']=$_SESSION['running_year'];
        $this->db->insert('home_work', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function  update_home_work($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        if($data['attachment']==''){ unset($data['attachment']);}
        $data['date']=date('Y-m-d');
        $this->db->update('home_work', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function home_wotk_by_id($id){
        $data=array('status'=>1,'id'=>$id);
        $work_data = $this->db->get_where('home_work',$data)->row_array();
        return $work_data;
    }
    /*==================================================================*/
    /*                          CLASS GALLERY                           */
    /*==================================================================*/
    function add_class_gallery($data){
        $data['date']=date('Y-m-d');
        $data['running_year']=$_SESSION['running_year'];
        $this->db->insert('class_gallery', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function update_class_gallery($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('class_gallery', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function list_class_gallery(){
        $data=array('running_year'=>$_SESSION['running_year']);
        $gal = $this->db->get_where('class_gallery',$data)->result_array();
        return $gal;
    }
    function list_class_gallery_by_id($id){
        $data=array('running_year'=>$_SESSION['running_year'],'id'=>$id);
        $gal = $this->db->get_where('class_gallery',$data)->row_array();
        return $gal;
    }
    function list_class_gallery_by_teacher_id($id){
        $data=array('running_year'=>$_SESSION['running_year'],'teacher_id'=>$id);
        $gal = $this->db->get_where('class_gallery',$data)->result_array();
        return $gal;
    }
    function list_class_gallery_by_teacher_id_active($id){
        $data=array('running_year'=>$_SESSION['running_year'],'section_id'=>$id,'status'=>1);
        $gal = $this->db->get_where('class_gallery',$data)->result_array();
        return $gal;
    }
    function add_class_gallery_photo($id,$image_name){
        $data=array('class_gallery_id'=>$id,'image'=>$image_name);
        $this->db->insert('class_gallery_photo', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function list_image_by_class_gallery_id($id){
        $data=array('class_gallery_id'=>$id);
        $x=$this->db->get_where('class_gallery_photo', $data)->result_array();
        return $x;
    }
    function delete_class_image($id){
       $data=array('id'=>$id);
       $x= $this->db->delete('class_gallery_photo',$data);
       return $x;
    }

    /*==================================================================*/
    /*                                EXAM                              */
    /*==================================================================*/
    public function list_all_exam_allowed_section($class_id,$section_id)
    {
        $data=array('class_id'=>$class_id,'section_id'=>$section_id);
        return $this->db->get_where('exam_allowed_section',$data)->result_array();
    }
    function exam_by_id($id){
        $data=array('running_year'=>$_SESSION['running_year'],'id'=>$id);
        $x=$this->db->get_where('exam', $data)->row_array();
        return $x;
    }
    function get_exam_paper($data){
        $data=array('exam_id'=>$data['exam_id'],'class_id'=>$data['cl_id'],'section_id'=>$data['sec_id'],'subject_id'=>$data['sub_id']);
        $this->db->select('paper_id');
        return $this->db->get_where('exam_allowed_section_subject',$data)->result_array();
    }
    function get_exam_paper_min_max_marks($data){
        $data=array('exam_id'=>$data['exam_id'],'class_id'=>$data['cl_id'],'section_id'=>$data['sec_id'],'subject_id'=>$data['sub_id']);
        $this->db->select('paper_id');
        return $this->db->get_where('exam_allowed_section_subject',$data)->result_array();
    }
    function paper_name($id)
    {
        $data=array('id'=>$id);
        $x=$this->db->get_where('subject_option',$data)->row_array();
        return $x['name'];
    }
    /*==================================================================*/
    /*                             EXAM MARKS                           */
    /*==================================================================*/
    function find_min_max_marks($data){
        unset($data['student_id']);
        unset($data['running_year']);
        $this->db->select('min');
        $this->db->select('max');
        $x=$this->db->get_where('exam_allowed_section_subject',$data)->row_array();
        return $x;
    }
    function check_row_already_inserted($data){
        $x=$this->db->get_where('exam_marks',$data)->num_rows();
        return $x;
    }
    function add_exam_marks($data){
       $chk=$this->guardian_model->check_row_already_inserted($data);
        $data['running_year']=$_SESSION['running_year'];
        if($chk==0){
            $xx= $this->guardian_model->find_min_max_marks($data);
            $data['max']=$xx['max'];
            $data['min']=$xx['min'];
        $this->db->insert('exam_marks', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
        }
    }
    function update_exam_marks($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam_marks', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function exam_mark_data($data){
        $x=$this->db->get_where('exam_marks',$data)->result_array();
        return $x;
    }
    function student_name_by_id($id){
        $data=array('student_id'=>$id);
        $this->db->select('student_name');
        $x=$this->db->get_where('student',$data)->row_array();
        return $x['student_name'];
    }
    function list_all_exam_by_id($id){
        $data=array('running_year'=>$_SESSION['running_year'],'id'=>$id);
        $x=$this->db->get_where('exam', $data)->row_array();
        return $x;
    }
    public function list_subject_option_by_id($id)
    {   $data=array('id'=>$id);
        return $this->db->get_where('subject_option',$data)->row_array();
    }

/*=================================*/

    function get_attendance_report_year($c_id,$s_id,$month){
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'month'=>$month,'running_year'=>$_SESSION['running_year']);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->select('year');
        $x=$this->db->get_where($table, $data)->row_array();
        return $x['year'];
    }
    function get_attendance_individual($c_id,$s_id,$stu,$day,$month,$year){
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'student_id'=>$stu,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->row_array();
        return $x;
    }
    function get_assessment_individual($c_id,$s_id,$stu,$day,$month,$year){
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'student_id'=>$stu,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$_SESSION['running_year'],);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->row_array();
        return $x;
    }

    /*==================================================================*/
    /*                           LESSON PLAN                             */
    /*==================================================================*/
    function lesson_plan($sec){
        $data=array('section_id'=>$sec,'approve_status'=>1);
        $work_data = $this->db->get_where('lesson_plan',$data)->result_array();
        return $work_data;
    }
    function add_lesson_plan($data){
        $data['date']=date('Y-m-d');
        $data['running_year	']=$_SESSION['running_year'];
        $this->db->insert('lesson_plan',$data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function update_lesson_plan($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        if($data['attachment']==''){ unset($data['attachment']);}
        $data['date']=date('Y-m-d');
        $this->db->update('lesson_plan', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function lesson_plan_by_id($id){
        $data=array('id'=>$id);
        $work_data = $this->db->get_where('lesson_plan',$data)->row_array();
        return $work_data;
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
    /*+++++++++++++++++++++++++++++++++++++*/
    function admin_name()
    {
        $data = array('designation' =>'admin');
        $this->db->select('employee_id');
        $this->db->select('name');
        $this->db->select('online');
        $this->db->select('employee_image');
        return $this->db->get_where('employee', $data)->result_array();
        return $y;
    }

}



