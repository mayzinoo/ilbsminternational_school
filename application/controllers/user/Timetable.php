<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timetable extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('auth');
        $this->auth->is_logged_in_user();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Time_table');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        $class_id = $student['class_id'];
        $section_id = $student['section_id'];
        $data['title'] = 'Exam Marks';
        $data['class_id'] = $class_id;
        $data['section_id'] = $section_id;
        $result_subjects = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        $getDaysnameList = $this->customlib->getDaysname();
        $data['getDaysnameList'] = $getDaysnameList;
        $this->db->select("class_time.*,classes.class,sections.section,sessions.session");
            $this->db->join("classes","classes.id=class_time.class_id","left");
            $this->db->join("sections","sections.id=class_time.section_id","left");
            $this->db->join("sessions","sessions.id=class_time.academic_year","left");
            $this->db->where("class_time.class_id",$class_id);
            $this->db->where("class_time.section_id",$section_id);
            $data["lists"]=$this->db->get("class_time");
            
            $this->load->view('layout/student/header', $data);
            $this->load->view('student/timetable/timetableList', $data);
            $this->load->view('layout/student/footer', $data);
    }
    
    function viewdetail()
    {
            $class_id = $this->uri->segment(4);
            $section_id = $this->uri->segment(5);
            $class = $this->class_model->get();
            $data['classlist'] = $class;
            // $this->db->select("class_time.*,timetables.*,subjects.name");
            // $this->db->join("timetables","class_time.id=timetables.theader_id","");
            // $this->db->where("class_time.class_id",$class_id);
            // $this->db->where("class_time.section_id",$section_id);
            // $data['result'] = $this->db->get("class_time");
           
            $data["time"]=$this->db->query("SELECT * FROM class_time WHERE class_id='$class_id' AND section_id='$section_id' ORDER BY id DESC LIMIT 1")->row();
            $tid=$data["time"]->id; 
            $data["lists"]=$this->db->order_by("id","ASC")->get_where("timetables",array("theader_id"=>$tid));
            
            $this->load->view('layout/student/header', $data);
            $this->load->view('student/timetable/timetableSearch', $data);
            $this->load->view('layout/student/footer', $data);
    }

}

?>