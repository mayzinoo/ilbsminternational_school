<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
    }
    function index(){
        
        $data['classlists'] = $this->Common_model->grab_class();

        $this->load->view("guest/guest_create",$data);
    }
    function guest_insert()
    {
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $nrcno=$this->input->post("nrcno");
        $address=$this->input->post("address");
        $class=$this->input->post("class");
        $cardno=$this->input->post("cardno");
        $c="";
        foreach($class as $cl):
            $c.=$cl.",";
        endforeach;
        $remark=$this->input->post("remark");    
        $data['classlists'] = $this->Common_model->grab_class();

        $data=array(
            "name"=>$name,
            "phone"=>$phone,
            "nrcno"=>$nrcno,
            "cardno"=>$cardno,
            "address"=>$address,
            "class"=>$c,
            "remark"=>$remark,
            "intime"=>date('Y-m-d H:i:s')
            );
            
        $this->db->insert("guest",$data);
       
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Successfully Register</div>');
        redirect("Guest/index");
        
    }
    function guestlist()
    {
        $this->session->set_userdata('top_menu', 'Info Center');
        $this->session->set_userdata('sub_menu', 'guest/guestlist');
        
        
        $data['guestdata']=$this->db->get("guest");
        
        $this->load->view('layout/header', $data);
        $this->load->view('guest/guestlist', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>