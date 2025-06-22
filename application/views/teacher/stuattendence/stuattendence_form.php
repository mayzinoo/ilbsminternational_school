
<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<style type="text/css">
.form-control-flex {
    display: block;
    height: 28px;
    padding: 0px 12px;
    font-size: 10pt;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
        border-top-color: rgb(204, 204, 204);
        border-right-color: rgb(204, 204, 204);
        border-bottom-color: rgb(204, 204, 204);
        border-left-color: rgb(204, 204, 204);
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
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
<form id='form1' action="<?php echo site_url('teacher/Stuattendence/stumaintenance') ?>"  method="post" accept-charset="utf-8">
<div class="box-body">
<?php echo $this->customlib->getCSRF(); ?>
<div class="row">
<div class="col-md-3">
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
<div class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
<select  id="section_id" name="section_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
</select>
<span class="text-danger"><?php echo form_error('section_id'); ?></span>
</div>
</div>


<div class="col-sm-3">
<div class="form-group">
    <label>School</label>
    <?=form_dropdown("school",$school,set_value("school"),"class='form-control'")?>
    <span class="text-danger"><?php echo form_error('school'); ?></span>
</div>   
</div>


<div class="col-md-3">
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



<?=form_open("teacher/Stuattendence/stumaintenance_insert")?>


<div class="box box-info">
<br/>
<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('attendance'); ?> Maintenance <?php echo $this->lang->line('list'); ?> </h3>

<div class="form-check btn btn-default"  style="margin-left:100px;">
  <input class="custom-control-input" type="checkbox" name="holiday" value="Holiday" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
Set As Holiday
</label>
</div>

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
<div class="container">
<table class="table table-bordered" width="50%">
<thead>

<tr>
<th  style="width:5% !important">No</th>
<th  style="width:30% !important"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>

<th style="width:15% !important">In Time</th>
<th  style="width:15% !important">Out Time</th>
<th style="width:15% !important"> If Absent</th>
</tr> 
</thead>            
<tbody>    
<?php
$date = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat(date("Y-m-d")));

$count = 1;
if($resultlist)
{
foreach ($resultlist as $student) {


?>

<tr>
<td><?php   echo $count; ?><input type="hidden" name="stu_id[]" value="<?=$student['id']?>" />
<input type="hidden" name="class[]" value="<?=$student['class_id']?>" /></td>
<input type="hidden" name="section[]" value="<?=$student['section_id']?>" /></td>
<td><?php echo $student["firstname"] . " " . $student["lastname"]; ?></td>

<td>
<?php
$in_time = "9:00 AM";
$out_time = "4:00 PM";

?>
<div class="bootstrap-timepicker">
<div class="form-group">

<div class="input-group">
<input type="text" name="stime[]" class="form-control timepicker" id="stime_<?php echo $student['id'] ?>" value="<?php echo $in_time;; ?>">
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
<input type="text" name="etime[]" class="form-control timepicker" id="etime_<?php echo $student['id'] ?>" value="<?php echo $out_time; ?>">
<div class="input-group-addon">
<i class="fa fa-clock-o"></i>
</div>
</div><!-- /.input group -->
</div><!-- /.form group -->
</div>
</td>
<td style="width:50px !important">
<select name="reason[]" class="form-control-flex">

<option value="Present">Present</option>
<option value="Absent">Absent</option>
<option value="Late">Late</option>
<option value="Leave">Leave</option>
<option value="Half Day Leave">Half Day Leave</option>


</select>
</td>



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
url: base_url + "sections/getByClass",
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