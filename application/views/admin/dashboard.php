<div class="content-wrapper" style="min-height: 946px;">
    <section class="content">
        <div class="row">
            <?php
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('studentfee') ?>">
                        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo $this->lang->line('monthly_fees_collection'); ?></span>
                            <span class="info-box-number"><?php echo number_format($totalfeepermonth->amount); ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('admin/expense') ?>">
                        <span class="info-box-icon bg-red"><i class="fa fa-credit-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo $this->lang->line('monthly_expenses'); ?></span>
                            <span class="info-box-number"><?php echo number_format($get_totalexppermonth->amount); ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('student/search') ?>">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo $this->lang->line('student'); ?></span>
                            <span class="info-box-number"><?php echo $total_students; ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('admin/teacher') ?>">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo $this->lang->line('teachers'); ?></span>
                            <span class="info-box-number"><?php echo $total_teachers; ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
          <div class="row">
            <?php
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('Installment/studentfee_receive') ?>">
                        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Installment Payment</span>
                            <span class="info-box-number"><?php echo number_format($get_totalinstallpermonth->amount); ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('admin/income') ?>">
                        <span class="info-box-icon bg-red"><i class="fa fa-credit-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Income Total</span>
                            <span class="info-box-number"><?php echo number_format($get_totalincpermonth->amount); ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('Course/course_fee_receive') ?>">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Summer Course Income</span>
                            <span class="info-box-number"><?php echo number_format($get_totalsummer->amount); ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo site_url('Inventory/sale') ?>">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Inventory Sale Incomes</span>
                            <span class="info-box-number"><?php echo number_format($get_totalsale->amount); ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

       <!-- <div class="row">       
            <div class="col-md-12">               
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fees Collection & Expenses For <?php echo date('F')." ".date('Y'); ?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-md-12">              
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('fees_collection_&_expenses_for_session'); ?> <?php echo $this->setting_model->getCurrentSessionName(); ?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
</div>
