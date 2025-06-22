<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qrecord_model extends CI_Model {

   

    public function get($id = null) {
        if ($id != null) {
        
           $this->db->select("teacherdiary.*,classes.class,sections.section,subjects.name as sname,teacherdiary_detail.description as tdes,teacherdiary_detail.subject_id,teacherdiary_detail.id as detail_id");
           $this->db->join("teacherdiary_detail",'teacherdiary_detail.header_id=teacherdiary.id','left');
           $this->db->join("classes",'teacherdiary.class_section_id=classes.id',"left");
           $this->db->join("sections",'teacherdiary.section_id=sections.id',"left");
           $this->db->join("subjects",'teacherdiary_detail.subject_id=subjects.id',"left");

           $this->db->where('teacherdiary.id',$id);


        } else {

                $this->db->select('qrecord.*,students.firstname as fname,students.lastname as lname,classes.class,sections.section');
                $this->db->select('qrecord.*');
                $this->db->join('classes', 'classes.id = qrecord.class_section_id');
                $this->db->join('sections', 'sections.id = qrecord.section_id');
                $this->db->join('students', 'students.id = qrecord.student_id');
                $this->db->order_by('qrecord.id');
        }

        $query = $this->db->get("qrecord");
     
        if ($id != null) {
            return $query;
        } else {
            return $query->result_array();
        }
    }


  
 function getByeachTeacher($teacher_id)
    {
        $this->db->select("teacherdiary.*,classes.class,sections.section,teachers.name as tname");
           $this->db->join("classes",'teacherdiary.class_section_id=classes.id',"left");
           $this->db->join("sections",'teacherdiary.section_id=sections.id',"left");
        $this->db->join('teachers', 'teachers.id = teacherdiary.teacher_id');
          $this->db->where('teacherdiary.teacher_id',$teacher_id);
            $query = $this->db->get("teacherdiary");
            return $query->result_array();

    }



    public function teachersjubject($id = null) {
        $this->db->select()->from('teacher_subjects');
        if ($id != null) {
            $this->db->where('teacher_id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('teacherdiary');
    }


    public function add($data) {
        if (isset($data['id'])) {
         
            $this->db->where('id', $data['id']);
            $this->db->update('teacherdiary', $data);
        } else {
            
            $this->db->insert('teacherdiary', $data);

            return $this->db->insert_id();
        }
    }

}
