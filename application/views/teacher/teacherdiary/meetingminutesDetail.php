<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }

    table, th, td {
    border: 1px solid black !important;
    border-collapse: collapse;
}


td, th
{
    height: 30px;
}

</style>

<div class="content-wrapper" style="min-height: 946px;">  
    
    <!-- Main content -->
    <section class="content">
        <div class="row">       
            <div class="col-md-12">           
                <div class="box box-primary">
                    <div class="box-header with-border text-center">
                        <!-- <h3 class="box-title"><?php echo $this->lang->line('add_teacher'); ?></h3> -->
                        <h3 class="box-title">Meeting Minute Records</h3> <br/>
                        
                    </div> 
                    
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>


                            <div class="form-group col-md-1">
                                Date <br/>
                                Place <br/>
                            </div>

                            <div class="form-group col-md-5">
                                <?=": ".$row->date?> <br/> 
                                <?=": ".$row->place?> <br/>                                         
                            </div> 

                            <div class="form-group col-md-1">
                                Opening <br/>
                                Closing <br/>
                            </div>

                            <div class="form-group col-md-5">
                                <?=": ".$row->opening_time?> <br/> 
                                <?=": ".$row->closing_time?> <br/>                                         
                            </div> 

                            <div class="form-group col-md-12">
                                အေၾကာင္းအရာ ။ &nbsp; &nbsp; &nbsp; ။  <?=$row->description?>
                            </div>

                            <div class="form-group col-md-12">
                                တက္ေရာက္သူစာရင္း
                            </div>
                                                                              
                            <div class="form-group col-md-12">
                                <table class="table">                               
                                    <tr>
                                     <td>စဥ္</td>
                                     <td>နာမည္</td>
                                     <td>လက္မွတ္</td>                                     
                                    </tr>
                                    <?php $i=1; foreach($teachers->result() as $list):?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$list->name?></td>
                                        <td><?=$list->sign?></td>
                                    </tr>
                                    <?php $i++; endforeach; ?>                                   
                                </table>
                            </div> <br/> <br/>

                            <div class="form-group col-md-2">
                                Prepared by <br/>                                      
                            </div>

                            <div class="form-group col-md-2">
                                <?=": ".$row->prepared_by?> <br/>                             
                            </div>

                            <div class="col-md-2"></div>

                            <div class="form-group col-md-2">
                                Approved by <br/>                                      
                            </div>

                            <div class="form-group col-md-2">
                                <?=": ".$row->approved_by?> <br/>                             
                            </div>

                            <div class="col-md-2"></div>
                                                    
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
