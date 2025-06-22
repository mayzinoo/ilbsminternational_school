<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weeklypreparation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }


    public function get($id = null) {
        if ($id != null) {
        
           $this->db->select("weeklypreparation.*,classes.class,teachers.name as tname,subjects.name as sname,weeklypreparation_detail.grade,weeklypreparation_detail.description as tdes,weeklypreparation_detail.subject_id,weeklypreparation_detail.id as detail_id");
           $this->db->join("weeklypreparation_detail",'weeklypreparation_detail.header_id=weeklypreparation.id','left');
           $this->db->join("classes",'weeklypreparation_detail.grade=classes.id',"left");
           $this->db->join("teachers",'weeklypreparation.teacher_id=teachers.id',"left");
           $this->db->join("subjects",'weeklypreparation_detail.subject_id=subjects.id',"left");

           $this->db->where('weeklypreparation.id',$id);


        } else {

                $this->db->select('weeklypreparation.*,teachers.name as tname');
                $this->db->select('weeklypreparation.*');
                $this->db->join('teachers', 'teachers.id = weeklypreparation.teacher_id');
                $this->db->order_by('weeklypreparation.id');
        }

        $query = $this->db->get("weeklypreparation");
     
        if ($id != null) {
            return $query;
        } else {
            return $query->result_array();
        }
    }
    
    
    function search($date_from,$date_to)
    {
        $date_from=date("Y-m-d",strtotime($date_from));
        $date_to=date("Y-m-d",strtotime($date_to));
         $this->db->select('weeklypreparation.*,teachers.name as tname');
                $this->db->select('weeklypreparation.*');
                $this->db->join('teachers', 'teachers.id = weeklypreparation.teacher_id');
                $this->db->where('weeklypreparation.date_from >=',$date_from);
                $this->db->where('weeklypreparation.date_to <=',$date_to);

                $this->db->order_by('weeklypreparation.id');
                $query = $this->db->get("weeklypreparation");
            return $query->result_array();

    }
    
    function get_weeklypreparation($sid)
    {
                $session_id = $this->setting_model->getCurrentSession();

                $qry=$this->db->get_where("student_session",array("student_id"=>$sid,'session_id'=>$session_id))->row();
                $class_id=$qry->class_id;
             
        
                $query=$this->db->query("SELECT weeklypreparation.*,teachers.name as tname FROM weeklypreparation 
                LEFT JOIN teachers ON teachers.id = weeklypreparation.teacher_id
                WHERE weeklypreparation.class_section_id='$class_id' ");
                return $query->result_array();
    }



 function getByeachTeacher($teacher_id)
    {
        $this->db->select("weeklypreparation.*,classes.class,sections.section,teachers.name as tname");
           $this->db->join("classes",'weeklypreparation.class_section_id=classes.id',"left");
           $this->db->join("sections",'weeklypreparation.section_id=sections.id',"left");
        $this->db->join('teachers', 'teachers.id = weeklypreparation.teacher_id');
          $this->db->where('weeklypreparation.teacher_id',$teacher_id);
            $query = $this->db->get("weeklypreparation");
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
        $this->db->delete('weeklypreparation');
        
         $this->db->where('header_id', $id);
        $this->db->delete('weeklypreparation_detail');
    }

    public function deleteBatch($ids, $class_section_id) {


        $this->db->where('class_section_id', $class_section_id);
        $this->db->where('session_id', $this->current_session);
        $this->db->where_not_in('id', $ids);
        $this->db->delete('teacher_subjects');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
         
            $this->db->where('id', $data['id']);
            $this->db->update('weeklypreparation', $data);
           
        } else {
            
            $this->db->insert('weeklypreparation', $data);

            return $this->db->insert_id();
        }
    }

    public function getDetailByclassAndSection($class_section_id) {
        $this->db->select()->from('teacher_subjects');
        $this->db->where('class_section_id', $class_section_id);
        $this->db->where('teacher_subjects.session_id', $this->current_session);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDetailbyClsandSection($class_id, $section_id, $exam_id) {
        $query = $this->db->query("SELECT teacher_subjects.*,exam_schedules.date_of_exam,exam_schedules.start_to,exam_schedules.end_from,exam_schedules.room_no,exam_schedules.full_marks,exam_schedules.passing_marks,subjects.name,
            subjects.type FROM `teacher_subjects` LEFT JOIN `exam_schedules` ON exam_schedules.teacher_subject_id=teacher_subjects.id AND exam_schedules.exam_id = " . $this->db->escape($exam_id) . "  INNER JOIN subjects
            ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections
            ON teacher_subjects.class_section_id = class_sections.id WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id));
        return $query->result_array();
    }

    public function getSubjectByClsandSection($class_id, $section_id) {
        $sql = "SELECT teacher_subjects.*,teachers.name as `teacher_name`, subjects.name,subjects.type,subjects.code FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id INNER JOIN teachers ON teachers.id = teacher_subjects.teacher_id  WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and teacher_subjects.session_id=" . $this->db->escape($this->current_session);

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getTeacherClassSubjects($teacher_id) {
        $this->db->select('teacher_subjects.*,subjects.name,classes.class,sections.section');
        $this->db->from('teacher_subjects');
        $this->db->join('subjects', 'subjects.id = teacher_subjects.subject_id');
        $this->db->join('class_sections', 'class_sections.id = teacher_subjects.class_section_id');
        $this->db->join('classes', 'classes.id = class_sections.class_id');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->where('teacher_subjects.teacher_id', $teacher_id);
        $this->db->where('teacher_subjects.session_id', $this->current_session);
        $query = $this->db->get();
        return $query->result();
    }

}
