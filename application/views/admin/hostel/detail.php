<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-building-o"></i> Hostel Info
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4><?php echo $hosteldata->hostel_name; ?></h4>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="">
                        <table class="table" width="100%">
                            <tr>
                                <td style="width:30%;">Hostel Name</td>
                                <td>:</td>
                                <td><?php echo $hosteldata->hostel_name; ?></td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>:</td>
                                <td><?php echo $hosteldata->type; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $hosteldata->address; ?></td>
                            </tr>
                            <tr>
                                <td>Intake</td>
                                <td>:</td>
                                <td><?php echo $hosteldata->intake; ?></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td><?php echo $hosteldata->description; ?></td>
                            </tr>
                            <tr>
                                <td>Warden Teacher</td>
                                <td>:</td>
                                <td>
                                    <?php 
							            $warden = explode(']', $hosteldata->hostel_warden);

							            for($i=1;$i<count($warden);$i++)
							            {
							              $teach1 = explode(',', $warden[$i-1]);

							                 ?> 
											<?=$teach1[0]?> ,<?=$teach1[1]?>,

										<?php } ?>
                                    
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Guide Teacher</td>
                                <td>:</td>
                                <td>
                                    <?php 
							            $guide = explode(']', $hosteldata->guide_teacher);

							            for($i=1;$i<count($guide);$i++)
							            {
							              $teach2 = explode(',', $guide[$i-1]);

							                 ?> 
											<?=$teach2[0]?> ,<?=$teach2[1]?> ,

										<?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
<!--            <!--/.col (left) -->
        </div>
        <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
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
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>