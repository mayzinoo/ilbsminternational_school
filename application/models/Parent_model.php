<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parent_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {

        $sql = "SELECT * FROM `users` WHERE role='parent' order by id desc";
        $query = $this->db->query($sql);
        $parents = $query->result();
        foreach ($parents as $pr_key => $pr_value) {
            $pr_value->siblings = $this->student_model->read_siblings_students($pr_value->childs);
        }
        return $parents;
    }

function monthlyattandence_percent($session_id,$student_id)
    {

      $query=$this->db->query("SELECT
                month(student_attendences.created_at) as month,          
          count(if(month(student_attendences.created_at)  != 5 && student_attendences.status = 'Present', 1, NULL))  AS 'totalpresent',
              
            count(if(student_attendences.status = 'Absent', 1, NULL))  AS 'totalabsent',
        count(if(student_attendences.status = 'Leave', 1, NULL))  AS 'totalleave'
          FROM student_attendences 
                    where
                     student_attendences.session_id='$session_id'
                    AND student_attendences.student_id='$student_id'
                    group by month order by id ASC
                    ");
  
        return $query;          
        

    }

     function get_school_calendar($session_id)
    {
        $query=$this->db->query(" SELECT att_month,att_day

            FROM school_calendar WHERE school_calendar.session_id='$session_id'");

        return $query;


    }



}
