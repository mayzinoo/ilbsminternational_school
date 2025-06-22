<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-envelope"></i> <?php echo $this->lang->line('communicate'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>
        </h1>
    </section>   
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid1">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-envelope"></i> Private Notice Lists</h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url() ?>admin/Mailsms/compose" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('post_new_message'); ?></a>
                        </div>
                    </div>                 
                    <div class="box-body">
                        <div class="box-group" id="accordion">                          
                            <?php if (empty($listMessage)) {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            } else {
                                foreach ($listMessage as $key => $notification) {
                                    ?>
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $notification['id']; ?>" aria-expanded="false" class="collapsed">
                                                    <?php echo $notification['title']; ?>
                                                </a>
                                            </h4>
                                            <div class="pull-right">
                                                <!-- <a href="<?php echo base_url() ?>admin/Mailsms/edit/<?php echo $notification['id'] ?>" class="" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" data-original-title="<?php echo $this->lang->line('add'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a> -->
                                                &nbsp;  <a href="<?php echo base_url() ?>admin/Mailsms/delete/<?php echo $notification['id'] ?>" class="" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" data-original-title="<?php echo $this->lang->line('add'); ?>">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div id="collapse<?php echo $notification['id']; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <?php echo $notification['message']; ?>
                                                    </div><!-- /.col -->
                                                    <div class="col-md-3">
                                                        <div class="box box-solid">
                                                            <div class="box-body no-padding">
                                                                <ul class="nav nav-pills nav-stacked">
                                                                    <li><i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('publish_date'); ?> : <?php echo $notification['created_at']; ?> </li>

                                                                </ul>
                                                                <h4 class="text text-primary">

                                                                 <?php echo $this->lang->line('message_to')." "; 

                                                                 if($notification["is_group"]==1)
                                                                 {echo "Group";}
                                                                if($notification["is_individual"]==1)
                                                                {echo "Individdual";}
                                                                if($notification["is_class"])
                                                                {
                                                                    $cla=$this->db->get_where("classes",array("id",$notification["class_list"]))->row();
                                                                    echo "Class ".$cla->class;}
                                                                ?></h4>
                                                              

                                                                <ul class="nav nav-pills nav-stacked">
                                                                <?php  
                                                                if($notification["is_individual"]==1)
                                                                {

                                                                    $n=$notification['user_list'];
                                                                    $array=array_map('intval', explode(',', $n));
                                                                    $array = implode("','",$array);
                                                                    $exp=$this->db->query("SELECT guardian_name FROM students WHERE id IN ('$array')");
                                                                    foreach($exp->result_array() as $e):
                                                                    ?>
                                                                    <li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $e['guardian_name']; ?> </li>
                                                                    <?php
                                                                    endforeach;
                                                                }


                                                                if($notification["is_class"]==1)
                                                                {

                                                                    $n=$notification['section_list'];
                                                                    $array=array_map('intval', explode(',', $n));
                                                                    $array = implode("','",$array);
                                                                    $exp=$this->db->query("SELECT section FROM sections WHERE id IN ('$array')");
                                                                    foreach($exp->result_array() as $e):
                                                                    ?>
                                                                    <li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $e['section']; ?> </li>
                                                                    <?php
                                                                    endforeach;
                                                                }
                                                                 ?>
                                                                 
                                                                </ul>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>
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
        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

</script>
<script>
    $(function () {

        $("#compose-textarea").wysihtml5();
    });
</script>