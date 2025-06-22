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
                        <h3 class="box-title">Edit Lecture Course</h3>
                    </div> 
                    <form action="<?php echo site_url('course/update_course') ?>"  name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                             <div class="form-group col-md-6">
                                 <input type="hidden" name="id" value="<?=$row->id?>">
                                <label for="exampleInputEmail1">Course Title</label>
                                <input autofocus="" id="title" name="title" placeholder="Course Title" type="text" class="form-control"  value="<?php echo $row->title; ?>" />
                                <span class="text-danger"><?php echo form_error('title'); ?></span>
                            </div>


                           <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Teacher Name</label>
                                <?=form_dropdown("teacher",$teacherlist,$row->teacher,"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('teacher'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Start Date</label>
                                <!--<input autofocus="" id="start_date" name="start_date" placeholder="choose date" type="text" class="form-control"  value="<?php echo date("y-m-d",strtotime($row->start_date)); ?>" />-->
                                <input id="start_date" name="start_date" placeholder="" type="text" class="form-control"  value="<?php echo date("d-m-Y",strtotime($row->start_date)); ?>" />
                                <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">End Date</label>
                                <input id="end_date" name="end_date" placeholder="" type="text" class="form-control"  value="<?php echo date("d-m-Y",strtotime($row->end_date)); ?>" />
                                <span class="text-danger"><?php echo form_error('end_date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Duration</label>
                                <input autofocus="" name="duration" placeholder="Duration" type="text" class="form-control"  value="<?php echo $row->duration; ?>" />
                                <span class="text-danger"><?php echo form_error('duration'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Certificate</label>
                                <input autofocus="" name="certificate" placeholder="certificate" type="text" class="form-control"  value="<?php echo $row->certificate; ?>" />
                                <span class="text-danger"><?php echo form_error('certificate'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Fees</label>
                                <input autofocus="" name="fees" placeholder="fees" type="text" class="form-control"  value="<?php echo $row->fees; ?>" />
                                <span class="text-danger"><?php echo form_error('fees'); ?></span>
                            </div>
    
                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                <textarea name="description" class="form-control">
                                    <?php echo $row->description; ?>
                                </textarea>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
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
        $('#start_date,#end_date,#startDateofTeaching').datepicker({
            format: date_format,
            autoclose: true
        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>
