<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dailyrecord_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        if ($id != null) {
            
            $this->db->select("dailyrecord.*,classes.class,sections.section,subjects.name as sname,dailyrecord_detail.description as tdes,dailyrecord_detail.subject_id,dailyrecord_detail.id as detail_id,dailyrecord_detail.grade,dailyrecord_detail.times");
           $this->db->join("dailyrecord_detail",'dailyrecord_detail.header_id=dailyrecord.id','left');
           $this->db->join("classes",'dailyrecord.class_section_id=classes.id',"left");
           $this->db->join("sections",'dailyrecord.section_id=sections.id',"left");
           $this->db->join("subjects",'dailyrecord_detail.subject_id=subjects.id',"left");
           $this->db->where('dailyrecord.id',$id);

        } else {

                $this->db->select('dailyrecord.*,classes.class,sections.section');
                $this->db->select('dailyrecord.*');
                $this->db->join('classes', 'classes.id = dailyrecord.class_section_id');
                $this->db->join('sections', 'sections.id = dailyrecord.section_id');
                $this->db->order_by('dailyrecord.id');
        }

        $query = $this->db->get("dailyrecord");
        if ($id != null) {
            return $query;
        } else {
            return $query->result_array();
        }
    }

    function get_dailyrecord($sid)
    {
                // $this->db->select('dailyrecord.*,classes.class,sections.section');
                // $this->db->select('dailyrecord.*');
                // $this->db->join('classes', 'classes.id = dailyrecord.class_section_id');
                // $this->db->join('sections', 'sections.id = dailyrecord.section_id');
                // $this->db->join('student_session','student_session.section_id=sections.id');
            
                // $this->db->where("student_session.student_id",$sid);
                // $this->db->order_by('dailyrecord.id');
                // $query = $this->db->get("dailyrecord");
                
                $qry=$this->db->get_where("student_session",array("student_id"=>$sid))->row();
                $class_id=$qry->class_id;
                $section_id=$qry->section_id;
                $session_id=$qry->session_id;
                $qry2=$this->db->get_where("class_sections",array("class_id"=>$class_id,"section_id=>$section_id"))->row();
                
                $csid=$qry2->id;
                // echo $csid; exit;
                
                $query=$this->db->query("SELECT dailyrecord.*,subjects.name,teachingnote.lessontitle FROM dailyrecord LEFT JOIN teacher_subjects ON teacher_subjects.class_section_id = dailyrecord.class_section_id LEFT JOIN subjects ON teacher_subjects.subject_id = subjects.id LEFT JOIN teachingnote ON teachingnote.class_section_id=dailyrecord.class_section_id WHERE dailyrecord.section_id='$section_id' AND dailyrecord.class_section_id='$csid' ");
                
                
                // $query=$this->db->query("SELECT * FROM dailyrecord LEFT JOIN teacher_subjects ON dailyrecord.class_section_id =teacher_subjects.class_section_id WHERE dailyrecord.class_section_id='$csid'");
                
                // $this->db->select("dailyrecord.*,teacher_subjects.*");
                // // $this->db->group_by("dailyrecord.class_section_id");
                //  $this->db->join("teacher_subjects","dailyrecord.class_section_id=teacher_subjects.class_section_id",'inner');
                // // $this->db->join("subjects","subjects.id=teacher_subjects.subject_id");
                // $query=$this->db->get_where("dailyrecord",array("dailyrecord.class_section_id"=>$csid));
                
                // $this->db->select('dailyrecord.*,teacher_subjects.subject_id,subjects.name as sub');
                // $this->db->from('dailyrecord');
                // $this->db->join('teacher_subjects', 'teacher_subjects.class_section_id = dailyrecord.class_section_id','inner');
                // $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id','inner');
                // $this->db->where('dailyrecord.class_section_id', '$csid');
                // $query = $this->db->get();
                
                // echo $query->sub;exit;
                // echo $query->num_rows(); exit;
                return $query->result_array();
    }



 function getByeachTeacher($teacher_id)
    {
        $this->db->select("dailyrecord.*,classes.class,sections.section,teachers.name as tname");
           $this->db->join("classes",'dailyrecord.class_section_id=classes.id',"left");
           $this->db->join("sections",'dailyrecord.section_id=sections.id',"left");
        $this->db->join('teachers', 'teachers.id = dailyrecord.teacher_id');
          $this->db->where('dailyrecord.teacher_id',$teacher_id);
            $query = $this->db->get("dailyrecord");
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
        $this->db->delete('dailyrecord');
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
            $this->db->update('dailyrecord', $data);
        } else {
            
            $this->db->insert('dailyrecord', $data);
           

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
