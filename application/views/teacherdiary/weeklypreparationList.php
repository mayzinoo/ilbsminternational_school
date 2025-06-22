<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Weekly Preparations        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Weekly Preparations</h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><?=anchor("teacherdiary/Weeklypreparation/createform","+ Add","class='btn btn-primary btn-sm'")?></small> 
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="row">
                                    <form role="form" action="<?php echo site_url('teacherdiary/Weeklypreparation/Search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>    
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date_from'); ?></label>
                                                <input id="datefrom"  name="date_from" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date_to'); ?></label>
                                                <input id="dateto" name="date_to" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <br/>
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-left"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                            <!--<div class="col-md-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/Weeklypreparation/Search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search'); ?></label>
                                                <input autofocus=""  type="text" value="<?php echo set_value('search_text', ""); ?>" name="search_text"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12"> 
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>

                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>-->

                        </div>
                            <table class="table table-striped table-bordered table-hover example">
                               <thead>
                                    <tr>
                                        <th>Teacher's Name
                                        </th>
                                       
                                        <th>From
                                        </th>
                                        <th>    To</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($lists)) {
                                        ?>
                                    <tfoot>    
                                        <tr>
                                            <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>

                                        </tr>
                                    </tfoot>
                                    <?php
                                } else {
                                    foreach ($lists as $expense) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $expense['tname'] ?>
                                            </td>
                                            

                                                <td class="mailbox-name">
                                                <?php echo $expense['date_from'] ?>

                                            </td>

                                              
                                            <td class="mailbox-name">
                                                <?php echo $expense['date_to'] ?>

                                            </td>
                                           <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>teacherdiary/Weeklypreparation/view/<?php echo $expense['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>teacherdiary/Weeklypreparation/edit/<?php echo $expense['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>teacherdiary/Weeklypreparation/delete/<?php echo $expense['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <?php
                                    }
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
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
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