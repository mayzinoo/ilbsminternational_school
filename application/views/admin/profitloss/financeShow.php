<div class="content-wrapper" style="min-height: 305px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
               <?=form_open('admin/ProfitLoss/profitloss_search/')?>
                    <div class="box-body">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="row">
                            <!--<div class="col-md-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>-->
                            <!--          <input name="finance" value="income" id="1" class="fin-coll" checked="checked" type="radio">-->
                            <!--          Income-->
                            <!--        </label> -->
                            <!--        <label>-->
                            <!--          <input name="finance" value="outcome" id="2" class="fin-coll" type="radio">-->
                            <!--          Outcome-->
                            <!--        </label>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-12">
                                <!--<div class="col-md-4">-->
                                <!--    <div class="form-group" id="con-one">-->
                                <!--    <label for="exampleInputEmail1">Category</label>-->
                                <!--    <select name="income" class="form-control">-->
                                <!--        <option value="">...Select...</option>-->
                                <!--        <option value="coursefee">Course Fee Receive</option>-->
                                <!--        <option value="collectfee">Collect Fees</option>-->
                                <!--        <option value="income">Income</option>-->
                                <!--    </select>-->
                                    
                                <!--    </div>-->
                                <!--    <div class="form-group" id="con-two">-->
                                <!--    <label for="exampleInputEmail1">Category</label>-->
                                <!--    <?=form_dropdown("outcome",array(''=>'..Select..','Expense'=>'Expense'),"",'class="form-control"')?>-->
                                    
                                <!--</div>-->
                                <!--</div>-->
                                
                                <div class="col-md-4">
                                    <label>From</label>
                                    <?php if($fromdate=="")
                                    {?>
                                    <input type="text" id="start_date" value="" name="fromdate" class="form-control">
                                    <?php }
                                    else
                                    { ?>
                                    <input type="text" id="start_date" value="<?=date("d-m-Y",strtotime($fromdate))?>" name="fromdate" class="form-control">   
                                   <?php }?>
                                </div>
                                <div class="col-md-4">
                                    <label>To</label>
                                    <?php if($todate=="")
                                    {?>
                                     <input type="text" id="end_date"  value="" name="todate" class="form-control">
                                    <?php }
                                    else
                                    { ?>
                                     <input type="text" id="end_date"  value="<?=date("d-m-Y",strtotime($todate))?>" name="todate" class="form-control">   
                                   <?php }?>
                                       
                                   
                                </div>
                                <div class="col-md-2" style="margin-top:20px;">
                                   <button type="submit" value="submit" name="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="box-footer">-->
                    <!--    <input type="button" class="btn btn-primary pull-right" value="Search" onclick="searchsingle('form1')">-->
                    <!--</div>-->
                <?=form_close()?>
            </div>
        </div>
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-users"></i>  Profit & Loss </h3>
                    <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h3 style="text-align:center">Income</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $incometotal1=$incomelist1->feestotal;
                                $incometotal2=$incomelist2->feecollecttotal;
                                $incometotal3=$incomelist3->incometotal;
                                $incometotal4=$incomelist4->stotal;
                                $incometotal5=$incomelist5->install_fees;
                                $nettotal=$incometotal1+$incometotal2+$incometotal3+$incometotal4+$incometotal5;
                                ?>
                                    <tr>
                                        <td>Course Fee Receive</td>
                                        <td><?php echo $incomelist1->feestotal; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Installment Student Fees</td>
                                        <td><?php echo $incometotal5; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Student Fees</td>
                                        <td><?php echo $incomelist2->feecollecttotal; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Income</td>
                                        <td><?php echo $incomelist3->incometotal; ?></td>
                                    </tr>
                                     <tr>
                                        <td>Sale Lists</td>
                                        <td><?php echo $incomelist4->stotal; ?></td>
                                    </tr>
                                    
                                    
                                    
                                    <tr>
                                        <td style="border-top:1px solid #000 !important;">Net Total</td>
                                        <td style="border-top:1px solid #000 !important;"><?php echo $nettotal;?></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h3 style="text-align:center">Expense</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Outcome</th>
                                    </tr>
                                </thead>
                                <tbody id="content">
                                    <tr>
                                        <th>General Outcome Lists</th>
                                    </tr>
                                    <?php
                                    $subtotal=0;
                                    foreach($outcomelist->result() as $row){ ?>
                                    <tr>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $row->total; ?></td>
                                    </tr>
                                    <?php 
                                    
                                        $subtotal+=$row->total;
                                    } ?>
                                    <tr>
                                        <th>Item purchase Lists</th>
                                    </tr>
                                    <?php
                                    foreach($outcomelist3->result() as $row){ ?>
                                    <tr>
                                        <td><?php echo $row->sname; ?></td>
                                        <td><?php echo $row->total; ?></td>
                                    </tr>
                                    <?php
                                        $subtotal+=$row->total;
                                    }?>
                                    <tr>
                                        <th>Item Use Lists</th>
                                    </tr>
                                    <?php
                                    foreach($outcomelist2->result() as $row){ ?>
                                    <tr>
                                        <td><?php echo $row->sname; ?></td>
                                        <td><?php echo $row->total; ?></td>
                                    </tr>
                                    <?php 
                                        $subtotal+=$row->total;
                                    }
                                    ?>
                                    <tr>
                                        <td style="border-top:1px solid #000 !important;">Net Total</td>
                                        <td style="border-top:1px solid #000 !important;"><?php echo $subtotal; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <h3 style="text-align:left">Net Profit</h3> <br>
                        <h4 style="text-align:left">Net Profit is : <?php echo $nettotal."-".$subtotal."=". $nettotal - $subtotal; ?> </h4>
                           
                    </div>
                    
                    </div><!--end box body-->
                </div>
            </div>
        </div><!--end col-md-12-->
    </section>
</div>

<script>

    $(document).ready(function() {

   $('#con-one').show();
   $('#con-two').hide();

   $(".fin-coll").on("change", function() {
   if ($('.fin-coll#1').is(':checked')) {  // if the radiolabel of id=1 is checked
    $('#con-one').show("slow");         //show condition one
    $('#con-two').hide();                   


    } else if ($(".fin-coll#2").is(":checked")) {
    $('#con-two').show("slow");
    $('#con-one').hide("slow");
    }
    });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#start_date,#end_date,#register_date,#startDateofTeaching').datepicker({
            format: date_format,
            autoclose: true
        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script>
    $('#start_date,#end_date,#register_date,#startDateofTeaching').datepicker({
            format: date_format,
            autoclose: true
        });
        
    function searchsingle(table)
    {	
        
    	$("#content").html("<tr><td align='center' colspan='18'><img src='images/loading.gif'/></td></tr>");
    
    	var data=$("#"+table).serialize();
    	$.ajax({
    			type: "POST",
    			url : site_url+"Finance/financetypecheck/"+table,
    			data : data,
    			success : function(e)
    			{
    			 $("#content").html(e);	
    			}
    		});
    }

</script>