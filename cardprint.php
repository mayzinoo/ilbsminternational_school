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
        margin: 0mm 15mm 10mm 15mm; /* margin you want for the content */
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
</style>
 
 <table width="30%">
  <caption style="background:teal;color:white;font-weight:bold">         
 <?php echo $this->setting_model->getCurrentSchoolName(); ?>
</caption>
 <!--  <tr>
       <td rowspan="4" width="30%">             <img src="<?=base_url()?><?=$student['image']?>" width="100%"/>
</td>
       <td></td>
   </tr>
   <tr><td> 
    Name :  <?php   echo $student['firstname']." ".$student['lastname']?>
</td></tr>
   <tr><td>             Phone : <?php echo $student['phone']?>
</td></tr>
   <tr><td>             Class : <?php echo $student['class'] . "(" . $student['section'] . ")"?>
</td></tr> -->
 
 <tr><td colspan="2">            <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],10,"0",STR_PAD_LEFT)?>&sf=2&ms=r&md=0.8"/>
</td></tr>
</table>
<script type="text/javascript">
window.print();
</script>