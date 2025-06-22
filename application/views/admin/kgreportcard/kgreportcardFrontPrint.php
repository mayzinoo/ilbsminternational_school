<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KG Student Report Card</title>
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
#kgreportcard tr,#kgreportcard th,#kgreportcard td{
    border: thin solid green;
    color: green;
    vertical-align: middle;
    margin: 0;
}
#kgreportcard table th,#kgreportcard table td{
    padding:10px;
}
</style>

</head>

<body>
    <h3 style="text-align:center;padding-top:30px;">သင္ယူမႈရလဒ္ မွတ္တမ္း</h3>
    <p>ေက်ာင္းသူ/သား အမည္ - <?=$student["firstname"].$student["lastname"]?>
        <span style="margin-left:50px;">အဘအမည္ - <?=$student["father_name"]?></span>
        <span style="float:right;">ေမြးသကၠရာဇ္ - <?=$student["dob"]?> </span>
    </p>
    <div id="kgreportcard">
    <table class="table table-striped table-bordered table-hover example" width="100%" cellspacing="0">
        <tr>
            <th rowspan="3">စဥ္</th>
            <th rowspan="3" style="width:10%;">သင္ယူမႈနယ္ပယ္</th>
            <th rowspan="3" style="width:12%;">သင္ယူမႈရလဒ္</th>
            <th colspan="4">ပထမအၾကိမ္</th>
            <th colspan="4">ဒုတိယအၾကိမ္</th>
            <th colspan="4">တတိယအၾကိမ္</th>
            <th colspan="4">စတုတၳအၾကိမ္</th>
        </tr>
        <tr>
            <th colspan="4">ဇူလိုင္လ ေနာက္ဆံုးအပတ္</th>
            <th colspan="4">စက္တင္ဘာလ ေနာက္ဆံုးအပတ္</th>
            <th colspan="4">နို၀င္ဘာလ ေနာက္ဆံုးအပတ္</th>
            <th colspan="4">ဇန္န၀ါရီလ ေနာက္ဆံုးအပတ္</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
        </tr>
        <!--table header-->
        
            <tr>
            <td rowspan="2">1</td>
            <td rowspan="2">ကိုယ္စိတ္ႏွစ္ၿဖာ က်န္းမာခ်မ္းသာၿခင္း</td>
            <td>ကေလးမ်ား က်န္းမာသန္စြမ္းၿပီး အၿခားကေလးမ်ားႏွင့္ အတူတကြ စုေပါင္းကစားနိုင္သည္။</td>
           
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                         <?php
                            if($kgimpro_result->reportcard_month=='3' && $kgimpro_result->grade==$i && $kgimpro1->id=='1'  && $kgimpro1->description_id=='1')
                            { 
                               echo '√';
                            }
                        ?>   
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result->reportcard_month=='5' && $row->grade==$i && $kgimpro1->id=='1' && $kgimpro1->description_id=='1')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result->reportcard_month=='7' && $kgimpro_result->grade==$i && $kgimpro1->id=='1' && $kgimpro1->description_id=='1')
                            { 
                               echo '√';
                            }
                       
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result->reportcard_month=='9' && $kgimpro_result->grade==$i && $kgimpro1->id=='1' && $kgimpro1->description_id=='1')
                            { 
                               echo '√';
                            }
                       
                        ?>    
                    </td>
             <?php    }
            ?>

        </tr>
        
         
        
        <tr>
            <td>တစ္ကိုယ္ေရ သန္႕ရွင္းေရးအေလ႕အက်င္႕ေကာင္းမ်ားကို ေန႕စဥ္ပံုမွန္လုပ္ေဆာင္နိုင္သည္။</td>
            
           <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result->reportcard_month=='3' && $kgimpro_result->grade==$i && $kgimpro1->id=='2' && $kgimpro1->description_id=='2')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result->reportcard_month=='5' && $kgimpro_result->grade==$i && $kgimpro1->id=='2'&& $kgimpro1->description_id=='2')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result->reportcard_month=='7' && $kgimpro_result->grade==$i && $kgimpro1->id=='2'&& $kgimpro1->description_id=='2')
                            { 
                               echo '√';
                            }
                       
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result->reportcard_month=='9' && $kgimpro_result->grade==$i && $kgimpro1->id=='2'&& $kgimpro1->description_id=='2')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <!--1-->
        <tr>
            <td rowspan="4">2</td>
            <td rowspan="4">စာရိတၱ၊ မိတၱႏွင့္ စိတ္လႈပ္ရွားမႈဆိုင္ရာ ဖြံ႕ၿဖိဳးတိုးတက္ၿခင္း</td>
            <td>မိမိကိုယ္မိမိ သိရွိၿပီး မိမိႏွင့္ အၿခားသူမ်ားအၾကား တူညီမႈ၊ ကြဲၿပားၿခားနားမႈတို႕ကို ေၿပာၿပနိုင္သည္။</td>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='3' && $kgimpro_result2->grade==$i && $kgimpro2->id=='3' && $kgimpro2->description_id=='3')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='5' && $kgimpro_result2->grade==$i && $kgimpro2->id=='3' && $kgimpro2->description_id=='3')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='7' && $kgimpro_result2->grade==$i && $kgimpro2->id=='3' && $kgimpro2->description_id=='3')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='9' && $kgimpro_result2->grade==$i && $kgimpro2->id=='3' && $kgimpro2->description_id=='3')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>မိမိေနထိုင္ရာလူမႈပတ္၀န္းက်င္တြင္ ေကာင္းေသာအမူအက်င့္မ်ားကို ၿပသနိုင္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='3' && $kgimpro_result2->grade==$i && $kgimpro2->id=='4' && $kgimpro2->description_id=='4')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='5' && $kgimpro_result2->grade==$i && $kgimpro2->id=='4' && $kgimpro2->description_id=='4')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='7' && $kgimpro_result2->grade==$i && $kgimpro2->id=='4' && $kgimpro2->description_id=='4')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='9' && $kgimpro_result2->grade==$i && $kgimpro2->id=='4' && $kgimpro2->description_id=='4')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>မိမိ မိသားစုအတြင္းအစဥ္အလာအရ က်င္းပေသာပြဲမ်ားႏွင့္ အၿခားလူမ်ိဳးစုမ်ား၏ အစဥ္အလာအရ က်င္းပေသာ ပြဲေတာ္မ်ားတြင္ ပါ၀င္ၿပီး အၿခား လူမ်ိဳးစုမ်ား၏ ယဥ္ေက်းမႈ ကို ေလးစားသည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='3' && $kgimpro_result2->grade==$i && $kgimpro2->id=='18' && $kgimpro2->description_id=='18')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result2->reportcard_month=='5' && $kgimpro_result2->grade==$i && $kgimpro2->id=='18' && $kgimpro2->description_id=='18')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='7' && $kgimpro_result2->grade==$i && $kgimpro2->id=='18' && $kgimpro2->description_id=='18')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='9' && $kgimpro_result2->grade==$i && $kgimpro2->id=='18' && $kgimpro2->description_id=='18')
                            { 
                               echo '√';
                            }
                       
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>ပတ္၀န္းက်င္ကို လြတ္လပ္စြာစူးစမ္း ေလ့လာနိုင္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='3' && $kgimpro_result2->grade==$i && $kgimpro2->id=='19' && $kgimpro2->description_id=='19')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='5' && $kgimpro_result2->grade==$i && $kgimpro2->id=='19' && $kgimpro2->description_id=='19')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='7' && $kgimpro_result2->grade==$i && $kgimpro2->id=='19' && $kgimpro2->description_id=='19')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result2->reportcard_month=='9' && $kgimpro_result2->grade==$i && $kgimpro2->id=='19' && $kgimpro2->description_id=='19')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <!--2-->
        <tr>
            <td rowspan="5">3</td>
            <td rowspan="5">အၿပန္အလွန္ ေၿပာဆိုဆက္သြယ္ၿခင္း</td>
            <td>ဗ်ည္းအကၡရာမ်ားႏွင့္ ကိန္းမ်ားကို ခြဲၿခားသတ္မွတ္နိုင္ၿပီး အရစ္အဆြဲမွန္စြာ ၿဖင့္ ကူးေရးတတ္သည္။</td>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='3' && $kgimpro_result3->grade==$i && $kgimpro3->id=='9' && $kgimpro3->description_id=='9')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result3->reportcard_month=='5' && $kgimpro_result3->grade==$i && $kgimpro3->id=='9' && $kgimpro3->description_id=='9')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='7' && $kgimpro_result3->grade==$i && $kgimpro3->id=='9' && $kgimpro3->description_id=='9')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='9' && $kgimpro_result3->grade==$i && $kgimpro3->id=='9' && $kgimpro3->description_id=='9')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>ရုပ္ပံုမ်ားကို ၾကည္႕ၿပီး ပံုၿပင္ကို ၾကိဳတင္ခန္႕မွန္းနိုင္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result3->reportcard_month=='3' && $kgimpro_result3->grade==$i && $kgimpro3->id=='8' && $kgimpro3->description_id=='8')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='5' && $kgimpro_result3->grade==$i && $kgimpro3->id=='8' && $kgimpro3->description_id=='8')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='7' && $kgimpro_result3->grade==$i && $kgimpro3->id=='8' && $kgimpro3->description_id=='8')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='9' && $kgimpro_result3->grade==$i && $kgimpro3->id=='8' && $kgimpro3->description_id=='8')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>ေမးခြန္းမ်ားကို နားေထာင္ၿပီး မရွင္းလင္းသည္မ်ားကို ရွင္းၿပရန္ ေတာင္းဆိုတတ္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='3' && $kgimpro_result3->grade==$i && $kgimpro3->id=='7' && $kgimpro3->description_id=='7')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result3->reportcard_month=='5' && $kgimpro_result3->grade==$i && $kgimpro3->id=='7' && $kgimpro3->description_id=='7')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='7' && $kgimpro_result3->grade==$i && $kgimpro3->id=='7' && $kgimpro3->description_id=='7')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='9' && $kgimpro_result3->grade==$i && $kgimpro3->id=='7' && $kgimpro3->description_id=='7')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>သီခ်င္းမ်ား၊ ကဗ်ာမ်ား၊ ပံုၿပင္မ်ား၊ ဇာတ္လမ္းမ်ားကို နားေထာင္ၿပီး အမူအရာၿဖင့္ သရုပ္ေဆာင္ၿပနိုင္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='3' && $kgimpro_result3->grade==$i && $kgimpro3->id=='6' && $kgimpro3->description_id=='6')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='5' && $kgimpro_result3->grade==$i && $kgimpro3->id=='6' && $kgimpro3->description_id=='6')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='7' && $kgimpro_result3->grade==$i && $kgimpro3->id=='6' && $kgimpro3->description_id=='6')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='9' && $kgimpro_result3->grade==$i && $kgimpro3->id=='6' && $kgimpro3->description_id=='6')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>စကားသံအမ်ိဳးမ်ိဳးကို နားေထာင္၍ အသံမ်ားကို ခြဲၿခားနိုင္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='3' && $kgimpro_result3->grade==$i && $kgimpro3->id=='5' && $kgimpro3->description_id=='5')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='5' && $kgimpro_result3->grade==$i && $kgimpro3->id=='5' && $kgimpro3->description_id=='5')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='7' && $kgimpro_result3->grade==$i && $kgimpro3->id=='5' && $kgimpro3->description_id=='5')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result3->reportcard_month=='9' && $kgimpro_result3->grade==$i && $kgimpro3->id=='5' && $kgimpro3->description_id=='5')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <!--3-->
        <tr>
            <td rowspan="3">4</td>
            <td rowspan="3">သခ်ၤာအေၿခခံမ်ားကို စူးစမ္းၿခင္း</td>
            <td>ပစၥည္းအေရအတြက္မည္မွ်ရွိသည္ကို အနီးစပ္ဆံုးခန္႕မွန္းနိုင္သည္။</td>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='3' && $kgimpro_result4->grade==$i && $kgimpro4->id=='10' && $kgimpro4->description_id=='10')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='5' && $kgimpro_result4->grade==$i && $kgimpro4->id=='10' && $kgimpro4->description_id=='10')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='7' && $kgimpro_result4->grade==$i && $kgimpro4->id=='10' && $kgimpro4->description_id=='10')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='9' && $kgimpro_result4->grade==$i && $kgimpro4->id=='10' && $kgimpro4->description_id=='10')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>သခ်ၤာအေၿခခံအသိပညာၿဖစ္မ်ားကို ၿပဳလုပ္နိုင္သည္။(ႏႈိင္းယွဥ္ၿခင္း၊ အမ်ိဳးအစားခြဲၿခားၿခင္း၊ တူရာစုၿခင္းစသည္)</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='3' && $kgimpro_result4->grade==$i && $kgimpro4->id=='11' && $kgimpro4->description_id=='11')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='5' && $kgimpro_result4->grade==$i && $kgimpro4->id=='11' && $kgimpro4->description_id=='11')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='7' && $kgimpro_result4->grade==$i && $kgimpro4->id=='11' && $kgimpro4->description_id=='11')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='9' && $kgimpro_result4->grade==$i && $kgimpro4->id=='11' && $kgimpro4->description_id=='11')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>ကိန္းမ်ားကို (၁ မွ ၂၀) အထိသိ၍ ဖတ္တတ္ၿပီး ေရတြက္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result4->reportcard_month=='3' && $kgimpro_result4->grade==$i && $kgimpro4->id=='12' && $kgimpro4->description_id=='12')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='5' && $kgimpro_result4->grade==$i && $kgimpro4->id=='12' && $kgimpro4->description_id=='12')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='7' && $kgimpro_result4->grade==$i && $kgimpro4->id=='12' && $kgimpro4->description_id=='12')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result4->reportcard_month=='9' && $kgimpro_result4->grade==$i && $kgimpro4->id=='12' && $kgimpro4->description_id=='12')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <!--4-->
        <tr>
            <td rowspan="2">5</td>
            <td rowspan="2">အနုပညာရသ ခံစားၿခင္းႏွင့္ ဖန္တီးၿခင္း</td>
            <td>သီခ်င္း၊ကဗ်ာမ်ားကို ကာရန္ႏွင့္အညီ သီဆိုနိုင္ၿပီး ကၿခင္း၊ လက္ခုပ္တီးၿခင္းကို ၿပဳလုပ္နိုင္သည္။</td>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result5->reportcard_month=='3' && $kgimpro_result5->grade==$i && $kgimpro5->id=='14' && $kgimpro5->description_id=='14')
                            { 
                               echo '√';
                            }
                       
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result5->reportcard_month=='5' && $kgimpro_result5->grade==$i && $kgimpro5->id=='14' && $kgimpro5->description_id=='14')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result5->reportcard_month=='7' && $kgimpro_result5->grade==$i && $kgimpro5->id=='14' && $kgimpro5->description_id=='14')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result5->reportcard_month=='9' && $kgimpro_result5->grade==$i && $kgimpro5->id=='14' && $kgimpro5->description_id=='14')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>အပိုင္း အေၿခခံ၊ လူပံုမ်ား၊ တိရိစာၦန္ပံုမ်ားႏွင့္ သစ္ပင္ပံုမ်ားကို ေရးဆြဲတတ္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result5->reportcard_month=='3' && $kgimpro_result5->grade==$i && $kgimpro5->id=='13' && $kgimpro5->description_id=='13')
                            { 
                               echo '√';
                            }
                       
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result5->reportcard_month=='5' && $kgimpro_result5->grade==$i && $kgimpro5->id=='13' && $kgimpro5->description_id=='13')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result5->reportcard_month=='7' && $kgimpro_result5->grade==$i && $kgimpro5->id=='13' && $kgimpro5->description_id=='13')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                       
                            if($kgimpro_result5->reportcard_month=='9' && $kgimpro_result5->grade==$i && $kgimpro5->id=='13' && $kgimpro5->description_id=='13')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <!--5-->
        <tr>
            <td rowspan="2">6</td>
            <td rowspan="2">ပတ္၀န္းက်င္ေလာကကို သိရွိနားလည္ၿခင္း</td>
            <td>တိရစာၦန္မ်ား၊ သစ္ပင္မ်ား အေၾကာင္းသိရွိၿပီး လူသားမ်ားႏွင့္ အၿပန္အလွန္ဆက္သြယ္ပံုကို  ေၿပာၿပနိုင္သည္။</td>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='3' && $kgimpro_result6->grade==$i && $kgimpro6->id=='15' && $kgimpro6->description_id=='15')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='5' && $kgimpro_result6->grade==$i && $kgimpro6->id=='15' && $kgimpro6->description_id=='15')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='7' && $kgimpro_result6->grade==$i && $kgimpro6->id=='15' && $kgimpro6->description_id=='15')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='9' && $kgimpro_result6->grade==$i && $kgimpro6->id=='15' && $kgimpro6->description_id=='15')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <tr>
            <td>အရာ၀တၳဳမ်ား ၊ ပစၥည္းမ်ားကို အာရံု(၅)ပါးသံုးၿပီး စူးစမ္းေလ့လာနိုင္သည္။</td>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='3' && $kgimpro_result6->grade==$i && $kgimpro6->id=='16' && $kgimpro6->description_id=='16')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='5' && $kgimpro_result6->grade==$i && $kgimpro6->id=='16' && $kgimpro6->description_id=='16')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='7' && $kgimpro_result6->grade==$i && $kgimpro6->id=='16' && $kgimpro6->description_id=='16')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
            <?php 
                for($i=1;$i<=4;$i++)
                { ?>
                    <td>
                        <?php
                        
                            if($kgimpro_result6->reportcard_month=='9' && $kgimpro_result6->grade==$i && $kgimpro6->id=='16' && $kgimpro6->description_id=='16')
                            { 
                               echo '√';
                            }
                        
                        ?>    
                    </td>
             <?php    }
            ?>
        </tr>
        <!--6-->
        
        <tr>
            <td>7</td>
            <td colspan="2">သံုးသပ္ခ်က္</td>
            <td colspan="16"></td>
            
        </tr>
    </table>
    </div>
</body>
</html>