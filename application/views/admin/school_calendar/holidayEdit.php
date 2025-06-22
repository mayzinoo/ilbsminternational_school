<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
            <i class="fa fa-mortar-board"></i> Attendance <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title"><?php //echo $title;     ?>Edit Holiday Form</h3>
</div><!-- /.box-header -->
<form id="form1" action="<?php echo site_url() ?>admin/Holiday/edit/<?=$row->id?>" name="holiday" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
<?php echo form_hidden("id",$row->id); ?>

<!--Header Row Start-->
<div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Holiday Name</label>
        <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo $row->name; ?>"  />
     </div>
    </div>
    
    <div class="col-md-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea name="description" class="form-control">
            <?php echo $row->description; ?>
        </textarea>
     </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Date From</label>
        <input id="start_date" name="datefrom" placeholder="" type="text" class="form-control"  value="<?php echo date("d-m-Y",strtotime($row->datefrom)); ?>"  />
     </div>
    </div>

    <div class="col-md-2">
          <div class="form-group">
        <label for="exampleInputEmail1">Date To</label>
        <input id="end_date" name="dateto" onchange="calculateDay()" placeholder="" type="text" class="form-control"  value="<?php echo date("d-m-Y",strtotime($row->dateto)); ?>"  />
    </div>
    </div>
    
        <div class="col-md-2">
          <div class="form-group">
        <label for="exampleInputEmail1">Total Days</label>
        <input name="total" placeholder="" id="day" type="text" class="form-control"  value="<?php echo $row->total; ?>"  />
    </div>
    </div>
</div>  


</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
</div>
</form>
</div>

</div><!--/.col (right) -->

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

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#start_date,#end_date,#register_date,#reqdate,#certified_date,#checked_date,#approved_date').datepicker({
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
