<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Primary Student Report Card</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
<style>
.kgreportcard p,td{
    font-size:12px;
    text-align:center;
}
#reportcard .col-sm-6{
   -webkit-box-flex:0;
   -ms-flex:0 0 50% !important;
   flex:0 0 50%;
   max-width:50%;
}
.toppadding_md{
    padding-bottom: 30px; 
}
.kgreportcard h3{
    margin-top: 0px !important;
}
#kgreportcard tr,#kgreportcard th,#kgreportcard td{
    border: thin solid green;
    color: green;
    vertical-align: middle;
    margin: 0;
}
#kgreportcard table th,#kgreportcard table td{
    padding:5px;
    white-space: nowrap !important;
}
</style>

</head>

<body>
    <h3 style="text-align:center;padding-top:30px;"> စစ္ေဆးအကဲၿဖတ္အမွတ္ေပးစံဇယား</h3>
    <p>အမည္ - <?=$student["firstname"].$student["lastname"]?>
        <span style="margin-left:50px;">ေမြးသကၠရာဇ္ - <?=$student["dob"]?> </span>
        <span style="margin-left:50px;">ေက်ာင္း၀င္အမွတ္ - <?=$student[admission_no]?> </span>
        <span style="margin-left:50px;">အဘအမည္ - <?=$student["father_name"]?> </span>
        <span style="margin-left:50px;">အတန္း - <?=$student["roll_no"]?> </span>
    </p>
    <div id="kgreportcard">
    <table class="table table-striped table-bordered table-hover example" cellspacing="0">
        <tr>
            <th rowspan="2">စဥ္</th>
            <th rowspan="2" style="width:5% !important;">လ</th>
            <th rowspan="2">အၾကိမ္</th>
            <?php
            foreach($subject->result() as $sub):?>
                <th colspan="3"><?php echo $sub->name; ?></th>
                
            <?php endforeach; ?>
            <th>အတန္းပိုင္လက္မွတ္</th>
            <th>ေက်ာင္းအုပ္ၾကီး လက္မွတ္</th>
        </tr>
        <tr>
            <?php 
            for($i=1;$i<=$subject->num_rows();$i++){ ?>
                <th>ေကာင္း</th>
                <th>သင့္</th>
                <th>ၾကိဳးစားရန္</th>
            <?php }
            ?>
            <td></td>
            <td></td>
        </tr>
        <?php 
        $m=1;
        foreach($month->result() as $row):?>
        <tr>
            <td rowspan="4"><?php echo $m; ?></td>
            <td rowspan="4"><?php echo $row->name; ?></td>
            <td>ပ</td>
            <?php 
            foreach($subject->result() as $sub){ ?>
                <td>
                    <?php
                    // echo $primary_result->grade;echo "<br/>";
                    // echo $primary_result->exam_time;echo "<br/>";
                    // echo $primary_result->subject_id;echo "<br/>";
                     
                    foreach($primary_result->result() as $pr){
                        // echo $pr->subject_id;echo "=";
                        // echo $sub->id;echo "<br/>";
                        
                    ?>
                    <?php if($pr->reportcard_month==$row->id && $pr->grade=='1' && $pr->exam_time =='1' && $pr->subject_id==$sub->id)
                        { 
                          echo '√';
                        }
                    }
                    ?>   
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='2' && $pr->exam_time =='1' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='3' && $pr->exam_time =='1' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
            <?php }
            ?>
            <td></td>
            <td></td>
        </tr>
        <tr>
            
            <td>ဒု</td>
            <?php 
            foreach($subject->result() as $sub){ ?>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='1' && $pr->exam_time =='2' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?>   
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='2' && $pr->exam_time =='2' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='3' && $pr->exam_time =='2' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
            <?php }
            ?>
            <td></td>
            <td></td>
        </tr>
        <tr>
            
            <td>တ</td>
            <?php 
            foreach($subject->result() as $sub){ ?>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='1' && $pr->exam_time =='3' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?>   
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='2' && $pr->exam_time =='3' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
                <td>
                    <?php
                     foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='3' && $pr->exam_time =='3' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                     }
                    ?> 
                </td>
            <?php }
            ?>
            <td></td>
            <td></td>
        </tr>
        <tr>
            
            <td>စ</td>
            <?php 
            foreach($subject->result() as $sub){ ?>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='1' && $pr->exam_time =='4' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?>   
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='2' && $pr->exam_time =='4' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='3' && $pr->exam_time =='4' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
            <?php }
            ?>
            <td></td>
            <td></td>
        </tr>
        
        <?php 
        $m++; 
        endforeach; ?>
        
        
        <!--table header-->
        
    </table>
    </div>
</body>
</html>