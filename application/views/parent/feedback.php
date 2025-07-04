
<style type="text/css"> 
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}


.outgoing_msg_img {
  display: inline-block;
  float:right;
  width: 10%;
  padding-left:10px;
}


.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 67%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 66%;
}
.input_msg_write textarea {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border: 1px solid #c4c4c4;position: relative;margin-bottom:10px;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
.sidepadding_md{
    padding-top:20px;
    /*padding-left:80px;*/
    /*padding-right:80px;*/
}
#show_status
{color:green;font-weight:bold;}
</style>
<div class="container">
    <div class="sidepadding_md">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
      
        <div class="mesgs">
          <div class="msg_history" id="msg_history">
        
          <?php 
          foreach($feedbacks->result() as $fb):

          	if($fb->reply_by =="")
          	{
           ?>

            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="<?=base_url()?>uploads/school_content/logo/user-profile.png"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?=$fb->message?></p>
                  <span class="time_date"> <?php echo date("h:m A",strtotime($fb->date)) ?>   |    <?php echo date("d,m,y",strtotime($fb->date)) ?> </span></div>
              </div>
            </div>

            <?php } 
            else
            {
             ?>
            

            <div class="outgoing_msg">
                 <div class="outgoing_msg_img"> <img src="<?=base_url()?>uploads/school_content/logo/1.png"> </div>
              <div class="sent_msg">
               <p><?=$fb->message?></p>
                  <span class="time_date"> <?php echo date("h:m A",strtotime($fb->date)) ?>   |    <?php echo date("d,m,y",strtotime($fb->date)) ?> </span></div>
               </div>

            <?php 

       		 }
       		 
            endforeach;
             ?>

        
          </div>
          
          
          <p id="show_status">Type Your Message Here</p>
          <div class="type_msg">
            <div class="input_msg_write">
              <textarea  class="write_msg" placeholder="Type a message" id="message"/> </textarea>
              <button class="msg_send_btn" type="button" onclick="sendfeedback()"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>
      
      
      
    </div>
</div>    
    <script type="text/javascript">
    function sendfeedback()
    {
    $("#show_status").html("sending.....");
    message=$("#message").val();
    data="message="+message;
    
          $.ajax({
          type: "POST",
          url: '<?=base_url()?>'+"parent/Parents/send_feedback/",
          data: data,
	      success: function(d) 

        		{
        		    $("#msg_history").append(d);
        		    $("#message").val("");
        		    window.scrollBy(0, 70);

        		  $("#show_status").html("Type Your Message Here");

        		}
		});
    }
        </script>
    </script>