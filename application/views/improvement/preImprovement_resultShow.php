<div class="content-wrapper" style="min-height: 946px;"> 
<section class="content-header">
<h1>
<i class="fa fa-mortar-board"></i>Preschool Improvement Results <small><?php echo $this->lang->line('student_fees1'); ?></small>
</h1>

</section>
<!-- Main content -->
<section class="content">
<div class="row">          
<div class="col-md-12">
<!-- general form elements -->
<div class="box box-primary">

<div class="box-body">
<div class="table-responsive mailbox-messages">
<div class="download_label">Preschool Improvement Results </div>
<table class="table table-striped table-bordered table-hover example">
<thead>

<tr>

<td class="" colspan="5" style="font-weight:bold;"> Class	:	<span style="width:10%;text-align:left;padding-left:10px;"><?=$resultlist->class?>(<?=$resultlist->section?>)</span><br/>
Teacher : <span style="text-align:left;padding-left:10px;"><?=$resultlist->tname?></span><br/>
Date : <span style="width:10%;text-align:left;padding-left:10px;"><?=$resultlist->created_at?></span></td>
</tr>
<tr>
<td colspan="3"><h3>သင္ခန္းစာေခါင္းစဥ္ : <?=$resultlist->lessontitle?></h3></td>
</tr>
<tr>
    <th width="15">No</th>
    <th>Student</th>
    <th>Subject</th>
    <th>Grade</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
    
<?php 
$i=1;
foreach($lists->result() as $row):

?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row->firstname.$row->lastname; ?></td>
        <td><?php echo $row->lessontitle; ?></td>
        <td>
            <?php if($row->grade=="3"){
                echo "ေကာင္း";
            }else if($row->grade=="2"){
                echo "သင့္";
            }else{
                echo "လို";
            }?>
        </td>
        <td class="mailbox-date">
            <a href="<?php echo base_url(); ?>improvement/Improvement_result/preedit_show/<?php echo $row->improvement_id?>/<?php echo $row->preid?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                <i class="fa fa-pencil"></i>
            </a>
           
        </td>
    </tr>
<?php 
$i++; 
endforeach; 
?>
</tbody>
</table><!-- /.table -->



</div><!-- /.mail-box-messages -->

	<div class="pull-right">

<br/>
		---------------
		<br/>
		<?=$show->tname?>
		<br/>
		<?=$show->tposition?>
	</div>
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