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

<?php 
$show=$studentfee->row();
 ?>
<html lang="en">
    <head>
        <title><?php echo $this->lang->line('fees_receipt'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>       
        <div class="container">
            <div class="container">
                <div id="content" >
                    <div class="invoice">
                        <div class="row header text-center">
                            <div class="col-sm-2">
                                <?php
                                if ($settinglist[0]['image'] != "") {
                                    ?>

                                    <img style="height:70px;" src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-10">

                                <strong style="font-size: 20px;"><?php echo $settinglist[0]['name']; ?></strong><br>
                                <?php echo $settinglist[0]['address']; ?>

                                <?php echo $this->lang->line('phone'); ?>: <?php echo $settinglist[0]['phone']; ?><br>
                                <?php echo $this->lang->line('email'); ?>: <?php echo $settinglist[0]['email']; ?><br>

                            </div><!--/col-->
                        </div>
  <br/>
  <br/>

                        <div class="row">
                            <div class="col-sm-8"><?php echo $student['firstname'] . " " . $student['lastname'] ?>
                            <br/> ID : <?php echo $student['admission_no']; ?>
                            <br/>
                            Gurdian Name : <?php echo $student['father_name']; ?> + <?php echo $student['mother_name']; ?>
                            <br/>
                            Class : <?php echo $student['class'] . " (" . $student['section'] . ")" ?>
                            </div>
                            <div class="col-sm-4 text-right">
                                <br/>
                                <address>
                                    <strong>Date: <?php  echo date("d-m-Y, h:i:s A",strtotime($show->created_at))?></strong><br/>
Payment For : <?php echo $show->payment_for; ?>
                                </address>                               
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
<th class="right">Amount</th>
<th class="right">Discount</th>
<th class="right">Received</th>
</tr>
</thead>
<tbody id="SourceWrapper">
<?php 
$count=1;
foreach($studentfee->result() as $fee): ?>
<tr class="clonethis">
<td class="no"><?php echo $count;?></td>
<td>
<div class="form-group">

<?php echo $fee->fgname?>

</div> 

</td>

<td align="right">

<div class="form-group">
<?php echo number_format($fee->amount); ?>

</div>
</td>
<td align="right">

<div class="form-group">
<?php echo $fee->amount_discount; ?>

</div>
</td>
<td align="right">

<div class="form-group">
<?php echo number_format($fee->receive); ?>

</div>
</td>
</tr>

<?php 
$count++;
	endforeach;
 ?>

</tbody>

<tr>
<td colspan="4" align="right"><b>Total Received</b></td>
<td align="right">   
<b><?php echo number_format($show->total_received)?></b>
</td>
</tr>
</table>



</div>
<div class="row">
<div class="col-sm-8"></div>
    <div class="col-sm-4" align="center">
    <br/>
    <br/>
    <br/>
    <strong>Received By</strong>
    <br/>
    <strong><?=$show->authority?></strong>
</div>

</div>

<?php echo form_close(); ?>
</div>
</div>


</div>


</div></div>

</div>
 

</div>

</div>

</div>
</div>
<div class="footer">
<?php 
$show=$studentfee->row();
 ?>
	<?php echo $settinglist[0]['dise_code']?>
</div>
</section>
</div>

<script type="text/javascript">
window.print();
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
