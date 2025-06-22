<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
<i class="fa fa-credit-card"></i> Preschool Improvement Results Form<small></small>        </h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-primary">

<form id="form1" action="<?php echo base_url() ?>improvement/Improvement_result/search_student"  id="improvement" name="improvement" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<div class="box-body">
<?php if ($this->session->flashdata('msg')) { ?>
    <?php echo $this->session->flashdata('msg')?>
<?php } ?>
<?php
if (isset($error_message)) {
    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
}
?>
<?php echo $this->customlib->getCSRF(); ?>

<div class="row">


<div class="col-md-2">
     <div class="form-group <?php
if (form_error('class')) {
    echo 'has-error';
}
?>">

    <label for="exampleInputEmail1">Classes</label>

   <?php echo form_dropdown("class",$classlists,set_value("class"),'class="form-control"'); ?>

</div>
</div>


<div class="col-md-2">
     <div class="form-group <?php
if (form_error('section')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Section</label>

   <?php echo form_dropdown("section",$sectionlists,set_value("section"),'class="form-control"'); ?>

</div>

</div> 
<div class="col-md-2">
     <div class="form-group <?php
if (form_error('section')) {
    echo 'has-error';
}
?>">
    <label>School</label>
    <?=form_dropdown("school",$school,set_value("school"),"class='form-control'")?>
</div>

</div> 
<div class="col-md-2"> <div class="form-group">
<label for="exampleInputEmail1"> </label>
<br/>
 <input type="submit" class="btn btn-primary" value="search"/></div>
 </div>
</form>
</div>   
<div class="box-header with-border">
</div>
     
<div class="box-header with-border">
<h3 class="box-title"><?php //echo $title;     ?>Add New Improvement Results</h3>
</div><!-- /.box-header -->
<div class="row box-body">
<div class="box-info with-border">
<?php echo form_open("improvement/Improvement_result/create")?>
    <div class="col-md-2">
      <div class="form-group <?php
if (form_error('date')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
    <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo $date; ?>"  />

</div>

</div>

<div class="col-md-2">
      <div class="form-group <?php
if (form_error('name')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Months</label>

   <?php echo form_dropdown("month",$monthlist,$month,'class="form-control"'); ?>

</div>
</div>
<div class="col-md-2">
      <div class="form-group <?php
if (form_error('teacher_id')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Teacher's Name</label>

   <?php echo form_dropdown("teacher_id",$teacherlists,$teacher_id,'class="form-control"'); ?>

</div>
</div>
 <div class="col-md-4">
     <div class="form-group <?php
if (form_error('improvement_id')) {
    echo 'has-error';
}
?>">
    <label for="exampleInputEmail1">Lesson Title</label>

   <?php echo form_dropdown("improvement_id",$lessons,$improvement_id,"class='form-control' onchange=headertitlesearch(this.value)"); ?>

</div>

</div> 


</div>
             
  <div class="panel-default">
      <div class="panel-body">
  <div class="row clone">
  <table class="table" width="100%">
      
  <thead>
    <tr>
    <th width="5%">No</th>
    <th>Admission No</th>
          <th>Name</th>
<th>Class</th>

    <th width="20%" class="grade">Grades</th>
    <th width="20%" class="weight">Weight</th>
    <th width="20%" class="height">Height</th>
      </tr>
  </thead>
  <tbody id="SourceWrapper">
  <?php
  $no=1;

   
    if(!$resultlist) {
          ?>
      <tfoot>    
           <tr>
               <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                      
           </tr>
       </tfoot>
       <?php
   } else {
   foreach($resultlist as $stulist): ?>
  <tr class="clonethis">
  <td class="no"><?php echo $no; ?></td>
  <td class="no"><?php echo $stulist["admission_no"]?></td>
  <td>
  <input type="hidden" name="student_id[]" value="<?=$stulist['id']?>"/>
  <input type="hidden" name="class_id[]" value="<?=$stulist['class']?>"/>
  <input type="hidden" name="section_id[]" value="<?=$stulist['section']?>"/>
 
<div class="form-group <?php
if (form_error('firstname')) {
    echo 'has-error';
}
?>">
<?php echo $stulist["firstname"] . " " . $stulist["lastname"]; ?>
</div>
      </td>


      <td><?php echo $stulist["class"]."(".$stulist["section"].")" ?></td>


      <td class="grade">
            <div class="form-group <?php
if (form_error('grades')) {
    echo 'has-error';
}
?>">

   <?php echo form_dropdown("grades[]",$grades,'','class="form-control"'); ?>

</div> 

      </td>
    <td class="weight">
      <input type="text" name="weight" class="form-control">
    </td>
    <td class="height">
          <input type="text" name="height" class="form-control">
    </td>
  </tr>
  

  <?php 
$no++;

  endforeach; 
  ?>
      
  </tbody>
  </table>
    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
<?php }
 ?>
</form>

          </div>

    
  </div>
  </div>
  </div>

   
</div><!-- /.box-body -->

<div class="box-footer">
</div>
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
<script>
    $( document ).ready(function() {
        $(".grade").show();
       $(".weight").hide();
       $(".height").hide();
    });
</script>

<script type="text/javascript">

    function headertitlesearch(id)
    {
       if(id==13){
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