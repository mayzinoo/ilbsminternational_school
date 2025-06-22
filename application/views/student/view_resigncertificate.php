<style>
    .padding_md{
        padding-top:30px;
        padding-bottom:30px;
    }
</style>
<div class="content-wrapper">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
       
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                
                <div class="box-body">
                    <div class="tshadow mb25 bozero">    
                        <h4 class="pagetitleh2">Student's Resign Certificate </h4>
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-striped tmb0">
                            <tr>
                                <td style="width:25%;">Student Name</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->student_name ; ?></td>
                            </tr>
                            <tr>
                                <td>NRC No</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->nrc_no ; ?></td>
                            </tr>
                            <tr>
                                <td>Enter Date</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->enter_date ;?></td>
                            </tr>
                            <tr>
                                <td>School Entering Number</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->enterschool_number ;?></td>
                            </tr>
                            <tr>
                                <td>Resign Date</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->resign_date ;?></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div><!--box primary-->
                <div class="box-body">
                    <div class="tshadow mb25 bozero">    
                        
                        <div class="table-responsive topmargin_sm">
                            <table class="table table-hover table-striped tmb0">
                            <tr>
                                <td style="width:25%;">Year (From)</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->edu_from ; ?></td>
                            </tr>
                            <tr>
                                <td>Year (To)</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->edu_to ; ?></td>
                            </tr>
                            <tr>
                                <td>Father Name</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->father_name ;?></td>
                            </tr>
                            <tr>
                                <td>Moved School</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->moved_school ;?></td>
                            </tr>
                            <tr>
                                <td>Moved Division</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->moved_division ;?></td>
                            </tr>
                            <tr>
                                <td>Moved Township</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->moved_township ;?></td>
                            </tr>
                            <tr>
                                <td>Moved City</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->moved_city ;?></td>
                            </tr>
                            <tr>
                                <td>Attendance Class</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->letattend_class ;?></td>
                            </tr>
                            <tr>
                                <td>Attendance Date</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->letattend_date ;?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->dob ;?></td>
                            </tr>
                            <tr>
                                <td>Now Attendance Class</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->nowattend_class ;?></td>
                            </tr>
                            <tr>
                                <td>Attended Date</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->attend_date ;?></td>
                            </tr>
                            <tr>
                                <td>Roll Call Time</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->rollcalltime ;?></td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>
                </div><!--box primary-->
                <div class="box-body">
                    <div class="tshadow mb25 bozero">    
                        <h4 class="pagetitleh2">Parent's Data </h4>
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-striped tmb0">
                            <tr>
                                <td style="width:25%;">Sign</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->parent_sign ; ?></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->parent_name ; ?></td>
                            </tr>
                            <tr>
                                <td>NRC No</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->parent_nrc ;?></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->parent_date ;?></td>
                            </tr>
                            
                        </table>
                        </div>
                    </div>
                </div><!--box primary-->
                <div class="box-body">
                    <div class="tshadow mb25 bozero">    
                        <h4 class="pagetitleh2">Principal's Data </h4>
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-striped tmb0">
                            <tr>
                                <td style="width:25%;">School</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->principal_school ; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><?php echo $resignstudent->principal_city ; ?></td>
                            </tr>
                            
                            
                        </table>
                        </div>
                    </div>
                </div><!--box primary-->
        </div>
    </div>
    </section>
</div>