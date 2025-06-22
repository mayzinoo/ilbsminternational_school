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
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/teaattendence/attendencereport') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('month'); ?></label>
                                        <select  id="month" name="month" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($monthlist as $m_key => $month) {
                                                ?>
                                                <option value="<?php echo $m_key ?>" <?php
                                                if ($month_selected == $m_key) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $month; ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('month'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>


               
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('list'); ?> </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                             <div class="container">
    
<table class="table">
<thead>

<tr>
<th>No</th>
<th><?php echo $this->lang->line('name'); ?></th>
<th>Position</th>
<th> Date</th>
<th>In Time</th>
<th>Out Time</th>
</tr>
</thead>            
<tbody>    
<?php
$count = 1;
foreach ($resultlist->result() as $teacher) {


?>
<tr>
<td><?php   echo $count; ?></td>

<td><?php echo $teacher->name?></td>
<td><?php echo $teacher->position; ?></td>
<td><?php echo date("d-m-Y",strtotime($teacher->fcdate)); ?></td>
<td><?php echo date('h:i A', strtotime($teacher->in_time)); ?></td>
<td><?php if($teacher->out_time !="0000-00-00 00:00:00")  echo date('h:i A', strtotime($teacher->out_time));?></td>



</tr>
<?php
$count++;


}
?>
</tbody>



</table>



    </div>
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