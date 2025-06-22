<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> School Calendars  <small class="pull-right"><?=anchor("admin/School_calendar/create_calendar_form","+ Add","class='btn btn-primary btn-sm'")?></small></h1>
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
                    <form id='form1' action="<?php echo site_url('admin/School_calendar/search_calendar') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('attendance'); ?>
                                                Year
                                        </label>
                                        
                                          
              <?=form_dropdown("sel_session",$sessionlist,$sel_session,"class='form-control'")?> 
                                    </div>
                                </div>
                                <div class="col-md-1">        
                                    <label for="exampleInputEmail1">
                                    <br/>
                                    </label>
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
               </div>
                            </div>
                        </div>
                        
                    </form>
					</div>
				
					
                    <div class="box box-info">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">School Calendars</div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                     <th>No</th>
                                     <th>Month Name</th>          
                                     <th>Total Att Days</th>
                                     <th>Academic Year</th>
                                    <th>Created At</th>

                                     <th>Action</th>                                        
                                    </tr>
                                </thead>
                               <tbody>
                                    <?php
                                    if (empty($schlenders)) {
                                        ?>

                                        <?php
                                    } else {

                                       

                                        $no=1;
                                        $total=0;
                                        foreach ($schlenders as $sch) {
                                            ?>
                                            <tr>
                                            <td><?=$no?></td>                                 
                                                <td class="mailbox-name">
                                                    <?php echo $monthlist[$sch['att_month']]?>
                                                </td>
                                                 <td class="mailbox-name">
                                                    <?php echo $sch['att_day'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $sessionlist[$sch['session_id']]?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $sch['date']?>                 
                                                </td>
                                                
                                                
                                                  <td class="mailbox-name">
                                        <a href="<?php echo base_url(); ?>admin/School_calendar/calendar_edit_form/<?php echo $sch['id']?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?php echo base_url(); ?>admin/School_calendar/delete_calendar/<?php echo $sch['id']?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                                            <i class="fa fa-remove"></i>
                                        </a>
                                                   </td>
                                               
                                            </tr>
                                            <?php


                                            $total+=$sch["amount"];
                                            $no++;
                                        }
                                    }
                                    ?>

                                    <!-- <tr><td colspan="4"></td><td><?=number_format($total)." ".$sch["currency"]?></td></tr> -->

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
