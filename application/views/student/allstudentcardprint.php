<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Report Card</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
<style>
@page 
{margin:40px;}
.kgreportcard p,td{
    font-size:12px;
}

p{  word-wrap: break-word; }
#reportcard .col-sm-6{
   -webkit-box-flex:0;
   -ms-flex:0 0 50% !important;
   flex:0 0 50%;
   max-width:50%;
}
.left_logo img{
    margin: 8px 0px 0px 10px;
}
.toppadding_md{
    padding-top: 30px;
}
.top_card{
    background:#eb1c22;
    height:115px;
}
.middle_card{
    height:200px;
}
.bottom_card{
    /*height:64px;*/
    background:#eb1c22 !important;
    border:1px solid #ccc;
}
.studentcard{
    border:1px solid #ccc;
    /*width: 49%;*/
    /*margin:0 auto;*/
}
.txt_card p{
    margin: 14px 0px 0px 0px;
    text-align: center;
    color: #fff;
}
.bottom_card p{
    color:#fff;
}
img.profile{
    margin: 9px 0px 0px 65px;
}
/*.left_middle_card img{*/
/*    margin-left: -89px;*/
    /*width:150px;*/
/*}*/
.left_middle_card p{
    margin: 5px 0px 0px 72px;
}
.grade p{
    display:inline;
    border:1px solid #000;
    border-radius:4px;
    margin-right:4px;
    margin-bottom:4px;
    padding:0px 5px;
    /*line-height: 2rem !important;*/
}
.center_middle_card {
    /*margin: -125px 0px 0px 190px;*/
}
.center_middle_card p{
 line-height: 1.6;}
.padding_sm{
    padding-top:10px;
    padding-bottom:10px;
}
.toppadding_sm{
    padding-top:10px;
}
.right{
    float:right;
}
</style>

</head>

<div class="col-sm-12">
        <?php  $i=1; foreach ($resultlist as $student) {?>

<div>
    <div class="studentcard">
    <div class="top_card">
        <div class="col-sm-2">
            <div class="left_logo">
            <img src="/backend/images/ilbsm-logo.png" style="margin: 4px 0px 0px 5px; width:100%; height:auto;">
            
            </div>
        </div>
        <div class="col-sm-8">
            <div class="txt_card">
            <p><b><span style="">ကိုယ္ပိုင္ေက်ာင္း</span></b><br/>
                အမွတ္(၁/၆)သာစည္လမ္း၊ ခ်မ္းၿမသာစည္ရပ္၊မံုရြာၿမိဳ႕<br/>
                ၀၇၁-၂၄၈၂၁၊ ၀၉-၂၅၇၈၄၇၇၇၁၊၀၉-၂၅၇၈၄၇၇၇၂</p>
                        </div>
        </div>
        <div class="col-sm-2">
            <div class="right_logo">
            <img src="/backend/images/card-right.png" style="margin:4px 12px 0px -5px; width:100%; height:auto;">
           
            </div>
        </div>
        
    </div><!--top-->
    <div class="middle_card">
        <div class="col-sm-12">
            <div class="col-sm-6 cardphoto">
            <div class="left_middle_card right">
                <img src="<?=base_url()?><?=$student['image']?>" class="profile"/>
             <p style=""><?php echo $student['admission_no']?></p>
              <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.4&&ms=r&md=0.8" class="barcode"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="center_middle_card">
                <p><?php   echo $student['firstname']." ".$student['lastname']?></p>
                <!--<div class="grade">-->
                    <p><?php echo $student['class'] . " (" . $student['section'] . ")"?></p>
                <!--</div>-->
                <p><?php echo $student['father_name']?></p>
                <p><?php echo $student['guardian_address']?></p>
                <p><?php echo $student['guardian_phone']?></p>
            </div>
        </div>
        <!--<div class="col-sm-3">-->
        <!--    <div class="right_middle_card">-->
        <!--    <img src="/backend/images/excel.png" style="margin: 8px 0px 0px -18px; width:100%; height:auto;">-->
        <!--    <img src="/backend/images/iso.png" style="margin: 15px 0px 0px -18px; width:100%; height:auto;">-->
        <!--</div>-->
        <!--</div>-->
        </div>
        
        
        
        
    </div><!--middle-->
    <div class="col-sm-12 bottom_card">
        <div class="col-sm-6">
            <p style="margin-left:4px;">admin@ilbsm.com.mm</p>
        </div>
        <div class="col-sm-6">
            <p style="float:right;margin-right:5px;">www.ilbsm.com.mm</p>
        </div>
    </div><!--bottom-->
</div>
</div>

<br/>

  <?php $i++;}?>

</div>



<script type="text/javascript">
//window.print();
</script>
</body>
</html>