<style>

@media only screen and (min-width:200px) and (max-width: 480px){
    .getfee table {
    border: 0;
  }

  .getfee table caption {
    font-size: 1.3em;
  }
  
  .getfee table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  .getfee table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  .getfee table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  .getfee table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  .getfee table td:last-child {
    border-bottom: 0;
  }
  td.payment-bg{
      background:#ccc;
  }
}
</style>

<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();


?>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Fees</h1>
    </section>
    <section class="content">
        <div class="row">
            <!--<div class="col-md-3">-->
            <!--    <div class="box box-primary">-->
            <!--        <div class="box-body box-profile">-->
            <!--            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">-->
            <!--            <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>-->
            <!--            <ul class="list-group list-group-unbordered">-->
            <!--                <li class="list-group-item">-->
            <!--                    <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right"><?php echo $student['admission_no']; ?></a>-->
            <!--                </li>-->
            <!--                <li class="list-group-item">-->
            <!--                    <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right"><?php echo $student['roll_no']; ?></a>-->
            <!--                </li>-->
            <!--                <li class="list-group-item">-->
            <!--                    <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right"><?php echo $student['class']; ?></a>-->
            <!--                </li>-->
            <!--                <li class="list-group-item">-->
            <!--                    <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right"><?php echo $student['section']; ?></a>-->
            <!--                </li>-->
            <!--                <li class="list-group-item">-->
            <!--                    <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right"><?php echo $student['rte']; ?></a>-->
            <!--                </li>-->
            <!--            </ul>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('fees'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if (empty($feeresultlist)) {
                            ?>
                            <div class="alert alert-danger">
                                No fees Found.
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="table-responsive getfee">  

                             <table class="table table-striped table-bordered table-hover example">
<thead>

<tr>
<th scope="col" class="payment-bg">Payment For</th>
<!--<th scope="col">No</th>-->
<th scope="col"><?php echo $this->lang->line('class'); ?></th>
<th scope="col">Collected BY</th>
<th scope="col" style="text-align:right !important"> Amount</th>
<th scope="col" style="text-align:right !important"> Received</th>
<th scope="col" style="text-align:right !important">Collected Date</th>
<th scope="col" class="text-right"><?php echo $this->lang->line('action'); ?></th>

</tr>
</thead>            
<tbody>    
<?php

$count = 1;
$totalamt=0;
$totalrec=0;

foreach ($feeresultlist->result() as $stufee) :

?>
<tr>
<td data-label="Payment For" class="payment-bg"><?php   echo $stufee->payment_for; ?></td>
<!--<td data-label="No"><?php   echo $count; ?></td>-->
<td data-label="Class"><?php echo $stufee->class; ?> ( <?php echo $stufee->section; ?> )</td>
<td data-label="Collected By"><?php echo $stufee->authority; ?></td>
<td data-label="Amount" align="right"><?php echo number_format($stufee->total_amount);?></td>
<td data-label="Received" align="right"><?php echo number_format($stufee->total_received);?></td>
<td data-label="Collected Date" align="right"><?php echo $stufee->fcdate; ?></td>
<td data-label="Action" class="">
<?php 
if($stufee->status==1)
{
?>
<a  title="View Details" href="<?php echo base_url(); ?>parent/parents/feedetail/<?php echo $stufee->id?>/<?php echo $stufee->student_id?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<i class="fa fa-list"></i>
</a>

<?php

}
else
{
?>
<a  href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student->id ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<?php
echo $currency_symbol; echo $this->lang->line('collect_fees'); ?>
</a>
<?php
}
?>
</td>

</tr>
<?php
$count++;
$totalamt+=$stufee->total_amount;
$totalrec+=$stufee->total_received;

endforeach;
?>
<tr>
    <td colspan="3" align="center">All Total</td>
    <td align="right"><?php echo number_format($totalamt) ?></td>
    <td align="right"><?php echo number_format($totalrec) ?></td>
</tr>

</tbody>



</table>
                            </div>  
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>