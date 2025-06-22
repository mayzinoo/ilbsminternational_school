<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
            <i class="fa fa-mortar-board"></i> Courses <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title"><?php //echo $title;     ?>New Purchase Request Form</h3>
</div><!-- /.box-header -->
<form id="form1" action="<?php echo site_url() ?>admin/Purchase/edit/<?=$row->id?>" name="purchase" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
<?php echo form_hidden("id",$row->id); ?>

<!--Header Row Start-->
<div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Form No</label>
        <input id="form_no" name="form_no" placeholder="" type="text" class="form-control"  value="<?php echo $row->form_no; ?>"  />
     </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Requested By</label>
        <input id="" name="requested_by" placeholder="" type="text" class="form-control"  value="<?php echo $row->requested_by; ?>"  />
     </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Requested Date</label>
        <input id="reqdate" name="reqdate" placeholder="" type="text" class="form-control"  value="<?php echo $row->requested_date; ?>"  />
     </div>
    </div>

<div class="col-md-2">
      <div class="form-group">
    <label for="exampleInputEmail1">Requested School</label>
    <input id="reqschool" name="reqschool" placeholder="" type="text" class="form-control"  value="<?php echo $row->requested_school; ?>"  />
</div>
</div>


<div class="col-md-2">
    <div class="form-group">
        <label for="exampleInputEmail1">Business Unit</label>
        <input autofocus="" value="<?php echo $row->business_unit; ?>" id="bunit" name="bunit" placeholder="" type="text" class="form-control" />
        <span class="text-danger"><?php echo form_error('bunit'); ?></span>
    </div>
</div>
                            
<div class="col-md-2">
    <div class="form-group">
        <label for="exampleInputEmail1">Department</label>
        <input autofocus="" id="dept" value="<?php echo $row->department; ?>" name="dept" placeholder="" type="text" class="form-control" />
        <span class="text-danger"><?php echo form_error('dept'); ?></span>
    </div>
</div>

</div>  

<!--Header Row End-->
<div class="row">
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Certified By</label>
        <input id="certified_by" name="certified_by" placeholder="" type="text" class="form-control"  value="<?php echo $row->certified_by; ?>"  />
     </div>
    </div>
    
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Certified Date</label>
            <input autofocus="" value="<?php echo $row->certified_date; ?>" id="certified_date" name="certified_date" placeholder="" type="text" class="form-control" />
            <span class="text-danger"></span>
        </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Checked By</label>
        <input id="checked_by" name="checked_by" placeholder="" type="text" class="form-control"  value="<?php echo $row->checked_by; ?>"  />
     </div>
    </div>
    
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Checked Date</label>
            <input autofocus="" value="<?php echo $row->checked_date; ?>" id="checked_date" name="checked_date" placeholder="" type="text" class="form-control" />
            <span class="text-danger"><?php echo form_error('checked_date'); ?></span>
        </div>
    </div>

<div class="col-md-2">
      <div class="form-group">
    <label for="exampleInputEmail1">Approved By</label>
    <input id="approved_by" name="approved_by" placeholder="" type="text" class="form-control"  value="<?php $row->approved_by; ?>"  />
</div>
</div>

<div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Approved Date</label>
            <input autofocus="" value="<?php echo $row->approved_date; ?>" id="approved_date" name="approved_date" placeholder="" type="text" class="form-control" />
            <span class="text-danger"><?php echo form_error('approved_date'); ?></span>
        </div>
    </div>


</div>  

<!--second row-->

  <div class="panel-default">
      <div class="panel-body">
  <div class="row clone">
  <table class="table" width="100%">
      
  <thead>
    <tr>
        <th width="5%">No</th>
          <th>Description</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Remark</th>
          <th>X</th>
          <th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></th>
      </tr>
  </thead>
  <tbody id="SourceWrapper">

<?php $no=1; foreach($lists->result() as $list){ ?> 
  
  <tr class="clonethis">
  <td class="no"><?=$no?></td>
      
      <td>
          
<div class="form-group <?php
if (form_error('description[]')) {
    echo 'has-error';
}
?>">
    <textarea class="form-control" name="description[]" placeholder="" rows="3" placeholder="Enter ..."><?php echo $list->item_name; ?></textarea>

</div>
      </td>
      
      <td>
            <div class="form-group ">
               <?php echo form_input("unit[]",$list->unit,'class="form-control"'); ?>
            </div> 

      </td>
      
      <td>
            <div class="form-group ">
               <?php echo form_input("quantity[]",$list->quantity,'class="form-control"'); ?>
            </div> 

      </td>
      
      <td>
            <div class="form-group ">
               <?php echo form_input("remark[]",$list->remark,'class="form-control"'); ?>
            </div> 

      </td>
      
      <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
  </tr>
  
  <?php $no++; } ?>
      
  </tbody>
  </table>
    
          
    
  </div>
  </div>
  </div>


</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
</div>
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
