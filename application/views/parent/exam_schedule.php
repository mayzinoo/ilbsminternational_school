<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><</small>         </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                
               
                </div>
                <?php
                if (isset($examSchedule)) {
                    ?>
                    <div class="box box-info">
                       
                        <div class="box-body table-responsive">
						<div class="download_label"><?php echo $this->lang->line('exam_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th><?php echo $this->lang->line('exam'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>    
                                <tbody>
                                    <?php
                                    if (empty($examSchedule)) {
                                        ?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                    </tfoot>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($examSchedule as $exam) {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?>.</td>
                                            <td><?php echo $exam['name']; ?></td>
                                            <td class="pull-right">
                                                <a  class="btn btn-primary btn-sm schedule_modal" data-toggle="tooltip" title="" data-examname="<?php echo $exam['name']; ?>" data-examid="<?php echo $exam['exam_id']; ?>" data-original-title="<?php echo $this->lang->line('view_detail'); ?>" data-sectionid='<?php echo $section_id ?>' data-classid='<?php echo $class_id ?>' data-classname="<?php echo $exam['class_name'] ?>"  data-sectionname="<?php echo $exam['section_name'] ?>">
                                                    <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('view'); ?>
                                                </a>

                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                                </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            
        }
        ?>
    </section>
</div>
<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "teacher/sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }
    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "teacher/sections/getByClass",
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
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "teacher/feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });
                    $('#feetype_id').append(div_data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy',]) ?>';
    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title').html("");
        var exam_id = $(this).data('examid');
        var examname = $(this).data('examname');
        var section_id = $(this).data('sectionid');
        var class_id = $(this).data('classid');
        var classname = $(this).data('classname');
        var sectionname = $(this).data('sectionname');
        $('.modal-title').html("<?php echo $this->lang->line('exam'); ?> " + examname);
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "parent/Parents/getexamscheduledetail",
            data: {'exam_id': exam_id, 'section_id': section_id, 'class_id': class_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="table-responsive">';
                data += "<p class='lead titlefix pt0'><?php echo $this->lang->line('class'); ?>: " + classname + "(" + sectionname + ")</p>";
                data += '<table class="table table-hover sss">';
                data += '<thead>';
                data += '<tr>';
                data += "<th><?php echo $this->lang->line('subject'); ?></th>";
                data += "<th><?php echo $this->lang->line('date'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('start_time'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('end_time'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('room'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('full_marks'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('passing_marks'); ?></th>";
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    var now = new Date(obj.date_of_exam);
                    var str = now.toString(date_format);
                    var date = Date.parse(str);
                    date_formatted = (date.toString(date_format));
                    data += '<tr>';
                    data += '<td class="">' + obj.name + ' (' + obj.type.substring(2, 0) + '.)</td>';
                    data += '<td class="">' + date_formatted + '</td> ';
                    data += '<td style="width:200px;" class="text text-center">' + obj.start_to + '</td> ';
                    data += '<td style="width:200px;" class="text text-center">' + obj.end_from + '</td> ';
                    data += '<td class="text text-center">' + obj.room_no + '</td> ';
                    data += '<td class="text text-center">' + obj.full_marks + '</td>';
                    data += '<td class="text text-center">' + obj.passing_marks + '</td>';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '</div>  ';
                $('.modal-body').html(data);
                //===========

                var dtable = $('.sss').DataTable();
                $('div.dataTables_filter input').attr('placeholder', 'Search...');
                new $.fn.dataTable.Buttons(dtable, {

                    buttons: [

                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            titleAttr: 'Columns',
                            postfixButtons: ['colvisRestore']
                        },
                    ]
                });

                dtable.buttons(0, null).container().prependTo(
                        dtable.table().container()
                        );

//===========
                $("#scheduleModal").modal('show');
            }
        });
    });
</script>
<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>