<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('message', 'english');
        $this->load->library('auth');
        $this->auth->is_logged_in_parent();
    }

    public function index($id = NULL) {
        $data = array();
        $stuid=$id;
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'route/index');
        $listroute = $this->vehroute_model->listroute($stuid);
        $data['listroute'] = $listroute;
        
 /*get student's route*/       
        $stuid=$this->uri->segment(4);
        $this->db->select("student_session.*,vehicles.*,transport_route.*");
        $this->db->join('vehicle_routes', 'student_session.vehroute_id = vehicle_routes.id');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id');
        $this->db->join('transport_route', 'transport_route.id = vehicle_routes.route_id');
        $data['sturoute']=$this->db->get_where("student_session",array("student_session.student_id"=>$stuid))->row();
 /*end*/  
        $child = $this->session->userdata('parent_childs');
        $student_array = array();
        foreach ($child as $key => $value) {

            $student = $this->student_model->get($value['student_id']);
            $student_array[] = $student;
        }
        $data['childs'] = $student_array;
        $this->load->view('layout/parent/header');
        $this->load->view('parent/route/index', $data);
        $this->load->view('layout/student/footer');
    }

    public function getbusdetail() {
        $vehrouteid = $this->input->post('vehrouteid');
        $result = $this->vehroute_model->getVechileDetailByVecRouteID($vehrouteid);
        echo json_encode($result);
    }

}

?>