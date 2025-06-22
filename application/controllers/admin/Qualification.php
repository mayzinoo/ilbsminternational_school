<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qualification extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Qualification_model");
        $this->load->model("Common_model");
    }

    function view_detail()
    {
        $id=$this->uri->segment(4);
        // $this->load->model("Leave_model");
        // $data["row"]=$this->Leave_model->get($id); 
        // echo $id; exit;
        $data["row"]=$this->db->query("SELECT * FROM qualification")->row();        
                $error = $this->db->error();
                echo $error["message"];                
        $data["content"]="qualificationDetail";
         $this->load->view('layout/header', $data);
        $this->load->view("admin/qualification/qualificationDetail",$data);
        $this->load->view('layout/footer', $data);
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/Qualification/index');
        // $data['exp_title'] = date("F-Y");
          $data["locations"]=$this->Common_model->grab_location();

        // $data['title'] = 'Add Salary';
        // $data['title_list'] = 'Recent Salary';        
        $qualification_result = $this->Qualification_model->get();
        $data['qualificationresult'] = $qualification_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/qualification/qualificationList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/school_salary/" . $this->uri->segment(6);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    function view($id) {
        $data['title'] = 'Fees Master List';
        $salary = $this->Salary_model->get($id);
        $data['salary'] = $salary;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/salary/Salaryshow', $data);
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
        $data = $this->Salary_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    function delete($id) {
        $data['title'] = 'Academics List';
        $this->db->delete("qualification",array("id"=>$id));
        redirect('admin/Qualification/index');
    }

    function createform()
    {
                                   

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'Academics/index');
        $data['title'] = 'Academics List';
        // $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/qualification/qualificationCreate', $data);
        $this->load->view('layout/footer', $data);

    }

    function create() {
        $data['title'] = 'Add Qualification';

        // $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');        
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('qualification/qualificationList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            // $data = array(
            //     'teacher_id' => $this->input->post('teacher'),
            //     'class_section_id' => $this->input->post('class'),
            //     'section_id' => $this->input->post('section'),
            //     'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            // );

           

            //  $header_id=$this->Teacherdiary_model->add($data);

            $subject=$this->input->post("subject");
            $description=$this->input->post("description");

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            
                            "subject"=>$subject[$i],
                            "qualification"=>$description[$i],
                    );

                $this->db->insert("qualification",$data);
            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Qualification added successfully</div>');
            redirect('admin/Qualification/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Qualification';
         $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data['subjectlists'] = $this->Common_model->grab_subject();
        $data['classlists'] = $this->Common_model->grab_class();
        $data['sectionlists'] = $this->Common_model->grab_section();
        
       
        $data['id'] = $id;
        $qualification = $this->Qualification_model->get($id);
        $data['lists'] = $qualification;

        // $this->form_validation->set_rules('teacher', 'Teacher Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject[]', 'Subject', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description[]', 'description', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/qualification/qualificationEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            // $data = array(
            //     'id' => $id,
            //     'teacher_id' => $this->input->post('teacher'),
            //     'class_section_id' => $this->input->post('class'),
            //     'section_id' => $this->input->post('section'),
            //     'created_at' => date("Y-m-d",strtotime($this->input->post('date')))
            // );

            // $this->Teacherdiary_model->add($data);

             $subject=$this->input->post("subject");
            $description=$this->input->post("description");
            $detail_id=$this->input->post("detail_id");

            $this->db->where("id",$id)->delete("qualification");

            for($i=0;$i<count($subject);$i++)
            {
                $data=array(
                            
                            "subject"=>$subject[$i],
                            "qualification"=>$description[$i],
                    );

                $this->db->insert("qualification",$data);
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Qualification updated successfully</div>');
            redirect('admin/Qualification/index');
        }
    }

    function salarySearch() {
        $this->session->set_userdata('top_menu', 'Salary');
        $this->session->set_userdata('sub_menu', 'salary/Salaryearch');
        $data['title'] = 'Search Salary';
        $data["locations"]=$this->Common_model->grab_location();

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = $this->input->post('date_from') . " ~ " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                $resultList = $this->Salary_model->search("", $date_from, $date_to);
                $data['salarylist'] = $resultList;
            } 
                else if($search=="search_location")
                {
                     $data['exp_title'] = 'Salary Result';
                    $location = $this->input->post('location');
                    $resultList = $this->Salary_model->search($location,$search_text, "", "");
                    $data['salarylist'] = $resultList;
                    
                }
            else {
                $data['exp_title'] = 'Salary Result';
                $search_text = $this->input->post('search_text');
                $resultList = $this->Salary_model->search($location,$search_text, "", "");
                $data['salarylist'] = $resultList;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salarySearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salarySearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}

?>