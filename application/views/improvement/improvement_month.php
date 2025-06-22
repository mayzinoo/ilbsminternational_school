<style>
    .padding_md{
        padding-top:30px;
        padding-bottom:30px;
    }
    .month-save{
        margin-top:21px;
    }
</style>
<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Improvement Result Months    </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
           
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Report Card Month Create Form</h3>
                        <form id="form1" action="<?php echo site_url('improvement/improvement_result/rpcardmonth_insert') ?>" method="post" accept-charset="utf-8">
                        <div class="col-md-12 padding_md">
                             <div class="col-md-2">
                                  <div class="form-group <?php
                            if (form_error('name')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1">Months</label>
                               <?php echo form_dropdown("month",$monthlist,$month,'class="form-control"'); ?>
                            
                            </div>
                            </div>
                            <div class="col-md-2">
                                  <div class="form-group <?php
                            if (form_error('name')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1">Class Level</label>
                               <?php echo form_dropdown("class_level",$class_level,$level,'class="form-control"'); ?>
                            </div>
                            </div>
                            <div class="col-md-2 month-save">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </div>
                        </form>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Report Card Months</div>
                            <table class="table table-striped table-bordered table-hover example">
                                 <thead>
                                    <tr>
                                        <th>Month Name
                                        </th>
                                        <th>Pre_Status
                                        </th>
                                        <th>KG_Status
                                        </th>
                                        <th>Primary_Status
                                        </th>
                                        <th width="30%">Academic Year
                                        </th>
                                        
                                        <th>Date</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($resultlist)) {
                                        ?>
                                    <tfoot>    
                                        <tr>
                                            <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                    </tfoot>
                                    <?php
                                } else {
                                    foreach ($resultlist->result() as $row) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $row->name?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $row->Pre_status?>
                                            <td class="mailbox-name">
                                                <?php echo $row->KG_status?>
                                            <td class="mailbox-name">
                                                <?php echo $row->Primary_status?>
                                          
                                            <td class="mailbox-name">
                                                <?php echo $row->sesion_id?>

                                            </td>

                                            <td class="mailbox-name">
                                                <?php echo $row->updated_at?>

                                            </td>

                                           <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>improvement/Improvement_result/kgresult_view/<?php echo $expense->improvement_id?>/<?php echo $expense->description_id?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <!--<a href="<?php echo base_url(); ?>improvement/Improvement_result/edit/<?php echo $expense->id?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">-->
                                                <!--    <i class="fa fa-pencil"></i>-->
                                                <!--</a>-->
                                                <!--<a href="<?php echo base_url(); ?>improvement/Improvement_result/delete/<?php echo $expense->id?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>-->
                                                <!--    <i class="fa fa-remove"></i>-->
                                                <!--</a>-->
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

        $('#date').datepicker({
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