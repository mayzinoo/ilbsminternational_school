<html>    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="theme-color" content="#424242" />
        <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">    
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css"> 
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
        <!--print table-->

        <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/template.js"></script>
        

    </head>
    <style>
        body{
            background: #424242;
        }
        .center{
            text-align:center;
        }
        .toppadding_sm{
            padding-top:10px;
        }
        .padding_md{
            padding-top:30px;
            padding-bottom:30px;
        }
        .toppadding_md{
            padding-top:30px;
        }
        .bottompadding_md{
            padding-bottom:30px;
        }
        .padding_lg{
            padding-top:60px;
            padding-bottom:60px;
        }
        .bottompadding_lg{
            padding-bottom:60px;
        }
        .padding_xl{
            padding-top:120px;
            padding-bottom:120px;
        }
        .guestform{
            color: #555;
            background:#eee;
            padding:10px 30px 30px 30px;
            border-radius:5px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.35);
        }
        .form-control{
            height: 40px;
            border: 1px solid #999;
            border-radius: 5px;
        }
        label{
            padding-top:20px;
            color: #555;
        }
        button.btn {
            height: 40px;
            line-height: 40px;
        }
        button.btn{
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
            background: #de995e;
            border: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            border-radius: 4px;
            text-shadow: none;
            width:100%;
        }
        .form-top img{
            width:100px;
            height:auto;
        }
        .form-top h4{
            color:#fff;
            font-size: 25px;
        }
        @media only screen and (min-width:200px) and (max-width: 480px){
            .guest_form{
                padding-top:60px;
            }
            .form-top h4{
                font-size:22px !important;
                float:right;
            }
        }
    </style>
    <?php
        $cur_session=$this->db->query("Select * from sch_settings")->row();
     $cur_sess=$cur_session->session_id;
    ?>
    <body>
        <div class="container">
            <div class="row padding_md">
                <div class="col-md-12 bottompadding_md form-top">
                        
                            <div class="col-md-offset-3 col-md-2 col-xs-2">
                                <img src="<?php echo base_url(); ?>uploads/school_content/logo/<?=$cur_session->image?>" class="logowidth"> 
                            </div>
                            <div class="col-md-4 col-sm-6 toppadding_md noppadding">
                                <h4>Visitor Registration Form !</h4>
                            </div>
                        
                </div>
                <div class="col-md-12">
                <div class="col-md-6 col-md-offset-3 guest_form">
                    <div class="guestform">
                     <?php if ($this->session->flashdata('msg')) { ?>
                        <?php echo $this->session->flashdata('msg') ?>
                    <?php } ?>   
                    <?=form_open('Guest/guest_insert/')?>
                        <label>အမည် <span style="color:#CD232C;">*</span></label>
                        <input type="text" name="name" class="form-control">
                        
                        <label>ဖုန်း <span style="color:#CD232C;">*</span></label>
                        <input type="text" name="phone" class="form-control">
                        
                        <label>မှတ်ပုံတင်အမှတ် <span style="color:#CD232C;">*</span></label>
                        <input type="text" name="nrcno" class="form-control">
                        
                        <label>ကဒ်နံပါတ် <span style="color:#CD232C;">*</span></label>
                        <input type="text" name="cardno" class="form-control">    
                        
                        <label>လိပ်စာ <span style="color:#CD232C;">*</span></label>
                        <textarea name="address" class="form-control"></textarea>
                         
                         <label>စုံစမ်းလိုသည့်အတန်း <span style="color:#CD232C;">*</span></label>
                    <?php 
                    foreach($classlists as $class=>$key):
                        
                        echo '<div class="col-md-6 col-sm-6">

                        <div class="form-check">
    <input type="checkbox" class="form-check-input" name="class[]" value="'.$key.'">
    <label class="form-check-label" for="class">'.$key.'</label>
</div></div>';
                        endforeach;
                        
                    ?>
                        
                        <label>အျခားအေၾကာင္းအရာ <span style="color:#CD232C;">*</span></label>
                        <textarea name="remark" class="form-control"></textarea>
                        
                        <div class="toppadding_sm">
                            <button type="submit" class="btn">Register</button>
                        </div>
                    <?=form_close()?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>