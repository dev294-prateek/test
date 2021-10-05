<?php

if (!defined('BASEPATH'))
    exit('Ohhh... This is Cheating you are not suppose to do this.Cheater :)');
class Login_model extends CI_Model {
        function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function validate_login($user, $password){
        $data= array('login_id' =>$user,'password' =>$password,'status' => 1 );
       $x= $this->db->get_where("employee",$data)->row_array();
        return $x;

      //return $x->row_array();
    }
    function get_setting(){
        $x= $this->db->get("setting")->row_array();
        return $x;
    }
    public function teacher_by_employee_id($id)
    {
        $data=array('employee_id'=>$id);
        $x=$this->db->get_where('teacher',$data)->row_array();
        return $x['teacher_id'];
    }
    public function list_section_by_teacher_id($id)
    {
        $data = array('teacher_id' => $id);
        return $this->db->get_where('section', $data)->row_array();
    }
    function validate_s_login($user, $password){
       // $data= array('email' =>$user,'password' =>$password,'status' => 1 );
        $x= $this->db->select("*")->where('email',$user)
                                    ->or_where('guardian_mobile',$user)
                                    ->where('password',$password)
                                    ->where('status',1)->get('guardian');
        //$x= $this->db->get_where("guardian",$data)->row_array();
        return $x->row_array();
    }

}