<!DOCTYPE html>
<html>
<head>
    <title>Attendances</title>
            <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">    
</head>
<body>

 <div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content">
        <div class="container">
        <div class="col-md-3"></div>
            <div class="col-md-6 thumbnail"  style="background:black;padding: 30px 70px 70px 70px;">

                <div class="box box-primary">
                 <p align="center"><img src="<?php echo base_url(); ?>backend/images/logo.png" alt="<?php echo $this->customlib->getAppName() ?>" width="75%"/></p>

 <section class="content-header">
        <h1 style="text-align:center;   ">
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> Form<small><?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section>
                <div class="form-group">
                <input type="text" name="att_id" value="" id="att_id" class="form-control" onkeyup="insert_teaattendance(this.value)">

                </div>
                <div class="form-group">
                    <span id="stu_result" >
                    </span>
                </div>
                    </div>
            </div>
                    <div class="col-md-3"></div>

        </div>
    </section>


    

</div>
<style type="text/css">
h1
{
    color:green;
    padding:20px;

}
    #stu_result
    {
       color:green;
       font-size: 2em;
       text-align: center;
    }
    .show_stu_result
    {
        display: block;
    }
    body
    {
        margin-top: 4%;
    }
</style>
<script type="text/javascript">
$(window).on('load', function() {
    $("#att_id").focus();
})</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>

</body>
</html>
