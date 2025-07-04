<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport_routes'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php
                        foreach ($childs as $each_child_key => $each_child_value) {
                            $act = "";
                            if ($each_child_key == 0) {
                                $act = "active";
                            }
                            ?>
                            <li class="<?php echo $act; ?>"><a href="#tab_1-<?php echo $each_child_value['student_session_id']; ?>" data-toggle="tab"><?php echo $each_child_value['firstname'] . " " . $each_child_value['lastname']; ?></a></li>
                            <?php
                        }
                        ?>


                    </ul>
                    <div class="tab-content">
                        <?php
                        foreach ($childs as $each_child_key => $each_child_value) {
                            $student_route = $each_child_value['vehroute_id'];
                            $act = "";
                            if ($each_child_key == 0) {
                                $act = "active";
                            }
                            ?>

                            <div class="tab-pane <?php echo $act; ?>" id="tab_1-<?php echo $each_child_value['student_session_id']; ?>">
                                <div class="table-responsive mailbox-messages">
								<div class="download_label"><?php echo $this->lang->line('route_title'); ?></div>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('route_title'); ?>
                                                </th>

                                                <th class=""><?php echo $this->lang->line('vehicle'); ?>
                                                </th>
                                                <th class="">Driver's Name
                                                </th>
                                                <th>Driver's Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($listroute)) {
                                                ?>
                                                <tr>
                                                    <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                </tr>
                                                <?php
                                            } else { ?>
                                                <tr>
                                                <td><?php echo $sturoute->route_title; ?></td>
                                                <td><a href="#">
                                                                <i class="fa fa-bus"></i>&nbsp;&nbsp;<?php echo $sturoute->vehicle_no; ?></a></td>
                                                <td><?php echo $sturoute->driver_name; ?></td>
                                                <td><?php echo $sturoute->driver_contact; ?></td>
                                            </tr>
                                       <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>  
</div>
<div class="row">           
    <div class="col-md-12">
    </div>
</div>
</section>
</div>


<div id="busDetailModal"  class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    var base_url = '<?php echo base_url() ?>';
    $(document).on('click', '#bus_allot', function () {
        $('.modal-title').html("");
        $('.modal-body').html("");
        var vehrouteid = $(this).data('vehrouteid');

        $('.modal-title').html("Vehicle Detail");
        $.ajax({
            type: "POST",
            url: base_url + "parent/route/getbusdetail",
            data: {'vehrouteid': vehrouteid},
            dataType: "json",
            success: function (response) {

                var data = "";
                data += '<div class="row">';
                data += '<div class="col-md-12">';
                data += '<div class="lead text text-center"><b>Route: ' + response.route_title + '</b></div>';
                data += '<table class="table table-striped table-hover">';
                data += '<tbody>';
                data += '<tr>';
                data += '<td>Vehicle no:</td>';
                data += '<td>' + response.vehicle_no + '</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<td>Vehicle model:</td>';
                data += '<td>' + response.vehicle_model + '</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<td>Made</td>';
                data += '<td>' + response.manufacture_year + '</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<td>Driver Name</td>';
                data += '<td>' + response.driver_name + '</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<td>Driver Licence</td>';
                data += '<td>' + response.driver_licence + '</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<td>Driver Contact</td>';
                data += '<td>' + response.driver_contact + '</td>';
                data += '</tr>';
                data += '</tbody>';
                data += '</table>';
                data += '</div>';
                data += '</div>';

                $('.modal-body').html(data);
                $("#busDetailModal").modal('show');
            }
        });
    });
</script>


<script type="text/javascript">
                    $("#coverScreen").hide();

               </script>