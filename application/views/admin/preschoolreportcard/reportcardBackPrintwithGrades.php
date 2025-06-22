<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Report Card</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">

</head>

<body>

<div class="col-sm-12" align="right"> 
<?=anchor("admin/Reportcard/rpcardsfront/".$student["id"],"&laquo; Front Report","class='btn active pull-right'");?>
<?=anchor("admin/Reportcard/rpcardsback/".$student["id"],"&laquo; Marks","class='btn active pull-right'");?>

<span onclick="window.print()" class="btn btn-success"><img src="<?=base_url()?>backend/images/p.png"/> Print</span>
</div>
<div class="tab-pane" id="reportcard">


                           <div class="table-responsive">    
<table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
<thead>

<tr>

<td colspan="13" align="center"><h3><?=$settinglist->backtitle?></h3></td>
</tr>

<tr>

<td colspan="13" align="center"><h3><?=$settinglist->backtitle2?></h3></td>
</tr>

   
 <tr>
 <td align="center">လအမည္</td>
<?php

///$titlearr=array("လအမည္","ျမန္မာစာ","အဂၤလိပ္စာ","သခၤ်ာ","အေထြေထြ သိပၸံဘာသာ","လူမႈေရးဘာသာ","ပထ၀ီဘာသာ","သမိုင္းဘာသာ","စုစုေပါင္း","အဆင့္","ေက်ာင္းေခၚၾကိမ္","အတန္းပိုင္ လက္မွတ္ႏွင့္ ေန႕စြဲ","မိဘအုပ္ထိန္းသူ လက္မွတ္ႏွင့္ ေန႕စြဲ","ေက်ာင္းအုပ္ၾကီး လက္မွတ္ႏွင့္ ေန႕စြဲ");
$numberarr=array("၁","၂","၃","၄","၅","၆","၇","၈","၉","၁၀","၁၁","၁၂","၁၃");
$count = 1;
$totalamt=0;
$totalrec=0;


//for($j=0;$j<count($titlearr);$j++)
//{
	
foreach($school_activity->result() as $activity):
?>

<td align="center"><?php echo $activity->name; ?></td>


<?php
//}

endforeach;

?>
<td align="center">အတန္းပိုင္ လက္မွတ္ႏွင့္ ေန႕စြဲ</td>
<td align="center">မိဘအုပ္ထိန္းသူ လက္မွတ္ႏွင့္ ေန႕စြဲ</td>
<td align="center">ေက်ာင္းအုပ္ၾကီး လက္မွတ္ႏွင့္ ေန႕စြဲ
</td>
</tr>

<tr>
<?php
for($j=0;$j<count($numberarr);$j++)
{
    ?>
    
    <td align="center"><?php echo $numberarr[$j]; ?></td>

    <?php
}
?>


</tr>
</thead>            
<tbody> 
<?php
 $m=date("n");
 
 //$no=$rpcards->num_rows();
 foreach($reportcard_month->result() as $e):

	if($e->sesion_id==$m)
	{
		
		$cl="class='current'";
	}
	
	else{$cl="";}
	
    ?>
    <tr <?=$cl?>>
<td><?php   echo $e->name; ?></td>
<?php 
$student_id=$this->uri->segment(4);

$rpcards=$this->Reportcard_model->rpback($student_id,$e->id);


 $r=$rpcards->row();

 ?>
<td align="center"><?php    if($r->act_1==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_1/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>
<td align="center"><?php    if($r->act_2==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_2/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>
<td align="center"><?php    if($r->act_3==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_3/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>
<td align="center"><?php    if($r->act_4==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_4/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>
<td align="center"><?php    if($r->act_5==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_5/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>
<td align="center"><?php    if($r->act_6==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_6/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>
<td align="center"><?php    if($r->act_7==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_7/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>

<td align="center"><?php    if($r->act_8==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_8/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>

<td align="center"><?php    if($r->act_9==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->act_9/100)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}

echo $mg?></td>



    <td></td>
    <td></td>
    <td></td> 

</tr>
    
    <?php
    
endforeach;

?>
<tr>
<td>စုစုေပါင္းရမွတ္</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

</tr>

<tr>
<td><span>ပ်မ္းမွရမွတ္</span> <br/><span style='float:right'>အဆင့္</span></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

</tr>


</tbody>



</table>

</div>    

<br /><br />

                        <div class="container"> 
                                <div class="col-sm-6 signature"> 
                                        အတန္းပိုင္ဆရာ၏မွတ္ခ်က္။ ---------------------
                                        <br/>
                                        အတန္းပိုင္ဆရာ၏လက္မွတ္။ ---------------------
                                 </div>
                                <div class="col-sm-6 signature">  
ေက်ာင္းအုပ္ၾကီးမွတ္ခ်က္။ ---------------------
<br/>
ေက်ာင္းအုပ္ၾကီးလက္မွတ္။---------------------

                                </div>


                        </div>  

                        </div>
</body>
</html>