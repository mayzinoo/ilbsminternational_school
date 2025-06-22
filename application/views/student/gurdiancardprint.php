 <style type="text/css">
    
 @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    h4{
        color: #8e3808;
        margin-bottom: 3px;
    }

    /*h3{
        color: #FF0000;
    }*/
    .title1{
        color: #FF0000;
        font-size: 30px;


    }

    h3{
        color: #FF0000;
        font-size: 30px;
        margin: 0px;
    }

    p
    {
        margin: 3px;
    }

    td
    {
        vertical-align: top;

    }

    .title2{
        color: #1a8731;
        font-size: 16px;
    }
    .address{
        color: #1a8731;
        font-size: 16px;
    }

    body
    {
        margin: 0mm; /* margin you want for the content */
    font-size: 11px;

    }
   

.font1
{
  color:red !important;
}

.font2
{
  color:blue !important;
}

.footer
{
  font-family:Zawgyi-One;
  font-size:11px;
  position:absolute;
  bottom:0;
  text-align:center;
  width:100%
}

.col-md-8

{
float:left;
width: 70%;
margin:10px;	
}
</style>
 <?php
     $setting=$this->Setting_model->getsettinglistByid($student["school"]);

 ?>
 <div class="col-md-8" style="border:1px solid black;border-radius:10px;padding:10px">	

<table width="100%">
  <tr> 
  <td width="10%"><img src="<?=base_url()?>uploads/school_content/logo/<?=$setting["image"]?>" height="70"/></td>
  <td align="center" colspan="2">
 <?php 
 echo $setting["name"];
 echo "<br/>".$setting["address"];
 echo "<br/>".$setting["phone"];
 echo "<br/>မိဘအုပ္ထိန္းသူမွ ကေလးၾကိဳခြင့္ ကဒ္ျပား";
  
 ?>
 </td>
 
</tr>
<tr><td colspan="3" size=3><hr/></td></tr>
   
   <tr>
       <td>အမည္</td>
<td> <?php   echo $student['firstname']." ".$student['lastname']?></td>
<td rowspan="3"><img src="<?=base_url()?><?=$student['image']?>" height="70"/></td>
</tr>
 
   <tr>
 <td>အတန္း</td>

<td><?php echo $student['class'] . " (" . $student['section'] . ")"?></td>
</tr> 

<tr>
<td>မိဘအမည္</td>

    <td><?php echo $student['father_name']." + ".$student["mother_name"]?></td></tr> 

<tr><td>လိပ္စာ</td
></td><td><?php echo $student['guardian_address']?></td></tr> 
<tr><td>မွတ္ခ်က္</td
></td><td>ကေလဘးကို လာေရာက္ၾကိဳသည့္ အခ်ိန္တိုင္း ေက်းဇူးျပဳ၍ ဤကဒ္ကို ယူေဆာင္လာပါရန္။ </td></tr> 

</table>
 </div>


<script type="text/javascript">
window.print();
</script>