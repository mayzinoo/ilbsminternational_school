<div class="content-wrapper" style="min-height: 946px;"> 
<section class="content-header">
<h1>
<i class="fa fa-mortar-board"></i> Daily Records <small><?php echo $this->lang->line('student_fees1'); ?></small>
</h1>
</section>
<!-- Main content -->
<section class="content">
<div class="row">          
   <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Daily Records</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">Daily Records</div>
                            <table class="table table-striped table-bordered table-hover example">
                                 <thead>
                                 <?php $show=$lists->row();?>
                                 <tr>
                                 	<td></td>
                                 	<td></td>
                                 	<td class="text-right">သင္ၾကားမည့္ အတန္း	:	<span style="width:10%;float:right;text-align:left;padding-left:10px;"><?=$show->class?></span><br/>
                                 	သင္ၾကားမည့္ ဘာသာရပ္ : <span style="width:10%;float:right;text-align:left;padding-left:10px;"><?=$show->section?></span></td>
                                 </tr>
                                 <tr>
                                 	<td colspan="3"><h3>ေန႕စဥ္မွတ္တမ္း</h3></td>
                                 </tr>
                                    <tr>
                                        <th>Subjects
                                        </th>
                                        <th>Description
                                        </th>                                      
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($lists)) {
                                        ?>
                                    <tfoot>    
                                        <tr>
                                            <td colspan="3" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>

                                        </tr>
                                    </tfoot>
                                    <?php
                                } else {
                                    foreach ($lists->result() as $expense) {
                                        ?>
                                        <tr>
                                          <td class="mailbox-name">
                                                <?php echo $expense->sname; ?>

                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $expense->tdes; ?>
                                            </td>
                                        
                                           <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>teacher/teacherdiary/dailyrecord/view/<?php echo $expense->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>teacher/teacherdiary/dailyrecord/edit/<?php echo $expense->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>teacher/teacherdiary/dailyrecord/delete/<?php echo $expense->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->

</div> 
</section>
</div>

<script type="text/javascript">
$(document).on('click', '.schedule_modal', function () {
$('.modal-title').html("");
$('.modal-title').html("<?php echo $this->lang->line('login_details'); ?>");
var base_url = '<?php echo base_url() ?>';
var teacher_id = '<?php echo $teacher["id"] ?>';
var teacher_name = '<?php echo $teacher["name"] ?>';
$.ajax({
type: "post",
url: base_url + "admin/teacher/getlogindetail",
data: {'teacher_id': teacher_id},
dataType: "json",
success: function (response) {
var data = "";
data += '<div class="table-responsive">';
data += '<p class="lead text text-center">' + teacher_name + '</p>';
data += '<table class="table table-hover">';
data += '<thead>';
data += '<tr>';
data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
data += '</tr>';
data += '</thead>';
data += '<tbody>';
$.each(response, function (i, obj)
{
console.log(obj);
data += '<tr>';
data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
data += '<td class="text text-center">' + obj.username + '</td> ';
data += '<td class="text text-center">' + obj.password + '</td> ';
data += '</tr>';
});
data += '</tbody>';
data += '</table>';
data += '<b class="lead text text-danger" style="font-size:14px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
data += '</div>  ';
$('.modal-body').html(data);
$("#scheduleModal").modal('show');
}
});
});

function firstToUpperCase(str) {
return str.substr(0, 1).toUpperCase() + str.substr(1);
}
</script>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title"></h4>
</div>
<div class="modal-body">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
</div>
</div>
</div>
</div>