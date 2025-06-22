<div class="content-wrapper">   
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit School</h3>
                    </div>
                    <form action="<?php echo site_url("admin/School/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>   
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">School</label>
                                <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $school->name); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
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
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($schoollist->result_array() as $list) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"><?php echo $list['name'] ?></td>
                                            <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/School/edit/<?php echo $list['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/School/delete/<?php echo $list['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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