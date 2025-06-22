<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
            <div class="col-md-12">           
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title"><?php echo $this->lang->line('add_teacher'); ?></h3> -->
                        <h3 class="box-title">Leave Detail</h3>
                    </div> 
                    
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>


                            <div class="form-group col-md-12 text-center">
                                <label for="leaveform">ခြင့္တိုင္ၾကားလႊာ</label>                
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">အမည္  &nbsp; &nbsp; &nbsp; <?=$row->name?></label>
                                <!-- <input autofocus="" id="category" name="name" placeholder="" type="text" class="form-control no-border"  value="<?php echo set_value('name'); ?>" />
                                <?php echo form_error('name'); ?></span> -->
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">ရာထူး &nbsp; &nbsp; &nbsp; <?=$row->position?></label>
                                <!-- <input autofocus="" id="position" name="position" placeholder="" type="text" class="form-control"  value="<?php echo set_value('position'); ?>" />
                                <span class="text-danger"><?php echo form_error('position'); ?></span> -->
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">ဌာန &nbsp; &nbsp; &nbsp; <?=$row->dept?></label>
                                <!-- <input autofocus="" id="dept" name="dept" placeholder="" type="text" class="form-control"  value="<?php echo set_value('dept'); ?>" />
                                <span class="text-danger"><?php echo form_error('dept'); ?></span> -->
                            </div>

                            <div class="form-group col-md-12">
                                <label for="leavetype">ခြင့္အမ်ိဳးအစား</label>
                                <br/>
                                <input type="checkbox" value="casual" <?=($row->leave_type=='casual'? "checked='checked'" : "")?> /> ေရွာင္တခင္ခြင့္ &nbsp;  
                                <input type="checkbox" value="earn" 
                                <?=($row->leave_type=='earn'? "checked='checked'" : "")?> > လုပ္သက္ခြင့္ &nbsp;  
                                <input type="checkbox" value="medical" <?=($row->leave_type=='medical'? "checked='checked'" : "")?> > ေဆးလက္မွတ္ခြင့္ &nbsp;  
                                <input type="checkbox" value="compensation" <?=($row->leave_type=='compensation'? "checked='checked'" : "")?> > သာေရးနာေရးခြင့္ &nbsp;  
                                <input type="checkbox" value="paternity" <?=($row->leave_type=='paternity'? "checked='checked'" : "")?> > မီးဖြားခြင့္ &nbsp;  
                                <input type="checkbox" <?=($row->leave_type=='maternity'? "checked='checked'" : "")?> value="maternity" > ဖခင္ဘ၀ခံစားခြင့္ &nbsp;  
                                <input type="checkbox" <?=($row->leave_type=='other'? "checked='checked'" : "")?> value="other" > အျခားခြင့္ &nbsp;  
                                <input type="checkbox" <?=($row->leave_type=='replace'? "checked='checked'" : "")?> value="replace" > ရက္အစားခြင့္ (တိက်စြာေဖာ္ျပရမည္။)                 
                            </div> <br/>


                            <div class="form-group col-md-12">
                                <label for="leavereason">အေၾကာင္းအရာ</label> <br/>
                                <span><?=$row->leave_reason?></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="leavereason">ခြင့္ရက္</label>      <br/>                 
                            
                             <div class="form-group col-md-1">                                
                                <?=$row->leave_from?>
                            </div>

                            <div class="form-group col-md-1"> 
                                <label for="leavefrom">ရက္ေန႔မွ</label>
                            </div>

                            <div class="form-group col-md-1">                                
                                <?=$row->leave_to?>
                            </div>
                            
                            <div class="form-group col-md-1"> 
                                <label for="leaveto">ရက္ေန႔ထိ</label>
                            </div>

                            <div class="form-group col-md-2"> 
                                <label for="totaldays"> ရက္ေပါင္း ( <?=$row->total_leave?> ) ရက္</label>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="leavedate">ခြင့္တိုင္ၾကားသည့္ရက္စြဲ</label>              
                            </div>

                            <div class="form-group col-md-3">                                
                                <?=$row->leave_date?>   
                            </div>

                        </div>

                            <!--<div class="form-group col-md-12">-->
                            <!--    <label for="apply_by">ေလွ်ာက္ထားသူလက္မွတ္</label> <br/>-->
                            <!--    <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                            <!--</div>-->
                                                        

                            <div class="form-group col-md-12">
                                <label for="dutytransfer">မိမိတာ၀န္အားလႊဲအပ္သူ</label>                
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">အမည္  &nbsp; &nbsp; &nbsp; <?=$dtrow->dtname?></label>                                
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">ရာထူး &nbsp; &nbsp; &nbsp; <?=$dtrow->dtposition?></label>                               
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">ဌာန &nbsp; &nbsp; &nbsp; <?=$dtrow->dept?></label>                               
                            </div>

                            <div class="form-group col-md-6">
                                <label for="admindept">စီမံ/၀န္ထမ္းေရးရာဌာနအတြက္သာ</label> <br/>    
                                လစာျဖင့္ <input autofocus="" placeholder="" type="checkbox" class="form-control-date" <?=($row->adbysalary=='yes'? "checked='checked'" : "")?> /> &nbsp; &nbsp;
                                လစာမဲ့ျဖင့္ <input autofocus placeholder="" type="checkbox" class="form-control-date"  <?=($row->adbysalary=='no'? "checked='checked'" : "")?>/>
                                 <br/> <br/>
                                မွတ္ခ်က္ <br/>
                                <textarea name="remark" class="form-control">
                                    <?=$row->remark?>
                                </textarea> <br/>
                                 <br/> 
                               
                            </div>

                            <div class="form-group col-md-6">
                                
                                <label for="hrdept">(လူ႔စြမ္းအားအရင္းအျမစ္ဌာန)</label> <br/>
                               ခြင့္လက္က်န္ <br/>
                               <input type="radio" value="casual" <?php echo ($row->hrleavebalance=="casual")?'checked':'' ?> />&nbsp; 
                               ေရွာင္တခင္ခြင့္ &nbsp; &nbsp;<input type="radio" value="earn" <?php echo ($row->hrleavebalance=="earn")?'checked':'' ?> />&nbsp; 
                               လုပ္သက္ခြင့္ &nbsp; &nbsp; &nbsp;<input type="radio" value="medical" <?php echo ($row->hrleavebalance=="medical")?'checked':'' ?> />&nbsp; 
                               ေဆးခြင့္ &nbsp; &nbsp; &nbsp;<input type="radio" name="hrleavebalance" <?php echo ($row->hrleavebalance=="other")?'checked':'' ?> />&nbsp; 
                               အျခားခြင့္ &nbsp; &nbsp; &nbsp;
                               
                               
                               <br/> <br/>
                               
                                <input type="checkbox" value="yes" <?php echo ($row->recbyadmin=="yes")?'checked':'' ?>/>
                                &nbsp; ေထာက္ခံသည္ &nbsp; &nbsp; &nbsp; 
                                <input type="checkbox" value="no" <?php echo ($row->recbyadmin=="no")?'checked':'' ?> />
                                &nbsp; မေထာက္ခံပါ &nbsp; &nbsp; &nbsp;  <br/> <br/>
                                
                                     <input type="checkbox" <?php echo ($row->hrbysalary=="bysalary")?'checked':'' ?>>&nbsp; 
                                     လစာျဖင့္ခြင့္ျပဳသည္ &nbsp; &nbsp; &nbsp; <input type="checkbox" <?php echo ($row->hrbysalary=="nosalary")?'checked':'' ?>>&nbsp; 
                                     လစာမဲ့ျဖင့္ခြင့္ျပဳသည္ &nbsp; &nbsp; &nbsp; <input type="checkbox" name="approve_status" <?php echo ($row->hrbysalary=="noapprove")?'checked':'' ?> />&nbsp; 
                                     ခြင့္မျပဳပါ &nbsp; &nbsp; &nbsp;  <br/> <br/>

                                <!--<div class="col-md-6">-->
                                <!--လူ႔စြမ္းအားအရင္းအျမစ္ဌာနမန္ေနဂ်ာလက္မွတ္ </div>-->
                                <!--<div class="col-md-6">-->
                                <!--    <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                                <!--</div>-->

                                <br/> <br/>
                                <!--<div class="col-md-6">-->
                                <!--မန္ေနဂ်ာလက္မွတ္ </div>-->
                                <!--<div class="col-md-6">-->
                                <!--    <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                                <!--</div>-->
                               
                            </div>  
                            
                    <div class="form-group col-md-12">
                        <center>
                            မန္ေနဂ်ာ၏သေဘာတူညီခ်က္ <br/> <br/>
                               
                     <input type="checkbox" <?php echo ($row->approve_status=="allow")?'checked':'' ?>>&nbsp; သေဘာတူသည္ &nbsp; &nbsp; &nbsp; <input type="checkbox" <?php echo ($row->approve_status=="notallow")?'checked':'' ?> >&nbsp; သေဘာမတူပါ &nbsp; &nbsp; &nbsp; <br/> <br/>
                     
                     </center> 
                    </div>  
                    
            </div>  
             
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#dob,#entryDate,#startDateofTeaching').datepicker({
            format: date_format,
            autoclose: true
        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>
