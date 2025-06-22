<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
            <i class="fa fa-mortar-board"></i> Academics <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title"><?php //echo $title;     ?>Edit Performance Form</h3>
</div><!-- /.box-header -->
<form id="form1" action="<?php echo site_url() ?>admin/Performance/edit/<?=$row->id?>" name="purchase" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
        <label for="exampleInputEmail1">Teacher's Name</label>
        <?php echo form_dropdown("teacher",$teachers,$row->teacher_id,"class='form-control'")?>
     </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Approved By</label>
        <?php echo form_dropdown("approved_by",$teachers,$row->approved_by,"class='form-control'")?>
     </div>
    </div>
    
</div>  

<!--Header Row End-->

  <div class="panel-default">
      <div class="panel-body">
  <div class="row clone">
  <table class="table" width="100%">
      
  <thead>
    <tr>
        <th width="5%">No</th>
          <th>Performance Type</th>
          <th>Performance Level</th>
          <!--<th>X</th>-->
          <!--<th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></th>-->
      </tr>
  </thead>
  <tbody id="SourceWrapper">

<?php
if($lists->num_rows()>0)
{
$no=1; foreach($lists->result() as $list){ ?> 
  
  <!--<tr class="clonethis">-->
  <tr>
  <td class="no"><?=$no?></td>
      
   <td>
          
<div class="form-group">
    <?php echo form_input("performtype[]",$list->ptype,"class='form-control' readonly")?>
</div>
      </td>
      
      <td>
            <div class="form-group ">
                <?php echo form_dropdown("level[]",array("-"=>"..Select..","excellent"=>"Excellent","good"=>"Good","fair"=>"Fair","poor"=>"Poor"),$list->plevel,"class='form-control'")?>
            </div> 

      </td>
      
      <!--<td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>-->
  </tr>
  
  <?php $no++; }
  
  }
  
  if($lists->num_rows()==0)
  { ?>
       <?php $i=1; 
       foreach($performtype->result() as $ptype){ ?>
  <tr>
  <td class="no"><?=$i?></td>
      
      <td>
          
<div class="form-group">
    <?php echo form_input("performtype[]",$ptype->name,"class='form-control' readonly")?>
</div>
      </td>
      
      <td>
            <div class="form-group ">
                <?php echo form_dropdown("level[]",array("-"=>"..Select..","excellent"=>"Excellent","good"=>"Good","fair"=>"Fair","poor"=>"Poor"),"","class='form-control'")?>
            </div> 

      </td>
      
      
      <!--<td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>-->
  </tr>
  
  <?php $i++; } 
  }
  ?>
      
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
