<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Student's Hostel Room     </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
           
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Student's Room</h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><?=anchor("student/studentsroom","+ Add","class='btn btn-primary btn-sm'")?></small>   
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Improvement Results</div>
                            <table class="table table-striped table-bordered table-hover example">
                                 <thead>
                                    <tr>
                                        <th>Student Name
                                        </th>
                                        <th>Class
                                        </th>
                                      
                                        <th width="30%">Hostel Name
                                        </th>
                                        <th>Room No</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($studentroomlist)) {
                                        ?>
                                    <tfoot>    
                                        <tr>
                                            <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                    </tfoot>
                                    <?php
                                } else {
                                    foreach ($studentroomlist->result() as $expense) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $expense->firstname.$expense->lastname; ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $expense->class?> (<?php echo $expense->section?>)

                                          
                                            <td class="mailbox-name">
                                                <?php echo $expense->hostel_id?>

                                            </td>

                                            <td class="mailbox-name">
                                                <?php echo $expense->room_no?>

                                            </td>

                                           <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/hostel/view/<?php echo $expense->student_id?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/hostel/studentsroom_edit/<?php echo $expense->student_id?>"class="btn btn-default btn-xs">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                
                                                <a href="<?php echo base_url(); ?>admin/hostel/delete/<?php echo $expense->id?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
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



<!--model start-->
<div id="studentsroomedit<?=$expense->student_id?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Student's Room</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <?=form_open_multipart('Hostel/editstudentsroom/')?>
                        <!--<input type="hidden" name="sch_id" value="0">-->
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                            <!--<button type="button" class="btn btn-primary submit_schsetting pull-right" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('save'); ?></button>-->
                            <button type="submit"  class="btn btn-primary">Save changes</button>
                        </div>


                    </form>                  
                </div>
                
            </div><!--end modal body-->
            
        </div>
    </div>
</div><!--end modal-->    


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