<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProfitLoss extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
    }
    function index()
    {
        $data["fromdate"]="";
        $data["todate"]="";
       
        $this->db->select("course_fee_receive.*,SUM(pay_amount) as feestotal");
       $data["incomelist1"]=$this->db->get("course_fee_receive")->row();
       
    //   $this->db->select("fee_collection.*,SUM(total_received) as feecollecttotal");
    //   $data["incomelist2"]=$this->db->get_where("fee_collection",array("payment_mode"=>"Cash"))->row();
       
       $data["incomelist2"]=$this->db->query("SELECT SUM(total_received) as feecollecttotal FROM fee_collection")->row();
       
        $this->db->select("income.*,SUM(amount) as incometotal");
       $data["incomelist3"]=$this->db->get("income")->row();
       
       $data["incomelist4"]=$this->db->query("SELECT SUM(total) as stotal FROM sale_detail")->row();
       
       $data["incomelist5"]=$this->db->query("SELECT SUM(pay_amount) as install_fees FROM studentfee_receive")->row();
       
        $data["outcomelist"]=$this->db->query("SELECT expenses.*,SUM(amount) as total FROM expenses GROUP BY name ORDER BY id desc");
        
        // $data["outcomelist2"]=$this->db->query("SELECT use_item.*,SUM(total) as total FROM use_item GROUP BY name ORDER BY id desc");
        
        $data["outcomelist2"]=$this->db->query("SELECT use_item.*,stock.name as sname, SUM(total) as total FROM use_item LEFT JOIN stock ON use_item.item_id=stock.id GROUP BY stock.name ORDER BY use_item.id desc");
        
        $data["outcomelist3"]=$this->db->query("SELECT purchase_details.*,stock.name as sname, SUM(total) as total FROM purchase_details LEFT JOIN stock ON purchase_details.item_id=stock.id GROUP BY stock.name ORDER BY purchase_details.id desc");
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/profitloss/financeShow', $data);
        $this->load->view('layout/footer', $data);
    }
    
    
    function profitloss_search()
    {
        if($this->input->post("fromdate")!="" && $this->input->post("todate")!="")
        {
            // echo "Hello";
            
            $start_date=date("Y-m-d",strtotime($this->input->post("fromdate")));
            $end_date=date("Y-m-d",strtotime($this->input->post("todate")));
            
//         $this->db->select("course_fee_receive.*,SUM(pay_amount) as feestotal");
//         $this->db->where("pay_date >=",$start_date);
// 		$this->db->where("pay_date <=",$end_date);
//       $data["incomelist1"]=$this->db->get("course_fee_receive")->row();
       $data["fromdate"]=$start_date;
       $data["todate"]=$end_date;
       $data["incomelist1"]=$this->db->query("SELECT SUM(pay_amount) as feestotal FROM course_fee_receive WHERE paydate BETWEEN '$start_date' AND '$end_date'")->row();
       
    //   $this->db->select("fee_collection.*,SUM(total_received) as feecollecttotal");
    //   $data["incomelist2"]=$this->db->get_where("fee_collection",array("payment_mode"=>"Cash"))->row();
       
       $data["incomelist2"]=$this->db->query("SELECT SUM(total_received) as feecollecttotal FROM fee_collection WHERE paydate BETWEEN '$start_date' AND '$end_date'")->row();
       
       $this->db->select("income.*,SUM(amount) as incometotal");
       $this->db->where("created_at >=",$start_date);
		$this->db->where("created_at <=",$end_date);
       $data["incomelist3"]=$this->db->get("income")->row();
       
       $data["incomelist4"]=$this->db->query("SELECT SUM(total) as stotal FROM sale_detail WHERE created_at BETWEEN '$start_date' AND '$end_date'")->row();
       
       $data["incomelist5"]=$this->db->query("SELECT SUM(pay_amount) as install_fees FROM studentfee_receive WHERE paydate BETWEEN '$start_date' AND '$end_date'")->row();
       
        $data["outcomelist"]=$this->db->query("SELECT expenses.*,SUM(amount) as total FROM expenses WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY id desc");
        
        // $data["outcomelist2"]=$this->db->query("SELECT use_item.*,SUM(total) as total FROM use_item GROUP BY name ORDER BY id desc");
        
        $data["outcomelist2"]=$this->db->query("SELECT use_item.*,stock.name as sname, SUM(total) as total FROM use_item LEFT JOIN stock ON use_item.item_id=stock.id WHERE use_item.date BETWEEN '$start_date' AND '$end_date' GROUP BY stock.name ORDER BY use_item.id desc");
        
        $data["outcomelist3"]=$this->db->query("SELECT purchase_details.*,stock.name as sname, SUM(total) as total FROM purchase_details LEFT JOIN stock ON purchase_details.item_id=stock.id WHERE purchase_details.date BETWEEN '$start_date' AND '$end_date' GROUP BY stock.name ORDER BY purchase_details.id desc");
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/profitloss/financeShow', $data);
        $this->load->view('layout/footer', $data);
        }
        
        else
        {
            $this->index();
        }
    }
    
//     function profitloss_search()
//     {
//         if($this->input->post('submit')==true)
//     	{
//     		$fromdate=$this->input->post("fromdate");
//     		$todate=$this->input->post("todate");
    
//     		$userdata=array(
    
//     	    'fromdate'=>$fromdate,
//     	    'todate'=>$todate
//     	    );
//     	$this->session->set_userdata($userdata);
//     	}
//     	else{
//     		$fromdate=$this->session->userdata("fromdate");
//     		$todate=$this->session->userdata("todate");
//     	}
//     if(empty($fromdate) && empty($todate))
// 	{
// 		$query=$this->db->query("SELECT * FROM in_outcome_tbl order by income_amt desc");
// 		$data["total_amt"]=$this->db->query("SELECT SUM(in_outcome_tbl.income_amt) as incomeamt,SUM(in_outcome_tbl.outcome_amt) as outcomeamt FROM in_outcome_tbl")->row();
// 	}
// 	elseif(!empty($fromdate) && empty($todate))
// 	{
// 		$query=$this->db->query("SELECT * FROM in_outcome_tbl WHERE entry_date='$startdate' order by income_amt desc");
// 		$data["total_amt"]=$this->db->query("SELECT SUM(in_outcome_tbl.income_amt) as incomeamt,SUM(in_outcome_tbl.outcome_amt) as outcomeamt FROM in_outcome_tbl WHERE entry_date='$startdate'")->row();
// 	}
// 	elseif(empty($fromdate) && !empty($todate))
// 	{
// 		$query=$this->db->query("SELECT * FROM in_outcome_tbl WHERE entry_date='$enddate' order by income_amt desc");
// 		$data["total_amt"]=$this->db->query("SELECT SUM(in_outcome_tbl.income_amt) as incomeamt,SUM(in_outcome_tbl.outcome_amt) as outcomeamt FROM in_outcome_tbl WHERE entry_date='$enddate'")->row();
// 	}
// 	elseif(!empty($fromdate) && !empty($todate))
// 	{
// 		$query=$this->db->query("SELECT * FROM in_outcome_tbl WHERE entry_date BETWEEN '$startdate' AND '$enddate' order by income_amt desc");
// 		$data["total_amt"]=$this->db->query("SELECT SUM(in_outcome_tbl.income_amt) as incomeamt,SUM(in_outcome_tbl.outcome_amt) as outcomeamt FROM in_outcome_tbl WHERE entry_date BETWEEN '$startdate' AND '$enddate'")->row();
// 	}
//     }
}

?>