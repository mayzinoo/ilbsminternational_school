<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    
    .btn-primary, .btn-success
    {
        width:100px;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Online CV From ILBSM Website <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
       
            <div class="col-md-12">              
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Online Recruitment Lists</h3>
                        <h3 style="color:red"><?=$message?></h3>

                                           </div>
                    <div class="box-body">

                  
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
						<div class="download_label"><?php echo $this->lang->line('teacher_list'); ?> </div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Apply Position</th>
                                        <th>Expected Salary</th>
                                        <th>Education</th>
                                        <th>Upload CV</th>
                                        <th>Replied Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($lists->result() as $list) {
                                        ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td class="mailbox-name"> <?php echo $list->name; ?></td>
                                            <td class="mailbox-name"> <?php echo $list->father_name; ?></td>
                                            <td class="mailbox-name"> <?=$list->apply_position?></td>
                                            <td class="mailbox-name"> <?php echo $list->expected_salary ?></td>
                                            <td class="mailbox-name"> <?php echo $list->education ?></td>
                                            <td class="mailbox-name"> <a href="http://ilbsm.itcurrent.com/assets/images/job/<?=$list->uploadcv?>" download=""> Download CV</a> </td>
                                            <td>
                                            <?php if($list->reply_status==1)
                                            { ?>
                                            
                                                <?=$list->reply_message?>
                                            
                                            <?php } else echo "-";
                                            ?>
                                            </td>
                                              <td>
                                            <?php if($list->reply_status==0)
                                            { ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mailreply<?=$list->id?>">Reply Now</button>
                                           <?php } 
                                            else{ ?>
                                            <button type="button" class="btn btn-success" >Replied</button>
                                           <?php } ?>
                                            </td>
                                    <div class="modal fade" id="mailreply<?=$list->id?>" role="dialog">
            								<div class="modal-dialog">
            
            									<!-- Modal content-->
            									<div class="modal-content">
            										<div class="modal-header">
            											<button type="button" class="close" data-dismiss="modal">&times;</button>
            											 <h4 class="modal-title">Applied for <?=$list->apply_position?> Position</h4> 
            										</div>
            										
            										<div class="modal-body">
            										    <?php echo form_open("admin/admin/mailreply/onlinecv"); ?>
            								<input type="hidden" name="subject" value="<?=$list->subject?>">
            								<input type="hidden" name="id" value="<?=$list->id?>">
                                                        Reply To <input type="text" name="replyto" class="form-control" value="<?=$list->email?>" />
                                                         Message <textarea name="message" class="form-control"></textarea>
                                                         <!--Reply By <input type="text" name="reply_by" class="form-control">-->
            										
            										<div style="margin-top:10px" class="footer text-right">	<input type="submit" class="btn btn-success " value="Send" />
            										</div>
            											<?php echo form_close(); ?> 
            										</div>
            									</div>
            
            								</div>
							            </div>
                                           
                                        </tr>
                                        <?php
                                        $count++;

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#dob,#admission_date').datepicker({
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
