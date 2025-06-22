<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Report Card</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print.css">
                <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">

</head>

<body>

        <div class="col-sm-12" align="right"> 
        
        <span onclick="window.print()" class="btn btn-success"><img src="<?=base_url()?>backend/images/p.png"/> Print</span>
        </div>
                          
        <div class="tab-pane" id="reportcard">
        
            <div class="row header text-center student">
            <div class="col-sm-3">အမည္ <input type="text" value="<?=$student["firstname"].$student["lastname"]?>" readonly="readonly"/></div>
            <div class="col-sm-3">ေက်ာင္း <input type="text" value="<?=$settinglist->nick?>" readonly="readonly"/></div>
            <div class="col-sm-3">အတန္း <input type="text" value="<?=$student["class"]?>" readonly="readonly"/> တန္း</div>
            <div class="col-sm-3">တန္းခဲြ <input type="text" value="<?=$student["section"]?>" readonly="readonly"/></div>
            </div>
        </div>
        
        
            <div class="table-responsive">    
                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td>Subjects Name</td>
                            <td>Marks</td>
                            <td>Grades</td>
                        </tr>
                        <?php
                        foreach($subjects->result() as $sub){ ?>
                            <tr>
                                <td><?=$sub->subname?></td>
                                <td><?=$sub->gm?></td>
                                <td>
                                    <?php
                                    if($sub->gm==0)
                            {$avg=0;$g="";}
                            else{ 
                            $mk=$sub->gm;
                            $fm=$sub->fm;
                            $avg=($mk/$fm)*100;
                            $grades=$this->Reportcard_model->get_grades($avg);
                            $g=$grades->name;
                            }
                                    echo $g;
                                    ?>
                                </td>
                                <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>  <td></td> <td></td> <td></td>
                            </tr>
                        <?php } ?>
                
                    </thead>            
                    <tbody> 
                    
                    </tbody>
                </table>
            </div>    
            
            <br />
</body>
</html>