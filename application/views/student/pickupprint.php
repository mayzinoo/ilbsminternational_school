
   <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
                   <link rel="stylesheet" href="http://www.essentialschool.online/backend/bootstrap/css/bootstrap.min.css">    
        <link rel="stylesheet" href="http://www.essentialschool.online/backend/dist/css/style-main.css"> 
<style>
@page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    h4{
        color: #8e3808;
        margin-bottom: 3px;
    }

    /*h3{
        color: #FF0000;
    }*/
    .title1{
        color: #FF0000;
        font-size: 30px;


    }

    h3{
        color: #FF0000;
        font-size: 30px;
        margin: 0px;
    }

    p
    {
        margin: 3px;
        width:100%;
        float:left;
        text-align:left;
    }

    td
    {
        vertical-align: top;

    }

    .title2{
        color: #1a8731;
        font-size: 16px;
    }
    .address{
        color: #1a8731;
        font-size: 16px;
    }

    body
    {
        margin: 0mm; /* margin you want for the content */
    font-size: 11px;

    }
   

.font1
{
  color:red !important;
}

.font2
{
  color:blue !important;
}

.footer
{
  font-family:Zawgyi-One;
  font-size:11px;
  position:absolute;
  bottom:0;
  text-align:center;
  width:100%
}

.col-md-8

{
float:left;
width: 70%;
margin:10px;	
}

</style>
<div class="col-md-4 col-sm-4">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" align='center'>ကျောင်းကြိုခွင့် ကဒ်ပြား</h5>
      
      </div>
      <div class="modal-body">
           <div class="row">
            

            <div class="col-sm-6 cardphoto" align="center">
                <img src="<?=base_url()?><?=$student['image']?>" class="profile" width="30%"/>

            </div>
        <div class="col-sm-6">
            <div class="center_middle_card">
                             <p align="center"><?php echo $student['admission_no']?></p>

                <p><?php   echo $student['firstname']." ".$student['lastname']?></p>
                <!--<div class="grade">-->
                    <p><?php echo $student['class'] . " (" . $student['section'] . ")"?></p>
                <!--</div>-->
                <p><?php echo $student['father_name']?></p>
                <p><?php echo $student['guardian_address']?></p>
                <p><?php echo $student['guardian_phone']?></p>
            </div>
     </div>
        </div>
             <div class="row">
                        
                        
                         


                     <?php foreach($pickups as $value):
                         ?>
                  <div class="col-md-4 col-sm-4">  
                  <img src="<?=base_url()?>uploads/pickup_persons/<?=$value["student_id"]?>/<?php echo $value['pickuphoto']; ?>" align="left" class="thumbnail"/>
                    <p><?php echo $value['name']; ?></p>
                    <?php echo $value['relation']; ?>
                   <p> <?php echo $value['phone']; ?></p>
                     </div>                                   
                     <?php endforeach;?>    


        </div>
      </div>
    </div>
    </div>