<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grab_controller extends CI_Controller 
{

    function __construct() {
        parent::__construct();

        $this->load->model("Common_model");
    }

    function grabdata()
	   {

	    $id=$this->input->post("id");
	    $tbl=$this->input->post("tbl");

	    $query=$this->db->get_where($tbl,array("id"=>$id));
	   
		    $resultSet = Array();
			if($query){
		    foreach($query->result() as $result) 
		    	{
		      	 $resultSet = $result;
		  	  	}
			}
		echo json_encode($resultSet);
	   }

    function grabstudentdata()
	   {

	    $id=$this->uri->segment(3);
	    $query=$this->db->get_where("students",array("id"=>$id));
	   
		    $resultSet = Array();
			if($query){
		    foreach($query->result() as $result) 
		    	{
		      	 $resultSet = $result;
		  	  	}
			}
		echo json_encode($resultSet);
	   }
	   
	   
	   function grabFee()
	   {

	    $id=$this->uri->segment(3);
	    $query=$this->db->get_where("lectured_courses",array("id"=>$id));
	   
		    $resultSet = Array();
			if($query){
		    foreach($query->result() as $result) 
		    	{
		      	 $resultSet = $result;
		  	  	}
			}
		echo json_encode($resultSet);
	   }


function getposition()

{
	 $id=$this->input->post("id");
	  $tbl="teachers";

	    $query=$this->db->get_where($tbl,array("id"=>$id));
	   
		    $resultSet = Array();
			if($query){
		    foreach($query->result() as $result) 
		    	{
		      	 $resultSet = $result;
		  	  	}
			}
		echo json_encode($resultSet);
	   }
}

?>