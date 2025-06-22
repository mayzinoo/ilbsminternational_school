<link rel="stylesheet" href="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.js"></script>
<style>
    .grade-1 {
        background-color: #FA2601;
    }
    .grade-2 {
        background-color: #FA8A00;
    }
    .grade-3 {
        background-color: #FFEB00;
    }
    .grade-4 {
        background-color: #27AB00;
    }
    .grade-5 {
        background-color: #a7a7a7;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                       <!--  <div id="my-calendar"></div> -->
                         <?php
// Set your timezone
date_default_timezone_set('Asia/Rangoon');
// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}
// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
// Today
 $today = date('Y-m-j', time());
// For H3 title
$html_title = date('Y / F', $timestamp);
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));
// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
 $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);
// Create Calendar!!
$weeks = array();
$week = '';
// Add empty cell
$attes=array();
foreach($attendances->result() as $att):
$attes[$att->created_at]=$att->attendence_type_id;
endforeach;


$week .= str_repeat('<td></td>', $str);
for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
     
    $date = $ym . '-' . $day;
    if ($date == $today) {
       $c='today';
    }   
     else if(($str % 7)==0){
         $c='hol';
    } 
    else if(array_key_exists($date, $attes))
    {
       
        if($attes[$date]==4)
        {
         $c='absent';
        }
         else if($attes[$date]==2)
        {
         $c='leave';
        }
       else if($attes[$date]==3)
        {
         $c='late';
        }
        else
        {
            $c='';
        }

       
        
    }
    else {
       $c='';
    }

     $week .= '<td class="'.$c.'">' . $day;
    $week .= '</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        // Prepare for new week
        $week = '';
    }
}
?>


    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
        }
       .calendar h3 {
            margin-bottom: 30px;
            width:100%;
            text-align:center;
        }
       .calendar th {
            height: 30px;
            text-align: center;
        }
       .calendar td {
            padding:30px 0px;
            text-align:center;
        }
       .calendar .today, .cla-label .today{
            background: lightgreen;
                        font-weight:bold;

        }

         .calendar .hol,.cla-label .hol {
            color: red;
            font-weight:bold;
        }

         .calendar .leave ,.cla-label .leave{
            color: white;
            font-weight:bold;
            background:blue;
        }

          .calendar .late,.cla-label .late {
            font-weight:bold;
            background:yellow;

        }

         .calendar .absent ,.cla-label .absent{
            color: red;
            background: gray;
            font-weight:bold;

        }

        .cla-label span
        {
            padding:3px 5px;
            margin:3px;
            width:50px;
            float:right;
            text-align:center;
        }
       .calendar > th:nth-of-type(1), .calendar > td:nth-of-type(1) {
            color: red;
        }
      .calendar > th:nth-of-type(7), .calendar > td:nth-of-type(7) {
            color: blue;
        }

       .calendar span
        {
            width:10px;
            height:10px;
        }
      .calendar  .cla-label
        {
            font-weight:bold;
        }
    </style>
 
    <div class="calendar">
        <h3><a href="?ym=<?php echo $prev; ?>" class="btn btn-primary">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>" class="btn btn-primary">&gt;</a></h3>
        <table class="table table-bordered">
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>

     
    </div>

      <div class="col-md-12 cla-label text-right" >

        <span class="leave">Leave</span> 
        <span class="absent">Absent</span> 
        <span class="late">Late</span>
        <span class="today">Today</span> 


        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="application/javascript">
    $(document).ready(function () {
    var  base_url = '<?php echo base_url() ?>';
    $("#my-calendar").zabuto_calendar({
    legend: [
    {type: "block", label: "<?php echo $this->lang->line('absent') ?>", classname: 'grade-1'},
    {type: "block", label: "<?php echo $this->lang->line('present') ?>", classname: 'grade-4'},
    {type: "block", label: "<?php echo $this->lang->line('late') ?>", classname: 'grade-3'},
    {type: "block", label: "<?php echo $this->lang->line('late_with_excuse') ?>", classname: 'grade-2'},
    {type: "block", label: "<?php echo $this->lang->line('holiday') ?>", classname: 'grade-5'},
    ],
    ajax: {
    url: base_url+"user/attendence/getAttendence?grade=1",
    }
    });
    });
</script>