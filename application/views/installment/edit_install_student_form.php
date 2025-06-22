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
                        <h3 class="box-title">Edit Install Student Form</h3>
                    </div> 
                    
                        <?=form_open_multipart("Installment/update_install_student","")?>
                        <input type="hidden" name="id" value="<?=$row->id?>">
                        <input type="hidden" name="image" value="<?=$row->photo?>">
                        
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Installment Plans</label>
                                
                                <?php echo form_dropdown("install_plan_id",$install_plans,$row->install_plan_id,'class="form-control" onchange="getData(this.value)"'); ?>
                                
                                <span class="text-danger"><?php echo form_error('install_plan_id'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Choose Student</label>
                                
                                <select name="student_id" id="student_id" class="form-control">
                                              <option value="<?=$row->student_id?>"><?=$row->fname." ".$row->lname?></option>
                                            </select>
                                
                                <span class="text-danger"><?php echo form_error('student_id'); ?></span>
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Fees</label>
                                <input autofocus="" id="fees" name="fee" placeholder="" value="<?=$row->fee?>" type="text" class="form-control" readonly />
                                <span class="text-danger"><?php echo form_error('fee'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Academic year</label>
                                <input type="hidden" name="session" value="<?=$row->session_id?>" id="session_id">
                                <?=form_input("sess",$row->session,"class='form-control' id='session' readonly")?>
                                <span class="text-danger"><?php echo form_error('sess'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Register Date</label>
                                <input autofocus="" value="<?=date("d-m-Y",strtotime($row->register_date))?>" id="start_date" name="date" placeholder="Register Date" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Due Date</label>
                                <input autofocus="" id="end_date" name="due_date" placeholder="Date" value="<?=date("d-m-Y",strtotime($row->due_date))?>" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('due_date'); ?></span>
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
