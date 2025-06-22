<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Monthly Salary (<?=$exp_title?>) <small class="pull-right"><?=anchor("admin/Salary/createform","+ Add","class='btn btn-primary btn-sm'")?></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
           
           
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">

                          
                            <div class="col-md-3">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/Salary/salarySearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Location</label>
											<?php echo form_dropdown("location",$locations,set_value("location"),"class='form-control'"); ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-12"> 
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_location" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>

                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/salary/salarySearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date_from'); ?></label>
                                                <input id="datefrom"  name="date_from" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date_to'); ?></label>
                                                <input id="dateto" name="date_to" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                          
                            <div class="col-md-4">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/salary/salarySearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search'); ?></label>
                                                <input autofocus=""  type="text" value="<?php echo set_value('search_text', ""); ?>" name="search_text"  class="form-control" placeholder="Search by Name">
                                            </div>
                                        </div>

                                        <div class="col-sm-12"> 
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>

                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>

                        </div>

                    </div>

					</div>
                    <div class="box box-info">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('salary_list'); ?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                     <th><?php echo $this->lang->line('date'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('name'); ?>
                                        </th>
                                     <th>Position
                                        </th>
                                       

                                        <th><?php echo $this->lang->line('amount'); ?>
                                        </th>

                                        <th>Notes</th>
                                        <th>Location</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                               <tbody>
                                    <?php
                                    if (empty($salarylist)) {
                                        ?>

                                        <?php
                                    } else {

                                        $no=1;
                                        $total=0;
                                        foreach ($salarylist as $salary) {
                                            ?>
                                            <tr>
                                            <td><?=$no?></td>
                                             <td class="mailbox-name">
                                                    <?php echo $salary['date']?></td>
                                                <td class="mailbox-name">
                                                    <a href="<?=base_url()?>admin/teacher/view/<?=$salary['id']?>" data-toggle="popover" class="detail_popover"><?php echo $salary['tname'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($salary['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $salary['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>

                                                  <td class="mailbox-name">
                                                    <?php echo $salary['position'] ?>

                                                </td>
                                               

                                              
                                                <td class="mailbox-name"><?php echo ($salary['amount'])." ".$salary["currency"]; ?></td>
                                                <td class="mailbox-name"><?=$salary["note"]?></td>
                                                <td class="mailbox-name"><?=$salary["ltext"]?></td>

                                                <td class="mailbox-date pull-right">
                                                

                                                    
                                                   
                                                    <a href="<?php echo base_url(); ?>admin/salary/edit/<?php echo $salary['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>admin/salary/delete/<?php echo $salary['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php


                                            $total+=$salary["amount"];
                                            $no++;
                                        }
                                    }
                                    ?>

                                    <tr><td colspan="4"></td><td><?=number_format($total)." ".$salary["currency"]?></td></tr>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

         $(".date").datepicker({
            // format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true,
            todayHighlight: true

        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
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

<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
