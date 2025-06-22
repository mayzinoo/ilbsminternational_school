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
        padding-bottom:20px;

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
 <?php  $i=1; foreach ($resultlist as $student) {?>
 <div class="col-md-12" style="padding:10px;margin:70px 10px">	

<table width="100%">
   
  <tr>
       <td><?=$student['class'] . "(" . $student['section']?>) - <?=$student["inter_class"]?></td>
      <td><?=$student['admission_no']?></td><td><?=$student['firstname'] . " " . $student['lastname']?></td>
  <td><?=$student['father_name'] . "+" . $student['mother_name']?></td>
 <td width="30%"> username : <?=$student['username']?> <br/>

  password : <?=$student['password']?></td></tr>
  
  

</table>
 </div>
  <?php $i++;}?>


<script type="text/javascript">
//window.print();
</script>