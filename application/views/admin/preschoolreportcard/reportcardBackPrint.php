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
.kgreportcard img.mainlogo{
  /* margin-left: 159px;*/
  padding:10px;
}
.reportcover{
    border: 5px double #018D11;
    padding:10px;
    border-radius: 10px;
    float:right;
}
.reportcover .col-sm-4 {

    width: 31.333% !important;

}
.kgdatabox{
    margin-left: 100px;
}
.kgdatabox td{
    border:0px !important; 
}
.kgdatabox{
    border:1px solid #018D11 !important;
    padding:10px;
    margin-left: 40px !important;
}
#reportcard .student{
    width:80%;
}
.lower img{
    width:80px !important;
}
.lower{
    margin-top:0px !important;
}
.kgallowno p{
    background:green;
    color:#fff;
    text-align:center;
}
.kgallowno_lower p{
    margin-top:-11px;
}
.toppadding_md{   
    padding-bottom: 30px;
}
</style>
</head>

<body>

<div class="col-sm-12" align="right"> 
<?=anchor("admin/Preschool_Reportcard/rpcardsfront/".$student["id"],"&laquo; Front Report","class='btn active pull-right'");?>


<span onclick="window.print()" class="btn btn-success"><img src="<?=base_url()?>backend/images/p.png"/> Print</span>
</div>

