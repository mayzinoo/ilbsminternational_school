<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Report Card</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
<style>
.kgreportcard p,td{
    font-size:12px;
}
#reportcard .col-sm-6{
   -webkit-box-flex:0;
   -ms-flex:0 0 50% !important;
   flex:0 0 50%;
   max-width:50%;
}
.left_logo img{
    margin: 8px 0px 0px 10px !important;
}
.toppadding_md{
    padding-top: 30px;
}
.header-top{
    background:#eb1c22;
    height:20px;
}
.content-body{
    height:295px;
}
.footer{
    /*height:64px;*/
    background:#eb1c22 !important;
    margin-top: -4px;
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
.footer p{
    color:#fff;
    text-align:center;
    font-size:12px;
}
img.profile{
    margin: 20px 0px 0px 65px;
}
/*.left_middle_card img{*/
/*    margin-left: -89px;*/
    /*width:150px;*/
/*}*/
.left_middle_card p{
    margin: 5px 0px 0px 7px;
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
    line-height:1rem;
}
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
.bodylogo_top img{
    width: 65%;
    height: auto;
    margin: 0 auto;
    display: block;
}
.bodytext p{
    font-size:12px;
    padding-left: 22px;
}
.bodylogo_excel img{
    width: 80%;
    margin-top: 20px;
}
.bodylogo_certificate img{
    width: 80%;
    margin-top: 13px;
}
.title1{
    line-height: 1em;
    margin-top: 4px;
    font-size:25px;
    color:#000 !important;
}
.title2{
    margin-top: -24px;
    color:#f222f2;
}

</style>

</head>

<body>
    <div class="col-sm-12" align="right"> 
    <?=anchor("Student/cardprint/".$student["id"],"&laquo; Front","class='btn active'");?>
    
    <span onclick="window.print()" class="btn btn-success"><img src="<?=base_url()?>backend/images/p.png"/> Print</span>
</div>
<div class="col-sm-12">
<div class="col-sm-6">
    <div class="studentcard">
    <div class="header-top">
        
    </div><!--top-->
    <div class="content-body">
        <div class="col-sm-12">
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/ilbsmlogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/termslogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_excel">
                <img src="/backend/images/excel2.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_certificate">
                <img src="/backend/images/certificate.jpg" style="">
            </div>
        </div>
        <div class="col-sm-3 toppadding_sm bodylogo_top">
            <img src="/backend/images/bodymiddle_logo.png" style="">
        </div>
        <div class="col-sm-9 toppadding_sm bodylogo_top">
            <p class="title1">UNIVERSITY OF CAMBRIDGE<br/>
            Esol Examinations</p>
            <p class="title2">Cambridge Preparation Courses & Exams Center</p>
        </div>
        <div class="col-sm-12 bodytext">
            <p>၁။ ေက်ာင္းသို႕လာေရာက္သည္႕အခ်ိန္တိုင္း ေက်ာင္းသားကဒ္ကို အၿမဲတမ္းခ်ိတ္ဆြဲထားရမည္။<br/>
၂။ ဤေက်ာင္းသားကဒ္ေပ်ာက္ဆံုးပါက မိမိအတန္းပိုင္ ဆရာ၊မ(သို႔)တာ၀န္ခံ ဆရာ၊မသို႕ ခ်က္ခ်င္းအေၾကာင္းၾကားေပးရမည္။</p>
        </div>
    </div><!--middle-->
    <div class="col-sm-12 footer">
        <p>ဤေက်ာင္းသားကဒ္ေတြ႕ရွိလွ်င္ နီးစပ္ရာILBSM ေက်ာင္းသို႕ပို႕ေပးပါရန္ ေမတၱာရပ္ခံအပ္ပါသည္။</p>
    </div><!--bottom-->
</div>
</div>
<div class="col-sm-6">
    <div class="studentcard">
    <div class="header-top">
        
    </div><!--top-->
    <div class="content-body">
        <div class="col-sm-12">
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/ilbsmlogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/termslogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_excel">
                <img src="/backend/images/excel2.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_certificate">
                <img src="/backend/images/certificate.jpg" style="">
            </div>
        </div>
        <div class="col-sm-3 toppadding_sm bodylogo_top">
            <img src="/backend/images/bodymiddle_logo.png" style="">
        </div>
        <div class="col-sm-9 toppadding_sm bodylogo_top">
            <p class="title1">UNIVERSITY OF CAMBRIDGE<br/>
            Esol Examinations</p>
            <p class="title2">Cambridge Preparation Courses & Exams Center</p>
        </div>
        <div class="col-sm-12 bodytext">
            <p>၁။ ေက်ာင္းသို႕လာေရာက္သည္႕အခ်ိန္တိုင္း ေက်ာင္းသားကဒ္ကို အၿမဲတမ္းခ်ိတ္ဆြဲထားရမည္။<br/>
၂။ ဤေက်ာင္းသားကဒ္ေပ်ာက္ဆံုးပါက မိမိအတန္းပိုင္ ဆရာ၊မ(သို႔)တာ၀န္ခံ ဆရာ၊မသို႕ ခ်က္ခ်င္းအေၾကာင္းၾကားေပးရမည္။</p>
        </div>
    </div><!--middle-->
    <div class="col-sm-12 footer">
        <p>ဤေက်ာင္းသားကဒ္ေတြ႕ရွိလွ်င္ နီးစပ္ရာILBSM ေက်ာင္းသို႕ပို႕ေပးပါရန္ ေမတၱာရပ္ခံအပ္ပါသည္။</p>
    </div><!--bottom-->
</div>
</div>
</div>
<div class="col-sm-12 toppadding_sm">
<div class="col-sm-6">
    <div class="studentcard">
    <div class="header-top">
        
    </div><!--top-->
    <div class="content-body">
        <div class="col-sm-12">
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/ilbsmlogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/termslogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_excel">
                <img src="/backend/images/excel2.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_certificate">
                <img src="/backend/images/certificate.jpg" style="">
            </div>
        </div>
        <div class="col-sm-3 toppadding_sm bodylogo_top">
            <img src="/backend/images/bodymiddle_logo.png" style="">
        </div>
        <div class="col-sm-9 toppadding_sm bodylogo_top">
            <p class="title1">UNIVERSITY OF CAMBRIDGE<br/>
            Esol Examinations</p>
            <p class="title2">Cambridge Preparation Courses & Exams Center</p>
        </div>
        <div class="col-sm-12 bodytext">
            <p>၁။ ေက်ာင္းသို႕လာေရာက္သည္႕အခ်ိန္တိုင္း ေက်ာင္းသားကဒ္ကို အၿမဲတမ္းခ်ိတ္ဆြဲထားရမည္။<br/>
၂။ ဤေက်ာင္းသားကဒ္ေပ်ာက္ဆံုးပါက မိမိအတန္းပိုင္ ဆရာ၊မ(သို႔)တာ၀န္ခံ ဆရာ၊မသို႕ ခ်က္ခ်င္းအေၾကာင္းၾကားေပးရမည္။</p>
        </div>
    </div><!--middle-->
    <div class="col-sm-12 footer">
        <p>ဤေက်ာင္းသားကဒ္ေတြ႕ရွိလွ်င္ နီးစပ္ရာILBSM ေက်ာင္းသို႕ပို႕ေပးပါရန္ ေမတၱာရပ္ခံအပ္ပါသည္။</p>
    </div><!--bottom-->
</div>
</div>
<div class="col-sm-6">
    <div class="studentcard">
    <div class="header-top">
        
    </div><!--top-->
    <div class="content-body">
        <div class="col-sm-12">
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/ilbsmlogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_top">
                <img src="/backend/images/termslogo.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_excel">
                <img src="/backend/images/excel2.jpg" style="">
            </div>
            <div class="col-sm-3 bodylogo_certificate">
                <img src="/backend/images/certificate.jpg" style="">
            </div>
        </div>
        <div class="col-sm-3 toppadding_sm bodylogo_top">
            <img src="/backend/images/bodymiddle_logo.png" style="">
        </div>
        <div class="col-sm-9 toppadding_sm bodylogo_top">
            <p class="title1">UNIVERSITY OF CAMBRIDGE<br/>
            Esol Examinations</p>
            <p class="title2">Cambridge Preparation Courses & Exams Center</p>
        </div>
        <div class="col-sm-12 bodytext">
            <p>၁။ ေက်ာင္းသို႕လာေရာက္သည္႕အခ်ိန္တိုင္း ေက်ာင္းသားကဒ္ကို အၿမဲတမ္းခ်ိတ္ဆြဲထားရမည္။<br/>
၂။ ဤေက်ာင္းသားကဒ္ေပ်ာက္ဆံုးပါက မိမိအတန္းပိုင္ ဆရာ၊မ(သို႔)တာ၀န္ခံ ဆရာ၊မသို႕ ခ်က္ခ်င္းအေၾကာင္းၾကားေပးရမည္။</p>
        </div>
    </div><!--middle-->
    <div class="col-sm-12 footer">
        <p>ဤေက်ာင္းသားကဒ္ေတြ႕ရွိလွ်င္ နီးစပ္ရာILBSM ေက်ာင္းသို႕ပို႕ေပးပါရန္ ေမတၱာရပ္ခံအပ္ပါသည္။</p>
    </div><!--bottom-->
</div>
</div>
</div>
</body>
</html>