<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Salary_model");
        $this->load->model("Common_model");
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Salary');
        $this->session->set_userdata('sub_menu', 'salary/index');
        $data['exp_title'] = date("F-Y");
         $data["locations"]=$this->Common_model->grab_location();

        $data['title'] = 'Add Salary';
        $data['title_list'] = 'Recent Salary';        
        $salary_result = $this->Salary_model->get();
        $data['salarylist'] = $salary_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/salary/salaryList', $data);
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
        $data['title'] = 'Fees Master List';
        $this->Salary_model->remove($id);
        redirect('admin/salary/index');
    }

    function createform()
    {
            
            $data["teachers"] = $this->teacher_model->get();
             $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salaryCreate', $data);
            $this->load->view('layout/footer', $data);

    }

    function create() {
        $data['title'] = 'Add Fees Master';
        $authority=$this->customlib->getAdminSessionUserName();

        $this->form_validation->set_rules('salary[]', 'Salaries', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salaryCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $count=count($this->input->post('teacher_id'));
            $teacher_id=$this->input->post('teacher_id');
            $teacher_name=$this->input->post('teacher_name');
            $position=$this->input->post('position');
            $salary=$this->input->post('salary');
            $date=$this->input->post('date');
            for($i=0;$i<$count;$i++)
            {
            $data = array(
                'teacher_id' =>$teacher_id[$i] ,
                'name' => $teacher_name[$i],
                'position' => $position[$i],
                'amount' => $salary[$i],
                'date' => date("Y-m-d",strtotime($date)),
                'authority' => $authority

            );
          
            $this->Salary_model->add($data);

            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Salary added successfully</div>');
            redirect('admin/Salary');
          
        }
    }

    function edit($id) {

        $data['title'] = 'Edit Salary';
        $data['teachers'] = $this->Common_model->grab_teacher();

        $data['id'] = $id;
        $salary = $this->Salary_model->get($id);

        $data['salary'] = $salary;
        $data['title_list'] = 'Monthly Salary List';
        $salary_result = $this->Salary_model->get();
        $data['salarylist'] = $salary_result;
      
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('teacher_id', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salaryEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $teacher_id=$this->input->post('teacher_id');
            $teacher_name=$this->input->post('teacher_name');
            $position=$this->input->post('position');
            $amount=$this->input->post('amount');
            $date=$this->input->post('date');


          $data = array(
                'id'=>$id,
                'teacher_id' =>$teacher_id ,
                'name' => $teacher_name,
                'position' => $position,
                'amount' => $amount,
                'date' => date("Y-m-d",strtotime($date)),
                'authority' => $authority
            );

            $insert_id = $this->Salary_model->add($data);
            if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {
                $fileInfo = pathinfo($_FILES["documents"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["documents"]["tmp_name"], "./uploads/school_salary/" . $img_name);
                $data_img = array('id' => $id, 'documents' => 'uploads/school_salary/' . $img_name);
                $this->Salary_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Salary updated successfully</div>');
          
      
             $data['title'] = 'Edit Salary';
        $data['teachers'] = $this->Common_model->grab_teacher();

        $data['id'] = $id;
        $salary = $this->Salary_model->get($id);

        $data['salary'] = $salary;
        $data['title_list'] = 'Monthly Salary List';
        $salary_result = $this->Salary_model->get();
        $data['salarylist'] = $salary_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/salary/salaryEdit', $data);
            $this->load->view('layout/footer', $data);
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
                $resultList = $this->Salary_model->search("","", $date_from, $date_to);
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