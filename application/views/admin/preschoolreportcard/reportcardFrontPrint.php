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
.toppadding_md{
    padding-bottom: 30px;
}
.kgreportcard h3{
    margin-top: 0px !important;
}
</style>

</head>

<body>
    <div class="col-sm-12" align="right"> 
<?=anchor("admin/Preschool_Reportcard/rpcardsback/".$student["id"],"&laquo; Back Report","class='btn active'");?>


<span onclick="window.print()" class="btn btn-success"><img src="<?=base_url()?>backend/images/p.png"/> Print</span>
</div>
<div class="col-sm-12 kgreportcard toppadding_md" id="reportcard">
    <div class="col-sm-5">
        <center><h3>လူမႈဆက္ဆံေရးႏွင့္ စိတ္လႈပ္ရွားမႈပိုင္းဆိုင္ရာ ဖြံ႕ၿဖိဳးမႈ</h3></center>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <p>
                ၁။ မိသားစုအတြင္းသာ ေၿပာဆိုဆက္ဆံမႈရွိၿခင္း။<br/>
                ၂။ မိသားစုသာမက သူစိမ္းမ်ား (ဆရာမ၊ ကေလးအခ်င္းခ်င္း၊ အၿခားသူမ်ား) ႏွင့္ ေၿပာဆိုဆက္ဆံမႈရွိၿခင္း။<br/>
                ၃။ မိသားစုႏွင္႕ အလြယ္တကူ ခြဲခြာနိုင္ၿခင္း။<br/>
                ၄။ မူၾကိဳသြားလိုစိတ္ရွိၿခင္း။<br/>
                ၅။ စိတ္တိုင္းမက်မႈကို မ်က္ႏွာ/ကိုယ္အမူအရာမ်ားႏွင္႕ ၿပတတ္ၿခင္း
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                ၆။ လုိအပ္ခ်က္ကို ေၿပာၿပတတ္ၿခင္း။<br/>
                ၇။ အခ်င္းခ်င္းကူညီတတ္ၿခင္း။<br/>
                ၈။ ကိုယ္တိုင္ပါ၀င္လုပ္ကိုင္လိုၿခင္း။<br/>
                ၉။ အမ်ားႏွင္႕ကစားၿခင္း။<br/>
                ၁၀။ ကိုယ္႕အလွည္႕ေရာက္ေအာင္ ေစာင္႕တတ္ၿခင္း။
                </p>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td></td>
                <?php 
				    foreach($getmonth->result() as $row):
                  ?>
                  <td><?php echo $row->name; ?></td>
                <?php 
				endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ေကာင္း</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result3->grade=='3' && $row->id==$result->reportcard_month)
                            { 
                               echo 'ေကာင္း';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>သင့္</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result3->grade=='2' && $row->id==$result->reportcard_month)
                            { 
                               echo 'သင့္';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>လို</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result3->grade=='1' && $row->id==$result->reportcard_month)
                            { 
                               echo 'လို';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
        <h3>​ဉာဏဖြံ႕ၿဖိဳးမႈ</h3>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <p>
                ၁။ အေၿခခံအေရာင္မ်ားကို သိၿခင္း။<br/>
                ၂။ အမ်ိဳးအစားအေရာအေႏွာထဲ မူတူရာစုစည္းတတ္ၿခင္။ (ေက်ာက္ခဲတစ္ပံု၊ သစ္ရြက္တစ္ပံု)<br/>
                ၃။ ပီသစြာ ရြတ္ဆိုေၿပာဆိုနိုင္ၿခင္း။<br/>
                ၄။ အရာ၀တၳဳမ်ားကို တစ္ခုမွ သံုးခုအထိမွန္ေအာင္ ေရတြက္တတ္ၿခင္း။<br/>
                ၅။ တည္ေနရာ (ေပၚ၊ ေအာက္၊ ေဘး၊ ထဲ၊ ၿပင္) တို႕ကို ၾကားရံုၿဖင္႕ နားလည္ၿခင္း။
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                ၆။ ဗ်ည္းစာလံုးမ်ား၊ ကိန္းဂဏန္းမ်ားကို ႏႈတ္တိုက္ရြတ္ဆိုတတ္ၿခင္း။<br/>
                ၇။ အဆက္အစပ္မရွိေသာ ေမးခြန္းမ်ားေမးတတ္ၿခင္း။<br/>
                ၈။ အေတြ႕အၾကံဳ (ၿမင္၊ၾကား၊သိ) မွ ပံုၿပင္တိုကေလးမ်ား။ <br/>
                ၉။ က်ိဳးေၾကားဆက္စပ္ေနေသာ ညႊန္ၾကားခ်က္(၂)ခုကို လုိက္နာနိုင္ၿခင္း။<br/>
                ၁၀။ အံသြင္းကစားစရာမ်ားကို မွန္ကန္စြာ လုပ္တတ္ၿခင္း။
                </p>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td></td>
                <?php 
				    foreach($getmonth->result() as $row):
                  ?>
                  <td><?php echo $row->name; ?></td>
                <?php 
				endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ေကာင္း</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result4->grade=='3' && $row->id==$impro_result4->reportcard_month)
                            { 
                               echo 'ေကာင္း';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>သင့္</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result4->grade=='2' && $row->id==$impro_result4->reportcard_month)
                            { 
                               echo 'သင့္';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>လို</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result4->grade=='1' && $row->id==$impro_result4->reportcard_month)
                            { 
                               echo 'လို';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
    </div><!-- left block-->

    <div class="col-sm-5" style="float:right;">
        <center><h3>ကိုယ္တိုင္လုပ္ေဆာင္နိုင္မႈစြမ္းရည္ (သို႕)အေလ႕အထ</h3></center>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <p>
                ၁။ ေရအိမ္၀င္တတ္ၿခင္း။ <br/>
                ၂။ တစ္ကိုယ္ရည္ သန္႕ရွင္းေရးကို ၿပဳလုပ္နိုင္ၿခင္း။<br/>
                ၃။ လက္ကိုစင္ေအာင္ သုတ္တတ္ၿခင္း။<br/>
                ၄။ ကိုယ္တိုင္ေရခြက္ကိုင္ၿပီး ေသာက္တတ္ၿခင္း။<br/>
                ၅။ ဇြန္းကို အသံုးၿပဳတတ္ၿခင္း။
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                ၆။ ပစၥည္းမ်ား (ကစားစရာ၊ အသံုးအေဆာင္) ကို သူ႕ေနရာႏွင္႕သူ ၿပန္ထားတတ္ၿခင္း။ <br/>
                ၇။ ႏွိပ္ၾကယ္ေစ႕ ၿဖဳတ္တတ္ၿခင္း။ <br/>
                ၈။ ႏွိပ္ၾကယ္ေစ႕ တပ္တတ္ၿခင္း။<br/>
                ၉။ အ၀တ္မ်ားကို ခၽြတ္တတ္ၿခင္း။<br/>
                ၁၀။ အမႈိက္မ်ားကို အမိႈက္ပံုးထဲသို႕ ထည္႕တတ္ၿခင္း။
                </p>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td></td>
                <?php 
				    foreach($getmonth->result() as $row):
                  ?>
                  <td><?php echo $row->name; ?></td>
                <?php 
				endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ေကာင္း</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result5->grade=='3' && $row->id==$impro_result5->reportcard_month)
                            { 
                               echo 'ေကာင္း';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>သင့္</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result5->grade=='2' && $row->id==$impro_result5->reportcard_month)
                            { 
                               echo 'သင့္';
                            }
                       
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>လို</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result5->grade=='1' && $row->id==$impro_result5->reportcard_month)
                            { 
                               echo 'လို';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
        <h3>​(က) ၾကြက္သားငယ္မ်ားထိန္းသိမ္းနိုင္မႈ</h3>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <p>
                ၁။ လက္ညွိးႏွင္႕ လက္မကို အသံုးၿပဳ၍ အရာ၀တၳဳမ်ားကို ေကာက္နိုင္ၿခင္း။<br/>
                ၂။ ခြက္ထဲသို႕ ေရမဖိတ္ေအာင္ ထည္႕နုိင္ၿခင္း။<br/>
                ၃။ သစ္သားတံုး (၅/၆)တံုးအထိသံုး၍ သစ္သားေမွ်ာ္စင္ တည္ေဆာင္နိုင္ၿခင္း။<br/>
                ၄။ ပုလင္းအဖံုးမ်ားဖြင္႕နိုင္ၿခင္း။<br/>
                ၅။ ဂ်ံဳ/ရႊံၿဖင္႕ အရုပ္မ်ား(ေဘာလံုး၊ ေၿမြ၊ ဘီစကစ္၊ ၾကက္ဥ၊ ေၾကာင္) ၿပဳလုပ္နိုင္ၿခင္း။
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                ၆။ ၾကိဳးသီနိုင္ၿခင္း (အရြယ္ၾကီးေသာ သစ္သားတံုး၊ ရာဘာလံုး၊ ပလပ္စတစ္လံုး။)<br/>
                ၇။ စကၠဴကို ဆုတ္ၿဖဲနိုင္ၿခင္း။<br/>
                ၈။ ေပးထားေသာ အစက္ခ်ရုပ္ပံု၏ အစက္မ်ားကို လိုက္ဆြဲနိုင္ၿခင္း။<br/>
                ၉။ ရုပ္ပံုမ်ားကို ေဆးၿခယ္ရာတြင္ အၿပင္သို႕ အနည္းငယ္သာ ထြက္ၿခင္း။<br/>
                ၁၀။ အ၀ိုင္းပံုေရးဆြဲနိုင္ၿခင္း။
                </p>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td></td>
                <?php 
				    foreach($getmonth->result() as $row):
                  ?>
                  <td><?php echo $row->name; ?></td>
                <?php 
				endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ေကာင္း</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result6->grade=='3' && $row->id==$impro_result6->reportcard_month)
                            { 
                               echo 'ေကာင္း';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>သင့္</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result6->grade=='2' && $row->id==$impro_result6->reportcard_month)
                            { 
                               echo 'သင့္';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>လို</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        
                            if($impro_result6->grade=='1' && $row->id==$impro_result6->reportcard_month)
                            { 
                               echo 'လို';
                            }
                        
                         ?>    
                    </td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
    </div><!-- right block-->
</div>



</body>
</html>