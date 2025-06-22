<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?=base_url()?>"></base>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Report Card</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
<style>
.kgreportcard{
    font-size:12px;
}
.edulogo{
    text-align:center;
}
.toppadding_md{
   
    padding-bottom: 30px;
}
.leftcolumn{
    /*background:#ccc;*/
}
.rightcolumn{
    /*background:#eee;*/
    padding-top: 21px;
}
.resigncertificate .student input {
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 1px dotted green;
}
.rightcolumn{
    line-height:2rem;
}
</style>

</head>

<body>
    <div class="col-sm-12" align="right"> 
    </div>
<div class="col-sm-12 kgreportcard toppadding_md resigncertificate">
    <div class="col-sm-6 leftcolumn student">
                <div class="edulogo">
                    <img src="backend/images/edulogo.png" >
                    <p>ပညာေရး၀န္ၾကီးဌာန<br/>
                    အေၿခခံပညာေက်ာင္း ေက်ာင္းထြက္လက္မွတ္</p>
                </div>
            <table style="width:100%;">
                <tr>
                    <td>(၁)ေက်ာင္း၀င္အမွတ္ <input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/>
                    <td>(2)ေက်ာင္းသားအမည္  <input type="text" value="<?=$resignstudent->student_name ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>(၃)ေက်ာင္းထြက္ရက္ <input type="text" value="<?=$resignstudent->resign_date ?>" readonly="readonly"/></td>
                    <td>(၄)နိုင္ငံသားစိစစ္ေရးကဒ္ၿပားအမွတ္ <input type="text" value="<?=$resignstudent->nrc_no?>" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>(၅) -  ပညာသင္ႏွစ္၌ <input type="text" value="<?=$resignstudent->student_name ?>" readonly="readonly"/></td>
                    <td>(၆)အဖအမည္ <input type="text" value="<?=$resignstudent->father_name ?>" readonly="readonly"/></td>
                </tr>
            .
            </table>       
            <p style="text-align:left;">
                (၇)ေၿပာင္းေရႊ႕လာခဲ႕သည္႕ေက်ာင္း <input type="text" value="<?=$resignstudent->moved_school ?>" readonly="readonly"/> ၊   <input type="text" value="<?=$resignstudent->moved_division?>" readonly="readonly"/>တိုင္းေဒသၾကီး/ၿပည္နယ္<br/>
                <input type="text" value="<?=$resignstudent->moved_township?>" readonly="readonly"/> ၿမိဳ႕နယ္<br/>
             
                <input type="text" value="<?=$resignstudent->moved_city?>" readonly="readonly"/> ၿမိဳ႕/ရြာ<br/>
                
               <input type="text" value="<?=$resignstudent->moved_school?>" readonly="readonly"/> ေက်ာင္း
            </p>
            <table style="width:100%;">
                <tr>
                    <td>(၈)၀င္ခြင္႕ၿပဳသည္႕အတန္း္ <input type="text" value="<?=$resignstudent->letattend_class ?>" readonly="readonly"/>     တန္း</td>
                    <td>(၉)၀င္ခြင္႕ၿပဳသည္႕ရက္  <input type="text" value="<?=$resignstudent->letattend_date ?>" readonly="readonly"/></td>
                </tr>            .
            </table>   
            <p>(၁၀)ေမြးသကၠရာဇ္ <input type="text" value="<?=$resignstudent->dob ?>" readonly="readonly"/></p> 
            <p>(၁၁)(ေက်ာင္းႏွစ္မကုန္မီထြက္ေသာ္) စာသင္ၾကားလ်က္ရွိသည္႕အတန္း <input type="text" value="<?=$resignstudent->nowattend_class?>" readonly="readonly"/></p>
            <p>(၁၂)  <input type="text" value="<?=$resignstudent->attend_date ?>" readonly="readonly"/> ေန႕ထိ၊ ရရွိသည္႕ ေက်ာင္းေခၚၾကိမ္ေပါင္း<input type="text" value="<?=$resignstudent->rollcalltime?>" readonly="readonly"/>
            </p>
            <br/>
            <p>
                မိဘအုပ္ထိန္းသူ၏<br/>
                လက္မွတ္ <input type="text" value="<?=$resignstudent->parent_sign ?>" readonly="readonly"/><br/>
                အမည္  <input type="text" value="<?=$resignstudent->parent_name ?>" readonly="readonly"/><br/>                နိုင္ငံသားစိစစ္ေရးကဒ္ၿပား <input type="text" value="<?=$resignstudent->parent_nrc ?>" readonly="readonly"/><br/>                ေန႕စြဲ <input type="text" value="<?=$resignstudent->parent_date ?>" readonly="readonly"/><br/>
            </p>
    </div><!--left column-->
    <div class="col-sm-6 student">
        <div class="edulogo">
            <img src="backend/images/edulogo.png" >
            <p>ပညာေရး၀န္ၾကီးဌာန<br/>
            အေၿခခံပညာေက်ာင္း ေက်ာင္းထြက္လက္မွတ္</p>
        </div>
        <p class="rightcolumn"><input type="text" value="<?=$resignstudent->moved_division?>" readonly="readonly"/>တိုင္းေဒသၾကီး/ၿပည္နယ္၊ <input type="text" value="<?=$resignstudent->moved_township?>" readonly="readonly"/> ၿမိဳ႕နယ္၊ <input type="text" value="<?=$resignstudent->moved_city?>" readonly="readonly"/>  ၿမိဳ႕/ရြာ၊
        
        ေက်ာင္း၀င္အမွတ္ <input type="text" value="<?=$resignstudent->enterschool_number?>" readonly="readonly"/>  ၿဖစ္သူ၊ <input type="text" value="<?=$resignstudent->father_name?>" readonly="readonly"/> ၏ သား/သမီး  
        <input type="text" value="<?=$resignstudent->student_name?>" readonly="readonly"/> သည္ <input type="text" value="<?=$resignstudent->edu_from?>" readonly="readonly"/> - <input type="text" value="<?=$resignstudent->edu_to?>" readonly="readonly"/> ပညာသင္ႏွစ္၌ <input type="text" value="<?=$resignstudent->nowattend_class?>" readonly="readonly"/>   တန္းကိုသင္ယူၿပီးေၿမာက္/မၿပီးေၿမာက္၍ <input type="text" value="<?=$resignstudent->resign_date?>" readonly="readonly"/> တြင္ ဤေက်ာင္းမွ  <input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/> အက်င္႕စာရိတၱႏွင္႕ ထြက္ေၾကာင္း၊၎ <input type="text" value="<?=$resignstudent->student_name?>" readonly="readonly"/> သည္ <input type="text" value="<?=$resignstudent->moved_division?>" readonly="readonly"/>  တိုင္းေဒသၾကီး/ၿပည္နယ္၊ <input type="text" value="<?=$resignstudent->moved_city?>" readonly="readonly"/>   ၿမိဳ႕/ရြာ <input type="text" value="<?=$resignstudent->moved_school?>" readonly="readonly"/> ေက်ာင္းမွ <input type="text" value="<?=$resignstudent->nowattend_class?>" readonly="readonly"/>  တန္းကို သင္ယူၿပီးေၿမာက္၍ ေၿပာင္းလာရာစည္းကမ္းႏွင္႕   ညီညြတ္သည္႕
