<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>ddddd
            <i class="fa fa-user-plus"></i> Monthly School Activity Mark Register <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('teacher/Reportcard/activitysearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-4">
                                            <div class="form-group"> 
                                                <label><?php echo $this->lang->line('class'); ?></label>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>  
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>   
                                        </div>


                                    <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Month Name</label>
                                              <?php echo form_dropdown("month",$reportcard_month,set_value("month"),"class='form-control'"); ?>
                                                <span class="text-danger"><?php echo form_error('month'); ?></span>
                                            </div>   
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                </div>  
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('teacher/Reportcard/activitysearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" class="form-control"   placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($resultlist)) {
                    ?>
                    <div class="nav-tabs-custom">
                       
                        <div class="tab-content">
<!--                             <div class="download_label"><?php echo $title; ?></div>
 -->      


                       <div class="tab-pane active table-responsive no-padding" id="tab_1">
 <?php echo form_open("teacher/Reportcard/save_acitvity"); ?>
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <?php foreach($school_activity->result() as $act):

                                            echo "<th style='text-align:center !important;width:11% !important'>".$act->name."</th>";

                                            endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($resultlist)) {
                                            ?>
                                                            <!-- <tr>
                                                                <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                            </tr> -->
                                            <?php
                                        } else {
                                            $count = 1;
                                            foreach ($resultlist as $student) {
                                                ?>
                                                <tr>
                                                <?php echo ' <input type="hidden" name="student_id[]" value="'.$student["id"].'"/>'; ?>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                        </a>
                                                    </td>

                                                <td width="10%">
                                                        <input type="text" name="act_1" style="width:80px" value="<?=$student['act_1']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_2" style="width:80px" value="<?=$student['act_2']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_3" style="width:80px" value="<?=$student['act_3']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_4" style="width:80px" value="<?=$student['act_4']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_5" style="width:80px" value="<?=$student['act_5']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_6" style="width:80px" value="<?=$student['act_6']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_7" style="width:80px" value="<?=$student['act_7']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_8" style="width:80px" value="<?=$student['act_8']?>"/>
                                                    </td>
                                                     <td width="10%">
                                                        <input type="text" name="act_9" style="width:80px" value="<?=$student['act_9']?>"/>
                                                    </td>
                                                    </tr>

                                                    <?php } ?>
                                    </tbody>
                                    <tr>
                                        <td colspan="10" align="right">
                                            
                                            <?php echo form_submit("save","save","btn btn-primary"); ?>
                                        </td>
                                    </tr>
                                </table>

                                <?php echo form_close(); 

                                }?>
                            </div>                           
                                                                                 
                                                            </div>                                                         
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        </div>  
                                                        </div> 
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
                                                            });
                                                        </script>