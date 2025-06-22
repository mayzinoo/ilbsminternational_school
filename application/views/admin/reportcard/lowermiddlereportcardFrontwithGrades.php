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
<?=anchor("admin/LowerMiddle_Reportcard/rpcardsback/".$student["id"],"&laquo; Back Report","class='btn active'");?>
<?=anchor("admin/LowerMiddle_Reportcard/rpcardsfront/".$student["id"],"&laquo; Marks","class='btn active pull-right'");?>
<span onclick="window.print()" class="btn btn-success"><img src="<?=base_url()?>backend/images/p.png"/> Print</span>
</div>





<div class="row header">
                            <div class="col-sm-1">                               
                         <img src="<?php echo base_url(); ?>uploads/school_content/logo/<?php echo $settinglist->left_logo; ?>" width="110%">                                 
                            </div>
                            <div class="col-sm-7  lower">
                                <strong class="title"><?php echo $settinglist->address; ?></strong>


                                <strong class="sectitle"><?php echo $settinglist->title; ?> လယ္ ဆင့္ </strong>
                              

                            </div><!--/col-->
                            <div class="col-sm-2 allowno">
                            <div>ပညာေရး၀န္ၾကီးဌာန၏ <br />

ခြင့္ျပဳမိန္႕အမွတ္</div>

                             <span> <?php echo $settinglist->allow_no; ?></span>

                            </div>
                             <div class="col-sm-2 lower">
                    <center><img src="<?php echo base_url(); ?>/backend/images/<?php echo $settinglist->right_logo; ?>" style="display:block;text-align:center" align="center"></center>
                            

                                                                
                                  <small>  APPROVED CENTER NO     <?php echo $settinglist->approved_center_no; ?></small>
  

                            </div>
                            
                        </div>
                        
                        
                        


<div class="tab-pane" id="reportcard">

<div class="row header text-center student">
<div class="col-sm-3">အမည္ <input type="text" value="<?=$student["firstname"].$student["lastname"]?>" readonly="readonly"/></div>
<div class="col-sm-3">ေက်ာင္း <input type="text" value="<?=$settinglist->nick?>" readonly="readonly"/></div>
<div class="col-sm-3">အတန္း <input type="text" value="<?=$student["class"]?>" readonly="readonly"/> တန္း</div>
<div class="col-sm-3">တန္းခြဲ <input type="text" value="<?=$student["section"]?>" readonly="readonly"/></div>

</div>




                           <div class="table-responsive">    
<table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
<thead>


   
 <tr>
  <td align="center">လအမည္</td>

<?php

       $numberarr=array("၁","၂","၃","၄","၅","၆","၇","၈","၉","၁၀","၁၁","၁၂");
$count = 1;
$totalamt=0;
$totalrec=0;
//for($j=0;$j<count($titlearr);$j++)
//{
	
	foreach($reportcard_subject->result() as $subject):
?>

<td align="center"><?php echo $subject->name; ?></td>


<?php
endforeach;
//}

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
 foreach($exams->result() as $e):

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
$totalmark=0;
$totalfullmark=0;

$rpcards=$this->Reportcard_model->rpcards($student_id,$e->id);
 $no=$rpcards->num_rows();
 
foreach($rpcards->result() as $r):
 ?>
<td align="center"><?php   
if($r->full_marks==0)
{$mavg=0;$mg="";}
else{ 
 $mavg=($r->get_marks/$r->full_marks)*100;
$grades=$this->Reportcard_model->get_grades($mavg);
$mg=$grades->name;
}


 echo $mg?></td>

<?php
 $totalfullmark+=$r->full_marks;
  $totalmark+=$r->get_marks;
 
endforeach;

if($totalmark==0)
{$avg=0;$g="";}
else{ 
$avg=($totalmark/$totalfullmark)*100;
$grades=$this->Reportcard_model->get_grades($avg);
$g=$grades->name;
}

for($a=$no;$a<count($numberarr)-1;$a++)
{
	if($a==5)
	{
		if($totalmark==0){$totalmark="";}else{$totalmark=$totalmark;}
	echo "<td align='center'>".""."</td>";
	}
	
	else if($a==6)
	{
		//if($totalmark==0){$totalmark="";}else{$totalmark=$totalmark;}
	echo "<td align='center'>".$g."</td>";
	}
	
	
	else
	{
	echo "<td align='center'></td>";
	}
} 


 ?>

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


</tr>


</tbody>



</table>

</div>    

<br />

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