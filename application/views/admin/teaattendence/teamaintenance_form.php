
<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
<i class="fa fa-calendar-check-o"></i> Teachers <?php echo $this->lang->line('attendance'); ?> Maintainance Form </h1>
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
<label for="exampleInputEmail1">Location</label>
<?php echo form_dropdown("location",$locations,set_value("location"),"class='form-control'"); ?>
<span class="text-danger"><?php echo form_error('class_id'); ?></span>
</div>
</div>

<div class="col-md-4">
<div class="form-group">

<label for="exampleInputEmail1"></label>
<br/>
<button type="submit" name="search" value="search" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</div>
</div>
</div>

</form>
</div>


<div class="box box-info">
<div class="box-header with-border">
<br/>
<?=form_open("admin/Teaattendence/teamaintenance_insert")?>

<h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('attendance'); ?> Maintenance <?php echo $this->lang->line('list'); ?> </h3>
<div class="box-tools pull-right">
 <div class="form-group">
<?php echo $this->lang->line('date'); ?>
&nbsp;
&nbsp;
&nbsp;
<input id="date" name="sdate" placeholder="" type="text"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" /> <span class="text-danger"><?php echo form_error('sdate'); ?></span>
                            </div>
</div>
</div>
<div class="box-body">
<table class="table table-bordered" width="50%">
<thead>

<tr>
<th style="width:5% !important">No</th>
<th style="width:30% !important"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('name'); ?></th>

<th style="width:15% !important">In Time</th>
<th style="width:15% !important">Out Time</th>
<th style="width:15% !important"> If Absent</th>
<th style="width:3% !important"></th>

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
<?php
$in_time = "8:00 AM";
$out_time = "5:30 PM";

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
<td>
<select name="reason[]" class="form-control">

<option value="Present">Present</option>
<option value="Absent">Absent</option>
<option value="Leave">Leave</option>
<option value="Half Day Leave">Half Day Leave</option>


</select>
</td>
<td ><i class="fa fa-trash" onclick="removerform(event)"></i></td>

</tr>
<?php
$count++;


}

}
?>
<tr>
    <td colspan="4" ></td><td align="left"><input type="submit" name="save" value="Save"></td>
</tr>
</tbody>



</table>

<?=form_close()?>


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
