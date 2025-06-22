<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timetable extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Common_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'timetable/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data["academic_year"]=$this->setting_model->getCurrentSessionid();
        $data["inter_class"]=$this->Common_model->grab_inter_class();

        $data['time']=$this->db->get("class_time");
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $data["session_lists"]=$this->teachersubject_model->get_session();
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->db->select("class_time.*,classes.class,sections.section,sessions.session");
            $this->db->join("classes","classes.id=class_time.class_id","left");
            $this->db->join("sections","sections.id=class_time.section_id","left");
            $this->db->join("sessions","sessions.id=class_time.academic_year","left");
            $data["lists"]=$this->db->get("class_time");
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $inter_class = $this->input->post('inter_class');
            $academic_year=$this->input->post("academic_year");
            $data["academic_year"]=$academic_year;
            $this->db->select("class_time.*,classes.class,sections.section,sessions.session");
            $this->db->join("classes","classes.id=class_time.class_id","left");
            $this->db->join("sections","sections.id=class_time.section_id","left");
            $this->db->join("sessions","sessions.id=class_time.academic_year","left");
            $this->db->where("class_time.class_id",$class_id);
            if($inter_class!="")
            {
                $this->db->where("class_time.inter_class",$inter_class);

            }
            $this->db->where("class_time.section_id",$section_id);
            if($academic_year != "")
            {
            $this->db->where("class_time.academic_year",$academic_year);
            }
            $data["lists"]=$this->db->get("class_time");
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableList', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    function viewdetail()
    {
             $id=$this->uri->segment(4);
             $class_id=$this->uri->segment(5);
            $section_id=$this->uri->segment(6);
            $class = $this->class_model->get();
            $data['classlist'] = $class;
            $data['academic_year']='';
            $data["session_lists"]=$this->teachersubject_model->get_session();
            // $this->db->select("class_time.*,timetables.*,subjects.name");
            // $this->db->join("timetables","class_time.id=timetables.theader_id","");
            // $this->db->where("class_time.class_id",$class_id);
            // $this->db->where("class_time.section_id",$section_id);
            // $data['result'] = $this->db->get("class_time");
            $data["inter_class"]=$this->Common_model->grab_inter_class();

            $data["time"]=$this->db->query("SELECT * FROM class_time WHERE id='$id'")->row();
            $tid=$data["time"]->id; 
            
            $data["lists"]=$this->db->order_by("id","ASC")->get_where("timetables",array("theader_id"=>$tid));
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableSearch', $data);
            $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Timetable List';
        $id=$this->uri->segment(4);
        $this->db->where("id",$id);
        $qry=$this->db->delete("class_time");
        if($qry)
        {
            $this->db->where("theader_id",$id);
            $this->db->delete("timetables");
        }
        redirect('admin/timetable/index');
    }

    function create() {
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['subject_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['time']=$this->db->get("class_time");
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data["session_lists"]=$this->teachersubject_model->get_session();
        $data["inter_class"]=$this->Common_model->grab_inter_class();

        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        // $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id = $this->input->post('feecategory_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $inter_class = $this->input->post('inter_class');
            $academic_year=$this->input->post('academic_year');
            $data["subjects"]=$this->teachersubject_model->getSubject($class_id,$section_id);
            $data["teachers"]=$this->teachersubject_model->grab_teacher();
            // echo $data["subjects"]->num_rows(); exit;
            $data['result_subjects'] = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
            $data["class_id"]=$class_id;
            $data["section_id"]=$section_id;
            $data["inter_class"]=$inter_class;
            $data["academic_year"]=$academic_year;
            $getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreate', $data);
            $this->load->view('layout/footer', $data);
        }
     }
     
     function edit() {
        
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['result_subjects'] = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        $data["session_lists"]=$this->teachersubject_model->get_session();   
        $id=$this->uri->segment(4);
        $class_id=$this->uri->segment(5);
        $section_id=$this->uri->segment(6);
        $session = $this->setting_model->getCurrentSession();
          $class = $this->class_model->get();
          $data["academic_year"]=$this->setting_model->getCurrentSessionid();
        $data["inter_class"]=$this->Common_model->grab_inter_class();

$data["classlist"]=$class;
$data["session_lists"]=$this->teachersubject_model->get_session();
        $this->db->where("class_time.id",$id);
        $time=$this->db->get("class_time");
        $data["time"]=$time->row();
        $data["lists"]=$this->db->order_by("id","ASC")->get_where("timetables",array("theader_id"=>$id));
        $getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $data["id"]=$id;
        $data['class_id'] = $class_id;
        $data['section_id'] = $section_id;
        $data["teachers"]=$this->teachersubject_model->grab_teacher();
        $data["subjects"]=$this->teachersubject_model->getSubject($class_id,$section_id);
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/timetableEdit', $data);
        $this->load->view('layout/footer', $data);
        }
     
     
     function insert_timetable()
     {
         $class_id=$this->input->post("class_id");
         $section_id=$this->input->post("section_id"); 
         $inter_class=$this->input->post("inter_class"); 
         $academic_year=$this->input->post("academic_year");
         $data=array();
         $data['class_id']=$class_id;
         $data['section_id']=$section_id;
         $data['inter_class']=$inter_class;
         $data["created_at"]=date("Y-m-d");
         $data["academic_year"]=$academic_year;
         
         for($i=1; $i<10;$i++)
         {
             $start_time=$this->input->post("timestart".$i);
             $end_time=$this->input->post("timeend".$i);
             $data['start_time'.$i]=$start_time;
             $data['end_time'.$i]=$end_time;
         }
         
         
         $qry=$this->db->insert("class_time",$data);
         $timetable_id=$this->db->insert_id();
         if($qry)
            {
                
                if($this->input->post("Monday")!="")
                {
                    
                    $Mondaysec1=$this->input->post("Mondaysec1");
                    $Mondaysec2=$this->input->post("Mondaysec2");
                    $Mondaysec3=$this->input->post("Mondaysec3");
                    $Mondaysec4=$this->input->post("Mondaysec4");
                    $Mondaysec5=$this->input->post("Mondaysec5");
                    $Mondaysec6=$this->input->post("Mondaysec6");
                    $Mondaysec7=$this->input->post("Mondaysec7");
                    $Mondaysec8=$this->input->post("Mondaysec8");
                    $Mondaysec9=$this->input->post("Mondaysec9");
                    
                    $Mondaytec1=$this->input->post("Mondaytec1");
                    $Mondaytec2=$this->input->post("Mondaytec2");
                    $Mondaytec3=$this->input->post("Mondaytec3");
                    $Mondaytec4=$this->input->post("Mondaytec4");
                    $Mondaytec5=$this->input->post("Mondaytec5");
                    $Mondaytec6=$this->input->post("Mondaytec6");
                    $Mondaytec7=$this->input->post("Mondaytec7");
                    $Mondaytec8=$this->input->post("Mondaytec8");
                    $Mondaytec9=$this->input->post("Mondaytec9");

                    
                }
                else
                {
                    
                    $Mondaysec1="";
                    $Mondaysec2="";
                    $Mondaysec3="";
                    $Mondaysec4="";
                    $Mondaysec5="";
                    $Mondaysec6="";
                    $Mondaysec7="";
                    $Mondaysec8="";
                    $Mondaysec9="";
                    
                    $Mondaytec1="";
                    $Mondaytec2="";
                    $Mondaytec3="";
                    $Mondaytec4="";
                    $Mondaytec5="";
                    $Mondaytec6="";
                    $Mondaytec7="";
                    $Mondaytec8="";
                    $Mondaytec9="";
                    
                }
                
                $secdata1=array("theader_id"=>$timetable_id,
                            "day_name"=>"Monday",
                            "sec1"=>$Mondaysec1,
                            "sec2"=>$Mondaysec2,
                            "sec3"=>$Mondaysec3,
                            "sec4"=>$Mondaysec4,
                            "sec5"=>$Mondaysec5,
                            "sec6"=>$Mondaysec6,
                            "sec7"=>$Mondaysec7,
                            "sec8"=>$Mondaysec8,
                            "sec9"=>$Mondaysec9,
                            
                            "tec1"=>$Mondaytec1,
                            "tec2"=>$Mondaytec2,
                            "tec3"=>$Mondaytec3,
                            "tec4"=>$Mondaytec4,
                            "tec5"=>$Mondaytec5,
                            "tec6"=>$Mondaytec6,
                            "tec7"=>$Mondaytec7,
                            "tec8"=>$Mondaytec8,
                            "tec9"=>$Mondaytec9
                            );
                $q1=$this->db->insert("timetables",$secdata1);
                
                if($this->input->post("Tuesday")!="")
                {
                    
                    $Tuesdaysec1=$this->input->post("Tuesdaysec1");
                    $Tuesdaysec2=$this->input->post("Tuesdaysec2");
                    $Tuesdaysec3=$this->input->post("Tuesdaysec3");
                    $Tuesdaysec4=$this->input->post("Tuesdaysec4");
                    $Tuesdaysec5=$this->input->post("Tuesdaysec5");
                    $Tuesdaysec6=$this->input->post("Tuesdaysec6");
                    $Tuesdaysec7=$this->input->post("Tuesdaysec7");
                    $Tuesdaysec8=$this->input->post("Tuesdaysec8");
                    $Tuesdaysec9=$this->input->post("Tuesdaysec9");
                    
                    $Tuesdaytec1=$this->input->post("Tuesdaytec1");
                    $Tuesdaytec2=$this->input->post("Tuesdaytec2");
                    $Tuesdaytec3=$this->input->post("Tuesdaytec3");
                    $Tuesdaytec4=$this->input->post("Tuesdaytec4");
                    $Tuesdaytec5=$this->input->post("Tuesdaytec5");
                    $Tuesdaytec6=$this->input->post("Tuesdaytec6");
                    $Tuesdaytec7=$this->input->post("Tuesdaytec7");
                    $Tuesdaytec8=$this->input->post("Tuesdaytec8");
                    $Tuesdaytec9=$this->input->post("Tuesdaytec9");
                }
                else
                {
                    
                    $Tuesdaysec1="";
                    $Tuesdaysec2="";
                    $Tuesdaysec3="";
                    $Tuesdaysec4="";
                    $Tuesdaysec5="";
                    $Tuesdaysec6="";
                    $Tuesdaysec7="";
                    $Tuesdaysec8="";
                    $Tuesdaysec9="";

                    $Tuesdaytec1="";
                    $Tuesdaytec2="";
                    $Tuesdaytec3="";
                    $Tuesdaytec4="";
                    $Tuesdaytec5="";
                    $Tuesdaytec6="";
                    $Tuesdaytec7="";
                    $Tuesdaytec8="";
                    $Tuesdaytec9="";
                    
                }
                
                $secdata2=array("theader_id"=>$timetable_id,
                            "day_name"=>"Tuesday",
                            "sec1"=>$Tuesdaysec1,
                            "sec2"=>$Tuesdaysec2,
                            "sec3"=>$Tuesdaysec3,
                            "sec4"=>$Tuesdaysec4,
                            "sec5"=>$Tuesdaysec5,
                            "sec6"=>$Tuesdaysec6,
                            "sec7"=>$Tuesdaysec7,
                            "sec8"=>$Tuesdaysec8,
                            "sec9"=>$Tuesdaysec9,
                            "tec1"=>$Tuesdaytec1,
                            "tec2"=>$Tuesdaytec2,
                            "tec3"=>$Tuesdaytec3,
                            "tec4"=>$Tuesdaytec4,
                            "tec5"=>$Tuesdaytec5,
                            "tec6"=>$Tuesdaytec6,
                            "tec7"=>$Tuesdaytec7,
                            "tec8"=>$Tuesdaytec8,
                            "tec9"=>$Tuesdaytec9
                            );
                $q2=$this->db->insert("timetables",$secdata2);
                
                if($this->input->post("Wednesday")!="")
                {
                    
                    $Wednesdaysec1=$this->input->post("Wednesdaysec1");
                    $Wednesdaysec2=$this->input->post("Wednesdaysec2");
                    $Wednesdaysec3=$this->input->post("Wednesdaysec3");
                    $Wednesdaysec4=$this->input->post("Wednesdaysec4");
                    $Wednesdaysec5=$this->input->post("Wednesdaysec5");
                    $Wednesdaysec6=$this->input->post("Wednesdaysec6");
                    $Wednesdaysec7=$this->input->post("Wednesdaysec7");
                    $Wednesdaysec8=$this->input->post("Wednesdaysec8");
                    $Wednesdaysec9=$this->input->post("Wednesdaysec9");
                    
                    $Wednesdaytec1=$this->input->post("Wednesdaytec1");
                    $Wednesdaytec2=$this->input->post("Wednesdaytec2");
                    $Wednesdaytec3=$this->input->post("Wednesdaytec3");
                    $Wednesdaytec4=$this->input->post("Wednesdaytec4");
                    $Wednesdaytec5=$this->input->post("Wednesdaytec5");
                    $Wednesdaytec6=$this->input->post("Wednesdaytec6");
                    $Wednesdaytec7=$this->input->post("Wednesdaytec7");
                    $Wednesdaytec8=$this->input->post("Wednesdaytec8");
                    $Wednesdaytec9=$this->input->post("Wednesdaytec9");
                }
                else
                {
                    
                    $Wednesdaysec1="";
                    $Wednesdaysec2="";
                    $Wednesdaysec3="";
                    $Wednesdaysec4="";
                    $Wednesdaysec5="";
                    $Wednesdaysec6="";
                    $Wednesdaysec7="";
                    $Wednesdaysec8="";
                    $Wednesdaysec9="";
                    
                    $Wednesdaytec1="";
                    $Wednesdaytec2="";
                    $Wednesdaytec3="";
                    $Wednesdaytec4="";
                    $Wednesdaytec5="";
                    $Wednesdaytec6="";
                    $Wednesdaytec7="";
                    $Wednesdaytec8="";
                    $Wednesdaytec9="";
                }
                
                $secdata3=array("theader_id"=>$timetable_id,
                            "day_name"=>"Wednesday",
                            "sec1"=>$Wednesdaysec1,
                            "sec2"=>$Wednesdaysec2,
                            "sec3"=>$Wednesdaysec3,
                            "sec4"=>$Wednesdaysec4,
                            "sec5"=>$Wednesdaysec5,
                            "sec6"=>$Wednesdaysec6,
                            "sec7"=>$Wednesdaysec7,
                            "sec8"=>$Wednesdaysec8,
                            "sec9"=>$Wednesdaysec9,
                            "tec1"=>$Wednesdaytec1,
                            "tec2"=>$Wednesdaytec2,
                            "tec3"=>$Wednesdaytec3,
                            "tec4"=>$Wednesdaytec4,
                            "tec5"=>$Wednesdaytec5,
                            "tec6"=>$Wednesdaytec6,
                            "tec7"=>$Wednesdaytec7,
                            "tec8"=>$Wednesdaytec8,
                            "tec9"=>$Wednesdaytec9
                            );
                $q3=$this->db->insert("timetables",$secdata3);
                
                if($this->input->post("Thursday")!="")
                {
                    
                    $Thursdaysec1=$this->input->post("Thursdaysec1");
                    $Thursdaysec2=$this->input->post("Thursdaysec2");
                    $Thursdaysec3=$this->input->post("Thursdaysec3");
                    $Thursdaysec4=$this->input->post("Thursdaysec4");
                    $Thursdaysec5=$this->input->post("Thursdaysec5");
                    $Thursdaysec6=$this->input->post("Thursdaysec6");
                    $Thursdaysec7=$this->input->post("Thursdaysec7");
                    $Thursdaysec8=$this->input->post("Thursdaysec8");
                    $Thursdaysec9=$this->input->post("Thursdaysec9");
                    
                    $Thursdaytec1=$this->input->post("Thursdaytec1");
                    $Thursdaytec2=$this->input->post("Thursdaytec2");
                    $Thursdaytec3=$this->input->post("Thursdaytec3");
                    $Thursdaytec4=$this->input->post("Thursdaytec4");
                    $Thursdaytec5=$this->input->post("Thursdaytec5");
                    $Thursdaytec6=$this->input->post("Thursdaytec6");
                    $Thursdaytec7=$this->input->post("Thursdaytec7");
                    $Thursdaytec8=$this->input->post("Thursdaytec8");
                    $Thursdaytec9=$this->input->post("Thursdaytec9");
                    
                }
                else
                {
                    
                    $Thursdaysec1="";
                    $Thursdaysec2="";
                    $Thursdaysec3="";
                    $Thursdaysec4="";
                    $Thursdaysec5="";
                    $Thursdaysec6="";
                    $Thursdaysec7="";
                    $Thursdaysec8="";
                    $Thursdaysec9="";
                    
                    $Thursdaytec1="";
                    $Thursdaytec2="";
                    $Thursdaytec3="";
                    $Thursdaytec4="";
                    $Thursdaytec5="";
                    $Thursdaytec6="";
                    $Thursdaytec7="";
                    $Thursdaytec8="";
                    $Thursdaytec9="";
                }
                
                $secdata4=array("theader_id"=>$timetable_id,
                            "day_name"=>"Thursday",
                            "sec1"=>$Thursdaysec1,
                            "sec2"=>$Thursdaysec2,
                            "sec3"=>$Thursdaysec3,
                            "sec4"=>$Thursdaysec4,
                            "sec5"=>$Thursdaysec5,
                            "sec6"=>$Thursdaysec6,
                            "sec7"=>$Thursdaysec7,
                            "sec8"=>$Thursdaysec8,
                            "sec9"=>$Thursdaysec9,
                            "tec1"=>$Thursdaytec1,
                            "tec2"=>$Thursdaytec2,
                            "tec3"=>$Thursdaytec3,
                            "tec4"=>$Thursdaytec4,
                            "tec5"=>$Thursdaytec5,
                            "tec6"=>$Thursdaytec6,
                            "tec7"=>$Thursdaytec7,
                            "tec8"=>$Thursdaytec8,
                            "tec9"=>$Thursdaytec9
                            );
                $q4=$this->db->insert("timetables",$secdata4);
                
                if($this->input->post("Friday")!="")
                {
                    
                    $Fridaysec1=$this->input->post("Fridaysec1");
                    $Fridaysec2=$this->input->post("Fridaysec2");
                    $Fridaysec3=$this->input->post("Fridaysec3");
                    $Fridaysec4=$this->input->post("Fridaysec4");
                    $Fridaysec5=$this->input->post("Fridaysec5");
                    $Fridaysec6=$this->input->post("Fridaysec6");
                    $Fridaysec7=$this->input->post("Fridaysec7");
                    $Fridaysec8=$this->input->post("Fridaysec8");
                    $Fridaysec9=$this->input->post("Fridaysec9");

                    $Fridaytec1=$this->input->post("Fridaytec1");
                    $Fridaytec2=$this->input->post("Fridaytec2");
                    $Fridaytec3=$this->input->post("Fridaytec3");
                    $Fridaytec4=$this->input->post("Fridaytec4");
                    $Fridaytec5=$this->input->post("Fridaytec5");
                    $Fridaytec6=$this->input->post("Fridaytec6");
                    $Fridaytec7=$this->input->post("Fridaytec7");
                    $Fridaytec8=$this->input->post("Fridaytec8");
                    $Fridaytec9=$this->input->post("Fridaytec9");
                }
                else
                {
                    
                    $Fridaysec1="";
                    $Fridaysec2="";
                    $Fridaysec3="";
                    $Fridaysec4="";
                    $Fridaysec5="";
                    $Fridaysec6="";
                    $Fridaysec7="";
                    $Fridaysec8="";
                    $Fridaysec9="";
                    
                    $Fridaytec1="";
                    $Fridaytec2="";
                    $Fridaytec3="";
                    $Fridaytec4="";
                    $Fridaytec5="";
                    $Fridaytec6="";
                    $Fridaytec7="";
                    $Fridaytec8="";
                    $Fridaytec9="";
                }
                
                
                $secdata5=array("theader_id"=>$timetable_id,
                            "day_name"=>"Friday",
                            "sec1"=>$Fridaysec1,
                            "sec2"=>$Fridaysec2,
                            "sec3"=>$Fridaysec3,
                            "sec4"=>$Fridaysec4,
                            "sec5"=>$Fridaysec5,
                            "sec6"=>$Fridaysec6,
                            "sec7"=>$Fridaysec7,
                            "sec8"=>$Fridaysec8,
                            "sec9"=>$Fridaysec9,
                            "tec1"=>$Fridaytec1,
                            "tec2"=>$Fridaytec2,
                            "tec3"=>$Fridaytec3,
                            "tec4"=>$Fridaytec4,
                            "tec5"=>$Fridaytec5,
                            "tec6"=>$Fridaytec6,
                            "tec7"=>$Fridaytec7,
                            "tec8"=>$Fridaytec8,
                            "tec9"=>$Fridaytec9
                            );
                $q5=$this->db->insert("timetables",$secdata5);
                
                if($this->input->post("Saturday")!="")
                {
                   
                    $Saturdaysec1=$this->input->post("Saturdaysec1");
                    $Saturdaysec2=$this->input->post("Saturdaysec2");
                    $Saturdaysec3=$this->input->post("Saturdaysec3");
                    $Saturdaysec4=$this->input->post("Saturdaysec4");
                    $Saturdaysec5=$this->input->post("Saturdaysec5");
                    $Saturdaysec6=$this->input->post("Saturdaysec6");
                    $Saturdaysec7=$this->input->post("Saturdaysec7");
                    $Saturdaysec8=$this->input->post("Saturdaysec8");
                    $Saturdaysec9=$this->input->post("Saturdaysec9");
                    
                    $Saturdaytec1=$this->input->post("Saturdaytec1");
                    $Saturdaytec2=$this->input->post("Saturdaytec2");
                    $Saturdaytec3=$this->input->post("Saturdaytec3");
                    $Saturdaytec4=$this->input->post("Saturdaytec4");
                    $Saturdaytec5=$this->input->post("Saturdaytec5");
                    $Saturdaytec6=$this->input->post("Saturdaytec6");
                    $Saturdaytec7=$this->input->post("Saturdaytec7");
                    $Saturdaytec8=$this->input->post("Saturdaytec8");
                    $Saturdaytec9=$this->input->post("Saturdaytec9");
                    
                }
                else
                {
                    
                    $Saturdaysec1="";
                    $Saturdaysec2="";
                    $Saturdaysec3="";
                    $Saturdaysec4="";
                    $Saturdaysec5="";
                    $Saturdaysec6="";
                    $Saturdaysec7="";
                    $Saturdaysec8="";
                    $Saturdaysec9="";
                    
                    $Saturdaytec1="";
                    $Saturdaytec2="";
                    $Saturdaytec3="";
                    $Saturdaytec4="";
                    $Saturdaytec5="";
                    $Saturdaytec6="";
                    $Saturdaytec7="";
                    $Saturdaytec8="";
                    $Saturdaytec9="";
                }
                
                
                $secdata6=array("theader_id"=>$timetable_id,
                            "day_name"=>"Saturday",
                            "sec1"=>$Saturdaysec1,
                            "sec2"=>$Saturdaysec2,
                            "sec3"=>$Saturdaysec3,
                            "sec4"=>$Saturdaysec4,
                            "sec5"=>$Saturdaysec5,
                            "sec6"=>$Saturdaysec6,
                            "sec7"=>$Saturdaysec7,
                            "sec8"=>$Saturdaysec8,
                            "sec9"=>$Saturdaysec9,
                            "tec1"=>$Saturdaytec1,
                            "tec2"=>$Saturdaytec2,
                            "tec3"=>$Saturdaytec3,
                            "tec4"=>$Saturdaytec4,
                            "tec5"=>$Saturdaytec5,
                            "tec6"=>$Saturdaytec6,
                            "tec7"=>$Saturdaytec7,
                            "tec8"=>$Saturdaytec8,
                            "tec9"=>$Saturdaytec9
                            );
                $q6=$this->db->insert("timetables",$secdata6);
                
                if($this->input->post("Sunday")!="")
                {
                    $Sundaysec1=$this->input->post("Sundaysec1");
                    $Sundaysec2=$this->input->post("Sundaysec2");
                    $Sundaysec3=$this->input->post("Sundaysec3");
                    $Sundaysec4=$this->input->post("Sundaysec4");
                    $Sundaysec5=$this->input->post("Sundaysec5");
                    $Sundaysec6=$this->input->post("Sundaysec6");
                    $Sundaysec7=$this->input->post("Sundaysec7");
                    $Sundaysec8=$this->input->post("Sundaysec8");
                    $Sundaysec9=$this->input->post("Sundaysec9");
                    
                    $Sundaytec1=$this->input->post("Sundaytec1");
                    $Sundaytec2=$this->input->post("Sundaytec2");
                    $Sundaytec3=$this->input->post("Sundaytec3");
                    $Sundaytec4=$this->input->post("Sundaytec4");
                    $Sundaytec5=$this->input->post("Sundaytec5");
                    $Sundaytec6=$this->input->post("Sundaytec6");
                    $Sundaytec7=$this->input->post("Sundaytec7");
                    $Sundaytec8=$this->input->post("Sundaytec8");
                    $Sundaytec9=$this->input->post("Sundaytec9");
                    
                    
                }
                else
                {
                   
                    $Sundaysec1="";
                    $Sundaysec2="";
                    $Sundaysec3="";
                    $Sundaysec4="";
                    $Sundaysec5="";
                    $Sundaysec6="";
                    $Sundaysec7="";
                    $Sundaysec8="";
                    $Sundaysec9="";
                    
                    $Sundaytec1="";
                    $Sundaytec2="";
                    $Sundaytec3="";
                    $Sundaytec4="";
                    $Sundaytec5="";
                    $Sundaytec6="";
                    $Sundaytec7="";
                    $Sundaytec8="";
                    $Sundaytec9="";
                }
                
                $secdata7=array("theader_id"=>$timetable_id,
                            "day_name"=>"Sunday",
                            "sec1"=>$Sundaysec1,
                            "sec2"=>$Sundaysec2,
                            "sec3"=>$Sundaysec3,
                            "sec4"=>$Sundaysec4,
                            "sec5"=>$Sundaysec5,
                            "sec6"=>$Sundaysec6,
                            "sec7"=>$Sundaysec7,
                            "sec8"=>$Sundaysec8,
                            "sec9"=>$Sundaysec9,
                            "tec1"=>$Sundaytec1,
                            "tec2"=>$Sundaytec2,
                            "tec3"=>$Sundaytec3,
                            "tec4"=>$Sundaytec4,
                            "tec5"=>$Sundaytec5,
                            "tec6"=>$Sundaytec6,
                            "tec7"=>$Sundaytec7,
                            "tec8"=>$Sundaytec8,
                            "tec9"=>$Sundaytec9
                            );
                $q7=$this->db->insert("timetables",$secdata7);
                if($q1 && $q2 && $q3 && $q4 && $q5 && $q6 && $q7)
                {
                    $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Timetable Edit successfully</div>');
                    redirect('admin/timetable/index');
                }
                else
                {
                //     $error = $this->db->error();
                //  if (isset($error['message'])) {
                //     echo $error['message'];
                // } 
                    redirect('admin/timetable/index');
                }
                
            }
     }
     
     
     function edit_timetable()
     {
         $id=$this->input->post("id");
         $class_id=$this->input->post("class_id");
         $section_id=$this->input->post("section_id"); 
         $inter_class=$this->input->post("inter_class"); 
         $academic_year=$this->input->post("academic_year");
         $data=array();
         $data['class_id']=$class_id;
         $data['section_id']=$section_id;
         $data['inter_class']=$inter_class;
         $data["updated_at"]=date("Y-m-d");
         $data["academic_year"]=$academic_year;
         for($i=1; $i<10;$i++)
         {
             $start_time=$this->input->post("timestart".$i);
             $end_time=$this->input->post("timeend".$i);
             $data['start_time'.$i]=$start_time;
             $data['end_time'.$i]=$end_time;
         }
         
         $this->db->where("id",$id);
         $qry=$this->db->update("class_time",$data);
         if($qry)
         {
             $this->db->where("theader_id",$id);
             $query=$this->db->delete("timetables");
         if($query)
            {
                if($this->input->post("Monday")!="")
                {
                    
                    $Mondaysec1=$this->input->post("Mondaysec1");
                    $Mondaysec2=$this->input->post("Mondaysec2");
                    $Mondaysec3=$this->input->post("Mondaysec3");
                    $Mondaysec4=$this->input->post("Mondaysec4");
                    $Mondaysec5=$this->input->post("Mondaysec5");
                    $Mondaysec6=$this->input->post("Mondaysec6");
                    $Mondaysec7=$this->input->post("Mondaysec7");
                    $Mondaysec8=$this->input->post("Mondaysec8");
                    $Mondaysec9=$this->input->post("Mondaysec9");
                    
                    $Mondaytec1=$this->input->post("Mondaytec1");
                    $Mondaytec2=$this->input->post("Mondaytec2");
                    $Mondaytec3=$this->input->post("Mondaytec3");
                    $Mondaytec4=$this->input->post("Mondaytec4");
                    $Mondaytec5=$this->input->post("Mondaytec5");
                    $Mondaytec6=$this->input->post("Mondaytec6");
                    $Mondaytec7=$this->input->post("Mondaytec7");
                    $Mondaytec8=$this->input->post("Mondaytec8");
                    $Mondaytec9=$this->input->post("Mondaytec9");
                    
                }
                else
                {
                    
                    $Mondaysec1="";
                    $Mondaysec2="";
                    $Mondaysec3="";
                    $Mondaysec4="";
                    $Mondaysec5="";
                    $Mondaysec6="";
                    $Mondaysec7="";
                    $Mondaysec8="";
                    $Mondaysec9="";
                    
                    $Mondaytec1="";
                    $Mondaytec2="";
                    $Mondaytec3="";
                    $Mondaytec4="";
                    $Mondaytec5="";
                    $Mondaytec6="";
                    $Mondaytec7="";
                    $Mondaytec8="";
                    $Mondaytec9="";
                }
                
                $secdata1=array("theader_id"=>$id,
                            "day_name"=>"Monday",
                            "sec1"=>$Mondaysec1,
                            "sec2"=>$Mondaysec2,
                            "sec3"=>$Mondaysec3,
                            "sec4"=>$Mondaysec4,
                            "sec5"=>$Mondaysec5,
                            "sec6"=>$Mondaysec6,
                            "sec7"=>$Mondaysec7,
                            "sec8"=>$Mondaysec8,
                            "sec9"=>$Mondaysec9,
                            "tec1"=>$Mondaytec1,
                            "tec2"=>$Mondaytec2,
                            "tec3"=>$Mondaytec3,
                            "tec4"=>$Mondaytec4,
                            "tec5"=>$Mondaytec5,
                            "tec6"=>$Mondaytec6,
                            "tec7"=>$Mondaytec7,
                            "tec8"=>$Mondaytec8,
                            "tec9"=>$Mondaytec9
                            );
                            
                $q1=$this->db->insert("timetables",$secdata1);
                
                if($this->input->post("Tuesday")!="")
                {
                    
                    $Tuesdaysec1=$this->input->post("Tuesdaysec1");
                    $Tuesdaysec2=$this->input->post("Tuesdaysec2");
                    $Tuesdaysec3=$this->input->post("Tuesdaysec3");
                    $Tuesdaysec4=$this->input->post("Tuesdaysec4");
                    $Tuesdaysec5=$this->input->post("Tuesdaysec5");
                    $Tuesdaysec6=$this->input->post("Tuesdaysec6");
                    $Tuesdaysec7=$this->input->post("Tuesdaysec7");
                    $Tuesdaysec8=$this->input->post("Tuesdaysec8");
                    $Tuesdaysec9=$this->input->post("Tuesdaysec9");
                    
                    $Tuesdaytec1=$this->input->post("Tuesdaytec1");
                    $Tuesdaytec2=$this->input->post("Tuesdaytec2");
                    $Tuesdaytec3=$this->input->post("Tuesdaytec3");
                    $Tuesdaytec4=$this->input->post("Tuesdaytec4");
                    $Tuesdaytec5=$this->input->post("Tuesdaytec5");
                    $Tuesdaytec6=$this->input->post("Tuesdaytec6");
                    $Tuesdaytec7=$this->input->post("Tuesdaytec7");
                    $Tuesdaytec8=$this->input->post("Tuesdaytec8");
                    $Tuesdaytec9=$this->input->post("Tuesdaytec9");
                    
                }
                else
                {
                    
                    $Tuesdaysec1="";
                    $Tuesdaysec2="";
                    $Tuesdaysec3="";
                    $Tuesdaysec4="";
                    $Tuesdaysec5="";
                    $Tuesdaysec6="";
                    $Tuesdaysec7="";
                    $Tuesdaysec8="";
                    $Tuesdaysec9="";
                    
                    $Tuesdaytec1="";
                    $Tuesdaytec2="";
                    $Tuesdaytec3="";
                    $Tuesdaytec4="";
                    $Tuesdaytec5="";
                    $Tuesdaytec6="";
                    $Tuesdaytec7="";
                    $Tuesdaytec8="";
                    $Tuesdaytec9="";
                }
                
                $secdata2=array("theader_id"=>$id,
                            "day_name"=>"Tuesday",
                            "sec1"=>$Tuesdaysec1,
                            "sec2"=>$Tuesdaysec2,
                            "sec3"=>$Tuesdaysec3,
                            "sec4"=>$Tuesdaysec4,
                            "sec5"=>$Tuesdaysec5,
                            "sec6"=>$Tuesdaysec6,
                            "sec7"=>$Tuesdaysec7,
                            "sec8"=>$Tuesdaysec8,
                            "sec9"=>$Tuesdaysec9,
                            "tec1"=>$Tuesdaytec1,
                            "tec2"=>$Tuesdaytec2,
                            "tec3"=>$Tuesdaytec3,
                            "tec4"=>$Tuesdaytec4,
                            "tec5"=>$Tuesdaytec5,
                            "tec6"=>$Tuesdaytec6,
                            "tec7"=>$Tuesdaytec7,
                            "tec8"=>$Tuesdaytec8,
                            "tec9"=>$Tuesdaytec9
                            );
                $q2=$this->db->insert("timetables",$secdata2);
                
                if($this->input->post("Wednesday")!="")
                {
                    
                    $Wednesdaysec1=$this->input->post("Wednesdaysec1");
                    $Wednesdaysec2=$this->input->post("Wednesdaysec2");
                    $Wednesdaysec3=$this->input->post("Wednesdaysec3");
                    $Wednesdaysec4=$this->input->post("Wednesdaysec4");
                    $Wednesdaysec5=$this->input->post("Wednesdaysec5");
                    $Wednesdaysec6=$this->input->post("Wednesdaysec6");
                    $Wednesdaysec7=$this->input->post("Wednesdaysec7");
                    $Wednesdaysec8=$this->input->post("Wednesdaysec8");
                    $Wednesdaysec9=$this->input->post("Wednesdaysec9");
                    
                    $Wednesdaytec1=$this->input->post("Wednesdaytec1");
                    $Wednesdaytec2=$this->input->post("Wednesdaytec2");
                    $Wednesdaytec3=$this->input->post("Wednesdaytec3");
                    $Wednesdaytec4=$this->input->post("Wednesdaytec4");
                    $Wednesdaytec5=$this->input->post("Wednesdaytec5");
                    $Wednesdaytec6=$this->input->post("Wednesdaytec6");
                    $Wednesdaytec7=$this->input->post("Wednesdaytec7");
                    $Wednesdaytec8=$this->input->post("Wednesdaytec8");
                    $Wednesdaytec9=$this->input->post("Wednesdaytec9");
                    
                }
                else
                {
                    
                    $Wednesdaysec1="";
                    $Wednesdaysec2="";
                    $Wednesdaysec3="";
                    $Wednesdaysec4="";
                    $Wednesdaysec5="";
                    $Wednesdaysec6="";
                    $Wednesdaysec7="";
                    $Wednesdaysec8="";
                    $Wednesdaysec9="";
                    
                    $Wednesdaytec1="";
                    $Wednesdaytec2="";
                    $Wednesdaytec3="";
                    $Wednesdaytec4="";
                    $Wednesdaytec5="";
                    $Wednesdaytec6="";
                    $Wednesdaytec7="";
                    $Wednesdaytec8="";
                    $Wednesdaytec9="";
                }
                
                $secdata3=array("theader_id"=>$id,
                            "day_name"=>"Wednesday",
                            "sec1"=>$Wednesdaysec1,
                            "sec2"=>$Wednesdaysec2,
                            "sec3"=>$Wednesdaysec3,
                            "sec4"=>$Wednesdaysec4,
                            "sec5"=>$Wednesdaysec5,
                            "sec6"=>$Wednesdaysec6,
                            "sec7"=>$Wednesdaysec7,
                            "sec8"=>$Wednesdaysec8,
                            "sec9"=>$Wednesdaysec9,
                            "tec1"=>$Wednesdaytec1,
                            "tec2"=>$Wednesdaytec2,
                            "tec3"=>$Wednesdaytec3,
                            "tec4"=>$Wednesdaytec4,
                            "tec5"=>$Wednesdaytec5,
                            "tec6"=>$Wednesdaytec6,
                            "tec7"=>$Wednesdaytec7,
                            "tec8"=>$Wednesdaytec8,
                            "tec9"=>$Wednesdaytec9
                            
                            );
                $q3=$this->db->insert("timetables",$secdata3);
                
                if($this->input->post("Thursday")!="")
                {
                    
                    $Thursdaysec1=$this->input->post("Thursdaysec1");
                    $Thursdaysec2=$this->input->post("Thursdaysec2");
                    $Thursdaysec3=$this->input->post("Thursdaysec3");
                    $Thursdaysec4=$this->input->post("Thursdaysec4");
                    $Thursdaysec5=$this->input->post("Thursdaysec5");
                    $Thursdaysec6=$this->input->post("Thursdaysec6");
                    $Thursdaysec7=$this->input->post("Thursdaysec7");
                    $Thursdaysec8=$this->input->post("Thursdaysec8");
                    $Thursdaysec9=$this->input->post("Thursdaysec9");
                    
                    $Thursdaytec1=$this->input->post("Thursdaytec1");
                    $Thursdaytec2=$this->input->post("Thursdaytec2");
                    $Thursdaytec3=$this->input->post("Thursdaytec3");
                    $Thursdaytec4=$this->input->post("Thursdaytec4");
                    $Thursdaytec5=$this->input->post("Thursdaytec5");
                    $Thursdaytec6=$this->input->post("Thursdaytec6");
                    $Thursdaytec7=$this->input->post("Thursdaytec7");
                    $Thursdaytec8=$this->input->post("Thursdaytec8");
                    $Thursdaytec9=$this->input->post("Thursdaytec9");
                    
                }
                else
                {
                    
                    $Thursdaysec1="";
                    $Thursdaysec2="";
                    $Thursdaysec3="";
                    $Thursdaysec4="";
                    $Thursdaysec5="";
                    $Thursdaysec6="";
                    $Thursdaysec7="";
                    $Thursdaysec8="";
                    $Thursdaysec9="";
                    
                    $Thursdaytec1="";
                    $Thursdaytec2="";
                    $Thursdaytec3="";
                    $Thursdaytec4="";
                    $Thursdaytec5="";
                    $Thursdaytec6="";
                    $Thursdaytec7="";
                    $Thursdaytec8="";
                    $Thursdaytec9="";
                }
                
                $secdata4=array("theader_id"=>$id,
                            "day_name"=>"Thursday",
                            "sec1"=>$Thursdaysec1,
                            "sec2"=>$Thursdaysec2,
                            "sec3"=>$Thursdaysec3,
                            "sec4"=>$Thursdaysec4,
                            "sec5"=>$Thursdaysec5,
                            "sec6"=>$Thursdaysec6,
                            "sec7"=>$Thursdaysec7,
                            "sec8"=>$Thursdaysec8,
                            "sec9"=>$Thursdaysec9,
                            "tec1"=>$Thursdaytec1,
                            "tec2"=>$Thursdaytec2,
                            "tec3"=>$Thursdaytec3,
                            "tec4"=>$Thursdaytec4,
                            "tec5"=>$Thursdaytec5,
                            "tec6"=>$Thursdaytec6,
                            "tec7"=>$Thursdaytec7,
                            "tec8"=>$Thursdaytec8,
                            "tec9"=>$Thursdaytec9
                            );
                $q4=$this->db->insert("timetables",$secdata4);
                
                if($this->input->post("Friday")!="")
                {
                    
                    $Fridaysec1=$this->input->post("Fridaysec1");
                    $Fridaysec2=$this->input->post("Fridaysec2");
                    $Fridaysec3=$this->input->post("Fridaysec3");
                    $Fridaysec4=$this->input->post("Fridaysec4");
                    $Fridaysec5=$this->input->post("Fridaysec5");
                    $Fridaysec6=$this->input->post("Fridaysec6");
                    $Fridaysec7=$this->input->post("Fridaysec7");
                    $Fridaysec8=$this->input->post("Fridaysec8");
                    $Fridaysec9=$this->input->post("Fridaysec9");
                    
                    $Fridaytec1=$this->input->post("Fridaytec1");
                    $Fridaytec2=$this->input->post("Fridaytec2");
                    $Fridaytec3=$this->input->post("Fridaytec3");
                    $Fridaytec4=$this->input->post("Fridaytec4");
                    $Fridaytec5=$this->input->post("Fridaytec5");
                    $Fridaytec6=$this->input->post("Fridaytec6");
                    $Fridaytec7=$this->input->post("Fridaytec7");
                    $Fridaytec8=$this->input->post("Fridaytec8");
                    $Fridaytec9=$this->input->post("Fridaytec9");
                    
                }
                else
                {
                    
                    $Fridaysec1="";
                    $Fridaysec2="";
                    $Fridaysec3="";
                    $Fridaysec4="";
                    $Fridaysec5="";
                    $Fridaysec6="";
                    $Fridaysec7="";
                    $Fridaysec8="";
                    $Fridaysec9="";
                    
                    $Fridaytec1="";
                    $Fridaytec2="";
                    $Fridaytec3="";
                    $Fridaytec4="";
                    $Fridaytec5="";
                    $Fridaytec6="";
                    $Fridaytec7="";
                    $Fridaytec8="";
                    $Fridaytec9="";
                }
                
                
                $secdata5=array("theader_id"=>$id,
                            "day_name"=>"Friday",
                            "sec1"=>$Fridaysec1,
                            "sec2"=>$Fridaysec2,
                            "sec3"=>$Fridaysec3,
                            "sec4"=>$Fridaysec4,
                            "sec5"=>$Fridaysec5,
                            "sec6"=>$Fridaysec6,
                            "sec7"=>$Fridaysec7,
                            "sec8"=>$Fridaysec8,
                            "sec9"=>$Fridaysec9,
                            "tec1"=>$Fridaytec1,
                            "tec2"=>$Fridaytec2,
                            "tec3"=>$Fridaytec3,
                            "tec4"=>$Fridaytec4,
                            "tec5"=>$Fridaytec5,
                            "tec6"=>$Fridaytec6,
                            "tec7"=>$Fridaytec7,
                            "tec8"=>$Fridaytec8,
                            "tec9"=>$Fridaytec9
                            );
                $q5=$this->db->insert("timetables",$secdata5);
                
                if($this->input->post("Saturday")!="")
                {
                   
                    $Saturdaysec1=$this->input->post("Saturdaysec1");
                    $Saturdaysec2=$this->input->post("Saturdaysec2");
                    $Saturdaysec3=$this->input->post("Saturdaysec3");
                    $Saturdaysec4=$this->input->post("Saturdaysec4");
                    $Saturdaysec5=$this->input->post("Saturdaysec5");
                    $Saturdaysec6=$this->input->post("Saturdaysec6");
                    $Saturdaysec7=$this->input->post("Saturdaysec7");
                    $Saturdaysec8=$this->input->post("Saturdaysec8");
                    $Saturdaysec9=$this->input->post("Saturdaysec9");
                    
                    $Saturdaytec1=$this->input->post("Saturdaytec1");
                    $Saturdaytec2=$this->input->post("Saturdaytec2");
                    $Saturdaytec3=$this->input->post("Saturdaytec3");
                    $Saturdaytec4=$this->input->post("Saturdaytec4");
                    $Saturdaytec5=$this->input->post("Saturdaytec5");
                    $Saturdaytec6=$this->input->post("Saturdaytec6");
                    $Saturdaytec7=$this->input->post("Saturdaytec7");
                    $Saturdaytec8=$this->input->post("Saturdaytec8");
                    $Saturdaytec9=$this->input->post("Saturdaytec9");
                    
                }
                else
                {
                    
                    $Saturdaysec1="";
                    $Saturdaysec2="";
                    $Saturdaysec3="";
                    $Saturdaysec4="";
                    $Saturdaysec5="";
                    $Saturdaysec6="";
                    $Saturdaysec7="";
                    $Saturdaysec8="";
                    $Saturdaysec9="";
                    
                    $Saturdaytec1="";
                    $Saturdaytec2="";
                    $Saturdaytec3="";
                    $Saturdaytec4="";
                    $Saturdaytec5="";
                    $Saturdaytec6="";
                    $Saturdaytec7="";
                    $Saturdaytec8="";
                    $Saturdaytec9="";
                }
                
                
                $secdata6=array("theader_id"=>$id,
                            "day_name"=>"Saturday",
                            "sec1"=>$Saturdaysec1,
                            "sec2"=>$Saturdaysec2,
                            "sec3"=>$Saturdaysec3,
                            "sec4"=>$Saturdaysec4,
                            "sec5"=>$Saturdaysec5,
                            "sec6"=>$Saturdaysec6,
                            "sec7"=>$Saturdaysec7,
                            "sec8"=>$Saturdaysec8,
                            "sec9"=>$Saturdaysec9,
                            "tec1"=>$Saturdaytec1,
                            "tec2"=>$Saturdaytec2,
                            "tec3"=>$Saturdaytec3,
                            "tec4"=>$Saturdaytec4,
                            "tec5"=>$Saturdaytec5,
                            "tec6"=>$Saturdaytec6,
                            "tec7"=>$Saturdaytec7,
                            "tec8"=>$Saturdaytec8,
                            "tec9"=>$Saturdaytec9
                            );
                $q6=$this->db->insert("timetables",$secdata6);
                
                if($this->input->post("Sunday")!="")
                {
                    
                    $Sundaysec1=$this->input->post("Sundaysec1");
                    $Sundaysec2=$this->input->post("Sundaysec2");
                    $Sundaysec3=$this->input->post("Sundaysec3");
                    $Sundaysec4=$this->input->post("Sundaysec4");
                    $Sundaysec5=$this->input->post("Sundaysec5");
                    $Sundaysec6=$this->input->post("Sundaysec6");
                    $Sundaysec7=$this->input->post("Sundaysec7");
                    $Sundaysec8=$this->input->post("Sundaysec8");
                    $Sundaysec9=$this->input->post("Sundaysec9");
                    
                    $Sundaytec1=$this->input->post("Sundaytec1");
                    $Sundaytec2=$this->input->post("Sundaytec2");
                    $Sundaytec3=$this->input->post("Sundaytec3");
                    $Sundaytec4=$this->input->post("Sundaytec4");
                    $Sundaytec5=$this->input->post("Sundaytec5");
                    $Sundaytec6=$this->input->post("Sundaytec6");
                    $Sundaytec7=$this->input->post("Sundaytec7");
                    $Sundaytec8=$this->input->post("Sundaytec8");
                    $Sundaytec9=$this->input->post("Sundaytec9");
                    
                }
                else
                {
                   
                    $Sundaysec1="";
                    $Sundaysec2="";
                    $Sundaysec3="";
                    $Sundaysec4="";
                    $Sundaysec5="";
                    $Sundaysec6="";
                    $Sundaysec7="";
                    $Sundaysec8="";
                    $Sundaysec9="";
                    
                    $Sundaytec1="";
                    $Sundaytec2="";
                    $Sundaytec3="";
                    $Sundaytec4="";
                    $Sundaytec5="";
                    $Sundaytec6="";
                    $Sundaytec7="";
                    $Sundaytec8="";
                    $Sundaytec9="";
                }
                
                $secdata7=array("theader_id"=>$id,
                            "day_name"=>"Sunday",
                            "sec1"=>$Sundaysec1,
                            "sec2"=>$Sundaysec2,
                            "sec3"=>$Sundaysec3,
                            "sec4"=>$Sundaysec4,
                            "sec5"=>$Sundaysec5,
                            "sec6"=>$Sundaysec6,
                            "sec7"=>$Sundaysec7,
                            "sec8"=>$Sundaysec8,
                            "sec9"=>$Sundaysec9,
                            "tec1"=>$Sundaytec1,
                            "tec2"=>$Sundaytec2,
                            "tec3"=>$Sundaytec3,
                            "tec4"=>$Sundaytec4,
                            "tec5"=>$Sundaytec5,
                            "tec6"=>$Sundaytec6,
                            "tec7"=>$Sundaytec7,
                            "tec8"=>$Sundaytec8,
                            "tec9"=>$Sundaytec9
                            
                            );
                $q7=$this->db->insert("timetables",$secdata7);
                if($q1 && $q2 && $q3 && $q4 && $q5 && $q6 && $q7)
                {
                    $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Timetable Edit successfully</div>');
                    redirect('admin/timetable/index');
                }
                
            }
         }
     }

    

}

?>