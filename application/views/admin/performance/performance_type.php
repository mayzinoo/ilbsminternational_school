<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<style>
    .action a
    {
        float:left;
    }
</style>
<div class="content-wrapper">
    
    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Performance Type <small class="pull-right"><?=anchor("admin/Performance/ptype_form","+ Add","class='btn btn-primary btn-sm'")?>    </small>
        </h1>
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

                          
                            <div class="col-md-5">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/purchase/purchaseSearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Performance Name</label>
                                                <input name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" readonly="readonly"/>
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
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

                        </div>

                    </div>

					</div>
                    <div class="box box-info">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('purchase_list'); ?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                         <th>No</th>
                                         <th>Name</th>                           <th>Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                    <?php
                                    if (empty($result)) {
                                        ?>

                                        <?php
                                    } else {

                                        $no=1;
                                        $total=0;
                                        foreach ($result as $performance) {
                                            ?>
                                            <tr>
                                            <td><?=$no?></td>                                 
                                                <td class="mailbox-name">
                                                    <?php echo $performance['name'] ?>
                                                </td>
                                                 
                                                <td class="mailbox-name action">
                                                    <?=anchor("admin/performance/ptype_edit/".$performance['id'],"<i class='fa fa-edit'></i> / ","")?>
                                                    
                                                                                <a href="<?php echo base_url(); ?>admin/performance/delete_ptype/<?php echo $performance['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                                        <i class="fa fa-remove"></i>
                                        </a>
                                            
                                                </td>
                                               
                                            </tr>
                                            <?php


                                            $total+=$performance["amount"];
                                            $no++;
                                        }
                                    }
                                    ?>

                                    <!-- <tr><td colspan="4"></td><td><?=number_format($total)." ".$purchase["currency"]?></td></tr> -->

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
