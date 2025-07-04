<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">  
<section class="content-header">
<h1>
<i class="fa fa-user-plus"></i> Students' Improvements  <small class="pull-right"><?=anchor("teacher/improvement/Improvement_result/createform","+ Add","class='btn btn-primary btn-sm'")?></small> </h1>
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
<?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
<div class="row">
<div class="col-md-4">
<div class="row">
<form role="form" action="<?php echo site_url('teacher/improvement/Improvement_result/search_result') ?>" method="post" class="">
<?php echo $this->customlib->getCSRF(); ?>
<div class="col-sm-6">
<div class="form-group"> 
<label><?php echo $this->lang->line('class'); ?></label>
<select autofocus="" id="class_id" name="class_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($classlist as $class) {
?>
<option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
<?php
$count++;
}
?>
</select>
<span class="text-danger"><?php echo form_error('class_id'); ?></span>
</div>  
</div>
<div class="col-sm-6">
<div class="form-group">
<label><?php echo $this->lang->line('section'); ?></label>
<select  id="section_id" name="section_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
</select>
<span class="text-danger"><?php echo form_error('section_id'); ?></span>
</div>   
</div>

<div class="col-sm-12">
<div class="form-group">
<button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</div>
</div>  
</form>
</div>
<div class="col-md-8">
<div class="row">
<form role="form" action="<?php echo site_url('teacher/improvement/Improvement_result/search_result') ?>" method="post" class="">
<?php echo $this->customlib->getCSRF(); ?>
<div class="col-sm-3">
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
</div>


<div class="col-sm-6">
<div class="form-group">
<label><?php echo $this->lang->line('search_by_keyword'); ?></label>
<input type="text" name="search_text" class="form-control" placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
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

<div class="tab-content">
<div class="download_label"><?php echo $title; ?></div>
<div class="tab-pane active table-responsive no-padding" id="tab_1">
<table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
<thead>
<tr>
<th>No</th>
<th><?php echo $this->lang->line('admission_no'); ?></th>
<th><?php echo $this->lang->line('student_name'); ?></th>
<th><?php echo $this->lang->line('class'); ?></th>
<th>Improvement Title</th>
<th>Status</th>
<th>Approved By</th>
<th>Date</th>

<th class="text-right"><?php echo $this->lang->line('action'); ?></th>
</tr>
</thead>
<tbody>
<?php
if (empty($resultlist)) {
?>
<!-- <tr>
<td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
</tr> -->
<?php
} else {
$count = 1;
foreach ($resultlist as $list) {
?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo $list->admission_no; ?></td>
<td>
<a href="<?php echo base_url(); ?>student/view/<?php echo $list->id; ?>"><?php echo $list->firstname . " " . $list->lastname; ?>
</a>
</td>
<td><?php echo $list->class . "(" . $list->section . ")" ?></td>
<td><?php echo $list->improvement_id; ?></td>
<td><?php echo $list->grade; ?></td>
<td><?php echo $list->authority; ?></td>
<td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($list->dob)); ?></td>
<td class="mailbox-date pull-right">
<a href="<?php echo base_url(); ?>teacher/improvement/Improvementdesc/view/<?php echo $list->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
<i class="fa fa-reorder"></i>
</a>
<a href="<?php echo base_url(); ?>teacher/improvement/Improvementdesc/edit/<?php echo $list->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
<i class="fa fa-pencil"></i>
</a>
<a href="<?php echo base_url(); ?>teacher/improvement/Improvementdesc/delete/<?php echo $list->id; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
<i class="fa fa-remove"></i>
</a>
</td>

</tr>
<?php
$count++;
}
}
?>
</tbody>
</table>
</div>                           
<div class="tab-pane" id="tab_2">
<?php if (empty($resultlist)) {
?>
<div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
<?php
} else {
$count = 1;
foreach ($resultlist as $student) {
?>
<div class="carousel-row">
<div class="slide-row">
<div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
<div class="carousel-inner">
<div class="item active">
<a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <img class="img-responsive img-thumbnail width150" alt="Cinque Terre" src="<?php echo base_url() . $student['image'] ?>" alt="Image"></a>
</div>
</div>
</div>
<div class="slide-content">
<h4><a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <?php echo $student['firstname'] . " " . $student['lastname'] ?></a></h4>
<div class="row">
<div class="col-xs-6 col-md-6">
<address>
<strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
<b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
<b><?php echo $this->lang->line('date_of_birth'); ?>:
<?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?><br>
<b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $student['gender'] ?><br>
</address>
</div>
<div class="col-xs-6 col-md-6">
<b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
<b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
<b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?><br>
<b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
</div>
</div>
</div>
<div class="slide-footer">
<span class="pull-right buttons">
<a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
<i class="fa fa-reorder"></i>
</a>
<a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
<i class="fa fa-pencil"></i>
</a>
<a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">    
<?php echo $currency_symbol; ?>
</a>
</span>
</div>
</div>
</div>
<?php
}
$count++;
}
?>
</div>                                                          
</div>                                                         
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