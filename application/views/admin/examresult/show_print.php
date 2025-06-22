<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Exam Result</title>
	<link rel="stylesheet" type="text/css" href="css/gistfile1.css">
	<link rel="stylesheet" type="text/css" href="css/style-main.css">

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body{
			background-color: #fff;
			margin: 0 auto;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		.header h3{
			font-size: 20px;
    		padding: 13px 0px 0px 0px;
		}
		.header-img{
			width:70px;
			height:auto;
		}
		.container-with-shadow {
		    background-color: #FFF;
		    box-shadow: 0 0 3px 1px rgba(0,0,0,.2);
		    border-top-right-radius: 2px;
		    border-bottom-right-radius: 2px;
		    border-bottom-left-radius: 2px;
		    border-top-left-radius: 2px;
		    padding:40px 50px;
		}
		.padding_md{
			padding-top:50px;
			padding-bottom:50px;
		}
		.padding_sm{
			padding-top:10px;
			padding-bottom:10px;
		}
		.toppadding_md{
			padding-top:50px;
		}
		.toppadding_sm{
			padding-top:10px;
		}
		hr{
			border-top:1px solid #000 !important;
		}
		.cvtable .table td,.cvtable .table th{
			padding:0px !important;
			border-top:0px !important;
		}
		#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		#body{
		margin: 0 15px 0 15px;
		}
		table{
		    table-layout: fixed;
		}
		.center{
		    text-align:center;
		}
		.header-bd p {
            float: right !important;
            text-align:right;
        }
		.toppadding_sm{
		    padding-top:20px;
		}
		.result-header h3{
		    font-size:16px;
		}
	
	</style>
</head>
<body>

<div id="container">
	<div id="body" class="examp-result">
		<div class="row result-header">
         <div class="row header text-center">
                            <div class="col-sm-2">
                                
                             ိိ
                                  <img style="height:80px; " src="<?php echo base_url(); ?>uploads/school_content/logo/<?php echo $settinglist['image']; ?>">
                              
                            </div>
                            <div class="col-sm-10">

                                <strong style="font-size: 20px;"><?php echo $settinglist['name']; ?></strong><br>
                                <?php echo $settinglist['address']; ?>

                                <?php echo $this->lang->line('phone'); ?>: <?php echo $settinglist['phone']; ?><br>
                                <?php echo $this->lang->line('email'); ?>: <?php echo $settinglist['email']; ?><br>

                            </div><!--/col-->
                        </div>
           <div class="col-sm-12">
               <img src="<?php echo base_url(); ?>uploads/school_content/logo/<?php echo $scho_logo->image; ?>" style="width:80px;height:auto;margin-top:30px !important;">
               <h3 class="center" style="margin-left:80px !important;margin-top:-70px;">
                 Success More ကိုယ္ပိုင္အေၿခခံပညာအလယ္တန္းေက်ာင္း<br/>
    <!--အမွတ္(၁/၆)၊ သာစည္လမ္း၊ ခ်မ္းၿမသာစည္ရပ္ကြက္၊ မံုရြာၿမိဳ႕။</br/>-->
    <!--ဖုန္း-၀၇၁ ၂၆၂၆၂၉၊ ၀၇၁ ၂၄၈၂၁၊ ၀၉ ၂၅၇၈၄၇၇၇၁၊ ၀၉ ၂၅၇၈၄၇၇၇၂-->
               </h3>
           </div>
           <div class="col-sm-12 header-bd">
               <p>
                   <span><?php echo $location->division; ?></span>   တိုင္းေဒသၾကီး/ၿပည္နယ္<br/>
                    <span><?php echo $location->district; ?></span>  ခရိုင္<br/>
                    <span><?php echo $location->township; ?></span>  ၿမိဳ႕နယ္<br/>
                    <span><?php echo $location->sch_name; ?></span>  ေက်ာင္း
               </p>
           </div>
        </div>
   <div class="row result-body">
       <p><?php echo $location->year; ?> ပညာသင္ႏွစ္၊ (သင္ရိုးသစ္) <?php echo $studentdata->cls; ?> ေအာင္စာရင္း  </p>
       <table class="table table-striped table-bordered table-hover example" cellspacing="0" cellpadding="5">
           <thead>
               <tr>
                   <th>စဥ္</th>
                   <th>ခံုအမွတ္</th>
                   <th>ေက်ာင္း၀င္အမွတ္</th>
                   <th>အမည္</th>
                   <th>အဘအမည္</th>
                   <th>မွတ္ခ်က္</th>
               </tr>
           </thead>
           <tbody>
               <?php 
               $no=1;
               foreach($examresult->result() as $row): ?>
               <tr>
                   <td><?php echo $no; ?></td>
                   <td><?php echo $row->seat_no; ?></td>
                   <td><?php echo $row->admission_no; ?></td>
                   <td><?php echo $row->firstname.$row->lastname; ?></td>
                   <td><?php echo $row->father_name; ?></td>
                   <td><?php echo $row->remark; ?></td>
                   
               </tr>
              <?php 
					$no++;
					endforeach; ?>
           </tbody>
       </table>
   </div>
   <div class="row result-footer toppadding_sm">
       <p>အတန္းပိုင္ဆရာ လက္မွတ္ .......................</p>
       <p>အမည္   .......................</p>
       <p>ရာထူး   .......................</p>
   </div>
	</div>

	
</div>

</body>
</html>