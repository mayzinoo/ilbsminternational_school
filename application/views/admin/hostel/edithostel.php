<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-building-o"></i> <?php echo $this->lang->line('hostel'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('edit_hostel'); ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form action="<?php echo site_url('admin/hostel/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?> 
                            <?php echo $this->customlib->getCSRF(); ?>                         
                            <input type="hidden" name="id" value="<?php echo set_value('id', $edithostel['id']); ?>" >
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('hostel_name'); ?></label>
                                <input autofocus="" id="amount" name="hostel_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('hostel_name', $edithostel['hostel_name']); ?>" />
                                <span class="text-danger"><?php echo form_error('hostel_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('type'); ?></label>

                                <select  id="type" name="type" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($ght as $type) {
                                        ?>
                                        <option value="<?php echo $type; ?>" <?php if (set_value('type', $edithostel['type']) == $type) echo "selected=selected"; ?>><?php echo $type; ?></option>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('type'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>
                                <input id="amount" name="address" placeholder="" type="text" class="form-control"  value="<?php echo set_value('address', $edithostel['address']); ?>" />
                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('intake'); ?></label>
                                <input id="amount" name="intake" placeholder="" type="text" class="form-control"  value="<?php echo set_value('intake', $edithostel['intake']); ?>" />
                                <span class="text-danger"><?php echo form_error('intake'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description', $edithostel['description']); ?></textarea>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Warden Teacher</label>
                            
                    <table class="table" width="100%">
                                  
                              <thead>
                                    <tr>
                                    <th width="5%">No</th>
                                      <th>Name</th>
                                      <th>Phone</th>
                                      <th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="wardenclonerow()"></i></th>
                                      </tr>
                              </thead>
                <?php if($edithostel['hostel_warden']==""){ ?>
                                <tbody id="wardenWrapper">
                                <tr class="wardenclonethis">
                                        <td class="no">1</td>                                 
                                        <td>
                                                <div class="form-group <?php
                                                if (form_error('description')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                                                    
                                                    <input type="text" name="warden-techr[]" class="form-control">
                                                </div>
                                        </td>
                                        <td>
                                                <div class="form-group <?php
                                                if (form_error('description')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                                                          <input type="text" name="warden-phone[]" class="form-control">
                                                </div>
                                        </td>
                                        <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                              </tr>                                  
                              </tbody>
                              
            <?php }else{ ?> <!--end first condition-->                            
                                
                              
                            <tbody id="wardenWrapper">
                                <?php
                                
                                $tchr1 = explode(']', $edithostel['hostel_warden']);
                    
                                for($i=1;$i<count($tchr1);$i++)
                                    {
                                      $techr1 = explode(',',$tchr1[$i-1]);
                        
                                         ?>
                                           <tr class="wardenclonethis">
                                           <td class="no"><?php echo $i; ?></td>
                                           <td>
                                            <div class="form-group <?php
                                                if (form_error('description')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                                                    <input type="text" name="warden-techr[]" class="form-control" value="<?=$techr1[0]?>">
                                                </div>
                                            </td>
                                            <td>
                                            <div class="form-group <?php
                                                if (form_error('description')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                                                    <input type="text" name="warden-phone[]" class="form-control" value="<?=$techr1[1]?>">
                                                </div>
                                            </td>
                                            <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                                            </tr>
                                         <?php } ?>    
                            </tbody>
                              
            <?php } ?>
                              
                              
                    </table>
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Guide Teacher</label>
                                <table class="table" width="100%">
                                  
                              <thead>
                                <tr>
                                <th width="5%">No</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="guideclonerow()"></i></th>
                                  </tr>
                              </thead>
                              <?php if($edithostel['hostel_warden']==""){ ?>
                              <tbody id="guideWrapper">
                              <tr class="guideclonethis">
                              <td class="no">1</td>
                                 
                                  <td>
                                      
  <div class="form-group <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?>">
                                
                                <input type="text" name="guide-techr[]" class="form-control">
                            </div>
                                  </td>
                                  <td>
                                      
  <div class="form-group <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?>">
                                
                                <input type="text" name="guide-phone[]" class="form-control">
                            </div>
                                  </td>
                                  <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                              </tr>
                                  
                              </tbody>
                              <?php }else{ ?> <!--end first condition-->
                            <tbody id="guideWrapper">
                            <?php
                                $tchr2 = explode(']', $edithostel['guide_teacher']);
            
                                for($i=1;$i<count($tchr2);$i++)
                                {
                                  $techr2 = explode(',',$tchr2[$i-1]);
            
                             ?>
                              <tr class="guideclonethis">
                              <td class="no"><?php echo $i; ?></td>
                                 
                                  <td>
                                      
  <div class="form-group <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?>">
                                
                                <input type="text" name="guide-techr[]" class="form-control" value="<?=$techr2[0]?>">
                            </div>
                                  </td>
                                  <td>
                                      
  <div class="form-group <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?>">
                                
                                <input type="text" name="guide-phone[]" class="form-control" value="<?=$techr2[1]?>">
                            </div>
                                  </td>
                                  <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                              </tr>
                                  
                              </tbody>
                              <?php } ?>
                              <?php } ?>
                              
                              </table>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('hostel_list'); ?></h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">					
						<div class="download_label"><?php echo $this->lang->line('hostel_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('hostel_name'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('type'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('address'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('intake'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($listhostel)) {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($listhostel as $hostel) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $hostel['hostel_name'] ?></a>
                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($hostel['description'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $hostel['description']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-name"> <?php echo $hostel['type'] ?></td>
                                                <td class="mailbox-name"> <?php echo $hostel['address'] ?></td>
                                                <td class="mailbox-name"> <?php echo $hostel['intake'] ?></td>
                                                <td class="mailbox-date pull-right">
                                                    <a href="<?php echo base_url(); ?>admin/hostel/edit/<?php echo $hostel['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>admin/hostel/delete/<?php echo $hostel['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>