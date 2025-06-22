<style>
    .approve{
        background: red;
        color: #fff;
        padding: 3px 16px;
    }
</style>

<div class="content-wrapper" style="min-height: 327px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Students' Leave Information <small></small>
        </h1>
    </section>
    <section class="content">
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Students' Leave List</h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><a href="<?=base_url()?>admin/Leaveuser/leaveform" class="btn btn-primary btn-sm">+ Add</a></small>   
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <table class="table table-hover table-striped tmb0 example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Admission</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Reason</th>
                                    
                                    <th>Date(From)</th>
                                    <th>Date(To)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach($leaveuser->result() as $row){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->adminno; ?></td>
                                    <td><?php echo $row->fname.$row->lname; ?></td>
                                    <td><?php echo $row->clss ."(".$row->section.")"; ?></td>
                                    <td><?php echo $row->reason; ?></td>

                                    <td>
                                        <?php 
                                        if($row->leave_from==date("Y-m-d"))
                                        { ?>
                                         <span style="color:red"> <?php echo $row->leave_from; ?></span>
                                         
                                       <?php }
                                        else{
                                           echo $row->leave_from;
                                        }
                                        ?>
                                        </td>
                                    <td>
                                        <?php echo $row->leave_to; ?>
                                        </td>
                                    
                                       <?php if($row->leave_status==1){ ?>
                                       <td><span class="approve"> √ </span></td>
                                       <?php }
                                        else{ ?>
                                       
                                       <td>
                                        <a href="<?php echo base_url(); ?>/admin/Leaveuser/leaveconfirm/<?php echo $row->id; ?>/<?php echo $row->session_id; ?>" class="btn btn-success" onclick="return confirm('Are you sure to Confirm?')">Confirm</a>
                                        </td>
                                      <?php  } ?>
                                        
                                    
                                </tr>
                            <?php
                            $i++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </section>
    
</div>