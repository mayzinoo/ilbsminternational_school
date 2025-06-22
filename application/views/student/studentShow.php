<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small>      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">                
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                         
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line(strtolower($student['gender'])); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>
                        <li class=""><a href="#fee" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('fees'); ?></a></li>
                                                <li class=""><a href="#exam" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('exam'); ?></a></li>

                        <li class=""><a href="#attendance" data-toggle="tab" aria-expanded="true">Attendance</a></li>
                      
                        <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                        <li class=""><a href="#pickup" data-toggle="tab" aria-expanded="true">Pickup Persons</a></li>
                        <li class=""><a href="#troute" data-toggle="tab" aria-expanded="true">Transport</a></li>
                        
                        

<!--                         <li class=""><a href="<?php echo site_url("admin/".$student['level']."_Reportcard/rpcardsfront/" . $student['id']) ?>" target="_blank">Reportcard</a></li>
 -->
                            

                          
                          
                        <li class="pull-right"><a href="<?php echo site_url("student/delete/" . $student['id']) ?>" class="text-red" onclick="return confirm('Are you sure you want to delete this Student? All related data can not be recovered!');"><i class="fa fa-trash"></i> <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('student'); ?></a></li>
                        <li class="pull-right">
                            <a href="#"  class="schedule_modal text-green" data-toggle="tooltip" title="<?php echo $this->lang->line('login_detail'); ?>"><i class="fa fa-key"></i>
                                <?php echo $this->lang->line('login_details'); ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0">
                                        <tbody>  
                                            <tr>
                                                <td class="col-md-4"><?php echo $this->lang->line('admission_date'); ?></td>
                                                <td class="col-md-5">                                          
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['admission_date'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('date_of_birth'); ?></td>
                                                <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('category'); ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($category_list as $value) {
                                                        if ($student['category_id'] == $value['id']) {
                                                            echo $value['category'];
                                                        }
                                                    }
                                                    ?>                                         
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('mobile_no'); ?></td>
                                                <td><?php echo $student['mobileno']; ?></td>
                                            </tr>
                                          
                                            <tr>
                                                <td><?php echo $this->lang->line('religion'); ?></td>
                                                <td><?php echo $student['religion']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('email'); ?></td>
                                                <td><?php echo $student['email']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </div> 
                            <div class="tshadow mb25 bozero">   
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address'); ?> <?php echo $this->lang->line('detail'); ?></h3>
                                <div class="table-responsive around10 pt0">  
                                    <table class="table table-hover table-striped tmb0"><tbody>
                                            <tr>
                                                <td><?php echo $this->lang->line('current_address'); ?></td>
                                                <td><?php echo $student['current_address']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('permanent_address'); ?></td>
                                                <td><?php echo $student['permanent_address']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                            <div class="tshadow mb25 bozero">      
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('parent'); ?> / <?php echo $this->lang->line('guardian_details'); ?> </h3>
                                <div class="table-responsive around10 pt10">
                                    <table class="table table-hover table-striped tmb0">
                                        <tr>
                                            <td  class="col-md-4"><?php echo $this->lang->line('father_name'); ?></td>
                                            <td  class="col-md-5"><?php echo $student['father_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('father_phone'); ?></td>
                                            <td><?php echo $student['father_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('father_occupation'); ?></td>
                                            <td><?php echo $student['father_occupation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_name'); ?></td>
                                            <td><?php echo $student['mother_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_phone'); ?></td>
                                            <td><?php echo $student['mother_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_occupation'); ?></td>
                                            <td><?php echo $student['mother_occupation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_name'); ?></td>
                                            <td><?php echo $student['guardian_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_email'); ?></td>
                                            <td><?php echo $student['guardian_email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_relation'); ?></td>
                                            <td><?php echo $student['guardian_relation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_phone'); ?></td>
                                            <td><?php echo $student['guardian_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_occupation'); ?></td>
                                            <td><?php echo $student['guardian_occupation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_address'); ?></td>
                                            <td><?php echo $student['guardian_address']; ?></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                            <div class="tshadow mb25  bozero">    
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0">
                                        <tbody>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('previous_school_details'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['previous_school']; ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('national_identification_no'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['adhar_no']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('local_identification_no'); ?></td>
                                                <td><?php echo $student['samagra_id']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('bank_account_no'); ?></td>
                                                <td><?php echo $student['bank_account_no']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('bank_name'); ?></td>
                                                <td><?php echo $student['bank_name']; ?></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                        </div>
                        <div class="tab-pane" id="fee">
                           <div class="table-responsive">    
<table class="table table-striped table-bordered table-hover example">
<thead>

<tr>
<th>No</th>
<th><?php echo $this->lang->line('class'); ?></th>
<th>Collected BY</th>
<th style="text-align:right !important"> Amount</th>
<th style="text-align:right !important"> Received</th>
<th style="text-align:right !important"> Payment For</th>
<th style="text-align:right !important">Collected Date</th>
<th class="text-right"><?php echo $this->lang->line('action'); ?></th>

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
<td><?php   echo $count; ?></td>
<td><?php echo $stufee->class; ?> ( <?php echo $stufee->section; ?> )</td>
<td><?php echo $stufee->authority; ?></td>
<td align="right"><?php echo number_format($stufee->total_amount);?></td>
<td align="right"><?php echo number_format($stufee->total_received);?></td>
<td align="right"><?php echo $stufee->payment_for;?></td>
<td align="right"><?php echo $stufee->fcdate; ?></td>
<td class="pull-right">
<?php 
if($stufee->status==1)
{
?>
<a  title="View Details" href="<?php echo base_url(); ?>studentfee/view/<?php echo $stufee->id?>/<?php echo $stufee->student_id?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<i class="fa fa-list"></i>
</a>
<a title="Print" target="_blank" href="<?php echo base_url(); ?>studentfee/printvoc/<?php echo $stufee->id?>/<?php echo $stufee->student_id?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<i class="fa fa-print"></i>
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

<table class="table example">
    <thead>
        <tr>
            <th>No</th>
            <th>Installment Plan</th>
            <th>Fees</th>
            <th>Pay Amount </th>
            <th>Balance</th>
            <th>Pay Date</th>
            <th>Action</th>
        </tr>
    </thead>  

    <tbody>    
        <?php
        $count = 1;
        $total=0;
        foreach ($install_list->result() as $list) {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $list->name; ?></td>
            <td><?php echo $list->fee; ?></td>
            <td><?php echo $list->pay_amount; ?></td>
            <td><?php echo $list->balance; ?></td>
            <td><?php echo $list->paydate; ?></td>
            
            <td> 
               <!-- <a href="<?php echo base_url(); ?>Installment/delete/studentfee_receive/<?php echo $list->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                    <i class="fa fa-remove"></i>
                </a>-->
            </td>
            
        </tr>
        
        <?php
        $count++;
        $total+=$list->pay_amount;
        }
        ?>
    </tbody>
     <tr>
        <td colspan="2"> </td> <th colspan="2" class="text-center"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Total Pay Amount :</th> 
        <th><?=$total?></th>
    </tr>


</table>

</div>    

                        </div>                       
                        
                        
                        
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                               <button type="button"  data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn"> <i class="fa fa-upload"></i>  <?php echo $this->lang->line('upload_documents'); ?></button>
 
                                 <h2 class="page-header"><?php //echo $this->lang->line('documents');       ?> <?php //echo $this->lang->line('list');       ?></h2> 
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('title'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('file'); ?> <?php echo $this->lang->line('name'); ?>
                                                </th>
                                                <th class="mailbox-date text-right">
                                                    <?php echo $this->lang->line('action'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <div class="row">                                     
                                            <tbody>
                                                <?php
                                                if (empty($student_doc)) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($student_doc as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['title']; ?></td>
                                                            <td><?php echo $value['doc']; ?></td>
                                                            <td class="mailbox-date pull-right">
                                                                <a href="<?php echo base_url(); ?>student/download/<?php echo $value['student_id'] . "/" . $value['doc']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>student/doc_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="fa fa-remove"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>    
                        
                        
                        <div class="tab-pane" id="pickup">
                            <div class="timeline-header no-border">
 <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#myPickup">
  <i class="fa fa-upload"></i> Add
</button>

<button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#pickupCard">
  <i class="fa fa-print"></i> Print
</button>
                                 <h2 class="page-header">Pickup Persons</h2> 
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Relation
                                                </th>
                                                
                                                  <th>
                                                    Phone
                                                    </th>
                                                    <th>
                                                    NRC NO
                                                    </th> <th>
                                                    Address
                                                    </th>                                               
                                                  <th>
                                                    Photo
                                                    </th>
                                                <th class="mailbox-date text-right">
                                                    <?php echo $this->lang->line('action'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <div class="row">                                     
                                            <tbody>
                                                <?php
                                                if (empty($pickups)) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($pickups as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['name']; ?></td>
                                                            <td><?php echo $value['relation']; ?></td>
                                                            <td><?php echo $value['phone']; ?></td>
                                                            <td><?php echo $value['nrcno']; ?></td>
                                                            <td><?php echo $value['address']; ?></td>
                                                            <td><img src="<?=base_url()?>uploads/pickup_persons/<?=$value["student_id"]?>/<?php echo $value['pickuphoto']; ?>"/></td>
                                                            <td class="mailbox-date pull-right">
                                                                <a href="<?php echo base_url(); ?>student/download/<?php echo $value['student_id'] . "/" . $value['pickuphoto']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>student/pickup_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="fa fa-remove"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>    


  <div class="tab-pane" id="exam">
                            <div class=""> 
                                <?php
                                if (empty($examSchedule)) {
                                    ?>
                                    <div class="alert alert-danger">
                                        No Exam Found.
                                    </div>
                                    <?php
                                } else {
                                    foreach ($examSchedule as $key => $value) {
                                        ?>
                                        <h4 class="pagetitleh"><?php echo $value['exam_name']; ?></h4>
                                        <?php
                                        if (empty($value['exam_result'])) {
                                            ?>
                                            <div class="alert alert-info"><?php echo $this->lang->line('no_result_prepare'); ?></div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="table-responsive borgray around10">  
                                                <div class="download_label"><?php echo $this->lang->line('exam_marks_report'); ?></div>
                                                <table class="table table-striped table-bordered table-hover example">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <?php echo $this->lang->line('subject'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('full_marks'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('passing_marks'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('obtain_marks'); ?>
                                                            </th>
                                                            <th class="text text-right">
                                                                <?php echo $this->lang->line('result'); ?>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $obtain_marks = 0;
                                                        $total_marks = 0;
                                                        $result = "Pass";
                                                        $exam_results_array = $value['exam_result'];

                                                        $s = 0;
                                                        foreach ($exam_results_array as $result_k => $result_v) {
                                                            $total_marks = $total_marks + $result_v['full_marks'];
                                                            ?>
                                                            <tr>
                                                                <td>  <?php
                                                                    echo $result_v['exam_name'] . " (" . substr($result_v['exam_type'], 0, 2) . ".) ";
                                                                    ?></td>
                                                                <td><?php echo $result_v['full_marks']; ?></td>
                                                                <td><?php echo $result_v['passing_marks']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($result_v['attendence'] == "pre") {
                                                                        echo $get_marks_student = $result_v['get_marks'];
                                                                        $passing_marks_student = $result_v['passing_marks'];
                                                                        if ($result == "Pass") {
                                                                            if ($get_marks_student < $passing_marks_student) {
                                                                                $result = "Fail";
                                                                            }
                                                                        }
                                                                        $obtain_marks = (int) $obtain_marks + (int) $result_v['get_marks'];
                                                                    } else {
                                                                        $result = "Fail";
                                                                        echo ($result_v['attendence']);
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="text text-center">
                                                                    <?php
                                                                    if ($result_v['attendence'] == "pre") {
                                                                        $passing_marks_student = $result_v['passing_marks'];

                                                                        if ($get_marks_student < $passing_marks_student) {
                                                                            echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                        } else {
                                                                            echo "<span class='label pull-right bg-green'>Pass</span>";
                                                                        }
                                                                    } else {
                                                                        echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                        $s++;
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if ($s == count($exam_results_array)) {
                                                                $obtain_marks = 0;
                                                            }
                                                        }
                                                        ?>
                                                        <tr class="hide">
                                                            <td><?php echo $this->lang->line('exam').": ".$value['exam_name']; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($result == "Pass") {
                                                                    ?>
                                                                    <b class='text text-success'><?php echo $this->lang->line('result') .": ". $result; ?></b>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <b class='text text-danger'><?php echo $this->lang->line('result') .": ". $result; ?></b>
                                                                    <?php
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                echo $this->lang->line('grand_total') . ": " . $obtain_marks . "/" . $total_marks;
                                                                ;
                                                                ?></td>
                                                            <td><?php
                                                                $foo = ($obtain_marks * 100) / $total_marks;
                                                                echo $this->lang->line('percentage') .": ". number_format((float) $foo, 2, '.', '');
                                                                ?></td>
                                                            <td><?php
                                                                if (!empty($gradeList)) {
                                                                    foreach ($gradeList as $key => $value) {
                                                                        if ($foo >= $value['mark_from'] && $foo <= $value['mark_upto']) {
                                                                            ?>
                                                                            <?php echo $this->lang->line('grade') . " : " . $value['name']; ?>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                ?></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12" style="margin-bottom: 10px">
                                                    <div class="bgtgray">
                                                        <?php
                                                        $foo = "";
                                                        ?>    

                                                        <div class="col-sm-3 col-xs-6">
                                                            <div class="description-block">
                                                                <h5 class="description-header"><?php echo $this->lang->line('result'); ?>:
                                                                    <span class="description-text">
                                                                        <?php
                                                                        if ($result == "Pass") {
                                                                            ?>
                                                                            <b class='text text-success'><?php echo $result; ?></b>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <b class='text text-danger'><?php echo $result; ?></b>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </h5>
                                                            </div>                                             
                                                        </div>                                     
                                                        <div class="col-sm-3 col-xs-6">
                                                            <div class="description-block">
                                                                <h5 class="description-header"><?php echo $this->lang->line('grand_total'); ?>:
                                                                    <span class="description-text"><?php echo $obtain_marks . "/" . $total_marks; ?></span>

                                                                </h5>
                                                            </div>                                               
                                                        </div> 
                                                        <div class="col-sm-3 col-xs-6">
                                                            <div class="description-block">
                                                                <h5 class="description-header"><?php echo $this->lang->line('percentage'); ?>:
                                                                    <span class="description-text"><?php
                                                                        $foo = ($obtain_marks * 100) / $total_marks;
                                                                        echo number_format((float) $foo, 2, '.', '');
                                                                        ?>
                                                                    </span>
                                                                </h5>
                                                            </div>                                           
                                                        </div>                                          

                                                        <div class="col-sm-3 col-xs-6">
                                                            <div class="description-block">
                                                                <h5 class="description-header">
                                                                    <span class="description-text"><?php
                                                                        if (!empty($gradeList)) {
                                                                            foreach ($gradeList as $key => $value) {
                                                                                if ($foo >= $value['mark_from'] && $foo <= $value['mark_upto']) {
                                                                                    ?>
                                                                                    <?php echo $this->lang->line('grade') . ": " . $value['name']; ?>
                                                                                    <?php
                                                                                    break;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?></span>
                                                                </h5>
                                                            </div>                                               
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>                      
                        </div>



                        <div class="tab-pane" id="fee">
                           <div class="table-responsive">    
<table class="table table-striped table-bordered table-hover example">
<thead>

<tr>
<th>No</th>
<th><?php echo $this->lang->line('class'); ?></th>
<th>Collected BY</th>
<th style="text-align:right !important"> Amount</th>
<th style="text-align:right !important"> Received</th>
<th style="text-align:right !important">Collected Date</th>
<th class="text-right"><?php echo $this->lang->line('action'); ?></th>

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
<td><?php   echo $count; ?></td>
<td><?php echo $stufee->class; ?> ( <?php echo $stufee->section; ?> )</td>
<td><?php echo $stufee->authority; ?></td>
<td align="right"><?php echo number_format($stufee->total_amount);?></td>
<td align="right"><?php echo number_format($stufee->total_received);?></td>
<td align="right"><?php echo $stufee->fcdate; ?></td>
<td class="pull-right">
<?php 
if($stufee->status==1)
{
?>
<a  title="View Details" href="<?php echo base_url(); ?>studentfee/view/<?php echo $stufee->id?>/<?php echo $stufee->student_id?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<i class="fa fa-list"></i>
</a>
<a title="Print" target="_blank" href="<?php echo base_url(); ?>studentfee/printvoc/<?php echo $stufee->id?>/<?php echo $stufee->student_id?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
<i class="fa fa-print"></i>
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

                        </div>
                        
                        <!--Report card area-->
                       
                        <div class="tab-pane" id="attendance">

                           <div class="table-responsive calendar">    


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
        background-color: #FFEB00;
    }
    .grade-4 {
        background-color: #FA8A00;
    }
    .grade-5 {
        background-color: #a7a7a7;
    }
</style>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <?php echo $leaveuser->total; ?>
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
                        <td><?=@round(($list->totalpresent/ $attcal[$list->month])*100)?></td>
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
                        <th><?=@round(($tp/ array_sum($attcal))*100)?></th>
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
    var student_session_id='<?php echo $student['student_session_id']; ?>';
    $("#my-calendar").zabuto_calendar({
    legend: [
    {type: "block", label: "<?php echo $this->lang->line('absent') ?>", classname: 'grade-1'},
    {type: "block", label: "<?php echo $this->lang->line('leave') ?>", classname: 'grade-4'},
    {type: "block", label: "<?php echo $this->lang->line('late') ?>", classname: 'grade-3'},
    {type: "block", label: "<?php echo $this->lang->line('holiday') ?>", classname: 'grade-5'},
    ],
    ajax: {
    url: base_url+"Student/getAjaxAttendence?grade=1&student_session="+student_session_id,
    }
    });
    });
</script>



                        
                        <!--Report Card Area end-->


                         <div class="tab-pane" id="reportcard">

                           <div class="table-responsive">    



                            </div>    


                   
                        </div>
                        

                        
                        
                        </div>
                        
                        
                        
                        
                          <div class="tab-pane" id="troute">



 
       <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('route_title'); ?>
                                                </th>

                                                <th class=""><?php echo $this->lang->line('vehicle'); ?>
                                                </th>
                                                <th class="">Driver's Name
                                                </th>
                                                <th>Driver's Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $sturoute->route_title; ?></td>
                                                <td><a href="#">
                                                                <i class="fa fa-bus"></i>&nbsp;&nbsp;<?php echo $sturoute->vehicle_no; ?></a></td>
                                                <td><?php echo $sturoute->driver_name; ?></td>
                                                <td><?php echo $sturoute->driver_contact; ?></td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>


 </div>
                        
                </div>
                
                
                <!--transport route-->
                      

<!--end -->
                
            </div><!--end tab content-->
    </section>
</div>


<script type="text/javascript">
    $(".myTransportFeeBtn").click(function () {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b>Upload Document</b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });
</script>
<div class="modal fade" id="myTransportFeesModal" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="form-horizontal">
                    <div class="">
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                        <form id="form1" action="<?php echo site_url('student/create_doc') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php echo $this->customlib->getCSRF(); ?>
                            <div id='upload_documents_hide_show'>                                                    
                                <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label>
                                                <input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
                                                <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('Documents'); ?></label>
                                                <div class="mml15" style="margin-top:5px; border:0; outline:none;"><input id="first_doc_id" name="first_doc" placeholder="" type="file"  class="filestyle form-control"  value="<?php echo set_value('first_doc'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('first_doc'); ?></span></div>
                                            </div>
                                        </div>
                                    </div></div>
                            </div>
                            <div class="modal-footer" style="clear:both">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="pickupCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" align='center'>ကျောင်းကြိုခွင့် ကဒ်ပြား</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
            <div class="col-sm-6 cardphoto" align="center">
                <img src="<?=base_url()?><?=$student['image']?>" class="profile" width="30%"/>
             <p><?php echo $student['admission_no']?></p>
              <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.4&&ms=r&md=0.8" class="barcode"/>
            </div>
        <div class="col-sm-6">
            <div class="center_middle_card">
                <p><?php   echo $student['firstname']." ".$student['lastname']?></p>
                <!--<div class="grade">-->
                    <p><?php echo $student['class'] . " (" . $student['section'] . ")"?></p>
                <!--</div>-->
                <p><?php echo $student['father_name']?></p>
                <p><?php echo $student['guardian_address']?></p>
                <p><?php echo $student['guardian_phone']?></p>
            </div>
        </div>
     
        </div>
             <div class="row">

                     <?php foreach($pickups as $value):
                         ?>
                  <div class="col-md-4">  
                  <img src="<?=base_url()?>uploads/pickup_persons/<?=$value["student_id"]?>/<?php echo $value['pickuphoto']; ?>" align="left" class="thumbnail"/>
                    <p><?php echo $value['name']; ?></p>
                    <?php echo $value['relation']; ?>
                   <p> <?php echo $value['phone']; ?></p>
                     </div>                                   
                     <?php endforeach;?>               
            </div>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="myPickup" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title">Upload Pickup Persons</h4>
            </div>
            <div class="">
                <div class="form-horizontal">
                    <div class="">
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                        <form id="form1" action="<?php echo site_url('student/create_pickup') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php echo $this->customlib->getCSRF(); ?>
                            <div id='upload_documents_hide_show'>                                                    
                                <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Relation</label>
                                                <input id="relation" name="relation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('relation'); ?>" />
                                                <span class="text-danger"><?php echo form_error('relation'); ?></span>
                                            </div>
                                        </div>
                                        
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone</label>
                                                <input id="phone" name="phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('phone'); ?>" />
                                                <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                            </div>
                                        </div>
                            
                             <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NRC No</label>
                                                <input id="nrcno" name="nrcno" placeholder="" type="text" class="form-control"  value="<?php echo set_value('nrcno'); ?>" />
                                                <span class="text-danger"><?php echo form_error('nrcno'); ?></span>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Address</label>
                                                <input id="address" name="address" placeholder="" type="text" class="form-control"  value="<?php echo set_value('address'); ?>" />
                                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                                            </div>
                                        </div>                                
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Photo</label>
                                                <div class="mml15" style="margin-top:5px; border:0; outline:none;"><input id="pickuphoto" name="pickuphoto" placeholder="" type="file"  class="filestyle form-control"  value="<?php echo set_value('first_doc'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('pickuphoto'); ?></span></div>
                                            </div>
                                        </div>
                                    </div></div>
                            </div>
                            <div class="modal-footer" style="clear:both">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>



<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title_logindetail"></h4>
            </div>
            <div class="modal-body_logindetail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });

    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title_logindetail').html("");
        $('.modal-title_logindetail').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student["id"] ?>';
        var student_first_name = '<?php echo $student["firstname"] ?>';
        var student_last_name = '<?php echo $student["lastname"] ?>';
        $.ajax({
            type: "post",
            url: base_url + "student/getlogindetail",
            data: {'student_id': student_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="col-md-12">';
                data += '<div class="table-responsive">';
                data += '<p class="lead text text-center">' + student_first_name + ' ' + student_last_name + '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    data += '<tr>';
                    data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
                    data += '<td class="text text-center">' + obj.username + '</td> ';
                    data += '<td class="text text-center">' + obj.password + '</td> ';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';
                data += '</div>  ';
                $('.modal-body_logindetail').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }
</script>
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


