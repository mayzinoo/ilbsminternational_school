
<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
<i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> </h1>
</section>
<!-- Main content -->
<section class="content">
<div class="row">  
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
</div>
<form id='form1' action="<?php echo site_url('teacher/Teaattendence/teamaintenance') ?>"  method="post" accept-charset="utf-8">
<div class="box-body">
<?php echo $this->customlib->getCSRF(); ?>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
<select autofocus="" id="class_id" name="class_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($classlist as $class) {
?>
<option value="<?php echo $class['id'] ?>" <?php
if ($class_id == $class['id']) {
echo "selected =selected";
}
?>><?php echo $class['class'] ?></option>
<?php
$count++;
}
?>
</select>
<span class="text-danger"><?php echo form_error('class_id'); ?></span>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
<select  id="section_id" name="section_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
</select>
<span class="text-danger"><?php echo form_error('section_id'); ?></span>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">
<?php echo $this->lang->line('attendance'); ?>
<?php echo $this->lang->line('date'); ?>
</label>
<input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
<span class="text-danger"><?php echo form_error('date'); ?></span>
</div>
</div>
</div>
</div>
<div class="box-footer">
<button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</form>
</div>


<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('attendance'); ?> Maintenance <?php echo $this->lang->line('list'); ?> </h3>
<div class="box-tools pull-right">
</div>
</div>
<div class="box-body">
<div class="container">
<?=form_open("admin/Teaattendence/teamaintenance_insert")?>
<table class="table table-bordered" width="50%">
<thead>

<tr>
<th>No</th>
<th><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('name'); ?></th>

<th> Date</th>
<th>In Time</th>
<th>Out Time</th>
<th width="50"> </th>
</tr> 
</thead>            
<tbody>    
<?php
$date = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat(date("Y-m-d")));

$count = 1;
if($resultlist)
{
foreach ($resultlist as $teacher) {


?>

<tr>
<td><?php   echo $count; ?><input type="hidden" name="tea_id[]" value="<?=$teacher['id']?>" /></td>
<td><?php echo $teacher["name"]; ?></td>
<td>

<div class="form-group">

<input type="text" name="sdate[]" class="form-control sandbox-container" id="date_<?php echo $teacher['id'] ?>" placeholder="Enter date" value="<?php echo $date ; ?>">
</div>
</td>
<td>
<?php
$in_time = "9:00 AM";
$out_time = "4:00 PM";

?>
<div class="bootstrap-timepicker">
<div class="form-group">

<div class="input-group">
<input type="text" name="stime[]" class="form-control timepicker" id="stime_<?php echo $teacher['id'] ?>" value="<?php echo $in_time;; ?>">
<div class="input-group-addon">
<i class="fa fa-clock-o"></i>
</div>
</div><!-- /.input group -->
</div><!-- /.form group -->
</div>
</td>
<td>
<div class="bootstrap-timepicker">
<div class="form-group">

<div class="input-group">
<input type="text" name="etime[]" class="form-control timepicker" id="etime_<?php echo $teacher['id'] ?>" value="<?php echo $out_time; ?>">
<div class="input-group-addon">
<i class="fa fa-clock-o"></i>
</div>
</div><!-- /.input group -->
</div><!-- /.form group -->
</div>
</td>
<td></td>

</tr>
<?php
$count++;


}

}
?>
<tr>
    <td colspan="5" align="right"><input type="submit" name="save" value="Save"></td>
</tr>
</tbody>



</table>

<?=form_close()?>


</div>
</div>
</div>

</section>
</div>
<script type="text/javascript">
$(document).ready(function () {
var section_id_post = '<?php echo $section_id; ?>';
var class_id_post = '<?php echo $class_id; ?>';
populateSection(section_id_post, class_id_post);
function populateSection(section_id_post, class_id_post) {
$('#section_id').html("");
var base_url = '<?php echo base_url() ?>';
var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
$.ajax({
type: "GET",
url: base_url + "teacher/sections/getByClass",
data: {'class_id': class_id_post},
dataType: "json",
success: function (data) {
$.each(data, function (i, obj)
{
var select = "";
if (section_id_post == obj.section_id) {
var select = "selected=selected";
}
div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
});

$('#section_id').append(div_data);
}
});
}
$(document).on('change', '#class_id', function (e) {
$('#section_id').html("");
var class_id = $(this).val();
var base_url = '<?php echo base_url() ?>';
var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
$.ajax({
type: "GET",
url: base_url + "teacher/sections/getByClass",
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
var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
$('#date').datepicker({
format: date_format,
autoclose: true
});
});
</script>


<script type="text/javascript" src="<?php echo base_url(); ?>backend/custom/bootstrap-datepicker.js"></script>

<script>
    $(function () {

        $(".timepicker").timepicker({
            showInputs: false,

        });
    });
</script>
<script>
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
    $('.sandbox-container').datepicker({

        autoclose: true,
        // format : "dd-mm-yyyy"
        format: date_format,
    });


    $(function () {
        $('.addschedule-form').validate({

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('input[id^="date_"]').each(function () {
            $(this).rules('add', {
                required: true,
                messages: {
                    required: "Required"
                }
            });

        });
        $('input[id^="stime_"]').each(function () {
            $(this).rules('add', {
                required: true,
                messages: {
                    required: "Required"
                }
            });
        });
        $('input[id^="etime_"]').each(function () {
            $(this).rules('add', {
                required: true,
                messages: {
                    required: "Required"
                }
            });
        });

    });

</script>
