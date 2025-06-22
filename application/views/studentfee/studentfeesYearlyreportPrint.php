<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
    @media print {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
        table.hidden-xs {
            display: table;
        }
        tr.hidden-xs {
            display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }
        .hidden-xs.hidden-print {
            display: none !important;
        }
        .hidden-sm {
            display: none !important;
        }
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
    }

    .address
{
	font-size: 11px;
}
th.right
{
    text-align: right !important;
}
 @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    h4{
    	color: #8e3808;
    	margin-bottom: 3px;
    }

    /*h3{
    	color: #FF0000;
    }*/
    .title1{
    	color: #FF0000;
    	font-size: 30px;


    }

    h3{
    	color: #FF0000;
    	font-size: 30px;
    	margin: 0px;
    }

    p
    {
    	margin: 3px;
    }

    .title2{
    	color: #1a8731;
    	font-size: 16px;
    }
    .address{
    	color: #1a8731;
    	font-size: 16px;
    }

    body
    {
        margin: 0mm 15mm 10mm 15mm; /* margin you want for the content */
    font-size: 11px;

    }
   

.font1
{
  color:red !important;
}

.font2
{
  color:blue !important;
}

.footer
{
  font-family:Zawgyi-One;
  font-size:11px;
  position:absolute;
  bottom:0;
  text-align:center;
  width:100%
}
</style>

<html lang="en">
    <head>
        <title>Monthly <?php echo $this->lang->line('fees_receipt'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>       
        <div class="">
                <div id="content" >
                    <div class="invoice">
                        
                              


 <div class="table-responsive">


<div class="panel-default">
<div class="panel-heading">
<h3>Fees Collection ( <?=$sel_year?> ) - <?=$school[$sel_school]?></h3>
</div>
<div class="panel-body">

<div class="row clone">
<table class="table table-striped table-bordered table-hover example">
<thead>

<tr>
<th>No</th>
<th>Admission No</th>

<th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>
<th><?php echo $this->lang->line('class'); ?></th>
<th><?php echo $this->lang->line('father_name'); ?></th>
<th>Collected BY</th>
<th style="text-align:right !important"> Payment For</th>
<th style="text-align:right !important"> Received</th>
<th style="text-align:right !important">Collected Date</th>

</tr>
</thead>            
<tbody>    
<?php
$count = 1;
$allreceive=0;
$allamount=0;
foreach ($resultlist as $student) {


?>
<tr>
<td><?php   echo $count; ?></td>
<td><?php echo $student['admission_no']; ?></td>

<td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
<td><?php echo $student['class']; ?> ( <?php echo $student['section']; ?> )</td>
<td><?php echo $student['father_name']; ?></td>

<td><?php echo $student['authority']; ?></td>
<td align="right"><?php echo $student['payment_for'];?></td>
<td align="right"><?php echo number_format($student['total_received']);?></td>
<td style="text-align:right !important"><?php echo date("d-m-Y",strtotime($student['fcdate'])); ?></td>


</tr>
<?php
$count++;
$allreceive+=$student['total_received'];
$allamount+=$student['total_amount'];

}
?>
<tr><td colspan="6"></td><td align="right"></td><td align="right"><?php echo number_format($allreceive)?></td></tr>
</tbody>



</table>


</div>


<?php echo form_close(); ?>
</div>
</div>


</div>


</div></div>

 

</div>

</div>

</div>
</section>
</div>

<script type="text/javascript">
window.print();
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
