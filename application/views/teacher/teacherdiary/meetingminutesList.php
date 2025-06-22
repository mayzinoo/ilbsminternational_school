<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Meeting Minutes </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row"> 
           
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> Meeting Minutes </h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><?=anchor("teacher/teacherdiary/Meetingminutes/createform","+ Add","class='btn btn-primary btn-sm'")?></small>   
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    
                 
                    <div class="box-body">
                    <div class="row">
<form role="form" action="<?php echo site_url('teacher/teacherdiary/Meetingminutes/meetingminutesSearch') ?>" method="post" class="">
<?php echo $this->customlib->getCSRF(); ?>

<div class="col-md-2 col-sm-2">
<div class="form-group">
<label><?php echo $this->lang->line('class'); ?></label>
<select autofocus="" id="class_id" name="class_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($classlist as $class) {
?>
<option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
<?php
}
?>
</select>
<span class="text-danger"><?php echo form_error('class_id'); ?></span>
</div> 
</div>
<div class="col-md-2 col-sm-2">
<div class="form-group">
<label><?php echo $this->lang->line('section'); ?></label>
<select  id="section_id" name="section_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
</select>
<span class="text-danger"><?php echo form_error('section_id'); ?></span>
</div> 
</div>

<div class="col-md-2 col-sm-2">
<?php echo $this->customlib->getCSRF(); ?>


<div class="form-group">
<label>Date</label>

<?php echo form_input("day",set_value('day'),'class="form-control date"');?>
<span class="text-danger"><?php echo form_error('year'); ?></span>

</div>
</div>


<div class="col-md-4 col-sm-4">
<div class="form-group">
<label><?php echo $this->lang->line('search_by_keyword'); ?></label>
<input type="text" name="search_text" class="form-control" placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
</div>
</div>

<div class="col-sm-1">
<div class="form-group">
<label></label><br/>
<button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</div>


</form>
</div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Daily Records</div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                       
                                        <th>No</th>
                                        <th>Place</th>
                                        <th>Date</th>
                                        <th>Action</th>                                                                               
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
                                    $no=1;
                                    foreach ($lists as $expense) {
                                        ?>
                                        <tr>
                                           <td> <?=$no?></td>
                                           <td><?=$expense['place']?></td>
                                           <td><?=$expense['date']?></td>
                                           <td class="mailbox-name">
                                                    <?=anchor("teacher/teacherdiary/Meetingminutes/view_detail/".$expense['id'],"Detail","target='_blank'")?>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
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
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]); ?>';

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