<div class="col-sm-12 kgreportcard toppadding_md" id="reportcard">
    <div class="col-sm-6">
        <h3>(ခ) ၾကြက္သားၾကီးမ်ားထိန္းနိုင္မႈ</h3>
        <div class="col-sm-12">
            <p>
   
            </p>
            <div class="col-sm-6">
                <p>
                ၁။ ပံုစံတက် လမ္းေလွ်ာက္နိုင္ၿခင္း။၏ <br/>
                ၂။ ေၿပးလိုက္၊ ရပ္လိုက္လုပ္နိုင္ၿခင္း။<br/>
                ၃။ ခုန္ဆြ ခုန္ဆြသြားနိုင္ၿခင္း။<br/>
                ၄။ ေနရာမေရြ႕ ရပ္ေနရာမွ အထက္သို႕ ခုန္နိုင္ၿခင္း။<br/>
                ၅။ ေဘာလံုးကို လွမ္႕၍ ပစ္နိုင္ၿခင္း။
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                ၆။ မ်ဥ္းေပၚတြင္ တစ္ေၿဖာင္႕တည္းေလွ်ာက္နိုင္ၿခင္း။<br/>
                ၇။ အနိမ္႕အၿမင့္မညီေသာ သစ္သားၿပာေပၚတြင္ လမ္းေလွ်ာက္နိုင္ၿခင္း။<br/>
                ၈။ ေလွခါးဆင္းရာတြင္ တစ္ထစ္ၿခင္းဘယ္ညာလွမ္း၍ ဆင္းနိုင္ၿခင္း။<br/>
                ၉။ ေၿခႏွစ္ေခ်ာင္းကို လိန္၍ ရပ္နိုင္ၿခင္း။<br/>
                ၁၀။ သံုးဘီးစက္ဘီး စီးနိုင္ၿခင္း။
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
                        // foreach($impro_result->result() as $result)
                        // {
                            if($impro_result->grade=='3' && $row->id==$impro_result->reportcard_month)
                            { 
                               echo 'ေကာင္း';
                            }
                        // }
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
                        // foreach($impro_result->result() as $result)
                        // {
                            if($impro_result->grade=='2' && $row->id==$impro_result->reportcard_month)
                            { 
                               echo 'သင့္';
                            }
                        // }
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>လုိ</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        // foreach($impro_result->result() as $result)
                        // {
                            if($impro_result->grade=='1' && $row->id==$impro_result->reportcard_month)
                            { 
                               echo 'လို';
                            }
                        // }
                         ?>    
                    </td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
        <p>​(က) ဤမွတ္တမ္းသည္ ကေလး၏ဖြံ႕ၿဖိဳးတိုးတက္မႈကို ၾကည္႕ရႈ႕စစ္ေဆးရန္ သတ္မွတ္ေပးထားၿခင္း ၿဖစ္ပါသည္။ <br>
            (ခ) မိဘမ်ားအေနၿဖင္႕ ဤမွတ္တမ္းကို ဖတ္ရႈၿပီး လက္မွတ္ထိုး၍ ၿပန္လည္ပို႕ေပးရန္ ၿဖစ္ပါသည္။
        </p>
        
        
        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <tr>
                    <td></td>
                <?php 
				    foreach($getmonth->result() as $row):
                  ?>
                  <td><?php echo $row->name; ?></td>
                <?php 
				endforeach; ?>
                </tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>အရပ္</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        // foreach($impro_result13->result() as $result)
                        // {
                            if($row->id==$impro_result13->reportcard_month)
                            { 
                               echo $result->height;;
                            }
                        // }
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>ကိုယ္အေလးခ်ိန္</td>
                    <?php 
                    foreach($getmonth->result() as $row){ ?>
                    <td>
                        <?php
                        // foreach($impro_result13->result() as $result)
                        // {
                            if($row->id==$impro_result13->reportcard_month)
                            { 
                               echo $result->weight;;
                            }
                        // }
                         ?>    
                    </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>အတန္းပိုင္လက္မွတ္</td>
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
                    <td>မိဘလက္မွတ္</td>
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
                    <td>ေက်ာင္းအုပ္လက္မွတ္</td>
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
    </div><!-- left block-->
    
    <div class="col-sm-5 reportcover" >
        <div class="col-sm-12">
            <div class="col-sm-4 kgallowno">
                <div><p>ပညာေရး၀န္ၾကီးဌာန၏
                ခြင့္ျပဳမိန္႕အမွတ္</p></div>
                <div class="kgallowno_lower"><p><?php echo $settinglist->allow_no; ?></p></div>
                
            </div>
            <div class="col-sm-4 kgallowno">
                <img src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php echo $scho_logo->image; ?>" width="100%" class="mainlogo"> 
                
            </div>
            <div class="col-sm-4 lower">
                <center><img src="<?php echo base_url(); ?>/backend/images/<?php echo $settinglist->right_logo; ?>" style="display:block;text-align:center" align="center"></center>       
                    <small>  APPROVED CENTER NO     <?php echo $settinglist->approved_center_no; ?></small>
            </div>
        </div>
        <div class="col-sm-12"> 
            <center>
                <p><strong class="title"><span style="color:#FD0001;">International School </span>(Pre-School)</strong></p>
                <p>ဘက္စံုဖြံ႕ၿဖိဳးတိုးတက္မႈမွတ္တမ္း (အငယ္ဆင္႕)</p>
                <p>(2018-2019 စာသင္ႏွစ္)</p>

            </center>
        </div>
        <div class="col-sm-12 kgdatabox student">        
            
                <table style="border:0px !important;">
                    <tr>
                        <td>အမည္</td>                        
                        <td><input type="text" value="<?=$student["firstname"].$student["lastname"]?>" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>အဘအမည္</td>                        
                        <td><input type="text" value="<?=$student["father_name"]?>" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td>ေမြးသကၠရာဇ္</td>                        
                        <td><input type="text" value="<?=$student["dob"]?>" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td>ေနရပ္လိပ္စာ</td>                        
                        <td><input type="text" value="<?=$student["guardian_address"]?>" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td>ေက်ာင္းစတင္၀င္ေရာက္သည္႕ေန႕</td>                        
                        <td><input type="text" value="<?=$student["admission_date"]?>" readonly="readonly"/></td>
                    </tr>


                </table>
                           
        
        </div>
    </div><!-- right block -->
</div>
</body>
</html>