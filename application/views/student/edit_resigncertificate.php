<style>
    .padding_md{
        padding-top:30px;
        padding-bottom:30px;
    }
</style>
<div class="content-wrapper">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
       
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!--<div class="pull-right box-tools" style="position: absolute;right: 14px;top: 13px;">-->
                    <!--    <a href="<?php echo site_url('student/import') ?>">-->
                    <!--        <button class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> <?php echo $this->lang->line('import_student'); ?></button>-->
                    <!--    </a>-->
                    <!--</div>-->

                    
                        <div class="box-body">

                            <div class="tshadow mb25 bozero">    

                                <h4 class="pagetitleh2">Resign For Certificate </h4>
                <div class="around10 padding_md">
                    <?=form_open_multipart('Student/edit_resigncertificate/')?>
                    <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Enter Date</label>
                                <input type="text" name="enter_date" class="form-control" id="admission_date" value="<?php echo $resignstudent->enter_date; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input list="browsers" type="text" name="student_name" class="form-control" onclick=adminsionnosearch(this.value) value="<?php echo $resignstudent->student_name; ?>">
                                <datalist id="browsers">
                                    <?php 
                                        foreach($studentlist as $row)
                                    { 
                                      echo '
                                      <option value="'.$row->id.'">'.$row->firstname.$row->lastname.'</option>
                                      ';
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>School Entering Number</label>
                                <select name="school_no" class="form-control" id="searchresult" value="<?php echo $resignstudent->enterschool_number; ?>">
                                  <option value="hidden">...Select...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Resign Date</label>
                                <input type="text" name="resign_date" class="form-control" id="admission_date" value="<?php echo $resignstudent->resign_date; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>NRC No</label>
                                <input type="text" name="nrc_no" class="form-control" value="<?php echo $resignstudent->nrc_no; ?>">
                            </div>
                        </div>
                    </div><!--end first row-->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Year (From)</label>
                                <input type="text" name="yearfrom" class="form-control"  id="admission_date" value="<?php echo $resignstudent->edu_from; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Year (To)</label>
                                <input type="text" name="yearto" class="form-control"  id="admission_date" value="<?php echo $resignstudent->edu_to; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Father Name</label>
                                <input type="text" name="father_name" class="form-control" value="<?php echo $resignstudent->father_name; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Moved School</label>
                                <input type="text" name="moved_school" class="form-control" value="<?php echo $resignstudent->moved_school; ?>">
                            </div>
                        </div>
                     </div><!--end second row-->
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Moved Division</label>
                                <input type="text" name="moved_division" class="form-control" value="<?php echo $resignstudent->moved_division; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Moved Township</label>
                                <input type="text" name="moved_township" class="form-control" value="<?php echo $resignstudent->moved_township; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Moved City</label>
                                <input type="text" name="moved_city" class="form-control" value="<?php echo $resignstudent->moved_city; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Attendance Class</label>
                                <input type="text" name="letattend_class" class="form-control" value="<?php echo $resignstudent->letattend_class; ?>">
                            </div>
                        </div>
                     </div><!--end third row-->
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Attendance Date</label>
                                <input type="text" name="letattend_date" class="form-control" id="admission_date" value="<?php echo $resignstudent->letattend_date; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" name="dob" class="form-control" id="admission_date" value="<?php echo $resignstudent->dob; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Now Attendance Class</label>
                                <input type="text" name="nowattend_class" class="form-control" value="<?php echo $resignstudent->nowattend_class; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Attended Date </label>
                                <input type="text" name="attend_date" class="form-control" id="admission_date" value="<?php echo $resignstudent->attend_date; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Roll Call Time </label>
                                <input type="text" name="rollcalltime" class="form-control" value="<?php echo $resignstudent->rollcalltime; ?>">
                            </div>
                        </div>
                     </div><!--end forth row-->
                     <div class="row">
                         <h4 style="padding-left:10px;">Parent's Data</h4>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sign</label>
                                <input type="text" name="parent_sign" class="form-control" value="<?php echo $resignstudent->parent_sign; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="parent_name" class="form-control" value="<?php echo $resignstudent->parent_name; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>NRC No</label>
                                <input type="text" name="parent_nrc" class="form-control" value="<?php echo $resignstudent->parent_nrc; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="parent_date" class="form-control" id="admission_date" value="<?php echo $resignstudent->parent_date; ?>">
                            </div>
                        </div>
                     </div><!--end fifth row-->
                     <div class="row">
                         <h4 style="padding-left:10px;">Principal's Data</h4>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>School</label>
                                <input type="text" name="principal_school" class="form-control" value="<?php echo $resignstudent->principal_school; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="principal_city" class="form-control" value="<?php echo $resignstudent->principal_city; ?>">
                            </div>
                        </div>
                        
                     </div><!--end sixth row-->
                    
                </div><!--around10-->
                                
                            </div>
                            

                           
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                  <?=form_close()?>  
                </div>               
            </div>
        </div> 
</div>
</section>
</div>



<div class="modal fade" id="mySiblingModal" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center modal_title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="sibling_msg">

                        </div>
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $this->lang->line('class'); ?></label>
                            <div class="col-sm-10">
                                <select  id="sibiling_class_id" name="sibiling_class_id" class="form-control"  >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                        <option value="<?php echo $class['id'] ?>"<?php if (set_value('sibiling_class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line('section'); ?></label>
                            <div class="col-sm-10">
                                <select  id="sibiling_section_id" name="sibiling_section_id" class="form-control" >
                                    <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger" id="transport_amount_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line('student'); ?>
                            </label>

                            <div class="col-sm-10">
                                <select  id="sibiling_student_id" name="sibiling_student_id" class="form-control" >
                                    <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger" id="transport_amount_fine_error"></span>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <button type="button" class="btn btn-primary add_sibling" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-user"></i> <?php echo $this->lang->line('add'); ?></button>
            </div>
        </div>
    </div>
</div>



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
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
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

        $('#dob,#admission_date').datepicker({
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
    function auto_fill_guardian_address() {
        if ($("#autofill_current_address").is(':checked'))
        {
            $('#current_address').val($('#guardian_address').val());
        }
    }
    function auto_fill_address() {
        if ($("#autofill_address").is(':checked'))
        {
            $('#permanent_address').val($('#current_address').val());
        }
    }
    $('input:radio[name="guardian_is"]').change(
            function () {
                if ($(this).is(':checked')) {
                    var value = $(this).val();
                    if (value == "father") {
                        $('#guardian_name').val($('#father_name').val());
                        $('#guardian_phone').val($('#father_phone').val());
                        $('#guardian_occupation').val($('#father_occupation').val());
                        $('#guardian_relation').val("Father")
                    } else if (value == "mother") {
                        $('#guardian_name').val($('#mother_name').val());
                        $('#guardian_phone').val($('#mother_phone').val());
                        $('#guardian_occupation').val($('#mother_occupation').val());
                        $('#guardian_relation').val("Mother")
                    } else {
                        $('#guardian_name').val("");
                        $('#guardian_phone').val("");
                        $('#guardian_occupation').val("");
                        $('#guardian_relation').val("")
                    }
                }
            });


</script>

<script type="text/javascript">
    $(".mysiblings").click(function () {
        $('.sibling_msg').html("");
        $('.modal_title').html('<b>' + "<?php echo $this->lang->line('sibling'); ?>" + '</b>');
        $('#mySiblingModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });
</script>

<script type="text/javascript">

    $(document).on('change', '#sibiling_class_id', function (e) {
        $('#sibiling_section_id').html("");
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
                $('#sibiling_section_id').append(div_data);
            }
        });
    });

    $(document).on('change', '#sibiling_section_id', function (e) {
        getStudentsByClassAndSection();
    });

    function getStudentsByClassAndSection() {
        $('#sibiling_student_id').html("");
        var class_id = $('#sibiling_class_id').val();
        var section_id = $('#sibiling_section_id').val();
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                });
                $('#sibiling_student_id').append(div_data);
            }
        });
    }

    $(document).on('click', '.add_sibling', function () {
        var student_id = $('#sibiling_student_id').val();
        var base_url = '<?php echo base_url() ?>';
        if (student_id.length > 0) {
            $.ajax({
                type: "GET",
                url: base_url + "student/getStudentRecordByID",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (data) {
                    $('#sibling_name').text("Sibling: " + data.firstname + " " + data.lastname);
                    $('#sibling_name_next').val(data.firstname + " " + data.lastname);
                    $('#sibling_id').val(student_id);
                    $('#father_name').val(data.father_name);
                    $('#father_phone').val(data.father_phone);
                    $('#father_occupation').val(data.father_occupation);
                    $('#mother_name').val(data.mother_name);
                    $('#mother_phone').val(data.mother_phone);
                    $('#mother_occupation').val(data.mother_occupation);
                    $('#guardian_name').val(data.guardian_name);
                    $('#guardian_relation').val(data.guardian_relation);
                    $('#guardian_address').val(data.guardian_address);
                    $('#guardian_phone').val(data.guardian_phone);
                    $('#state').val(data.state);
                    $('#city').val(data.city);
                    $('#pincode').val(data.pincode);
                    $('#current_address').val(data.current_address);
                    $('#permanent_address').val(data.permanent_address);
                    $('#guardian_occupation').val(data.guardian_occupation);
                    $("input[name=guardian_is][value='" + data.guardian_is + "']").prop("checked", true);
                    $('#mySiblingModal').modal('hide');
                }
            });
        } else {
            $('.sibling_msg').html("<div class='alert alert-danger'>No Student Selected</div>");
        }

    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>    


<script type="text/javascript">
    function adminsionnosearch(id)
    {
        data="id="+id;
        $.ajax({
                type: "POST",
                url : '<?=base_url()?>'+"Student/searchadminsionno/",
                data : data,

                success : function(e)
                {
                 $("#searchresult").html(e);
                }
            });
    }
</script>