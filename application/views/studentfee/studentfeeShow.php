<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">    
<section class="content-header">
<h1>
<i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?><small><?php echo $this->lang->line('student_fee'); ?></small></h1>
</section>
<section class="content">
<div class="row">
<!-- left column -->
<form action="<?php echo site_url("studentfee/create/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

<div class="col-md-12">
<div class="box box-primary">
<div class="box-header">
<div class="row">
<div class="col-md-4">
<h3 class="box-title"><?php echo $this->lang->line('student_fees'); ?></h3>
</div>  
<div class="col-md-8 ">
<div class="btn-group pull-right">
<a href="<?php echo base_url() ?>studentfee" type="button" class="btn btn-primary btn-xs">
<i class="fa fa-arrow-left"></i> <?php echo $this->lang->line('back'); ?></a>
</div>
</div>
</div>  
</div><!--./box-header-->    
<div class="box-body" style="padding-top:0;">
<div class="row">
<div class="col-md-12">
<div class="sfborder">  
<div class="col-md-2">
<img width="115" height="115" class="round5" src="<?php echo base_url() . $student['image'] ?>" alt="No Image">
</div>

<div class="col-md-10">
<div class="row">
<table class="table table-striped mb0 font13">
<tbody>
<tr>
<th class="bozero"><?php echo $this->lang->line('name'); ?></th>
<td class="bozero"><?php echo $student['firstname'] . " " . $student['lastname'] ?></td>

<th class="bozero"><?php echo $this->lang->line('class_section'); ?></th>
<td class="bozero"><?php echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
</tr>
<tr>
<th><?php echo $this->lang->line('father_name'); ?></th>
<td><?php echo $student['father_name']; ?></td>
<th><?php echo $this->lang->line('admission_no'); ?></th>
<td><?php echo $student['admission_no']; ?></td>
</tr>
<tr>
<th><?php echo $this->lang->line('mobile_no'); ?></th>
<td><?php echo $student['mobileno']; ?></td>
<th><?php echo $this->lang->line('roll_no'); ?></th>
<td> <?php echo $student['roll_no']; ?>
</td>
</tr>


</tbody>
</table>
</div>
</div>
<?php 
$show=$studentfee->row();
 ?>

</div></div>
<div class="col-md-12">
<div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
</div>
</div>
<div class="row no-print">
<div class="col-xs-12 table-responsive">
<span class="pull-right"><?php echo $this->lang->line('date'); ?> : <?php  echo date("d-m-Y, h:i:s A",strtotime($show->paydate));?></span>
</div>
<div class="col-xs-12 table-responsive">
<span class="pull-right">Payment For : <?php echo $show->payment_for; ?></span>
</div>
</div>   
<div class="table-responsive">


<div class="panel-default">
<div class="panel-body">

<div class="row clone">

<table class="table" width="100%">

<thead>
<tr>
<th width="5%">No</th>
<th width="20%">Fee Group</th>
<th>Amount</th>
<th>Discount</th>
<th>Received</th>
</tr>
</thead>
<tbody id="SourceWrapper">
<?php 
$count=1;
foreach($studentfee->result() as $fee): ?>
<tr class="clonethis">
<td class="no"><?php echo $count;?></td>
<td>
<div class="form-group">

<?php echo $fee->fgname?>

</div> 

</td>

<td>

<div class="form-group">
<?php echo $fee->amount; ?>

</div>
</td>
<td>

<div class="form-group">
<?php echo $fee->amount_discount; ?>

</div>
</td>
<td>

<div class="form-group">
<?php echo $fee->receive; ?>

</div>
</td>
</tr>

<?php 
$count++;
	endforeach;
 ?>

</tbody>

<tr>
<td colspan="4" align="right">Total Received</td>
<td>   
<?php echo $show->total_received?>
</td>
</tr>
</table>



</div>
<div class="row">
<div class="col-md-8"></div>
	<div class="col-md-4">
	<strong>Received By</strong>
	<br/>
	<strong><?=$show->authority?></strong>
</div>

</div>
<div class="pull-right">
<?php
	
	 echo anchor("studentfee/printvoc/".$show->id."/".$this->uri->segment(4),"Print",'class="btn btn-primary" target="_blank"');
?>

<?php echo form_close(); ?>
</div>
</div>


</div>

</div>

</div>

</div>
</div>

</section>
</div>

<script type="text/javascript">
$(document).ready(function () {
var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
$('#date').datepicker({
format: date_format,
autoclose: true
});



});
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
