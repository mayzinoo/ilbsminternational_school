<?php


/**
 * @author Mingun Technology <office@mingun.com.mm>
 * @copyright Mingun Technology co.,Ltd 2018
 * @package essential_sms
 * 
 * 
 * Created using Ionic App Builder
 * http://codecanyon.net/item/ionic-mobile-app-builder/15716727
 */


/** CONFIG:START **/
$config["host"] 		= "localhost" ; 		//host
$config["user"] 		= "mmk_essentialsms" ; 		//Username SQL
$config["pass"] 		= "_R4q9IodK7Et" ; 		//Password SQL
$config["dbase"] 		= "mmk_essentialsms" ; 		//Database
$config["utf8"] 		= true ; 		//turkish charset set false
$config["timezone"] 		= "Asia/Jakarta" ; 		// check this site: http://php.net/manual/en/timezones.php
$config["abs_url_images"] 		= "http://smsdemo.minguntechnology.com" ; 		//Absolute Images URL
$config["abs_url_videos"] 		= "http://smsdemo.minguntechnology.com" ; 		//Absolute Videos URL
$config["abs_url_audios"] 		= "http://smsdemo.minguntechnology.com" ; 		//Absolute Audio URL
$config["abs_url_files"] 		= "http://smsdemo.minguntechnology.com" ; 		//Absolute Files URL
$config["image_allowed"][] 		= array("mimetype"=>"image/jpeg","ext"=>"jpg") ; 		//whitelist image
$config["image_allowed"][] 		= array("mimetype"=>"image/jpg","ext"=>"jpg") ; 		
$config["image_allowed"][] 		= array("mimetype"=>"image/png","ext"=>"png") ; 		
$config["file_allowed"][] 		= array("mimetype"=>"text/plain","ext"=>"txt") ; 		
$config["file_allowed"][] 		= array("mimetype"=>"","ext"=>"tmp") ; 		
/** CONFIG:END **/

date_default_timezone_set($config['timezone']);
if(isset($_SERVER["HTTP_X_AUTHORIZATION"])){
	list($_SERVER["PHP_AUTH_USER"],$_SERVER["PHP_AUTH_PW"]) = explode(":" , base64_decode(substr($_SERVER["HTTP_X_AUTHORIZATION"],6)));
}
$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Routes not found");

