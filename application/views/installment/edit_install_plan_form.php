<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> Installment <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Lecture Course</h3>
                    </div> 
                    <form action="<?php echo site_url('Installment/update_install_plan') ?>"  name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$row->id?>" />
                       <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Installment Name</label>
                                <input autofocus="" name="name" placeholder="Installment Name" type="text" class="form-control"  value="<?php echo $row->name; ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>

                           <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Class</label>
                                <?=form_dropdown("class",$classlist,$row->class_id,"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Academic year</label>
                                <?=form_dropdown("session",$sessionlist,$row->session_id,"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('session'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Date</label>
                                <input autofocus="" id="end_date" name="date" placeholder="choose date" type="text" class="form-control"  value="<?php echo $row->date; ?>" />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Fees</label>
                                <input autofocus="" name="fees" placeholder="fees" type="text" class="form-control"  value="<?php echo $row->fee; ?>" />
                                <span class="text-danger"><?php echo form_error('fees'); ?></span>
                            </div>
    
                            <!--  <div class="form-group col-md-6">-->
                            <!--    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>-->
                            <!--    <textarea name="description" class="form-control">-->
                            <!--        <?php echo set_value('description'); ?>-->
                            <!--    </textarea>-->
                            <!--    <span class="text-danger"><?php echo form_error('description'); ?></span>-->
                            <!--</div>-->
                            
                             
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
