<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customlib {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('user_agent');
        $this->CI->load->model('Notification_model', '', TRUE);
        $this->CI->load->model('Setting_model', '', TRUE);
        $this->CI->load->model('Notificationsetting_model', '', TRUE);
    }

    function getCSRF() {
        $csrf_input = "<input type='hidden' ";
        $csrf_input .= "name='" . $this->CI->security->get_csrf_token_name() . "'";
        $csrf_input .= " value='" . $this->CI->security->get_csrf_hash() . "'/>";

        return $csrf_input;
    }

    function getGender() {
        $gender = array();
        $gender['Male'] = $this->CI->lang->line('male');
        $gender['Female'] = $this->CI->lang->line('female');
        return $gender;
    }

    function getStatus() {
        $status = array();
        $status[""] = $this->CI->lang->line('select');
        $status['enabled'] = 'Enabled';
        $status['disabled'] = 'Disabled';
        return $status;
    }

    function getDateFormat() {
        $dateFormat = array();
        $dateFormat['d-m-Y'] = 'dd-mm-yyyy';
        $dateFormat['d-M-Y'] = 'dd-mmm-yyyy';
        $dateFormat['d/m/Y'] = 'dd/mm/yyyy';
        $dateFormat['d.m.Y'] = 'dd.mm.yyyy';
        $dateFormat['m-d-Y'] = 'mm-dd-yyyy';
        $dateFormat['m/d/Y'] = 'mm/dd/yyyy';
        $dateFormat['m.d.Y'] = 'mm.dd.yyyy';
        return $dateFormat;
    }

    function getCurrency() {
        $currency = array();
        
        $currency['MMK'] = 'MMK';
        
        $currency['USD'] = 'USD';
      
        return $currency;
    }

    function getRteStatus() {
        $status = array();
        $status['Yes'] = $this->CI->lang->line('yes');
        $status['No'] = $this->CI->lang->line('no');
        return $status;
    }

    function getHostaltype() {
        $status = array();
        $status['Girls'] = 'Girls';
        $status['Boys'] = 'Boys';
        $status['Combine'] = 'Combine';
        return $status;
    }

    function getAppNameVersion() {
        $status = array();
        $status['App_name'] = 'Smart School';
        $status['App_ver'] = 'Ver. 1.0';
        return $status;
    }

    function getDaysname() {
        $status = array();
        $status['Monday'] = 'Monday';
        $status['Tuesday'] = 'Tuesday';
        $status['Wednesday'] = 'Wednesday';
        $status['Thursday'] = 'Thursday';
        $status['Friday'] = 'Friday';
        $status['Saturday'] = 'Saturday';
        $status['Sunday'] = 'Sunday';
        return $status;
    }

    function getcontenttype() {
        $status = array();
        $status['Assignments'] = 'Assignments';
        $status['Study_material'] = 'Study Material';
        $status['Syllabus'] = 'Syllabus';
        $status['Other_download'] = 'Other Download';
        return $status;
    }

    function getSchoolDateFormat() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['date_format'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['date_format'];
        }
    }

    function getTimeZone() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['timezone'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['timezone'];
        }
    }

    function getSchoolCurrencyFormat() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['currency_symbol'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['currency_symbol'];
        }
    }

    function getLoggedInUserData() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin;
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student;
        }
    }

    function getCurrentTheme() {

        $theme = "default";
        $admin = $this->CI->session->userdata('admin');

        if ($admin) {
            if (isset($admin['theme']) && $admin['theme'] != "") {
                $ext = pathinfo($admin['theme'], PATHINFO_EXTENSION);
                $theme = basename($admin['theme'], "." . $ext);
            }
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');


            if (isset($student['theme']) && $student['theme'] != "") {
                $ext = pathinfo($student['theme'], PATHINFO_EXTENSION);
                $theme = basename($student['theme'], "." . $ext);
            }
        }
        return $theme;
    }

    function getRTL() {
        $rtl = "";
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            if ($admin['is_rtl'] == "disabled") {
                $rtl = "";
            } else {
                $rtl = "dir='rtl' lang='ar'";
            }
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');

            if ($student['is_rtl'] == "disabled") {
                $rtl = "";
            } else {
                $rtl = "dir='rtl' lang='ar'";
            }
        }
        return $rtl;
    }

    function getStudentSessionUserID() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $studentID = $session_Array['student_id'];
        return $studentID;
    }

    function getParentSessionUserID() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $Parentid = $session_Array['student_id'];
        return $Parentid;
    }

    function getTeacherSessionUserID() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $teacher_id = $session_Array['teacher_id'];
        return $teacher_id;
    }

    function getSessionLanguage() {
        $student_session = $this->CI->session->userdata('admin');
        $language = $student_session['language'];
        $lang_id = $language['lang_id'];
        return $lang_id;
    }

    function checkPaypalDisplay() {
        $payment_setting = $this->CI->paymentsetting_model->get();
        return $payment_setting;
    }

    function getStudentunreadNotification() {
        $student_id = $this->CI->customlib->getStudentSessionUserID();
        $notifications = $this->CI->notification_model->countUnreadNotificationStudent($student_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return FALSE;
        }
    }

    function getParentunreadNotification() {
        $teacher_id = $this->CI->customlib->getParentSessionUserID();
        $notifications = $this->CI->notification_model->countUnreadNotificationParent($teacher_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return FALSE;
        }
    }

      function getParentunreadMessage() {
        $parent_id = $this->CI->customlib->getParentSessionUserID();
        $notifications = $this->CI->notification_model->countUnreadMessageParent($parent_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return FALSE;
        }
    }

    
    
    function getParentunreadFeedback(){
        $user_id = $this->CI->customlib->getParentSessionUserID();
        $fb = $this->CI->notification_model->countUnreadFeedbackParent($user_id);
        if ($fb > 0) {
            return $fb;
        } else {
            return FALSE;
        }
    }

    function getStudentSessionUserName() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $studentUsername = $session_Array['username'];
        return $studentUsername;
    }

    function getAdminSessionUserName() {
        $student_session = $this->CI->session->userdata('admin');
        $username = $student_session['username'];

        return $username;
    }

    function getStudentSessionGardianname() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $studentUsername = $session_Array['guardian_name'];
        return $studentUsername;
    }

    function getMonthDropdown() {
        $array = array();
        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $array[$m] = $month;
        }
        return $array;
    }
    
    function getMonthLists()
    {
        $month = array('January', 'February', 'March', 'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November', 'Decmber');
        return $month;
    }
    

    function getMonthList() {
        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'Decmber');
        return $months;
    }

    function getAppName() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['sch_name'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['sch_name'];
        }
    }
     function getSchoolName() {
        $admin = $this->CI->Setting_model->getSetting();
        return $admin->name;
       
    }

    function getAppVersion() {
        $appVersion = "3.0.1";
        return $appVersion;
    }

    function datetostrtotime($date) {
        $format = $this->getSchoolDateFormat();
        if ($format == 'd-m-Y')
            list($day, $month, $year) = explode('-', $date);
        if ($format == 'd/m/Y')
            list($day, $month, $year) = explode('/', $date);
        if ($format == 'd-M-Y')
            list($day, $month, $year) = explode('-', $date);
        if ($format == 'd.m.Y')
            list($day, $month, $year) = explode('.', $date);
        if ($format == 'm-d-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm/d/Y')
            list($month, $day, $year) = explode('/', $date);
        if ($format == 'm.d.Y')
            list($month, $day, $year) = explode('.', $date);
        $date = $year . "-" . $month . "-" . $day;
        return strtotime($date);
    }

    function dateyyyymmddTodateformat($date) {
        $format = $this->getSchoolDateFormat();
        if ($format == 'd-m-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd/m/Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd-M-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd.m.Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm-d-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm/d/Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm.d.Y')
            list($month, $day, $year) = explode('-', $date);
        $date = $year . "-" . $day . "-" . $month;
        return strtotime($date);
    }

    function timezone_list() {

      
            $timezones["Asia/Rangoon"]="(GMT+06:30) Asia, Rangoon";

        
        return $timezones;
    }

    function format_GMT_offset($offset) {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));
        return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    public function format_timezone_name($name) {
        $name = str_replace('/', ', ', $name);
        $name = str_replace('_', ' ', $name);
        $name = str_replace('St ', 'St. ', $name);
        return $name;
    }

    function getMailMethod() {
        $mail_method = array();
        $mail_method['sendmail'] = 'SendMail';
        $mail_method['smtp'] = 'SMTP';
        return $mail_method;
    }

    function getNotificationModes() {
        $notification = array();
        $notification['student_admission'] = $this->CI->lang->line('student_admission');
        $notification['exam_result'] = $this->CI->lang->line('exam_result');
        $notification['fee_submission'] = $this->CI->lang->line('fees_submission');
        $notification['absent_attendence'] = $this->CI->lang->line('absent_student');
        $notification['login_credential'] = $this->CI->lang->line('login_credential');
        return $notification;
    }

    function sendMailSMS($find) {

        $notifications = $this->CI->notificationsetting_model->get();


        if (!empty($notifications)) {
            foreach ($notifications as $note_key => $note_value) {
                if ($note_value->type == $find) {
                    return array('mail' => $note_value->is_mail, 'sms' => $note_value->is_sms);
                }
            }
        }
        return false;
    }

    public function setUserLog($username, $role) {
        if ($this->CI->agent->is_browser()) {
            $agent = $this->CI->agent->browser() . ' ' . $this->CI->agent->version();
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->CI->agent->robot();
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $data = array(
            'user' => $username,
            'role' => $role,
            'ipaddress' => $this->CI->input->ip_address(),
            'user_agent' => $agent . ", " . $this->CI->agent->platform(),
        );
        $this->CI->userlog_model->add($data);
    }

}
