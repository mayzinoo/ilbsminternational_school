<link rel="stylesheet" href="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.js"></script>
<style>
    .grade-1 {
        background-color: #FA2601;
    }
    .grade-2 {
        background-color: #FA8A00;/*27AB00*/
    }
    .grade-3 {
        background-color: green;
    }
    .grade-4 {
        background-color: #FA8A00;
    }
    .grade-5 {
        background-color: #a7a7a7;
    }
    .toppadding_sm{
        padding-top:20px;
    }
    .form-control{
        padding: 0px 5px !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1> 
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?></small>    
    </h1>
    </section>
    <section class="content">
    
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div id="my-calendar"></div>
                    </div>

                     <div class="box-body">

 <table class="table table-bordered">
                    <thead class="thead-over">
                      <tr>
                       
                      <th>Month</th>
                        <th>Present %</th>
                        <th>Absent</th>
                        <th>Leave</th>
                        
        </tr>
                    </thead>

                    <?php 

                    $attcal=array();
                    foreach($attdays->result() as $att):
                        $attcal[$att->att_month]=$att->att_day;

                    endforeach;
                   

                    ?>
                    
                    <tbody id="content">
                    <?php
                    $alltotal=0;
                    $tp=0;
                    $ta=0;
                    $tl=0;
                                    foreach($att_percent->result() as $list):
                                ?>
                                  <tr>
                       
                        <td><?=$monthlist[$list->month]?></td>
                        <td><?=@round(($list->totalpresent/ $attcal[$list->month])*100)?> %</td>
                        <td><?=$list->totalabsent?></td>
                        <td><?=$list->totalleave?></td>


                        
                                      </tr>
                                       <?php
                                       $tp+= $list->totalpresent;
                                       $ta+= $list->totalabsent;
                                       $tl+= $list->totalleave;
                                    endforeach;
                                
                                ?>

                                 <tr style="border-top:1px solid red">
                       
                        <td></td>
                        <th><?=@round(($tp/ array_sum($attcal))*100)?> %</th>
                        <th><?=$ta?></th>
                        <th><?=$tl?></th>


                        
                                      </tr>
                     

                    </tbody>
                   
                  </table>
                    </div>
                </div>
            </div>
           
        </div>
    </section>
</div>
<script type="application/javascript">
    $(document).ready(function () {
    var  base_url = '<?php echo base_url() ?>';
    var student_id='<?php echo $student_id; ?>';
    $("#my-calendar").zabuto_calendar({
    legend: [
    {type: "block", label: "<?php echo $this->lang->line('absent') ?>", classname: 'grade-1'},
    {type: "block", label: "Present", classname: 'grade-3'},
    {type: "block", label: "<?php echo $this->lang->line('leave') ?>", classname: 'grade-2'},
    {type: "block", label: "<?php echo $this->lang->line('holiday') ?>", classname: 'grade-5'},
    ],
    ajax: {
    url: base_url+"parent/parents/getAjaxAttendence?grade=1&student_id="+student_id,
    }
    });
    });

    
</script>

