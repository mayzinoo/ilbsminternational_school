
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> Leaves</small>    
    </h1>
    </section>
    <section class="content">
    
        <div class="row">
            <div class="col-md-12">
                 <div class="box box-primary">
                 <?=form_open('parent/Parents/leaveform_insert')?>
                 
    <input type="hidden" name="stuid" value="<?php echo $this->uri->segment(4); ?>" >
    <input type="hidden" name="classes" value="<?php echo $student['class_id']; ?>">
    <input type="hidden" name="section" value="<?php echo $student['section_id']; ?>">
    <input type="hidden" name="session" value="<?php echo $student['sess_id']; ?>">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="col-md-2 toppadding_sm">
                            Leave Date
                        </div>
                        <div class="col-md-2">
                            <label>From</label>
                            <input type="date" name="leavefrom" id="leavefrom" class="form-control">
                        </div>
                       
                        <div class="col-md-2">
                            <label>To</label>
                            <input type="date" name="leaveto" id="leaveto" class="form-control">
                        </div>
                      
                        <div class="col-md-2">
                            <label>Status</label>
                            <select name="time_status" class="form-control">
                                <option value="">Select</option>
                                <option value="half">Half Day</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Reason</label>
                            <textarea name="reason" class="form-control"></textarea>
                        </div>
                        <div class="col-md-2 toppadding_sm">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
    <?=form_close()?>




                 
                </div>
            </div>
            <div class="col-md-12">
                <h3>
            <i class="fa fa-calendar"></i> Leave</small>    
    </h3>
                <div class="container">
                        
                      
                        <table class="table table-bordered">
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>

                              <?php 

                        foreach($leaveuser->result() as $r):

                            ?>

                        <tr>
                            <td><?=$r->leave_from?></td>
                            <td><?=$r->leave_to?></td>
                            <td><?=$r->reason?></td>
                            <td><?=$r->created_at?></td>
                            <td>
                    <?php if($r->leave_status==1){ ?>
                            <span class="approve"> √ </span>
                                       <?php }
                             ?>
                                       
                            <?=$r->status?>
                            </td>
                        </tr>

                         <?php
                            endforeach;
                         ?>

                        </table>

                       
                    </div>
            </div>
        </div>
    </section>
</div>
