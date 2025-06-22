<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> Inter <?php echo $this->lang->line('examinations'); ?> Schedules  </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- Large modal -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>admin/Inter_examSchedule/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></a>
                        </div>
                    </div>
                    <form action="<?php echo site_url('admin/Inter_examSchedule/index') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                 <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Inter Class</label>
                                             <?php echo form_dropdown("inter_class",$inter_classes,set_value("inter_class"),"class='form-control'");?>

                                                <span class="text-danger"><?php echo form_error('inter_class'); ?></span>
                                            </div>
                                        </div>
                                        
                                        
                                          <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">School</label>
                                             <?php echo form_dropdown("school",$schools,set_value("school"),"class='form-control'");?>

                                                <span class="text-danger"><?php echo form_error('school'); ?></span>
                                            </div>
                                        </div>
                                <div class="col-md-4">
                                      <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                                </div><!-- /.col -->
                                   
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                     
                    </form>
                </div>
                <?php
                if (isset($examSchedule)) {
                    ?>
                    <div class="box box-info">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-list"></i> <?php echo $this->lang->line('exam_list'); ?> </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body table-responsive">
						<div class="download_label"><?php echo $this->lang->line('exam_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th><?php echo $this->lang->line('exam'); ?></th>
                                        <th>Inter Class</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        <th class="text-right">Edit/Delete</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                    <?php
                                    if (empty($examSchedule)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($examSchedule as $exam) {
                                            ?>

                                            <tr>
                                                <td><?php echo $count; ?>.</td>
                                                <td><?php echo $exam['name']; ?></td>
                                                <td><?php echo $exam['inter_class']; ?></td>
                                                <td class="pull-right">
                                                    <a  class="btn btn-primary btn-sm schedule_modal" data-toggle="tooltip" title="" 
                                                    data-examname="<?php echo $exam['name']; ?>" data-examid="<?php echo $exam['id']; ?>"
                                                    data-original-title="<?php echo $this->lang->line('view_detail'); ?>" data-interclass='<?php echo $exam["inter_class"] ?>' data-school="<?php echo $exam['school'] ?>" >
                                                        <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('view'); ?>
                                                    </a>

                                                </td>
                                            <td class="mailbox-date no-print text text-right">
                                                <a href="<?php echo base_url(); ?>admin/Inter_examSchedule/edit/<?php echo $exam['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/Inter_examSchedule/delete/<?php echo $exam['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-remove"></i>
                                                </a>

                                            </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>


                                </tbody></table>
                        </div><!---./end box-body--->
                    </div>
                </div>

                <!-- right column -->

            </div>   <!-- /.row -->
            <?php
        } else {
            
        }
        ?>

    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title').html("");
        var examname = '<?php echo $exam['name'] ?>';
        var header_id = $(this).data('examid');
        var inter_class = $(this).data('interclass');
        var school = $(this).data('school');
        $('.modal-title').html("<?php echo $this->lang->line('exam'); ?> " + examname);
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "admin/Inter_examSchedule/getInterDetailbyClsandSection",
            data: {'header_id': header_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="table-responsive">';
                data += "<p class='lead titlefix pt0'> Class : " + inter_class + "</p>";
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
                    data += '<tr>';
                    data += '<td class="">' + obj.sname + '</td>';
                    data += '<td class="">' + obj.date_of_exam + '</td> ';
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

