<div class="content-wrapper" style="min-height: 946px;"> 
<section class="content-header">
<h1>
<i class="fa fa-mortar-board"></i> Improvement Results <small><?php echo $this->lang->line('student_fees1'); ?></small>
</h1>
</section>
<!-- Main content -->
<section class="content">
<div class="row">          
<div class="col-md-12">
<!-- general form elements -->
<div class="box box-primary">

<div class="box-body">
<div class="table-responsive mailbox-messages">
<div class="download_label">Improvement Results </div>
<?php $show=$lists->row();?>
<div class="box-info with-border">
<?php echo form_open("improvement/Improvement_result/edit/$id")?>
    <div class="col-md-2">
      <div class="form-group <?php
if (form_error('date')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
    <input id="date" name="date" placeholder="" type="text" class="form-control date"  value="<?php echo $show->created_at; ?>"  />

</div>

</div>
<div class="col-md-2">
      <div class="form-group <?php
if (form_error('name')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Months</label>

   <?php echo form_dropdown("month",$monthlist,set_value("month",$show->reportcard_month),'class="form-control"'); ?>

</div>
</div>

<div class="col-md-2">
     <div class="form-group <?php
if (form_error('class')) {
    echo 'has-error';
}
?>">

    <label for="exampleInputEmail1">Classes</label>

   <?php echo form_dropdown("class",$classlists,set_value("class",$show->class_id),'class="form-control"'); ?>

</div>
</div>


<div class="col-md-2">
     <div class="form-group <?php
if (form_error('section')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Section</label>

   <?php echo form_dropdown("section",$sectionlists,set_value("section",$show->section_id),'class="form-control"'); ?>

</div>

</div> 


<div class="col-md-2">
      <div class="form-group <?php
if (form_error('teacher_id')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Teacher's Name</label>

   <?php echo form_dropdown("teacher_id",$teacherlists,set_value("teacher_id",$show->teacher_id),'class="form-control"'); ?>

</div>
</div>

 <div class="col-md-4">
     <div class="form-group <?php
if (form_error('improvement_id')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Lesson Title</label>

   <?php echo form_dropdown("improvement_id",$lessons,set_value("improvement_id",$show->improvement_id),'class="form-control" onchange=headertitlesearch(this.value)'); ?>

</div>

</div> 


</div>
<table class="table table-striped table-bordered table-hover example">
<thead>

<tr>
<th width="15">No</th>
<th>Admission No</th>
<th>Student
</th>
<th class="grade">Grade
</th>
<th class="weight">Weight</th>
<th class="height">Height</th>
</tr>
</thead>
<tbody>
<?php


$grades = array(3=>"ေကာင္း",2=>"သင့္",1=>"လို");
$no=1;
foreach ($lists->result() as $expense) {


?>
<tr>
<td><?php echo $no; ?></td>
<td><?php echo $expense->admission_no; ?></td>
<td class="mailbox-name">
 <input type="hidden" name="student_id[]" value="<?=$expense->student_id?>"/>
  <input type="hidden" name="class_id[]" value="<?=$expense->class_id?>"/>
  <input type="hidden" name="section_id[]" value="<?=$expense->section_id?>"/>

<?php echo $expense->firstname.$expense->lastname; ?>

</td>

<td class="grade">
            <div class="form-group <?php
if (form_error('grades')) {
    echo 'has-error';
}
?>">

   <?php echo form_dropdown("grades[]",$grades,$expense->grade,'class="form-control"'); ?>

</div> 

      </td>
<td class="weight">
      <input type="text" name="weight" class="form-control" value="<?=$expense->weight?>">
    </td>
    <td class="height">
          <input type="text" name="height" class="form-control" value="<?=$expense->height?>">
    </td>

</tr>
<?php
$no++;
}

?>

</tbody>
</table><!-- /.table -->



</div><!-- /.mail-box-messages -->

  <div class="pull-right">
    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
</form>
  </div>
</div><!-- /.box-body -->
</div>
</div><!--/.col (left) -->

</div> 
</section>
</div>

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
$(document).on('click', '.schedule_modal', function () {
$('.modal-title').html("");
$('.modal-title').html("<?php echo $this->lang->line('login_details'); ?>");
var base_url = '<?php echo base_url() ?>';
var teacher_id = '<?php echo $teacher["id"] ?>';
var teacher_name = '<?php echo $teacher["name"] ?>';
$.ajax({
type: "post",
url: base_url + "admin/teacher/getlogindetail",
data: {'teacher_id': teacher_id},
dataType: "json",
success: function (response) {
var data = "";
data += '<div class="table-responsive">';
data += '<p class="lead text text-center">' + teacher_name + '</p>';
data += '<table class="table table-hover">';
data += '<thead>';
data += '<tr>';
data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
data += '</tr>';
data += '</thead>';
data += '<tbody>';
$.each(response, function (i, obj)
{
console.log(obj);
data += '<tr>';
data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
data += '<td class="text text-center">' + obj.username + '</td> ';
data += '<td class="text text-center">' + obj.password + '</td> ';
data += '</tr>';
});
data += '</tbody>';
data += '</table>';
data += '<b class="lead text text-danger" style="font-size:14px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
data += '</div>  ';
$('.modal-body').html(data);
$("#scheduleModal").modal('show');
}
});
});

function firstToUpperCase(str) {
return str.substr(0, 1).toUpperCase() + str.substr(1);
}
</script>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title"></h4>
</div>
<div class="modal-body">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    function headertitlesearch(id)
    {
       if(id=13){
           $(".grade").hide();
           $(".weight").show();
           $(".height").show();
       }
       else{
           $(".grade").show();
           $(".weight").hide();
           $(".height").hide();
       }
    }
</script>