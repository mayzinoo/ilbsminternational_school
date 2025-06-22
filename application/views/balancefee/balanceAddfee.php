<style>

.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>

<script>
      var expanded = false;
function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>

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
<form action="<?php echo site_url("studentfee/create/" . $student['id']) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
<!--<p><?=$student['id']?></p>-->
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


</div></div>
<div class="col-md-12">
<div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
</div>
</div>

<div class="row no-print">
	<div class="col-xs-3 table-responsive">
<label for="exampleInputEmail1">Payment Method </label>
<?php echo form_dropdown("payment_method",$paymenttype,'',"class='form-control'");?>

</span>
</div>


<div class="col-xs-3 table-responsive">
   <label for="exampleInputEmail1">Payment For: 
</label>
    <form>
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>Select Months</option>
      </select>
      <div class="overSelect"></div>
    </div>
    
        
    <div id="checkboxes">
        <?php
        $check="";
     $month = array('January', 'February', 'March', 'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November', 'Decmber');
         ?>
      
         <?php for($i=0; $i<12; $i++)
         { 
         if($row->payment_for==$month[$i])
         {
             $check="checked";
         }
         else
         {
             $check="";
         }
         ?>
              <label><input type="checkbox" name="month<?=$i?>" value="<?=$month[$i]?>" <?=$check?> /> <?=$month[$i]?></label>
              
         <?php } ?>
 
    </div>
  </div>
</form>
</span>
</div>

  <div class="col-md-3 table-responsive ">


     <div class="form-group">
        <label for="exampleInputEmail1">Academic Year</label>
              <?=form_dropdown("sel_session",$sessionlist,$sel_session,"class='form-control'")?> 
     </div>
     </div>

<div class="col-xs-3 table-responsive">
<label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label> <input type="text" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" name="date" id="date"  class="form-control"/>
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
<th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></th>
</tr>
</thead>
<tbody id="SourceWrapper">
<tr class="clonethis">
<td class="no">1</td>
<td>
<div class="form-group <?php
if (form_error('exp_head_id')) {
echo 'has-error';
}
?>">

<?php echo form_dropdown("feegroup[]",$feegroups,$row->feegroup_id,'class="form-control" onchange="getdata(\'fee_groups\',event)" '); ?>

</div> 

</td>

<td>

<div class="form-group <?php
if (form_error('amount')) {
echo 'has-error';
}
?>">
<input class="form-control" name="amount[]" placeholder="" rows="3" value="<?php echo $row->amount; ?>">

</div>
</td>
<td>

<div class="form-group <?php
if (form_error('discount')) {
echo 'has-error';
}
?>">
<input class="form-control discount" name="discount[]" placeholder="" value="<?php echo set_value('discount',0); ?>" onkeyup="calculate_discount(event)"/>

</div>
</td>
<td>

<div class="form-group <?php
if (form_error('receive')) {
echo 'has-error';
}
?>">
<input class="form-control total" name="receive[]" value="<?php echo $row->amount; ?>" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('receive'); ?></input>

</div>
</td>




<td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
</tr>

</tbody>

<tr>
<td colspan="4" align="right">Total Received</td>
<td>   
<input type="text" name="alltotal" id="nettotal" value="<?php echo $row->amount; ?>" class="form-control" readonly>
</td>
</tr>
</table>



</div>

<div class="pull-right"><input type="submit" name="save" value="Save & Print" /></div>

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
