<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    .icon-box,.icon-box2,.icon-box3,.icon-box4,
    .icon-box5,.icon-box6,.icon-box7,.icon-box8,.icon-box9,.icon-box10,.icon-box11,.icon-box12
    {
    /*padding: 9px 42px;*/
    text-align: center;
        width: 180px;
    height: 121px;
    }
    .icon-box{
        background: #32abb0;
    }
   .icon-box2 {

    background: #2a8605;

}


.icon-box3 {

    background: #7a10cb;

}

.icon-box4 {

    background: #00a;

}


.icon-box5 {

    background: #e00000;

}

.icon-box6 {

    background: #8b1069;

}
    .icon-box7{
        background:#7c27fb;
    }
    .icon-box8{
        background:#2b1944;
    }
    .icon-box9{
        background:#7c27fb;
    }
    .icon-box10{
        background:#e64e09;
    }
    .icon-box11{
        background:#0e4d4a;
    }
    
     .icon-box12{
        background:#684b09;
    }
    .icon-box p,.icon-box2 p,.icon-box3 p,.icon-box4 p,
    .icon-box5 p,.icon-box6 p,.icon-box7 p,.icon-box8 p,.icon-box9 p,.icon-box10 p,.icon-box11 p,.icon-box12 p,
    .icon-box i,.icon-box2 i,.icon-box3 i,.icon-box4 i,
    .icon-box5 i,.icon-box6 i,.icon-box7 i,.icon-box8 i,.icon-box9 i,.icon-box10 i,.icon-box11 i ,.icon-box12 i
    {
        padding: 10px 0px 0px 0px;
        color:#fff;
        font-weight:bold;
    }
    .toppadding_sm{
        padding-top:10px;
    }
    .fa-4x{
        padding-top:15px;
    }
    
    @media only screen and (min-width:200px) and (max-width: 480px){
        .fa-4x{
            font-size:2em !important;
            padding-top:25px !important;
        }
        .icon-box p, .icon-box2 p, .icon-box3 p, .icon-box4 p, .icon-box5 p, .icon-box6 p, .icon-box7 p, .icon-box8 p, .icon-box9 p, .icon-box10 p, .icon-box11 p,.icon-box12 p{
            font-size:10px !important;
        }
         .icon-box,.icon-box2,.icon-box3,.icon-box4,
    .icon-box5,.icon-box6,.icon-box7,.icon-box8,.icon-box9,.icon-box10,.icon-box11,.icon-box12
        {
        width: 120px;
        height: 100px;
        margin-bottom: 0px;
        }
        .icon-box p, .icon-box2 p, .icon-box3 p, .icon-box4 p, .icon-box5 p, .icon-box6 p, .icon-box7 p, .icon-box8 p, .icon-box9 p, .icon-box10 p, .icon-box11 p, .icon-box12 p{
            padding:5px 0px 0px 0px !important;
        }
    .fixed .content-wrapper, .fixed .right-side{
        padding-top:50px !important;
    }
    .content-wrapper{
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8b1069+2,7a10cb+100 */
background: #8b1069; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, #8b1069 2%, #7a10cb 100%); /* FF3.6-15 */
background: -webkit-radial-gradient(center, ellipse cover, #8b1069 2%,#7a10cb 100%); /* Chrome10-25,Safari5.1-6 */
background: radial-gradient(ellipse at center, #8b1069 2%,#7a10cb 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8b1069', endColorstr='#7a10cb',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }
    .nopadding{
        padding:0px !Important;
    }
    .toppadding{
        padding-top:10px !important;
        margin-top:-10px;
    }
    span.notice{
        position:absolute;
        top: 57px;
        left: 36px;
        z-index:10;
    }
    span.noticebell i{
        margin-left: 20px !important;
    }
    .bg-red, .callout.callout-danger, .alert-error, .label-danger, .modal-danger .modal-body{
        padding: 8px;
        position: relative;
        z-index: 100;
        right: 10px;
    }
    }
</style>

<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">  
   
    </section>
    <section class="content">
        <div class="row toppadding">
            <div class="col-md-2 col-xs-4 nopadding">
                 <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
                <a href="<?php echo base_url(); ?>parent/parents/getstudent/<?php echo $value_ch['student_id'] ?>" class="icon-box">
               <div class="">
                  
                   <i class=" fa fa-users fa-4x"></i>
                    
                   <p>My Children</p>
               </div>
               <?php
                    }
                    ?>
               </a>
                
            </div>
            <div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
                <a href="<?php echo base_url(); ?>parent/parents/getfees/<?php echo $value_ch['student_id'] ?>">
                <div class="icon-box2">
                    
                   <i class="fa fa-money fa-4x"></i>
                   
                   <p>Fees</p>
               </div>
                <?php
                    }
                    ?>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
                <a href="<?php echo base_url(); ?>parent/parents/gettimetable/<?php echo $value_ch['student_id'] ?>">
                <div class="icon-box3">
                    
                   <i class="fa fa-calendar-times-o fa-4x"></i>
                   <p>Class Timetable</p>
                   
               </div>
                <?php
                    }
                    ?>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
                    <a href="<?php echo base_url(); ?>parent/parents/getattendence/<?php echo $value_ch['student_id'] ?>">
                <div class="icon-box6">
                    
                   <i class="fa fa-calendar fa-4x"></i>
                   <p>Attendance</p>
                   
               </div>
                <?php
                    }
                    ?>
                </a>
            </div>

              <div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
                    <a href="<?php echo base_url(); ?>parent/parents/leave/<?php echo $value_ch['student_id'] ?>">
                <div class="icon-box10">
                    
                   <i class="fa fa-calendar-check-o fa-4x"></i>
                   <p>Leave</p>
                   
               </div>
                <?php
                    }
                    ?>
                </a>
            </div>

            <div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
