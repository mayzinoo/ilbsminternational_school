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
            <i class="fa fa-mortar-board"></i> Courses Register Students<small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>Course/insert_data/courses_register_form" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Course Register Form" >
                                <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                            </a>
                        </div>
                    </div>
                    
                     <form id='form1' action="<?php echo site_url('Course/courses_register/search') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                
                               <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Course Name </label>
                                        <?=form_dropdown("course_id",$courselists,$course_id,"class='form-control'")?>
                                        
                                        <span class="text-danger"><?php echo form_error('course_id'); ?></span>
                                    </div>
                                </div>
                              
                                <!--<div class="col-md-4">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="exampleInputEmail1">Students </label>-->
                                <!--        <?=form_dropdown("student_id",$studentlist,$student_id,"class='form-control'")?>-->
                                        
                                <!--        <span class="text-danger"><?php echo form_error('student_id'); ?></span>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                    
                </div>


               
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('Leave'); ?> <?php echo $this->lang->line('list'); ?> </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                     
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>NRC No </th>
            <th>Parent Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Email</th>
            <!--<th>Photo</th>-->
            <th>Lecture Course</th>
            <th>Register Date</th>
            <th>Start Date </th>
            <th>End Date</th>
            <th>Action</th>
        </tr>
    </thead>  

    <tbody>    
        <?php
        $count = 1;
        foreach ($resultlist->result() as $list) {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $list->name; ?></td>
            <td><?php echo $list->nrc; ?></td>
            <td><?php echo $list->parent; ?></td>
            <td><?php echo $list->phone; ?></td>
            <td><?php echo $list->address; ?></td>
            <td><?php echo $list->email; ?></td>
            
            <td><?php echo $list->title; ?></td>
            <td><?php echo $list->register_date; ?></td>
            <td><?php echo $list->start_date; ?></td>
            <td><?php echo $list->end_date; ?></td>
            <td> 
                <a href="<?php echo base_url(); ?>Course/edit_data/courses_register/<?php echo $list->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="<?php echo base_url(); ?>Course/delete_data/courses_register/<?php echo $list->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
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