<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">       
       
            <div class="col-md-12">              
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('teacher_list'); ?></h3>
 <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>admin/Teacher/create" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('add_timetable'); ?>" >
                                <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                            </a>
                        </div>
                                           </div>
                    <div class="box-body">

                    <div class="row">
                    
                    <?=form_open("admin/Teacher/search")?>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Location</label>
<?php echo form_dropdown("location",$school,set_value("location"),"class='form-control'"); ?>
<span class="text-danger"><?php echo form_error('location'); ?></span>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="exampleInputEmail1">Resign</label>
<?php echo form_dropdown("resign",array(0=>"No",1=>"Yes"),set_value("resign"),"class='form-control'");?>
<span class="text-danger"><?php echo form_error('resign'); ?></span>
</div>
</div>

<div class="col-md-4">
<div class="form-group">

<label for="exampleInputEmail1"></label>
<br/>
<button type="submit" name="search" value="search" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
</div>
</div>
<?=form_close()?>
</div>
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
						<div class="download_label"><?php echo $this->lang->line('teacher_list'); ?> </div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Finger ID</th>
                                        <th><?php echo $this->lang->line('teacher_name'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th>Location</th>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($teacherlist as $teacher) {
                                        ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['finger_id'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['email'] ?></td>
                                            <td class="mailbox-name"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($teacher['dob'])); ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['phone'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['ltext'] ?></td>
                                            <td class="mailbox-date pull-right no-print">
                                              <span data-toggle="modal" data-target="#teachercard<?=$teacher['id']?>" class="btn btn-default btn-xs">
                                                            <i class="fa fa-image"></i>
                                                </span>



                                                <div class="modal fade" id="teachercard<?=$teacher['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
             <img src="<?=base_url()?><?=$teacher['image']?>" height="100"/>
               <img alt="<?php echo $teacher['name']?>" src="<?php echo base_url()?>
barcode.php?f=svg&s=code39&d=<?=str_pad($teacher['id'],8,"0",STR_PAD_LEFT)?>&sy=0.5&&ms=r&md=0.8"/>
             </div>
            <div class="col-md-6" align="left">
              <p>
             Name :  <?php   echo $teacher['name']?>
              </p>
              
                 <p>
           Start Date  : <?php echo $teacher['entryDate']?>
            </p>   
            <p>
             Address : <?php echo $teacher['address']?>
            </p>
                   <p>
             Phone : <?php echo $teacher['phone']?>
            </p> 

     
            
            </div>
         
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url()?>admin/Teacher/teachercardprint/<?php echo $teacher['id'] ?>" class="btn btn-primary" target="_blank">Print</a>
      </div>
    </div>
  </div>
</div>
                                                <a href="<?php echo base_url(); ?>admin/teacher/view/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/teacher/edit/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/teacher/delete/<?php echo $teacher['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#dob,#admission_date').datepicker({
            format: date_format,
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>
