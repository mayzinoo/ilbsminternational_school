<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Inter Reportcard</h1>
    </section>   
    <section class="content">
        <div class="row">
           
            <div class="col-md-12">
                <div class="box box-primary">
                               
                    <div class="box-body">
                    <div class="download_label"><?php echo $this->lang->line('subject_list'); ?></div>
                                            

 <table class="table table-bordered">
                            <tr>
                                <th>Month</th>
                                <?php
                                $sbj_arr=array();
                                $subjects=$this->db->get_where("subjects",array("code"=>1,'level'=>'inter'));

                                foreach($subjects->result() as $s):
                                    $sbj_arr[]=$s->id;
                                    
                                ?>
                                <th><?=substr($s->name,0,5)?></th>
                               
                                <?php
                                endforeach;
                                ?>
                                <th>Grade</th>
                            </tr>
                           <?php
                            $student_id = $this->customlib->getStudentSessionUserID();
                            $student=$this->session->userdata("student");
                            $session_id = $this->setting_model->getCurrentSession();

                            $r=$this->db->get_where("student_session",array("student_id"=>$student_id,"session_id"=>$session_id))->row();
                            $inter_class=$r->inter_class;
                           $this->db->select("inter_exam_schedules.*,inter_exam_schedules.id as esid,exams.name as ename");
                           $this->db->join("inter_exam_schedules","exams.id=inter_exam_schedules.exam_id","left");
                           $this->db->where("inter_exam_schedules.inter_class",$inter_class);
                           $exs=$this->db->get("exams");

                           foreach($exs->result() as $e):
                               
                                 $total=0;
                                $fullmark=0;
                               
                             $a=0;

                           ?>
                        <tr> 
                                
                            
                                
                                <th><?=$e->ename?></th>
                                <?php for($i=0;$i<count($sbj_arr);$i++){
                                $this->db->where("exam_schedule_id",$e->id);
                                $this->db->where("subject_id",$sbj_arr[$i]);
                                $this->db->where("student_id",$student_id);
                                $res=$this->db->get("inter_exam_results");

                              
                                foreach($res->result() as $mk):
                                 $mavg=($mk->get_marks/$mk->full_marks)*100;
                                $grades=$this->Reportcard_model->get_grades(floor($mavg));
                                $mg=$grades->name;
                                
                                ?>
                                <td><?=$mg;?></td>
                                <?php 
                                $fullmark+=$mk->full_marks;
                                $total+=$mk->get_marks;
                                
                                $a++;

                                endforeach;
                                }
                                
                                 for($t=1;$t<=(count($sbj_arr)-$a);$t++)
                                {
                                    echo "<td></td>";
                                }
                                
                                
                                ?>
                                

                                <td> <?php
                               if($fullmark==0)
                                {$mavg=0;$mg="";}
                                else{ 
                                 $mavg=($total/$fullmark)*100;
                                $grades=$this->Reportcard_model->get_grades(floor($mavg));
                                $mg=$grades->name;
                                }

                                
                          echo $mg;
                          
                          ?>

                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                       
                            <tr>
                                 <th>Total</th>
                                 <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                            
                        </table>
                          </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>