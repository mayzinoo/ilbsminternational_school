
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small> </h1>

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
                    <form id='form1' action="<?php echo site_url('admin/stdtransfer/index') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">                                   
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>

                                 <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>School</label>
                                                <?=form_dropdown("school",$school,set_value("school"),"class='form-control'")?>
                                                <span class="text-danger"><?php echo form_error('school'); ?></span>
                                            </div>   
                                        </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right"><?php echo $this->lang->line('array_search(needle, haystack)'); ?><?php echo $this->lang->line('search'); ?></
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (isset($resultlist)) {
                ?>
                <input type="hidden" class="class_post" value="<?php echo $class_post; ?>" >
                <input type="hidden" class="section_post" value="<?php echo $section_post; ?>" >
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> <?php echo $this->lang->line('promote_students_in_next_session'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="#"  method="post" accept-charset="utf-8" class="promote_form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('promote_in_session'); ?> </label>
                                        <select  id="session_id" name="session_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($sessionlist as $session) {
                                                ?>
                                                <option value="<?php echo $session['id'] ?>" ><?php echo $session['session'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger" id="session_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select  id="class_promote_id" name="class_promote_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" ><?php echo $class['class'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger" id="class_promote_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_promote_id" name="section_promote_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger" id="section_promote_id_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">    
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                            <th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>
                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th>Inter Class</th>
                                            <th class=""><?php echo $this->lang->line('current'); ?> <?php echo $this->lang->line('result'); ?></th>
                                            <th class=""><?php echo $this->lang->line('next_session_status'); ?></th>
                                                <th width="2%"></th>
                                        </tr>
                                        <?php if (empty($resultlist)) {
                                            ?>
                                            <tr>
                                                <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                            </tr>
                                            <?php
                                        } else {
                                            $count = 1;
                                            foreach ($resultlist as $student) {
                                                ?>
                                         
                                            <tr>

                                                <td>
                                            <input type="hidden" value="<?php echo $student['id']; ?>">
                                            <input type="hidden" name="student_list[]" value="<?php echo $student['id']; ?>">
                                                <?php echo $student['admission_no']; ?></td>
                                                <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
                                                <td><?php echo $student['father_name']; ?></td>
                                                <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                                <td>                                             
                                                <?php 
                                                
                                                echo form_dropdown("inter_class",$inter_class,set_value("inter_class",$student["inter_class"]),"class='form-control'");?>
                                                </td>

                                                <td>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="result_<?php echo $student['id']; ?>" checked="checked" value="pass">
                                                            <?php echo $this->lang->line('pass'); ?>
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio"  name="result_<?php echo $student['id']; ?>" value="fail">
                                                            <?php echo $this->lang->line('fail'); ?>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="next_working_<?php echo $student['id']; ?>" checked="checked" value="countinue">
                                                            <?php echo $this->lang->line('continue'); ?>
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="next_working_<?php echo $student['id']; ?>" value="leave">
                                                            <?php echo $this->lang->line('leave'); ?>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td ><i class="fa fa-trash" onclick="removerform(event)"></i></td>

                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>    
                    </div>
                    </form>
                    <div class="box-footer clearfix" >
                        <?php
                        if (!empty($resultlist)) {
                            ?>

                            <a class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#pramoteStudentModal"><?php echo $this->lang->line('promote'); ?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div> 
                <?php
            } else {
                
            }
            ?>
    </section>
</div>

<!--==confirm modal===-->


<div class="modal" id="pramoteStudentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Promote Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure! You want to promote students?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pramote_student"><?php echo $this->lang->line('save'); ?></button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--===-->

<script type="text/javascript">
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
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
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

    $(document).on('change', '#class_promote_id', function (e) {
        $('#section_promote_id').html("");
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
                $('#section_promote_id').append(div_data);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#pramoteStudentModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })

        $('#pramoteStudentModal').on('click', '.pramote_student', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var datastring = $(".promote_form").serialize();
            var class_promote = $(".class_promote_id").val();
            var section_promote = $(".section_promote_id").val();
            var class_post = $(".class_post").val();
            var section_post = $(".section_post").val();
            $.ajax({
                type: "POST",

                url: '<?php echo site_url("admin/stdtransfer/promote") ?>',
                data: datastring + '&class_post=' + class_post + '&section_post=' + section_post,
                beforeSend: function () {

                    $modalDiv.addClass('modal_loading');
                },
                success: function (data) {
                    $('.sessionmodal_body').html(data);
                    var data = (JSON.parse(data));
                    if (data.status == "fail") {
                        $.each(data.msg, function (index, value) {
                            var errorDiv = '#' + index + '_error';

                            $(errorDiv).addClass('required');
                            $(errorDiv).empty().append(value);
                        });

                    } else {
                        successMsg("Students are successfully promoted");
                        location.reload(true);

                    }
                    $('#pramoteStudentModal').modal('hide');
                },
                error: function (xhr) { // if error occured
                    $modalDiv.removeClass('modal_loading');
                },
                complete: function () {
                    $modalDiv.removeClass('modal_loading');
                },
            });

        });

    });
</script>

