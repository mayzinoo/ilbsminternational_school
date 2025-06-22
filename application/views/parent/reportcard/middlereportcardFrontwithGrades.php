
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> Reportcard</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">            


<div class="tab-pane" id="reportcard">



                           <div class="table-responsive">    
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
<thead>


   
 <tr>
  <td align="center">လအမည္</td>

<?php

$titlearr=array("လအမည္","ျမန္မာစာ","အဂၤလိပ္စာ","သခၤ်ာ","အေထြေထြ သိပၸံဘာသာ","လူမႈေရးဘာသာ","ပထ၀ီဘာသာ","သမိုင္းဘာသာ","စုစုေပါင္း","အဆင့္","ေက်ာင္းေခၚၾကိမ္","အတန္းပိုင္ လက္မွတ္ႏွင့္ ေန႕စြဲ","မိဘအုပ္ထိန္းသူ လက္မွတ္ႏွင့္ ေန႕စြဲ","ေက်ာင္းအုပ္ၾကီး လက္မွတ္ႏွင့္ ေန႕စြဲ");
$numberarr=array("၁","၂","၃","၄","၅","၆","၇","၈","၉","၁၀","၁၁","၁၂","၁၃");
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
	if($a==6)
	{
		if($totalmark==0){$totalmark="";}else{$totalmark=$totalmark;}
	echo "<td align='center'>".""."</td>";
	}
	
	else if($a==7)
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

<br />

                        </div>
                        
                        </section>
                        </div>