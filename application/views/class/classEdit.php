<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>     </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('edit_class'); ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo site_url('classes/edit/' . $id) ?>"  method="post" accept-charset="utf-8">
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
                            <input type="hidden" name="id" value="<?php echo set_value('id', $vehroute[0]->id); ?>" >
                            <input type="hidden" name="pre_class_id" value="<?php echo $vehroute[0]->id; ?>" >
                            <?php
                            foreach ($vehroute[0]->vehicles as $v_key => $v_value) {
                                ?>
                                <input type="hidden" name="prev_sections[]" value="<?php echo $v_value->id; ?>">
                                <?php
                            }
                            ?>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                <input autofocus="" id="class" name="class" placeholder="" type="text" class="form-control"  value="<?php echo set_value('class', $vehroute[0]->class); ?>" />
                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>

                             <div class="form-group">
                                <label for="exampleInputEmail1">Level</label>
                                 <?=form_dropdown("level",$levels,$vehroute[0]->level,"class='form-control'")?>
                                <span class="text-danger"><?php echo form_error('level'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('sections'); ?></label>


                                <?php
                                foreach ($vehiclelist as $vehicle) {
                                    ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sections[]" value="<?php echo $vehicle['id'] ?>" <?php echo set_checkbox('sections[]', $vehicle['id'], check_in_array($vehicle['id'], $vehroute[0]->vehicles)); ?> ><?php echo $vehicle['section'] ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                                ?>

                                <span class="text-danger"><?php echo form_error('sections[]'); ?></span>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label for="exampleInputEmail1">Parent Sign</label>-->
                            <!--    <input type="text" name="parentsign" id="upload" size="28" class="file_input_replacement" value=""  value="<?php echo set_value('parent_sign', $vehroute[0]->class); ?>" accept="..jpg, .jpeg, .png">-->
                      
                            <!--    <input type="file" name="parentsign" class="file_input_with_replacement" >-->
                            <!--    <span class="text-danger"><?php echo form_error('level'); ?></span>-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <label for="exampleInputEmail1">Principal's Sign</label>-->
                            <!--    <input type="text" name="principalsign" id="upload" size="28" class="file_input_replacement" value="" placeholder="" accept="..jpg, .jpeg, .png">-->
                      
                            <!--    <input type="file" name="principalsign" class="file_input_with_replacement" >-->
                            <!--    <span class="text-danger"><?php echo form_error('level'); ?></span>-->
                            <!--</div>-->

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('class_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
						<div class="download_label"><?php echo $this->lang->line('class_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('class'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('sections'); ?>
                                        </th>
                                        <th>Reportcard Level
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($vehroutelist as $vehroute) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $vehroute->class; ?>

                                            </td>


                                            <td>
                                                <?php
                                                $vehicles = $vehroute->vehicles;
                                                if (!empty($vehicles)) {


                                                    foreach ($vehicles as $key => $value) {


                                                        echo "<div>" . $value->section . "</div>";
                                                    }
                                                }
                                                ?>

                                            </td>
                                             <td class="mailbox-name">
                                                <?php echo $vehroute->level; ?>

                                            </td>
                                            <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>classes/edit/<?php echo $vehroute->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                              
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->


                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
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

<?php

function check_in_array($find, $array) {

    foreach ($array as $element) {
        if ($find == $element->id) {
            return TRUE;
        }
    }
    return FALSE;
}
?>

<script>
        $(function(){
        $('.file_input_replacement').click(function(){
            //This will make the element with class file_input_replacement launch the select file dialog.
            var assocInput = $(this).siblings("input[type=file]");
            console.log(assocInput);
            assocInput.click();
        });
        $('.file_input_with_replacement').change(function(){
            //This portion can be used to trigger actions once the file was selected or changed. In this case, if the element triggering the select file dialog is an input, it fills it with the filename
            var thisInput = $(this);
            var assocInput = thisInput.siblings("input.file_input_replacement");
            if (assocInput.length > 0) {
              var filename = (thisInput.val()).replace(/^.*[\\\/]/, '');
              assocInput.val(filename);
            }
        });
    });
</script>