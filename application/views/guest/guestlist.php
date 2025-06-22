<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Info Center</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Guest Lists</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>NRC No</th>
                                <th>Address</th>
                                <th>Class</th>
                                <th>Visitor Card No</th>
                                <th>Remark</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                           </tr>
                        </thead>
                        <?php
                        $i=1;
                        foreach($guestdata->result() as $row):
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->phone; ?></td>
                                <td><?php echo $row->nrcno; ?></td>
                                <td><?php echo $row->address; ?></td>
                                <td><?php echo $row->class; ?></td>
                                <td><?php echo $row->cardno; ?></td>
                                <td><?php echo $row->remark; ?></td>
                                <td><?php echo $row->intime; ?></td>
                                <td><?php echo $row->outtime; ?></td>
                                      </tr>
                        </tbody>
                        <?php 
                        $i++;
                        endforeach; ?>
                    </table>
                </div>
            </div>   <!-- /.row -->
            </div><!--col-md-12-->
        </div><!--row-->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
        $(function(){
        $('.file_input_replacement').click(function(){
            //This will make the element with class file_input_replacement launch the select file dialog.
            var assocInput = $(this).siblings("input[type=file]");
            console.log(assocInput);
            assocInput.click();
        });
        $('.file_input_with_replacement').change(function(){
            //This portion can be used to trigger actions once the file was selected or changed. In this case, if the element triggering the select file dialog is an input, it fills it with the filename
            var thisInput = $(this);
            var assocInput = thisInput.siblings("input.file_input_replacement");
            if (assocInput.length > 0) {
              var filename = (thisInput.val()).replace(/^.*[\\\/]/, '');
              assocInput.val(filename);
            }
        });
    });
</script>