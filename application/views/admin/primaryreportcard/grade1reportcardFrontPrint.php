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
.bottomline{
    border-top: none;
border-left: none;
border-right: none;
border-bottom: 1px dotted green;
width:30%;
}
</style>

</head>

<body>
    <h3 style="text-align:center;"><?php echo $this->setting_model->getCurrentSessionName(); ?>    ပညာသင္ႏွစ္</h3>
    <h3 style="text-align:center;">....................အေၿခခံပညာ၊ .................... ေက်ာင္း၊.................... ၿမိဳ႕နယ္၊ .................... တိုင္းေဒသၾကီး/ၿပည္နယ္္  </h3>
    <h3 style="text-align:center;">စစ္ေဆး အကဲၿဖတ္မွတ္တမ္း (စာသင္ခန္းအတြင္း)</h3>
    <div class="col-sm-12">
        <div class="col-sm-4">
            <p>အမည္ - <?=$student["firstname"].$student["lastname"]?></p>
        </div>
        <div class="col-sm-4">
            <p>အဘအမည္ - <?=$student["father_name"]?></p>
        </div>
        <div class="col-sm-4">
            <p>အတန္း - <?=$student["class"]?> </span></p>
        </div>
    </div>
    
    <div id="kgreportcard">
    <table class="table table-striped table-bordered table-hover example" cellspacing="0">
    
        <tr>
            <th rowspan="2">စဥ္</th>
            <th rowspan="2" style="width:5% !important;">လ</th>
            <!--<th rowspan="2">အၾကိမ္</th>-->
            <?php
            foreach($subject->result() as $sub):?>
                <th colspan="3"><?php echo $sub->name; ?></th>
                
            <?php endforeach; ?>
            <th>မွတ္ခ်က္</th>
            <!--<th>ေက်ာင္းအုပ္ၾကီး လက္မွတ္</th>-->
        </tr>
        <tr>
            <?php 
            for($i=1;$i<=$subject->num_rows();$i++){ ?>
                <th>A</th>
                <th>B</th>
                <th>C</th>
            <?php }
            ?>
            <td></td>
            <!--<td></td>-->
        </tr>
        <?php 
        $m=1;
        foreach($month->result() as $row):?>
        <tr>
            <td><?php echo $m; ?></td>
            <td><?php echo $row->name; ?></td>
            <!--<td>ပ</td>-->
            <?php 
            foreach($subject->result() as $sub){ ?>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        
                    ?>
                    <?php if($pr->reportcard_month==$row->id && $pr->grade=='1' && $pr->subject_id==$sub->id)
                        { 
                          echo '√';
                        }
                    }
                    ?>   
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='2' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
                <td>
                    <?php
                    foreach($primary_result->result() as $pr){
                        if($pr->reportcard_month==$row->id && $pr->grade=='3' && $pr->subject_id==$sub->id)
                        { 
                           echo '√';
                        }
                    }
                    ?> 
                </td>
            <?php }
            ?>
            <td></td>
            
        </tr>
        
        
        <?php 
        $m++; 
        endforeach; ?>
        
        
        <!--table header-->
        
    </table>
    <div class="col-sm-12">
        <div class="col-sm-3">
            <p>မိဘလက္မွတ္ .................</p>
            <p>အမည္ - <?=$student["father_name"]?></p>
        </div>
        <div class="col-sm-3">
            <p>မိဘလက္မွတ္ .................</p>
            <p>အမည္ - <?=$student["mother_name"]?></p>
        </div>
        <div class="col-sm-3">
            <p>လက္မွတ္ .................  </p>
            <p>အတန္းပိုင္.................. </p>
        </div>
        <div class="col-sm-3">
            <p>လက္မွတ္ .................  </p>
            <p>ေက်ာင္းအုပ္ ................. </p>
        </div>
    </div>
    
    
    </div>
</body>
</html>