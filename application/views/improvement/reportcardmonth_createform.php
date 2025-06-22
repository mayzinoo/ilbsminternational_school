<style>
    .padding_md{
        padding-top:30px;
        padding-bottom:30px;
    }
    .month-save{
        margin-top:21px;
    }
</style>
<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
<i class="fa fa-credit-card"></i> Report Card Months Create Form<small></small>        </h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="row">
    <div class="col-md-12 padding_md">
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
        if (form_error('name')) {
            echo 'has-error';
        }
        ?>">
            <label for="exampleInputEmail1">Class Level</label>
        
           <?php echo form_dropdown("month",$class_level,$month,'class="form-control"'); ?>
        
        </div>
        </div>
        <div class="col-md-2 month-save">
           
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            
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