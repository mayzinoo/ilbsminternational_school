<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Qualifications
            </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Qualification Records</h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><?=anchor("admin/Qrecord/createform","+ Add","class='btn btn-primary btn-sm'")?></small>        
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Course Outlines</div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Student's Name
                                        </th>
                                        <th>Class
                                        </th>
                                        <th>Section
                                        </th>
                                        <th>Roll</th>
                                       
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
                                } else { $no=1;
                                    foreach ($lists as $qrecord) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $qrecord['fname'].$qrecord['lname'] ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $qrecord['class'] ?>

                                            <td class="mailbox-name">
                                                <?php echo $qrecord['section'] ?>

                                            </td>
                                               <td class="mailbox-name">
                                                <?php echo $qrecord['roll'] ?>

                                            </td>
                 
                                           <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/Qrecord/view/<?php echo $qrecord['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/Qrecord/edit/<?php echo $qrecord['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/Qrecord/delete/<?php echo $qrecord['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <?php $no++;
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