<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">   
<section class="content-header">
<h1>
<i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> ( <?php echo strtoupper($for);?> )</h1>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
</div>
<div class="box-body">
<div class="row">

<form role="form" action="<?php echo site_url('studentfee/noPaidsearch/')?>" method="post" class="">
    
<?php 
echo "<input type='hidden' name='status' value='".$this->uri->segment(3)."'/>";
echo $this->customlib->getCSRF(); ?>

<div class="col-sm-2">
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
<div class="col-sm-2">
<div class="form-group">
<label><?php echo $this->lang->line('section'); ?></label>
<select  id="section_id" name="section_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
</select>
<span class="text-danger"><?php echo form_error('section_id'); ?></span>
</div> 
</div>



<!-- <div class="col-sm-3">
<div class="form-group">
<label>From</label>
<input type="text" name="from" class="form-control" value="<?php echo set_value('from'); ?>" id="from-date">
</div>
</div>

<div class="col-sm-3">
<div class="form-group">
<label>To</label>
<input type="text" name="to" class="form-control" value="<?php echo set_value('to'); ?>" id="to-date">
</div>
</div> -->

   
<div class="col-sm-3">
    <div class="form-group">
        <label>School</label>
        <?=form_dropdown("school",$school,set_value("school"),"class='form-control'")?>
        <span class="text-danger"><?php echo form_error('school'); ?></span>
    </div>   
</div>


<div class="col-sm-4">
<div class="form-group">
<label><?php echo $this->lang->line('search_by_keyword'); ?></label>
<input type="text" name="search_text" class="form-control" placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
</div>
</div>


<div class="col-sm-1">
<div class="form-group"><br/>
<button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</div>



</form>
</div>  
</div>
</div>
</div>
</div>
<?php
if (isset($resultlist)) {
?>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">

<li class="active"><a href="<?php echo base_url(); ?>studentfee/" ><i class="fa fa-list"></i> No Paid Lists</a></li>
<li><a href="<?php echo base_url(); ?>studentfee/studentfeePaidList" ><i class="fa fa-newspaper-o"></i> Paid Lists</a></li>
</ul>
<div class="tab-content">
<div class="download_label"><?php echo $title; ?></div>
<div class="tab-pane active table-responsive no-padding" >   
<table class="table table-striped table-bordered table-hover example">
<thead>

<tr>
<th>No</th>
<th>Admission No</th>

<th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>
<th><?php echo $this->lang->line('class'); ?></th>
<th><?php echo $this->lang->line('father_name'); ?></th>
<th> Amount</th>
<th> Payment For</th>
<th>Due Date</th>
<th class="text-right"><?php echo $this->lang->line('action'); ?></th>

</tr>
</thead>            
<tbody>    
<?php
$count = 1;
$allreceive=0;
$allamount=0;
foreach ($resultlist as $student) {


?>
<tr>
<td><?php   echo $count; ?></td>
<td><?php echo $student['admission_no']; ?></td>

<td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
<td><?php echo $student['class']; ?> ( <?php echo $student['section']; ?> )</td>
<td><?php echo $student['father_name']; ?></td>

<td align="right"><?php echo number_format($student['total_amount']);?></td>
<td align="right"><?php echo $student['payment_for'];?></td>
<td><?php echo date("d-M-Y",strtotime($student['paydate'])); ?></td>
<td class="pull-right">


<a  href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<?php
echo $currency_symbol; echo $this->lang->line('collect_fees'); ?>
</a>

</td>

</tr>
<?php
$count++;
$allamount+=$student['total_amount'];

}
?>
<tr><td colspan="5"></td><td align="right"><?php echo number_format($allamount)?></td><td align="right"></td></tr>
</tbody>



</table>




</div>
<?php
}
?>
</div>

</div> 

</section>
</div>


<script type="text/javascript">
$(document).ready(function () {
var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
$('#from-date,#to-date').datepicker({
format: date_format,
autoclose: true
});


$("#btnreset").click(function () {
$("#form1")[0].reset();
});
});
</script>

<script type="text/javascript">
function getSectionByClass(class_id, section_id) {
if (class_id != "" && section_id != "") {
$('#section_id').html("");
var base_url = '<?php echo base_url() ?>';
var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
$.ajax({
type: "GET",
url: base_url + "sections/getByClass",
data: {'class_id': class_id},
dataType: "json",
success: function (data) {
$.each(data, function (i, obj)
{
var sel = "";
if (section_id == obj.section_id) {
sel = "selected";
}
div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
});
$('#section_id').append(div_data);
}
});
}
}

$(document).ready(function () {
var class_id = $('#class_id').val();
var section_id = '<?php echo set_value('section_id') ?>';
getSectionByClass(class_id, section_id);
$(document).on('change', '#class_id', function (e) {
$('#section_id').html("");
var class_id = $(this).val();
var base_url = '<?php echo base_url() ?>';
var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
$.ajax({
type: "GET",
url: base_url + "sections/getByClass",
data: {'class_id': class_id},
dataType: "json",
success: function (data) {
$.each(data, function (i, obj)
{
div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
});
$('#section_id').append(div_data);
}
});
});
});
</script>
