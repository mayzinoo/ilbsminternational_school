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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> Installment <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                            <!--<a href="<?php echo base_url(); ?>Course/insert_data/courses_feebalance_form" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Course Fee Balance Form" >-->
                            <!--    <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>-->
                            <!--</a>-->
                        </div>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/teaattendence/leavereport') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                
                                <!--<div class="col-md-4">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="exampleInputEmail1"><?php echo $this->lang->line('month'); ?></label>-->
                                <!--        <select  id="month" name="month" class="form-control" >-->
                                <!--            <option value=""><?php echo $this->lang->line('select'); ?></option>-->
                                
                                <!--            foreach ($monthlist as $m_key => $month) {-->
                                <!--                ?>-->
                                <!--                <option value="<?php echo $m_key ?>" 
                                <!--                if ($month_selected == $m_key) {-->
                                <!--                    echo "selected =selected";-->
                                <!--                }-->
                                <!--                ?>><?php echo $month; ?></option>-->
                                <!--                        
                                <!--                        $count++;-->
                                <!--                    }-->
                                <!--                    ?>-->
                                <!--        </select>-->
                                <!--        <span class="text-danger"><?php echo form_error('month'); ?></span>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <!--<div class="box-footer">-->
                        <!--    <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>-->
                        <!--</div>-->
                    </form>
                </div>


               
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('Leave'); ?> <?php echo $this->lang->line('list'); ?> </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                             <!--<div class="container">-->
    
<table class="table example">
    <thead>
        <tr>
            <th>No</th>
            <th>Installment Plan</th>
            <th>Student Name</th>
            <th>Fees</th>
            <th>Pay Amount</th>
            <th>Payment Status </th>
            <th>Balance</th>
            <th>Due Date</th>
            <th>Action</th>
        </tr>
    </thead>  

    <tbody>    
        <?php
        $count = 1;
        $total=0;
        foreach ($resultlist->result() as $list) {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $list->name; ?></td>
            <td><?php echo $list->fname.$list->lname; ?></td>
            <td><?php echo $list->fee; ?></td>
            <td><?php echo $list->pay_amount; ?></td>
            <?php if($list->status==0){ ?>
            <td> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pay<?=$list->id?>">Pay Now</button>
            
            <div class="modal fade" id="pay<?=$list->id?>" role="dialog">
            								<div class="modal-dialog">
            
            									<!-- Modal content-->
            									<div class="modal-content">
            										<div class="modal-header">
            											<button type="button" class="close" data-dismiss="modal">&times;</button>
            											 <h4 class="modal-title">Student Fee Receive Form</h4> 
            										</div>
            										
            										<div class="modal-body">
            										    <?php echo form_open("Installment/insert_receive","receipt_form"); ?>
            								<input type="hidden" name="id" value="<?=$list->id?>">
                                                        <!--Previous Balance -->
                                                   
                                                                                          <input type="hidden" name="dpercent" id="dpercent<?=$list->id?>" value=0 >
                                                      
                                                      <input type="hidden" name="discount" id="discount<?=$list->id?>" value=0 >
                                                      
                                                    <div class="form-group"> 
                                                    <div class="col-md-12">  
                                                        Fees (To Pay)
                                                        <input type="text" id="final_fees<?=$list->id?>" name="final_fees" onkeyup="calculateBalance('<?=$list->id?>')" value="<?=$list->balance?>" class="form-control" readonly>
                                                   </div>
                                                   </div>
                                                   
                                                   <div class="form-group"> 
                                                        <div class="col-md-4"> 
                                                        Pay Amount <input type="text" name="pay_amt" onkeyup="calculateBalance('<?=$list->id?>')" value=0 id="pay_amt<?=$list->id?>" class="form-control" >
                                                    </div>
                                                    <div class="col-md-4"> 
                                                        Balance <input type="text" id="balance<?=$list->id?>" value="<?=$list->balance?>" name="balance" class="form-control" readonly> </div>
                                                        <div class="col-md-4"> 
                                                        Pay Date <input type="text" name="paydate" value="<?=date('d-m-Y')?>" id="paydate" class="form-control" readonly> </div>
                                                    </div>
                                                       
            										<div class="form-group"> 
            										<div style="margin-top:10px" class="footer text-right">	<input type="submit" class="btn btn-success " value="Send" />
            										</div>
            										</div>
            											<?php echo form_close(); ?> 
            										</div>
            									</div>
            
            								</div>
							            </div>
            </td>
            
            <?php }
            if($list->status==1)
            { ?>
            <td><a class="btn btn-success">Received</a></td>
            <?php } ?>
            <td><?php echo $list->balance; ?></td>
            <td><?php echo $list->due_date; ?></td>
            <td> 
                
                <a href="<?php echo base_url(); ?>Installment/delete/studentfee_balance/<?php echo $list->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                    <i class="fa fa-remove"></i>
                </a>
            </td>
            
        </tr>
        
        <?php
        $count++;
        $total+=$list->balance;
        }
        ?>
    </tbody>
    <tr>
        <td colspan="5"> </td> <th>Total Balance :</th> 
        <th><?=$total?></th>
    </tr>



</table>


        <!--</div>-->
                        </div>
                    </div>

                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    var section_id_post = '<?php echo $section_id; ?>';
                    var class_id_post = '<?php echo $class_id; ?>';
                    populateSection(section_id_post, class_id_post);
                    function populateSection(section_id_post, class_id_post) {
                        $('#section_id').html("");
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id_post},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    var select = "";
                                    if (section_id_post == obj.section_id) {
                                        var select = "selected=selected";
                                    }
                                    div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    }
                    $(document).on('change', '#class_id', function (e) {
                        $('#section_id').html("");
                        var class_id = $(this).val();
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    });
                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
                    $('#date').datepicker({
                        format: date_format,
                        autoclose: true
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
            
            <script type="text/javascript">
                    $(document).ready(function () {
                        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
                        $('#start_date,#end_date,#register_date,#paydate').datepicker({
                            format: date_format,
                            autoclose: true
                        });
                
                
                        $("#btnreset").click(function () {
                            $("#form1")[0].reset();
                        });
                    });
                </script>