 
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
                        <h3 class="box-title"><i class="fa fa-search"></i> Add New Leave Form</h3>
                       
                    </div>
                    
                    <div class="box-body">
                        
 <?=form_open('admin/Leaveuser/leaveform')?>
                 
                     
                    
                    <div class="box-body">

                        
                      <div class="col-md-12">
                         <div class="form-group">
                             
                                <div class="form-group">
                             <div class="col-md-3">
                            <label>Student Name</label>
                    <input type="text" name="student" class="form-control" value="<?php echo $student['class']; ?>">
                        </div>

                         <div class="col-md-3">
                            <label>Class</label>
                     <input type="text" name="class" class="form-control" value="<?php echo $student['section_id']; ?>">
                        </div>

                        <div class="col-md-3">
                            <label>Section</label>
                     <input type="text" name="section" class="form-control" value="<?php echo $student['section_id']; ?>">
                        </div>
                        </div>
                         </div>

                      </div>

                                
<div class="col-md-12">

    <div class="form-group">
    
                        <div class="col-md-3">
                            <label>From</label>
                            <input type="text" name="leavefrom" id="leavefrom" class="form-control">
                        </div>
                       
                        <div class="col-md-3">
                            <label>To</label>
                            <input type="text" name="leaveto" id="leaveto" class="form-control">
                        </div>
                      
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="time_status" class="form-control">
                                <option value="">Select</option>
                                <option value="half">Half Day</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Reason</label>
                            <textarea name="reason" class="form-control"></textarea>
                        </div>
                        </div>

</div>

                        <div class="col-md-2 toppadding_sm">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
    <?=form_close()?>
                    </div>
                </div>
        </div>
    </section>
    
</div>


<script type="text/javascript">
     $(document).ready(function () {
     $('#leavefrom,#leaveto').datepicker({
            format: date_format,
            autoclose: true
        });

 });

</script>
