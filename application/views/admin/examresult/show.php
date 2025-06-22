<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam Result</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
<style>
    .result-header h3{
        text-align:center;
    }
    .result-header p{
        float:right;
    }
    .header-bd span{
        border-bottom:1px dotted #000;
        color:#000 !important;
    }
    .header-bd p{
        color:#008000 !important;
    }
    .result-body tr, .result-body thead th, .result-body td{
        border: thin solid #008000;
        color: #008000;
        vertical-align: middle;
        margin: 0px;
    }
    .result-body table thead th, .result-body table td {
    padding: 5px;
    white-space: nowrap !important;
}
.result-body table{
    width:100%;
}
</style>

</head>

<body>
   <div class="row result-header">
 <!--       <div class="col-sm-12 right">
           <a href="<?php echo base_url(); ?>admin/Examresult/print_resultshow/<?php echo $location->id; ?>">Print</a>
       </div> -->
       <div class="col-sm-12">
                                           <h3>
                    <img style="height:80px; " src="<?php echo base_url(); ?>uploads/school_content/logo/<?php echo $location->logo; ?>">
 </h3>
            <h3> <?=$location->sch_name?></h3>
<!--အမွတ္(၁/၆)၊ သာစည္လမ္း၊ ခ်မ္းၿမသာစည္ရပ္ကြက္၊ မံုရြာၿမိဳ႕။</br/>-->
<!--ဖုန္း-၀၇၁ ၂၆၂၆၂၉၊ ၀၇၁ ၂၄၈၂၁၊ ၀၉ ၂၅၇၈၄၇၇၇၁၊ ၀၉ ၂၅၇၈၄၇၇၇၂-->
          
       </div>
       <div class="col-sm-12 header-bd">
           <p>
               <span><?php echo $location->division; ?></span>   တိုင္းေဒသၾကီး/ၿပည္နယ္<br/>
                <span><?php echo $location->district; ?></span>  ခရိုင္<br/>
                <span><?php echo $location->township; ?></span>  ၿမိဳ႕နယ္<br/>
                <span><?php echo $location->sch_name; ?></span>  ေက်ာင္း
           </p>
       </div>

   </div>
   <div class="row result-body">
       <p><?php echo $location->year; ?> ပညာသင္ႏွစ္ (သင္ရိုးသစ္) ၊<?php echo $studata->clss; ?>   ေအာင္စာရင္း  </p>
       <table class="table table-striped table-bordered table-hover example" cellspacing="0">
           <thead>
               <tr>
                   <th>စဥ္</th>
                   <th>ခံုအမွတ္</th>
                   <th>ေက်ာင္း၀င္အမွတ္</th>
                   <th>အမည္</th>
                   <th>အဘအမည္</th>
                   <th>မွတ္ခ်က္</th>
               </tr>
           </thead>
           <tbody>
               <?php 
               $no=1;
               foreach($examresult->result() as $row): ?>
               <tr>
                   <td><?php echo $no; ?></td>
                   <td><?php echo $row->seat_no; ?></td>
                   <td><?php echo $row->admission_no; ?></td>
                   <td><?php echo $row->firstname.$row->lastname; ?></td>
                   <td><?php echo $row->father_name; ?></td>
                   <td><?php echo $row->remark; ?></td>
               </tr>
              <?php 
					$no++;
					endforeach; ?>
           </tbody>
       </table>
   </div>
   <div class="row result-footer">
       <p>အတန္းပိုင္ဆရာ လက္မွတ္ .......................</p>
       <p>အမည္   .......................</p>
       <p>ရာထူး   .......................</p>
   </div>
    
</body>
</html>