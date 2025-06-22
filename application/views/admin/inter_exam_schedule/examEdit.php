<style>
.table{
    margin-bottom: 122px !important;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> Inter <?php echo $this->lang->line('examinations'); ?> Schedules  </h1>

    </section>

    <!-- Main content -->

       <form id="form1" action="<?php echo site_url("admin/Inter_examSchedule/edit/" . $id) ?>"  id="examsch" name="examsch" method="post" enctype="multipart/form-data" accept-charset="utf-8">

    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">

                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('exam_name'); ?></label>

                                        <select autofocus=""  id="exam_id" name="exam_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($examlist as $exam) {
                                                ?>
                                                <option value="<?php echo $exam['id'] ?>" <?php
                                                if ($examSchedule[0]["exam_id"] == $exam['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $exam['name'] ?></option>

                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                    </div>

                                </div><!-- /.col -->
                           

                                    <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Inter Class</label>
                                             <?php echo form_dropdown("inter_class",$inter_classes,$examSchedule[0]["inter_class"],"class='form-control'");?>

                                                <span class="text-danger"><?php echo form_error('inter_class'); ?></span>
                                            </div>
                                        </div>
                                          <div class="col-md-2">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">School</label>
                                             <?php echo form_dropdown("school",$schools,$examSchedule[0]['school'],"class='form-control'");?>

                                                <span class="text-danger"><?php echo form_error('school'); ?></span>
                                            </div>
                                        </div>
                                            
                             
                            </div><!-- /.row -->

                        </div><!-- /.box-body -->

                </div>
               

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-list"></i> <?php echo $this->lang->line('exam_schedule'); ?></h3>
                                  <span width="5%" class="pull-right"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></span>

                        </div>
                        <div class="box-body">
                           

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('subject'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('date'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('start_time'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('end_time'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('room'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('full_mark'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('passing_marks'); ?>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="SourceWrapper">
                        <?php foreach($examSchedule as $exam):?>
                              <tr class="clonethis">
                                                    <td>
                                             <?php echo form_dropdown("subject_id[]",$subjectlists,$exam["subject_id"],"class='form-control'");?>

                                                    </td>
                                                    <td>
                                                       
                                                        <div class="form-group">

                                                            <input type="text" name="date[]" class="form-control sandbox-container"  placeholder="Enter date" value="<?php echo $exam["date_of_exam"]; ?>">
                                                        </div>
                                                    </td>
                                                    <td style="width:200px;">
                                                       
                                                        <div class="bootstrap-timepicker">
                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    <input type="text" name="stime[]" class="form-control timepicker"  value="<?php echo $exam["start_to"]; ?>">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-clock-o"></i>
                                                                    </div>
                                                                </div><!-- /.input group -->
                                                            </div><!-- /.form group -->
                                                        </div>
                                                    </td>
                                                    <td style="width:200px;">
                                                        <div class="bootstrap-timepicker">
                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    <input type="text" name="etime[]" class="form-control timepicker"  value="<?php echo $exam['end_from'] ?>">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-clock-o"></i>
                                                                    </div>
                                                                </div><!-- /.input group -->
                                                            </div><!-- /.form group -->
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">

                                                            <input type="text" name="room[]" class="form-control"   value="<?php echo $exam['room_no'] ?>" placeholder="Enter Room">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">

                                                            <input type="text" name="fmark[]" class="form-control"  value="<?php echo $exam['full_marks'] ?>" placeholder="Enter Full Marks">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">

                                                            <input type="text" name="pmarks[]" class="form-control"  value="<?php echo $exam['passing_marks'] ?>" placeholder="Enter Passing Marks">
                                                        </div>
                                                    </td>
                                                    
                                                <th><i class="fa fa-trash" onclick="removerform(event)"></i></th>

                                                </tr>
                                                
                                                
                                        <?php endforeach;?>
                                              
                                            </tbody>

                                        </table>
                                    </div>
                                    <input type="submit" class="btn btn-primary save_form pull-right" name="save" value="Save">
                               

                        </div><!---./end box-body--->
                    </div>
                </div>

                <!-- right column -->

            </div>   <!-- /.row -->
          
        

    </section><!-- /.content -->

                                    </form>

</div>


</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/custom/bootstrap-datepicker.js"></script>

<script>
    $(function () {

        $(".timepicker").timepicker({
            showInputs: false,

        });
    });
</script>
<script>
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
    $('.sandbox-container').datepicker({

        autoclose: true,
        // format : "dd-mm-yyyy"
        format: date_format,
    });



</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>

