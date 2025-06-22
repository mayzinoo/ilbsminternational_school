<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Weekly Preparations <small></small>        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php //echo $title;     ?> Edit Weekly Preparations</h3>
                    </div><!-- /.box-header -->
                     <form id="form1" action="<?php echo site_url('teacherdiary/weeklypreparation/edit/' . $id) ?>"  id="teacherdiary" name="teacherdiary" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                                    <?php $show=$lists->row();?>

                           <div class="row">
                                  <div class="col-md-2">
                                  <div class="form-group <?php
                            if (form_error('date_from')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date_from'); ?></label>
                                <input id="date_from" name="date_from" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date_from',$show->date_from); ?>"  />

                            </div>                          
                            </div>


                             <div class="col-md-2">
                                  <div class="form-group <?php
                            if (form_error('date_to')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date_to'); ?></label>
                                <input id="date_to" name="date_to" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date_to',$show->date_to); ?>"  />

                            </div>
                          
                            </div>
                            
                            <div class="col-md-2">
                                  <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1">School</label>

                               <?php echo form_dropdown("school",$schools,$show->school,'class="form-control"'); ?>

                            </div>
                            </div>

                            <div class="col-md-2">
                                  <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1">Teacher's Name</label>

                               <?php echo form_dropdown("teacher",$teacherlists,$show->teacher_id,'class="form-control"'); ?>

                            </div>
                            </div>


                    
                            
                           </div>                     
                           
                              <div class="panel-default">
                                  <div class="panel-body">
                              <div class="row clone">
                              <table class="table" width="100%">
                                  
                              <thead>
                                <tr>
                                <th width="5%">No</th>
                                <th width="20%">Grade</th>
                                <th width="20%">Subject</th>
                                  <th>Description</th>
                                  <th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></th>
                                  </tr>
                              </thead>
                              <tbody id="SourceWrapper">
                              <?php 
                              $no= 1;
                              foreach($lists->result() as $list):
                               ?>
                              <tr class="clonethis">
                              <td class="no"><?=$no?></td>
                                    <td>
                                        <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">


                                <input type="hidden" name="detail_id[]" value="<?=$list->detail_id?>">
                               <?php echo form_dropdown("grade[]",$classlists,$list->grade,'class="form-control"'); ?>

                            </div> 

                                  </td>
                                  <td>
                                        <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">


                                <input type="hidden" name="detail_id[]" value="<?=$list->detail_id?>">
                               <?php echo form_dropdown("subject[]",$subjectlists,$list->subject_id,'class="form-control"'); ?>

                            </div> 

                                  </td>
                                  <td>
                                      
  <div class="form-group <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?>">
                                <textarea class="form-control" name="description[]" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description',$list->tdes); ?></textarea>

                            </div>
                                  </td>
                                  <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                              </tr>

                              <?php 

                              $no++;

                              endforeach;

                               ?>
                                  
                              </tbody>
                              </table>
                                
                                      
                                
                              </div>
                              </div>
                              </div>

                               
                          

                           <!--  <div class="form-group <?php
                            if (form_error('name')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1">Title</label>
                                <input id="title" name="title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />

                            </div> -->
                          
                           <!--  <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control"  value="<?php echo set_value('documents'); ?>" />
                                <span class="text-danger"><?php echo form_error('documents'); ?></span>
                            </div> -->
                          
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            
            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date,#start_date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

          
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
