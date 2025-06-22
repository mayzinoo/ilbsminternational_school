<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-line-chart"></i> Students Finalized <?php echo $this->lang->line('reports'); ?> <small> <?php echo $this->lang->line('filter_by_name1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form role="form" action="<?php echo site_url('student/studentreport_search') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                                Year
                                        </label>
                                        
                                          <?php 
                    $year=array(2018=>2018,2019=>2019,2020=>2020,2021=>2021,2022=>2022,2023=>2023,2024=>2024)
                     ?>
                    
              <?=form_dropdown("year",$year,$sel_year,"class='form-control'")?> 
                                    </div>
                                </div>
                            <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>School</label>
                                                <?=form_dropdown("school",$school,set_value("school"),"class='form-control'")?>
                                                <span class="text-danger"><?php echo form_error('school'); ?></span>
                                            </div>   
                                        </div>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group"> 
                                    <label><br/></label><br/>
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>

                                </div>  
                            </div>

                          
                    </form>
                </div>
            </div>
          
                <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> Finalized <?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></h3>
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label"><?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
					
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>  
                                <!--<th>Grade</th>-->
                                <th>No.</th>
                                <th>Class</th>
                                <th>Male</th>
                                <th>Female</th>    
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              
                                    $count = 1;
                                    foreach ($resultlist->result() as $list) {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $list->class; ?></td>

                                            <td><?php echo $list->maletotal; ?></td>
                                            <td><?php echo $list->femaletotal; ?></td>
                                            <td><?php echo $list->total; ?></td>                                                       
                                         </tr>
                                           <?php
                $count++;
            }
            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              
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