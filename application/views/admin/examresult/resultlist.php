
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>
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
                        <h3 class="box-title titlefix">Exam Result Lists</h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><a href="<?=base_url()?>admin/Examresult/result_create" class="btn btn-primary btn-sm">+ Add</a></small>   
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->

                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('exam_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        
                                        <th>တိုင္းေဒသၾကီး/ၿပည္နယ္</th>
                                    <th>ခရိုင္</th>
                                    <th>ၿမိဳ႕နယ္</th>
                                    <th>ေက်ာင္း</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($examresults->result() as $result) {
                                            ?>

                                            <tr>
                                                <td><?php echo $result->division; ?></td>
                                                <td><?php echo $result->district; ?></td>
                                                <td><?php echo $result->township; ?></td>
                                                <td><?php echo $result->sch_name; ?></td>
                                                
                                                <td class="mailbox-date pull-right">
                                                 <a href="<?php echo base_url(); ?>admin/Examresult/resultshow/<?php echo $result->id ?>"class="btn btn-info btn-xs">
                                                View Result</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
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

                <!-- Horizontal Form -->

                <!-- general form elements disabled -->

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {

        $('#date').datepicker({
            format: "dd-mm-yyyy",
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