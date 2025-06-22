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
            <i class="fa fa-mortar-board"></i> Inventory <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>Inventory/insert_data/sale_form" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Sale Form" >
                                <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                            </a>
                        </div>
                    </div>
                    
                <div class="box-body">
                    <div class="row">
                    
                        <form id="saleperson">
                            <div class="col-md-3">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Sale Person (or) Sale Title</label>
                            <input type="text" name="sale_person" onkeyup="searchdata('saleperson')" class="form-control">
                            <span class="text-danger"><?php echo form_error('sale_person'); ?></span>
                            </div>
                            </div>
                            
                            <div class="col-md-2">
                            <div class="form-group">
                            
                            <label for="exampleInputEmail1"></label>
                            <br/>
                            <button type="button" name="search" onclick="searchdata('saleperson')" value="search" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                            </div>
                            </div> 
                            <div class="col-md-1"></div>
                        </form>
                        
                        <form id="sale">
                            <div class="col-md-2">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Start Date</label>
                            <input type="text" id="date" name="start_date" class="form-control" required>
                            <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                            </div>
                            </div>
                            
                            <div class="col-md-2">
                            <div class="form-group">
                            <label for="exampleInputEmail1">End Date</label>
                            <input id="end_date" type="text" name="end_date"  class="form-control" required>
                            <span class="text-danger"><?php echo form_error('end_date'); ?></span>
                            </div>
                            </div>
                            
                            <div class="col-md-2">
                            <div class="form-group">
                            
                            <label for="exampleInputEmail1"></label>
                            <br/>
                            <button type="button" name="search" onclick="searchdata('sale')"  value="search" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                            </div>
                            </div> 
                            <div class="col-md-1"></div>
                        </form>
                </div>
            </div>
                </div>

                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> Sale </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                          
<table class="table table-striped table-bordered table-hover example">
    <thead>
        <tr>
            <th>No</th>
            <th>Sale Title</th>
            <th>Sale Person </th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>  

    <tbody id="content">    
        <?php
        $count = 1;
        foreach ($resultlist->result() as $list) {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $list->title; ?></td>
            <td><?php echo $list->sale_person; ?></td>
            <td><?php echo $list->customer_name; ?></td>
            <td><?php echo $list->date; ?></td>
            
            <td> 
                <a href="<?php echo base_url(); ?>Inventory/view/sale/<?php echo $list->id; ?>" class="btn btn-default btn-xs" target="_blank" data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                    <i class="fa fa-reorder"></i>
                </a>
                <a title="Print" target="_blank" href="<?php echo base_url(); ?>Inventory/printvoc/sale/<?php echo $list->id; ?>/<?php echo $student['student_id']?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
                <i class="fa fa-print"></i>
                </a>
                <a href="<?php echo base_url(); ?>Inventory/edit_data/sale/<?php echo $list->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="<?php echo base_url(); ?>Inventory/delete_data/sale/<?php echo $list->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                    <i class="fa fa-remove"></i>
                </a>
            </td>
        </tr>
        
        <?php
        $count++;
        }
        ?>
    </tbody>



</table>


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
                    
                   $('#date,#end_date,#start_date').datepicker({
                    //  format: "dd-mm-yyyy",
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