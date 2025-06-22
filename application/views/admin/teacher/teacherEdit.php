<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('edit_teacher'); ?></h3>
                    </div> 
                    <form action="<?php echo site_url('admin/teacher/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Location</label>
                               <?php 
                               echo form_dropdown("location",$locations,set_value('location',$teacher['location']),"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('location'); ?></span>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('teacher_name'); ?></label>
                                <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $teacher['name']); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            <!-- 
                               <div class="col-md-3">
                                <label for="exampleInputEmail1">Sub Admin Permission</label>
                                <div class="form-group">	
 									<input name="sub_admin" placeholder="" type="checkbox" class="form-checkbox"  value= />
                                <span class="text-danger"><?php echo form_error('sub_admin'); ?></span>
                                </div>			
                               
                            </div> -->
                            <div class="col-md-6">                            			
                            <label class="form-check-label" for="inlineFormCheck">Resign</label>
										
                              <?php echo form_dropdown("resign",array(0=>"No",1=>"Yes"),$teacher['resign'],"class='form-control'");?>
                                      

                           </div>	

                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">NRC No</label>
                                <input autofocus="" id="nrcno" name="nrcno" placeholder="" type="text" class="form-control"  value="<?php echo set_value('nrcno',$teacher['nrcno']); ?>" />
                                <span class="text-danger"><?php echo form_error('nrcno'); ?></span>
                            </div>
                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Finger ID</label>
                                                <input id="finger_id" name="finger_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('finger_id', $teacher['finger_id']); ?>"/>
                                                <span class="text-danger"><?php echo form_error('finger_id'); ?></span>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mac ID</label>
                                                <input id="machine_id" name="machine_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('machine_id', $teacher['machine_id']); ?>" />
                                                <span class="text-danger"><?php echo form_error('machine_id'); ?></span>
                                            </div>
                                        </div>  
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">RFID</label>
                                                <input id="rfid" name="rfid" placeholder="" type="text" class="form-control"  value="<?php echo set_value('rfid', $teacher['rfid']); ?>" />
                                                <span class="text-danger"><?php echo form_error('rfid'); ?></span>
                                            </div>
                                        </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Race and Religion</label>
                                <input autofocus="" id="raceandreligion" name="raceandreligion" placeholder="" type="text" class="form-control"  value="<?php echo set_value('raceandreligion',$teacher['raceandreligion']); ?>" />
                                <span class="text-danger"><?php echo form_error('raceandreligion'); ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Spouse's Name (if yes)</label>
                                <input autofocus="" id="spouseName" name="spouseName" placeholder="" type="text" class="form-control"  value="<?php echo set_value('spouseName',$teacher['spouseName']); ?>" />
                                <span class="text-danger"><?php echo form_error('spouseName'); ?></span>
                            </div>

                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Spouse's Occupation (if yes)</label>
                                <input autofocus="" id="spouseOccupation" name="spouseOccupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('spouseOccupation',$teacher['spouseOccupation']); ?>" />
                                <span class="text-danger"><?php echo form_error('spouseOccupation'); ?></span>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Father's Name </label>
                                <input autofocus="" id="fathername" name="fathername" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fathername',$teacher['fathername']); ?>" />
                                <span class="text-danger"><?php echo form_error('fathername'); ?></span>
                            </div>


                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Mother's Name </label>
                                <input autofocus="" id="mothername" name="mothername" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mothername',$teacher['mothername']); ?>" />
                                <span class="text-danger"><?php echo form_error('mothername'); ?></span>
                            </div>

                               <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Parent's Occupation </label>
                                <input autofocus="" id="parentOccupation" name="parentOccupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('parentOccupation',$teacher['parentOccupation']); ?>" />
                                <span class="text-danger"><?php echo form_error('parentOccupation'); ?></span>
                            </div>

                          
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile"> <?php echo $this->lang->line('gender'); ?> &nbsp;&nbsp;</label>
                                <select class="form-control" name="gender">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($genderList as $key => $value) {
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php if (set_value('gender', $teacher['sex']) == $key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('gender'); ?></span>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date_of_birth'); ?></label>
                                <input id="dob" name="dob" placeholder="" type="text" class="form-control"  value="<?php echo set_value('dob', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($teacher['dob']))); ?>" readonly="readonly"/>
                                <span class="text-danger"><?php echo form_error('dob'); ?></span>
                            </div>
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Position</label>
                                <input id="position" name="position" placeholder="" type="text" class="form-control"  value="<?php echo set_value('position',$teacher['position']); ?>" />
                                <span class="text-danger"><?php echo form_error('position'); ?></span>
                            </div>

                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Education</label>
                                <input id="education" name="education" placeholder="" type="text" class="form-control"  value="<?php echo set_value('education',$teacher['education']); ?>" />
                                <span class="text-danger"><?php echo form_error('education'); ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Primary Subject</label>
                                <input id="primarySubject" name="primarySubject" placeholder="" type="text" class="form-control"  value="<?php echo set_value('primarySubject',$teacher['primarySubject']); ?>" />
                                <span class="text-danger"><?php echo form_error('primarySubject'); ?></span>
                            </div>


                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Date Of Enter To School </label>
                                <input id="entryDate" name="entryDate" placeholder="" type="text" class="form-control"  value="<?php echo set_value('entryDate',$teacher['entryDate']); ?>" />
                                <span class="text-danger"><?php echo form_error('entryDate'); ?></span>
                            </div>


                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Transfered School</label>
                                <input id="transferedSchool" name="transferedSchool" placeholder="" type="text" class="form-control"  value="<?php echo set_value('transferedSchool',$teacher['transferedSchool']); ?>" />
                                <span class="text-danger"><?php echo form_error('transferedSchool'); ?></span>
                            </div>

                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Start Date At Teaching Department</label>
                                <input id="startDateofTeaching" name="startDateofTeaching" placeholder="" type="text" class="form-control"  value="<?php echo set_value('startDateofTeaching',$teacher['startDateofTeaching']); ?>" />
                                <span class="text-danger"><?php echo form_error('startDateofTeaching'); ?></span>
                            </div>

                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Current Class and Subject</label>
                                <input id="currentsubject" name="currentsubject" placeholder="" type="text" class="form-control"  value="<?php echo set_value('currentsubject',$teacher['currentsubject']); ?>" />
                                <span class="text-danger"><?php echo form_error('currentsubject'); ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Educational Development Responsibility</label>
                                <input id="responsibility" name="responsibility" placeholder="" type="text" class="form-control"  value="<?php echo set_value('responsibility',$teacher['responsibility']); ?>" />
                                <span class="text-danger"><?php echo form_error('responsibility'); ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Salary</label>
                                <div class="row">
                                	<div class="col-md-9">
                                <input id="salary" name="salary" placeholder="" class='form-control'type="text" value="<?php echo set_value('salary',$teacher['salary']); ?>" />
                               </div>
                               <div class="col-md-3">
                                <?=form_dropdown("currency",array("MMK"=>"MMK","USD"=>"USD"),$teacher["currency"],"class='form-control'");?>

                               </div>

                                </div>
                                
                                <span class="text-danger"><?php echo form_error('salary'); ?></span>
                            </div>                      
                                                     

                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Attended Class And Year</label>
                                <textarea id="attendedclass" name="attendedclass" placeholder=""  class="form-control"><?php echo set_value('attendedclass',$teacher['attendedclass']); ?></textarea>
                                <span class="text-danger"><?php echo form_error('attendedclass'); ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                                <input id="category" name="email" placeholder="" type="text" class="form-control"  value="<?php echo set_value('email', $teacher['email'],$teacher['position']); ?>" />
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>
                                <textarea id="address" name="address" placeholder=""  class="form-control" ><?php echo set_value('address', $teacher['address']); ?></textarea>
                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>
                                <input id="phone" name="phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('phone', $teacher['phone']); ?>" />
                                <span class="text-danger"><?php echo form_error('phone'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile"><?php echo $this->lang->line('teacher_photo'); ?> (150px X 150px)</label>
                                <input class="filestyle form-control" type='file' name='file' id="file" size='20' />
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $teacher['image'] ?>" alt="User profile picture">

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div> 
            </div>
           
        </div> 
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#dob,#entryDate,#startDateofTeaching').datepicker({
            format: date_format,
            autoclose: true
        });
    });
</script>