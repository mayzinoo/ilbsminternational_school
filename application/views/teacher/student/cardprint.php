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

.col-md-6

{
float:left;
width: 46%;
margin:10px;	
}
</style>
 
 <div class="col-md-6">	

<table width="100%">
  <caption style="background:teal;color:white;font-weight:bold">         
 <?php echo $this->setting_model->getCurrentSchoolName(); ?>
</caption>
    <tr>
       <td rowspan="7" width="30%" align="center">             <img src="<?=base_url()?><?=$student['image']?>" height="70"/>
       <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.4&&ms=r&md=0.8"/>
</td>
   </tr>
   <tr>
<td> <?php   echo $student['firstname']." ".$student['lastname']?></td>
</tr>
 
   <tr>
<td><?php echo $student['class'] . " (" . $student['section'] . ")"?></td>
</tr> 

<tr><td>ID . <?php echo $student['admission_no']?></td></tr> 

<tr><td><?php echo $student['guardian_address']?></td></tr> 
<tr><td><?php echo $student['dob']?></td></tr> 
<tr><td><?php echo $student['guardian_phone']?></td></tr> 
 
</table>
 </div>


 <div class="col-md-6">	

<table width="100%">
  <caption style="background:teal;color:white;font-weight:bold">         
 <?php echo $this->setting_model->getCurrentSchoolName(); ?>
</caption>
    <tr>
       <td rowspan="7" width="30%" align="center">             <img src="<?=base_url()?><?=$student['image']?>" height="70"/>
       <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.4&&ms=r&md=0.8"/>
</td>
   </tr>
   <tr>
<td> <?php   echo $student['firstname']." ".$student['lastname']?></td>
</tr>
 
   <tr>
<td><?php echo $student['class'] . " (" . $student['section'] . ")"?></td>
</tr> 

<tr><td>ID . <?php echo $student['admission_no']?></td></tr> 

<tr><td><?php echo $student['guardian_address']?></td></tr> 
<tr><td><?php echo $student['dob']?></td></tr> 
<tr><td><?php echo $student['guardian_phone']?></td></tr> 
 
</table>
 </div>


 <div class="col-md-6">	


<table width="100%">
  <caption style="background:teal;color:white;font-weight:bold">         
 <?php echo $this->setting_model->getCurrentSchoolName(); ?>
</caption>
    <tr>
       <td rowspan="7" width="30%" align="center">             <img src="<?=base_url()?><?=$student['image']?>" height="70"/>
       <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.4&&ms=r&md=0.8"/>
</td>
   </tr>
   <tr>
<td> <?php   echo $student['firstname']." ".$student['lastname']?></td>
</tr>
 
   <tr>
<td><?php echo $student['class'] . " (" . $student['section'] . ")"?></td>
</tr> 

<tr><td>ID . <?php echo $student['admission_no']?></td></tr> 

<tr><td><?php echo $student['guardian_address']?></td></tr> 
<tr><td><?php echo $student['dob']?></td></tr> 
<tr><td><?php echo $student['guardian_phone']?></td></tr> 
 
</table>
 </div>


 <div class="col-md-6">	

<table width="100%">
  <caption style="background:teal;color:white;font-weight:bold">         
 <?php echo $this->setting_model->getCurrentSchoolName(); ?>
</caption>
    <tr>
       <td rowspan="7" width="30%" align="center">             <img src="<?=base_url()?><?=$student['image']?>" height="70"/>
       <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.4&&ms=r&md=0.8"/>
</td>
   </tr>
   <tr>
<td> <?php   echo $student['firstname']." ".$student['lastname']?></td>
</tr>
 
   <tr>
<td><?php echo $student['class'] . " (" . $student['section'] . ")"?></td>
</tr> 

<tr><td>ID . <?php echo $student['admission_no']?></td></tr> 

<tr><td><?php echo $student['guardian_address']?></td></tr> 
<tr><td><?php echo $student['dob']?></td></tr> 
<tr><td><?php echo $student['guardian_phone']?></td></tr> 
 
</table>
 </div>
<script type="text/javascript">
//window.print();
</script>