<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('teacher/student/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-3">
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
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>   
                                        </div>
                                        
                                          <div class="col-sm-3">
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

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                </div>  
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('teacher/student/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" class="form-control"   placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($resultlist)) {
                    ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?>  <?php echo $this->lang->line('view'); ?></a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details'); ?> <?php echo $this->lang->line('view'); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="download_label"><?php echo $title; ?></div>
                            <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Admission</th>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th><?php echo $this->lang->line('gender'); ?></th>
                                            <th><?php echo $this->lang->line('category'); ?></th>
                                            <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                            <th>School</th>

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($resultlist)) {
                                            ?>
                                                            <!-- <tr>
                                                                <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                            </tr> -->
                                            <?php
                                        } else {
                                            $count = 1;
                                            foreach ($resultlist as $student) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $student['admission_no']; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>teacher/student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                    <td><?php echo $student['father_name']; ?></td>
                                                    <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                                    <td><?php echo $student['gender']; ?></td>
                                                    <td><?php echo $student['category']; ?></td>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                    <td><?php echo $student['mobileno']; ?></td>


                                                    <td class="pull-right">

                                                    <span data-toggle="modal" data-target="#idcard<?=$student['id']?>" class="btn btn-default btn-xs" title="Student Card">
                                                            <i class="fa fa-user"></i>
</span>

<!-- Modal -->
<div class="modal fade" id="idcard<?=$student['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" align="center">
         <?php echo $this->setting_model->getCurrentSchoolName(); ?>
</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
            <div class="col-md-5"> 
             <img src="<?=base_url()?><?=$student['image']?>" height="100"/>
               <img alt="<?php echo $student['firstname'].$student['lastname'] ?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($student['id'],8,"0",STR_PAD_LEFT)?>&sy=0.5&&ms=r&md=0.8"/>
             </div>
            <div class="col-md-6" align="left">
              <p>
             Name :  <?php   echo $student['firstname']." ".$student['lastname']?>
              </p>
               <p>
             Class : <?php echo $student['class'] . "(" . $student['section'] . ")"?>
            </p>
             <p>
             Adminssion No : <?php echo $student['admission_no']?>
            </p>

             <p>
             D.O.B  : <?php echo $student['dob']?>
            </p>   
            <p>
             Address : <?php echo $student['address']?>
            </p>
                   <p>
             Phone : <?php echo $student['phone']?>
            </p> 

     
            
            </div>
         
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url()?>teacher/Student/cardprint/<?php echo $student['id'] ?>" class="btn btn-primary" target="_blank">Print</a>
      </div>
    </div>
  </div>
</div>


 <span data-toggle="modal" data-target="#gurdiancard<?=$student['id']?>" class="btn btn-default btn-xs" title="Gurdian Card">
                                                            <i class="fa fa-users"></i>
</span>

<!-- Modal -->
<div class="modal fade" id="gurdiancard<?=$student['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
   
          <?php
          
     $setting=$this->Setting_model->getSetting($student['school']);

 ?>
<table width="100%">
  <tr> 
  <td width="10%"><img src="<?=base_url()?>uploads/school_content/logo/<?=$setting->image?>" height="70"/></td>
  <td align="center" colspan="2">
 <?php 
 echo $setting->name;
 echo "<br/>".$setting->address;
 echo "<br/>".$setting->phone;
 echo "<br/>မိဘအုပ္ထိန္းသူမွ ကေလးၾကိဳခြင့္ ကဒ္ျပား";
  
 ?>
 </td>
 
</tr>
<tr><td colspan="3" size=3><hr/></td></tr>
   
   <tr>
       <td>အမည္</td>
<td> <?php   echo $student['firstname']." ".$student['lastname']?></td>
<td rowspan="3"><img src="<?=base_url()?><?=$student['image']?>" height="70"/></td>
</tr>
 
   <tr>
 <td>အတန္း</td>

<td><?php echo $student['class'] . " (" . $student['section'] . ")"?></td>
</tr> 

<tr>
<td>မိဘအမည္</td>

    <td><?php echo $student['father_name']." + ".$student["mother_name"]?></td></tr> 

<tr><td>လိပ္စာ</td
></td><td><?php echo $student['guardian_address']?></td></tr> 
<tr><td>မွတ္ခ်က္</td
></td><td>ကေလဘးကို လာေရာက္ၾကိဳသည့္ အခ်ိန္တိုင္း ေက်းဇူးျပဳ၍ ဤကဒ္ကို ယူေဆာင္လာပါရန္။ </td></tr> 

</table>
         
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url()?>teacher/Student/gurdiancardprint/<?php echo $student['id'] ?>" class="btn btn-primary" target="_blank">Print</a>
      </div>
    </div>
  </div>
</div>
                                                        <a href="<?php echo base_url(); ?>teacher/student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                            <i class="fa fa-reorder"></i>
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>teacher/student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
                                                            <?php echo $currency_symbol; ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>                           
                            <div class="tab-pane" id="tab_2">
                                <?php if (empty($resultlist)) {
                                    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($resultlist as $student) {
                                        ?>
                                        <div class="carousel-row">
                                            <div class="slide-row">
                                                <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a href="<?php echo base_url(); ?>teacher/student/view/<?php echo $student['id'] ?>"> <img class="img-responsive img-thumbnail width150" alt="Cinque Terre" src="<?php echo base_url() . $student['image'] ?>" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4><a href="<?php echo base_url(); ?>teacher/student/view/<?php echo $student['id'] ?>"> <?php echo $student['firstname'] . " " . $student['lastname'] ?></a></h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                <strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                                <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
                                                                <b><?php echo $this->lang->line('date_of_birth'); ?>:
                                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?><br>
                                                                    <b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $student['gender'] ?><br>
                                                                    </address>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
                                                                        <b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
                                                                        <b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?><br>
                                                                        <b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="slide-footer">
                                                                        <span class="pull-right buttons">
                                                                            <a href="<?php echo base_url(); ?>teacher/student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                                                <i class="fa fa-reorder"></i>
                                                                            </a>
                                                                            <a href="<?php echo base_url(); ?>teacher/student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </a>
                                                                            <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">    
                                                                                <?php echo $currency_symbol; ?>
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                $count++;
                                                            }
                                                            ?>
                                                            </div>                                                          
                                                            </div>                                                         
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
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