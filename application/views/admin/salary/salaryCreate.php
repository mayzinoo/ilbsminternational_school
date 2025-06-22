<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Monthly Salary<small>  (<?php echo date('F'); ?>)</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
           
           <form action="<?php echo site_url("admin/Salary/create/") ?>"  id="salary" name="salary" method="post" accept-charset="utf-8">

            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('teacher_list'); ?></h3>
                        <div class="box-tools pull-right">
                         Pay Date  <input type="text" name="date" id="date" value='<?php echo date("d-m-Y")?>'> 
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                          
                         

                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                        <th><?php echo $this->lang->line('name'); ?> </th>
                                     <th>Position </th>                                      

                                        <th><?php echo $this->lang->line('amount'); ?> </th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no=1;
                                    if (empty($teachers)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($teachers as $teacher) {
                                            ?>
                                            <tr>
                                            <td><?=$no?></td>
                                                <td class="mailbox-name">
                                                <input type="hidden" name="teacher_name[]" value="<?php echo $teacher['name'] ?>">
                                            <input type="hidden" name="teacher_id[]" value="<?php echo $teacher['id'] ?>">
                                            <input type="hidden" name="position[]" value="<?php echo $teacher['position'] ?>">

                                                    <a href="<?=base_url()?>admin/teacher/view/<?=$teacher['id']?>" data-toggle="popover" class="detail_popover"><?php echo $teacher['name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($teacher['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $teacher['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>

                                                  <td class="mailbox-name">
                                                    <?php echo $teacher['position'] ?>

                                                </td>
                                              
                                              
                                                <td class="mailbox-name"><input type="text" name="salary[]" value='<?php echo ($teacher['salary'])?>'/><input type="text" name="currency[]" value="<?php echo $teacher["currency"]; ?>" size="5" readonly/></td>

                                                <td class="mailbox-name"><input type="text" name="note[]" value='<?php echo set_value("note[]")?>' class="form-control"/></td>
                                                
                                            </tr>
                                            <?php

                                            $no++;
                                        }
                                    }
                                    ?>

                                    <tr>
                                    <td colspan="4"></td><td align="center"><input type="submit" name="save" value="Save"/></td></tr>

                                </tbody>
                            </table><!-- /.table -->

                            </form>

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

<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
