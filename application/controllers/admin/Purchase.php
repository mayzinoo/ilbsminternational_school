<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('Customlib');
        $this->load->model("Purchase_model");
        $this->load->model("Common_model");
        error_reporting(1);
    }

    function view_detail()
    {
        $id=$this->uri->segment(4);
        // $this->load->model("Leave_model");
        // $data["row"]=$this->Leave_model->get($id); 
        // echo $id; exit;
        $data["row"]=$this->db->query("SELECT * FROM purchase_header WHERE id=$id")->row();
        // $data["lists"]=$this->db->query("SELECT purchase_header.*,purchase_detail.* FROM purchase_header JOIN purchase_detail ON purchase_detail.purchase_id=purchase_header.id WHERE purchase_header.id='$id'");
        
        $data["lists"]=$this->db->query("SELECT * FROM purchase_detail WHERE purchase_id='$id'");
        
                $error = $this->db->error();
                echo $error["message"];                
        $data["content"]="purchaseDetail";
         $this->load->view('layout/header', $data);
        $this->load->view("admin/purchase/purchaseDetail",$data);
        $this->load->view('layout/footer', $data);
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Expenses');
        $this->session->set_userdata('sub_menu', 'Purchase/index');
        // $data['exp_title'] = date("F-Y");
          $data["locations"]=$this->Common_model->grab_location();

        // $data['title'] = 'Add Salary';
        // $data['title_list'] = 'Recent Salary';        
        $purchase_result = $this->Purchase_model->get();
        $data['purchaselist'] = $purchase_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/purchase/purchaseList', $data);
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
            $this->load->view('admin/purchase/purchaseCreate', $data);
            $this->load->view('layout/footer', $data);

    }
    
    function edit_form($id)
    {
            $data["row"]=$this->db->query("SELECT * FROM purchase_header WHERE id=$id")->row();
        // $data["lists"]=$this->db->query("SELECT purchase_header.*,purchase_detail.* FROM purchase_header JOIN purchase_detail ON purchase_detail.purchase_id=purchase_header.id WHERE purchase_header.id='$id'");
        
        $data["lists"]=$this->db->query("SELECT * FROM purchase_detail WHERE purchase_id='$id'");
            $data["teachers"] = $this->teacher_model->get();
             $this->load->view('layout/header', $data);
            $this->load->view('admin/purchase/purchaseEdit', $data);
            $this->load->view('layout/footer', $data);

    }

    function create() {
       
        $data['title'] = 'Add Purchase Request';

        // $this->form_validation->set_rules('salary[]', 'Salaries', 'trim|required|xss_clean');
        // if ($this->form_validation->run() == FALSE) {
        //     $this->load->view('layout/header', $data);
        //     $this->load->view('admin/salary/salaryCreate', $data);
        //     $this->load->view('layout/footer', $data);
        // } else {

            
            $form_no=$this->input->post('form_no');
            $date=strtotime(date("Y-m-d",$this->input->post('reqdate')));
            $requested_school=$this->input->post('reqschool');
            $requested_by=$this->input->post('requested_by');
            $business_unit=$this->input->post('bunit');
            $department=$this->input->post('dept');
            $certified_by=$this->input->post('certified_by');
            $certified_date=strtotime(date("Y-m-d",$this->input->post('$certified_date')));
            $checked_by=$this->input->post('checked_by');
            $checked_date=strtotime(date("Y-m-d",$this->input->post('$checked_date')));
            $approved_by=$this->input->post('approved_by');
            $approved_date=strtotime(date("Y-m-d",$this->input->post('approved_date')));
            
            $count=count($this->input->post('unit'));
            $item_name=$this->input->post('description');
            $unit=$this->input->post('unit');
            $quantity=$this->input->post('quantity');
            $remark=$this->input->post('remark');
            
            $data=array(
                        "form_no"=>$form_no,
                        "requested_school"=>$requested_school,
                        "business_unit"=>$business_unit,
                        "department"=>$department,
                        "date"=>$date,
                        "requested_by"=>$requested_by,
                        "certified_by"=>$certified_by,
                        "checked_by"=>$checked_by,
                        "approved_by"=>$approved_by,
                        "certified_date"=>$certified_date,
                        "checked_date"=>$checked_date,
                        "approved_date"=>$approved_date
                );
                
            $query=$this->db->insert("purchase_header",$data);
            $purchase_id=$this->db->insert_id(); 
            // echo $purchase_id;
            // echo $count; exit;
            if($query)
            {
                   for($i=0;$i<$count;$i++)
                    {
                    $detail = array(
                        'purchase_id' =>$purchase_id,
                        'item_name' => $item_name[$i],
                        'unit' => $unit[$i],
                        'quantity' => $quantity[$i],
                        'remark' => $remark[$i]
        
                    );
                    
                   $insq=$this->db->insert("purchase_detail",$detail);
                    
                    }
                    
                 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Purchase Request added successfully</div>');
                redirect('admin/Purchase/createform');
               
            }
            
                $error = $this->db->error();
                 if (isset($error['message'])) {
                    echo $error['message'];
                }
            
    }

    function edit($id) {

        $data['title'] = 'Edit Purchase Request Form';
        $data['teachers'] = $this->Common_model->grab_teacher();

            // $id=$this->uri->segment(4);
            $form_no=$this->input->post('form_no');
            $date=strtotime(date("Y-m-d",$this->input->post('reqdate')));
            $requested_school=$this->input->post('reqschool');
            $requested_by=$this->input->post('requested_by');
            $business_unit=$this->input->post('bunit');
            $department=$this->input->post('dept');
            $certified_by=$this->input->post('certified_by');
            $certified_date=strtotime(date("Y-m-d",$this->input->post('$certified_date')));
            $checked_by=$this->input->post('checked_by');
            $checked_date=strtotime(date("Y-m-d",$this->input->post('$checked_date')));
            $approved_by=$this->input->post('approved_by');
            $approved_date=strtotime(date("Y-m-d",$this->input->post('approved_date')));
            
            $count=count($this->input->post('unit'));
            $item_name=$this->input->post('description');
            $unit=$this->input->post('unit');
            $quantity=$this->input->post('quantity');
            $remark=$this->input->post('remark');
            
            $data=array(
                        "form_no"=>$form_no,
                        "requested_school"=>$requested_school,
                        "business_unit"=>$business_unit,
                        "department"=>$department,
                        "date"=>$date,
                        "requested_by"=>$requested_by,
                        "certified_by"=>$certified_by,
                        "checked_by"=>$checked_by,
                        "approved_by"=>$approved_by,
                        "certified_date"=>$certified_date,
                        "checked_date"=>$checked_date,
                        "approved_date"=>$approved_date
                );
                
                $this->db->where("id",$id);
                $query=$this->db->update("purchase_header",$data);
                
            if($query)
            {
                $this->db->where("purchase_id",$id);
                $qry=$this->db->delete("purchase_detail");
                if($qry)
                    {
                       for($i=0;$i<$count;$i++)
                        {
                        $detail = array(
                            'purchase_id' =>$id,
                            'item_name' => $item_name[$i],
                            'unit' => $unit[$i],
                            'quantity' => $quantity[$i],
                            'remark' => $remark[$i]
            
                        );
                        
                       $insq=$this->db->insert("purchase_detail",$detail);
                        
                        }
                        
                     $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Purchase Request Updated successfully</div>');
                    redirect('admin/Purchase/index');

                    }
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