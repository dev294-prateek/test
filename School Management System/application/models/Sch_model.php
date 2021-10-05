<?php
class Sch_model extends CI_Model {

    public function __construct(){

        $this->load->database();

    }
    /*##########################################################*/
    /*                       USE FULL FUNCTION                  */
    /*##########################################################*/
    public function running_year(){
        $query = $this->db->get('setting')->row_array();
        return $query['running_year'];
    }
    public function subject_name($id){
        $data = array('id' => $id);
        $query = $this->db->get_where('subjects_list',$data)->row_array();
        return $query['name'];
    }
    public function class_name($id){
        $data = array('class_id' => $id);
        $query = $this->db->get_where('class',$data)->row_array();
        return $query['name'];
    }
    public function section_name($id){
        $data = array('section_id' => $id);
        $query = $this->db->get_where('section',$data)->row_array();
        return $query['name'];
    }
    public function roll_no($id){
        $running_year=$this->sch_model->running_year();
        $data = array('student_id' => $id,'running_year'=>$running_year);
        $query = $this->db->get_where('enroll ',$data)->row_array();
        return $query['roll_no'];
    }
    function employee_name($id)
    {
        $data = array('employee_id' => $id);
        $this->db->select('name');
        $x = $this->db->get_where('employee', $data)->row_array();
        return $x['name'];
    }
    function class_teacher_name($id)
    {
        $data = array('teacher_id' => $id);
        $x = $this->db->get_where('teacher', $data)->row_array();
        $y = $this->sch_model->employee_name($x['employee_id']);
        return $y;
    }
    function student_section($stu_id){
        $data=array('student_id'=>$stu_id);
        $query=$this->db->get_where('student',$data)->row_array();
        return $query['section'];
    }
    function student_name($stu_id){
        $data=array('student_id'=>$stu_id);
        $query=$this->db->get_where('student',$data)->row_array();
        return $query['student_name'];
    }
    function teacher_id_by_section_id($sec_id){
        $data2=array('section_id'=>$sec_id);
        $query1=$this->db->get_where('section',$data2)->row_array();
        return $query1['teacher_id'];
    }
    private function generateApiKey(){
        return md5(uniqid(rand(), true));
    }
    function student_guardian($stu_id){
        $data=array('student_id'=>$stu_id);
        $query=$this->db->get_where('student',$data)->row_array();
        return $query['guardian'];
    }

    function guardian_name($g_id){
        $data=array('guardian_id'=>$g_id);
        $query=$this->db->get_where('guardian',$data)->row_array();
        return $query['guardian_name'];
    }
    function class_id($stu_id){
        $data=array('student_id'=>$stu_id);
        $query=$this->db->get_where('student',$data)->row_array();
        return $query['class'];
    }
    /*##########################################################*/
    /*   IF STUDENT EXIST*/
    /*##########################################################*/

    private function isStudentExists($username) {
        $arr = array('username' => $username);
        $query = $this->db->get_where('students ',$arr);
        return $query->row_array();
    }
    /*##########################################################*/
    /*    PARENT lOGIN*/
    /*##########################################################*/
    function parentLogin($email,$pass)
    {
        $data=array('email'=>$email, 'password'=>md5($pass) );
        $query=$this->db->get_where('guardian',$data);
        return $query->num_rows();
    }
    function getParent($email,$pass)
    {
        $data=array('email'=>$email, 'password'=>md5($pass) );
        $query=$this->db->get_where('guardian',$data);
        return $query->row_array();
    }
    /*##########################################################*/
    /*   LIST ALL CHILD*/
    /*##########################################################*/
    public function getChildList($guardian_id)
    {
        $data=array('guardian'=>$guardian_id);
        $child_list= $this->db->get_where('student',$data)->result_array();
        return $child_list;
    }

    /*##########################################################*/
    /*   LIST CLASS TEACHER*/
    /*##########################################################*/

    public function class_teacher_list($stu_id){
        $section_id = $this-> student_section($stu_id);
        $teacher_id = $this-> teacher_id_by_section_id( $section_id);
        return  $teacher_id ;
    }
    /*##########################################################*/
    /*                          GET HOMRWORK                    */
    /*##########################################################*/
    function home_work($sec_id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('status' => 1,'running_year'=>$running_year,'section_id'=>$sec_id);
        $work_data = $this->db->get_where('home_work', $data)->result_array();
        return $work_data;
    }
    function home_work_today($sec_id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('status' => 1,'running_year'=>$running_year,'section_id'=>$sec_id,'date'=>date('Y-m-d'));
        $work_data = $this->db->get_where('home_work', $data)->result_array();
        return $work_data;
    }

