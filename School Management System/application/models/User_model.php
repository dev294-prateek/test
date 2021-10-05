<?php

if (!defined('BASEPATH'))
    exit('Ohhh... This is Cheating you are not suppose to do this.Cheater :)');
class User_model extends CI_Model {
    function update_profile_image($id, $image){
        $data = array('profile_image'=>$image);
        $this->db->where('user_id', $id);
        $x=$this->db->update('users', $data);
        return $x;
    }
    function profile($id){
        $data=array('user_id'=>$id);
        $x = $this->db->get_where('users',$data)->row_array();
        return $x ;
    }
    function sector_by_id($id){
        $data = array('sec_id'=>$id);
        $x = $this->db->get_where('sector',$data)->row_array();
        return $x;
    }
    /*----------------for venue listing in all venue page----------*/
    function all_venue(){
        $data =array('status'=>1 );
        $this->db->select('id');
        $this->db->select('location_id');
        $this->db->select('venue_name');
        $this->db->select('image');
        $this->db->select('image');
        $this->db->select('venue_type');
        $this->db->order_by("id", "asc");
        return $this->db->get_where('venue',$data)->result_array();
    }
    function location($id){
        $data =array('status'=>1 ,'id'=>$id);
        $this->db->select('name');
        $x=$this->db->get_where('location',$data)->row_array();
        return $x['name'];
    }
    function city($id){
        $data =array('status'=>1 ,'id'=>$id);
        $this->db->select('city');
        $x= $this->db->get_where('location',$data)->row_array();
        return $x['city'];
    }
    /*----------------End for venue listing in all venue page----------*/
    /*----------------for location listin in side bar----------*/
    function location_name()
    {
        $data = array('status' => 1);
        $this->db->select('id');
        $this->db->select('name');
        $x = $this->db->get_where('location', $data)->result_array();
        return $x;
    }
    function city_name()
    {
        $data = array('status' => 1);

        $this->db->distinct();
        $this->db->select('city');
        $x = $this->db->get_where('location', $data)->result_array();
        return $x;
    }
    function count_location($id){
        $data =array('status'=>1,'location_id'=>$id );
        return $this->db->get_where('venue',$data)->num_rows();
    }
    function count_venue_all(){
        $data =array('status'=>1 );
        return $this->db->get_where('venue',$data)->num_rows();
    }
    /*----------------End for location listin in side bar----------*/


    /*----------- Package  Item Listing----------*/
    function package_item_listing($data_prev){

        /*======================remove this section to get data by package id and replace  $data_prev by $data ==============================*/
        $data=array('package'=>1,
            'Type'=>$data_prev['Type'],
            'main_group'=>$data_prev['main_group'],
            'category'=>$data_prev['category'],
            'status'=>1);

        /*====================================================*/
        $this->db->select('id');
        $this->db->select('item');
        $this->db->select('price');
        $this->db->select('qty');
        return $this->db->get_where('package_item',$data)->result_array();
    }

    function venue_slider_by_venueid($id){
        $data= array('venue_id'=>$id);
        return $this->db->get_where('venue_slider',$data)->result_array();
    }
    function venue_single($id){
        $data= array('id'=>$id);
        return $this->db->get_where('venue',$data)->row_array();
    }
    function location_by_id($id){
        $data= array('id'=>$id);
        return $this->db->get_where('location',$data)->row_array();
    }
    function  all_venue_by_location_id($id=''){
        $data= array('location_id'=>$id);
        return $this->db->get_where('venue',$data)->result_array();
    }

}