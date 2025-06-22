<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">    
<style type="text/css">
    td.brk {
  word-break: break-all !important;
}
    
</style>
       <div class="col-md-12">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('student/barcodeprint_search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-2">
                                            <div class="form-group"> 
                                                <label><?php echo $this->lang->line('class'); ?></label>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>  
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Inter Class</label>
                                                 <?php echo form_dropdown("inter_class",$inter_class,set_value("inter_class"),"class='form-control'");?>
                                                <span class="text-danger"><?php echo form_error('inter_class'); ?></span>
                                            </div>   
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>   
                                        </div>
                                        
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Resign Status</label>
                                                <?=form_dropdown("resign",array(0=>"No",1=>"Yes"),set_value("resign"),"class='form-control'")?>
                                                <span class="text-danger"><?php echo form_error('resign'); ?></span>
                                            </div>   
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>School</label>
                                                <?=form_dropdown("school",$school,set_value("school"),"class='form-control'")?>
                                                <span class="text-danger"><?php echo form_error('school'); ?></span>
                                            </div>   
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <br/>
                                                <button type="submit" name="search" value="search_filter" class="btn btn-danger btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                </div>  
                                </form>
                            </div>
 <div class="col-md-12">	

<table width="100%" class="table table-bordered">
    <tr>
        <td width="10">No</td>
        <td>ADM.NO</td>
        <td>Name</td>
        <td>Class</td>
        <td>Parent</td>
        <td>Phone</td>
        <td>Address</td>
        <td>Photo</td>
        <td>Barcode</td>
        
    </tr>
    <?php  $i=1; foreach ($resultlist as $student) {?>
  <tr><td><?=$i?></td>
  <td><?=$student["admission_no"]?></td><td><?=$student['firstname'] . " " . $student['lastname']?></td>
  <td><?=$student['class'] . "(" . $student['section'] . ")"?></td>
  <td><?=$student['father_name']?> + <?=$student['mother_name']?></td>
    <td class='brk'><?=$student['mobileno']?></td>

  <td class='brk'><?=$student['guardian_address']?></td>
  <td><img src="<?=base_url().$student['image']?>" width="80"/></td>
  <td>  <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.5&&ms=r&md=0.8"/></td></tr>
  
  <?php $i++;}?>

</table>
 </div>


<script type="text/javascript">
//window.print();
</script>