/** connect to mysql **/
$mysql = new mysqli($config["host"], $config["user"], $config["pass"], $config["dbase"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}


if(!isset($_GET["json"])){
	$_GET["json"]= "route";
}
if((!isset($_GET["form"])) && ($_GET["json"] == "submit")) {
	$_GET["json"]= "route";
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}

$get_dir = explode("/", $_SERVER["PHP_SELF"]);
unset($get_dir[count($get_dir)-1]);
$main_url = "http://" . $_SERVER["HTTP_HOST"] . implode("/",$get_dir)."/";


switch($_GET["json"]){	
	// TODO: -+- Listing : books
	case "books":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["book_title"])){
			if($_GET["book_title"]!="-1"){
				$_where[] = "`book_title` LIKE '".$mysql->escape_string($_GET["book_title"])."'";
			}
		}
		if(isset($_GET["book_no"])){
			if($_GET["book_no"]!="-1"){
				$_where[] = "`book_no` LIKE '".$mysql->escape_string($_GET["book_no"])."'";
			}
		}
		if(isset($_GET["publish"])){
			if($_GET["publish"]!="-1"){
				$_where[] = "`publish` LIKE '".$mysql->escape_string($_GET["publish"])."'";
			}
		}
		if(isset($_GET["author"])){
			if($_GET["author"]!="-1"){
				$_where[] = "`author` LIKE '".$mysql->escape_string($_GET["author"])."'";
			}
		}
		if(isset($_GET["subject"])){
			if($_GET["subject"]!="-1"){
				$_where[] = "`subject` LIKE '".$mysql->escape_string($_GET["subject"])."'";
			}
		}
		if(isset($_GET["postdate"])){
			if($_GET["postdate"]!="-1"){
				$_where[] = "`postdate` LIKE '".$mysql->escape_string($_GET["postdate"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="book_title"){
			$order_by = "`book_title`";
		}
		if($_GET["order"]=="book_no"){
			$order_by = "`book_no`";
		}
		if($_GET["order"]=="publish"){
			$order_by = "`publish`";
		}
		if($_GET["order"]=="author"){
			$order_by = "`author`";
		}
		if($_GET["order"]=="subject"){
			$order_by = "`subject`";
		}
		if($_GET["order"]=="postdate"){
			$order_by = "`postdate`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `books` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['book_title'])){$rest_api[$z]['book_title'] = $data['book_title'];}; # heading-1
				if(isset($data['book_no'])){$rest_api[$z]['book_no'] = $data['book_no'];}; # text
				if(isset($data['publish'])){$rest_api[$z]['publish'] = $data['publish'];}; # text
				if(isset($data['author'])){$rest_api[$z]['author'] = $data['author'];}; # text
				if(isset($data['subject'])){$rest_api[$z]['subject'] = $data['subject'];}; # text
				
				/** date**/
				if($data['postdate'] != ''){
				$rest_api[$z]['postdate'] =  mktime( 0,0,0,substr($data['postdate'],5,2),substr($data['postdate'],8,2),substr($data['postdate'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['postdate'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : dailyrecord
	case "dailyrecord":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["section_id"])){
			if($_GET["section_id"]!="-1"){
				$_where[] = "`section_id` LIKE '".$mysql->escape_string($_GET["section_id"])."'";
			}
		}
		if(isset($_GET["class_section_id"])){
			if($_GET["class_section_id"]!="-1"){
				$_where[] = "`class_section_id` LIKE '".$mysql->escape_string($_GET["class_section_id"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="section_id"){
			$order_by = "`section_id`";
		}
		if($_GET["order"]=="class_section_id"){
			$order_by = "`class_section_id`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `dailyrecord` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['section_id'])){$rest_api[$z]['section_id'] = $data['section_id'];}; # number
				if(isset($data['class_section_id'])){$rest_api[$z]['class_section_id'] = $data['class_section_id'];}; # number
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : event
	case "event":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["title"])){
			if($_GET["title"]!="-1"){
				$_where[] = "`title` LIKE '".$mysql->escape_string($_GET["title"])."'";
			}
		}
		if(isset($_GET["short_line"])){
			if($_GET["short_line"]!="-1"){
				$_where[] = "`short_line` LIKE '".$mysql->escape_string($_GET["short_line"])."'";
			}
		}
		if(isset($_GET["description"])){
			if($_GET["description"]!="-1"){
				$_where[] = "`description` LIKE '".$mysql->escape_string($_GET["description"])."'";
			}
		}
		if(isset($_GET["image"])){
			if($_GET["image"]!="-1"){
				$_where[] = "`image` LIKE '".$mysql->escape_string($_GET["image"])."'";
			}
		}
		if(isset($_GET["date"])){
			if($_GET["date"]!="-1"){
				$_where[] = "`date` LIKE '".$mysql->escape_string($_GET["date"])."'";
			}
		}
		if(isset($_GET["venue"])){
			if($_GET["venue"]!="-1"){
				$_where[] = "`venue` LIKE '".$mysql->escape_string($_GET["venue"])."'";
			}
		}
		if(isset($_GET["language"])){
			if($_GET["language"]!="-1"){
				$_where[] = "`language` LIKE '".$mysql->escape_string($_GET["language"])."'";
			}
		}
		if(isset($_GET["remark"])){
			if($_GET["remark"]!="-1"){
				$_where[] = "`remark` LIKE '".$mysql->escape_string($_GET["remark"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="title"){
			$order_by = "`title`";
		}
		if($_GET["order"]=="short_line"){
			$order_by = "`short_line`";
		}
		if($_GET["order"]=="description"){
			$order_by = "`description`";
		}
		if($_GET["order"]=="image"){
			$order_by = "`image`";
		}
		if($_GET["order"]=="date"){
			$order_by = "`date`";
		}
		if($_GET["order"]=="venue"){
			$order_by = "`venue`";
		}
		if($_GET["order"]=="language"){
			$order_by = "`language`";
		}
		if($_GET["order"]=="remark"){
			$order_by = "`remark`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `event` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['title'])){$rest_api[$z]['title'] = $data['title'];}; # heading-1
				if(isset($data['short_line'])){$rest_api[$z]['short_line'] = $data['short_line'];}; # to_trusted
				if(isset($data['description'])){$rest_api[$z]['description'] = $data['description'];}; # to_trusted
				
				/** images**/
				$abs_url_images = $config['abs_url_images'].'/';
				$abs_url_videos = $config['abs_url_videos'].'/';
				$abs_url_audios = $config['abs_url_audios'].'/';
				if(!isset($data['image'])){$data['image']='undefined';}; # images
				if((substr($data['image'], 0, 7)=='http://')||(substr($data['image'], 0, 8)=='https://')){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if(substr($data['image'], 0, 5)=='data:'){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if($data['image'] != ''){
					$rest_api[$z]['image'] = $abs_url_images . $data['image']; # images
				}else{
					$rest_api[$z]['image'] = ''; # images
				}
				
				/** date**/
				if($data['date'] != ''){
				$rest_api[$z]['date'] =  mktime( 0,0,0,substr($data['date'],5,2),substr($data['date'],8,2),substr($data['date'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['date'] = 0; # date
				}
				if(isset($data['venue'])){$rest_api[$z]['venue'] = $data['venue'];}; # text
				if(isset($data['language'])){$rest_api[$z]['language'] = $data['language'];}; # text
				if(isset($data['remark'])){$rest_api[$z]['remark'] = $data['remark'];}; # text
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : exam_results
	case "exam_results":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["attendence"])){
			if($_GET["attendence"]!="-1"){
				$_where[] = "`attendence` LIKE '".$mysql->escape_string($_GET["attendence"])."'";
			}
		}
		if(isset($_GET["_exam_schedule_id"])){
			if($_GET["_exam_schedule_id"]!="-1"){
				$_where[] = "`_exam_schedule_id` LIKE '".$mysql->escape_string($_GET["_exam_schedule_id"])."'";
			}
		}
		if(isset($_GET["student_id"])){
			if($_GET["student_id"]!="-1"){
				$_where[] = "`student_id` LIKE '".$mysql->escape_string($_GET["student_id"])."'";
			}
		}
		if(isset($_GET["get_marks"])){
			if($_GET["get_marks"]!="-1"){
				$_where[] = "`get_marks` LIKE '".$mysql->escape_string($_GET["get_marks"])."'";
			}
		}
		if(isset($_GET["note"])){
			if($_GET["note"]!="-1"){
				$_where[] = "`note` LIKE '".$mysql->escape_string($_GET["note"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="attendence"){
			$order_by = "`attendence`";
		}
		if($_GET["order"]=="_exam_schedule_id"){
			$order_by = "`_exam_schedule_id`";
		}
		if($_GET["order"]=="student_id"){
			$order_by = "`student_id`";
		}
		if($_GET["order"]=="get_marks"){
			$order_by = "`get_marks`";
		}
		if($_GET["order"]=="note"){
			$order_by = "`note`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `exam_results` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['attendence'])){$rest_api[$z]['attendence'] = $data['attendence'];}; # heading-1
				if(isset($data['_exam_schedule_id'])){$rest_api[$z]['_exam_schedule_id'] = $data['_exam_schedule_id'];}; # number
				if(isset($data['student_id'])){$rest_api[$z]['student_id'] = $data['student_id'];}; # number
				if(isset($data['get_marks'])){$rest_api[$z]['get_marks'] = $data['get_marks'];}; # float
				if(isset($data['note'])){$rest_api[$z]['note'] = $data['note'];}; # to_trusted
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : exam_schedules
	case "exam_schedules":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["exam_id"])){
			if($_GET["exam_id"]!="-1"){
				$_where[] = "`exam_id` LIKE '".$mysql->escape_string($_GET["exam_id"])."'";
			}
		}
		if(isset($_GET["teacher_subject_id"])){
			if($_GET["teacher_subject_id"]!="-1"){
				$_where[] = "`teacher_subject_id` LIKE '".$mysql->escape_string($_GET["teacher_subject_id"])."'";
			}
		}
		if(isset($_GET["date_of_exam"])){
			if($_GET["date_of_exam"]!="-1"){
				$_where[] = "`date_of_exam` LIKE '".$mysql->escape_string($_GET["date_of_exam"])."'";
			}
		}
		if(isset($_GET["start_to"])){
			if($_GET["start_to"]!="-1"){
				$_where[] = "`start_to` LIKE '".$mysql->escape_string($_GET["start_to"])."'";
			}
		}
		if(isset($_GET["end_from"])){
			if($_GET["end_from"]!="-1"){
				$_where[] = "`end_from` LIKE '".$mysql->escape_string($_GET["end_from"])."'";
			}
		}
		if(isset($_GET["passing_marks"])){
			if($_GET["passing_marks"]!="-1"){
				$_where[] = "`passing_marks` LIKE '".$mysql->escape_string($_GET["passing_marks"])."'";
			}
		}
		if(isset($_GET["full_marks"])){
			if($_GET["full_marks"]!="-1"){
				$_where[] = "`full_marks` LIKE '".$mysql->escape_string($_GET["full_marks"])."'";
			}
		}
		if(isset($_GET["room_no"])){
			if($_GET["room_no"]!="-1"){
				$_where[] = "`room_no` LIKE '".$mysql->escape_string($_GET["room_no"])."'";
			}
		}
		if(isset($_GET["note"])){
			if($_GET["note"]!="-1"){
				$_where[] = "`note` LIKE '".$mysql->escape_string($_GET["note"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="exam_id"){
			$order_by = "`exam_id`";
		}
		if($_GET["order"]=="teacher_subject_id"){
			$order_by = "`teacher_subject_id`";
		}
		if($_GET["order"]=="date_of_exam"){
			$order_by = "`date_of_exam`";
		}
		if($_GET["order"]=="start_to"){
			$order_by = "`start_to`";
		}
		if($_GET["order"]=="end_from"){
			$order_by = "`end_from`";
		}
		if($_GET["order"]=="passing_marks"){
			$order_by = "`passing_marks`";
		}
		if($_GET["order"]=="full_marks"){
			$order_by = "`full_marks`";
		}
		if($_GET["order"]=="room_no"){
			$order_by = "`room_no`";
		}
		if($_GET["order"]=="note"){
			$order_by = "`note`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `exam_schedules` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['exam_id'])){$rest_api[$z]['exam_id'] = $data['exam_id'];}; # text
				if(isset($data['teacher_subject_id'])){$rest_api[$z]['teacher_subject_id'] = $data['teacher_subject_id'];}; # text
				
				/** date**/
				if($data['date_of_exam'] != ''){
				$rest_api[$z]['date_of_exam'] =  mktime( 0,0,0,substr($data['date_of_exam'],5,2),substr($data['date_of_exam'],8,2),substr($data['date_of_exam'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['date_of_exam'] = 0; # date
				}
				if(isset($data['start_to'])){$rest_api[$z]['start_to'] = $data['start_to'];}; # share_link
				if(isset($data['end_from'])){$rest_api[$z]['end_from'] = $data['end_from'];}; # text
				if(isset($data['passing_marks'])){$rest_api[$z]['passing_marks'] = $data['passing_marks'];}; # number
				if(isset($data['full_marks'])){$rest_api[$z]['full_marks'] = $data['full_marks'];}; # number
				if(isset($data['room_no'])){$rest_api[$z]['room_no'] = $data['room_no'];}; # number
				if(isset($data['note'])){$rest_api[$z]['note'] = $data['note'];}; # text
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : fee_collection
	case "fee_collection":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["student_id"])){
			if($_GET["student_id"]!="-1"){
				$_where[] = "`student_id` LIKE '".$mysql->escape_string($_GET["student_id"])."'";
			}
		}
		if(isset($_GET["total_amount"])){
			if($_GET["total_amount"]!="-1"){
				$_where[] = "`total_amount` LIKE '".$mysql->escape_string($_GET["total_amount"])."'";
			}
		}
		if(isset($_GET["total_received"])){
			if($_GET["total_received"]!="-1"){
				$_where[] = "`total_received` LIKE '".$mysql->escape_string($_GET["total_received"])."'";
			}
		}
		if(isset($_GET["payment_for"])){
			if($_GET["payment_for"]!="-1"){
				$_where[] = "`payment_for` LIKE '".$mysql->escape_string($_GET["payment_for"])."'";
			}
		}
		if(isset($_GET["payment_mode"])){
			if($_GET["payment_mode"]!="-1"){
				$_where[] = "`payment_mode` LIKE '".$mysql->escape_string($_GET["payment_mode"])."'";
			}
		}
		if(isset($_GET["paydate"])){
			if($_GET["paydate"]!="-1"){
				$_where[] = "`paydate` LIKE '".$mysql->escape_string($_GET["paydate"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="student_id"){
			$order_by = "`student_id`";
		}
		if($_GET["order"]=="total_amount"){
			$order_by = "`total_amount`";
		}
		if($_GET["order"]=="total_received"){
			$order_by = "`total_received`";
		}
		if($_GET["order"]=="payment_for"){
			$order_by = "`payment_for`";
		}
		if($_GET["order"]=="payment_mode"){
			$order_by = "`payment_mode`";
		}
		if($_GET["order"]=="paydate"){
			$order_by = "`paydate`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `fee_collection` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['student_id'])){$rest_api[$z]['student_id'] = $data['student_id'];}; # number
				if(isset($data['total_amount'])){$rest_api[$z]['total_amount'] = $data['total_amount'];}; # number
				if(isset($data['total_received'])){$rest_api[$z]['total_received'] = $data['total_received'];}; # number
				if(isset($data['payment_for'])){$rest_api[$z]['payment_for'] = $data['payment_for'];}; # text
				if(isset($data['payment_mode'])){$rest_api[$z]['payment_mode'] = $data['payment_mode'];}; # text
				
				/** date**/
				if($data['paydate'] != ''){
				$rest_api[$z]['paydate'] =  mktime( 0,0,0,substr($data['paydate'],5,2),substr($data['paydate'],8,2),substr($data['paydate'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['paydate'] = 0; # date
				}
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : feedback
	case "feedback":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["subject"])){
			if($_GET["subject"]!="-1"){
				$_where[] = "`subject` LIKE '".$mysql->escape_string($_GET["subject"])."'";
			}
		}
		if(isset($_GET["phone"])){
			if($_GET["phone"]!="-1"){
				$_where[] = "`phone` LIKE '".$mysql->escape_string($_GET["phone"])."'";
			}
		}
		if(isset($_GET["message"])){
			if($_GET["message"]!="-1"){
				$_where[] = "`message` LIKE '".$mysql->escape_string($_GET["message"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="subject"){
			$order_by = "`subject`";
		}
		if($_GET["order"]=="phone"){
			$order_by = "`phone`";
		}
		if($_GET["order"]=="message"){
			$order_by = "`message`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `feedback` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['subject'])){$rest_api[$z]['subject'] = $data['subject'];}; # text
				if(isset($data['phone'])){$rest_api[$z]['phone'] = $data['phone'];}; # text
				if(isset($data['message'])){$rest_api[$z]['message'] = $data['message'];}; # text
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : send_notification
	case "send_notification":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["title"])){
			if($_GET["title"]!="-1"){
				$_where[] = "`title` LIKE '".$mysql->escape_string($_GET["title"])."'";
			}
		}
		if(isset($_GET["publish_date"])){
			if($_GET["publish_date"]!="-1"){
				$_where[] = "`publish_date` LIKE '".$mysql->escape_string($_GET["publish_date"])."'";
			}
		}
		if(isset($_GET["message"])){
			if($_GET["message"]!="-1"){
				$_where[] = "`message` LIKE '".$mysql->escape_string($_GET["message"])."'";
			}
		}
		if(isset($_GET["created_by"])){
			if($_GET["created_by"]!="-1"){
				$_where[] = "`created_by` LIKE '".$mysql->escape_string($_GET["created_by"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="title"){
			$order_by = "`title`";
		}
		if($_GET["order"]=="publish_date"){
			$order_by = "`publish_date`";
		}
		if($_GET["order"]=="message"){
			$order_by = "`message`";
		}
		if($_GET["order"]=="created_by"){
			$order_by = "`created_by`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `send_notification` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['title'])){$rest_api[$z]['title'] = $data['title'];}; # heading-1
				
				/** date**/
				if($data['publish_date'] != ''){
				$rest_api[$z]['publish_date'] =  mktime( 0,0,0,substr($data['publish_date'],5,2),substr($data['publish_date'],8,2),substr($data['publish_date'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['publish_date'] = 0; # date
				}
				if(isset($data['message'])){$rest_api[$z]['message'] = $data['message'];}; # to_trusted
				if(isset($data['created_by'])){$rest_api[$z]['created_by'] = $data['created_by'];}; # text
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : student_attendences
	case "student_attendences":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["student_id"])){
			if($_GET["student_id"]!="-1"){
				$_where[] = "`student_id` LIKE '".$mysql->escape_string($_GET["student_id"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["in_time"])){
			if($_GET["in_time"]!="-1"){
				$_where[] = "`in_time` LIKE '".$mysql->escape_string($_GET["in_time"])."'";
			}
		}
		if(isset($_GET["out_time"])){
			if($_GET["out_time"]!="-1"){
				$_where[] = "`out_time` LIKE '".$mysql->escape_string($_GET["out_time"])."'";
			}
		}
		if(isset($_GET["attendence_type_id"])){
			if($_GET["attendence_type_id"]!="-1"){
				$_where[] = "`attendence_type_id` LIKE '".$mysql->escape_string($_GET["attendence_type_id"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="student_id"){
			$order_by = "`student_id`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="in_time"){
			$order_by = "`in_time`";
		}
		if($_GET["order"]=="out_time"){
			$order_by = "`out_time`";
		}
		if($_GET["order"]=="attendence_type_id"){
			$order_by = "`attendence_type_id`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `student_attendences` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['student_id'])){$rest_api[$z]['student_id'] = $data['student_id'];}; # number
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				
				/** datetime**/
				if($data['in_time'] != ''){
				$rest_api[$z]['in_time'] =  mktime(substr($data['in_time'],11,2),substr($data['in_time'],14,2),substr($data['in_time'],17,2),substr($data['in_time'],5,2),substr($data['in_time'],8,2),substr($data['in_time'],0,4)) * 1000; # datetime
				}else{
					$rest_api[$z]['in_time'] = 0; # datetime
				}
				
				/** datetime**/
				if($data['out_time'] != ''){
				$rest_api[$z]['out_time'] =  mktime(substr($data['out_time'],11,2),substr($data['out_time'],14,2),substr($data['out_time'],17,2),substr($data['out_time'],5,2),substr($data['out_time'],8,2),substr($data['out_time'],0,4)) * 1000; # datetime
				}else{
					$rest_api[$z]['out_time'] = 0; # datetime
				}
				if(isset($data['attendence_type_id'])){$rest_api[$z]['attendence_type_id'] = $data['attendence_type_id'];}; # number
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : students
	case "students":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["admission_no"])){
			if($_GET["admission_no"]!="-1"){
				$_where[] = "`admission_no` LIKE '".$mysql->escape_string($_GET["admission_no"])."'";
			}
		}
		if(isset($_GET["roll_no"])){
			if($_GET["roll_no"]!="-1"){
				$_where[] = "`roll_no` LIKE '".$mysql->escape_string($_GET["roll_no"])."'";
			}
		}
		if(isset($_GET["admission_date"])){
			if($_GET["admission_date"]!="-1"){
				$_where[] = "`admission_date` LIKE '".$mysql->escape_string($_GET["admission_date"])."'";
			}
		}
		if(isset($_GET["firstname"])){
			if($_GET["firstname"]!="-1"){
				$_where[] = "`firstname` LIKE '".$mysql->escape_string($_GET["firstname"])."'";
			}
		}
		if(isset($_GET["lastname"])){
			if($_GET["lastname"]!="-1"){
				$_where[] = "`lastname` LIKE '".$mysql->escape_string($_GET["lastname"])."'";
			}
		}
		if(isset($_GET["image"])){
			if($_GET["image"]!="-1"){
				$_where[] = "`image` LIKE '".$mysql->escape_string($_GET["image"])."'";
			}
		}
		if(isset($_GET["mobileno"])){
			if($_GET["mobileno"]!="-1"){
				$_where[] = "`mobileno` LIKE '".$mysql->escape_string($_GET["mobileno"])."'";
			}
		}
		if(isset($_GET["email"])){
			if($_GET["email"]!="-1"){
				$_where[] = "`email` LIKE '".$mysql->escape_string($_GET["email"])."'";
			}
		}
		if(isset($_GET["state"])){
			if($_GET["state"]!="-1"){
				$_where[] = "`state` LIKE '".$mysql->escape_string($_GET["state"])."'";
			}
		}
		if(isset($_GET["city"])){
			if($_GET["city"]!="-1"){
				$_where[] = "`city` LIKE '".$mysql->escape_string($_GET["city"])."'";
			}
		}
		if(isset($_GET["religion"])){
			if($_GET["religion"]!="-1"){
				$_where[] = "`religion` LIKE '".$mysql->escape_string($_GET["religion"])."'";
			}
		}
		if(isset($_GET["dob"])){
			if($_GET["dob"]!="-1"){
				$_where[] = "`dob` LIKE '".$mysql->escape_string($_GET["dob"])."'";
			}
		}
		if(isset($_GET["gender"])){
			if($_GET["gender"]!="-1"){
				$_where[] = "`gender` LIKE '".$mysql->escape_string($_GET["gender"])."'";
			}
		}
		if(isset($_GET["current_address"])){
			if($_GET["current_address"]!="-1"){
				$_where[] = "`current_address` LIKE '".$mysql->escape_string($_GET["current_address"])."'";
			}
		}
		if(isset($_GET["permanent_address"])){
			if($_GET["permanent_address"]!="-1"){
				$_where[] = "`permanent_address` LIKE '".$mysql->escape_string($_GET["permanent_address"])."'";
			}
		}
		if(isset($_GET["category_id"])){
			if($_GET["category_id"]!="-1"){
				$_where[] = "`category_id` LIKE '".$mysql->escape_string($_GET["category_id"])."'";
			}
		}
		if(isset($_GET["adhar_no"])){
			if($_GET["adhar_no"]!="-1"){
				$_where[] = "`adhar_no` LIKE '".$mysql->escape_string($_GET["adhar_no"])."'";
			}
		}
		if(isset($_GET["samagra_id"])){
			if($_GET["samagra_id"]!="-1"){
				$_where[] = "`samagra_id` LIKE '".$mysql->escape_string($_GET["samagra_id"])."'";
			}
		}
		if(isset($_GET["bank_account_no"])){
			if($_GET["bank_account_no"]!="-1"){
				$_where[] = "`bank_account_no` LIKE '".$mysql->escape_string($_GET["bank_account_no"])."'";
			}
		}
		if(isset($_GET["bank_name"])){
			if($_GET["bank_name"]!="-1"){
				$_where[] = "`bank_name` LIKE '".$mysql->escape_string($_GET["bank_name"])."'";
			}
		}
		if(isset($_GET["ifsc_code"])){
			if($_GET["ifsc_code"]!="-1"){
				$_where[] = "`ifsc_code` LIKE '".$mysql->escape_string($_GET["ifsc_code"])."'";
			}
		}
		if(isset($_GET["guardian_is"])){
			if($_GET["guardian_is"]!="-1"){
				$_where[] = "`guardian_is` LIKE '".$mysql->escape_string($_GET["guardian_is"])."'";
			}
		}
		if(isset($_GET["father_name"])){
			if($_GET["father_name"]!="-1"){
				$_where[] = "`father_name` LIKE '".$mysql->escape_string($_GET["father_name"])."'";
			}
		}
		if(isset($_GET["father_phone"])){
			if($_GET["father_phone"]!="-1"){
				$_where[] = "`father_phone` LIKE '".$mysql->escape_string($_GET["father_phone"])."'";
			}
		}
		if(isset($_GET["father_occupation"])){
			if($_GET["father_occupation"]!="-1"){
				$_where[] = "`father_occupation` LIKE '".$mysql->escape_string($_GET["father_occupation"])."'";
			}
		}
		if(isset($_GET["mother_name"])){
			if($_GET["mother_name"]!="-1"){
				$_where[] = "`mother_name` LIKE '".$mysql->escape_string($_GET["mother_name"])."'";
			}
		}
		if(isset($_GET["mother_phone"])){
			if($_GET["mother_phone"]!="-1"){
				$_where[] = "`mother_phone` LIKE '".$mysql->escape_string($_GET["mother_phone"])."'";
			}
		}
		if(isset($_GET["mother_occupation"])){
			if($_GET["mother_occupation"]!="-1"){
				$_where[] = "`mother_occupation` LIKE '".$mysql->escape_string($_GET["mother_occupation"])."'";
			}
		}
		if(isset($_GET["guardian_name"])){
			if($_GET["guardian_name"]!="-1"){
				$_where[] = "`guardian_name` LIKE '".$mysql->escape_string($_GET["guardian_name"])."'";
			}
		}
		if(isset($_GET["guardian_relation"])){
			if($_GET["guardian_relation"]!="-1"){
				$_where[] = "`guardian_relation` LIKE '".$mysql->escape_string($_GET["guardian_relation"])."'";
			}
		}
		if(isset($_GET["guardian_phone"])){
			if($_GET["guardian_phone"]!="-1"){
				$_where[] = "`guardian_phone` LIKE '".$mysql->escape_string($_GET["guardian_phone"])."'";
			}
		}
		if(isset($_GET["guardian_occupation"])){
			if($_GET["guardian_occupation"]!="-1"){
				$_where[] = "`guardian_occupation` LIKE '".$mysql->escape_string($_GET["guardian_occupation"])."'";
			}
		}
		if(isset($_GET["guardian_address"])){
			if($_GET["guardian_address"]!="-1"){
				$_where[] = "`guardian_address` LIKE '".$mysql->escape_string($_GET["guardian_address"])."'";
			}
		}
		if(isset($_GET["guardian_email"])){
			if($_GET["guardian_email"]!="-1"){
				$_where[] = "`guardian_email` LIKE '".$mysql->escape_string($_GET["guardian_email"])."'";
			}
		}
		if(isset($_GET["previous_school"])){
			if($_GET["previous_school"]!="-1"){
				$_where[] = "`previous_school` LIKE '".$mysql->escape_string($_GET["previous_school"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["updated_at"])){
			if($_GET["updated_at"]!="-1"){
				$_where[] = "`updated_at` LIKE '".$mysql->escape_string($_GET["updated_at"])."'";
			}
		}
		if(isset($_GET["resign"])){
			if($_GET["resign"]!="-1"){
				$_where[] = "`resign` LIKE '".$mysql->escape_string($_GET["resign"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="admission_no"){
			$order_by = "`admission_no`";
		}
		if($_GET["order"]=="roll_no"){
			$order_by = "`roll_no`";
		}
		if($_GET["order"]=="admission_date"){
			$order_by = "`admission_date`";
		}
		if($_GET["order"]=="firstname"){
			$order_by = "`firstname`";
		}
		if($_GET["order"]=="lastname"){
			$order_by = "`lastname`";
		}
		if($_GET["order"]=="image"){
			$order_by = "`image`";
		}
		if($_GET["order"]=="mobileno"){
			$order_by = "`mobileno`";
		}
		if($_GET["order"]=="email"){
			$order_by = "`email`";
		}
		if($_GET["order"]=="state"){
			$order_by = "`state`";
		}
		if($_GET["order"]=="city"){
			$order_by = "`city`";
		}
		if($_GET["order"]=="religion"){
			$order_by = "`religion`";
		}
		if($_GET["order"]=="dob"){
			$order_by = "`dob`";
		}
		if($_GET["order"]=="gender"){
			$order_by = "`gender`";
		}
		if($_GET["order"]=="current_address"){
			$order_by = "`current_address`";
		}
		if($_GET["order"]=="permanent_address"){
			$order_by = "`permanent_address`";
		}
		if($_GET["order"]=="category_id"){
			$order_by = "`category_id`";
		}
		if($_GET["order"]=="adhar_no"){
			$order_by = "`adhar_no`";
		}
		if($_GET["order"]=="samagra_id"){
			$order_by = "`samagra_id`";
		}
		if($_GET["order"]=="bank_account_no"){
			$order_by = "`bank_account_no`";
		}
		if($_GET["order"]=="bank_name"){
			$order_by = "`bank_name`";
		}
		if($_GET["order"]=="ifsc_code"){
			$order_by = "`ifsc_code`";
		}
		if($_GET["order"]=="guardian_is"){
			$order_by = "`guardian_is`";
		}
		if($_GET["order"]=="father_name"){
			$order_by = "`father_name`";
		}
		if($_GET["order"]=="father_phone"){
			$order_by = "`father_phone`";
		}
		if($_GET["order"]=="father_occupation"){
			$order_by = "`father_occupation`";
		}
		if($_GET["order"]=="mother_name"){
			$order_by = "`mother_name`";
		}
		if($_GET["order"]=="mother_phone"){
			$order_by = "`mother_phone`";
		}
		if($_GET["order"]=="mother_occupation"){
			$order_by = "`mother_occupation`";
		}
		if($_GET["order"]=="guardian_name"){
			$order_by = "`guardian_name`";
		}
		if($_GET["order"]=="guardian_relation"){
			$order_by = "`guardian_relation`";
		}
		if($_GET["order"]=="guardian_phone"){
			$order_by = "`guardian_phone`";
		}
		if($_GET["order"]=="guardian_occupation"){
			$order_by = "`guardian_occupation`";
		}
		if($_GET["order"]=="guardian_address"){
			$order_by = "`guardian_address`";
		}
		if($_GET["order"]=="guardian_email"){
			$order_by = "`guardian_email`";
		}
		if($_GET["order"]=="previous_school"){
			$order_by = "`previous_school`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="updated_at"){
			$order_by = "`updated_at`";
		}
		if($_GET["order"]=="resign"){
			$order_by = "`resign`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `students` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['admission_no'])){$rest_api[$z]['admission_no'] = $data['admission_no'];}; # heading-1
				if(isset($data['roll_no'])){$rest_api[$z]['roll_no'] = $data['roll_no'];}; # heading-1
				
				/** date**/
				if($data['admission_date'] != ''){
				$rest_api[$z]['admission_date'] =  mktime( 0,0,0,substr($data['admission_date'],5,2),substr($data['admission_date'],8,2),substr($data['admission_date'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['admission_date'] = 0; # date
				}
				if(isset($data['firstname'])){$rest_api[$z]['firstname'] = $data['firstname'];}; # heading-1
				if(isset($data['lastname'])){$rest_api[$z]['lastname'] = $data['lastname'];}; # heading-1
				
				/** images**/
				$abs_url_images = $config['abs_url_images'].'/';
				$abs_url_videos = $config['abs_url_videos'].'/';
				$abs_url_audios = $config['abs_url_audios'].'/';
				if(!isset($data['image'])){$data['image']='undefined';}; # images
				if((substr($data['image'], 0, 7)=='http://')||(substr($data['image'], 0, 8)=='https://')){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if(substr($data['image'], 0, 5)=='data:'){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if($data['image'] != ''){
					$rest_api[$z]['image'] = $abs_url_images . $data['image']; # images
				}else{
					$rest_api[$z]['image'] = ''; # images
				}
				if(isset($data['mobileno'])){$rest_api[$z]['mobileno'] = $data['mobileno'];}; # number
				if(isset($data['email'])){$rest_api[$z]['email'] = $data['email'];}; # app_email
				if(isset($data['state'])){$rest_api[$z]['state'] = $data['state'];}; # heading-1
				if(isset($data['city'])){$rest_api[$z]['city'] = $data['city'];}; # heading-1
				if(isset($data['religion'])){$rest_api[$z]['religion'] = $data['religion'];}; # heading-1
				
				/** date**/
				if($data['dob'] != ''){
				$rest_api[$z]['dob'] =  mktime( 0,0,0,substr($data['dob'],5,2),substr($data['dob'],8,2),substr($data['dob'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['dob'] = 0; # date
				}
				if(isset($data['gender'])){$rest_api[$z]['gender'] = $data['gender'];}; # heading-2
				if(isset($data['current_address'])){$rest_api[$z]['current_address'] = $data['current_address'];}; # text
				if(isset($data['permanent_address'])){$rest_api[$z]['permanent_address'] = $data['permanent_address'];}; # text
				if(isset($data['category_id'])){$rest_api[$z]['category_id'] = $data['category_id'];}; # heading-2
				if(isset($data['adhar_no'])){$rest_api[$z]['adhar_no'] = $data['adhar_no'];}; # heading-2
				if(isset($data['samagra_id'])){$rest_api[$z]['samagra_id'] = $data['samagra_id'];}; # number
				if(isset($data['bank_account_no'])){$rest_api[$z]['bank_account_no'] = $data['bank_account_no'];}; # number
				if(isset($data['bank_name'])){$rest_api[$z]['bank_name'] = $data['bank_name'];}; # heading-2
				if(isset($data['ifsc_code'])){$rest_api[$z]['ifsc_code'] = $data['ifsc_code'];}; # heading-2
				if(isset($data['guardian_is'])){$rest_api[$z]['guardian_is'] = $data['guardian_is'];}; # heading-2
				if(isset($data['father_name'])){$rest_api[$z]['father_name'] = $data['father_name'];}; # heading-2
				if(isset($data['father_phone'])){$rest_api[$z]['father_phone'] = $data['father_phone'];}; # app_call
				if(isset($data['father_occupation'])){$rest_api[$z]['father_occupation'] = $data['father_occupation'];}; # text
				if(isset($data['mother_name'])){$rest_api[$z]['mother_name'] = $data['mother_name'];}; # heading-2
				if(isset($data['mother_phone'])){$rest_api[$z]['mother_phone'] = $data['mother_phone'];}; # app_call
				if(isset($data['mother_occupation'])){$rest_api[$z]['mother_occupation'] = $data['mother_occupation'];}; # heading-2
				if(isset($data['guardian_name'])){$rest_api[$z]['guardian_name'] = $data['guardian_name'];}; # heading-2
				if(isset($data['guardian_relation'])){$rest_api[$z]['guardian_relation'] = $data['guardian_relation'];}; # heading-2
				if(isset($data['guardian_phone'])){$rest_api[$z]['guardian_phone'] = $data['guardian_phone'];}; # heading-2
				if(isset($data['guardian_occupation'])){$rest_api[$z]['guardian_occupation'] = $data['guardian_occupation'];}; # heading-2
				if(isset($data['guardian_address'])){$rest_api[$z]['guardian_address'] = $data['guardian_address'];}; # text
				if(isset($data['guardian_email'])){$rest_api[$z]['guardian_email'] = $data['guardian_email'];}; # app_email
				if(isset($data['previous_school'])){$rest_api[$z]['previous_school'] = $data['previous_school'];}; # heading-2
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				
				/** date**/
				if($data['updated_at'] != ''){
				$rest_api[$z]['updated_at'] =  mktime( 0,0,0,substr($data['updated_at'],5,2),substr($data['updated_at'],8,2),substr($data['updated_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['updated_at'] = 0; # date
				}
				if(isset($data['resign'])){$rest_api[$z]['resign'] = $data['resign'];}; # number
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : subjects
	case "subjects":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["name"])){
			if($_GET["name"]!="-1"){
				$_where[] = "`name` LIKE '".$mysql->escape_string($_GET["name"])."'";
			}
		}
		if(isset($_GET["type"])){
			if($_GET["type"]!="-1"){
				$_where[] = "`type` LIKE '".$mysql->escape_string($_GET["type"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="name"){
			$order_by = "`name`";
		}
		if($_GET["order"]=="type"){
			$order_by = "`type`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `subjects` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['name'])){$rest_api[$z]['name'] = $data['name'];}; # heading-1
				if(isset($data['type'])){$rest_api[$z]['type'] = $data['type'];}; # heading-1
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : teacherdiary
	case "teacherdiary":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["section_id"])){
			if($_GET["section_id"]!="-1"){
				$_where[] = "`section_id` LIKE '".$mysql->escape_string($_GET["section_id"])."'";
			}
		}
		if(isset($_GET["class_section_id"])){
			if($_GET["class_section_id"]!="-1"){
				$_where[] = "`class_section_id` LIKE '".$mysql->escape_string($_GET["class_section_id"])."'";
			}
		}
		if(isset($_GET["teacher_id"])){
			if($_GET["teacher_id"]!="-1"){
				$_where[] = "`teacher_id` LIKE '".$mysql->escape_string($_GET["teacher_id"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="section_id"){
			$order_by = "`section_id`";
		}
		if($_GET["order"]=="class_section_id"){
			$order_by = "`class_section_id`";
		}
		if($_GET["order"]=="teacher_id"){
			$order_by = "`teacher_id`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `teacherdiary` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['section_id'])){$rest_api[$z]['section_id'] = $data['section_id'];}; # number
				if(isset($data['class_section_id'])){$rest_api[$z]['class_section_id'] = $data['class_section_id'];}; # number
				if(isset($data['teacher_id'])){$rest_api[$z]['teacher_id'] = $data['teacher_id'];}; # number
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : teachers
	case "teachers":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["name"])){
			if($_GET["name"]!="-1"){
				$_where[] = "`name` LIKE '".$mysql->escape_string($_GET["name"])."'";
			}
		}
		if(isset($_GET["nrcno"])){
			if($_GET["nrcno"]!="-1"){
				$_where[] = "`nrcno` LIKE '".$mysql->escape_string($_GET["nrcno"])."'";
			}
		}
		if(isset($_GET["email"])){
			if($_GET["email"]!="-1"){
				$_where[] = "`email` LIKE '".$mysql->escape_string($_GET["email"])."'";
			}
		}
		if(isset($_GET["address"])){
			if($_GET["address"]!="-1"){
				$_where[] = "`address` LIKE '".$mysql->escape_string($_GET["address"])."'";
			}
		}
		if(isset($_GET["dob"])){
			if($_GET["dob"]!="-1"){
				$_where[] = "`dob` LIKE '".$mysql->escape_string($_GET["dob"])."'";
			}
		}
		if(isset($_GET["designation"])){
			if($_GET["designation"]!="-1"){
				$_where[] = "`designation` LIKE '".$mysql->escape_string($_GET["designation"])."'";
			}
		}
		if(isset($_GET["sex"])){
			if($_GET["sex"]!="-1"){
				$_where[] = "`sex` LIKE '".$mysql->escape_string($_GET["sex"])."'";
			}
		}
		if(isset($_GET["phone"])){
			if($_GET["phone"]!="-1"){
				$_where[] = "`phone` LIKE '".$mysql->escape_string($_GET["phone"])."'";
			}
		}
		if(isset($_GET["image"])){
			if($_GET["image"]!="-1"){
				$_where[] = "`image` LIKE '".$mysql->escape_string($_GET["image"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["updated_at"])){
			if($_GET["updated_at"]!="-1"){
				$_where[] = "`updated_at` LIKE '".$mysql->escape_string($_GET["updated_at"])."'";
			}
		}
		if(isset($_GET["raceandreligion"])){
			if($_GET["raceandreligion"]!="-1"){
				$_where[] = "`raceandreligion` LIKE '".$mysql->escape_string($_GET["raceandreligion"])."'";
			}
		}
		if(isset($_GET["spouseName"])){
			if($_GET["spouseName"]!="-1"){
				$_where[] = "`spouseName` LIKE '".$mysql->escape_string($_GET["spouseName"])."'";
			}
		}
		if(isset($_GET["spouseOccupation"])){
			if($_GET["spouseOccupation"]!="-1"){
				$_where[] = "`spouseOccupation` LIKE '".$mysql->escape_string($_GET["spouseOccupation"])."'";
			}
		}
		if(isset($_GET["fathername"])){
			if($_GET["fathername"]!="-1"){
				$_where[] = "`fathername` LIKE '".$mysql->escape_string($_GET["fathername"])."'";
			}
		}
		if(isset($_GET["mothername"])){
			if($_GET["mothername"]!="-1"){
				$_where[] = "`mothername` LIKE '".$mysql->escape_string($_GET["mothername"])."'";
			}
		}
		if(isset($_GET["parentOccupation"])){
			if($_GET["parentOccupation"]!="-1"){
				$_where[] = "`parentOccupation` LIKE '".$mysql->escape_string($_GET["parentOccupation"])."'";
			}
		}
		if(isset($_GET["gender"])){
			if($_GET["gender"]!="-1"){
				$_where[] = "`gender` LIKE '".$mysql->escape_string($_GET["gender"])."'";
			}
		}
		if(isset($_GET["position"])){
			if($_GET["position"]!="-1"){
				$_where[] = "`position` LIKE '".$mysql->escape_string($_GET["position"])."'";
			}
		}
		if(isset($_GET["education"])){
			if($_GET["education"]!="-1"){
				$_where[] = "`education` LIKE '".$mysql->escape_string($_GET["education"])."'";
			}
		}
		if(isset($_GET["salary"])){
			if($_GET["salary"]!="-1"){
				$_where[] = "`salary` LIKE '".$mysql->escape_string($_GET["salary"])."'";
			}
		}
		if(isset($_GET["currency"])){
			if($_GET["currency"]!="-1"){
				$_where[] = "`currency` LIKE '".$mysql->escape_string($_GET["currency"])."'";
			}
		}
		if(isset($_GET["primarySubject"])){
			if($_GET["primarySubject"]!="-1"){
				$_where[] = "`primarySubject` LIKE '".$mysql->escape_string($_GET["primarySubject"])."'";
			}
		}
		if(isset($_GET["entryDate"])){
			if($_GET["entryDate"]!="-1"){
				$_where[] = "`entryDate` LIKE '".$mysql->escape_string($_GET["entryDate"])."'";
			}
		}
		if(isset($_GET["transferedSchool"])){
			if($_GET["transferedSchool"]!="-1"){
				$_where[] = "`transferedSchool` LIKE '".$mysql->escape_string($_GET["transferedSchool"])."'";
			}
		}
		if(isset($_GET["educationDepartment"])){
			if($_GET["educationDepartment"]!="-1"){
				$_where[] = "`educationDepartment` LIKE '".$mysql->escape_string($_GET["educationDepartment"])."'";
			}
		}
		if(isset($_GET["startDateofTeaching"])){
			if($_GET["startDateofTeaching"]!="-1"){
				$_where[] = "`startDateofTeaching` LIKE '".$mysql->escape_string($_GET["startDateofTeaching"])."'";
			}
		}
		if(isset($_GET["currentsubject"])){
			if($_GET["currentsubject"]!="-1"){
				$_where[] = "`currentsubject` LIKE '".$mysql->escape_string($_GET["currentsubject"])."'";
			}
		}
		if(isset($_GET["responsibility"])){
			if($_GET["responsibility"]!="-1"){
				$_where[] = "`responsibility` LIKE '".$mysql->escape_string($_GET["responsibility"])."'";
			}
		}
		if(isset($_GET["attendedclass"])){
			if($_GET["attendedclass"]!="-1"){
				$_where[] = "`attendedclass` LIKE '".$mysql->escape_string($_GET["attendedclass"])."'";
			}
		}
		if(isset($_GET["location"])){
			if($_GET["location"]!="-1"){
				$_where[] = "`location` LIKE '".$mysql->escape_string($_GET["location"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="name"){
			$order_by = "`name`";
		}
		if($_GET["order"]=="nrcno"){
			$order_by = "`nrcno`";
		}
		if($_GET["order"]=="email"){
			$order_by = "`email`";
		}
		if($_GET["order"]=="address"){
			$order_by = "`address`";
		}
		if($_GET["order"]=="dob"){
			$order_by = "`dob`";
		}
		if($_GET["order"]=="designation"){
			$order_by = "`designation`";
		}
		if($_GET["order"]=="sex"){
			$order_by = "`sex`";
		}
		if($_GET["order"]=="phone"){
			$order_by = "`phone`";
		}
		if($_GET["order"]=="image"){
			$order_by = "`image`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="updated_at"){
			$order_by = "`updated_at`";
		}
		if($_GET["order"]=="raceandreligion"){
			$order_by = "`raceandreligion`";
		}
		if($_GET["order"]=="spouseName"){
			$order_by = "`spouseName`";
		}
		if($_GET["order"]=="spouseOccupation"){
			$order_by = "`spouseOccupation`";
		}
		if($_GET["order"]=="fathername"){
			$order_by = "`fathername`";
		}
		if($_GET["order"]=="mothername"){
			$order_by = "`mothername`";
		}
		if($_GET["order"]=="parentOccupation"){
			$order_by = "`parentOccupation`";
		}
		if($_GET["order"]=="gender"){
			$order_by = "`gender`";
		}
		if($_GET["order"]=="position"){
			$order_by = "`position`";
		}
		if($_GET["order"]=="education"){
			$order_by = "`education`";
		}
		if($_GET["order"]=="salary"){
			$order_by = "`salary`";
		}
		if($_GET["order"]=="currency"){
			$order_by = "`currency`";
		}
		if($_GET["order"]=="primarySubject"){
			$order_by = "`primarySubject`";
		}
		if($_GET["order"]=="entryDate"){
			$order_by = "`entryDate`";
		}
		if($_GET["order"]=="transferedSchool"){
			$order_by = "`transferedSchool`";
		}
		if($_GET["order"]=="educationDepartment"){
			$order_by = "`educationDepartment`";
		}
		if($_GET["order"]=="startDateofTeaching"){
			$order_by = "`startDateofTeaching`";
		}
		if($_GET["order"]=="currentsubject"){
			$order_by = "`currentsubject`";
		}
		if($_GET["order"]=="responsibility"){
			$order_by = "`responsibility`";
		}
		if($_GET["order"]=="attendedclass"){
			$order_by = "`attendedclass`";
		}
		if($_GET["order"]=="location"){
			$order_by = "`location`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `teachers` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['name'])){$rest_api[$z]['name'] = $data['name'];}; # heading-1
				if(isset($data['nrcno'])){$rest_api[$z]['nrcno'] = $data['nrcno'];}; # heading-2
				if(isset($data['email'])){$rest_api[$z]['email'] = $data['email'];}; # app_email
				if(isset($data['address'])){$rest_api[$z]['address'] = $data['address'];}; # paragraph
				
				/** date**/
				if($data['dob'] != ''){
				$rest_api[$z]['dob'] =  mktime( 0,0,0,substr($data['dob'],5,2),substr($data['dob'],8,2),substr($data['dob'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['dob'] = 0; # date
				}
				if(isset($data['designation'])){$rest_api[$z]['designation'] = $data['designation'];}; # text
				if(isset($data['sex'])){$rest_api[$z]['sex'] = $data['sex'];}; # heading-2
				if(isset($data['phone'])){$rest_api[$z]['phone'] = $data['phone'];}; # text
				
				/** images**/
				$abs_url_images = $config['abs_url_images'].'/';
				$abs_url_videos = $config['abs_url_videos'].'/';
				$abs_url_audios = $config['abs_url_audios'].'/';
				if(!isset($data['image'])){$data['image']='undefined';}; # images
				if((substr($data['image'], 0, 7)=='http://')||(substr($data['image'], 0, 8)=='https://')){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if(substr($data['image'], 0, 5)=='data:'){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if($data['image'] != ''){
					$rest_api[$z]['image'] = $abs_url_images . $data['image']; # images
				}else{
					$rest_api[$z]['image'] = ''; # images
				}
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				
				/** date**/
				if($data['updated_at'] != ''){
				$rest_api[$z]['updated_at'] =  mktime( 0,0,0,substr($data['updated_at'],5,2),substr($data['updated_at'],8,2),substr($data['updated_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['updated_at'] = 0; # date
				}
				if(isset($data['raceandreligion'])){$rest_api[$z]['raceandreligion'] = $data['raceandreligion'];}; # heading-2
				if(isset($data['spouseName'])){$rest_api[$z]['spouseName'] = $data['spouseName'];}; # heading-2
				if(isset($data['spouseOccupation'])){$rest_api[$z]['spouseOccupation'] = $data['spouseOccupation'];}; # heading-2
				if(isset($data['fathername'])){$rest_api[$z]['fathername'] = $data['fathername'];}; # heading-2
				if(isset($data['mothername'])){$rest_api[$z]['mothername'] = $data['mothername'];}; # heading-2
				if(isset($data['parentOccupation'])){$rest_api[$z]['parentOccupation'] = $data['parentOccupation'];}; # heading-2
				if(isset($data['gender'])){$rest_api[$z]['gender'] = $data['gender'];}; # heading-2
				if(isset($data['position'])){$rest_api[$z]['position'] = $data['position'];}; # heading-2
				if(isset($data['education'])){$rest_api[$z]['education'] = $data['education'];}; # text
				if(isset($data['salary'])){$rest_api[$z]['salary'] = $data['salary'];}; # number
				if(isset($data['currency'])){$rest_api[$z]['currency'] = $data['currency'];}; # heading-2
				if(isset($data['primarySubject'])){$rest_api[$z]['primarySubject'] = $data['primarySubject'];}; # heading-2
				
				/** date**/
				if($data['entryDate'] != ''){
				$rest_api[$z]['entryDate'] =  mktime( 0,0,0,substr($data['entryDate'],5,2),substr($data['entryDate'],8,2),substr($data['entryDate'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['entryDate'] = 0; # date
				}
				if(isset($data['transferedSchool'])){$rest_api[$z]['transferedSchool'] = $data['transferedSchool'];}; # text
				if(isset($data['educationDepartment'])){$rest_api[$z]['educationDepartment'] = $data['educationDepartment'];}; # text
				
				/** date**/
				if($data['startDateofTeaching'] != ''){
				$rest_api[$z]['startDateofTeaching'] =  mktime( 0,0,0,substr($data['startDateofTeaching'],5,2),substr($data['startDateofTeaching'],8,2),substr($data['startDateofTeaching'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['startDateofTeaching'] = 0; # date
				}
				if(isset($data['currentsubject'])){$rest_api[$z]['currentsubject'] = $data['currentsubject'];}; # text
				if(isset($data['responsibility'])){$rest_api[$z]['responsibility'] = $data['responsibility'];}; # text
				if(isset($data['attendedclass'])){$rest_api[$z]['attendedclass'] = $data['attendedclass'];}; # text
				if(isset($data['location'])){$rest_api[$z]['location'] = $data['location'];}; # number
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : teachingnote
	case "teachingnote":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["section_id"])){
			if($_GET["section_id"]!="-1"){
				$_where[] = "`section_id` LIKE '".$mysql->escape_string($_GET["section_id"])."'";
			}
		}
		if(isset($_GET["class_section_id"])){
			if($_GET["class_section_id"]!="-1"){
				$_where[] = "`class_section_id` LIKE '".$mysql->escape_string($_GET["class_section_id"])."'";
			}
		}
		if(isset($_GET["teacher_id"])){
			if($_GET["teacher_id"]!="-1"){
				$_where[] = "`teacher_id` LIKE '".$mysql->escape_string($_GET["teacher_id"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["lessontitle"])){
			if($_GET["lessontitle"]!="-1"){
				$_where[] = "`lessontitle` LIKE '".$mysql->escape_string($_GET["lessontitle"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="section_id"){
			$order_by = "`section_id`";
		}
		if($_GET["order"]=="class_section_id"){
			$order_by = "`class_section_id`";
		}
		if($_GET["order"]=="teacher_id"){
			$order_by = "`teacher_id`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="lessontitle"){
			$order_by = "`lessontitle`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `teachingnote` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['section_id'])){$rest_api[$z]['section_id'] = $data['section_id'];}; # number
				if(isset($data['class_section_id'])){$rest_api[$z]['class_section_id'] = $data['class_section_id'];}; # number
				if(isset($data['teacher_id'])){$rest_api[$z]['teacher_id'] = $data['teacher_id'];}; # number
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				if(isset($data['lessontitle'])){$rest_api[$z]['lessontitle'] = $data['lessontitle'];}; # to_trusted
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : timetables
	case "timetables":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["teacher_subject_id"])){
			if($_GET["teacher_subject_id"]!="-1"){
				$_where[] = "`teacher_subject_id` LIKE '".$mysql->escape_string($_GET["teacher_subject_id"])."'";
			}
		}
		if(isset($_GET["day_name"])){
			if($_GET["day_name"]!="-1"){
				$_where[] = "`day_name` LIKE '".$mysql->escape_string($_GET["day_name"])."'";
			}
		}
		if(isset($_GET["start_time"])){
			if($_GET["start_time"]!="-1"){
				$_where[] = "`start_time` LIKE '".$mysql->escape_string($_GET["start_time"])."'";
			}
		}
		if(isset($_GET["end_time"])){
			if($_GET["end_time"]!="-1"){
				$_where[] = "`end_time` LIKE '".$mysql->escape_string($_GET["end_time"])."'";
			}
		}
		if(isset($_GET["room_no"])){
			if($_GET["room_no"]!="-1"){
				$_where[] = "`room_no` LIKE '".$mysql->escape_string($_GET["room_no"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="teacher_subject_id"){
			$order_by = "`teacher_subject_id`";
		}
		if($_GET["order"]=="day_name"){
			$order_by = "`day_name`";
		}
		if($_GET["order"]=="start_time"){
			$order_by = "`start_time`";
		}
		if($_GET["order"]=="end_time"){
			$order_by = "`end_time`";
		}
		if($_GET["order"]=="room_no"){
			$order_by = "`room_no`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `timetables` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['teacher_subject_id'])){$rest_api[$z]['teacher_subject_id'] = $data['teacher_subject_id'];}; # text
				if(isset($data['day_name'])){$rest_api[$z]['day_name'] = $data['day_name'];}; # text
				if(isset($data['start_time'])){$rest_api[$z]['start_time'] = $data['start_time'];}; # text
				if(isset($data['end_time'])){$rest_api[$z]['end_time'] = $data['end_time'];}; # text
				if(isset($data['room_no'])){$rest_api[$z]['room_no'] = $data['room_no'];}; # text
				
				/** datetime**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime(substr($data['created_at'],11,2),substr($data['created_at'],14,2),substr($data['created_at'],17,2),substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # datetime
				}else{
					$rest_api[$z]['created_at'] = 0; # datetime
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : transport_route
	case "transport_route":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["route_title"])){
			if($_GET["route_title"]!="-1"){
				$_where[] = "`route_title` LIKE '".$mysql->escape_string($_GET["route_title"])."'";
			}
		}
		if(isset($_GET["no_of_vehicle"])){
			if($_GET["no_of_vehicle"]!="-1"){
				$_where[] = "`no_of_vehicle` LIKE '".$mysql->escape_string($_GET["no_of_vehicle"])."'";
			}
		}
		if(isset($_GET["fare"])){
			if($_GET["fare"]!="-1"){
				$_where[] = "`fare` LIKE '".$mysql->escape_string($_GET["fare"])."'";
			}
		}
		if(isset($_GET["note"])){
			if($_GET["note"]!="-1"){
				$_where[] = "`note` LIKE '".$mysql->escape_string($_GET["note"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="route_title"){
			$order_by = "`route_title`";
		}
		if($_GET["order"]=="no_of_vehicle"){
			$order_by = "`no_of_vehicle`";
		}
		if($_GET["order"]=="fare"){
			$order_by = "`fare`";
		}
		if($_GET["order"]=="note"){
			$order_by = "`note`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `transport_route` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['route_title'])){$rest_api[$z]['route_title'] = $data['route_title'];}; # text
				if(isset($data['no_of_vehicle'])){$rest_api[$z]['no_of_vehicle'] = $data['no_of_vehicle'];}; # number
				if(isset($data['fare'])){$rest_api[$z]['fare'] = $data['fare'];}; # number
				if(isset($data['note'])){$rest_api[$z]['note'] = $data['note'];}; # paragraph
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : users
	case "users":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["user_id"])){
			if($_GET["user_id"]!="-1"){
				$_where[] = "`user_id` LIKE '".$mysql->escape_string($_GET["user_id"])."'";
			}
		}
		if(isset($_GET["username"])){
			if($_GET["username"]!="-1"){
				$_where[] = "`username` LIKE '".$mysql->escape_string($_GET["username"])."'";
			}
		}
		if(isset($_GET["password"])){
			if($_GET["password"]!="-1"){
				$_where[] = "`password` LIKE '".$mysql->escape_string($_GET["password"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="user_id"){
			$order_by = "`user_id`";
		}
		if($_GET["order"]=="username"){
			$order_by = "`username`";
		}
		if($_GET["order"]=="password"){
			$order_by = "`password`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `users` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['user_id'])){$rest_api[$z]['user_id'] = $data['user_id'];}; # number
				
				/** as_username**/
				
				/** as_password**/
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	
	// TODO: -+- Listing : weeklypreparation
	case "weeklypreparation":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["section_id"])){
			if($_GET["section_id"]!="-1"){
				$_where[] = "`section_id` LIKE '".$mysql->escape_string($_GET["section_id"])."'";
			}
		}
		if(isset($_GET["class_section_id"])){
			if($_GET["class_section_id"]!="-1"){
				$_where[] = "`class_section_id` LIKE '".$mysql->escape_string($_GET["class_section_id"])."'";
			}
		}
		if(isset($_GET["teacher_id"])){
			if($_GET["teacher_id"]!="-1"){
				$_where[] = "`teacher_id` LIKE '".$mysql->escape_string($_GET["teacher_id"])."'";
			}
		}
		if(isset($_GET["created_at"])){
			if($_GET["created_at"]!="-1"){
				$_where[] = "`created_at` LIKE '".$mysql->escape_string($_GET["created_at"])."'";
			}
		}
		if(isset($_GET["date_from"])){
			if($_GET["date_from"]!="-1"){
				$_where[] = "`date_from` LIKE '".$mysql->escape_string($_GET["date_from"])."'";
			}
		}
		if(isset($_GET["date_to"])){
			if($_GET["date_to"]!="-1"){
				$_where[] = "`date_to` LIKE '".$mysql->escape_string($_GET["date_to"])."'";
			}
		}
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` = '".$mysql->escape_string($_GET["id"])."'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="section_id"){
			$order_by = "`section_id`";
		}
		if($_GET["order"]=="class_section_id"){
			$order_by = "`class_section_id`";
		}
		if($_GET["order"]=="teacher_id"){
			$order_by = "`teacher_id`";
		}
		if($_GET["order"]=="created_at"){
			$order_by = "`created_at`";
		}
		if($_GET["order"]=="date_from"){
			$order_by = "`date_from`";
		}
		if($_GET["order"]=="date_to"){
			$order_by = "`date_to`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		$limit = 100;
		if(isset($_GET["limit"])){
			$limit = (int)$_GET["limit"] ;
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `weeklypreparation` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, ".$limit." " ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['section_id'])){$rest_api[$z]['section_id'] = $data['section_id'];}; # number
				if(isset($data['class_section_id'])){$rest_api[$z]['class_section_id'] = $data['class_section_id'];}; # number
				if(isset($data['teacher_id'])){$rest_api[$z]['teacher_id'] = $data['teacher_id'];}; # number
				
				/** date**/
				if($data['created_at'] != ''){
				$rest_api[$z]['created_at'] =  mktime( 0,0,0,substr($data['created_at'],5,2),substr($data['created_at'],8,2),substr($data['created_at'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['created_at'] = 0; # date
				}
				
				/** date**/
				if($data['date_from'] != ''){
				$rest_api[$z]['date_from'] =  mktime( 0,0,0,substr($data['date_from'],5,2),substr($data['date_from'],8,2),substr($data['date_from'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['date_from'] = 0; # date
				}
				
				/** date**/
				if($data['date_to'] != ''){
				$rest_api[$z]['date_to'] =  mktime( 0,0,0,substr($data['date_to'],5,2),substr($data['date_to'],8,2),substr($data['date_to'],0,4)) * 1000; # date
				}else{
					$rest_api[$z]['date_to'] = 0; # date
				}
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}else{
					$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
				}
			}
		}

		break;
	// TODO: -+- Authorization
	case "auth":
		// TODO: -+----+- Auth User
		
		$is_user = false;
		if(isset($_SERVER["PHP_AUTH_USER"])){
			$php_auth_user = $mysql->escape_string($_SERVER["PHP_AUTH_USER"]);
			$php_auth_pw = $mysql->escape_string($_SERVER["PHP_AUTH_PW"]);
			$auth_sql = "SELECT * FROM `users` WHERE `username` = '$php_auth_user' AND `password` = '$php_auth_pw'";
			if($result = $mysql->query($auth_sql)){
				$current_user = $result->fetch_array();
				if(isset($current_user["username"])){
					$is_user = true;
				}
			}
			if($is_user === true){
				$rest_api=array("data"=>array("status"=>200,"error"=>"Successfully"),"title"=>"Successfully","message"=>"Successfully");
			}else{
				$rest_api=array("data"=>array("status"=>401,"error"=>"Unauthorized"),"title"=>"Failed","message"=>"Username or password is incorrect, please try again.");
			}
		}else{
			$rest_api=array("data"=>array("status"=>401,"error"=>"Unauthorized"),"title"=>"Unauthorized","message"=>"Sorry, you cannot see list resources.");
			break;
		}

		break;
	// TODO: -+- me
	case "me":
		// TODO: -+----+- Auth User
		$is_user = false;
		if(isset($_SERVER["PHP_AUTH_USER"])){
			$php_auth_user = $mysql->escape_string($_SERVER["PHP_AUTH_USER"]);
			$php_auth_pw = $mysql->escape_string($_SERVER["PHP_AUTH_PW"]);
			$auth_sql = "SELECT * FROM `users` WHERE `username` = '$php_auth_user' AND `password` = '$php_auth_pw'";
			if($result = $mysql->query($auth_sql)){
				$current_user = $result->fetch_array();
				if(isset($current_user["username"])){
					$is_user = true;
				}
			}
			if($is_user == true){
				$rest_api["data"]["status"]=200;
				$rest_api["me"]["id"]= $current_user["id"];
				$rest_api["me"]["user_id"]= $current_user["user_id"];
				$rest_api["me"]["username"]= $current_user["username"];
			}else{
				$rest_api=array("data"=>array("status"=>401,"error"=>"Unauthorized"),"title"=>"Failed","message"=>"Username or password is incorrect, please try again.");
			}
		}else{
			$rest_api=array("data"=>array("status"=>401,"error"=>"Unauthorized"),"title"=>"Unauthorized","message"=>"Sorry, you cannot see list resources.");
			break;
		}

		break;
	// TODO: -+- route
	case "route":		$rest_api=array();
		$rest_api["site"]["name"] = "Essential SMS" ;
		$rest_api["site"]["description"] = " Essential SMS Software  Private School, International School        Main Functions  - Courses  Batches- Student Attendance- Multiple Dashboards- Timetable Management- Examination- Student Admission- SchoolEvent Calendar- Fees Management- EmployeeTeacher Login- StudentParent login- Internal Messaging system- SMS Alerts- Email Integration- HostelDormitory Management- Library Module- Transport Module" ;
		$rest_api["site"]["imabuilder"] = "rev18.09.15" ;

		$rest_api["routes"][0]["namespace"] = "books";
		$rest_api["routes"][0]["tb_version"] = "Upd.1810040439";
		$rest_api["routes"][0]["methods"][] = "GET";
		$rest_api["routes"][0]["args"]["id"] = array("required"=>"false","description"=>"Selecting `books` based `id`");
		$rest_api["routes"][0]["args"]["book_title"] = array("required"=>"false","description"=>"Selecting `books` based `book_title`");
		$rest_api["routes"][0]["args"]["book_no"] = array("required"=>"false","description"=>"Selecting `books` based `book_no`");
		$rest_api["routes"][0]["args"]["publish"] = array("required"=>"false","description"=>"Selecting `books` based `publish`");
		$rest_api["routes"][0]["args"]["author"] = array("required"=>"false","description"=>"Selecting `books` based `author`");
		$rest_api["routes"][0]["args"]["subject"] = array("required"=>"false","description"=>"Selecting `books` based `subject`");
		$rest_api["routes"][0]["args"]["postdate"] = array("required"=>"false","description"=>"Selecting `books` based `postdate`");
		$rest_api["routes"][0]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `book_title`, `book_no`, `publish`, `author`, `subject`, `postdate`");
		$rest_api["routes"][0]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][0]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][0]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=books";
		$rest_api["routes"][1]["namespace"] = "dailyrecord";
		$rest_api["routes"][1]["tb_version"] = "Upd.1810171125";
		$rest_api["routes"][1]["methods"][] = "GET";
		$rest_api["routes"][1]["args"]["id"] = array("required"=>"false","description"=>"Selecting `dailyrecord` based `id`");
		$rest_api["routes"][1]["args"]["section_id"] = array("required"=>"false","description"=>"Selecting `dailyrecord` based `section_id`");
		$rest_api["routes"][1]["args"]["class_section_id"] = array("required"=>"false","description"=>"Selecting `dailyrecord` based `class_section_id`");
		$rest_api["routes"][1]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `dailyrecord` based `created_at`");
		$rest_api["routes"][1]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `section_id`, `class_section_id`, `created_at`");
		$rest_api["routes"][1]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][1]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][1]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=dailyrecord";
		$rest_api["routes"][2]["namespace"] = "event";
		$rest_api["routes"][2]["tb_version"] = "Upd.1810121147";
		$rest_api["routes"][2]["methods"][] = "GET";
		$rest_api["routes"][2]["args"]["id"] = array("required"=>"false","description"=>"Selecting `event` based `id`");
		$rest_api["routes"][2]["args"]["title"] = array("required"=>"false","description"=>"Selecting `event` based `title`");
		$rest_api["routes"][2]["args"]["short_line"] = array("required"=>"false","description"=>"Selecting `event` based `short_line`");
		$rest_api["routes"][2]["args"]["description"] = array("required"=>"false","description"=>"Selecting `event` based `description`");
		$rest_api["routes"][2]["args"]["image"] = array("required"=>"false","description"=>"Selecting `event` based `image`");
		$rest_api["routes"][2]["args"]["date"] = array("required"=>"false","description"=>"Selecting `event` based `date`");
		$rest_api["routes"][2]["args"]["venue"] = array("required"=>"false","description"=>"Selecting `event` based `venue`");
		$rest_api["routes"][2]["args"]["language"] = array("required"=>"false","description"=>"Selecting `event` based `language`");
		$rest_api["routes"][2]["args"]["remark"] = array("required"=>"false","description"=>"Selecting `event` based `remark`");
		$rest_api["routes"][2]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `title`, `short_line`, `description`, `image`, `date`, `venue`, `language`, `remark`");
		$rest_api["routes"][2]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][2]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][2]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=event";
		$rest_api["routes"][3]["namespace"] = "exam_results";
		$rest_api["routes"][3]["tb_version"] = "Upd.1810120113";
		$rest_api["routes"][3]["methods"][] = "GET";
		$rest_api["routes"][3]["args"]["id"] = array("required"=>"false","description"=>"Selecting `exam_results` based `id`");
		$rest_api["routes"][3]["args"]["attendence"] = array("required"=>"false","description"=>"Selecting `exam_results` based `attendence`");
		$rest_api["routes"][3]["args"]["_exam_schedule_id"] = array("required"=>"false","description"=>"Selecting `exam_results` based `_exam_schedule_id`");
		$rest_api["routes"][3]["args"]["student_id"] = array("required"=>"false","description"=>"Selecting `exam_results` based `student_id`");
		$rest_api["routes"][3]["args"]["get_marks"] = array("required"=>"false","description"=>"Selecting `exam_results` based `get_marks`");
		$rest_api["routes"][3]["args"]["note"] = array("required"=>"false","description"=>"Selecting `exam_results` based `note`");
		$rest_api["routes"][3]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `exam_results` based `created_at`");
		$rest_api["routes"][3]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `attendence`, `_exam_schedule_id`, `student_id`, `get_marks`, `note`, `created_at`");
		$rest_api["routes"][3]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][3]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][3]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=exam_results";
		$rest_api["routes"][4]["namespace"] = "exam_schedules";
		$rest_api["routes"][4]["tb_version"] = "Upd.1810040440";
		$rest_api["routes"][4]["methods"][] = "GET";
		$rest_api["routes"][4]["args"]["id"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `id`");
		$rest_api["routes"][4]["args"]["exam_id"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `exam_id`");
		$rest_api["routes"][4]["args"]["teacher_subject_id"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `teacher_subject_id`");
		$rest_api["routes"][4]["args"]["date_of_exam"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `date_of_exam`");
		$rest_api["routes"][4]["args"]["start_to"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `start_to`");
		$rest_api["routes"][4]["args"]["end_from"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `end_from`");
		$rest_api["routes"][4]["args"]["passing_marks"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `passing_marks`");
		$rest_api["routes"][4]["args"]["full_marks"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `full_marks`");
		$rest_api["routes"][4]["args"]["room_no"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `room_no`");
		$rest_api["routes"][4]["args"]["note"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `note`");
		$rest_api["routes"][4]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `exam_schedules` based `created_at`");
		$rest_api["routes"][4]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `exam_id`, `teacher_subject_id`, `date_of_exam`, `start_to`, `end_from`, `passing_marks`, `full_marks`, `room_no`, `note`, `created_at`");
		$rest_api["routes"][4]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][4]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][4]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=exam_schedules";
		$rest_api["routes"][5]["namespace"] = "fee_collection";
		$rest_api["routes"][5]["tb_version"] = "Upd.1810080135";
		$rest_api["routes"][5]["methods"][] = "GET";
		$rest_api["routes"][5]["args"]["id"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `id`");
		$rest_api["routes"][5]["args"]["student_id"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `student_id`");
		$rest_api["routes"][5]["args"]["total_amount"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `total_amount`");
		$rest_api["routes"][5]["args"]["total_received"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `total_received`");
		$rest_api["routes"][5]["args"]["payment_for"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `payment_for`");
		$rest_api["routes"][5]["args"]["payment_mode"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `payment_mode`");
		$rest_api["routes"][5]["args"]["paydate"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `paydate`");
		$rest_api["routes"][5]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `fee_collection` based `created_at`");
		$rest_api["routes"][5]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `student_id`, `total_amount`, `total_received`, `payment_for`, `payment_mode`, `paydate`, `created_at`");
		$rest_api["routes"][5]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][5]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][5]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=fee_collection";
		$rest_api["routes"][6]["namespace"] = "feedback";
		$rest_api["routes"][6]["tb_version"] = "Upd.1810120122";
		$rest_api["routes"][6]["methods"][] = "GET";
		$rest_api["routes"][6]["args"]["id"] = array("required"=>"false","description"=>"Selecting `feedback` based `id`");
		$rest_api["routes"][6]["args"]["subject"] = array("required"=>"false","description"=>"Selecting `feedback` based `subject`");
		$rest_api["routes"][6]["args"]["phone"] = array("required"=>"false","description"=>"Selecting `feedback` based `phone`");
		$rest_api["routes"][6]["args"]["message"] = array("required"=>"false","description"=>"Selecting `feedback` based `message`");
		$rest_api["routes"][6]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `subject`, `phone`, `message`");
		$rest_api["routes"][6]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][6]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][6]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=feedback";
		$rest_api["routes"][7]["namespace"] = "send_notification";
		$rest_api["routes"][7]["tb_version"] = "Upd.1810040442";
		$rest_api["routes"][7]["methods"][] = "GET";
		$rest_api["routes"][7]["args"]["id"] = array("required"=>"false","description"=>"Selecting `send_notification` based `id`");
		$rest_api["routes"][7]["args"]["title"] = array("required"=>"false","description"=>"Selecting `send_notification` based `title`");
		$rest_api["routes"][7]["args"]["publish_date"] = array("required"=>"false","description"=>"Selecting `send_notification` based `publish_date`");
		$rest_api["routes"][7]["args"]["message"] = array("required"=>"false","description"=>"Selecting `send_notification` based `message`");
		$rest_api["routes"][7]["args"]["created_by"] = array("required"=>"false","description"=>"Selecting `send_notification` based `created_by`");
		$rest_api["routes"][7]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `send_notification` based `created_at`");
		$rest_api["routes"][7]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `title`, `publish_date`, `message`, `created_by`, `created_at`");
		$rest_api["routes"][7]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][7]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][7]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=send_notification";
		$rest_api["routes"][8]["namespace"] = "student_attendences";
		$rest_api["routes"][8]["tb_version"] = "Upd.1810040442";
		$rest_api["routes"][8]["methods"][] = "GET";
		$rest_api["routes"][8]["args"]["id"] = array("required"=>"false","description"=>"Selecting `student_attendences` based `id`");
		$rest_api["routes"][8]["args"]["student_id"] = array("required"=>"false","description"=>"Selecting `student_attendences` based `student_id`");
		$rest_api["routes"][8]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `student_attendences` based `created_at`");
		$rest_api["routes"][8]["args"]["in_time"] = array("required"=>"false","description"=>"Selecting `student_attendences` based `in_time`");
		$rest_api["routes"][8]["args"]["out_time"] = array("required"=>"false","description"=>"Selecting `student_attendences` based `out_time`");
		$rest_api["routes"][8]["args"]["attendence_type_id"] = array("required"=>"false","description"=>"Selecting `student_attendences` based `attendence_type_id`");
		$rest_api["routes"][8]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `student_id`, `created_at`, `in_time`, `out_time`, `attendence_type_id`");
		$rest_api["routes"][8]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][8]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][8]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=student_attendences";
		$rest_api["routes"][9]["namespace"] = "students";
		$rest_api["routes"][9]["tb_version"] = "Upd.1810040443";
		$rest_api["routes"][9]["methods"][] = "GET";
		$rest_api["routes"][9]["args"]["id"] = array("required"=>"false","description"=>"Selecting `students` based `id`");
		$rest_api["routes"][9]["args"]["admission_no"] = array("required"=>"false","description"=>"Selecting `students` based `admission_no`");
		$rest_api["routes"][9]["args"]["roll_no"] = array("required"=>"false","description"=>"Selecting `students` based `roll_no`");
		$rest_api["routes"][9]["args"]["admission_date"] = array("required"=>"false","description"=>"Selecting `students` based `admission_date`");
		$rest_api["routes"][9]["args"]["firstname"] = array("required"=>"false","description"=>"Selecting `students` based `firstname`");
		$rest_api["routes"][9]["args"]["lastname"] = array("required"=>"false","description"=>"Selecting `students` based `lastname`");
		$rest_api["routes"][9]["args"]["image"] = array("required"=>"false","description"=>"Selecting `students` based `image`");
		$rest_api["routes"][9]["args"]["mobileno"] = array("required"=>"false","description"=>"Selecting `students` based `mobileno`");
		$rest_api["routes"][9]["args"]["email"] = array("required"=>"false","description"=>"Selecting `students` based `email`");
		$rest_api["routes"][9]["args"]["state"] = array("required"=>"false","description"=>"Selecting `students` based `state`");
		$rest_api["routes"][9]["args"]["city"] = array("required"=>"false","description"=>"Selecting `students` based `city`");
		$rest_api["routes"][9]["args"]["religion"] = array("required"=>"false","description"=>"Selecting `students` based `religion`");
		$rest_api["routes"][9]["args"]["dob"] = array("required"=>"false","description"=>"Selecting `students` based `dob`");
		$rest_api["routes"][9]["args"]["gender"] = array("required"=>"false","description"=>"Selecting `students` based `gender`");
		$rest_api["routes"][9]["args"]["current_address"] = array("required"=>"false","description"=>"Selecting `students` based `current_address`");
		$rest_api["routes"][9]["args"]["permanent_address"] = array("required"=>"false","description"=>"Selecting `students` based `permanent_address`");
		$rest_api["routes"][9]["args"]["category_id"] = array("required"=>"false","description"=>"Selecting `students` based `category_id`");
		$rest_api["routes"][9]["args"]["adhar_no"] = array("required"=>"false","description"=>"Selecting `students` based `adhar_no`");
		$rest_api["routes"][9]["args"]["samagra_id"] = array("required"=>"false","description"=>"Selecting `students` based `samagra_id`");
		$rest_api["routes"][9]["args"]["bank_account_no"] = array("required"=>"false","description"=>"Selecting `students` based `bank_account_no`");
		$rest_api["routes"][9]["args"]["bank_name"] = array("required"=>"false","description"=>"Selecting `students` based `bank_name`");
		$rest_api["routes"][9]["args"]["ifsc_code"] = array("required"=>"false","description"=>"Selecting `students` based `ifsc_code`");
		$rest_api["routes"][9]["args"]["guardian_is"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_is`");
		$rest_api["routes"][9]["args"]["father_name"] = array("required"=>"false","description"=>"Selecting `students` based `father_name`");
		$rest_api["routes"][9]["args"]["father_phone"] = array("required"=>"false","description"=>"Selecting `students` based `father_phone`");
		$rest_api["routes"][9]["args"]["father_occupation"] = array("required"=>"false","description"=>"Selecting `students` based `father_occupation`");
		$rest_api["routes"][9]["args"]["mother_name"] = array("required"=>"false","description"=>"Selecting `students` based `mother_name`");
		$rest_api["routes"][9]["args"]["mother_phone"] = array("required"=>"false","description"=>"Selecting `students` based `mother_phone`");
		$rest_api["routes"][9]["args"]["mother_occupation"] = array("required"=>"false","description"=>"Selecting `students` based `mother_occupation`");
		$rest_api["routes"][9]["args"]["guardian_name"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_name`");
		$rest_api["routes"][9]["args"]["guardian_relation"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_relation`");
		$rest_api["routes"][9]["args"]["guardian_phone"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_phone`");
		$rest_api["routes"][9]["args"]["guardian_occupation"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_occupation`");
		$rest_api["routes"][9]["args"]["guardian_address"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_address`");
		$rest_api["routes"][9]["args"]["guardian_email"] = array("required"=>"false","description"=>"Selecting `students` based `guardian_email`");
		$rest_api["routes"][9]["args"]["previous_school"] = array("required"=>"false","description"=>"Selecting `students` based `previous_school`");
		$rest_api["routes"][9]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `students` based `created_at`");
		$rest_api["routes"][9]["args"]["updated_at"] = array("required"=>"false","description"=>"Selecting `students` based `updated_at`");
		$rest_api["routes"][9]["args"]["resign"] = array("required"=>"false","description"=>"Selecting `students` based `resign`");
		$rest_api["routes"][9]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `image`, `mobileno`, `email`, `state`, `city`, `religion`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `guardian_email`, `previous_school`, `created_at`, `updated_at`, `resign`");
		$rest_api["routes"][9]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][9]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][9]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=students";
		$rest_api["routes"][10]["namespace"] = "subjects";
		$rest_api["routes"][10]["tb_version"] = "Upd.1810040443";
		$rest_api["routes"][10]["methods"][] = "GET";
		$rest_api["routes"][10]["args"]["id"] = array("required"=>"false","description"=>"Selecting `subjects` based `id`");
		$rest_api["routes"][10]["args"]["name"] = array("required"=>"false","description"=>"Selecting `subjects` based `name`");
		$rest_api["routes"][10]["args"]["type"] = array("required"=>"false","description"=>"Selecting `subjects` based `type`");
		$rest_api["routes"][10]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `subjects` based `created_at`");
		$rest_api["routes"][10]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `name`, `type`, `created_at`");
		$rest_api["routes"][10]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][10]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][10]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=subjects";
		$rest_api["routes"][11]["namespace"] = "teacherdiary";
		$rest_api["routes"][11]["tb_version"] = "Upd.1810171027";
		$rest_api["routes"][11]["methods"][] = "GET";
		$rest_api["routes"][11]["args"]["id"] = array("required"=>"false","description"=>"Selecting `teacherdiary` based `id`");
		$rest_api["routes"][11]["args"]["section_id"] = array("required"=>"false","description"=>"Selecting `teacherdiary` based `section_id`");
		$rest_api["routes"][11]["args"]["class_section_id"] = array("required"=>"false","description"=>"Selecting `teacherdiary` based `class_section_id`");
		$rest_api["routes"][11]["args"]["teacher_id"] = array("required"=>"false","description"=>"Selecting `teacherdiary` based `teacher_id`");
		$rest_api["routes"][11]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `teacherdiary` based `created_at`");
		$rest_api["routes"][11]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `section_id`, `class_section_id`, `teacher_id`, `created_at`");
		$rest_api["routes"][11]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][11]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][11]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=teacherdiary";
		$rest_api["routes"][12]["namespace"] = "teachers";
		$rest_api["routes"][12]["tb_version"] = "Upd.1810040444";
		$rest_api["routes"][12]["methods"][] = "GET";
		$rest_api["routes"][12]["args"]["id"] = array("required"=>"false","description"=>"Selecting `teachers` based `id`");
		$rest_api["routes"][12]["args"]["name"] = array("required"=>"false","description"=>"Selecting `teachers` based `name`");
		$rest_api["routes"][12]["args"]["nrcno"] = array("required"=>"false","description"=>"Selecting `teachers` based `nrcno`");
		$rest_api["routes"][12]["args"]["email"] = array("required"=>"false","description"=>"Selecting `teachers` based `email`");
		$rest_api["routes"][12]["args"]["address"] = array("required"=>"false","description"=>"Selecting `teachers` based `address`");
		$rest_api["routes"][12]["args"]["dob"] = array("required"=>"false","description"=>"Selecting `teachers` based `dob`");
		$rest_api["routes"][12]["args"]["designation"] = array("required"=>"false","description"=>"Selecting `teachers` based `designation`");
		$rest_api["routes"][12]["args"]["sex"] = array("required"=>"false","description"=>"Selecting `teachers` based `sex`");
		$rest_api["routes"][12]["args"]["phone"] = array("required"=>"false","description"=>"Selecting `teachers` based `phone`");
		$rest_api["routes"][12]["args"]["image"] = array("required"=>"false","description"=>"Selecting `teachers` based `image`");
		$rest_api["routes"][12]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `teachers` based `created_at`");
		$rest_api["routes"][12]["args"]["updated_at"] = array("required"=>"false","description"=>"Selecting `teachers` based `updated_at`");
		$rest_api["routes"][12]["args"]["raceandreligion"] = array("required"=>"false","description"=>"Selecting `teachers` based `raceandreligion`");
		$rest_api["routes"][12]["args"]["spouseName"] = array("required"=>"false","description"=>"Selecting `teachers` based `spouseName`");
		$rest_api["routes"][12]["args"]["spouseOccupation"] = array("required"=>"false","description"=>"Selecting `teachers` based `spouseOccupation`");
		$rest_api["routes"][12]["args"]["fathername"] = array("required"=>"false","description"=>"Selecting `teachers` based `fathername`");
		$rest_api["routes"][12]["args"]["mothername"] = array("required"=>"false","description"=>"Selecting `teachers` based `mothername`");
		$rest_api["routes"][12]["args"]["parentOccupation"] = array("required"=>"false","description"=>"Selecting `teachers` based `parentOccupation`");
		$rest_api["routes"][12]["args"]["gender"] = array("required"=>"false","description"=>"Selecting `teachers` based `gender`");
		$rest_api["routes"][12]["args"]["position"] = array("required"=>"false","description"=>"Selecting `teachers` based `position`");
		$rest_api["routes"][12]["args"]["education"] = array("required"=>"false","description"=>"Selecting `teachers` based `education`");
		$rest_api["routes"][12]["args"]["salary"] = array("required"=>"false","description"=>"Selecting `teachers` based `salary`");
		$rest_api["routes"][12]["args"]["currency"] = array("required"=>"false","description"=>"Selecting `teachers` based `currency`");
		$rest_api["routes"][12]["args"]["primarySubject"] = array("required"=>"false","description"=>"Selecting `teachers` based `primarySubject`");
		$rest_api["routes"][12]["args"]["entryDate"] = array("required"=>"false","description"=>"Selecting `teachers` based `entryDate`");
		$rest_api["routes"][12]["args"]["transferedSchool"] = array("required"=>"false","description"=>"Selecting `teachers` based `transferedSchool`");
		$rest_api["routes"][12]["args"]["educationDepartment"] = array("required"=>"false","description"=>"Selecting `teachers` based `educationDepartment`");
		$rest_api["routes"][12]["args"]["startDateofTeaching"] = array("required"=>"false","description"=>"Selecting `teachers` based `startDateofTeaching`");
		$rest_api["routes"][12]["args"]["currentsubject"] = array("required"=>"false","description"=>"Selecting `teachers` based `currentsubject`");
		$rest_api["routes"][12]["args"]["responsibility"] = array("required"=>"false","description"=>"Selecting `teachers` based `responsibility`");
		$rest_api["routes"][12]["args"]["attendedclass"] = array("required"=>"false","description"=>"Selecting `teachers` based `attendedclass`");
		$rest_api["routes"][12]["args"]["location"] = array("required"=>"false","description"=>"Selecting `teachers` based `location`");
		$rest_api["routes"][12]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `name`, `nrcno`, `email`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `created_at`, `updated_at`, `raceandreligion`, `spouseName`, `spouseOccupation`, `fathername`, `mothername`, `parentOccupation`, `gender`, `position`, `education`, `salary`, `currency`, `primarySubject`, `entryDate`, `transferedSchool`, `educationDepartment`, `startDateofTeaching`, `currentsubject`, `responsibility`, `attendedclass`, `location`");
		$rest_api["routes"][12]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][12]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][12]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=teachers";
		$rest_api["routes"][13]["namespace"] = "teachingnote";
		$rest_api["routes"][13]["tb_version"] = "Upd.1810171227";
		$rest_api["routes"][13]["methods"][] = "GET";
		$rest_api["routes"][13]["args"]["id"] = array("required"=>"false","description"=>"Selecting `teachingnote` based `id`");
		$rest_api["routes"][13]["args"]["section_id"] = array("required"=>"false","description"=>"Selecting `teachingnote` based `section_id`");
		$rest_api["routes"][13]["args"]["class_section_id"] = array("required"=>"false","description"=>"Selecting `teachingnote` based `class_section_id`");
		$rest_api["routes"][13]["args"]["teacher_id"] = array("required"=>"false","description"=>"Selecting `teachingnote` based `teacher_id`");
		$rest_api["routes"][13]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `teachingnote` based `created_at`");
		$rest_api["routes"][13]["args"]["lessontitle"] = array("required"=>"false","description"=>"Selecting `teachingnote` based `lessontitle`");
		$rest_api["routes"][13]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `section_id`, `class_section_id`, `teacher_id`, `created_at`, `lessontitle`");
		$rest_api["routes"][13]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][13]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][13]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=teachingnote";
		$rest_api["routes"][14]["namespace"] = "timetables";
		$rest_api["routes"][14]["tb_version"] = "Upd.1810110929";
		$rest_api["routes"][14]["methods"][] = "GET";
		$rest_api["routes"][14]["args"]["id"] = array("required"=>"false","description"=>"Selecting `timetables` based `id`");
		$rest_api["routes"][14]["args"]["teacher_subject_id"] = array("required"=>"false","description"=>"Selecting `timetables` based `teacher_subject_id`");
		$rest_api["routes"][14]["args"]["day_name"] = array("required"=>"false","description"=>"Selecting `timetables` based `day_name`");
		$rest_api["routes"][14]["args"]["start_time"] = array("required"=>"false","description"=>"Selecting `timetables` based `start_time`");
		$rest_api["routes"][14]["args"]["end_time"] = array("required"=>"false","description"=>"Selecting `timetables` based `end_time`");
		$rest_api["routes"][14]["args"]["room_no"] = array("required"=>"false","description"=>"Selecting `timetables` based `room_no`");
		$rest_api["routes"][14]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `timetables` based `created_at`");
		$rest_api["routes"][14]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `teacher_subject_id`, `day_name`, `start_time`, `end_time`, `room_no`, `created_at`");
		$rest_api["routes"][14]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][14]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][14]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=timetables";
		$rest_api["routes"][15]["namespace"] = "transport_route";
		$rest_api["routes"][15]["tb_version"] = "Upd.1810040446";
		$rest_api["routes"][15]["methods"][] = "GET";
		$rest_api["routes"][15]["args"]["id"] = array("required"=>"false","description"=>"Selecting `transport_route` based `id`");
		$rest_api["routes"][15]["args"]["route_title"] = array("required"=>"false","description"=>"Selecting `transport_route` based `route_title`");
		$rest_api["routes"][15]["args"]["no_of_vehicle"] = array("required"=>"false","description"=>"Selecting `transport_route` based `no_of_vehicle`");
		$rest_api["routes"][15]["args"]["fare"] = array("required"=>"false","description"=>"Selecting `transport_route` based `fare`");
		$rest_api["routes"][15]["args"]["note"] = array("required"=>"false","description"=>"Selecting `transport_route` based `note`");
		$rest_api["routes"][15]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `transport_route` based `created_at`");
		$rest_api["routes"][15]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `route_title`, `no_of_vehicle`, `fare`, `note`, `created_at`");
		$rest_api["routes"][15]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][15]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][15]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=transport_route";
		$rest_api["routes"][16]["namespace"] = "users";
		$rest_api["routes"][16]["tb_version"] = "Upd.1810040323";
		$rest_api["routes"][16]["methods"][] = "GET";
		$rest_api["routes"][16]["args"]["id"] = array("required"=>"false","description"=>"Selecting `users` based `id`");
		$rest_api["routes"][16]["args"]["user_id"] = array("required"=>"false","description"=>"Selecting `users` based `user_id`");
		$rest_api["routes"][16]["args"]["username"] = array("required"=>"false","description"=>"Selecting `users` based `username`");
		$rest_api["routes"][16]["args"]["password"] = array("required"=>"false","description"=>"Selecting `users` based `password`");
		$rest_api["routes"][16]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `user_id`, `username`, `password`");
		$rest_api["routes"][16]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][16]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][16]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=users";
		$rest_api["routes"][17]["namespace"] = "weeklypreparation";
		$rest_api["routes"][17]["tb_version"] = "Upd.1810171208";
		$rest_api["routes"][17]["methods"][] = "GET";
		$rest_api["routes"][17]["args"]["id"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `id`");
		$rest_api["routes"][17]["args"]["section_id"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `section_id`");
		$rest_api["routes"][17]["args"]["class_section_id"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `class_section_id`");
		$rest_api["routes"][17]["args"]["teacher_id"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `teacher_id`");
		$rest_api["routes"][17]["args"]["created_at"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `created_at`");
		$rest_api["routes"][17]["args"]["date_from"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `date_from`");
		$rest_api["routes"][17]["args"]["date_to"] = array("required"=>"false","description"=>"Selecting `weeklypreparation` based `date_to`");
		$rest_api["routes"][17]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `section_id`, `class_section_id`, `teacher_id`, `created_at`, `date_from`, `date_to`");
		$rest_api["routes"][17]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][17]["args"]["limit"] = array("required"=>"false","description"=> "limit the items that appear","type"=>"number");
		$rest_api["routes"][17]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=weeklypreparation";
		$rest_api["routes"][18]["namespace"] = "me";
		$rest_api["routes"][18]["methods"][] = "GET";
		$rest_api["routes"][18]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=me";
		$rest_api["routes"][19]["namespace"] = "auth";
		$rest_api["routes"][19]["methods"][] = "GET";
		$rest_api["routes"][19]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=auth";
		$rest_api["routes"][20]["namespace"] = "submit/me";
		$rest_api["routes"][20]["methods"][] = "POST";
		$rest_api["routes"][20]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=submit&form=me";
		$rest_api["routes"][21]["namespace"] = "submit/feedback";
		$rest_api["routes"][21]["tb_version"] = "";
		$rest_api["routes"][21]["methods"][] = "POST";
		$rest_api["routes"][21]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=submit&form=feedback";
		$rest_api["routes"][21]["args"]["subject"] = array("required"=>"true","description"=>"Insert data to field `subject` in table `feedback`");
		$rest_api["routes"][21]["args"]["phone"] = array("required"=>"true","description"=>"Insert data to field `phone` in table `feedback`");
		$rest_api["routes"][21]["args"]["email"] = array("required"=>"true","description"=>"Insert data to field `email` in table `feedback`");
		$rest_api["routes"][21]["args"]["message"] = array("required"=>"true","description"=>"Insert data to field `message` in table `feedback`");
		$rest_api["routes"][22]["namespace"] = "submit/feedback";
		$rest_api["routes"][22]["tb_version"] = "";
		$rest_api["routes"][22]["methods"][] = "POST";
		$rest_api["routes"][22]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=submit&form=feedback";
		$rest_api["routes"][22]["args"]["subject"] = array("required"=>"true","description"=>"Insert data to field `subject` in table `feedback`");
		$rest_api["routes"][22]["args"]["phone"] = array("required"=>"true","description"=>"Insert data to field `phone` in table `feedback`");
		$rest_api["routes"][22]["args"]["email"] = array("required"=>"true","description"=>"Insert data to field `email` in table `feedback`");
		$rest_api["routes"][22]["args"]["message"] = array("required"=>"true","description"=>"Insert data to field `message` in table `feedback`");
		$rest_api["routes"][23]["namespace"] = "submit/users";
		$rest_api["routes"][23]["tb_version"] = "";
		$rest_api["routes"][23]["methods"][] = "POST";
		$rest_api["routes"][23]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=submit&form=users";
		$rest_api["routes"][23]["args"]["opassword"] = array("required"=>"true","description"=>"Insert data to field `Password` in table `users`");
		$rest_api["routes"][23]["args"]["npassword"] = array("required"=>"true","description"=>"Insert data to field `New Password` in table `users`");
		$rest_api["routes"][23]["args"]["cpassword"] = array("required"=>"true","description"=>"Insert data to field `Confirm Password` in table `users`");
		break;
	// TODO: -+- submit

	case "submit":
		$rest_api=array();

		$rest_api["methods"][0] = "POST";
		$rest_api["methods"][1] = "GET";
		switch($_GET["form"]){
			// TODO: -+----+- users
			case "users":


				$rest_api["auth"]["basic"] = false;

				$rest_api["args"]["subject"] = array("required"=>"true","description"=>"Receiving data from the input `subject`");
				$rest_api["args"]["phone"] = array("required"=>"true","description"=>"Receiving data from the input `phone`");
				$rest_api["args"]["email"] = array("required"=>"true","description"=>"Receiving data from the input `email`");
				$rest_api["args"]["message"] = array("required"=>"true","description"=>"Receiving data from the input `message`");
				if(!isset($_POST["subject"])){
					$_POST["subject"]="";
				}
				if(!isset($_POST["phone"])){
					$_POST["phone"]="";
				}
				if(!isset($_POST["email"])){
					$_POST["email"]="";
				}
				if(!isset($_POST["message"])){
					$_POST["message"]="";
				}
				$rest_api["message"] = "Please! complete the form provided.";
				$rest_api["title"] = "Notice!";
				if(($_POST["subject"] != "") || ($_POST["phone"] != "") || ($_POST["email"] != "") || ($_POST["message"] != "")){
					// avoid undefined
					$input["subject"] = "";
					$input["phone"] = "";
					$input["email"] = "";
					$input["message"] = "";
					// variable post
					if(isset($_POST["subject"])){
						$input["subject"] = $mysql->escape_string($_POST["subject"]);
					}

					if(isset($_POST["phone"])){
						$input["phone"] = $mysql->escape_string($_POST["phone"]);
					}

					if(isset($_POST["email"])){
						$input["email"] = $mysql->escape_string($_POST["email"]);
					}

					if(isset($_POST["message"])){
						$input["message"] = $mysql->escape_string($_POST["message"]);
					}

					$sql_query = "INSERT INTO `users` (`subject`,`phone`,`email`,`message`) VALUES ('".$input["subject"]."','".$input["phone"]."','".$input["email"]."','".$input["message"]."' )";
					if($query = $mysql->query($sql_query)){
						$rest_api["message"] = "Your Login Credential has been save.";
						$rest_api["title"] = "Successfully";
					}else{
						$rest_api["message"] = "Form input and SQL Column do not match.";
						$rest_api["title"] = "Fatal Error!";
					}
				}else{
					$rest_api["message"] = "Please! complete the form provided.";
					$rest_api["title"] = "Notice!";
				}

				break;

			// TODO: -+----+- users
			case "users":


				$rest_api["auth"]["basic"] = false;

				$rest_api["args"]["subject"] = array("required"=>"true","description"=>"Receiving data from the input `subject`");
				$rest_api["args"]["phone"] = array("required"=>"true","description"=>"Receiving data from the input `phone`");
				$rest_api["args"]["email"] = array("required"=>"true","description"=>"Receiving data from the input `email`");
				$rest_api["args"]["message"] = array("required"=>"true","description"=>"Receiving data from the input `message`");
				if(!isset($_POST["subject"])){
					$_POST["subject"]="";
				}
				if(!isset($_POST["phone"])){
					$_POST["phone"]="";
				}
				if(!isset($_POST["email"])){
					$_POST["email"]="";
				}
				if(!isset($_POST["message"])){
					$_POST["message"]="";
				}
				$rest_api["message"] = "Please! complete the form provided.";
				$rest_api["title"] = "Notice!";
				if(($_POST["subject"] != "") || ($_POST["phone"] != "") || ($_POST["email"] != "") || ($_POST["message"] != "")){
					// avoid undefined
					$input["subject"] = "";
					$input["phone"] = "";
					$input["email"] = "";
					$input["message"] = "";
					// variable post
					if(isset($_POST["subject"])){
						$input["subject"] = $mysql->escape_string($_POST["subject"]);
					}

					if(isset($_POST["phone"])){
						$input["phone"] = $mysql->escape_string($_POST["phone"]);
					}

					if(isset($_POST["email"])){
						$input["email"] = $mysql->escape_string($_POST["email"]);
					}

					if(isset($_POST["message"])){
						$input["message"] = $mysql->escape_string($_POST["message"]);
					}

					$sql_query = "INSERT INTO `users` (`subject`,`phone`,`email`,`message`) VALUES ('".$input["subject"]."','".$input["phone"]."','".$input["email"]."','".$input["message"]."' )";
					if($query = $mysql->query($sql_query)){
						$rest_api["message"] = "Your Login Credential has been save.";
						$rest_api["title"] = "Successfully";
					}else{
						$rest_api["message"] = "Form input and SQL Column do not match.";
						$rest_api["title"] = "Fatal Error!";
					}
				}else{
					$rest_api["message"] = "Please! complete the form provided.";
					$rest_api["title"] = "Notice!";
				}

				break;

			// TODO: -+----+- users
			case "users":


				$rest_api["auth"]["basic"] = false;

				$rest_api["args"]["subject"] = array("required"=>"true","description"=>"Receiving data from the input `subject`");
				$rest_api["args"]["phone"] = array("required"=>"true","description"=>"Receiving data from the input `phone`");
				$rest_api["args"]["email"] = array("required"=>"true","description"=>"Receiving data from the input `email`");
				$rest_api["args"]["message"] = array("required"=>"true","description"=>"Receiving data from the input `message`");
				$rest_api["args"]["opassword"] = array("required"=>"true","description"=>"Receiving data from the input `Password`");
				$rest_api["args"]["npassword"] = array("required"=>"true","description"=>"Receiving data from the input `New Password`");
				$rest_api["args"]["cpassword"] = array("required"=>"true","description"=>"Receiving data from the input `Confirm Password`");
				if(!isset($_POST["subject"])){
					$_POST["subject"]="";
				}
				if(!isset($_POST["phone"])){
					$_POST["phone"]="";
				}
				if(!isset($_POST["email"])){
					$_POST["email"]="";
				}
				if(!isset($_POST["message"])){
					$_POST["message"]="";
				}
				if(!isset($_POST["opassword"])){
					$_POST["opassword"]="";
				}
				if(!isset($_POST["npassword"])){
					$_POST["npassword"]="";
				}
				if(!isset($_POST["cpassword"])){
					$_POST["cpassword"]="";
				}
				$rest_api["message"] = "Please! complete the form provided.";
				$rest_api["title"] = "Notice!";
				if(($_POST["subject"] != "") || ($_POST["phone"] != "") || ($_POST["email"] != "") || ($_POST["message"] != "") || ($_POST["opassword"] != "") || ($_POST["npassword"] != "") || ($_POST["cpassword"] != "")){
					// avoid undefined
					$input["subject"] = "";
					$input["phone"] = "";
					$input["email"] = "";
					$input["message"] = "";
					$input["opassword"] = "";
					$input["npassword"] = "";
					$input["cpassword"] = "";
					// variable post
					if(isset($_POST["subject"])){
						$input["subject"] = $mysql->escape_string($_POST["subject"]);
					}

					if(isset($_POST["phone"])){
						$input["phone"] = $mysql->escape_string($_POST["phone"]);
					}

					if(isset($_POST["email"])){
						$input["email"] = $mysql->escape_string($_POST["email"]);
					}

					if(isset($_POST["message"])){
						$input["message"] = $mysql->escape_string($_POST["message"]);
					}

					if(isset($_POST["opassword"])){
						$input["opassword"] = $mysql->escape_string($_POST["opassword"]);
					}

					if(isset($_POST["npassword"])){
						$input["npassword"] = $mysql->escape_string($_POST["npassword"]);
					}

					if(isset($_POST["cpassword"])){
						$input["cpassword"] = $mysql->escape_string($_POST["cpassword"]);
					}

					$sql_query = "INSERT INTO `users` (`subject`,`phone`,`email`,`message`,`opassword`,`npassword`,`cpassword`) VALUES ('".$input["subject"]."','".$input["phone"]."','".$input["email"]."','".$input["message"]."','".$input["opassword"]."','".$input["npassword"]."','".$input["cpassword"]."' )";
					if($query = $mysql->query($sql_query)){
						$rest_api["message"] = "Your Login Credential has been save.";
						$rest_api["title"] = "Successfully";
					}else{
						$rest_api["message"] = "Form input and SQL Column do not match.";
						$rest_api["title"] = "Fatal Error!";
					}
				}else{
					$rest_api["message"] = "Please! complete the form provided.";
					$rest_api["title"] = "Notice!";
				}

				break;
			// TODO: -+- Submit : Me
			case "me":
				// TODO: -+----+- Auth User
				$is_user = false;
				if(isset($_SERVER["PHP_AUTH_USER"])){
					$php_auth_user = $mysql->escape_string($_SERVER["PHP_AUTH_USER"]);
					$php_auth_pw = $mysql->escape_string($_SERVER["PHP_AUTH_PW"]);
					$auth_sql = "SELECT * FROM `users` WHERE `username` = '$php_auth_user' AND `password` = '$php_auth_pw'";
					if($result = $mysql->query($auth_sql)){
						$current_user = $result->fetch_array();
						if(isset($current_user["username"])){
							$is_user = true;

							$input["user_id"] = null;
							if(isset($_POST["user_id"])){
								$input["user_id"] = $mysql->escape_string($_POST["user_id"]);
							}
							$update_me_sql = "UPDATE `users` SET `user_id` = '".$input["user_id"]."' WHERE `username`='$php_auth_user'";
							if($query = $mysql->query($update_me_sql)){
								$rest_api=array("data"=>array("status"=>200,"title"=>"Successfully"),"title"=>"Successfully","message"=>"You have successfully updated your data.");
							}else{
								$rest_api=array("data"=>array("status"=>200,"title"=>"Error"),"title"=>"Error","message"=>"You have fail updated your data.");
							}
						}
					}
					if($is_user == false){
						$rest_api=array("data"=>array("status"=>401,"title"=>"Unauthorized"),"title"=>"Unauthorized","message"=>"Sorry, you cannot see list resources.");
						break;
					}
				}else{
					$rest_api=array("data"=>array("status"=>401,"title"=>"Unauthorized"),"title"=>"Unauthorized","message"=>"Sorry, you cannot see list resources.");
					break;
				}

				break;

		}


	break;

}


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization,X-Authorization');
if (!isset($_GET["callback"])){
	header('Content-type: application/json');
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo json_encode($rest_api,JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode($rest_api);
	}

}else{
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api,JSON_UNESCAPED_UNICODE). ");" ;
	}else{
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api) . ");" ;
	}

}