<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
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
                        <h3 class="box-title">Add New Expense Form</h3>
                    </div> 
                    <form id="form1" action="<?php echo site_url('Inventory/create_expense') ?>" name="employeeform" method="post" accept-charset="utf-8"  >
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
      
      <th width="5%" style="text-align:center !important;"><i class="fa fa-plus btn btn-success" onclick="clonerow()"></i></th>
      </tr>
  </thead>
  <tbody id="SourceWrapper">
  <tr class="clonethis">
  <td class="no">1</td>
   <td>
            <div class="form-group <?php
            if (form_error('date[]')) {
                echo 'has-error';
            }
            ?>">
            
               <?php echo form_input("date[]",date("Y-m-d"),'class="form-control" id="start_date"'); ?>
            
            </div> 
      </td>
      <td>
            <div class="form-group <?php
if (form_error('item_name[]')) {
    echo 'has-error';
}
?>">

   <?php echo form_dropdown("item_name[]",$itemlist,'','class="form-control" onchange="getPrice(this.value,event)"'); ?>

</div> 

      </td>
      
       <td>
            <div class="form-group <?php
if (form_error('quantity[]')) {
    echo 'has-error';
}
?>">

   <?php echo form_input("quantity[]",'','class="form-control" onkeyup="calculateTotal(this.value,event)" '); ?>

</div> 

      </td>
      
      <td>
            <div class="form-group <?php
if (form_error('price[]')) {
    echo 'has-error';
}
?>">

   <?php echo form_input("price[]",'','class="form-control" readonly'); ?>

</div> 

      </td>
      
      <td>
            <div class="form-group <?php
if (form_error('total[]')) {
    echo 'has-error';
}
?>">

   <?php echo form_input("total[]",'','class="form-control" readonly'); ?>

</div> 

      </td>
      
      <td>
          
<div class="form-group <?php
if (form_error('description[]')) {
    echo 'has-error';
}
?>">
    <textarea class="form-control" name="description[]" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description[]'); ?></textarea>

</div>
      </td>
      
     
      <td align="center" width="5%"><i class="fa fa-trash" onclick="removerform(event)"></i>
      </td>
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

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>
