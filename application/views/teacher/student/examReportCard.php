<div class="tab-pane" id="reportcard">

                           <div class="table-responsive">    
<table class="table table-striped table-bordered table-hover example">
<thead>


   
 <tr>
<?php

$titlearr=array("လအမည္","ျမန္မာစာ","အဂၤလိပ္စာ","သခၤ်ာ","အေထြေထြ သိပၸံဘာသာ","လူမႈေရးဘာသာ","ပထ၀ီဘာသာ","သမိုင္းဘာသာ","စုစုေပါင္း","အဆင့္","ေက်ာင္းေခၚၾကိမ္","အတန္းပိုင္ လက္မွတ္ႏွင့္ ေန႕စြဲ","မိဘအုပ္ထိန္းသူ လက္မွတ္ႏွင့္ ေန႕စြဲ","ေက်ာင္းအုပ္ၾကီး လက္မွတ္ႏွင့္ ေန႕စြဲ");
$numberarr=array("၁","၂","၃","၄","၅","၆","၇","၈","၉","၁၀","၁၁","၁၂","၁၃","၁၄");
$count = 1;
$totalamt=0;
$totalrec=0;
for($j=0;$j<count($titlearr);$j++)
{
?>

<td align="center"><?php echo $titlearr[$j]; ?></td>


<?php
}

?>
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
 
 $no=$rpcards->num_rows();
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

foreach($rpcards->result() as $r):
 ?>
<td><?php    echo $r->get_marks?></td>

<?php
endforeach;


for($a=$no;$a<=count($titlearr)-$no;$a++)
{
	echo "<td></td>";
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
<td></td>

</tr>


</tbody>



</table>

</div>    


                        <div class="container"> 
                                <div class="col-md-6"> 
                                        အတန္းပိုင္ဆရာ၏မွတ္ခ်က္။ ---------------------
                                        <br/>
                                        အတန္းပိုင္ဆရာ၏လက္မွတ္။ ---------------------
                                 </div>
                                <div class="col-md-6">  
ေက်ာင္းအုပ္ၾကီးမွတ္ခ်က္။ ---------------------
<br/>
ေက်ာင္းအုပ္ၾကီးလက္မွတ္။---------------------

                                </div>


                        </div>  

                        </div>