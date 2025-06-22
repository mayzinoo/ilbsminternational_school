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
                        <h3 class="box-title">Leave Form</h3>
                    </div> 
                    <form id="form1" action="<?php echo site_url('admin/Leave/edit_leave') ?>"  id="leave_form" name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        
                        <?php 
                            echo form_hidden("id",$row->id);
                            echo form_hidden("apply_by",$row->apply_by);
                            echo form_hidden("dtsign",$row->dtsign);
                            echo form_hidden("admin_sign",$row->admin_sign);
                            echo form_hidden("hrmanager_sign",$row->hrmanager_sign);
                            echo form_hidden("manager_sign",$row->manager_sign);
                            
                        ?>
                        
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>


                            <!--<div class="form-group col-md-12 text-center">-->
                            <!--    <label for="leaveform">Leave Form</label>                -->
                            <!--</div>-->

                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Teacher's Name</label>
                                <!--<input autofocus="" id="category" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />-->
                                <?php echo form_dropdown("teacher",$teacherlists,$row->teacher,'class="form-control"'); ?>
                                <span class="text-danger"><?php echo form_error('teacher'); ?></span>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Leave From</label>
                                <input autofocus="" id="leavefrom" name="leavefrom" placeholder="" type="text" class="form-control"  value="<?php echo date("d-m-Y",strtotime($row->leave_from)); ?>" />
                                <span class="text-danger"><?php echo form_error('leavefrom'); ?></span>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Leave To</label>
                                <input autofocus="" id="leaveto" name="leaveto" placeholder="" type="text" class="form-control"  value="<?php echo date("d-m-Y",strtotime($row->leave_to));  ?>" />
                                <span class="text-danger"><?php echo form_error('leaveto'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Leave Total</label>
                                <input autofocus="" id="leavetotal" name="leavetotal" placeholder="" type="text" class="form-control"  value="<?php echo $row->total_leave; ?>" />
                                <span class="text-danger"><?php echo form_error('leavetotal'); ?></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="leavetype">Leave Type</label>
                                <br/>
                                <input type="radio" value="casual" name="leavetype" <?php echo ($row->leave_type=="casual")?'checked':'' ?>> 
                                ေရွာင္တခင္ခြင့္
                                &nbsp;  <input type="radio" value="earn" name="leavetype" <?php echo ($row->leave_type=="earn")?'checked':'' ?>> 
                                လုပ္သက္ခြင့္    &nbsp;  <input type="radio" value="medical"  name="leavetype" <?php echo ($row->leave_type=="medical")?'checked':'' ?> > 
                                ေဆးလက္မွတ္ခြင့္    &nbsp;  <input type="radio" value="compensation" name="leavetype" <?php echo ($row->leave_type=="compensation")?'checked':'' ?>> 
                                သာေရးနာေရးခြင့္    &nbsp;  <input type="radio" value="paternity" name="leavetype" <?php echo ($row->leave_type=="paternity")?'checked':'' ?>> 
                                မီးဖြားခြင့္    &nbsp;  <input type="radio" value="maternity" name="leavetype" <?php echo ($row->leave_type=="maternity")?'checked':'' ?>> 
                                ဖခင္ဘ၀ခံစားခြင့္    &nbsp;  <input type="radio" value="other" name="leavetype" <?php echo ($row->leave_type=="other")?'checked':'' ?>> 
                                အျခားခြင့္    &nbsp; 
                                    <input type="radio" value="replace" name="leavetype" <?php echo ($row->leave_type=="replace")?'checked':'' ?>> 
                                ရက္အစားခြင့္ (တိက်စြာေဖာ္ျပရမည္။)    
                                    
                            </div>
                           

                            <div class="form-group col-md-12">
                                <label for="leavereason">Reason for Leave</label>
                                <textarea id="leave_reason" name="leave_reason" class="form-control">
                                    <?php echo $row->leave_reason; ?>
                                </textarea>                                
                                <span class="text-danger"><?php echo form_error('leave_reason'); ?></span>
                            </div>

                           <div class="form-group col-md-12">
                                <!--<div class="form-group col-md-3">-->
                                <!--    <label for="apply_by">Signature of Applicant</label>-->
                                <!--    <input autofocus="" size='20' id="apply_by" name="apply_by" type="file" class="form-control filestyle" value="<?php echo $row->leave_from; ?>" />-->
                                <!--    <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                                <!--</div>-->
    
                                <div class="col-md-4">
                                    <label for="leavedate">Apply Date</label>
                                    <input autofocus="" id="leavedate" name="leave_date" placeholder="" type="text" class="form-control"  value="<?php echo  date("d-m-Y",strtotime($row->leave_date)); ?>" />
                                    <span class="text-danger"><?php echo form_error('leave_date'); ?></span>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Duty Transfer Name</label>
                                    <!--<input autofocus="" id="category" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />-->
                                    <?php echo form_dropdown("dtransfer",$teacherlists,$row->dtteacher,'class="form-control"'); ?>
                                    <span class="text-danger"><?php echo form_error('dtransfer'); ?></span>
                                    
                                </div>
    
                                <!--<div class="col-md-3">-->
                                <!--    <label for="exampleInputEmail1">လက္မွတ္</label>-->
                                    <!-- <input autofocus="" id="sign" name="sign" placeholder="" type="text" class="form-control"  value="<?php echo set_value('sign'); ?>" /> -->
                                <!--    <input autofocus="" size='20' id="dtsign" name="dtsign" type="file" class="form-control filestyle" value="<?php echo set_value('dtsign'); ?>" />-->
                                <!--    <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                                <!--</div>-->
                            </div>
                            
                           
                            <div class="form-group col-md-5">
                                <label for="admindept">စီမံ/၀န္ထမ္းေရးရာဌာန</label> <br/> <br/>   
                                လစာျဖင့္ <input autofocus="" name="adbysalary" placeholder="" type="radio" class="form-control-date"  value="yes" <?php echo ($row->adbysalary=="yes")?'checked':'' ?> /> &nbsp; &nbsp;
                                လစာမဲ့ျဖင့္ <input autofocus="" name="adbysalary" placeholder="" type="radio" value="no" class="form-control-date" <?php echo ($row->adbysalary=="no")?'checked':'' ?> />
                                <span class="text-danger"><?php echo form_error('adbysalary'); ?>   
                                </span> <br/> <br/>
                                မွတ္ခ်က္ <br/>
                                <textarea name="remark" class="form-control"><?=$row->remark?></textarea> <br/>
                                 <br/> 
                                 
                                 <input type="radio" value="yes" name="recbyadmin" <?php echo ($row->recbyadmin=="yes")?'checked':'' ?>/> &nbsp; ေထာက္ခံသည္ &nbsp; &nbsp; &nbsp; 
                                 <input type="radio" value="no" name="recbyadmin" <?php echo ($row->recbyadmin=="no")?'checked':'' ?> /> &nbsp; မေထာက္ခံပါ &nbsp; &nbsp; &nbsp;  <br/> <br/>
                                <!--<div class="col-md-6">-->
                                <!--ဌာနမွဴး/ ဌာနတာ၀န္ခံ လက္မွတ္ </div>-->
                                <!--<div class="col-md-6">-->
                                <!--    <input autofocus="" style="width: 150px" size='10' id="admin_sign" name="admin_sign" type="file" class="filestyle" value="<?php echo set_value('admin_sign'); ?>" /> -->
                                <!--    <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                                    
                                <!--</div>-->
                                 <br/> <br/> <br/>
                              
                            </div> <div class="col-md-1"> </div>

                            <div class="form-group col-md-6">
                                 <label for="hrdept">(လူ႔စြမ္းအားအရင္းအျမစ္ဌာန)</label> <br/> <br/>
                               ခြင့္လက္က်န္ <br/>
                               <input type="radio" value="casual" name="hrleavebalance" <?php echo ($row->hrleavebalance=="casual")?'checked':'' ?> />&nbsp; ေရွာင္တခင္ခြင့္ &nbsp; &nbsp; &nbsp; 
                               <input type="radio" value="earn" name="hrleavebalance" <?php echo ($row->hrleavebalance=="earn")?'checked':'' ?> />&nbsp; လုပ္သက္ခြင့္ &nbsp; &nbsp; &nbsp;  
                               <input type="radio" value="medical" name="hrleavebalance" <?php echo ($row->hrleavebalance=="medical")?'checked':'' ?> />&nbsp; ေဆးခြင့္ &nbsp; &nbsp; &nbsp; 
                               <input type="radio" value="other" name="hrleavebalance" <?php echo ($row->hrleavebalance=="other")?'checked':'' ?> />&nbsp; အျခားခြင့္ &nbsp; &nbsp; &nbsp;
                               
                               <br/> <br/>
                               
                               
                                     <input type="radio" value="bysalary"  name="hrbysalary" <?php echo ($row->hrbysalary=="bysalary")?'checked':'' ?> />&nbsp; 
                                     လစာျဖင့္ခြင့္ျပဳသည္ &nbsp; &nbsp; &nbsp; <input type="radio" value="nosalary" name="hrbysalary" <?php echo ($row->hrbysalary=="nosalary")?'checked':'' ?> />&nbsp; 
                                     လစာမဲ့ျဖင့္ခြင့္ျပဳသည္ &nbsp; &nbsp; &nbsp; <input type="radio" value="noapprove" name="hrbysalary" <?php echo ($row->hrbysalary=="noapprove")?'checked':'' ?> />&nbsp; 
                                     ခြင့္မျပဳပါ &nbsp; &nbsp; &nbsp;  <br/> <br/> <br/> <br/> <br/>

                              <!--လူ႔စြမ္းအားအရင္းအျမစ္ဌာနမန္ေနဂ်ာလက္မွတ္ -->
                              <!--  <br/> <br/>-->
                              <!--  <div style="width:255.67px">-->
                              <!--      <input autofocus="" style="width: 150px" size='10' id="admin_sign" name="hrmanager_sign" type="file" class="filestyle" value="<?php echo set_value('hrmanager_sign'); ?>" /> -->
                              <!--      <?php echo ($row->recbyadmin=="no")?'checked':'' ?>-->
                              <!--      <img style="margin-bottom: 20px" src="<?php echo base_url(); ?>uploads/teacher_images/sign.jpg" width="100px">-->
                                    
                              <!--  </div>-->
                                
                             <!--<br/> <br/>   -->

                            </div> 
                            
                            
                            
                            <div class="col-md-12 text-center">
                                 <br/> <br/>
                                 မန္ေနဂ်ာသေဘာတူညီခ်က္ <br/><br/>
                                <input type="radio" value="allow" name="approve_status" <?php echo ($row->approve_status=="allow")?'checked':'' ?> >&nbsp; သေဘာတူသည္ &nbsp; &nbsp; &nbsp; <input type="radio" value="notallow" name="approve_status" <?php echo ($row->approve_status=="notallow")?'checked':'' ?>>&nbsp; သေဘာမတူပါ &nbsp; &nbsp; &nbsp; <br/> <br/>
                                
                               
                                <div class="col-md-3"></div>
                                <!--<div class="col-md-2">-->
                                <!--     မန္ေနဂ်ာလက္မွတ္-->
                                <!--</div>-->
                                <!--<div class="col-md-4">-->
                                <!--    <input autofocus="" style="width: 150px" size='10' id="manager_sign" name="manager_sign" type="file" class="filestyle" value="<?php echo set_value('manager_sign'); ?>" /> -->
                                <!--</div>-->
                               
                               <div class="col-md-3"></div>
                            </div>

                        <div class="col-md-12 box-footer text-center">
                            <button type="submit" class="btn btn-info"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>   
            </div>  
             
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#dob,#entryDate,#leavefrom,#leaveto,#leavedate,#applydate').datepicker({
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
