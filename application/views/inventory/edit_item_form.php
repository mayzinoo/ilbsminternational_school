<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Courses <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Item</h3>
                    </div> 
                    <form action="<?php echo site_url('Inventory/update_item') ?>"  name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Item Name</label>
                                <input type="hidden" name="id" value="<?=$row->id?>" >
                                <input autofocus="" id="name" name="name" placeholder="Item Name" type="text" class="form-control"  value="<?=$row->name?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Price</label>
                                <input autofocus="" id="price" name="price" placeholder="" type="text" class="form-control"  value="<?=$row->price?>" />
                                <span class="text-danger"><?php echo form_error('price'); ?></span>
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Category</label>
                                <input autofocus="" id="category" name="category" placeholder="Category" type="text" class="form-control"  value="<?php echo $row->category; ?>" />
                                <span class="text-danger"><?php echo form_error('category'); ?></span>
                            </div>
                            
    
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                <textarea name="description" class="form-control">
                                    <?php echo $row->description; ?>
                                </textarea>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
                            </div>
                            
                             
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Date</label>
                                <input autofocus="" name="date" placeholder="Date" type="text" id="start_date" class="form-control"  value="<?php echo $row->date; ?>" />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
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
