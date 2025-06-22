<!DOCTYPE html>
<html <?php echo $this->customlib->getRTL(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->customlib->getAppName(); ?></title>       
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="theme-color" content="#424242" />
        <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">    
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css"> 
        <?php
        $this->load->view('layout/theme');
        ?>
        <?php
        if ($this->customlib->getRTL() != "") {
            ?>
            <!-- Bootstrap 3.3.5 RTL -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/bootstrap-rtl/css/bootstrap-rtl.min.css"/>  
            <!-- Theme RTL style -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/AdminLTE-rtl.min.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/ss-rtlmain.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/skins/_all-skins-rtl.min.css" />
            <?php
        }
        ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">      
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">       

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">      i
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">       
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">       
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">      
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
        <!--print table-->
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
        
        <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>       
        <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/template.js"></script>
        <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";

        </script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and me/
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>
    <style>
    .nav > li > a{
        padding:10px 10px !important;
    }
    </style>
    <?php
    
      $feedbacks=$this->db->query("SELECT students.guardian_name ,feedback.* FROM feedback JOIN students ON feedback.user_id=students.id WHERE feedback.viewm=0 AND reply_by = '' ");
      
    $contact_message=$this->db->query("SELECT * FROM message_from_website WHERE status=0");
    $totalcm=$contact_message->num_rows();
    
     $student_enroll=$this->db->query("SELECT * FROM student_info WHERE status=0");
     $totaler=$student_enroll->num_rows();
     
      $onlinecv=$this->db->query("SELECT * FROM onlinecv WHERE status=0");
     $totalcv=$onlinecv->num_rows();
     
     $leaveuser=$this->db->query("SELECT leave_tbl.*,students.* FROM leave_tbl LEFT JOIN students ON leave_tbl.student_id=students.id WHERE leave_status=0 ORDER BY leave_tbl.created_at");
     $total=$leaveuser->num_rows();
     
    //  $sql = "SELECT sessions.*, IFNULL(sch_settings.session_id, 0) as `active` FROM `sessions` LEFT JOIN sch_settings ON sessions.id=sch_settings.session_id";
     $cur_session=$this->db->query("Select * from sch_settings")->row();
     $cur_sess=$cur_session->session_id;
     
     
     
    ?>
   
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header" id="alert">            
                <a href="<?php echo base_url(); ?>admin/admin/dashboard" class="logo">                 
                    <span class="logo-mini">S S</span>                 
                    <span class="logo-lg"><img src="<?php echo base_url(); ?>backend/images/s_logo.png" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                </a>             
                <nav class="navbar navbar-static-top" role="navigation">                  
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="col-md-3 col-sm-3 col-xs-5"> 
                        <span href="#" class="sidebar-session">
                            <?php echo $this->setting_model->getCurrentSchoolName(); ?>
                        </span>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="pull-right">    
                            <!-- <form class="navbar-form navbar-left search-form" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="input-group" style="padding-top:3px;">
                                    <input type="text" name="search_text" class="form-control search-form search-form3" placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form> -->

                            <div class="navbar-custom-menu">
                                
                                <ul class="nav navbar-nav"> 
                                
                                <li class="dropdown">
                                        
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">  <i class="fa fa-comments fa-fw"></i> Feedbacks  <i class="badge"><?=$feedbacks->num_rows()?></i>
                                             <i class="fa fa-caret-down"></i>
                                        </a>
                                         <ol class="dropdown-menu dropdown-user">
                                          <?php foreach($feedbacks->result() as $fb):?>
                                          <li><a href="<?php echo base_url(); ?>admin/admin/feedback/<?=$fb->id?>">
                                              <?php echo $fb->guardian_name?><br/>
                                              <span class="text-right"><?=$fb->date?></span>
                                              </a>
                                            </li>
                                            <li class="divider"></li>
                                            <?php endforeach;?>
                                            <!--<li class="divider"></li>-->
                                            <!--<li><a href="<?php echo base_url(); ?>admin/messages"><i class="fa fa-minus"></i> Hello</a>-->
                                            <!--</li>-->
                                        </ol>                              
                                    </li>   
                                <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"> <i class="fa fa-user fa-fw"></i> Leave <i class="badge"><?=$total?></i>
                                             <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ol class="dropdown-menu dropdown-user">
                                         <?php foreach($leaveuser->result() as $row): ?>    
                                          <li><a href="<?php echo base_url(); ?>admin/Leaveuser/leaveuserView/<?=$row->session_id?>">
                                              <i class="fa fa-comment"></i> <?=$row->firstname.$row->lastname?> </a>
                                            </li>
                                        <?php endforeach; ?>
                                        </ol> 
                                    </li>   
                                 <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"> <i class="fa fa-envelope fa-fw"></i> Contacts <i class="badge"><?=$totalcm?></i>
                                             <i class="fa fa-caret-down"></i>
                                        </a>
                                         <ol class="dropdown-menu dropdown-user">
                                         <?php foreach($contact_message->result() as $cm): ?>    
                                          <li><a href="<?php echo base_url(); ?>admin/admin/website_message/<?=$cm->id?>">
                                              <i class="fa fa-comment"></i> <?=$cm->name?> </a>
                                            </li>
                                        <?php endforeach; ?>
                                        </ol>                              
                                    </li>   


                                     <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"> <i class="fa fa-bell fa-fw"></i> Enrolement <i class="badge"><?=$totaler?></i>
                                              <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                        <?php foreach($student_enroll->result() as $se): ?>  
                                          <li><a href="<?php echo base_url(); ?>admin/admin/online_registration/<?=$se->id?>"><i class="fa fa-comment"></i> <?=$se->name?> </a>
                                          </li>
                                        <?php endforeach;?>    
                                        </ul>                             
                                    </li> 
                                    
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"> <i class="fa fa-bell fa-fw"></i>  Recruitments <i class="badge"><?=$totalcv?></i>
                                             <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                        <?php foreach($onlinecv->result() as $oc): ?>  
                                          <li><a href="<?php echo base_url(); ?>admin/admin/onlinecv/<?=$oc->id?>"><i class="fa fa-comment"></i> <?=$oc->name?> </a>
                                            </li>
                                        <?php endforeach;?>    
                                
                                        </ul>                             
                                    </li>  

                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><?php echo $this->customlib->getAdminSessionUserName(); ?>
                                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="<?php echo base_url(); ?>admin/admin/changepass"><i class="fa fa-key"></i> <?php echo $this->lang->line('change_password'); ?></a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('logout'); ?></a>
                                            </li>
                                        </ul>                             
                                    </li>   
                                </ul>
                            </div>
                        </div>
                    </div>   
                </nav>
            </header>
           <aside class="main-sidebar" id="alert2">             
    <section class="sidebar" id="sibe-box">
        <form class="navbar-form navbar-left search-form2" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="input-group ">
                <input type="text" name="search_text" class="form-control search-form" placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>  

        <ul class="sessionul fixedmenu">
            <li class="removehover">
                <a data-toggle="modal" data-target="#sessionModal"><?php echo $this->lang->line('current_session') . ": " . $this->setting_model->getCurrentSessionName(); ?><i class="fa fa-pencil pull-right"></i></a>


            </li>
            <li class="dropdown">
                <a class="dropdown-toggle drop5" data-toggle="dropdown" href="#" aria-expanded="false">
                    <?php echo $this->lang->line('system_settings'); ?> <span class="fa fa-gears pull-right"></span>
                </a>
                <ul class="dropdown-menu verticalmenu" style="min-width:194px;font-size:10pt;left:3px;">
                    <li role="presentation"><a style="color:#282828; font-weight:600;padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/admin/backup"><i class="fa fa-cloud-download"></i><?php echo $this->lang->line('backup / restore'); ?></a></li>
                    <li role="presentation"><a style="color:#282828; font-weight:600;padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>sessions"><i class="fa fa-list"></i><?php echo $this->lang->line('session_setting'); ?></a></li>
					<li role="presentation"><a style="color:#282828; font-weight:600;padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>schsettings"><i class="fa fa-gears"></i>School Setting</a></li>
                    <li role="presentation"><a style="color:#282828; font-weight:600;padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/users"><i class="fa fa-users"></i><?php echo $this->lang->line('users'); ?></a></li>
                    <li role="presentation"><a style="color:#282828; font-weight:600;padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/adminuser"><i class="fa fa-calendar-check-o"></i><?php echo $this->lang->line('admin_users'); ?></a></li>
                    </ul>
            </li>
        </ul>                 
        <ul class="sidebar-menu verttop">
            <li class="treeview <?php echo set_Topmenu('Student Information'); ?>">
                <a href="#">
                    <i class="fa fa-user-plus"></i> <span><?php echo $this->lang->line('student_information'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('student/search'); ?>"><a href="<?php echo base_url(); ?>student/search"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_details'); ?></a></li>
                    

                    <li class="<?php echo set_Submenu('student/create'); ?>"><a href="<?php echo base_url(); ?>student/create"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_admission'); ?></a></li>
                    <li class="<?php echo set_Submenu('category/index'); ?>"><a href="<?php echo base_url(); ?>category"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_categories'); ?></a></li>
                    <li class="<?php echo set_Submenu('stdtransfer/index'); ?>"><a href="<?php echo base_url(); ?>admin/stdtransfer"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('promote_students'); ?></a></li>
                    <li class="<?php echo set_Submenu('Student/resigncertificate/'); ?>"><a href="<?php echo base_url(); ?>Student/resigncertificate"><i class="fa fa-angle-double-right"></i> Resign Certificate</a></li>
                    <li class="<?php echo set_Submenu('admin/hostel/studentroom_list/'); ?>"><a href="<?php echo base_url(); ?>admin/hostel/studentroom_list"><i class="fa fa-angle-double-right"></i> Student Rooms</a></li>
                    
                </ul>
            </li><!--student information-->
            
             <li class="treeview <?php echo set_Topmenu('Teacher'); ?>">
                <a href="#">
                    <i class="fa fa-user-plus"></i> <span>Teacher Information</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
             <li class="<?php echo set_Submenu('teacher/index'); ?>"><a href="<?php echo base_url(); ?>admin/teacher"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('teachers'); ?></a></li>
    
                </ul>
            </li><!--student information-->

            <li class="treeview <?php echo set_Topmenu('Teacherdiary'); ?>">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Teacher's Diary</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="<?php echo set_Submenu('Teacherdiary/index'); ?>"><a href="<?php echo base_url(); ?>teacherdiary/Teacherdiary/"><i class="fa fa-angle-double-right"></i> Course Outlines</a></li>
                     <li class="<?php echo set_Submenu('Teachingnote/index'); ?>"><a href="<?php echo base_url(); ?>teacherdiary/Teachingnote/"><i class="fa fa-angle-double-right"></i> Teaching Notes</a></li>
                     <li class="<?php echo set_Submenu('Weeklypreparation/index'); ?>"><a href="<?php echo base_url(); ?>teacherdiary/Weeklypreparation/"><i class="fa fa-angle-double-right"></i> Weekly Preparations</a></li>
                     <li class="<?php echo set_Submenu('Dailyrecord/index'); ?>"><a href="<?php echo base_url(); ?>teacherdiary/Dailyrecord/"><i class="fa fa-angle-double-right"></i> Daily Records</a></li>
                     <li class="<?php echo set_Submenu('Meetingminutes/index'); ?>"><a href="<?php echo base_url(); ?>teacherdiary/Meetingminutes/"><i class="fa fa-angle-double-right"></i> Meeting Minutes</a></li>
                </ul>
            </li><!--teacher's diary-->
            
             <li class="treeview <?php echo set_Topmenu('Academics'); ?>">
                <a href="#">
                    <i class="fa fa-mortar-board"></i> <span><?php echo $this->lang->line('academics'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('timetable/index'); ?>"><a href="<?php echo base_url(); ?>admin/timetable"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('class_timetable'); ?></a></li>
                    <li class="<?php echo set_Submenu('teacher/assignTeacher'); ?>"><a href="<?php echo base_url(); ?>admin/teacher/assignteacher"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assign_subjects'); ?></a></li>
                    <li class="<?php echo set_Submenu('subject/index'); ?>"><a href="<?php echo base_url(); ?>admin/subject"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('subjects'); ?></a></li>
                    <li class="<?php echo set_Submenu('classes/index'); ?>"><a href="<?php echo base_url(); ?>classes"><i class="fa fa-angle-double-right"></i> Private <?php echo $this->lang->line('class'); ?></a></li>
                    
                    <li class="<?php echo set_Submenu('inter_class/index'); ?>"><a href="<?php echo base_url(); ?>inter_class"><i class="fa fa-angle-double-right"></i> Inter Class</a></li>
                         
                 <!--  <li class="<?php echo set_Submenu('school/index'); ?>"><a href="<?php echo base_url(); ?>school"><i class="fa fa-angle-double-right"></i> Schools</a></li>-->

                    <li class="<?php echo set_Submenu('sections/index'); ?>"><a href="<?php echo base_url(); ?>sections"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('sections'); ?></a></li>
                    <!--<li class="<?php echo set_Submenu('admin/Performance/performance_type'); ?>"><a href="<?php echo base_url(); ?>admin/Performance/performance_type"><i class="fa fa-angle-double-right"></i>-->
                    <!--     Performance Types</a></li>-->
                    <!--<li class="<?php echo set_Submenu('admin/Performance/index'); ?>"><a href="<?php echo base_url(); ?>admin/Performance/index"><i class="fa fa-angle-double-right"></i>-->
                    <!--     Performance Appraisal</a></li>-->
                   	<!--<li class="<?php echo set_Submenu('admin/Qualification/index'); ?>"><a href="<?php echo base_url(); ?>admin/Qualification/index"><i class="fa fa-angle-double-right"></i>-->
                    <!--     Qualification Lists</a></li> -->
                    <!--<li class="<?php echo set_Submenu('admin/Qrecord/index'); ?>"><a href="<?php echo base_url(); ?>admin/Qrecord/index"><i class="fa fa-angle-double-right"></i>-->
                    <!--     Qualification Records</a></li>     -->
                </ul>
            </li><!--academics-->
            
            <li class="treeview <?php echo set_Topmenu('Attendance'); ?>">
                <a href="#">
                    <i class="fa fa-calendar-check-o"></i> <span><?php echo $this->lang->line('attendance'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('stuattendence/index'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/index/<?php echo $this->setting_model->getCurrentSessionid(); ?>"><i class="fa fa-angle-double-right"></i> Daily <?php echo $this->lang->line('student_attendance'); ?></a></li>
                    <li class="<?php echo set_Submenu('stuattendence/monthlyattandence'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/monthlyattandence/<?php echo $this->setting_model->getCurrentSessionid(); ?>"><i class="fa fa-angle-double-right"></i> Monthly <?php echo $this->lang->line('student_attendance'); ?></a></li>
                    <li class="<?php echo set_Submenu('teaattendence/index'); ?>"><a href="<?php echo base_url(); ?>admin/teaattendence"><i class="fa fa-angle-double-right"></i> Daily Teacher Attendance</a></li>
                    <li class="<?php echo set_Submenu('stuattendence/stumaintenance'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/stumaintenance/<?php echo $this->setting_model->getCurrentSessionid(); ?>"><i class="fa fa-angle-double-right"></i> Add Student Attendance</a></li>
                    <li class="<?php echo set_Submenu('Teaattendence/teamaintenance'); ?>"><a href="<?php echo base_url(); ?>admin/teaattendence/teamaintenance"><i class="fa fa-angle-double-right"></i> Add Teacher Attendance</a></li>
                    <!--<li class="<?php echo set_Submenu('stuattendence/classattendencereport'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> Student Reports</a></li>-->
                    <!--<li class="<?php echo set_Submenu('Teaattendence/teaattendencereport'); ?>"><a href="<?php echo base_url(); ?>admin/teaattendence/teaattendencereport"><i class="fa fa-angle-double-right"></i> Teacher Reports</a></li>-->
                    <li class="<?php echo set_Submenu('Leaveuser/leaveuserView/13'); ?>"><a href="<?php echo base_url(); ?>admin/Leaveuser/leaveuserView/13"><i class="fa fa-angle-double-right"></i> Students' Leave</a></li>
                    <li class="<?php echo set_Submenu('Leave/leavereport'); ?>"><a href="<?php echo base_url(); ?>admin/Leave/leavereport"><i class="fa fa-angle-double-right"></i> Teachers' Leave</a></li>
                    <li class="<?php echo set_Submenu('School_calendar/index'); ?>"><a href="<?php echo base_url(); ?>admin/School_calendar/index"><i class="fa fa-angle-double-right"></i> School Calendar</a></li>
                    <li class="<?php echo set_Submenu('School_calendar/holiday'); ?>"><a href="<?php echo base_url(); ?>admin/School_calendar/holiday"><i class="fa fa-angle-double-right"></i> Holidays</a></li>
                </ul>
            </li><!--attadence-->
            
            <li class="treeview <?php echo set_Topmenu('Examinations'); ?>">
                <a href="#">
                    <i class="fa fa-map-o"></i> <span><?php echo $this->lang->line('examinations'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('exam/index'); ?>"><a href="<?php echo base_url(); ?>admin/Exam"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_list'); ?></a></li>
                    <li class="<?php echo set_Submenu('Inter_exam/index'); ?>"><a href="<?php echo base_url(); ?>admin/Inter_exam"><i class="fa fa-angle-double-right"></i> Inter <?php echo $this->lang->line('exam_list'); ?></a></li>
                    <li class="<?php echo set_Submenu('examschedule/index'); ?>"><a href="<?php echo base_url(); ?>admin/Examschedule"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_schedule'); ?></a></li>
                    <li class="<?php echo set_Submenu('inter_examschedule/index'); ?>"><a href="<?php echo base_url(); ?>admin/Inter_examschedule"><i class="fa fa-angle-double-right"></i> Inter <?php echo $this->lang->line('exam_schedule'); ?></a></li>
                    <li class="<?php echo set_Submenu('mark/index'); ?>"><a href="<?php echo base_url(); ?>admin/Mark"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('marks_register'); ?></a></li>
                    <li class="<?php echo set_Submenu('Inter_mark/index'); ?>"><a href="<?php echo base_url(); ?>admin/Inter_mark"><i class="fa fa-angle-double-right"></i> Inter <?php echo $this->lang->line('marks_register'); ?></a></li>
                    <li class="<?php echo set_Submenu('Reportcard/activity'); ?>"><a href="<?php echo base_url(); ?>admin/High_Reportcard/activity"><i class="fa fa-angle-double-right"></i> Activities Register</a></li>
                    <li class="<?php echo set_Submenu('grade/index'); ?>"><a href="<?php echo base_url(); ?>admin/Grade"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('marks_grade'); ?></a></li>
                   
                    <li class="<?php echo set_Submenu('admin/Examresult/index'); ?>"><a href="<?php echo base_url(); ?>admin/Examresult/index"><i class="fa fa-angle-double-right"></i> Private Exam Results </a></li>
                 <li class="<?php echo set_Submenu('admin/Inter_Reportcard/index'); ?>"><a href="<?php echo base_url(); ?>admin/Inter_Reportcard/index"><i class="fa fa-angle-double-right"></i> Inter Exam Results </a></li>

                    <li class="<?php echo set_Submenu('Reportcard/index'); ?>"><a href="<?php echo base_url(); ?>admin/High_Reportcard"><i class="fa fa-angle-double-right"></i> Monthly Report Card </a></li>
                   
                    
                   <!--  
                    <li class="<?php echo set_Submenu('Reportcard/primaryreportcard'); ?>"><a href="<?php echo base_url(); ?>admin/Reportcard/primaryreportcard"><i class="fa fa-angle-double-right"></i> Primary Report Card </a></li>
                    
                    <li class="<?php echo set_Submenu('Reportcard/kgreportcard'); ?>"><a href="<?php echo base_url(); ?>admin/Reportcard/kgreportcard"><i class="fa fa-angle-double-right"></i> KG Report Card </a></li>-->
                </ul>
            </li><!--examination-->
            
            <li class="treeview <?php echo set_Topmenu('Improvement'); ?>">
                <a href="#">
                    <i class="fa fa-signal"></i> <span> Students Improvement</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="<?php echo set_Submenu('Improvement_result/index'); ?>"><a href="<?php echo base_url(); ?>improvement/Improvement_result"><i class="fa fa-angle-double-right"></i>Preschool Results</a></li>
                      <li class="<?php echo set_Submenu('Improvement_result/kgimpro_result_index/'); ?>"><a href="<?php echo base_url(); ?>improvement/Improvement_result/kgimpro_result_index"><i class="fa fa-angle-double-right"></i>KG Results</a></li>
                      <li class="<?php echo set_Submenu('Improvement_result/primary_result_index'); ?>"><a href="<?php echo base_url(); ?>improvement/Improvement_result/primary_result_index"><i class="fa fa-angle-double-right"></i>Primary Results</a></li>
                </ul>
            </li><!--student improvement-->
            
            <li class="treeview <?php echo set_Topmenu('Payment'); ?>">
                <a href="#">
                    <i class="fa fa-usd"></i> <span> Payment Collections</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('Installment/index'); ?>"><a href="<?php echo base_url(); ?>Installment/index"><i class="fa fa-angle-double-right"></i> Installment Plans</a></li>
                    <li class="<?php echo set_Submenu('Installment/install_student'); ?>"><a href="<?php echo base_url(); ?>Installment/install_student"><i class="fa fa-angle-double-right"></i> Installment Students</a></li>
                  
                     <li class="<?php echo set_Submenu('Installment/studentfee_balance'); ?>"><a href="<?php echo base_url(); ?>Installment/studentfee_balance"><i class="fa fa-angle-double-right"></i> Installment Fees Balance</a>
                     </li>

                      <li class="<?php echo set_Submenu('Installment/studentfee_receive'); ?>"><a href="<?php echo base_url(); ?>Installment/studentfee_receive"><i class="fa fa-angle-double-right"></i> Installment Fees Receive 
                      </a></li>
                
                    
                    <li class="<?php echo set_Submenu('admin/feegroup'); ?>"><a href="<?php echo base_url(); ?>admin/feegroup"><i class="fa fa-angle-double-right"></i> Monthly <?php echo $this->lang->line('fees_group'); ?></a></li>
                    
                    <li class="<?php echo set_Submenu('studentfee/monthlyfee'); ?>"><a href="<?php echo base_url(); ?>Studentfee/monthlyfee"><i class="fa fa-angle-double-right"></i> Monthly Fees Lists</a></li>
                    
                    <li class="<?php echo set_Submenu('balance_fee/index'); ?>"><a href="<?php echo base_url(); ?>balance_fee/index/0">
                        <i class="fa fa-angle-double-right"></i> Monthly Fees Balance </a></li>
                    
                    <li class="<?php echo set_Submenu('studentfee/index'); ?>"><a href="<?php echo base_url(); ?>studentfee/index/0"><i class="fa fa-angle-double-right"></i> 
                        Monthly Fees Received
                        </a>
                    </li>
                 
                </ul>
                
            </li><!--payment collection-->
            
            
          
            
            
            <!--<li class="treeview <?php echo set_Topmenu('Fees Collection'); ?>">-->
            <!--    <a href="#">-->
            <!--        <i class="fa fa-money"></i> <span> <?php echo $this->lang->line('fees_collection'); ?></span> <i class="fa fa-angle-left pull-right"></i>-->
            <!--    </a>-->
            <!--    <ul class="treeview-menu">-->
            <!--        <li class="<?php echo set_Submenu('studentfee/index'); ?>"><a href="<?php echo base_url(); ?>studentfee/index/0"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('collect_fees'); ?></a></li>-->
            <!--        <li class="<?php echo set_Submenu('balance_fee/index'); ?>"><a href="<?php echo base_url(); ?>balance_fee/index/0"><i class="fa fa-angle-double-right"></i> Balance Fees</a></li>-->
            <!--       <li class="<?php echo set_Submenu('admin/feegroup'); ?>"><a href="<?php echo base_url(); ?>admin/feegroup"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('fees_group'); ?></a></li>-->

            <!--             <li class="<?php echo set_Submenu('studentfee/studentfeesDailyReport'); ?>"><a href="<?php echo base_url(); ?>studentfee/studentfeesDailyReport"><i class="fa fa-angle-double-right"></i> Daily Report</a></li>-->

            <!--          <li class="<?php echo set_Submenu('studentfee/studentfeesMonthlyReport'); ?>"><a href="<?php echo base_url(); ?>studentfee/studentfeesMonthlyReport"><i class="fa fa-angle-double-right"></i> Monthly Report</a></li>-->
            <!--             <li class="<?php echo set_Submenu('studentfee/studentfeesYearlyReport'); ?>"><a href="<?php echo base_url(); ?>studentfee/studentfeesYearlyReport"><i class="fa fa-angle-double-right"></i> Yearly Report</a></li>-->
                         
            <!--              <li class="<?php echo set_Submenu('studentfee/payment_method'); ?>"><a href="<?php echo base_url(); ?>studentfee/payment_method"><i class="fa fa-angle-double-right"></i> Payment Method</a></li>-->
                          
            <!--        <li class="<?php echo set_Submenu('accountant/index'); ?>"><a href="<?php echo base_url(); ?>admin/accountant"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('accountants'); ?></a></li>-->
            <!--    </ul>-->
            <!--</li>-->
            
            <li class="treeview <?php echo set_Topmenu('Courses'); ?>">
                <a href="#">
                    <i class="fa fa-list"></i> <span> Summer Courses</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('Course/index'); ?>"><a href="<?php echo base_url(); ?>Course/index"><i class="fa fa-angle-double-right"></i> Lectured Courses</a></li>
                    <li class="<?php echo set_Submenu('Course/courses_subject'); ?>"><a href="<?php echo base_url(); ?>Course/courses_subject"><i class="fa fa-angle-double-right"></i> Courses Subject</a></li>
                   <li class="<?php echo set_Submenu('Course/courses_register'); ?>"><a href="<?php echo base_url(); ?>Course/courses_register"><i class="fa fa-angle-double-right"></i> Courses Register</a></li>

                         <li class="<?php echo set_Submenu('Course/course_fee_balance'); ?>"><a href="<?php echo base_url(); ?>Course/course_fee_balance"><i class="fa fa-angle-double-right"></i> Course Fee Balance</a></li>

                      <li class="<?php echo set_Submenu('Course/course_fee_receive'); ?>"><a href="<?php echo base_url(); ?>Course/course_fee_receive"><i class="fa fa-angle-double-right"></i> Course Fee Receive </a></li>
                         
                </ul>
            </li>
            <li class="treeview <?php echo set_Topmenu('Inventory'); ?>">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span><?php echo $this->lang->line('inventory'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                
                <ul class="treeview-menu">
                    <!--<li class="<?php echo set_Submenu('Inventory/index'); ?>"><a href="<?php echo base_url(); ?>Inventory/index"><i class="fa fa-angle-double-right"></i>Item Lists</a></li>-->
                    <li class="<?php echo set_Submenu('Inventory/stock'); ?>"><a href="<?php echo base_url(); ?>Inventory/stock"><i class="fa fa-angle-double-right"></i>Stock Lists</a></li>
                    <li class="<?php echo set_Submenu('Inventory/sale'); ?>"><a href="<?php echo base_url(); ?>Inventory/sale"><i class="fa fa-angle-double-right"></i>Sale Lists</a></li>
                    <li class="<?php echo set_Submenu('Inventory/purchase'); ?>"><a href="<?php echo base_url(); ?>Inventory/purchase"><i class="fa fa-angle-double-right"></i>Purchase Lists</a></li>
                    <li class="<?php echo set_Submenu('Inventory/use_item'); ?>"><a href="<?php echo base_url(); ?>Inventory/use_item"><i class="fa fa-angle-double-right"></i>Item Expense Lists</a></li>
                </ul>
                
                <!--<ul class="treeview-menu">-->
                <!--    <li class="<?php echo set_Submenu('issueitem/index'); ?>"><a href="<?php echo base_url(); ?>admin/issueitem"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('issue_item'); ?></a></li>-->
                <!--    <li class="<?php echo set_Submenu('Itemstock/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemstock"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_item_stock'); ?></a></li>-->
                <!--    <li class="<?php echo set_Submenu('Item/index'); ?>"><a href="<?php echo base_url(); ?>admin/item"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_item'); ?></a></li>-->
                <!--    <li class="<?php echo set_Submenu('itemcategory/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemcategory"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('item_category'); ?></a></li>-->
                <!--    <li class="<?php echo set_Submenu('itemstore/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemstore"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('item_store'); ?></a></li>-->
                <!--    <li class="<?php echo set_Submenu('itemsupplier/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemsupplier"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('item_supplier'); ?></a></li>-->
                <!--</ul>-->
            </li>
            <li class="treeview <?php echo set_Topmenu('Income'); ?>">
                <a href="#">
                    <i class="fa fa-usd"></i> <span><?php echo $this->lang->line('income'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('income/index'); ?>"><a href="<?php echo base_url(); ?>admin/income"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_income'); ?></a></li>
                    <!--<li class="<?php echo set_Submenu('income/incomesearch'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomesearch"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('search_income'); ?></a></li>-->
                    <li class="<?php echo set_Submenu('incomeshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/incomehead"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('income_head'); ?></a></li>
                </ul>
            </li>

            <li class="treeview <?php echo set_Topmenu('Expenses'); ?>">
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span><?php echo $this->lang->line('expenses'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('expense/index'); ?>"><a href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('add_expense'); ?></a></li>
                    <!--<li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('search_expense'); ?></a></li>-->
                    <li class="<?php echo set_Submenu('expenseshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/expensehead"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('expense_head'); ?></a></li>
                  <li class="<?php echo set_Submenu('Salary/index'); ?>"><a href="<?php echo base_url(); ?>admin/Salary/index"><i class="fa fa-angle-double-right"></i> Monthly Salary</a></li>
                  <li class="<?php echo set_Submenu('Purchase/index'); ?>"><a href="<?php echo base_url(); ?>admin/Purchase/index"><i class="fa fa-angle-double-right"></i> Purchase Request</a></li>
                </ul>
            </li>
            
            <li class="treeview <?php echo set_Topmenu('Library'); ?>">
                <a href="#">
                    <i class="fa fa-book"></i> <span><?php echo $this->lang->line('library'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li class="<?php echo set_Submenu('book/index'); ?>"><a href="<?php echo base_url(); ?>admin/book"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_book'); ?></a></li>
                    <li class="<?php echo set_Submenu('book/getall'); ?>">
                        <a href="<?php echo base_url(); ?>admin/book/getall"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('book_list'); ?></a></li>
                    <li class="<?php echo set_Submenu('member/index'); ?>"><a href="<?php echo base_url(); ?>admin/member"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('issue_return'); ?></a></li>
                    <li class="<?php echo set_Submenu('member/student'); ?>"><a href="<?php echo base_url(); ?>admin/member/student"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_student'); ?></a></li>
                    <li class="<?php echo set_Submenu('member/teacher'); ?>"><a href="<?php echo base_url(); ?>admin/member/teacher"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('add_teacher'); ?></a></li>
                </ul>
            </li><!--libray-->
            
           
            
            
           
            
            
            <li class="treeview <?php echo "Info Center"; ?>">
                <a href="#">
                    <i class="fa fa-info"></i> <span><?php echo "Info Center"; ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('admin/admin/feedback'); ?>"><a href="<?php echo base_url(); ?>admin/admin/feedback"><i class="fa fa-angle-double-right"></i> Feedbacks</a></li>
                    <li class="<?php echo set_Submenu('admin/admin/website_message'); ?>"><a href="<?php echo base_url(); ?>admin/admin/website_message"><i class="fa fa-angle-double-right"></i> Messages From Website</a></li>
                    <li class="<?php echo set_Submenu('admin/admin/online_registration'); ?>"><a href="<?php echo base_url(); ?>admin/admin/online_registration"><i class="fa fa-angle-double-right"></i> Online Registration</a></li>
                    <li class="<?php echo set_Submenu('admin/admin/onlinecv'); ?>"><a href="<?php echo base_url(); ?>admin/admin/onlinecv"><i class="fa fa-angle-double-right"></i> Online CV </a></li>
                </ul>
            </li>

              

              
            <li class="treeview <?php echo set_Topmenu('Download Center'); ?>">
                <a href="#">
                    <i class="fa fa-download"></i> <span><?php echo $this->lang->line('download_center'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('content/index'); ?>"><a href="<?php echo base_url(); ?>admin/content"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('upload_content'); ?></a></li>
                    <li class="<?php echo set_Submenu('content/assignment'); ?>"><a href="<?php echo base_url(); ?>admin/content/assignment"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assignments'); ?></a></li>
                    <li class="<?php echo set_Submenu('content/studymaterial'); ?>"><a href="<?php echo base_url(); ?>admin/content/studymaterial"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('study_material'); ?></a></li>
                    <li class="<?php echo set_Submenu('content/syllabus'); ?>"><a href="<?php echo base_url(); ?>admin/content/syllabus"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('syllabus'); ?></a></li>
                    <li class="<?php echo set_Submenu('content/other'); ?>"><a href="<?php echo base_url(); ?>admin/content/other"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('other_downloads'); ?></a></li>
                </ul>
            </li>
            
            <li class="treeview <?php echo set_Topmenu('Communicate'); ?>">
                <a href="#">
                    <i class="fa fa-bullhorn"></i> <span><?php echo $this->lang->line('communicate'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('notification/index'); ?>"><a href="<?php echo base_url(); ?>admin/notification"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('notice_board'); ?></a></li>
                    <li class="<?php echo set_Submenu('notification/add'); ?>"><a href="<?php echo base_url(); ?>admin/notification/add"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('send_message'); ?></a></li>
                    <li class="<?php echo set_Submenu('mailsms/compose'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/compose"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('send_email_/_sms'); ?></a></li>
                    <li class="<?php echo set_Submenu('mailsms/index'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/index"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('email_/_sms_log'); ?></a></li>
                </ul>
            </li>
            
            
            <li class="treeview <?php echo set_Topmenu('Transport'); ?>">
                <a href="#">
                    <i class="fa fa-bus"></i> <span><?php echo $this->lang->line('transport'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('route/index'); ?>"><a href="<?php echo base_url(); ?>admin/route"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('routes'); ?></a></li>
                    <li class="<?php echo set_Submenu('vehicle/index'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('vehicles'); ?></a></li>
                    <li class="<?php echo set_Submenu('vehroute/index'); ?>"><a href="<?php echo base_url(); ?>admin/vehroute"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assign_vehicle'); ?></a></li>
                </ul>
            </li>
            <li class="treeview <?php echo set_Topmenu('Hostel'); ?>">
                <a href="#">
                    <i class="fa fa-building-o"></i> <span><?php echo $this->lang->line('hostel'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('hostelroom/index'); ?>"><a href="<?php echo base_url(); ?>admin/hostelroom"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('hostel_rooms'); ?></a></li>
                    <li class="<?php echo set_Submenu('roomtype/index'); ?>"><a href="<?php echo base_url(); ?>admin/roomtype"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('room_type'); ?></a></li>
                    <li class="<?php echo set_Submenu('hostel/index'); ?>"><a href="<?php echo base_url(); ?>admin/hostel"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('hostel'); ?></a></li>
                </ul>
            </li>


              <li class="treeview <?php echo set_Topmenu('users'); ?>">
                <a href="#">
                    <i class="fa fa-users"></i> Software <span><?php echo $this->lang->line('users'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('accountant/index'); ?>"><a href="<?php echo base_url(); ?>admin/accountant"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('accountants'); ?></a></li>
                    <li class="<?php echo set_Submenu('librarian/index'); ?>"><a href="<?php echo base_url(); ?>admin/librarian"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('librarians'); ?></a></li>
                     <li class="<?php echo set_Submenu('adminusers/index'); ?>"><a href="<?php echo base_url(); ?>admin/adminuser"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('admin_users'); ?></a></li>  
                    <li class="<?php echo set_Submenu('users/index'); ?>"><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('users'); ?></a></li> 
                    <li class="<?php echo set_Submenu('users/index'); ?>"><a href="<?php echo base_url(); ?>student/userpass"><i class="fa fa-angle-double-right"></i> Login Infos</a></li> 
                
                
                </ul>
            </li>
            
            
            <li class="treeview <?php echo set_Topmenu('Reports'); ?>">
                <a href="#">
                    <i class="fa fa-line-chart"></i> <span><?php echo $this->lang->line('reports'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('admin/ProfitLoss/index'); ?>"><a href="<?php echo base_url(); ?>admin/ProfitLoss/index"><i class="fa fa-angle-double-right"></i> Income/Outcome Report</a></li>
                    <li class="<?php echo set_Submenu('student/studentreport_search'); ?>"><a href="<?php echo base_url(); ?>student/studentreport_search"><i class="fa fa-angle-double-right"></i>
                            <?php echo $this->lang->line('student_report'); ?></a></li>
                    <li class="<?php echo set_Submenu('admin/Teacher/tearcher_report'); ?>"><a href="<?php echo base_url(); ?>admin/Teacher/tearcher_report"><i class="fa fa-angle-double-right"></i>
                    Tearcher Report</a></li>
                  <!--  <li class="<?php echo set_Submenu('reportbyname/index'); ?>"><a href="<?php echo base_url(); ?>studentfee/studentfeesreport"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('fees_statement'); ?></a></li>-->
                    <li class="<?php echo set_Submenu('balance_fee/index/0'); ?>"><a href="<?php echo base_url(); ?>balance_fee/index/0"><i class="fa fa-angle-double-right"></i>
                           Monthly <?php echo $this->lang->line('balance_fees_report'); ?></a></li>                               
                     <!--<li class="<?php echo set_Submenu('balance_fee/index/0'); ?>"><a href="<?php echo base_url(); ?>balance_fee/index/0"><i class="fa fa-angle-double-right"></i>-->
                     <!--      Monthly <?php echo $this->lang->line('balance_fees_report'); ?></a></li> -->
                           
                 <li class="<?php echo set_Submenu('Installment/studentfee_balance'); ?>"><a href="<?php echo base_url(); ?>Installment/studentfee_balance"><i class="fa fa-angle-double-right"></i>
                           Installment <?php echo $this->lang->line('balance_fees_report'); ?></a></li> 
                           
                           
                    <li class="<?php echo set_Submenu('stuattendence/classattendencereport'); ?>"><a href="<?php echo base_url(); ?>admin/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> Student <?php echo $this->lang->line('attendance_report'); ?></a></li>
                  
                  
                 <li class="<?php echo set_Submenu('admin/Leaveuser/leaveuserView/13'); ?>"><a href="<?php echo base_url(); ?>admin/Leaveuser/leaveuserView/13"><i class="fa fa-angle-double-right"></i> Leave Report</a></li>

 
                 <li class="<?php echo set_Submenu('admin/Stuattendence/classabsentreport'); ?>"><a href="<?php echo base_url(); ?>admin/Stuattendence/classabsentreport"><i class="fa fa-angle-double-right"></i> Absent Report</a></li>
                  
                   <li class="<?php echo set_Submenu('mark/index'); ?>"><a href="<?php echo base_url(); ?>admin/mark"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_marks_report'); ?></a></li>
                   
					<li class="<?php echo set_Submenu('userlog/index'); ?>"><a href="<?php echo base_url(); ?>admin/userlog"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('user_log'); ?></a></li>
					
					
                </ul>
            </li>
           <!--  <li class="treeview <?php echo set_Topmenu('System Settings'); ?>">
                <a href="#">
                    <i class="fa fa-gears"></i> <span><?php echo $this->lang->line('system_settings'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('schsettings/index'); ?>"><a href="<?php echo base_url(); ?>schsettings"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('general_settings'); ?></a></li>
                    <li class="<?php echo set_Submenu('sessions/index'); ?>"><a href="<?php echo base_url(); ?>sessions"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('session_setting'); ?></a></li>
                    <li class="<?php echo set_Submenu('notification/setting'); ?>"><a href="<?php echo base_url(); ?>admin/notification/setting"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('notification_setting'); ?></a></li>
                    <li class="<?php echo set_Submenu('smsconfig/index'); ?>"><a href="<?php echo base_url(); ?>smsconfig"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('sms_setting'); ?></a></li>
                    <li class="<?php echo set_Submenu('emailconfig/index'); ?>"><a href="<?php echo base_url(); ?>emailconfig"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('email_setting'); ?></a></li>
                    <li class="<?php echo set_Submenu('admin/paymentsettings'); ?>"><a href="<?php echo base_url(); ?>admin/paymentsettings"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('payment_methods'); ?></a></li>
                    <li class="<?php echo set_Submenu('admin/backup'); ?>"><a href="<?php echo base_url(); ?>admin/admin/backup"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('backup / restore'); ?></a></li>
                    <li class="<?php echo set_Submenu('language/index'); ?>"><a href="<?php echo base_url(); ?>admin/language"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('languages'); ?></a></li>  
                    <?php
                    $adminsess = $this->session->userdata('admin');
                    if ($adminsess['username'] == "Admin") {
                        ?>
                        <li class="<?php echo set_Submenu('adminusers/index'); ?>"><a href="<?php echo base_url(); ?>admin/adminuser"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('admin_users'); ?></a></li>  
                        <?php
                    }
                    ?>
                    <li class="<?php echo set_Submenu('users/index'); ?>"><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('users'); ?></a></li> 
                    
                </ul>
            </li> -->
        </ul>
    </section>             
</aside>  
