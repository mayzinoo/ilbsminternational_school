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
            <i class="fa fa-mortar-board"></i> Installment <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
            <div class="col-md-12">           
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Installment Form</h3>
                    </div> 
                    <form id="form1" action="<?php echo site_url('Installment/create_install_plan') ?>" name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>

                           <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Installment Name</label>
                                <input autofocus="" name="name" placeholder="Installment Name" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                           
                           <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Class</label>
                                <?=form_dropdown("class",$classlist,$class_id,"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Academic year</label>
                                <?=form_dropdown("session",$sessionlist,$session_id,"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('session'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Date</label>
                                <input autofocus="" id="end_date" name="date" placeholder="choose date" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Fees</label>
                                <input autofocus="" name="fees" placeholder="fees" type="text" class="form-control"  value="<?php echo set_value('fees'); ?>" />
                                <span class="text-danger"><?php echo form_error('fees'); ?></span>
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
