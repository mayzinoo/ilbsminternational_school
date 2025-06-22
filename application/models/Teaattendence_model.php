<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teaattendence_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    function get($school, $year, $month)
    {

       
       $query=$this->db->query("SELECT
                      teachers.name,
                      
                    MAX(if(day(teacher_attendences.created_at) = 1, LEFT(teacher_attendences.status,1),'')) AS 'one',
                      MAX(if(day(teacher_attendences.created_at) = 2, LEFT(teacher_attendences.status,1),'')) AS 'two',
                      MAX(if(day(teacher_attendences.created_at) = 3, LEFT(teacher_attendences.status,1),'')) AS 'three',
                      MAX(if(day(teacher_attendences.created_at) = 4, LEFT(teacher_attendences.status,1),'')) AS 'four',
                      MAX(if(day(teacher_attendences.created_at) = 5, LEFT(teacher_attendences.status,1),'')) AS 'five',
                      MAX(if(day(teacher_attendences.created_at) = 6, LEFT(teacher_attendences.status,1),'')) AS 'six',
                      MAX(if(day(teacher_attendences.created_at) = 7, LEFT(teacher_attendences.status,1),'')) AS 'seven',
                      MAX(if(day(teacher_attendences.created_at) = 8, LEFT(teacher_attendences.status,1),'')) AS 'eight',
                      MAX(if(day(teacher_attendences.created_at) = 9, LEFT(teacher_attendences.status,1),'')) AS 'nine',
                      MAX(if(day(teacher_attendences.created_at) = 10, LEFT(teacher_attendences.status,1),''))  AS 'ten',
                      MAX(if(day(teacher_attendences.created_at) = 11, LEFT(teacher_attendences.status,1),''))  AS 'elev',
                     MAX(if(day(teacher_attendences.created_at) = 12, LEFT(teacher_attendences.status,1),''))  AS 'twle',
                      MAX(if(day(teacher_attendences.created_at) = 13, LEFT(teacher_attendences.status,1),''))  AS 'thirteen',
                      MAX(if(day(teacher_attendences.created_at) = 14, LEFT(teacher_attendences.status,1),''))  AS 'fourteen',
                      MAX(if(day(teacher_attendences.created_at) = 15, LEFT(teacher_attendences.status,1),''))  AS 'fifteen',

                      MAX(if(day(teacher_attendences.created_at) = 16, LEFT(teacher_attendences.status,1),'')) AS `sixteen`,
                      MAX(if(day(teacher_attendences.created_at) = 17, LEFT(teacher_attendences.status,1),'')) AS `sevteen`,
                      MAX(if(day(teacher_attendences.created_at) = 18, LEFT(teacher_attendences.status,1),'')) AS `eighteen`,
                      MAX(if(day(teacher_attendences.created_at) = 19, LEFT(teacher_attendences.status,1),'')) AS `nineteen`,
                      MAX(if(day(teacher_attendences.created_at) = 20, LEFT(teacher_attendences.status,1),'')) AS `twenty`,
                      MAX(if(day(teacher_attendences.created_at) = 21, LEFT(teacher_attendences.status,1),'')) AS `twenone`,
                      MAX(if(day(teacher_attendences.created_at) = 22, LEFT(teacher_attendences.status,1),'')) AS `twentwo`,
                      MAX(if(day(teacher_attendences.created_at) = 23, LEFT(teacher_attendences.status,1),'')) AS `twenthree`,
                      MAX(if(day(teacher_attendences.created_at) = 24, LEFT(teacher_attendences.status,1),'')) AS `twenfour`,
                      MAX(if(day(teacher_attendences.created_at) = 25, LEFT(teacher_attendences.status,1),'')) AS `twenfive`,
                      MAX(if(day(teacher_attendences.created_at) = 26, LEFT(teacher_attendences.status,1),'')) AS `twensix`,
                      MAX(if(day(teacher_attendences.created_at) = 27, LEFT(teacher_attendences.status,1),'')) AS `twensev`,
                      MAX(if(day(teacher_attendences.created_at) = 28, LEFT(teacher_attendences.status,1),'')) AS `tweneig`,
                      MAX(if(day(teacher_attendences.created_at) = 29, LEFT(teacher_attendences.status,1),'')) AS `twennine`,
                      MAX(if(day(teacher_attendences.created_at) = 30, LEFT(teacher_attendences.status,1),'')) AS `thirty`,
                      MAX(if(day(teacher_attendences.created_at) = 31, LEFT(teacher_attendences.status,1),'')) AS `thirtyone`

                   
                    FROM teacher_attendences 
                    LEFT join teachers ON teacher_attendences.teacher_id=teachers.id where
                     year(teacher_attendences.created_at)=year(now()) 
                    AND month(teacher_attendences.created_at)='$month'
                    GROUP BY teacher_attendences.teacher_id");      

                
                 return $query;
      
    }
    function getdetail($id = null)
    {
        if($id==null)
        {
             
        $this->db->select("teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,teacher_attendences.*");
        $this->db->join("teacher_attendences","teachers.id =teacher_attendences.teacher_id",'inner');
         $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get("teachers");          
     
        return $query;
        }

        else
        {
                    
        $this->db->select("teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,teacher_attendences.*");
        $this->db->join("teacher_attendences","teachers.id =teacher_attendences.teacher_id",'inner');
         $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get_where("teachers",array("teachers.id"=>$id));          
     
        return $query;
        }
    }
    function get_attendent()
    {
        // $this->db->select("teacher_attendences.*,teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a");
        // $this->db->join("teachers","teachers.id =teacher_attendences.teacher_id",'inner');
        //  $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        //  $this->db->where("teacher_attendences.status","Present");
        // $query=$this->db->order_by("teacher_attendences.id","DESC")->get("teacher_attendences"); 
        
        $this->db->select("teacher_attendences.*,teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a");
        $this->db->join("teachers","teachers.id=teacher_attendences.teacher_id",'inner');
        $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get_where("teacher_attendences",array("teacher_attendences.status"=>"Present")); 
        
        // $query=$this->db->get(teacher_attendences);
        return $query;
    }
      function get_absent()
    {

          $this->db->select("teacher_attendences.*,teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a");
        $this->db->join("teachers","teachers.id =teacher_attendences.teacher_id",'inner');
         $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        // $this->db->where("teacher_attendences.status","Absent");
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get_where("teacher_attendences",array("teacher_attendences.status"=>"Absent"));     
     
       return $query;
    }
      function get_leave()
    {

          $this->db->select("teacher_attendences.*,teachers.*,teacher_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a");
        $this->db->join("teachers","teachers.id =teacher_attendences.teacher_id",'inner');
         $this->db->like("teacher_attendences.created_at",date("Y-m-d"));
        // $this->db->where("teacher_attendences.status","Absent");
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get_where("teacher_attendences",array("teacher_attendences.status"=>"Leave"));     
     
       return $query;
    }
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('teacher_attendences', $data);
        } else {
            $this->db->insert('teacher_attendences', $data);
        }
    }

    public function searchAttendence($date) {

        $this->db->select("teachers.*,teacher_attendences.created_at as fcdate,teacher_attendences.*");
        $this->db->join("teacher_attendences","teachers.id =teacher_attendences.teacher_id");     
        $this->db->LIKE("teacher_attendences.created_at",$date);
        $query=$this->db->order_by("teacher_attendences.id","DESC")->get("teachers");          
        return $query;
    }
    

    public function searchAttendenceClassSectionPrepare($class_id, $section_id, $date) {
$query = $this->db->query("select student_sessions.attendence_id,teachers.firstname,
teachers.admission_no,student_sessions.date,teachers.roll_no,
teachers.lastname,student_sessions.attendence_type_id,
student_sessions.id as student_session_id from teachers ,
(SELECT student_session.id,student_session.teacher_id ,
IFNULL(teacher_attendences.date, 'xxx') as date,
IFNULL(teacher_attendences.id, 0) as attendence_id,
teacher_attendences.attendence_type_id FROM `student_session` 
RIGHT JOIN teacher_attendences ON teacher_attendences.teacher_id=student.id 
and teacher_attendences.date=" . $this->db->escape($date) . " 
and student_session.class_id=" . $this->db->escape($class_id) . " 
and student_session.section_id=" . $this->db->escape($section_id) . ") 
as student_sessions where student_sessions.teacher_id=teachers.id");

        return $query->result_array();
    }

}
