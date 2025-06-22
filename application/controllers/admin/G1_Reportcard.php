<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class G1_Reportcard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->model("Reportcard_model");
        $this->load->model("Common_model");
        $this->load->model("Student_model");

    }
    
    function activity() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Reportcard/activity');
        $data['title'] = 'Student Activity Reportcard List';
        $data["reportcard_month"]=$this->Common_model->grab_month();

         $class = $this->class_model->get();
        $data['classlist'] = $class;
        $student_result = $this->student_model->get();
        $data['studentlist'] = $student_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/reportcard/activityList', $data);
        $this->load->view('layout/footer', $data);
        
    }
    

     function index() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Reportcard/index');
         $data['title'] = 'Student Reportcard List';
         $class = $this->class_model->get();
        $data["reportcard_month"]=$this->Common_model->grab_month();

        $data['classlist'] = $class;
        $student_result = $this->student_model->get();
        $data['studentlist'] = $student_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/reportcard/reportcardList', $data);
        $this->load->view('layout/footer', $data);
        
    }
    
    
     function search() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Reportcard/index');
         $data['title'] = 'Student Reportcard List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/reportcard/reportcardList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                        
                    } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                    
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
                        $data['resultlist'] = $resultlist;
             $title=$this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
               $data['title'] = 'Student Details for '.$title['class']."(".$title['section'].")";
                    }
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
            $this->load->view('admin/reportcard/reportcardList', $data);
            $this->load->view('layout/footer', $data);
        }
    }



     function activitysearch() {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Reportcard/activity');
        $data['title'] = 'Student Reportcard List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data["school_activity"]=$this->db->order_by("id","ASC")->get("school_activity");
        $data["reportcard_month"]=$this->Common_model->grab_month();



        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/reportcard/activityList', $data);
            $this->load->view('layout/footer', $data);
        } else {



            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $month = $this->input->post('month');
            $search = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            $this->load->view('layout/header', $data);


            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                        
                    } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                        $data['search_text'] = $this->input->post('search_text');

                        $a=array(
                            "class_id"=>$class,
                            "section_id"=>$section,
                            "month"=> $month 

                                );

                        $this->session->set_userdata($a);


                        $check=$this->Reportcard_model->check_exit($class,$section,$month);


                        if($check->num_rows()>=1)
                        {
                        
                        $resultlist = $this->Reportcard_model->searchByClassSection($class, $section,$month);
                        $data['resultlist'] = $resultlist;

                        $this->load->view('admin/reportcard/activityList', $data);
                      
                        }
                        else
                        {
                            echo "he";
                        $resultlist = $this->student_model->searchByClassSection($class, $section);

                        $data['resultlist'] = $resultlist;

                        $this->load->view('admin/reportcard/activityformList', $data);


                        }
                        $title=$this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title'] = 'Student Details for '.$title['class']."(".$title['section'].")";
                    }
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
           
                 $this->load->view('layout/footer', $data);

        }
    }


            function save_acitvity()
            {

                
                 $student_id=$this->input->post("student_id");
                 $class_id=$this->session->userdata("class_id");
                 $section_id=$this->session->userdata("section_id");
                 $month=$this->session->userdata("month");


                 $act_1=$this->input->post("act_1");
                 $act_2=$this->input->post("act_2");
                 $act_3=$this->input->post("act_3");
                 $act_4=$this->input->post("act_4");
                 $act_5=$this->input->post("act_5");
                 $act_6=$this->input->post("act_6");
                 $act_7=$this->input->post("act_7");
                 $act_8=$this->input->post("act_8");
                 $act_9=$this->input->post("act_9");

                for($i=0;$i<count($student_id);$i++){

                    $data=array(
                                "student_id"=>$student_id[$i],
                                "class_id"=>$class_id,
                                "section_id"=>$section_id,
                                "month"=>$month,
                                "act_1"=>$act_1[$i],
                                "act_2"=>$act_2[$i],
                                "act_3"=>$act_3[$i],
                                "act_4"=>$act_4[$i],
                                "act_5"=>$act_5[$i],
                                "act_6"=>$act_6[$i],
                                "act_7"=>$act_7[$i],
                                "act_8"=>$act_8[$i],
                                "act_9"=>$act_9[$i]
                        );

                    $this->db->insert("activity_results",$data);                   
                 
                }
                
                $this->session->set_userdata('top_menu', 'Examinations');
                $this->session->set_userdata('sub_menu', 'Reportcard/activity');
                $data['title'] = 'Student Reportcard List';
                $class = $this->class_model->get();
                $data['classlist'] = $class;
                $data["school_activity"]=$this->db->order_by("id","ASC")->get("school_activity");
                $this->load->view('layout/header', $data);
                $this->load->view('admin/reportcard/activityList', $data);
                $this->load->view('layout/footer', $data);

            }
                
    function rpcardsfront() {
        
        $student_id=$this->uri->segment(4);
        $setting_result = $this->Reportcard_model->reportcard_head();
        $data['settinglist'] = $setting_result;     
        $data["student"]=$this->student_model->get($student_id);
        $data["exams"]=$this->db->order_by("id","ASC")->get("exams");
        $data["reportcard_subject"]=$this->db->order_by("id","ASC")->get("reportcard_subject");
       $data["subject"] = $this->db->get_where("subjects",array("level"=>'Primary',));
       $this->db->select("*");
       $this->db->where("name !=",'ေမ');
       $this->db->where("name !=",'မတ္');
       $this->db->where("name !=",'ဧၿပီ');
       $data['month'] = $this->db->get("reportcard_month");
       $data['primary_result']=$this->db->get_where("primary_result",array('student_id'=>$student_id));

        $this->load->view('admin/primaryreportcard/grade1reportcardFrontPrint', $data);
    }
    
    
    function prerpcardsback() {
        $student_id=$this->uri->segment(4);
         $setting_result = $this->Reportcard_model->reportcard_head();
        $data['settinglist'] = $setting_result;
       $data["student"]=$this->student_model->get($student_id);

       $data["reportcard_month"]=$this->db->order_by("id","ASC")->get("reportcard_month");
       $data["school_activity"]=$this->db->order_by("id","ASC")->get("school_activity");
    
        $data["improvement"]=$this->db->get_where("improvement_detail",array('header_id'=>'7'))->row();
        $data["impro_result"]=$this->db->get_where("improvement_result_details",array('student_id'=>$student_id,'improvement_id'=>'7'));
         $data["impro_result13"]=$this->db->get_where("improvement_result_details",array('student_id'=>$student_id,'improvement_id'=>'13'));
        
        $data['grades'] = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
        $data["getmonth"]=$this->Common_model->getmonths();
        $data["month"]=$this->Common_model->getmonths()->row();
        $data["rpcards"]=$this->db->query("SELECT activity_results.* FROM activity_results WHERE activity_results.student_id='$id' ORDER BY month ASC");            
        
        $this->load->view('admin/kgreportcard/kgreportcardBackPrint', $data);
    }
    function add_termsandconditionform()
    {               
        $this->load->view('layout/header');
        $this->load->view('admin/addtermsandcondition', $data);
        $this->load->view('layout/footer');
        
    }
    function add_termsandcondition()
    {
        $title=$this->input->post('');
        $title=$this->input->post('');

        $data=array(                                    
                            'id'=>'',                       
                            'title'=>$title
                        );
        $query=$this->db->insert('tbl_companyprofile',$data);
                    if($query)
                    {
                        $data['errmessage']="successfully  saved";
                    }
                    else
                    {
                        $data["errmessage"]="Fail to save";
                    }   
        redirect("admin/data_list/companyprofile");         

    }
    /*mzo*/
    
    function printwithgrade() {
        $student_id=$this->uri->segment(4);
         $setting_result = $this->Reportcard_model->reportcard_head();
        $data['settinglist'] = $setting_result;
        
       $data["student"]=$this->student_model->get($student_id);
       $data["exams"]=$this->db->order_by("id","ASC")->get("exams");
       $data["reportcard_subject"]=$this->db->order_by("id","ASC")->get("reportcard_subject");
        /*$data["rpcards"]=$this->db->query("SELECT exam_results.*,exam_schedules.* FROM exam_results JOIN exam_schedules
                            ON exam_results.exam_schedule_id=exam_schedules.id  WHERE 
                            exam_results.student_id='$id'");*/
                            
        
        $this->load->view('admin/reportcard/reportcardFrontPrintwithGrades', $data);
    }

    
    function rpcardsback() {
        $student_id=$this->uri->segment(4);
         $setting_result = $this->Reportcard_model->reportcard_head();
        $data['settinglist'] = $setting_result;
       $data["student"]=$this->student_model->get($student_id);

       $data["reportcard_month"]=$this->db->order_by("id","ASC")->get("reportcard_month");
       $data["school_activity"]=$this->db->order_by("id","ASC")->get("school_activity");

        $data["rpcards"]=$this->db->query("SELECT activity_results.* FROM activity_results WHERE activity_results.student_id='$id' ORDER BY month ASC");            
        
        $this->load->view('admin/reportcard/reportcardBackPrint', $data);
    }



    function rpcardsbackwithgrades() {
        $student_id=$this->uri->segment(4);
         $setting_result = $this->Reportcard_model->reportcard_head();
        $data['settinglist'] = $setting_result;
       $data["student"]=$this->student_model->get($student_id);

       $data["reportcard_month"]=$this->db->order_by("id","ASC")->get("reportcard_month");
       $data["school_activity"]=$this->db->order_by("id","ASC")->get("school_activity");

        $data["rpcards"]=$this->db->query("SELECT activity_results.* FROM activity_results WHERE activity_results.student_id='$id' ORDER BY month ASC");            
        
        $this->load->view('admin/reportcard/reportcardBackPrintwithGrades', $data);
    }
    
    
    function rpcards($id,$exam_id)
    {
        //$student_id=$this->uri->segment(3);
      //  $data["exams"]=$this->db->order_by("id","ASC")->get("exams");
        $query=$this->db->query("SELECT exam_results.*  WHERE 
                            exam_results.student_id='$id'");
                            
        return $query;          
        
    }

    function view($id) {
        $data['title'] = 'Exam List';
        $exam = $this->exam_model->get($id);
        $data['exam'] = $exam;
        $this->load->view('layout/header', $data);
        $this->load->view('exam/examShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function getByFeecategory() {
        $feecategory_id = $this->input->get('feecategory_id');
        $data = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
    }

    function getStudentCategoryFee() {
        $type = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data = $this->exam_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    function delete($id) {
        $data['title'] = 'Exam List';
        $this->exam_model->remove($id);
        redirect('admin/exam/index');
    }

    function create() {
        $data['title'] = 'Add Exam';
        $this->form_validation->set_rules('exam', 'Exam', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('exam/examCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'exam' => $this->input->post('exam'),
                'note' => $this->input->post('note'),
            );
            $this->exam_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Exam added successfully</div>');
            redirect('exam/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Exam';
        $data['id'] = $id;
        $exam = $this->exam_model->get($id);
        $data['exam'] = $exam;
        $data['title_list'] = 'Exam List';
        $exam_result = $this->exam_model->get();
        $data['examlist'] = $exam_result;
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam/examEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->exam_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Exam update successfully</div>');
            redirect('admin/exam/index');
        }
    }

    function examSearch() {
        $data['title'] = 'Search exam';
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'exam Result From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                $resultList = $this->exam_model->search("", $date_from, $date_to);
                $data['resultList'] = $resultList;
            } else {
                $data['exp_title'] = 'exam Result';
                $search_text = $this->input->post('search_text');
                $resultList = $this->exam_model->search($search_text, "", "");
                $data['resultList'] = $resultList;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam/examSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam/examSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}

?>