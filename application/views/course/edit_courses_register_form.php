<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Courses <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Course Register Form</h3>
                    </div> 
                    
                        <?=form_open_multipart("course/update_courses_register","")?>
                        <input type="hidden" name="id" value="<?=$row->id?>">
                        <input type="hidden" name="image" value="<?=$row->photo?>">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Choose Student</label>
                                
                                <?php echo form_dropdown("student_id",$studentlist,$row->student_id,'class="form-control" onchange="getstudentdata(this.value)"'); ?>
                                
                                <span class="text-danger"><?php echo form_error('student_id'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Student Name</label>
                                <input autofocus="" id="name" name="name" placeholder="Student Name" value="<?=$row->name?>" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">NRC No</label>
                                <input autofocus="" id="nrc" name="nrc" placeholder="NRC No" value="<?=$row->nrc?>" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('nrc'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Parent</label>
                                <input autofocus="" id="parent" name="parent" placeholder="Parent" value="<?=$row->parent?>" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('nrc'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Phone</label>
                                <input autofocus="" id="phone" name="phone" placeholder="Phone" value="<?=$row->phone?>" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('phone'); ?></span>
                            </div>
                            
                            
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea name="address" id="address" class="form-control">
                                   <?=$row->address?>
                                </textarea>
                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Email</label>
                                <input autofocus="" value="<?=$row->email?>" id="email" name="email" placeholder="Email" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Lectured Course</label>
                                
                                <?php echo form_dropdown("lecture_course_id",$courselists,$row->lecture_course_id,'class="form-control"'); ?>
                                
                                <span class="text-danger"><?php echo form_error('lecture_course_id'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Course Fees</label>
                                <input autofocus="" id="fees" name="fees" placeholder="" value="<?=$row->fees?>" type="text" class="form-control" readonly />
                                <span class="text-danger"><?php echo form_error('fees'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Register Date</label>
                                <input autofocus="" id="register_date" name="register_date" value="<?php echo date("d-m-Y",strtotime($row->register_date)); ?>" placeholder="Register Date" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('register_date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Start Date</label>
                                <input autofocus="" id="start_date" value="<?php echo date("d-m-Y",strtotime($row->start_date)); ?>" placeholder="start date" type="text" class="form-control" disabled />
                                <input type="hidden" name="start_date"  value="<?php echo date("d-m-Y",strtotime($row->start_date)); ?>" >
                                <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">End Date</label>
                                <input autofocus="" id="end_date" value="<?php echo date("d-m-Y",strtotime($row->end_date)); ?>" placeholder="End Date" type="text" class="form-control" disabled />
                                <input type="hidden" name="end_date"  value="<?php echo date("d-m-Y",strtotime($row->end_date)); ?>" >
                                <span class="text-danger"><?php echo form_error('end_date'); ?></span>
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
        $('#start_date,#end_date,#register_date').datepicker({
            format: date_format,
            autoclose: true
        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>
