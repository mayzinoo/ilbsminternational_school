<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Improvement_result_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

     public function get($id = null) {
        if ($id != null) {
           $this->db->select("improvement_result.*,improvement_result_details.*,teachers.name as tname,students.firstname,students.lastname,students.admission_no,classes.class,sections.section,improvement.lessontitle");
           $this->db->join("improvement",'improvement_result.improvement_id=improvement.id');
           $this->db->join("improvement_result_details",'improvement_result.id=improvement_result_details.header_id',"RIGHT");
           $this->db->join("teachers",'improvement_result.teacher_id=teachers.id');
           $this->db->join("students",'improvement_result_details.student_id=students.id',"LEFT");
           $this->db->join("classes",'improvement_result.class_id=classes.id');
           $this->db->join("sections",'improvement_result.section_id=sections.id');  
           $this->db->where("improvement_result.id",$id);

        } else {
        $this->db->select("improvement_result.*,teachers.name as tname,classes.class,sections.section,improvement.lessontitle");
           $this->db->join("improvement",'improvement_result.improvement_id=improvement.id');
           $this->db->join("teachers",'improvement_result.teacher_id=teachers.id');
           $this->db->join("classes",'improvement_result.class_id=classes.id');
           $this->db->join("sections",'improvement_result.section_id=sections.id');  
           $this->db->order_by('improvement_result.created_at',"DESC");
           $this->db->group_by("improvement_result.improvement_id");
        $this->db->group_by("improvement_result.created_at");

        }

        $query = $this->db->get('improvement_result');
      

       if(!$query)
       {
             $error = $this->db->error();
             echo $error["message"];
             exit;
       }
        if ($id != null) {
            return $query;
        } else {
            return $query;
        }
    }

    public function get_kgresult($id = null) {
        if ($id != null) {
           $this->db->select("kgimprovement_result.*,kgimprovement_result_details.*,teachers.name as tname,students.firstname,students.lastname,students.admission_no,classes.class,sections.section,improvement.lessontitle");
           $this->db->join("kgimprovement",'kgimprovement_result.improvement_id=kgimprovement.id');
           $this->db->join("kgimprovement_result_details",'kgimprovement_result.id=kgimprovement_result_details.header_id',"RIGHT");
           $this->db->join("teachers",'kgimprovement_result.teacher_id=teachers.id');
           $this->db->join("students",'kgimprovement_result_details.student_id=students.id',"LEFT");
           $this->db->join("classes",'kgimprovement_result.class_id=classes.id');
           $this->db->join("sections",'kgimprovement_result.section_id=sections.id');  
           $this->db->where("kgimprovement_result.id",$id);

        } else {
        $this->db->select("kgimprovement_result.*,teachers.name as tname,classes.class,sections.section,kgimprovement.lessontitle");
           $this->db->join("kgimprovement",'kgimprovement_result.improvement_id=kgimprovement.id');
           $this->db->join("teachers",'kgimprovement_result.teacher_id=teachers.id');
           $this->db->join("classes",'kgimprovement_result.class_id=classes.id');
           $this->db->join("sections",'kgimprovement_result.section_id=sections.id');  
           $this->db->order_by('kgimprovement_result.created_at',"DESC");
           $this->db->group_by("kgimprovement_result.improvement_id");
        $this->db->group_by("kgimprovement_result.created_at");

        }

        $query = $this->db->get('kgimprovement_result');
      

       if(!$query)
       {
             $error = $this->db->error();
             echo $error["message"];
             exit;
       }
        if ($id != null) {
            return $query;
        } else {
            return $query;
        }
    }
    public function get_primaryresult($id = null) {
        if ($id != null) {
           $this->db->select("primary_result.*");
           $this->db->where("kgimprovement_result.id",$id);

        } else {
        $this->db->select("primary_result.*,teachers.name as tname,classes.class as class,sections.section as section,subjects.name as name");
        $this->db->join("teachers",'primary_result.teacher_id=teachers.id',"left");
        $this->db->join("classes",'primary_result.class_id=classes.id',"left");
        $this->db->join("sections",'primary_result.section_id=sections.id'); 
        $this->db->join("subjects",'primary_result.subject_id=subjects.id'); 
           $this->db->order_by('primary_result.created_at',"DESC");
           $this->db->group_by("primary_result.subject_id");
        $this->db->group_by("primary_result.created_at");

        }
        $query = $this->db->get('primary_result');
      

       if(!$query)
       {
             $error = $this->db->error();
             echo $error["message"];
             exit;
       }
        if ($id != null) {
            return $query;
        } else {
            return $query;
        }
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
        $this->db->delete('improvement');
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
            $this->db->update('improvement', $data);
        } else {
            
            $this->db->insert('improvement', $data);

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


    function search_result($class=NULL,$section=NULL,$from=NULL,$to=NULL,$value=NULL)
    {
          $this->db->select("improvement_result.*,teachers.name as tname, students.firstname,students.lastname,classes.class,sections.section,improvement.lessontitle");
           $this->db->join("improvement",'improvement_result.improvement_id=improvement.id','left');
           $this->db->join("teachers",'improvement_result.teacher_id=teachers.id','left');
           $this->db->join("students",'improvement_result.student_id=students.id','left');
           $this->db->join("classes",'improvement_result.class_id=classes.id','left');
           $this->db->join("sections",'improvement_result.section_id=sections.id','left');  
           $this->db->order_by('improvement_result.date',"DESC");
           if($class!=NULL)
           {
            $this->db->where("improvement_result.class_id",$class);
           }

            if($section!=NULL)
           {
            $this->db->where("improvement_result.section_id",$section);
           }

            if($from!=NULL & $to!=NULL)
           {
            $this->db->where("improvement_result.created_at >=",$from);
            $this->db->where("improvement_result.created_at <=",$to);
           }

          
           $query=$this->db->get("improvement_result");
           return $query->result_array();

    }

}
