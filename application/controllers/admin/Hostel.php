<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hostel extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->helper('file');
        $this->role;
        $this->load->model("Studentfee_model");
        $this->load->model("Common_model");
        $this->load->model("Mymodel");
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Hostel');
        $this->session->set_userdata('sub_menu', 'hostel/index');
        $listhostel = $this->hostel_model->listhostel();
        $data['listhostel'] = $listhostel;
        $ght = $this->customlib->getHostaltype();
        $data['ght'] = $ght;
        $this->load->view('layout/header');
        $this->load->view('admin/hostel/createhostel', $data);
        $this->load->view('layout/footer');
    }

    function create() {
        $data['title'] = 'Add Library';
        $this->form_validation->set_rules('hostel_name', 'Hostel Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listhostel = $this->hostel_model->listhostel();
            $data['listhostel'] = $listhostel;
            $ght = $this->customlib->getHostaltype();
            $data['ght'] = $ght;
            $this->load->view('layout/header');
            $this->load->view('admin/hostel/createhostel', $data);
            $this->load->view('layout/footer');
            
            
        } else {
            $warden=$this->input->post('warden-techr');
            $wardenphone=$this->input->post("warden-phone");
            $guide=$this->input->post('guide-techr');
            $guidephone=$this->input->post("guide-phone");
            
            $wardentechr="";
		    	for($i=0;$i<count($warden);$i++)
		    	{
		    		$wardentechr .= $warden[$i]."]".$wardenphone[$i]."]";
		    	}
		    $guidetechr="";
		    	for($i=0;$i<count($guide);$i++)
		    	{
		    		$guidetechr .= $guide[$i]."]".$guidephone[$i]."]";
		    	}
		    
            $data = array(
                'hostel_name' => $this->input->post('hostel_name'),
                'type' => $this->input->post('type'),
                'address' => $this->input->post('address'),
                'intake' => $this->input->post('intake'),
                'description' => $this->input->post('description'),
                'hostel_warden' => $wardentechr,
                'guide_teacher' => $guidetechr
            );
            $this->hostel_model->addhostel($data);
          
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Hostel added successfully</div>');
            redirect('admin/hostel/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Add Hostel';
        $data['id'] = $id;
        $edithostel = $this->hostel_model->get($id);
        $data['edithostel'] = $edithostel;
        $ght = $this->customlib->getHostaltype();
        $data['ght'] = $ght;
        $this->form_validation->set_rules('hostel_name', 'Hostel Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listhostel = $this->hostel_model->listhostel();
            $data['listhostel'] = $listhostel;
            $this->load->view('layout/header');
            $this->load->view('admin/hostel/edithostel', $data);
            $this->load->view('layout/footer');
        } else {
            $warden=$this->input->post('warden-techr');
            $wardenphone=$this->input->post("warden-phone");
            $guide=$this->input->post('guide-techr');
            $guidephone=$this->input->post("guide-phone");
            
            $wardentechr="";
		    	for($i=0;$i<count($warden);$i++)
		    	{
		    		$wardentechr .= $warden[$i].",".$wardenphone[$i]."]";
		    	}
		    $guidetechr="";
		    	for($i=0;$i<count($guide);$i++)
		    	{
		    		$guidetechr .= $guide[$i].",".$guidephone[$i]."]";
		    	}
            $data = array(
                'id' => $this->input->post('id'),
                'hostel_name' => $this->input->post('hostel_name'),
                'type' => $this->input->post('type'),
                'address' => $this->input->post('address'),
                'intake' => $this->input->post('intake'),
                'description' => $this->input->post('description'),
                'hostel_warden' => $wardentechr,
                'guide_teacher' => $guidetechr
                
            );
            $this->hostel_model->addhostel($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Hostel updated successfully</div>');
            redirect('admin/hostel/index');
        }
    }
    function studentroom_list()
    {
        $this->db->select("student_room.*,hostel.*,students.*,student_room.id as stuid,hostel.hostel_name as hostel");
        $this->db->join("hostel","hostel.id=student_room.hostel_id");
        $this->db->join("students","student_room.student_id=students.id");
        // $this->db->join("classes","classes.id=student_room.class_id");
        // $this->db->join("sections","sections.id=student_room.section_id");
        // $this->db->join("hostel","hostel.id=student_room.hostel_id","left");
        $this->db->order_by("student_room.class_id","desc");
        $data["studentroomlist"]=$this->db->get("student_room");
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/hostel/studentroomlist', $data);
        $this->load->view('layout/footer', $data);
    }
    function studentsroom()
    {
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'admin/Hostel/studentsroom');
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data["school"]=$this->Common_model->grab_school();

        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/hostel/studentsroomSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $resign = $this->input->post('resign');
            $school = $this->input->post('school');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                 //   $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                   // if ($this->form_validation->run() == FALSE) {
                        
                   // } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                    
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchByClassSection($class, $section,$resign,$school);
                        $data['resultlist'] = $resultlist;
                        $title=$this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title'] = 'Student Details for '.$title['class']."(".$title['section'].")";
                   // } 
                    $data["hostellist"]=$this->student_model->gethostel();
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";
                   
                    $data['search_text'] = trim($this->input->post('search_text'));
                    $resultlist = $this->student_model->searchFullText($search_text);
				    $data["exams"]=$this->db->order_by("id","ASC")->get("exams");
                
                   $data["rpcards"]=$this->db->query("SELECT exam_results.*,exam_schedules.* FROM exam_results JOIN exam_schedules
                            ON exam_results.exam_schedule_id=exam_schedules.id  WHERE 
                            exam_results.student_id='$id'");
					
                    $data['resultlist'] = $resultlist;
                    $data['title'] = 'Search Details: '.$data['search_text'];
                }
            }
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/hostel/studentsroomSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    function studentroom_insert()
    {
        $student_id=$this->input->post("student_id");          
        // $class=$this->session->userdata("class");
        // echo $class;exit;
        // $section=$this->session->userdata("section");
        $class=$this->input->post("class_id");
        $section=$this->input->post("section_id");
        $hostelname=$this->input->post("hostelname");
        $roomno=$this->input->post("roomno");
        $date=date("Y-m-d",strtotime($this->input->post("date")));	
        
       
        for($i=0;$i<count($student_id);$i++)
        {
            if($hostelname[$i]=="" && $roomno[$i]==""){
                
            }
            else{
                 $roomdata=array(
                    "class_id"=>$class[$i],
                    "section_id"=>$section[$i],
                    "student_id"=>$student_id[$i],
                    "hostel_id"=>$hostelname[$i],
                    "room_no"=>$roomno[$i],
                    "created_at"=>$date
                    );
            }
            $this->db->insert("student_room",$roomdata);
        }
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Students Room added successfully</div>');
          redirect('admin/hostel/studentroom_list');
    }
    function detail()
    {
        $id=$this->uri->segment(4);
        
        $this->session->set_userdata('top_menu', 'Hostel');
        $this->session->set_userdata('sub_menu', 'hostel/index');
        $data['hosteldata']=$this->db->get_where("hostel",array("id"=>$id))->row();
        
        
        $listhostel = $this->hostel_model->listhostel();
        $data['listhostel'] = $listhostel;
        $ght = $this->customlib->getHostaltype();
        $data['ght'] = $ght;
        $this->load->view('layout/header');
        $this->load->view('admin/hostel/detail', $data);
        $this->load->view('layout/footer');
    }
    function studentsroom_detail($id)
    {
        $stuid=$this->uri->segment(4);
        $data['title'] = 'Student Details';
        $student = $this->student_model->get($id);
        $gradeList = $this->grade_model->get();
        $student_session_id = $student['student_session_id'];
      //  $student_due_fee = $this->studentfeemaster_model->getStudentFees($student_session_id);
      //  $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
     //   $data['student_discount_fee'] = $student_discount_fee;
     //   $data['student_due_fee'] = $student_due_fee;

          

        $prefs['day_type'] = 'short';
        $prefs['show_next_prev'] = true;
        $prefs['next_prev_url'] = base_url().'admin/hostel/studentsroom_detail//42';
        
       // $data["attendances"]=$this->db->query("SELECT created_at FROM student_attendences WHERE student_id='$id' GROUP BY created_at ORDER BY created_at ASC");
	   	$data["exams"]=$this->db->order_by("id","ASC")->get("exams");
		
        $feeresultlist = $this->Studentfee_model->getEachstudentFee($id);
        $data['feeresultlist'] =$feeresultlist;
       
        $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);

        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $student['id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id'] = $value['exam_id'];
                    $exam_array['full_marks'] = $value['full_marks'];
                    $exam_array['passing_marks'] = $value['passing_marks'];
                    $exam_array['exam_name'] = $value['name'];
                    $exam_array['exam_type'] = $value['type'];
                    $exam_array['attendence'] = $value['attendence'];
                    $exam_array['get_marks'] = $value['get_marks'];
                    $x[] = $exam_array;
                }
                $array['exam_name'] = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        $student_doc = $this->student_model->getstudentdoc($id);
        $data['student_doc'] = $student_doc;
        $data['student_doc_id'] = $id;
        $category_list = $this->category_model->get();
        $data['category_list'] = $category_list;
        $data['gradeList'] = $gradeList;
        $data['student'] = $student;
        
        
        $this->db->select("student_room.*,hostel.*,students.*,student_room.id as stuid,hostel.hostel_name as hostel");
        $this->db->join("hostel","hostel.id=student_room.hostel_id");
        $this->db->join("students","student_room.student_id=students.id");
        $this->db->order_by("student_room.class_id","desc");
        $data["sturoomdetail"]=$this->db->get_where("student_room",array("student_id"=>$stuid))->row();
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/hostel/studentroomdetail', $data);
        $this->load->view('layout/footer', $data);
    }
    function searchhostelroom()
    {
        $hostelname=$this->input->post("hostelname");
		$this->db->group_by("room_no");
		$this->db->order_by("room_no");
		$this->db->where("hostel_id",$hostelname);
		$query = $this->db->get("hostel_rooms");
		
		$r= "";
		foreach($query->result() as $row):
        
		$r.= "<option value='".$row->room_no."'>".$row->room_no."</option>";
		endforeach;
// 		$result=json_encode($r);
		echo $r;
    }
     function studentsroom_edit()
    {
        $id= $this->uri->segment(4);
        // $student_id=$this->input->post("studentid");
        
        // echo $id;exit;
        $this->db->select("student_room.*,hostel.*,students.*");
        $this->db->join("hostel","hostel.id=student_room.hostel_id");
        $this->db->join("students","students.id=student_room.student_id");
        // $this->db->join("classes","classes.id=student_room.class_id");
        // $this->db->join("sections","sections.id=student_room.section_id");
        // $this->db->join("hostel","hostel.id=student_room.hostel_id","left");
        $data["studentroom"]=$this->db->get_where("student_room",array('student_id'=>$id))->row();
        $data["hostellist"]=$this->student_model->gethostel();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/hostel/editstudentsroom', $data);
        $this->load->view('layout/footer', $data);
    }
    function studentroom_edit()
    {
        $stuid=$this->input->post("studentid");
        // echo $stuid;exit;
        $hostelname=$this->input->post("hostelname");
        $roomno=$this->input->post("roomno");
        
        // echo $hostelname;echo $roomno;exit;
        $data=array(
            "hostel_id"=>$hostelname,
            "room_no"=>$roomno
            );
            
        $this->db->where('student_id',$stuid);
		$this->db->update("student_room",$data);
		redirect('admin/hostel/studentroom_list');
    }
    function delete() {
       
        // $this->hostel_model->remove($id);
        $id= $this->uri->segment(4);
		$this->hostel_model->delete("student_room",'student_id',$id);
        redirect('admin/hostel/studentroom_list');
    }

}

?>