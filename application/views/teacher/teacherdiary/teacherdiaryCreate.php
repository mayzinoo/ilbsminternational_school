<style>
    @media only screen and (min-width:200px) and (max-width: 480px){
    .diary table {
    border: 0;
  }

  .diary table caption {
    font-size: 1.3em;
  }
  
  .diary table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  .diary table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  .diary table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  .diary table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  .diary table td:last-child {
    border-bottom: 0;
  }
  td.payment-bg{
      background:#ccc !Important;
  }
  .input-group .timepicker{
      width:30%!important;
      float:right !important;
  }
}
</style>
<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> Course Outlines <small></small>        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php //echo $title;     ?>Add New Course Outlines</h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo base_url() ?>teacher/teacherdiary/teacherdiary/create"  id="teacherdiary" name="teacherdiary" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                           
                           <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group <?php
                            if (form_error('date')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                                <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date'); ?>"  />

                            </div>
                          
                            </div>

                         

                            <div class="col-md-3">
                                 <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">

                                <label for="exampleInputEmail1">Classes</label>

                               <?php echo form_dropdown("class",$classlists,'','class="form-control"'); ?>

                            </div>
                            </div>


                            <div class="col-md-3">
                                 <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label for="exampleInputEmail1">Section</label>

                               <?php echo form_dropdown("section",$sectionlists,'','class="form-control"'); ?>

                            </div>

                            </div> 
                           </div>                     
                           
                              <div class="panel-default">
                                  <div class="panel-body">
                              <div class="row clone diary">
                              <table class="table" width="100%">
                                  
                              <thead>
                                <tr>
                                <th scope="col" width="5%">No</th>
                                <th scope="col" width="20%">Subject</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Month</th>
                                  <th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></th>
                                  </tr>
                              </thead>
                              <tbody id="SourceWrapper">
                              <tr class="clonethis">
                              <td data-label="No" class="no">1</td>
                                  <td data-label="Subject">
                                        <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">

                               <?php echo form_dropdown("subject[]",$subjectlists,'','class="form-control"'); ?>

                            </div> 

                                  </td>
                                  <td data-label="Description">
                                      
  <div class="form-group <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?>">
                                <textarea class="form-control" name="description[]" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>

                            </div>
                                  </td>

                                  <td data-label="Month">
                                        <div class="form-group <?php
                            if (form_error('exp_head_id')) {
                                echo 'has-error';
                            }
                            ?>">

                               <?php echo form_dropdown("month[]",$monthlist,'','class="form-control"'); ?>

                            </div> 

                                  </td>
                                  <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i></td>
                              </tr>
                                  
                              </tbody>
                              </table>
                                
                                      
                                
                              </div>
                              </div>
                              </div>

                               
                          
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
        
        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>

        <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/template.js"></script>
