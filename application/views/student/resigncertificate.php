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
                <div class="pull-right box-tools" style="position: absolute;right: 14px;top: 13px;">
                        <a href="<?php echo site_url('Student/create_resigncertificate_form') ?>">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Add New</button>
                        </a>
                </div>
                
                <div class="box-body">
                    <div class="tshadow mb25 bozero">    
                        <h4 class="pagetitleh2">Resign Certificate </h4>
                        <div class="table-responsive topmargin_md">
                  <table class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                      <tr>
                            <th>No</th>
                            <th>Student Name</th>
                            <th>Class Name</th>
                            <th>Father Name</th>
                            <th>NRC No</th>
                            <th>Resign Date</th>
                            <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i=1;
                        foreach($resigndata->result() as $row):
                      ?>
                          <tr>
                              <td><?=$i++;?></td>
                              <td><?php echo $row->student_name; ?></td>
                              <td><?php echo $row->nowattend_class; ?></td>
                              <td><?php echo $row->father_name; ?></td>
                              <td><?php echo $row->nrc_no; ?></td>
                              <td><?php echo $row->resign_date; ?></td>
                              <td class="pull-right">
                                  <span class="btn btn-default btn-xs">
                                  <a href="<?php echo base_url(); ?>Student/resigncertificateView/<?php echo $row->id; ?>" title="View">
                                    <i class="fa fa-reorder"></i>
                                  </a></span><!--View-->
                                  
                                  <span class="btn btn-default btn-xs">
                                  <a href="<?php echo base_url(); ?>Student/resigncertificateEdit/<?php echo $row->id; ?>" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                  </a></span><!--Edit-->
                                  
                                  <span class="btn btn-default btn-xs">
                                  <a href="<?php echo base_url(); ?>Student/resigncertificatePrint/<?php echo $row->id; ?>" title="Resign Certificate Print">
                                    <i class="fa fa-print"></i>
                                  </a></span><!--Print-->
                                  
                                  <span class="btn btn-default btn-xs">
                                  <a href="<?php echo base_url(); ?>Student/resigncertificateDelete/<?php echo $row->id; ?>" title="Delete">
                                    <i class="fa fa-trash"></i>
                                  </a></span><!--delete-->
                              </td>
                              
                          </tr> 
                        <?php endforeach; ?>      
                    </tbody>
                  </table>
                    </div>
                </div>
            </div><!--box primary-->
        </div>
    </div>
    </section>
</div>