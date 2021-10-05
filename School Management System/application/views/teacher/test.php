<?php
/*==================================================================*/
    /*                      EMPLOYEE  EXPERIENCE                     */
/*==================================================================*/
function add_experience(){
if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
$data=$this->input->post();
$this->teacher_model->add_emp_experience($data);
}
function experience($id=''){
$data['employee']=$this->teacher_model->list_employee_by_id($id);
$data['experience']=$this->teacher_model->list_emp_experience_by_employee_id($id);
$this->load->view('admin/employee/add_experience',$data);
}
function edit_experience($id=''){

$x=$data['experience']=$this->teacher_model->list_emp_experience_by_experience_id($id);
$data['employee']=$this->teacher_model->list_employee_by_id($x['employee_id']);
$this->load->view('admin/employee/edit_experience',$data);
}
function update_experience(){
if ($_SESSION["user_role"] != 'admin') redirect(base_url() . "login", 'refresh');
$data=$this->input->post();
$this->teacher_model->update_experience($data);
print_r($data);
}
function delete_experience(){
$data=$this->input->post('id');
if($this->teacher_model->delete_experience($data));
{echo $data;}
}