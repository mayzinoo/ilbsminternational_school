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
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title"><?php echo $this->lang->line('add_teacher'); ?></h3> -->
                        <h3 class="box-title">Purchase Detail</h3>
                    </div> 
                    
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>        
                            <?php echo $this->customlib->getCSRF(); ?>


                            <div class="form-group col-md-6">
                                Purchase Requisition (Indent) Form <br/>
                                <?=$row->form_no?>               
                            </div>

                            <div class="col-md-2"></div>

                            <div class="form-group col-md-2">
                                <br/>
                                No <br/>
                                Reference <br/>
                                Date Required              
                            </div>
                            <div class="form-group col-md-2">
                                <br/>
                                : - <br/>
                                : - <br/>
                                : <?=$row->date?>
                            </div>

                            <div class="form-group col-md-6">
                                <br/>
                                <table class="table">                               
                                    <tr>
                                     <td align="center">Requested By</td>
                                     <td><?=$row->requested_school?></td>
                                    </tr> 
                                    <tr>
                                     <td>Business Unit:  <?=$row->business_unit?></td>   
                                     <td>Department:   <?=$row->department?></td>                  
                                    </tr>                             
                            </table>                             
                            </div>                            

                            <div class="form-group col-md-6">     </div>

                            <div class="form-group col-md-12">
                                <table class="table">                               
                                    <tr>
                                     <td>No</td>
                                     <td>Description</td>
                                     <td>Unit</td>
                                     <td>Quantity</td>
                                     <td>Remark</td>
                                    </tr> 
                                    <?php $no=1; foreach ($lists->result() as $list): ?>
                                       
                                    <tr>
                                     <td><?=$no?></td>   
                                     <td><?=$list->item_name?></td> 
                                     <td><?=$list->unit?></td>  
                                     <td><?=$list->quantity?></td> 
                                     <td><?=$list->remark?></td>                           
                                    </tr> 
                                    <?php $no++; endforeach; ?>     

                                    <tr>
                                     <td></td> <td></td> <td></td> <td></td> <td></td> 
                                    </tr>
                                    <tr>
                                     <td></td> <td></td> <td></td> <td></td> <td></td> 
                                    </tr> 
                                    <tr>
                                     <td></td> <td></td> <td></td> <td></td> <td></td> 
                                    </tr> 
                                    <tr>
                                     <td></td> <td></td> <td></td> <td></td> <td></td> 
                                    </tr>  

                                </table>
                            </div>

                            <div class="form-group col-md-12">
                                <table class="table">                               
                                    <tr>
                                     <td rowspan="4"> Requested by <br/> <br/> <br/> Name: <?=$row->requested_by?> <br/> Date: <?=$row->date?></td>
                                     <td rowspan="4">Certified by <br/> (Dept. Head) <br/> <br/> Name: <?=$row->certified_by?> <br/> Date: <?=$row->certified_date?> </td>
                                     <td rowspan="4">Checked by <br/> (AP. Head) <br/> <br/> Name: <?=$row->checked_by?> <br/> Date: <?=$row->checked_date?> </td>
                                     <td rowspan="4">Approved by <br/> Management <br/> <br/> Name: <?=$row->approved_by?> <br/> Date: <?=$row->approved_date?></td>                        
                                    </tr>                                       

                                </table>
                                
                            </div>
                            
                         <div class="form-group col-md-6">     </div>   

                                                                             
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
