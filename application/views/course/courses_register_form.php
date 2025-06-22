<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    
    #photo img
    {
        width:100px;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Courses <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
            <div class="col-md-12">           
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Course Register Form</h3>
                    </div> 
                    <?=form_open_multipart("course/create_courses_register","")?>
                    
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Choose Student</label>
                                
                                <?php echo form_dropdown("student_id",$studentlist,'','class="form-control" onchange="getstudentdata(this.value)"'); ?>
                                
                                <span class="text-danger"><?php echo form_error('student_id'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Student Name</label>
                                <input autofocus="" id="name" name="name" placeholder="Student Name" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">NRC No</label>
                                <input autofocus="" id="nrc" name="nrc" placeholder="NRC No" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('nrc'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Parent</label>
                                <input autofocus="" id="parent" name="parent" placeholder="Parent" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('nrc'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Phone</label>
                                <input autofocus="" id="phone" name="phone" placeholder="Phone" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('phone'); ?></span>
                            </div>
                            
                            
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea name="address" id="address" class="form-control">
                                    <?php echo set_value('address'); ?>
                                </textarea>
                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Email</label>
                                <input autofocus="" id="email" name="email" placeholder="Email" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                            
                            <!--<div class="form-group col-md-6">-->
                            <!--    <label for="exampleInputEmail1">Photo</label>-->
                            <!--    <input name="student_photo" placeholder="" type="file" class="filestyle form-control" />-->
                            <!--    <span class="text-danger"><?php echo form_error('photo'); ?></span>-->
                            <!--    <div id="photo"> </div>-->
                            <!--</div>-->
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Lectured Course</label>
                                
                                <?php echo form_dropdown("lecture_course_id",$courselists,'','class="form-control" onchange="getFees(this.value)"'); ?>
                                
                                <span class="text-danger"><?php echo form_error('lecture_course_id'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Course Fees</label>
                                <input autofocus="" id="fees" name="fees" placeholder="" value=0 type="text" class="form-control" readonly />
                                <span class="text-danger"><?php echo form_error('fees'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Register Date</label>
                                <input autofocus="" id="register_date" name="register_date" placeholder="Register Date" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('register_date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Start Date</label>
                                <input autofocus="" id="start_date" name="start_date" placeholder="start date" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">End Date</label>
                                <input autofocus="" id="end_date" name="end_date" placeholder="End Date" type="text" class="form-control" />
                                <span class="text-danger"><?php echo form_error('end_date'); ?></span>
                            </div>
                            
                             
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
        $('#start_date,#end_date,#register_date,#startDateofTeaching').datepicker({
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
<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
