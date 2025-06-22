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
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
       
            <div class="col-md-12">              
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('teacher_list'); ?></h3>

                                           </div>
                    <div class="box-body">

                    <div class="row">
                    
                    <?=form_open("admin/Teacher/tearcher_report")?>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Location</label>
<?php echo form_dropdown("location",$school,set_value("location"),"class='form-control'"); ?>
<span class="text-danger"><?php echo form_error('location'); ?></span>
</div>
</div>

<div class="col-md-4">
<div class="form-group">

<label for="exampleInputEmail1"></label>
<br/>
<button type="submit" name="search" value="search" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</div>
<?=form_close()?>
</div>
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
						<div class="download_label"><?php echo $this->lang->line('teacher_list'); ?> </div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Teacher Name</th>
                                    <th>Degree</th>
                                    <th>Subjects</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($teacherlist as $teacher) {
                                        ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['education'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['primarySubject'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['currentsubject'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['gender'] ?></td>
                                            
                                            <td class="mailbox-date pull-right no-print">
                                              <a href="<?php echo base_url(); ?>admin/teacher/view/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Show">
                                                    <i class="fa fa-reorder"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;

                                    }
                                    ?>
                                    <tr>
                                        <th>Total : <?php echo $total->teatotal; ?></th>
                                        <th>Male : <?php echo $male->total; ?></th>
                                        <th>Female : <?php echo $female->total; ?></th>
                                    </tr>
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
