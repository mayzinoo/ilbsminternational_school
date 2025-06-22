<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FPattandance extends CI_Controller {
    
    function index()
    {
        $this->load->view("FPtemplate");
    }
  
    
    function save_attend()
    {
        
        $session_id = $this->setting_model->getCurrentSession();
        $path="../../EssentialSchool/ILBSM/";
        $dir_name = opendir($path);
        while (($file = readdir($dir_name)) !== false)
            {
            
                    $path_parts = pathinfo($dir_name.$file);
                    if($path_parts['extension']=="json")
                    {
                            $json=file_get_contents($path.$file);
                            $json_data = json_decode($json,true);
                            $c= count($json_data);
                            $i=0;
                            
                            foreach ($json_data as $key1 => $value1) {
                            
                            $row=$this->student_model->getFpdata($value1["userid"],$value1["machineid"]);

                             $check=$this->db->get_where("student_attendences",array('student_id'=>$value1["userid"],'created_at'=>date("Y-m-d",strtotime($value1["attendtime"]))));    
                             
                     if($check->num_rows()<1)
                            {          
                                

                            $data=array(
                                
                                     'machine_id'=>$value1["machineid"],
                                     'class_id'=>$row->class_id,
                                     'section_id'=>$row->section_id,
                                     'student_id'=>$row->student_id,
                                     'finger_id'=>$value1["userid"],
                                     'session_id'=>$session_id,
                                    'in_time'=>$value1["attendtime"],
                                    'created_at'=>date("Y-m-d",strtotime($value1["attendtime"])),
                                    'status'=>"Present"
                                );
                            $qry=$this->db->insert("student_attendences",$data);
                            
                            }
                            else
                            {
                            
                            
                            $data=array(
                                    'machine_id'=>$value1["machineid"],
                                    'out_time'=>$value1["attendtime"],
                                );
                                
                            $this->db->where("student_id",$value1["userid"]);
                            $this->db->where("created_at",date("Y-m-d",strtotime($value1["attendtime"])));
                            $qry=$this->db->update("student_attendences",$data);
                            
                            }
                            
                            $i++;
                                    
                                    }
                            
                            if($c==$i)
                            {
                               unlink($path.$file);
                            }
                    
                    }
            
            }
        
        
        closedir($dir_name);
        
            }
    
    
    
}



?>