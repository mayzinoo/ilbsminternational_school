<style>

.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.cb {
  display: none;
  border: 1px #dadada solid;
  z-index: 10000;
    position: absolute;
    background: white;
    width: 120px;
    padding-left: 10px;
top: 140px;
left: 100px;
}

.cb label {
  display: block;
}

.cb label:hover {
  background-color: #1e90ff;
}
/*.classform .form-control{*/
/*    width:38%;*/
/*}*/

</style>

<script>
      var expanded = false;
function showCheckboxes(id) {
  var checkboxes = document.getElementById("checkboxes"+id);
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>


<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <!--<i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?>-->
            <i class="fa fa-usd"></i> Payments
            </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_fees_group'); ?></h3>
                    </div><!-- /.box-header -->
                    <form action="<?php echo base_url() ?>admin/feegroup"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label>
                                <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label>
                                <input autofocus="" id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                <span class="text-danger"><?php echo form_error('amount'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                <span class="text-danger"></span>
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
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('fees_group_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('fees_group_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?>
                                        </th>
                                        <th>Amount</th>
                                        <!--<th>Set Balance</th>-->


                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <!--<input type="hidden" name="subject" value="<?=$list->subject?>">-->
				
                                    <?php
                                    foreach ($feegroupList as $feegroup) {
                                        ?>
                                        
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $feegroup['name'] ?></a>

                                                <div class="fee_detail_popover" style="display: none">
                                                    <?php
                                                    if ($feegroup['description'] == "") {
                                                        ?>
                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <p class="text text-info"><?php echo $feegroup['description']; ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>

                                            <td>
                                                <?=$feegroup["amount"]?>
                                            </td>

                                            
                                            <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/feegroup/edit/<?php echo $feegroup['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/feegroup/delete/<?php echo $feegroup['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
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