<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
            <i class="fa fa-mortar-board"></i> School Calendar <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Edit School Calendar Form</h3>
</div><!-- /.box-header -->
<form id="form1" action="<?php echo site_url() ?>admin/School_calendar/edit_calendar/<?=$row->id?>" name="School_calendar" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?=form_hidden("id",$row->id)?>
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
<?php  ?>
<!--Header Row Start-->
<div class="row">
    <div class="col-md-3">
     
    </div> 
    <div class="col-md-6">


     <div class="form-group">
        <label for="exampleInputEmail1">Academic Year</label>
              <?=form_dropdown("sel_session",$sessionlist,$row->session_id,"class='form-control'")?> 
     </div>


      <div class="form-group">
              <label for="exampleInputEmail1">Month Name</label>

           <?php
             echo form_dropdown("month",$monthlist,$row->att_month,"class='form-control'");?> 
     </div>


<div class="form-group">
        <label for="exampleInputEmail1">Total Attandence Days</label>
        <input id="att_day" name="att_day" placeholder="" type="text" class="form-control"  value="<?=$row->att_day?>"  />
     </div>

<div class="form-group">
    
    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>

</div>


    </div>
    
    <div class="col-md-3">
      
    </div>


    
        
 


</div><!-- /.box-body -->

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
