<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
 
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.cb {
  display: none;
  border: 1px #dadada solid;
  z-index: 10000;
    position: absolute;
    background: white;
    width: 120px;
    padding-left: 10px;
top: 165px;
left: 700px;
}

#student
{
    display:none;
}

.cb label {
  display: block;
}

.cb label:hover {
  background-color: #1e90ff;
}
/*.classform .form-control{*/
/*    width:38%;*/
/*}*/

</style>
<script>
      var expanded = false;
function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

</script>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Payments <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
            <div class="col-md-12">           
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Monthly Fee</h3>
                    </div> 
                    <form id="form1" action="<?php echo site_url('Balance_fee/create') ?>" name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>

                           <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Type </label>
                                <br/>
                                <input autofocus="" name="fee_type"  type="radio" onclick="hidestudent()"  value="By class" /> By Class
                                <input autofocus="" name="fee_type"  type="radio" onclick="showstudent()"  value="By student" />
                                <span class="text-danger"><?php echo form_error('fee_type'); ?></span> By Student
                            </div>
                           
                           <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Class</label>
                                <?=form_dropdown("class_id",$classlist,"","class='form-control' onchange='getstudentLists(this.value)'")?>
                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>
                            
                            
                            
                            <div class="form-group col-md-6">
                                           
                                        <label>Payment For: </label>
                                          
                                          <div class="">
                                            <div class="selectBox" onclick="showCheckboxes()">
                                              <select class="form-control">
                                                <option>..Select Months..</option>
                                              </select>
                                              <div class="overSelect"></div>
                                            </div>
                                            
                                              </div>
                                          
                            </div>
                                        
                    						
                    						<!--Checkbox-->
                    						<div class="cb" id="checkboxes">
                                                <?php
                                             $month = array('January', 'February', 'March', 'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November', 'Decmber');
                                                 ?>
                                              
                                                 <?php for($i=0; $i<12; $i++)
                                                 { ?>
                                                      <label><input type="checkbox" name="month<?=$i?>" value="<?=$month[$i]?>" /> <?=$month[$i]?></label>
                                                      
                                                 <?php } ?>
                                 
                                        </div>
                            
                            
                            <div class="form-group col-md-6" id="student">
                                <label for="exampleInputEmail1">Choose Student</label>
                                
                                <select name="student_id" id="student_id" class="form-control">
                                              <option value="">...Select...</option>
                                            </select>
                                
                                <span class="text-danger"><?php echo form_error('student_id'); ?></span>
                            </div>
                            
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Fee groups</label>
                                <?=form_dropdown("feegroupid",$feegroups,"","class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('feegroupid'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Date</label>
                                <input autofocus="" id="end_date" name="date" placeholder="choose date" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                            
                           
    
                            <!--  <div class="form-group col-md-6">-->
                            <!--    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>-->
                            <!--    <textarea name="description" class="form-control">-->
                            <!--        <?php echo set_value('description'); ?>-->
                            <!--    </textarea>-->
                            <!--    <span class="text-danger"><?php echo form_error('description'); ?></span>-->
                            <!--</div>-->
                            
                             
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
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
        $('#start_date,#end_date,#startDateofTeaching').datepicker({
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
