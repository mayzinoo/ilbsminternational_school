<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

		   function grab_teacher()
		   {

				$this->db->order_by("name");

				$query = $this->db->get("teachers");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }
		   
		  function grab_inter_class()
		   {

				$this->db->order_by("class");

				$query = $this->db->get("inter_class");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->class]=$row->class;

				endforeach;

				return $tags;
		   }
		   
		   
		   function grab_teachername()
		   {


				$this->db->order_by("name");

				$query = $this->db->get("teachers");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->name]=$row->name;

				endforeach;

				return $tags;
		   }



		      function grab_month()
		   {


				$this->db->order_by("id");

				$query = $this->db->get("reportcard_month");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }
		   function kg_month()
		   {

				$this->db->order_by("id");
                $this->db->where("id !=1");
                $this->db->where("id !=2");
                $this->db->where("id !=4");
                $this->db->where("id !=6");
                $this->db->where("id !=8");
                $this->db->where("id !=10");
                $this->db->where("id !=11");
				$query = $this->db->get_where("reportcard_month",array("id !="=>12));

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }
		   function primary_month()
		   {

				$this->db->order_by("id");
                $this->db->where("id !=1");
				$query = $this->db->get("reportcard_month");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }
		   /*mzo*/
		   function getmonths()
		   {
		       $this->db->order_by("id");
			    $query = $this->db->get("reportcard_month");
				return $query;
		   }
            function get_sessiondata()
		   {
				$this->db->group_by("session");
        		$this->db->order_by("session");
        		$query = $this->db->get("sessions");
        		if($query->num_rows()<=0)
        		{
        			$tags['']="..Select..".hide();
        		}
        		$tags['']="..Select..";
        		foreach($query->result() as $row):
        			$tags[$row->id]=$row->session;
        		endforeach;
        		return $tags;
		   }
		   function get_languagedata()
		   {
				$this->db->group_by("language");
        		$this->db->order_by("language");
        		$query = $this->db->get("languages");
        		if($query->num_rows()<=0)
        		{
        			$tags['']="..Select..".hide();
        		}
        		$tags['']="..Select..";
        		foreach($query->result() as $row):
        			$tags[$row->id]=$row->language;
        		endforeach;
        		return $tags;
		   }
		   /*mzo*/
             function get_startmonth()
		   {
				$this->db->group_by("session");
        		$this->db->order_by("session");
        		$query = $this->db->get("sessions");
        		if($query->num_rows()<=0)
        		{
        			$tags['']="..Select..".hide();
        		}
        		$tags['']="..Select..";
        		foreach($query->result() as $row):
        			$tags[$row->id]=$row->session;
        		endforeach;
        		return $tags;
		   }
     function grab_paymenttype()
		   {


				$this->db->order_by("id");

				$query = $this->db->get("payment_method");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->payment;

				endforeach;

				return $tags;
		   }



		      function grab_school()
		   {


				$this->db->order_by("id");

				$query = $this->db->get("sch_settings");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }
		   function grab_monthlist()
		   {


				$this->db->order_by("id");

				$query = $this->db->get("reportcard_month");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->name]=$row->name;

				endforeach;

				return $tags;
		   }



		     function grab_subject()
		   {
		   	$this->db->order_by("name");

				$query = $this->db->get("subjects");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }



		     function grab_section()

		   {
		   	$this->db->order_by("section");

				$query = $this->db->get("sections");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->section;

				endforeach;

				return $tags;
		   }

		     function grab_class()
		   {
		   	$this->db->order_by("class");

				$query = $this->db->get("classes");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->class;

				endforeach;

				return $tags;
		   }


		     function grab_feegroup()
		   {
		   	$this->db->order_by("name");

				$query = $this->db->get("fee_groups");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }




		     function grab_improvementdesc()
		   {
		   	$this->db->order_by("lessontitle");

				$query = $this->db->get("improvement");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->lessontitle;

				endforeach;

				return $tags;
		   }
        
        function grab_kgimprovementdesc()
		   {
		   	$this->db->order_by("lessontitle");

				$query = $this->db->get("kgimprovement");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->lessontitle;

				endforeach;

				return $tags;
		   }
        function grab_primarysubject()
		   {
		   	$this->db->order_by("name");

				$query = $this->db->get_where('subjects',array('level'=>"Primary"));

				if($query->num_rows()<=0)

				{
                    $tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }
   

       function grab_location()
		   {
		   	$this->db->order_by("name");

				$query = $this->db->get("sch_settings");

				if($query->num_rows()<=0)

				{

					$tags['']="..Select..";

				}

				$tags['']="..select..";

				foreach($query->result() as $row):

					$tags[$row->id]=$row->name;

				endforeach;

				return $tags;
		   }


   }



   

    ?>