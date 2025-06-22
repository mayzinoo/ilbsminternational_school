
<style type="text/css">
    .radio {
        padding-left: 20px; }
    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px; }
    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out; }
    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1; }
    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
        opacity: 0.65; }
    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
    .radio.radio-inline {
        margin-top: 0; }
    .radio-primary input[type="radio"] + label::after {
        background-color: #337ab7; }
    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #337ab7; }
    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #337ab7; }
    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f; }
    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de; }
    </style>

    <div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> Student <?php echo $this->lang->line('attendance'); ?> <small><?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section>
    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('teacher/Stuattendence/absent') ?>"  method="post" accept-charset="utf-8">
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
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('attendance'); ?>
                                            <?php echo $this->lang->line('date'); ?>
                                        </label>
                                        
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
</div>
<ul class="nav nav-tabs">

<li><a href="<?php echo base_url(); ?>teacher/Stuattendence/" ><i class="fa fa-list"></i> Attendance Lists</a></li>

<li class="active"><a href="<?php echo base_url(); ?>teacher/Stuattendence/absent" ><i class="fa fa-newspaper-o"></i> Absent Lists</a></li>
<li><a href="<?php echo base_url(); ?>teacher/Stuattendence/leave" ><i class="fa fa-newspaper-o"></i> Leave Lists</a></li>
</ul>
    <div class="box box-primary">


            
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
<thead>

<tr>
<th>No</th>
<th>Admission No</th>
<th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>
<th><?php echo $this->lang->line('class'); ?></th>
<th><?php echo $this->lang->line('father_name'); ?></th>
<th> Date</th>
<th>In Time</th>
<th>Out Time</th>
</tr>
</thead>            
<tbody>    
<?php
$count = 1;
foreach ($resultlist->result() as $student) {


?>
<tr>
<td><?php   echo $count; ?></td>
<td><?php echo $student->admission_no; ?></td>

<td><?php echo $student->firstname . " " . $student->lastname; ?></td>
<td><?php echo $student->class; ?> ( <?php echo $student->section; ?> )</td>
<td><?php echo $student->father_name; ?></td>
<td><?php echo date("d-m-Y",strtotime($student->created_at)); ?></td>
<td><?php echo date('h:i A', strtotime($student->in_time)); ?></td>
<td><?php if($student->out_time !="0000-00-00 00:00:00")  echo date('h:i A', strtotime($student->out_time));?></td>



</tr>
<?php
$count++;


}
?>
</tbody>



</table>



    </div>
                </div>
    <!-- Main content -->
    
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
                $(function () {
                    $('.button-checkbox').each(function () {
                        var $widget = $(this),
                                $button = $widget.find('button'),
                                $checkbox = $widget.find('input:checkbox'),
                                color = $button.data('color'),
                                settings = {
                                    on: {
                                        icon: 'glyphicon glyphicon-check'
                                    },
                                    off: {
                                        icon: 'glyphicon glyphicon-unchecked'
                                    }
                                };
                        $button.on('click', function () {
                            $checkbox.prop('checked', !$checkbox.is(':checked'));
                            $checkbox.triggerHandler('change');
                            updateDisplay();
                        });
                        $checkbox.on('change', function () {
                            updateDisplay();
                        });

                        function updateDisplay() {
                            var isChecked = $checkbox.is(':checked');
                            $button.data('state', (isChecked) ? "on" : "off");
                            $button.find('.state-icon')
                                    .removeClass()
                                    .addClass('state-icon ' + settings[$button.data('state')].icon);
                            if (isChecked) {
                                $button
                                        .removeClass('btn-success')
                                        .addClass('btn-' + color + ' active');
                            } else {
                                $button
                                        .removeClass('btn-' + color + ' active')
                                        .addClass('btn-primary');
                            }
                        }

                        function init() {
                            updateDisplay();
                            if ($button.find('.state-icon').length == 0) {
                                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                            }
                        }
                        init();
                    });
                });
            </script>        