<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Performance extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Performance_model");
        $this->load->model("Common_model");
    }

    function view_detail()
    {
        $id=$this->uri->segment(4);
        // $this->load->model("Leave_model");
        // $data["row"]=$this->Leave_model->get($id); 
        // echo $id; exit;
        $data["row"]=$this->db->query("SELECT performance.*,teachers.* FROM performance LEFT JOIN teachers ON performance.teacher_id=teachers.id WHERE performance.id='$id'")->row();        
        $data["row2"]=$this->db->query("SELECT performance.*,teachers.* FROM performance LEFT JOIN teachers ON performance.approved_by=teachers.id WHERE performance.id='$id'")->row();        
                $error = $this->db->error();
                echo $error["message"];  
        $data["lists"]=$this->db->get_where("performance_detail",array("header_id"=>$id));
        $data["content"]="performanceDetail";
         $this->load->view('layout/header', $data);
        $this->load->view("admin/performance/performanceDetail",$data);
        $this->load->view('layout/footer', $data);
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/Performance/index');
        // $data['exp_title'] = date("F-Y");
        $data['teacherlists'] = $this->Common_model->grab_teacher();
        $data["locations"]=$this->Common_model->grab_location();

        // $data['title'] = 'Add Salary';
        // $data['title_list'] = 'Recent Salary';        
        $performance_result = $this->Performance_model->get();
        $data['performanceresult'] = $performance_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/performance/performanceList', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function performance_type() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'admin/Performance/performance_type');
        // $data['exp_title'] = date("F-Y");
          $data["locations"]=$this->Common_model->grab_location();

        // $data['title'] = 'Add Salary';
        // $data['title_list'] = 'Recent Salary';        
        
        $data['result'] = $this->db->get("performance_type")->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/performance/performance_type', $data);
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

    function delete_ptype($id) {
        $this->db->where("id",$id);
        $this->db->delete("performance_type");
        redirect('admin/Performance/performance_type');
    }

    function createform()
    {
            // $data["performtype"]=$this->Performance_model->getPerformanceType();
            $data["performtype"]=$this->db->get("performance_type");
            $data["teachers"] = $this->Common_model->grab_teacher();
             $this->load->view('layout/header', $data);
            $this->load->view('admin/performance/performanceCreate', $data);
            $this->load->view('layout/footer', $data);

    }
    
    function edit_form($id)
    {
            $data["teachers"] = $this->Common_model->grab_teacher();
            $data["performtype"]=$this->db->get("performance_type");
            $data["row"]=$this->db->get_where("performance",array("id"=>$id))->row();
            $data["lists"]=$this->db->get_where("performance_detail",array("header_id"=>$id));
             $this->load->view('layout/header', $data);
            $this->load->view('admin/performance/performanceEdit', $data);
            $this->load->view('layout/footer', $data);

    }
    
     function delete($id) {
        $this->db->where("id",$id);
        $this->db->delete("performance");
        redirect('admin/Performance/index');
    }
    
    function ptype_form()
    {
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/performance/performance_typeCreate', $data);
            $this->load->view('layout/footer', $data);

    }
    
    function ptype_edit($id)
    {
            
        $data['row'] = $this->db->get_where("performance_type",array("id"=>$id))->row();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/performance/edit_performance_type', $data);
        $this->load->view('layout/footer', $data);

    }

    function create() {
       
        $data['title'] = 'Add Purchase Request';

      
            $count=count($this->input->post("performtype"));
            $performtype=$this->input->post("performtype");
            $level=$this->input->post("level");
            $teacher_id=$this->input->post('teacher');
            $approved_by=$this->input->post('approved_by');
            
            $data=array(
                        "teacher_id"=>$teacher_id,
                        "approved_by"=>$approved_by
                );
                
            $query=$this->db->insert("performance",$data);
            $id=$this->db->insert_id(); 
            
            if($query)
            {
                   for($i=0;$i<$count;$i++)
                    {
                    $detail = array(
                        'header_id'=>$id,
                        'ptype' =>$performtype[$i],
                        'plevel' => $level[$i]
                    );
                    
                   $insq=$this->db->insert("performance_detail",$detail);
                    
                    }
                    
                 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Performance Appraisal added successfully</div>');
                redirect('admin/Performance/createform');
               
            }
            
                $error = $this->db->error();
                 if (isset($error['message'])) {
                    echo $error['message'];
                }
            
    }

    function edit($id) {

        $data['title'] = 'Edit Purchase Request Form';
        $data['teachers'] = $this->Common_model->grab_teacher();

            $count=count($this->input->post("performtype"));
            $performtype=$this->input->post("performtype");
            $level=$this->input->post("level");
            $teacher_id=$this->input->post('teacher');
            $approved_by=$this->input->post('approved_by');
            
            $data=array(
                        "teacher_id"=>$teacher_id,
                        "approved_by"=>$approved_by
                );
                
                $this->db->where("id",$id);
                $query=$this->db->update("performance",$data);
                
            if($query)
            {
                $this->db->where("header_id",$id);
                $qry=$this->db->delete("performance_detail");
                if($qry)
                    {
                       for($i=0;$i<$count;$i++)
                        {
                        $detail = array(
                            'header_id'=>$id,
                            'ptype' =>$performtype[$i],
                            'plevel' => $level[$i]
                        );
                        
                       $insq=$this->db->insert("performance_detail",$detail);
                        
                        }
                        
                     $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Performance Updated successfully</div>');
                    redirect('admin/Performance/index');

                    }
        }
    }
    
    
    function create_ptype() {
        $data['title'] = 'Add New Performance Type';
        $authority=$this->customlib->getAdminSessionUserName();

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/Performance/ptype_form', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $name=$this->input->post('name');
            
            $data = array(
                'name'=>$name
            );
          
            $this->db->insert("performance_type",$data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Performance Type added successfully</div>');
            redirect('admin/Performance/performance_type');
          
        }
    }

    function edit_ptype() {
        
        $id=$this->input->post("id");
        $data['title'] = 'Edit Performance Type';
      
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
           
        } else {

            $name=$this->input->post('name');
          $data = array(
                
                'name' => $name
            );
            $this->db->where("id",$id);
            $qry=$this->db->update("performance_type",$data);
            if($qry)
            {
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Performance Type updated successfully</div>');
            }
        }
        
            redirect("admin/Performance/performance_type");
          
            // $this->load->view('layout/header', $data);
            // $this->load->view('admin/performance/performance_type', $data);
            // $this->load->view('layout/footer', $data);
       
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