<a href="<?php echo site_url("parent/".$student['level']."_Reportcard/rpcardsfront/" . $student['id']) ?>" >

               <div class="icon-box5">
                   <i class="fa fa-map-o fa-4x"></i>
                   <p>Reportcard</p>
                   
               </div>
                <?php
                    }
                    ?>
            </a>
            </div>

            <?php 


             ?>


<div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
<a href="<?php echo site_url("parent/parents/inter_reportcard/" . $student['id']) ?>">

               <div class="icon-box4">
                   <i class="fa fa-map-o fa-4x"></i>
                   <p>Inter Reportcard</p>
                   
               </div>
                <?php
                    }
                    ?>
            </a>
            </div>
           
            <?php



             ?>
            <div class="col-md-2 col-xs-4 nopadding">
                <a href="<?php echo base_url(); ?>parent/notification">
                <div class="icon-box5">
                <i class="fa fa-bell fa-4x"> </i>
                    <?php
                                $ntf = $this->customlib->getParentunreadNotification();

                                if ($ntf) {
                                    ?>
                                    <small class="label pull-right bg-red">
                                        <?php echo $ntf; ?>
                                    </small>
                                    <?php
                                }
                                ?>
                   <p>Notice Board</p>
                   
               </div>
                </a>
            </div>
        
        
               <div class="col-md-2 col-xs-4 nopadding">
                <a href="<?php echo base_url(); ?>parent/notification/privatenotice">
                <div class="icon-box5">
                <i class="fa fa-envelope fa-4x"> </i>
                    <?php
                                $ntf = $this->customlib->getParentunreadMessage();

                                if ($ntf) {
                                    ?>
                                    <small class="label pull-right bg-red">
                                        <?php echo $ntf; ?>
                                    </small>
                                    <?php
                                }
                                ?>
                   <p>Messages</p>
                   
               </div>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 nopadding">
                <?php
                    $ch = $this->session->userdata('parent_childs');
                    foreach ($ch as $key_ch => $value_ch) {
                        ?>
                <a href="<?php echo base_url(); ?>parent/parents/getsubject/<?php echo $value_ch['student_id'] ?>">
               <div class="icon-box8">
                   
                   <i class="fa fa-language fa-4x"></i>
                   <p>Subjects</p>
                   
               </div>
                <?php
                    }
                    ?>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 nopadding">
                <a href="<?php echo base_url(); ?>parent/teacher">
                <div class="icon-box2">
                   <i class="fa fa-group fa-4x"></i>
                   <p>Teachers</p>
               </div>
            </a>
            </div>
            <div class="col-md-2 col-xs-4 nopadding">
                <a href="<?php echo base_url(); ?>parent/book">
                <div class="icon-box3">
                   <i class="fa fa-book fa-4x"></i>
                   <p>Library Books</p>
               </div>
               </a> 
            </div>
             <div class="col-md-2 col-xs-4 nopadding">
            <a href="<?php echo base_url(); ?>parent/Parents/weeklypreparation/<?=$value_ch['student_id']?>">
                <div class="icon-box5">
                   <i class="fa fa-list fa-4x"></i>
                   <p>Weekly Lecture</p>
               </div>
            </a>    
            </div>
            
             <div class="col-md-2 col-xs-4 nopadding">
            <a href="<?php echo base_url(); ?>parent/Parents/dailyrecord/<?=$value_ch['student_id']?>">
                <div class="icon-box6">
                   <i class="fa fa-list fa-4x"></i>
                   <p>Daily Lecture</p>
               </div>
            </a>    
            </div>
             <?php  $this->session->userdata('class'); ?>   
             <div class="col-md-2 col-xs-4 nopadding">
            <a href="<?php echo base_url(); ?>parent/Parents/exam_schedule/<?=$value_ch['student_id']?>">
                <div class="icon-box2">
                   <i class="fa fa-calendar fa-4x"></i>
                   <p>Exam Schdules</p>
               </div>
            </a>    
            </div>
            
            <div class="col-md-2 col-xs-4 nopadding">
            <a href="<?php echo base_url(); ?>parent/route">
                <div class="icon-box4">
                   <i class="fa fa-bus fa-4x"></i>
                   <p>Transport Routes</p>
               </div>
            </a>    
            </div>
            <!-- <div class="col-md-2 col-xs-4 nopadding">
            <a href="<?php echo base_url(); ?>parent/hostel">
                <div class="icon-box12">
                   <i class="fa fa-building-o fa-4x"></i>
                   <p>Hostels</p>
               </div>
            </a>    
            </div> -->
            
            
             <div class="col-md-2 col-xs-4 nopadding">
            <a href="<?php echo base_url(); ?>parent/parents/feedback">
                <div class="icon-box11">
                   <i class="fa fa-envelope fa-4x"></i>
                    <?php
                                $ntf = $this->customlib->getParentunreadFeedback();

                                if ($ntf) {
                                    ?>
                                    <small class="label pull-right bg-red">
                                        <?php echo $ntf; ?>
                                    </small>
                                    <?php
                                }
                    ?>
                   <p>Feedback</p>
               </div>
            </a>    
            </div>
            
              <div class="col-md-2 col-xs-4 nopadding">
            <a href="http://www.ilbsm.itcurrent.com">
                <div class="icon-box10">
                   <i class="fa fa-globe fa-4x"></i>
                   <p>Website</p>
               </div>
            </a>    
            </div>
            
             <div class="col-md-2 col-xs-4 nopadding">
            <a href="https://www.facebook.com/pages/ILBSM-International-School/1807581506171498">
                <div class="icon-box4">
                   <i class="fa fa-facebook-square fa-4x"></i>
                   <p>Facebook</p>
               </div>
            </a>    
            </div>
            
            
   

            
        </div>
    </section>
</div>
