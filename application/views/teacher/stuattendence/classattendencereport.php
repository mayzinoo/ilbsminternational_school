<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<?php

$statusarr=array(
    "Present"=>"Present",
    "Absent"=>"Absent",
    "Leave"=>"Leave",
    "Half Day Leave"=>"Half Day Leave"
    
);

?>
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
                    <form id='form1' action="<?php echo site_url('teacher/Stuattendence/classattendencereport') ?>"  method="post" accept-charset="utf-8">
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
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                                       <input class="form-control" id="date" name="date" placeholder="" type="text"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" /> <span class="text-danger"><?php echo form_error('date'); ?></span>

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
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('list'); ?> ( <?php echo $month_selected; ?> ) </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>

                        <ul class="nav nav-tabs">

<li class="active"><a href="<?php echo base_url(); ?>teacher/Stuattendence/classattendencereport" ><i class="fa fa-list"></i> Attendance Lists</a></li>

<li><a href="<?php echo base_url(); ?>teacher/Stuattendence/classabsentreport" ><i class="fa fa-newspaper-o"></i> Absent Lists</a></li>
</ul>
                        <div class="box-body">

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
<th>Status</th>
</tr>
</thead>            
<tbody>    
<?php
if($resultlist)
{
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
<td><?php if($student->in_time !="0000-00-00 00:00:00") echo date('h:i A', strtotime($student->in_time)); ?></td>
<td><?php if($student->out_time !="0000-00-00 00:00:00")  echo date('h:i A', strtotime($student->out_time));?></td>
<td id="status<?=$student->id?>"><?php echo $student->status; ?></td>
<td>
     
     
     <div class="modal fade" id="myModal<?php echo $student->id?>" role="dialog">
    <div class="modal-dialog modal-sm">
        <?=form_open("Stuattendence/edit/", "id='form".$student->id."'")?>
        <?=form_hidden("id",$student->id);?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Attandence Status</h4>
        </div>
        <div class="modal-body">
            <?=form_dropdown("status",$statusarr,$student->status,"form-control")?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="edit_attstatus('<?=$student->id?>')">Save</button>
        </div>
      </div>
      <?=form_close()?>
    </div>
  </div>
  
  
     <a href="#" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#myModal<?php echo $student->id?>" title="<?php echo $this->lang->line('edit'); ?>">
             <i class="fa fa-pencil"></i>
         </a>
     <a href="<?php echo base_url(); ?>teacher/Stuattendence/delete/<?php echo $student->id?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
    <i class="fa fa-remove"></i>
</a>
  
</td>

</tr>
<?php
$count++;


}

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
                            url: base_url + "teacher/sections/getByClass",
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
                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
                    $('#date').datepicker({
                        format: date_format,
                        autoclose: true
                    });
                });
            </script>
            <script type="text/javascript">
                
                
                
                function edit_attstatus(id)
                {
                    data=$("#form"+id).serialize();
                    		$.ajax({
                            		type:"POST",
                            		data: data,
                            		url:'<?php echo base_url() ?>teacher/Stuattendence/edit',
                            		cache: false,
                            		success: function(d) 
                            
                            		{				
                            
                            			$("#status"+id).html(d);
                                          
                                    }
                            		
                            	});

                }
            </script>