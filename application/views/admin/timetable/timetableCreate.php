<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <form action="<?php echo site_url('admin/timetable/create') ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-3">                                   
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>><?php echo $class['class'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                
                                   <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Inter Class</label>
                                             <?php echo form_dropdown("inter_class",$inter_class,set_value("inter_class"),"class='form-control'");?>

                                                <span class="text-danger"><?php echo form_error('inter_class'); ?></span>
                                            </div>
                                        </div>
                                
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Acedamic Year</label>
                                        
                                        <!--<input name="acedamic_year" type="text" value="2018-2019" class="form-control" readonly="">-->
                                         <?=$academic_year?>
                                        <?php echo form_dropdown("academic_year",$session_lists,$academic_year,"class='form-control'"); ?>
                                        
                                        <span class="text-danger" ><?php echo form_error('academic_year'); ?></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right"><?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
               
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('class_timetable'); ?></h3>
                        </div>
                        <div class="box-body">
                            
                                <form role="form" id=""  class="addmarks-form"  method="post" action="<?php echo site_url('admin/timetable/insert_timetable') ?>">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?=$class_id?>" >
                                    <input type="hidden" name="inter_class" value="<?=$inter_class?>" >
                                    <input type="hidden" name="section_id" value="<?=$section_id?>" >
                                    <input type="hidden" name="academic_year" value="<?=$academic_year?>" >
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        
                                                    </th>
                                                    <th>
                                                        From
                                                    </th>
                                                    
                                                    <?php
                                                        for($i=1;$i<10;$i++)
                                                        {
                                                    ?>
                                                    <th>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="timestart<?=$i?>" class="form-control timepicker" id="stime_" >
                                                                        <!--<div class="input-group-addon">-->
                                                                        <!--    <i class="fa fa-clock-o"></i>-->
                                                                        <!--</div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </th>
                                                    <?php } ?>
                                           
                                                </tr>
                                                <tr>
                                                    <th>
                                                       
                                                    </th>
                                                    <th>
                                                       To 
                                                    </th>
                                                    
                                                    <?php
                                                        for($i=1;$i<10;$i++)
                                                        {
                                                    ?>
                                                    <th>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="timeend<?=$i?>" class="form-control timepicker" id="stime_" >
                                                                        <!--<div class="input-group-addon">-->
                                                                        <!--    <i class="fa fa-clock-o"></i>-->
                                                                        <!--</div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </th>
                                                    <?php } ?>
                                           
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                   <?php
                                                   
                                                    if (!empty($getDaysnameList)) {
                                                        
                                                        foreach ($getDaysnameList as $key => $value) {
                                                            ?>

                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" name="<?=$key?>" value="<?=$key?>" checked>
                                                            </th>
                                                            
                                                            <th>
                                                            <?php echo $key; ?>
                                                            </th>
                                                            
                                                            <?php
                                                               for($j=1;$j<10;$j++)
                                                        { 
                                                            ?>
                                                            <th>
                                            <div class="form-group">
                                                <?=form_dropdown($key.'sec'.$j,$subjects,"","class='form-control' id='subject_id'")?>
                                                
                                        <span class="text-danger"><?php echo form_error($key.'tec'.$j); ?></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                <?=form_dropdown($key.'tec'.$j,$teachers,"","class='form-control' id='teacher_id'")?>
                                                
                                        <span class="text-danger"><?php echo form_error($key.'tec'.$j); ?></span>
                                                        </div>
                                                        
                                                            </th>
                                                            <?php
                                                                }
                                                               ?>
                                                 
                                                            </tr>
                                                            <?php
                                                                }
                                                            } 
                                                            ?>
                                                    
                                                 
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right" name="save_exam" value="save_exam"><?php echo $this->lang->line('save'); ?></button>
                                </form>
                                
                        </div>
                    </div>
                </div> 
            </div> 
           
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
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
        $(document).on('change', '#section_id', function (e) {
            $('#subject_id').html("");
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subject_id').append(div_data);
                }
            });
        });
    });
</script>

<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    $(function () {

        $(".timepicker").timepicker({
            showInputs: false,
            defaultTime: false,
            explicitMode: false,
            minuteStep: 1
        });
    });

    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        var subject_id = '<?php echo set_value('subject_id') ?>';
        getSectionByClass(class_id, section_id);
        getSubjectByClassandSection(class_id, section_id, subject_id);
    });

    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
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

    function getSubjectByClassandSection(class_id, section_id, subject_id) {
        console.log("rrrr");
        if (class_id != "" && section_id != "" && subject_id != "") {
            $('#subject_id').html("");
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subject_id == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subject_id').append(div_data);
                }
            });
        }
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>