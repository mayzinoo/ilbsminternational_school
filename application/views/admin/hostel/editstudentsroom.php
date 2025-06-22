<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Edit Student's Room <small></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <?=form_open('admin/hostel/studentroom_edit/')?>
                            <input type="hidden" name="studentid" class="form-control" value="<?=$studentroom->student_id ?>">
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>Admission</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Father Name</th>
                                            <th>Hostel Name</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <tr>                              
                                            <td><?=$studentroom->admission_no ?></td>
                                            <td><?=$studentroom->firstname.$studentroom->lastname ?></td>
                                            <td><?php echo $studentroom->class_id?> (<?php echo $studentroom->section_id?>)</td>
                                            <td><?=$studentroom->father_name ?></td>
                                            <td><?=form_dropdown("hostelname",$hostellist,$studentroom->hostel_id,"class='form-control' onchange=hostelroomsearch(this.value,event)")?></td>
                                            <td><select name="roomno" class="form-control" value="<?php echo $studentroom->room_no; ?>">
                                              <option><?php echo $studentroom->room_no; ?></option>
                                            </select></td>
                                            
                                        </tr>    
                                    </tbody>
                                </table>
                            <button type="submit" class="btn btn-success">Update</button>
                            <?=form_close()?>
                                                  
                            
</div>  
                    </div> 
            </div>
        </div>
    </section>
</div>
                                                   
<script type="text/javascript">
                                                            function getSectionByClass(class_id, section_id) {
                                                                if (class_id != "" && section_id != "") {
                                                                    $('#section_id').html("");
                                                                    var base_url = '<?php echo base_url() ?>';
                                                                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: base_url + "sections/getByClass",
                                                                        data: {'class_id': class_id},
                                                                        dataType: "json",
                                                                        success: function (data) {
                                                                            $.each(data, function (i, obj)
                                                                            {
                                                                                var sel = "";
                                                                                if (section_id == obj.section_id) {
                                                                                    sel = "selected";
                                                                                }
                                                                                div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                                                                            });
                                                                            $('#section_id').append(div_data);
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                            $(document).ready(function () {
                                                                var class_id = $('#class_id').val();
                                                                var section_id = '<?php echo set_value('section_id') ?>';
                                                                getSectionByClass(class_id, section_id);
                                                                $(document).on('change', '#class_id', function (e) {
                                                                    $('#section_id').html("");
                                                                    var class_id = $(this).val();
                                                                    var base_url = '<?php echo base_url() ?>';
                                                                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: base_url + "sections/getByClass",
                                                                        data: {'class_id': class_id},
                                                                        dataType: "json",
                                                                        success: function (data) {
                                                                            $.each(data, function (i, obj)
                                                                            {
                                                                                div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                                                                            });
                                                                            $('#section_id').append(div_data);
                                                                        }
                                                                    });
                                                                });
                                                            });
                                                        </script>
<script type="text/javascript">
    function hostelroomsearch(hostelname,arg)
    {
        data="hostelname="+hostelname;
        $.ajax({
                type: "POST",
                url : '<?=base_url()?>'+"admin/hostel/searchhostelroom/",
                data : data,

                success : function(e)
                {
               
                //  var v=JSON.parse(e);
                //  $("#searchresult").html(e);
                $(arg.target).parent().parent().find("select[name='roomno']").html(e);
                }
            });
    }
</script>