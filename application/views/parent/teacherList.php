<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-secret"></i> <?php echo $this->lang->line('teachers'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" id="tachelist">
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
						<div class="download_label"><?php echo $this->lang->line('teachers'); ?></div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                       <th class="text text-left"><?php echo $this->lang->line('name'); ?></th>
                                        <th class="text text-right">Subject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($teacherlist)) {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($teacherlist as $teacher) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                                
                                                <td class="text text-right"> <?php echo $teacher['sname'] ?></td>
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
                    <div class="box-footer">
                        <div class="mailbox-controls"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>