    public function getHomeWork($student_id)
    {
        $section_id = $this-> student_section($student_id);
        $all_home_work = $this-> home_work($section_id);
        return $all_home_work ;
    }

    public function getHomeWorkToday($student_id)
    {
        $section_id = $this-> student_section($student_id);
        $all_home_work = $this->home_work_today($section_id);
        return $all_home_work ;
    }
    public function getTeacherHomeWork($teacher_id )
    {
        $running_year=$this->sch_model->running_year();
        $data = array('status' => 1,'running_year'=>$running_year,'teacher_id'=>$teacher_id);
        $work_data = $this->db->get_where('home_work', $data)->result_array();
        return $work_data;
    }
    function  add_home_work($data){
        $data['date']=date('Y-m-d');
        $data['running_year	']=$this->sch_model->running_year();
        $this->db->insert('home_work', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function home_work_by_id($id){
        $data=array('id'=>$id);
        $work_data = $this->db->get_where('home_work',$data)->row_array();
        return $work_data;
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
    /*##########################################################*/
    /*                      GET CLASS WORK                      */
    /*##########################################################*/
    function class_work($sec_id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('status' => 1,'running_year'=>$running_year,'section_id'=>$sec_id);
        $work_data = $this->db->get_where('class_work', $data)->result_array();
        return $work_data;
    }
    function class_work_today($sec_id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('status' => 1,'running_year'=>$running_year,'section_id'=>$sec_id,'date'=>date('Y-m-d'));
        $work_data = $this->db->get_where('class_work', $data)->result_array();
        return $work_data;
    }

    public function getClassWork($student_id)
    {
        $section_id = $this-> student_section($student_id);
        $all_class_work = $this-> class_work($section_id);
        return $all_class_work ;
    }

    public function getClassWorkToday($student_id)
    {
        $section_id = $this-> student_section($student_id);
        $all_class_work = $this->class_work_today($section_id);
        return $all_class_work ;
    }
    public function getTeacherClassWork($teacher_id )
    {
        $running_year=$this->sch_model->running_year();
        $data = array('status' => 1,'running_year'=>$running_year,'teacher_id'=>$teacher_id);
        $work_data = $this->db->get_where('class_work', $data)->result_array();
        return $work_data;
    }
    function  add_class_work($data){
        $data['date']=date('Y-m-d');
        $data['running_year	']=$this->sch_model->running_year();
        $this->db->insert('class_work', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function class_work_by_id($id){
        $data=array('id'=>$id);
        $work_data = $this->db->get_where('class_work',$data)->row_array();
        return $work_data;
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

    /*==========================*/
    /*##########################################################*/
    /*                         STUDENT SUBJECT                  */
    /*##########################################################*/
    public function student_subject($id){
        $running_year=$this->sch_model->running_year();
        $data = array('student_id' => $id,'running_year'=>$running_year);
        $query = $this->db->get_where('enroll ',$data)->row_array();
        return json_decode($query['subjects'],true);
    }

    function lessonPlan($student_id,$subject_id){
        $section_id = $this->student_section($student_id);
        $running_year=$this->sch_model->running_year();
        $data = array('approve_status' => 1,'running_year'=>$running_year,'section_id'=>$section_id ,'subject_id'=>$subject_id );
        $work_data = $this->db->get_where('lesson_plan', $data)->result_array();
        return $work_data;
    }
    function teacher_lesson_plan($id){
        $data=array('teacher_id'=>$id);
        $work_data = $this->db->get_where('lesson_plan',$data)->result_array();
        return $work_data;
    }
    function add_lesson_plan($data){
        $data['date']=date('Y-m-d');
        $data['running_year	']=$this->sch_model->running_year();
        $this->db->insert('lesson_plan',$data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function lesson_plan_by_id($id){
        $data=array('id'=>$id);
        $work_data = $this->db->get_where('lesson_plan',$data)->row_array();
        return $work_data;
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
    /*##########################################################*/
    /*   ALL CHAT MESSAGE*/
    /*##########################################################*/

    function teacher_student_all_chat_message($teacher_id,$student_id){

        $wh= "from_id=".$student_id." AND to_id=".$teacher_id." OR to_id=".$student_id." AND from_id=".$teacher_id;
        $this->db->where( $wh);
        $this->db->order_by('id', 'DESC');
        $x = $this->db->get('teacher_guardian_chat')->result_array();
        return array_reverse($x);
    }

    function guardian_to_teacher_chat_add($teacher_id,$student_id, $message)
    {

        $t_name = $this->class_teacher_name($teacher_id);
        $g_id = $this->student_guardian($student_id);
        $g_name = $this->guardian_name($g_id);
        $data['date'] = date('Y-m-d');
        $data['message'] = $message;
        $data['date'] = date('Y-m-d');
        $data['time'] = date('h:i:a');
        $data['to_id'] = $teacher_id;
        $data['to_name'] = $t_name;
        $data['from_id'] = $student_id;
        $data['from_name'] = $g_name ;
        $this->db->insert('teacher_guardian_chat', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function teacher_to_guardian_to_chat_add($teacher_id,$student_id, $message)
    {
        $t_name = $this->class_teacher_name($teacher_id);
        $g_id = $this->student_guardian($student_id);
        $g_name = $this->guardian_name($g_id);
        $data['date'] = date('Y-m-d');
        $data['message'] = $message;
        $data['date'] = date('Y-m-d');
        $data['time'] = date('h:i:a');
        $data['from_id'] = $teacher_id;
        $data['from_name'] = $t_name;
        $data['to_id'] = $student_id;
        $data['to_name'] = $g_name ;
        $this->db->insert('teacher_guardian_chat', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function teacher_admin_all_chat_message($employee_id,$admin_id){

        $wh= "from_id=".$admin_id." AND to_id=".$employee_id." OR to_id=".$admin_id." AND from_id=".$employee_id;
        $this->db->where( $wh);
        $this->db->order_by('id', 'DESC');
        $x = $this->db->get('admin_teacher_chat')->result_array();
        return array_reverse($x);
    }
    function teacher_to_admin_to_chat_add($employee_id,$admin_id, $message){
        $t_name = $this->employee_name($employee_id);
        $admin_name = $this->employee_name($admin_id);
        $data['date'] = date('Y-m-d');
        $data['message'] = $message;
        $data['date'] = date('Y-m-d');
        $data['time'] = date('h:i:a');
        $data['from_id'] = $employee_id;
        $data['from_name'] = $t_name;
        $data['to_id'] = $admin_id;
        $data['to_name'] = $admin_name ;
        $this->db->insert('admin_teacher_chat', $data);
    if ($this->db->affected_rows() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
   }
   function admin_detail(){
       $data=array('designation'=>'admin');
       $this->db->select('employee_id');
       $this->db->select('name');
       $this->db->select('employee_image');
       $x= $this->db->get_where("employee",$data)->row_array();
       return $x;
   }
    /*##########################################################*/
    /*   SEND MESSAGE*/
    /*##########################################################*/
    public function send_message($from,$to,$message,$account_type){
        date_default_timezone_set('Asia/Kolkata');
        $sent=date('Y-m-d h:i:s');
        $recd=0;
        $data=array('from1'=>$from,'to1'=>$to,'account_type'=>$account_type,' message'=>$message,'sent'=>$sent,'recd'=>$recd);
        $result = $this->db->insert('chat', $data);
        if ($result) {
            return 0;
        } else {
            return 1;
        }
    }

    /*##########################################################*/
    /*   UPDATE TOKEN*/
    /*##########################################################*/

    function update_token($parent_id,$token){
        $data=array('authentication_key'=>$token);
        $this->db->where('parent_id', $parent_id);
        $result=$this->db->update('parent', $data);
        if($result){
            return true;
        }
        return false;
    }


    /*##########################################################*/
    /*  GET ACADEMIC SLABUS */
    /*##########################################################*/

    public function getAcademicSyllabus($student_id)
    {
        $arr = array('type' => "running_year");
        $query = $this->db->get_where('settings',$arr)->row_array();
        $running_year = $query['description'];

        $data = array('year'=>$running_year,'student_id'=>$student_id);
        $this->db->select('class_id');
        $this->db->select('section_id');
        $query=$this->db->get_where('enroll',$data);
        $row1= $query->row_array();
        $class_id = $row1['class_id'];

        $this->db->select('academic_syllabus.`academic_syllabus_id`, academic_syllabus.`academic_syllabus_code`, academic_syllabus.`title`,
        academic_syllabus.`description`, academic_syllabus.`file_name`, class.`name` as class_name');

        $this->db->from('academic_syllabus');
        $this->db->join('class', 'class.class_id = academic_syllabus.class_id', 'left');
        $this->db->where('academic_syllabus.class_id', $class_id);
        $this->db->where('academic_syllabus.year', $running_year);


        $slabus = $this->db->get()->result_array();
        return $slabus;
    }

    /*##########################################################*/
    /*  GET TIME TABLE  */
    /*##########################################################*/

    public function getTimeTable($student_id)
    {
        $section_id = $this->student_section($student_id);
        $time_table = $this->list_period_by_section($section_id );
        return $time_table;
    }
    public function getTeacherTimeTable($teacher_id)
    {
        $running_year=$this->sch_model->running_year();
        $data=array('teacher_id'=>$teacher_id,'running_year'=>$running_year);
        return $this->db->get_where('period_allotment',$data)->result_array();
     }
    public function list_period_by_section($s_id)
    {
        $running_year=$this->sch_model->running_year();
        $data=array('section_id'=>$s_id,'running_year'=>$running_year);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }

    /*##########################################################*/
    /*  NOTICE BOARD  */
    /*##########################################################*/

    public function getNoticeBoard()
    {
        $x = $this->db->get('noticeboard')->result_array();
        return $x;
    }

    public function getNoticeBoardToday()
    {
        $arr = array('date' => date("Y-m-d"));
        $query= $this->db->get_where('noticeboard',$arr);
        return $query->result_array();
    }

    /*##########################################################*/
    /*  GET SCHOOL GALLERY */
    /*##########################################################*/

    public function getSchoolGallery()
    {
        $running_year=$this->sch_model->running_year();
        $data=array('running_year'=>$running_year);
        $query= $this->db->get_where('school_gallery',$data);
        return $query->result_array();
    }

    public function getschoolGalleryPhotos($school_gallery_id)
    {
        $arr = array('id' => $school_gallery_id);
        $query= $this->db->get_where('school_gallery_photo',$arr);
        return $query->result_array();

    }
    function add_class_gallery($data){
        $data['date']=date('Y-m-d');
        $data['running_year']= $this->sch_model->running_year();
        $this->db->insert('class_gallery', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function class_gallery_by_id($id){
        $running_year=$this->sch_model->running_year();
        $data=array('running_year'=>$running_year,'id'=>$id);
        $gal = $this->db->get_where('class_gallery',$data)->row_array();
        return $gal;
    }
    function update_class_gallery($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('class_gallery', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    /*##########################################################*/
    /*  GET CLASS GALLERY */
    /*##########################################################*/
    public function getClassGallery($student_id)
    {   $section_id = $this->student_section($student_id);
        $running_year=$this->sch_model->running_year();
        $data=array('running_year'=>$running_year,'section_id'=>$section_id,'status'=>1);
        $gal = $this->db->get_where('class_gallery',$data)->result_array();
        return $gal;
    }

    public function getClassGalleryPhotos($class_gallery_id)
    {
        $arr = array('id' => $class_gallery_id);
        $query= $this->db->get_where('class_gallery_photo',$arr);
        return $query->result_array();
    }
    function list_class_gallery_by_teacher_id($id){
        $running_year=$this->sch_model->running_year();
        $data=array('running_year'=> $running_year,'teacher_id'=>$id);
        $gal = $this->db->get_where('class_gallery',$data)->result_array();
        return $gal;
    }
    function add_class_gallery_photo($id,$image_name){
        $data=array('class_gallery_id'=>$id,'image'=>$image_name);
        $this->db->insert('class_gallery_photo', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function delete_class_image($id){
        $data=array('id'=>$id);
        $x= $this->db->delete('class_gallery_photo',$data);
        return $x;
    }
    function list_image_by_class_gallery_id($id){
        $data=array('class_gallery_id'=>$id);
        $x=$this->db->get_where('class_gallery_photo', $data)->result_array();
        return $x;
    }
    /*##########################################################*/
    /* GET ATTENDANCE & ASSESSMENT*/
    /*##########################################################*/
    function  all_attendance($stu_id){
        $section_id = $this->student_section($stu_id);
        $c_id = $this->class_id($stu_id);
        $running_year=$this->sch_model->running_year();
        $data = array('class_id' => $c_id, 'section_id' => $section_id,'student_id' => $stu_id,'running_year' => $running_year);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->result_array();
        return $x;
    }
    function  get_attendance($stu_id,$month){
        $section_id = $this->student_section($stu_id);
        $c_id = $this->class_id($stu_id);
        $running_year=$this->sch_model->running_year();
        $data = array('class_id' => $c_id, 'section_id' => $section_id,'student_id' => $stu_id,'month' => $month,'running_year' => $running_year);
        $table = 'class_id_' . $c_id . '_attendance';
        $x = $this->db->get_where($table, $data)->result_array();
        return $x;
    }

    /*##########################################################*/
    /*  GET STUDENT PROFILE */
    /*##########################################################*/


    public function getStudentProfile($stu_id)
    {
        $data=array('student_id'=>$stu_id);
        $query=$this->db->get_where('student',$data)->row_array();
        return $query;
    }
    /*##########################################################*/
    /*  lIST ALL pERIOD */
    /*##########################################################*/
    public function list_period_by_section_new($stu_id)
    {   $sec_id = $this->student_section($stu_id);
        $running_year=$this->sch_model->running_year();
        $data=array('status'=>1,'section_id'=>$sec_id,'running_year'=>$running_year);
        return $this->db->get_where('period_allotment',$data)->result_array();
    }
    /*##########################################################*/
    /*  lIST ALL EVENT */
    /*##########################################################*/
    function all_event()
    {
        $running_year=$this->sch_model->running_year();
        $data = array('running_year' => $running_year);
        return $this->db->get_where("events",$data)->result_array();
    }


    /*##########################################################*/
    /*  FEE*/
    /*##########################################################*/
    function fee_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee', $data)->row_array();
        return $x['name'];
    }
    function payment_history($st_id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('student_id' => $st_id, 'running_year' => $running_year);
        $x = $this->db->get_where('student_fee', $data)->result_array();
        return $x;
    }


    function list_section_fee_by_section_id($stu_id)
    {   $running_year=$this->sch_model->running_year();
        $sec_id = $this->student_section($stu_id);
        $data = array('section_id' => $sec_id, 'running_year' => $running_year);
        $x = $this->db->get_where('fee_section', $data)->result_array();
        return $x;
    }
    function fee_type_name($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('fee_type', $data)->row_array();
        return $x['name'];
    }
    /*##########################################################*/
    /*  GET EXAM LIST*/
    /*##########################################################*/
    function list_all_exam($stu_id)
    {
        $running_year=$this->sch_model->running_year();
        $sec_id = $this->student_section($stu_id);
        $data = array('running_year' => $running_year);
        $x = $this->sch_model->list_exam_allowed_section_by_section_id($sec_id);
        $this->db->where_in('id', $x);
        $x = $this->db->get_where('exam', $data)->result_array();
        return $x;
    }
    function list_exam_type_by_id($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('exam_type', $data)->row_array();
        return $x['name'];
    }
    public function list_exam_allowed_section_by_section_id($sec_id)
    {
        $data = array('section_id' => $sec_id);
        $this->db->distinct();
        $this->db->select('exam_id');
        $x=$this->db->get_where('exam_allowed_section', $data)->result_array();
        foreach ($x as $row) {  $result[]=$row['exam_id']; }
        return  $result;
    }

    public function list_all_exam_allowed_section_subject($stu_id,$exam_id)
    {
        $sec_id = $this->student_section($stu_id);
        $data = array('exam_id' => $exam_id,'section_id' => $sec_id);
        $this->db->order_by("subject_id", "asc");
        return $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
    }
    public function list_subjects_by_id($id)
    {
        $data = array('id' => $id);
        $x=$this->db->get_where('subjects_list', $data)->row_array();
        return $x['name'];

    }
    function paper_name($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('subject_option', $data)->row_array();
        return $x['name'];
    }
    function exam_mark_data_tabulation($stu_id,$exam_id)
    {
        $data = array('exam_id' => $exam_id,'student_id' => $stu_id);
        $x = $this->db->get_where('exam_marks', $data)->result_array();
        return $x;
    }
    public function list_all_exam_allowed_section_subject_tabulation($stu_id,$exam_id)
    {   $sec_id = $this->student_section($stu_id);
        $data = array('exam_id' => $exam_id, 'section_id' => $sec_id);
        $this->db->select("subject_id");
        $this->db->distinct();
        return $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
    }
    public function book_history_by_stu_id($id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('student_id' => $id, 'running_year' => $running_year);
        $x = $this->db->get_where('book_issue_history', $data)->result_array();
        return $x;
    }
    public function book_history_by_staff_id($id)
    {
        $running_year=$this->sch_model->running_year();
        $data = array('staff_id' => $id, 'running_year' => $running_year);
        $x = $this->db->get_where('book_issue_history', $data)->result_array();
        return $x;
    }
//    ------------------------------ for teacher ----------------------------------------
    public function list_all_exam_allowed_section($class_id,$section_id)
    {
        $data=array('class_id'=>$class_id,'section_id'=>$section_id);
        $this->db->select('exam_id');
        $this->db->select('class_id');
        $this->db->select('section_id');
        return $this->db->get_where('exam_allowed_section',$data)->result_array();
    }
    function exam_by_id($id){
        $running_year=$this->sch_model->running_year();
        $data=array('running_year'=>$running_year,'id'=>$id);
        $x=$this->db->get_where('exam', $data)->row_array();
        return $x['name'];
    }
    function get_exam_paper($data){
        $data=array('exam_id'=>$data['exam_id'],'class_id'=>$data['class_id'],'section_id'=>$data['section_id'],'subject_id'=>$data['subject_id']);
        $this->db->select('paper_id');
        return $this->db->get_where('exam_allowed_section_subject',$data)->result_array();
    }
    function get_exam_paper_min_max_marks($data){
        $data=array('exam_id'=>$data['exam_id'],'class_id'=>$data['cl_id'],'section_id'=>$data['sec_id'],'subject_id'=>$data['sub_id']);
        $this->db->select('paper_id');
        return $this->db->get_where('exam_allowed_section_subject',$data)->result_array();
    }
//    function paper_name($id)
//    {
//        $data=array('id'=>$id);
//        $x=$this->db->get_where('subject_option',$data)->row_array();
//        return $x['name'];
//    }
    function exam_mark_data($data){
        $x=$this->db->get_where('exam_marks',$data)->result_array();
        return $x;
    }
    function update_exam_marks($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('exam_marks', $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }
    function exam_name_by_id($id)
    {    $running_year=$this->sch_model->running_year();
        $data = array('running_year' => $running_year, 'id' => $id);
        $x = $this->db->get_where('exam', $data)->row_array();
        return $x['name'];
    }
    public function subjects_name_by_id($id)
    {
        $data = array('id' => $id);
       $x= $this->db->get_where('subjects_list', $data)->row_array();
        return $x['name'];
    }
    public function list_all_exam_allowed_section_paper_tabulation($exam_id, $class_id, $section_id, $subject_id)
    {
        $data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id);
        $this->db->select("paper_id");
        $x = $this->db->get_where('exam_allowed_section_subject', $data)->result_array();
        return $x;
    }
    function paper_name_exam($id)
    {
        $data = array('id' => $id);
        $x = $this->db->get_where('subject_option', $data)->row_array();
        return $x['name'];
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
            'running_year' => $this->sch_model->running_year()
        );
        $this->db->select('marks');
        $this->db->select('max');
        $this->db->select('min');
        $x = $this->db->get_where('exam_marks', $data)->row_array();
        return $x;
    }
    /*##########################################################*/
    /*    tHEACHER LOGIN*/
    /*##########################################################*/

    function validate_login($user, $password){
        $data= array('login_id' =>$user,'password' =>md5($password),'status' => 1 );
        $x= $this->db->get_where("employee",$data)->row_array();
        return $x;
    }
    function teacher_id_by_employee_id($employee_id){
        $data=array('employee_id'=>$employee_id);
        $x= $this->db->get_where("teacher",$data)->row_array();
        return $x['teacher_id'];
    }
    function teacher_rofile($employee_id){
        $data=array('employee_id'=>$employee_id);
        $x= $this->db->get_where("employee",$data)->row_array();
        return $x;
    }
    function class_section($employee_id){
        $data=array('teacher_id'=>$employee_id);
        $x= $this->db->get_where("section",$data)->row_array();
        return $x;
    }
    function class_name_by_id($class_id){
        $data=array('class_id'=>$class_id);
        $x= $this->db->get_where("class",$data)->row_array();
        return $x['name'];
    }
    function class_by_id($class_id){
        $data=array('class_id'=>$class_id);
        $x= $this->db->get_where("class",$data)->row_array();
        return $x;
    }
    function all_student($employee_id){
        $y=$this->sch_model->class_section($employee_id);
        $data=array('class'=>$y['class_id'],'section'=>$y['section_id']);
        $x= $this->db->get_where("student",$data)->result_array();
        return $x;
    }
    /*==================================================================*/
    /*                    STUDENT ATTENDANCE                            */
    /*==================================================================*/
    function chk_before_insert_attendance($c_id,$s_id,$d){
        $running_year=$this->sch_model->running_year();
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$running_year);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->num_rows();
        return $x;
    }
    // ==================================================================
    function update_attendance($id, $c_id,$data){
        $running_year=$this->sch_model->running_year();
        $this->db->where('id', $id);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

// =======================================================================
    function get_data_from_enroll($c_id,$s_id){
        $running_year=$this->sch_model->running_year();
        $data = array('class_id'=>$c_id,'section_id'=>$s_id,'running_year'=>$running_year);
        $x= $this->db->get_where('enroll',$data)->result_array();
        return $x;
    }
    function insert_attendance($st_id,$c_id,$s_id,$d){
        $running_year=$this->sch_model->running_year();
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('student_id'=>$st_id,'class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$running_year,'date'=>$d);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0)
        { return TRUE;} else {return FALSE;}
    }

    function get_attendance_teach($c_id,$s_id,$d){
        $running_year=$this->sch_model->running_year();
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$running_year,);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->result_array();
        return $x;
    }
    function get_attendance_for_sms($c_id,$s_id,$d){
        $running_year=$this->sch_model->running_year();
        $y=explode("-",$d);
        $year=$y[0];
        $month=$y[1];
        $day=$y[2];
        $this->db->select('student_id');
        $this->db->select('attendance');
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$running_year,);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->result_array();
        return $x;
    }
    function student_name_mobile_sms($id){
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $this->db->select('mobile_no_for_sms');
        $x=$this->db->get_where('student', $data)->row_array();
        return $x;
    }
    function get_student_name_by_id($id){
        $data = array('student_id' => $id);
        $this->db->select('student_name');
        $x=$this->db->get_where('student', $data)->row_array();
        return $x['student_name'];
    }
    public function list_all_class()
    {
        return $this->db->get('class')->result_array();
    }
    public function list_all_active_class()
    {      $data=array('status'=>1);
        return $this->db->get_where('class',$data)->result_array();
    }
    function all_student_by_section_id($id){
        $data = array('section' => $id);
        $this->db->select('student_id');
        $this->db->select('student_name');
        $x=$this->db->get_where('student', $data)->result_array();
        return $x;
    }
    function get_attendance_report_year($c_id,$s_id,$month){
        $running_year=$this->sch_model->running_year();
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'month'=>$month,'running_year'=>$running_year);
        $table='class_id_'.$c_id.'_attendance';
        $this->db->select('year');
        $x=$this->db->get_where($table, $data)->row_array();
        return $x['year'];
    }
    function get_attendance_individual($c_id,$s_id,$stu,$day,$month,$year){
        $running_year=$this->sch_model->running_year();
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'student_id'=>$stu,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=>$running_year);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->row_array();
        return $x['attendance'];
    }
    function get_assessment_individual($c_id,$s_id,$stu,$day,$month,$year){
        $running_year=$this->sch_model->running_year();
        $data=array('class_id'=>$c_id,'section_id'=>$s_id,'student_id'=>$stu,'day'=>$day,'month'=>$month,'year'=>$year,'running_year'=> $running_year);
        $table='class_id_'.$c_id.'_attendance';
        $x=$this->db->get_where($table, $data)->row_array();
        return $x;
    }
}