ေက်ာင္းထြက္လက္မွတ္ တင္ၿပနိုင္သၿဖင့္ <input type="text" value="<?=$resignstudent->resign_date?>" readonly="readonly"/>  ေန႕မွစ၍ <input type="text" value="<?=$resignstudent->letattend_class?>" readonly="readonly"/>       တန္းတြင္ သင္ၾကားခြင့္ၿပဳခဲ့ေၾကာင္း၊၎ <input type="text" value="<?=$resignstudent-> 	student_name?>" readonly="readonly"/>    ၏ေမြးသကၠရာဇ္မွာေက်ာင္း၀င္မွတ္ပံုတင္ စာရင္းမ်ားအရ <input type="text" value="<?=$resignstudent->dob?>" readonly="readonly"/> ၿဖစ္ေၾကာင္း <br/>
(ေက်ာင္းႏွစ္မကုန္မီထြက္ေသာ္) <input type="text" value="<?=$resignstudent->nowattend_class?>" readonly="readonly"/>   တန္းတြင္ ပညာသင္ၾကားလွ်က္ရွိစဥ္ <input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/> ေန႕ထိေက်ာင္းေခၚၾကိမ္ေပါင္း(<input type="text" value="<?=$resignstudent->rollcalltime?>" readonly="readonly"/>) အနက္ (<input type="text" value="<?=$resignstudent->rollcalltime?>" readonly="readonly"/>) ရရွိၿပီးထြက္ေၾကာင္း။
        </p>
        <p style="padding-top:20px;">
            ၾကီးၾကပ္အုပ္ခ်ဳပ္သူ </p>
            <p style="padding-top:20px;"></p><input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/> ေက်ာင္း<br/>
            လက္မွတ္ထုတ္ေပးသည္႕ေန႕စြဲ <input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/> 
        </p>

          <p style="padding-top:20px;">
            ၾကီးၾကပ္အုပ္ခ်ဳပ္သူ </p>
            <p style="padding-top:20px;"></p><input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/> ေက်ာင္း<br/>
            လက္မွတ္ထုတ္ေပးသည္႕ေန႕စြဲ <input type="text" value="<?=$resignstudent->enter_date?>" readonly="readonly"/> 
        </p>
    </div><!--right column-->
</div>


</body>
</html>