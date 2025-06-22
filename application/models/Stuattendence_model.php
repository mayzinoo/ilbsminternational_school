<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stuattendence_model extends CI_Model {

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
    function get($class, $section, $year,$month)
    {
       $sessionid=$this->uri->segment(4);    

      
       $query=$this->db->query("SELECT
                      students.firstname,students.lastname,
                      
                    MAX(if(day(student_attendences.created_at) = 1, LEFT(student_attendences.status,1),'')) AS 'one',
                      MAX(if(day(student_attendences.created_at) = 2, LEFT(student_attendences.status,1),'')) AS 'two',
                      MAX(if(day(student_attendences.created_at) = 3, LEFT(student_attendences.status,1),'')) AS 'three',
                      MAX(if(day(student_attendences.created_at) = 4, LEFT(student_attendences.status,1),'')) AS 'four',
                      MAX(if(day(student_attendences.created_at) = 5, LEFT(student_attendences.status,1),'')) AS 'five',
                      MAX(if(day(student_attendences.created_at) = 6, LEFT(student_attendences.status,1),'')) AS 'six',
                      MAX(if(day(student_attendences.created_at) = 7, LEFT(student_attendences.status,1),'')) AS 'seven',
                      MAX(if(day(student_attendences.created_at) = 8, LEFT(student_attendences.status,1),'')) AS 'eight',
                      MAX(if(day(student_attendences.created_at) = 9, LEFT(student_attendences.status,1),'')) AS 'nine',
                      MAX(if(day(student_attendences.created_at) = 10, LEFT(student_attendences.status,1),''))  AS 'ten',
                      MAX(if(day(student_attendences.created_at) = 11, LEFT(student_attendences.status,1),''))  AS 'elev',
                     MAX(if(day(student_attendences.created_at) = 12, LEFT(student_attendences.status,1),''))  AS 'twle',
                      MAX(if(day(student_attendences.created_at) = 13, LEFT(student_attendences.status,1),''))  AS 'thirteen',
                      MAX(if(day(student_attendences.created_at) = 14, LEFT(student_attendences.status,1),''))  AS 'fourteen',
                      MAX(if(day(student_attendences.created_at) = 15, LEFT(student_attendences.status,1),''))  AS 'fifteen',

                      MAX(if(day(student_attendences.created_at) = 16, LEFT(student_attendences.status,1),'')) AS `sixteen`,
                      MAX(if(day(student_attendences.created_at) = 17, LEFT(student_attendences.status,1),'')) AS `sevteen`,
                      MAX(if(day(student_attendences.created_at) = 18, LEFT(student_attendences.status,1),'')) AS `eighteen`,
                      MAX(if(day(student_attendences.created_at) = 19, LEFT(student_attendences.status,1),'')) AS `nineteen`,
                      MAX(if(day(student_attendences.created_at) = 20, LEFT(student_attendences.status,1),'')) AS `twenty`,
                      MAX(if(day(student_attendences.created_at) = 21, LEFT(student_attendences.status,1),'')) AS `twenone`,
                      MAX(if(day(student_attendences.created_at) = 22, LEFT(student_attendences.status,1),'')) AS `twentwo`,
                      MAX(if(day(student_attendences.created_at) = 23, LEFT(student_attendences.status,1),'')) AS `twenthree`,
                      MAX(if(day(student_attendences.created_at) = 24, LEFT(student_attendences.status,1),'')) AS `twenfour`,
                      MAX(if(day(student_attendences.created_at) = 25, LEFT(student_attendences.status,1),'')) AS `twenfive`,
                      MAX(if(day(student_attendences.created_at) = 26, LEFT(student_attendences.status,1),'')) AS `twensix`,
                      MAX(if(day(student_attendences.created_at) = 27, LEFT(student_attendences.status,1),'')) AS `twensev`,
                      MAX(if(day(student_attendences.created_at) = 28, LEFT(student_attendences.status,1),'')) AS `tweneig`,
                      MAX(if(day(student_attendences.created_at) = 29, LEFT(student_attendences.status,1),'')) AS `twennine`,
                      MAX(if(day(student_attendences.created_at) = 30, LEFT(student_attendences.status,1),'')) AS `thirty`,
                      MAX(if(day(student_attendences.created_at) = 31, LEFT(student_attendences.status,1),'')) AS `thirtyone`,
                      count(if(student_attendences.status = 'Present', 1, NULL))  AS 'totalpresent',
                      count(if(student_attendences.status = 'Absent', 1, NULL))  AS 'totalabsent',
                      count(if(student_attendences.status = 'Holiday', 1, NULL))  AS 'totalholiday',
                      count(if(student_attendences.status = 'Leave', 1, NULL))  AS 'totalleave'

                   
                    FROM student_attendences 
                    LEFT join students ON student_attendences.student_id=students.id where
                     year(student_attendences.created_at)='$year' 
                    AND month(student_attendences.created_at)='$month'
                    AND student_attendences.class_id='$class'
                    AND student_attendences.section_id='$section'
                    GROUP BY student_attendences.student_id");      
 
/* $error = $this->db->error();
                
                    echo $error['message'];
                    exit;*/
                
                 return $query;
      
    }


    function get_school_calendar($session_id)
    {
        $query=$this->db->query(" SELECT att_day,

            MAX(if(school_calendar.att_month = 1, att_day, 0))  AS 'Jan_attday',
            MAX(if(school_calendar.att_month = 2, att_day, 0))  AS 'Feb_attday',
            MAX(if(school_calendar.att_month = 3, att_day, 0))  AS 'Mar_attday',
            MAX(if(school_calendar.att_month = 4, att_day, 0))  AS 'Apr_attday',
            MAX(if(school_calendar.att_month = 5, att_day, 0))  AS 'May_attday',
            MAX(if(school_calendar.att_month = 6, att_day, 0))  AS 'Jun_attday',
            MAX(if(school_calendar.att_month = 7, att_day, 0))  AS 'Jul_attday',
            MAX(if(school_calendar.att_month = 8, att_day, 0))  AS 'Aug_attday',
            MAX(if(school_calendar.att_month = 9, att_day, 0))  AS 'Sept_attday',
            MAX(if(school_calendar.att_month = 10, att_day, 0))  AS 'Oct_attday',
            MAX(if(school_calendar.att_month = 11, att_day, 0))  AS 'Nov_attday',
            MAX(if(school_calendar.att_month = 12, att_day, 0))  AS 'Dec_attday',


            SUM(school_calendar.att_day)  AS 'totalatt_day'


            FROM school_calendar WHERE school_calendar.session_id='$session_id'");


        return $query->row();


    }

    function get_monthly_attendenceList($class,$section,$session_id)
    {

      $query=$this->db->query("SELECT
             students.firstname,students.lastname,
               count(if(month(student_attendences.created_at)= 1 && student_attendences.status='Present', 1, NULL))  AS Jan,
            count(if(month(student_attendences.created_at)= 2 && student_attendences.status='Present', 1, NULL))  AS Feb,         
            count(if(month(student_attendences.created_at)= 3 && student_attendences.status='Present', 1, NULL))  AS Mar,        
            count(if(month(student_attendences.created_at)= 5 && student_attendences.status='Present', 1, NULL))  AS May,          
              count(if(month(student_attendences.created_at)= 6 && student_attendences.status='Present', 1, NULL))  AS Jun,          
            count(if(month(student_attendences.created_at)= 7 && student_attendences.status='Present', 1, NULL))  AS Jul,            
            count(if(month(student_attendences.created_at)= 8 && student_attendences.status='Present', 1, NULL))  AS Aug,           
            count(if(month(student_attendences.created_at)= 9 && student_attendences.status='Present', 1, NULL))  AS Sep,           
            count(if(month(student_attendences.created_at)= 10 && student_attendences.status='Present', 1, NULL)) AS Oct,          
            count(if(month(student_attendences.created_at)= 11 && student_attendences.status='Present', 1, NULL)) AS Nov,           
            count(if(month(student_attendences.created_at)= 12 && student_attendences.status='Present', 1, NULL)) AS `Dec`,          
          count(if(month(student_attendences.created_at)  != 5 && student_attendences.status = 'Present', 1, NULL))  AS 'totalpresent',
        count(if(student_attendences.status = 'Present', 1, NULL))  AS 'MtotalP',
           count(if(student_attendences.status = 'Absent', 1, NULL))  AS 'totalabsent',
            count(if(student_attendences.status = 'Holiday', 1, NULL))  AS 'totalholiday',
            count(if(student_attendences.status = 'Leave', 1, NULL))  AS 'totalleave'


          FROM student_attendences 
                    LEFT join students ON student_attendences.student_id=students.id 
                    where
                     student_attendences.session_id='$session_id'
                    AND student_attendences.class_id='$class'
                    AND student_attendences.section_id='$section'
                   
                    GROUP BY student_attendences.student_id"); 

  /*    echo $this->db->last_query();

      $err=$this->db->error();
      echo $err["message"];
      exit;*/
        return $query;
           
        

    }

    function monthlyattandence_percent($class,$section,$session_id)
    {

      $query=$this->db->query("SELECT
             students.firstname,students.lastname,
               count(if(month(student_attendences.created_at)= 1 && student_attendences.status='Present', 1, NULL))  AS Jan,
            count(if(month(student_attendences.created_at)= 2 && student_attendences.status='Present', 1, NULL))  AS Feb,         
            count(if(month(student_attendences.created_at)= 3 && student_attendences.status='Present', 1, NULL))  AS Mar,        
            count(if(month(student_attendences.created_at)= 5 && student_attendences.status='Present', 1, NULL))  AS May,          
              count(if(month(student_attendences.created_at)= 6 && student_attendences.status='Present', 1, NULL))  AS Jun,          
            count(if(month(student_attendences.created_at)= 7 && student_attendences.status='Present', 1, NULL))  AS Jul,            
            count(if(month(student_attendences.created_at)= 8 && student_attendences.status='Present', 1, NULL))  AS Aug,           
            count(if(month(student_attendences.created_at)= 9 && student_attendences.status='Present', 1, NULL))  AS Sep,           
            count(if(month(student_attendences.created_at)= 10 && student_attendences.status='Present', 1, NULL)) AS Oct,          
            count(if(month(student_attendences.created_at)= 11 && student_attendences.status='Present', 1, NULL)) AS Nov,           
            count(if(month(student_attendences.created_at)= 12 && student_attendences.status='Present', 1, NULL)) AS `Dec`,          
          count(if(month(student_attendences.created_at)  != 5 && student_attendences.status = 'Present', 1, NULL))  AS 'totalpresent',
              
             count(if(student_attendences.status = 'Present', 1, NULL))  AS 'MtotalP',
            count(if(student_attendences.status = 'Absent', 1, NULL))  AS 'totalabsent',
            count(if(student_attendences.status = 'Holiday', 1, NULL))  AS 'totalholiday',
            count(if(student_attendences.status = 'Leave', 1, NULL))  AS 'totalleave'


          FROM student_attendences 
                    LEFT join students ON student_attendences.student_id=students.id 
                    where
                     student_attendences.session_id='$session_id'
                    AND student_attendences.class_id='$class'
                    AND student_attendences.section_id='$section'
                   
                    GROUP BY student_attendences.student_id"); 

  
        return $query;          
        

    }




     function get_absent()
    {
             
        $this->db->select("students.*,student_attendences.created_at as fcdate,DATE_FORMAT(in_time, '%Y-%m-%d %h:%i:%s %p') as a,student_attendences.*,classes.class,sections.section");
        $this->db->join("student_attendences","students.id =student_attendences.student_id",'inner');
        $this->db->join("student_session","students.id =student_session.student_id",'inner');
        $this->db->join("classes","student_session.class_id =classes.id","inner");
        $this->db->join("sections","student_session.section_id =sections.id","inner");
        $this->db->like("student_session.created_at",date("Y"),'after');
        $this->db->like("student_attendences.created_at",date("Y-m-d"));
        $this->db->where("student_attendences.status","Absent");
        $query=$this->db->order_by("student_attendences.id","DESC")->get("students");          
     
       return $query;
    }
    function get_leave()
    {
             
        $sessionid=$this->uri->segment(4);  
        $this->db->select("student_attendences.*,students.*,classes.class,sections.section");
        $this->db->join("students","students.id =student_attendences.student_id");
        $this->db->join("classes","student_attendences.class_id =classes.id");
        $this->db->join("sections","student_attendences.section_id =sections.id");
        $this->db->where("student_attendences.session_id",'$sessionid');
        $this->db->where("student_attendences.status",'Leave');
        $query=$this->db->get("student_attendences");
     
       return $query;
    }
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_attendences', $data);
        } else {
            $this->db->insert('student_attendences', $data);
        }
    }

    public function searchAttendenceClassSection($class_id, $section_id, $date) {

        $this->db->select("student_attendences.*,students.firstname,students.lastname,students.admission_no,students.father_name,student_attendences.created_at as fcdate,classes.class,sections.section");
        $this->db->join("students","students.id =student_attendences.student_id","left");
        $this->db->join("classes","student_attendences.class_id =classes.id","left");
        $this->db->join("sections","student_attendences.section_id =sections.id","left");
        $this->db->where("student_attendences.class_id",$class_id);
        $this->db->where("student_attendences.section_id",$section_id);
        $this->db->where("student_attendences.created_at",$date);
       // $this->db->where("student_attendences.status","Present");
        $query=$this->db->order_by("student_attendences.id","DESC")->get("student_attendences");   
        return $query;
    }
    

    public function searchAbsentClassSection($class_id, $section_id, $month) {


        $this->db->select("student_attendences.*,students.firstname,students.lastname,students.admission_no,students.father_name,student_attendences.created_at as fcdate,classes.class,sections.section");
        $this->db->join("students","students.id =student_attendences.student_id","left");
        $this->db->join("classes","student_attendences.class_id =classes.id","left");
        $this->db->join("sections","student_attendences.section_id =sections.id","left");
        $this->db->where("student_attendences.class_id",$class_id);
        $this->db->where("student_attendences.section_id",$section_id);
        $this->db->where("MONTHNAME(student_attendences.created_at)",$month);
        $this->db->where("student_attendences.status","Absent");
        $query=$this->db->order_by("student_attendences.id","DESC")->get("student_attendences");     
        return $query;
    }
    

    public function searchLeaveClassSection($class_id, $section_id, $month) {


       $this->db->select("student_attendences.*,students.firstname,students.lastname,students.admission_no,students.father_name,student_attendences.created_at as fcdate,classes.class,sections.section");
        $this->db->join("students","students.id =student_attendences.student_id","left");
        $this->db->join("classes","student_attendences.class_id =classes.id","left");
        $this->db->join("sections","student_attendences.section_id =sections.id","left");
        $this->db->where("student_attendences.class_id",$class_id);
        $this->db->where("student_attendences.section_id",$section_id);
        $this->db->where("MONTHNAME(student_attendences.created_at)",$month);
        $this->db->where("student_attendences.status","Leave");
        $query=$this->db->order_by("student_attendences.id","DESC")->get("student_attendences");     
        return $query;
    }
    
    
    
    public function searchAttendenceClassSectionPrepare($class_id, $section_id, $date) {
$query = $this->db->query("select student_sessions.attendence_id,students.firstname,
students.admission_no,student_sessions.date,students.roll_no,
students.lastname,student_sessions.attendence_type_id,
student_sessions.id as student_session_id from students ,
(SELECT student_session.id,student_session.student_id ,
IFNULL(student_attendences.date, 'xxx') as date,
IFNULL(student_attendences.id, 0) as attendence_id,
student_attendences.attendence_type_id FROM `student_session` 
RIGHT JOIN student_attendences ON student_attendences.student_id=student.id 
and student_attendences.date=" . $this->db->escape($date) . " 
and student_session.class_id=" . $this->db->escape($class_id) . " 
and student_session.section_id=" . $this->db->escape($section_id) . ") 
as student_sessions where student_sessions.student_id=students.id");

        return $query->result_array();
    }

}
