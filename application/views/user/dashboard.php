<style type="text/css">

    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    .option_grade{
        display: none;
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">   
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('my_profile'); ?> <small><?php echo $this->lang->line('student1'); ?></small>        </h1>
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
                        <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped">
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
                                </div></div> 
                            <div class="tshadow mb25 bozero">   
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address'); ?> <?php echo $this->lang->line('detail'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped"><tbody>
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
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped">
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
                                    <table class="table table-hover table-striped">
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
                                            <tr>
                                                <td><?php echo $this->lang->line('ifsc_code'); ?></td>
                                                <td><?php echo $student['ifsc_code']; ?></td>
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
<a  title="View Details" href="<?php echo base_url(); ?>user/user/feedetail/<?php echo $stufee->id?>/<?php echo $stufee->student_id?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
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

                        </div>                        
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                                <button type="button"  data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn mb10"> <i class="fa fa-upload"></i>  <?php echo $this->lang->line('upload_documents'); ?></button>

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

                                        <tbody>
                                            <?php
                                            if (empty($student_doc)) {
                                                ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                </tr>
                                            </tfoot>
                                            <?php
                                        } else {
                                            foreach ($student_doc as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['title']; ?></td>
                                                    <td><?php echo $value['doc']; ?></td>
                                                    <td class="mailbox-date text-right">
                                                        <a href="<?php echo base_url(); ?>user/user/download/<?php echo $value['student_id'] . "/" . $value['doc']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                            <i class="fa fa-download"></i>
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
                            </table>
                        </div>                        
                        <div class="tab-pane" id="exam">
                            <div class="tshadow mb25"> 
                                <?php
                                if (empty($examSchedule)) {
                                    ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->lang->line('no_record_found'); ?>
                                    </div>
                                    <?php
                                } else {
                                    $counter = 1;
                                    foreach ($examSchedule as $key => $value) {
                                        ?>
                                        <div id="<?php echo 'print_view' . $counter ?>">
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
                                                    <table class="table table-striped table-hover tmb0 example">
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
                                                                            $obtain_marks = $obtain_marks + $result_v['get_marks'];
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
                                                                                echo "<span class='label pull-right bg-green'>" . $this->lang->line('pass') . "</span>";
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
                                                        <div class="bgtgray mb0">
                                                            <?php
                                                            $foo = "";
                                                            ?>                                               <div class="col-md-12 option_grade">
                                                                <div class="description-header"><?php echo $this->lang->line('grand_total'); ?>:
                                                                    <span class="description-text"><?php echo $obtain_marks . "/" . $total_marks; ?></span>
                                                                </div>
                                                                <div class="description-header"><?php echo $this->lang->line('percentage'); ?>:
                                                                    <span class="description-text"><?php
                                                                        $foo = ($obtain_marks * 100) / $total_marks;
                                                                        echo number_format((float) $foo, 2, '.', '');
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                <div class="description-header"><?php echo $this->lang->line('result'); ?>:
                                                                    <span class="description-text">
                                                                        <?php
                                                                        if ($result == "Pass") {
                                                                            ?>
                                                                            <b><?php echo $result; ?></b>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <b><?php echo $result; ?></b>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                <div class="description-header">
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
                                                                </div>

                                                            </div> 
                                                            <div class="col-sm-3 pull no-print">
                                                                <div class="description-block">
                                                                    <h5 class="description-header"><?php echo $this->lang->line('result'); ?>:
                                                                        <span class="description-text">
                                                                            <?php
                                                                            if ($result == "Pass") {
                                                                                ?>
                                                                                <span class='label bg-green'><?php echo $result; ?></span>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <span class='label bg-red'><?php echo $result; ?></span>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </h5>
                                                                </div>                                                   
                                                            </div>
                                                            <div class="col-sm-3 border-right no-print">
                                                                <div class="description-block">
                                                                    <h5 class="description-header"><?php echo $this->lang->line('grand_total'); ?>:
                                                                        <span class="description-text"><?php echo $obtain_marks . "/" . $total_marks; ?></span>
                                                                    </h5>
                                                                </div>                                                   
                                                            </div>
                                                            <div class="col-sm-3 border-right no-print">
                                                                <div class="description-block">
                                                                    <h5 class="description-header"><?php echo $this->lang->line('percentage'); ?>:
                                                                        <span class="description-text"><?php
                                                                            $foo = ($obtain_marks * 100) / $total_marks;
                                                                            echo number_format((float) $foo, 2, '.', '') . '%';
                                                                            ?>
                                                                        </span>
                                                                    </h5>
                                                                </div>                                                   
                                                            </div>                                                

                                                            <div class="col-sm-3 border-right no-print">
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
                                                        </div></div></div>
                                            <?php }
                                            ?>
                                        </div>
                                        <?php
                                        $counter++;
                                    }
                                }
                                ?>
                            </div>  
                        </div>                        
                    </div>
                </div>
            </div>
    </section> 
</div>

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
                                            <div class="mml15" style="margin-top:5px; border:0; outline:none;">
                                                <input id="first_doc_id" name="first_doc" placeholder="" type="file" class="filestyle form-control"  value="<?php echo set_value('first_doc'); ?>" />
                                                <span class="text-danger"><?php echo form_error('first_doc'); ?></span></div>
                                        </div>
                                    </div>
                                </div>
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

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>
<script type="text/javascript">
   $(document).ready(function () {
    $.extend( $.fn.dataTable.defaults, {
    searching: false,
    ordering:  false,
    paging: false,
    bSort: false,
    info: false
   });
    });

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

    $(document).ready(function () {
        $('table.display').DataTable();
    });


</script>


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
