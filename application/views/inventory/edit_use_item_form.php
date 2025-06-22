<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Inventory <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Expense Form</h3>
                    </div> 
                    <form action="<?php echo site_url('Inventory/update_expense') ?>"  name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$row->id?>">
                        <input type="hidden" name="old_qty" value="<?=$row->quantity?>" >
                         <div class="panel-default">
                          <div class="panel-body">
                      <div class="row clone">
                      <table class="table" width="100%">
                          
                      <thead>
                        <tr>
                        <th width="5%">No</th>
                        <th>Date</th>
                        <th width="20%">Item Name</th>
                        <th width="15%">Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                          <th>Description</th>
                          
                          </tr>
                      </thead>
                      <tbody id="SourceWrapper">
                      <tr class="">
                      <td class="no">1</td>
                      <td>
                            <div class="form-group <?php
                                if (form_error('date[]')) {
                                    echo 'has-error';
                                }
                                ?>">
                                
                                   <?php echo form_input("date",$row->date,'class="form-control" id="start_date"'); ?>
                                
                                </div> 
                          </td>
                          <td>
                                <div class="form-group <?php
                    if (form_error('item_name')) {
                        echo 'has-error';
                    }
                    ?>">
                    
                       <?php echo form_dropdown("item_name",$itemlist,$row->item_id,'class="form-control" onchange="getPricedata(this.value)"'); ?>
                    
                    </div> 
                    
                          </td>
                          
                           <td>
                                <div class="form-group <?php
                    if (form_error('quantity')) {
                        echo 'has-error';
                    }
                    ?>">
                    
                       <?php echo form_input("quantity",$row->quantity,'class="form-control" onkeyup="calculateThis(this.value)" '); ?>
                    
                    </div> 
                    
                          </td>
                          
                          <td>
                                <div class="form-group <?php
                    if (form_error('price')) {
                        echo 'has-error';
                    }
                    ?>">
                    
                       <?php echo form_input("price",$row->price,'class="form-control" id="price"'); ?>
                    
                    </div> 
                    
                          </td>
                          
                          <td>
                                <div class="form-group <?php
                    if (form_error('total')) {
                        echo 'has-error';
                    }
                    ?>">
                    
                       <?php echo form_input("total",$row->total,'class="form-control" id="total"'); ?>
                    
                    </div> 
                    
                          </td>
                          
                          <td>
                              
                    <div class="form-group <?php
                    if (form_error('description')) {
                        echo 'has-error';
                    }
                    ?>">
                        <textarea class="form-control" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo $row->description; ?></textarea>
                    
                    </div>
                          </td>
                          <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                      </tr>
                          
                      </tbody>
                      </table>
                        
                              
                        
                      </div>
                      </div>
                      </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div> 
            </div>
           
        </div> 
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#start_date,#end_date,#startDateofTeaching').datepicker({
            format: date_format,
            autoclose: true
        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
        
        
    });
</script>
