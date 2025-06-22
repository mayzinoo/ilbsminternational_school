<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> School Lists</small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add School</h3>
                    </div> 
                    <form action="<?php echo site_url('admin/School/index') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">School Name </label>
                                <input autofocus="" id="school" name="school" placeholder="" type="text" class="form-control"  value="<?php echo set_value('school'); ?>" />
                                <span class="text-danger"><?php echo form_error('school'); ?></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>  
            </div>     
            <div class="col-md-8">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">School Lists</h3>
                    </div>
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages">
						<div class="download_label">School Lists</div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    foreach ($school->result_array() as $sc) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $sc['name'] ?></td>
                                            <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/School/edit/<?php echo $sc['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/School/delete/<?php echo $sc['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>   
        </div> 
    </section>
</div>