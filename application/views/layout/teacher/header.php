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
        } else {
            
        }
        ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">      
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">       

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">      
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">       
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">       
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">      
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/sweet-alert/sweetalert2.css">
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
        <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";
        </script>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header" id="alert">               
                <a href="<?php echo base_url(); ?>teacher/teacher/dashboard" class="logo">                  
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
                    <div class="col-md-5 col-sm-3 col-xs-5">  
                        <span href="#" class="sidebar-session">
                            <?php echo $this->setting_model->getCurrentSchoolName(); ?>
                        </span>
                    </div>        
                    <div class="col-md-7 col-sm-9 col-xs-7">
                        <div class="pull-right">           
                            
                            <div class="navbar-custom-menu">
                                <ul class="nav navbar-nav"> 
                                   <!--  <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Messages
                                            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ol class="dropdown-menu dropdown-user">
                                            <li><a href="<?php echo base_url(); ?>admin/messages"><i class="fa fa-minus"></i> Hello</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo base_url(); ?>admin/messages"><i class="fa fa-minus"></i> Hello</a>
                                            </li>
                                        </ol>                             
                                    </li>   


                                     <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Notifications
                                            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="<?php echo base_url(); ?>admin/admin/changepass"><i class="fa fa-key"></i> <?php echo $this->lang->line('change_password'); ?></a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('logout'); ?></a>
                                            </li>
                                        </ul>                             
                                    </li> -->   
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><?php echo $this->customlib->getStudentSessionUserName(); ?>
                                            <i class="fa fa-user-secret fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="<?php echo base_url(); ?>teacher/teacher/changepass"><i class="fa fa-key"></i> <?php echo $this->lang->line('change_password'); ?></a>
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
                    <form class="navbar-form navbar-left search-form2" role="search"  action="<?php echo site_url('teacher/admin/search'); ?>" method="POST">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="input-group ">
                            <input type="text" name="search_text" class="form-control search-form" placeholder="<?php echo $this->lang->line('search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..'); ?>">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>     
                    
                    <?php
                    $sessionData = $this->session->userdata('student');

                    
                    ?>
                    <ul class="sessionul fixedmenu">
                        <li class="removehover accurrent">
                            <?php echo $this->lang->line('current_session') . ": " . $this->setting_model->getCurrentSessionName(); ?>
                        </li>
                    </ul>                  
                    <ul class="sidebar-menu verttop38">
                        <li><a href="<?php echo base_url(); ?>teacher/teacher/dashboard"><i class="fa fa-user-secret"></i> <?php echo $this->lang->line('my_profile'); ?></a></li>
                       
                       
                       
                        <li class="treeview <?php echo set_Topmenu('Student Information'); ?>">
                          
                        
                        
                        <?php
                        
                   if ($sessionData['role'] == "teacher_head") {

                        
                        ?>
                        
                <a href="#">
                    <i class="fa fa-user-plus"></i> <span><?php echo $this->lang->line('student_information'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('student/search'); ?>"><a href="<?php echo base_url(); ?>teacher/student/search"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_details'); ?></a></li>
                   
                    <li class="<?php echo set_Submenu('student/create'); ?>"><a href="<?php echo base_url(); ?>teacher/student/create"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_admission'); ?></a></li>
                </ul>
            </li>
                        
                        <?php
                        
                        }
                        
                        else
                        
                        {
                            ?>
                              <a href="#">
                                <i class="fa fa-user-plus"></i> <span><?php echo $this->lang->line('student_information'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('student/search'); ?>"><a href="<?php echo base_url(); ?>teacher/student/search"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_details'); ?></a></li>
                                <li class="<?php echo set_Submenu('category/index'); ?>"><a href="<?php echo base_url(); ?>teacher/category"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('student_categories'); ?></a></li>
                            </ul>
                        </li>
                            
                            <?php
                        }
                        

                    if ($sessionData['role'] == "teacher_head") {

                        ?>     
                       <li class="treeview <?php echo set_Topmenu('Fees Collection'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i> <span> <?php echo $this->lang->line('fees_collection'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('studentfee/index'); ?>"><a href="<?php echo base_url(); ?>teacher/studentfee/index/0"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('collect_fees'); ?></a></li>
                     <li class="<?php echo set_Submenu('studentfee/studentfeesDailyReport'); ?>"><a href="<?php echo base_url(); ?>teacher/studentfee/studentfeesDailyReport"><i class="fa fa-angle-double-right"></i> Daily Report</a></li>

                      <li class="<?php echo set_Submenu('studentfee/studentfeesMonthlyReport'); ?>"><a href="<?php echo base_url(); ?>teacher/studentfee/studentfeesMonthlyReport"><i class="fa fa-angle-double-right"></i> Monthly Report</a></li>
                         <li class="<?php echo set_Submenu('studentfee/studentfeesYearlyReport'); ?>"><a href="<?php echo base_url(); ?>teacher/studentfee/studentfeesYearlyReport"><i class="fa fa-angle-double-right"></i> Yearly Report</a></li>
                   
                   <li class="<?php echo set_Submenu('teacher/feegroup'); ?>"><a href="<?php echo base_url(); ?>teacher/feegroup"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('fees_group'); ?></a></li>
                </ul>
            </li>

              <li class="treeview <?php echo set_Topmenu('Expenses'); ?>">
                            <a href="#">
                                <i class="fa fa-credit-card"></i> <span><?php echo $this->lang->line('expenses'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('expense/index'); ?>"><a href="<?php echo base_url(); ?>teacher/expense"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('add_expense'); ?></a></li>
                                <li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>teacher/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('search_expense'); ?></a></li>
                                <li class="<?php echo set_Submenu('expenseshead/index'); ?>"><a href="<?php echo base_url(); ?>teacher/expensehead"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('expense_head'); ?></a></li>
                                 <li class="<?php echo set_Submenu('Purchase/index'); ?>"><a href="<?php echo base_url(); ?>teacher/Purchase/index"><i class="fa fa-angle-double-right"></i> Purchase Request</a></li>

                            </ul>
                        </li>
            
            
            <?php
            }
            
            ?>
                        
   <li class="treeview <?php echo set_Topmenu('Attendance'); ?>">
                <a href="#">
                    <i class="fa fa-calendar-check-o"></i> <span><?php echo $this->lang->line('attendance'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('stuattendence/stumaintenance'); ?>"><a href="<?php echo base_url(); ?>teacher/stuattendence/stumaintenance"><i class="fa fa-angle-double-right"></i> Att Maintenance Entry</a></li>
                    <li class="<?php echo set_Submenu('stuattendence/classattendencereport'); ?>"><a href="<?php echo base_url(); ?>teacher/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> Attandence Reports</a></li>
               <li class="<?php echo set_Submenu('stuattendence/index'); ?>"><a href="<?php echo base_url(); ?>teacher/stuattendence/index"><i class="fa fa-angle-double-right"></i> Daily <?php echo $this->lang->line('student_attendance'); ?></a></li>
            <li class="<?php echo set_Submenu('stuattendence/monthlyattandence'); ?>"><a href="<?php echo base_url(); ?>teacher/stuattendence/monthlyattandence/<?php echo $this->setting_model->getCurrentSessionid(); ?>"><i class="fa fa-angle-double-right"></i> Monthly <?php echo $this->lang->line('student_attendance'); ?></a></li>
     
                 <?php
                        
                        

                    if ($sessionData['role'] == "teacher_head") {

                        ?>     
                    <li class="<?php echo set_Submenu('teaattendence/index'); ?>"><a href="<?php echo base_url(); ?>teacher/teaattendence"><i class="fa fa-angle-double-right"></i> Teacher Attendance</a></li>

                    <li class="<?php echo set_Submenu('Teaattendence/teamaintenance'); ?>"><a href="<?php echo base_url(); ?>teacher/teaattendence/teamaintenance"><i class="fa fa-angle-double-right"></i> Teacher Maintenance</a></li>

                    <li class="<?php echo set_Submenu('Teaattendence/teaattendencereport'); ?>"><a href="<?php echo base_url(); ?>teacher/teaattendence/teaattendencereport"><i class="fa fa-angle-double-right"></i> Teacher Reports</a></li>

                    <li class="<?php echo set_Submenu('Teaattendence/leavereport'); ?>"><a href="<?php echo base_url(); ?>teacher/teaattendence/leavereport"><i class="fa fa-angle-double-right"></i> Leave Reports</a></li>

                    <?php 
                        }
                     ?>

                </ul>
            </li>
                        


                        <li class="treeview <?php echo set_Topmenu('Examinations'); ?>">
                            <a href="#">
                                <i class="fa fa-map-o"></i> <span><?php echo $this->lang->line('examinations'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('exam/index'); ?>"><a href="<?php echo base_url(); ?>teacher/exam"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_list'); ?></a></li>
                                <li class="<?php echo set_Submenu('examschedule/index'); ?>"><a href="<?php echo base_url(); ?>teacher/examschedule"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_schedule'); ?></a></li>
                                <li class="<?php echo set_Submenu('mark/index'); ?>"><a href="<?php echo base_url(); ?>teacher/mark"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('marks_register'); ?></a></li>
                                <li class="<?php echo set_Submenu('grade/index'); ?>"><a href="<?php echo base_url(); ?>teacher/grade"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('marks_grade'); ?></a></li>

                             <li class="<?php echo set_Submenu('Reportcard/activity'); ?>"><a href="<?php echo base_url(); ?>teacher/Reportcard/activity"><i class="fa fa-angle-double-right"></i> Activities Register</a></li>

                    <li class="<?php echo set_Submenu('Reportcard/index'); ?>"><a href="<?php echo base_url(); ?>teacher/Reportcard"><i class="fa fa-angle-double-right"></i> Monthly Report Card </a></li>

                            </ul>
                        </li>
                        <li class="treeview <?php echo set_Topmenu('Academics'); ?>">
                            <a href="#">
                                <i class="fa fa-mortar-board"></i> <span><?php echo $this->lang->line('academics'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('timetable/index'); ?>"><a href="<?php echo base_url(); ?>teacher/timetable"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('class_timetable'); ?></a></li>                            
                               <!-- <li class="<?php //echo set_Submenu('subject/index'); ?>"><a href="<?php echo base_url(); ?>teacher/subject"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('subjects'); ?></a></li>
                                <li class="<?php //echo set_Submenu('teacher/index'); ?>"><a href="<?php echo base_url(); ?>teacher/teacher"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('teachers'); ?></a></li>
                                <li class="<?php //echo set_Submenu('classes/index'); ?>"><a href="<?php echo base_url(); ?>teacher/classes"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('class'); ?></a></li>
                                <li class="<?php //echo set_Submenu('sections/index'); ?>"><a href="<?php echo base_url(); ?>teacher/sections"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('sections'); ?></a></li>

                    <li class="<?php //echo set_Submenu('sections/index'); ?>"><a href="<?php echo base_url(); ?>sections"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('sections'); ?></a></li>
               
               -->
                    <?php

                      if ($sessionData['role'] == "teacher_head") {

                        ?> 

                    <li class="<?php echo set_Submenu('teacher/performance/index'); ?>"><a href="<?php echo base_url(); ?>admin/Performance/index"><i class="fa fa-angle-double-right"></i>
                         Performance Appraisal</a></li>
                    <li class="<?php echo set_Submenu('teacher/qualification/index'); ?>"><a href="<?php echo base_url(); ?>admin/Qualification/index"><i class="fa fa-angle-double-right"></i>
                         Qualification Lists</a></li> 
                    <li class="<?php echo set_Submenu('teacher/qrecord/index'); ?>"><a href="<?php echo base_url(); ?>admin/Qrecord/index"><i class="fa fa-angle-double-right"></i>
                         Qualification Records</a></li>    

                         <?php 
                        }
                          ?> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu('Teacherdiary'); ?>">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Teacher's Diary</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="<?php echo set_Submenu('teacherdiary/index'); ?>"><a href="<?php echo base_url(); ?>teacher/teacherdiary/Teacherdiary/"><i class="fa fa-angle-double-right"></i> Course Outlines</a></li>
                     <li class="<?php echo set_Submenu('teacherdiary/index'); ?>"><a href="<?php echo base_url(); ?>teacher/teacherdiary/Teachingnote/"><i class="fa fa-angle-double-right"></i> Teaching Notes</a></li>
                     <li class="<?php echo set_Submenu('teacherdiary/index'); ?>"><a href="<?php echo base_url(); ?>teacher/teacherdiary/Weeklypreparation/"><i class="fa fa-angle-double-right"></i> Weekly Preparations</a></li>
                     <li class="<?php echo set_Submenu('teacherdiary/index'); ?>"><a href="<?php echo base_url(); ?>teacher/teacherdiary/Dailyrecord/"><i class="fa fa-angle-double-right"></i> Daily Records</a></li>
                </ul>
            </li>

              <li class="treeview <?php echo set_Topmenu('Improvement'); ?>">
                <a href="#">
                    <i class="fa fa-signal"></i> <span> Students Improvement</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo set_Submenu('Improvement/index'); ?>"><a href="<?php echo base_url(); ?>teacher/improvement/Improvementdesc"><i class="fa fa-angle-double-right"></i> Improvement Description</a></li>
                  
                    <li class="<?php echo set_Submenu('Improvement/results'); ?>"><a href="<?php echo base_url(); ?>teacher/improvement/Improvement_result"><i class="fa fa-angle-double-right"></i> Improvement Results</a></li>
                </ul>
            </li>
                        <li class="treeview <?php echo set_Topmenu('Download Center'); ?>">
                            <a href="#">
                                <i class="fa fa-download"></i> <span><?php echo $this->lang->line('download_center'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('content/index'); ?>"><a href="<?php echo base_url(); ?>teacher/content"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('upload_content'); ?></a></li>
                                <li class="<?php echo set_Submenu('content/assignment'); ?>"><a href="<?php echo base_url(); ?>teacher/content/assignment"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('assignments'); ?></a></li>
                                <li class="<?php echo set_Submenu('content/studymaterial'); ?>"><a href="<?php echo base_url(); ?>teacher/content/studymaterial"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('study_material'); ?></a></li>
                                <li class="<?php echo set_Submenu('content/syllabus'); ?>"><a href="<?php echo base_url(); ?>teacher/content/syllabus"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('syllabus'); ?></a></li>
                                <li class="<?php echo set_Submenu('content/other'); ?>"><a href="<?php echo base_url(); ?>teacher/content/other"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('other_downloads'); ?></a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo set_Topmenu('Library'); ?>">
                            <a href="#">
                                <i class="fa fa-book"></i> <span><?php echo $this->lang->line('library'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="<?php echo set_Submenu('book/getall'); ?>">
                                    <a href="<?php echo base_url(); ?>teacher/book/getall"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('book_list'); ?></a></li>
                                <li class="<?php echo set_Submenu('book/issue'); ?>">
                                    <a href="<?php echo base_url(); ?>teacher/book/issue">
                                        <i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('book_issued'); ?></a>
                                </li>
                            </ul>
                        </li>
                     
                        <li class="treeview <?php echo set_Topmenu('Communicate'); ?>">
                            <a href="#">
                                <i class="fa fa-bullhorn"></i> <span><?php echo $this->lang->line('communicate'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('notification/index'); ?>"><a href="<?php echo base_url(); ?>teacher/notification">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo $this->lang->line('notice_board'); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu('notification/add'); ?>"><a href="<?php echo base_url(); ?>teacher/notification/add"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('send_message'); ?></a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo set_Topmenu('Reports'); ?>">
                            <a href="#">
                                <i class="fa fa-line-chart"></i> <span><?php echo $this->lang->line('reports'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu('student/studentreport'); ?>"><a href="<?php echo base_url(); ?>teacher/student/studentreport"><i class="fa fa-angle-double-right"></i>
                                        <?php echo $this->lang->line('student_report'); ?></a></li>



                                <li class="<?php echo set_Submenu('stuattendence/classattendencereport'); ?>"><a href="<?php echo base_url(); ?>teacher/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('attendance_report'); ?></a></li>
                                <li class="<?php echo set_Submenu('mark/index'); ?>"><a href="<?php echo base_url(); ?>teacher/mark"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('exam_marks_report'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </section>               
            </aside>