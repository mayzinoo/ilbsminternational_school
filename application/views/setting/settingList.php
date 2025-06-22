   
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('school'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

   <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">School Setting Lists</h3>
                        <div class="box-tools pull-right">
                        <small class="pull-right"><span data-toggle="modal" data-target="#createschsetting" class="btn btn-primary btn-sm" title="Student Card">
                                                             + Add
                                        </span></small>   
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">School Setting List</div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($settinglistdata->result() as $list) {
                                        ?>
                                        <tr>
                                           
                                        <!--<input type="hidden" name="settingid" value="<?=$list->id?>">-->
                                            <td><?=$list->id?></td>
                                            <td>
                                                <?=$list->name?>
                                            </td>
                                             <td>
                                                <?=$list->email?>
                                            </td>
                                             <td>
                                                <?=$list->phone?>
                                            </td>
                                             <td>
                                                <?=$list->address?>
                                            </td>


                                            <td class="mailbox-date pull-right">
                                                <!--<a href="<?php echo base_url(); ?>Schsettings/editform/<?php echo $list->id;?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">-->
                                                <!--    <i class="fa fa-pencil"></i>-->
                                                <!--</a>-->
                                            <span data-toggle="modal" data-target="#schsetting<?=$list->id?>" class="btn btn-default btn-xs" title="Student Card">
                                                            <i class="fa fa-pencil"></i>
                                        </span> 
<!--create modal start-->
<div id="createschsetting" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create System Setting</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <?=form_open_multipart('Schsettings/schsetting_insert/')?>
                      
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('school_name'); ?></label>

                            <input class="form-control" id="name" name="sch_name" placeholder="" type="text" />
                            <span class="text-danger"><?php echo form_error('name'); ?></span>

                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1">
                                <?php echo $this->lang->line('school_code'); ?></label>

                            <input id="dise_code" name="sch_dise_code" placeholder="" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('dise_code'); ?></span>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>

                            <textarea class="form-control" style="resize: none;" rows="2" id="address" name="sch_address" placeholder=""></textarea>
                            <span class="text-danger"><?php echo form_error('address'); ?></span>

                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>

                            <input class="form-control" id="phone" name="sch_phone" placeholder="" type="text"/>
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>

                            <input class="form-control" id="email" name="sch_email" placeholder="" type="text"/>
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1">Academic Year</label>
                            
                            <?=form_dropdown("sch_session_id",$sessiondata,"","class='form-control'")?>
                            
                            <!--<span class="text-danger"><?php echo form_error('session_id'); ?></span>-->
                        </div>
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('session_start_month'); ?></label>
                            
                            <?=form_dropdown("sch_start_month",$monthList,"","class='form-control'")?>
                            
                        </div>
                        <div class="clearfix"></div>
                      
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('timezone'); ?></label>
                            <?=form_dropdown("sch_timezone",$timezoneList,"","class='form-control'")?>
                            
                            
                            
                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('date_format'); ?></label>
                            <?=form_dropdown("sch_date_format",$dateFormatList,"","class='form-control'")?>
                            
                            
                            
                        </div>
                          <div class="clearfix"></div>
                              <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('currency'); ?></label>
                             <?=form_dropdown("sch_currency",$currencyList,"","class='form-control'")?>

                            
                        </div>
                      
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('currency_symbol'); ?></label>

                            <input id="currency_symbol" name="sch_currency_symbol" placeholder="" type="text" class="form-control"/>
                            <span class="text-danger"><?php echo form_error('currency_symbol'); ?></span>
                        </div>
                       
                        <div class="clearfix"></div>
                        <hr/>
                        

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                           
                            <button type="submit"  class="btn btn-primary">Save</button>
                        </div>


                    </form>                  
                </div>
                <!--logo upload-->
                <div class="row" style="padding-top:10px;">
            <div class="col-md-3">
                <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                        
                        <br/>
                        <br/>
                        <a href="#schsetting" role="button" class="btn btn-primary btn-sm upload_logo" data-toggle="tooltip" title="<?php echo $this->lang->line('edit_logo'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-picture-o"></i> Upload Logo</a>
                 
            </div><!--./col-md-3-->
            </div>
            </div><!--end modal body-->
            
        </div>
    </div>
</div>
<!--model start-->
<div id="schsetting<?=$list->id?>" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('system_settings'); ?></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <?=form_open_multipart('Schsettings/editsetting/')?>
                        <!--<input type="hidden" name="sch_id" value="0">-->
                        <input type="hidden" name="sch_id" value="<?=$list->id?>">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('school_name'); ?></label>

                            <input class="form-control" id="name" name="sch_name" placeholder="" type="text" value="<?=$list->name?>"  />
                            <span class="text-danger"><?php echo form_error('name'); ?></span>

                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1">
                                <?php echo $this->lang->line('school_code'); ?></label>

                            <input id="dise_code" name="sch_dise_code" placeholder="" type="text" class="form-control" value="<?=$list->dise_code ?>" />
                            <span class="text-danger"><?php echo form_error('dise_code'); ?></span>
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>

                            <textarea class="form-control" style="resize: none;" rows="2" id="address" name="sch_address" placeholder=""><?php echo $list->address;?></textarea>
                            <span class="text-danger"><?php echo form_error('address'); ?></span>

                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>

                            <input class="form-control" id="phone" name="sch_phone" placeholder="" type="text" value="<?=$list->phone?>" />
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>

                            <input class="form-control" id="email" name="sch_email" placeholder="" type="text" value="<?=$list->email?>"/>
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1">Academic Year</label>
                            
                            <?=form_dropdown("sch_session_id",$sessiondata,$list->session_id,"class='form-control'")?>
                            
                            <!--<span class="text-danger"><?php echo form_error('session_id'); ?></span>-->
                        </div>
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('session_start_month'); ?></label>
                            
                            <?=form_dropdown("sch_start_month",$monthList,$list->start_month,"class='form-control'")?>
                            
                        </div>
                        <div class="clearfix"></div>

                        <!--<div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">-->
                        <!--    <label for="exampleInputEmail1"><?php echo $this->lang->line('language'); ?></label>-->

                        <!--    <?=form_dropdown("sch_lang_id",$languagedata,$list->lang_id,"class='form-control'")?>-->

                            
                        <!--</div>  -->
                        

  <!--<div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">-->
  <!--                          <label for="IsSmallBusiness"><?php echo $this->lang->line('language_rtl_text_mode'); ?></label>-->
  <!--                          <div class="clearfix"></div>-->
  <!--                          <label class="radio-inline">-->
  <!--                              <input type="radio" name="sch_is_rtl" value="disabled" <?=($list->is_rtl==disabled ? 'checked="checked"' : "")?>><?php echo $this->lang->line('disabled'); ?>-->
  <!--                          </label>-->
  <!--                          <label class="radio-inline">-->
  <!--                              <input type="radio" name="sch_is_rtl" value="enabled" <?=($list->is_rtl==enabled ? 'checked="checked"' : "")?>><?php echo $this->lang->line('enabled'); ?>-->
  <!--                          </label>-->
  <!--                      </div>-->

                        <div class="clearfix"></div>    

                      
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('timezone'); ?></label>
                            <?=form_dropdown("sch_timezone",$timezoneList,$list->timezone,"class='form-control'")?>
                            
                            
                            
                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('date_format'); ?></label>
                            <?=form_dropdown("sch_date_format",$dateFormatList,$list->date_format,"class='form-control'")?>
                            
                            
                            
                        </div>
                          <div class="clearfix"></div>
                              <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('currency'); ?></label>
                             <?=form_dropdown("sch_currency",$currencyList,$list->currency,"class='form-control'")?>

                            
                        </div>
                      
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('currency_symbol'); ?></label>

                            <input id="currency_symbol" name="sch_currency_symbol" placeholder="" type="text" class="form-control" value="<?=$list->currency_symbol?>" />
                            <span class="text-danger"><?php echo form_error('currency_symbol'); ?></span>
                        </div>
                       
                        <div class="clearfix"></div>
                        <hr/>
                        

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                            <!--<button type="button" class="btn btn-primary submit_schsetting pull-right" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('save'); ?></button>-->
                            <button type="submit"  class="btn btn-primary">Save changes</button>
                        </div>


                    </form>                  
                </div>
                <!--logo upload-->
                <div class="row" style="padding-top:10px;">
            <div class="col-md-3">
                
                        <?php
                        if ($settinglist[0]['image'] == "") {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                            <?php
                        }
                        ?>
                        <br/>
                        <br/>
                        <a href="#schsetting" role="button" class="btn btn-primary btn-sm upload_logo" data-toggle="tooltip" title="<?php echo $this->lang->line('edit_logo'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-picture-o"></i> <?php echo $this->lang->line('edit_logo'); ?></a>
                 
            </div><!--./col-md-3-->
            </div>
            </div><!--end modal body-->
            
        </div>
    </div>
</div><!--end modal-->                                                
                                                
                                                <a href="<?php echo base_url(); ?>Schsettings/delete/<?php echo $list->id;?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>

            </div>

        </div>

    </section>
</div>
<!--old end-->
<div class="modal fade" id="modal-uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('edit_logo'); ?></h4>
            </div>
            <div class="modal-body">
                <!-- ==== -->
                <form class="box_upload boxupload" method="post" action="<?php echo site_url('schsettings/ajax_editlogo') ?>" enctype="multipart/form-data">

                    <div class="box__input">
                        <i class="fa fa-download box__icon"></i>

                        <input class="box__file" type="file" name="file" id="file"/>
                        <input value="<?php echo $settinglist[0]['id'] ?>" type="hidden" name="id" id="id"/>
                        <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
                        <button class="box__button" type="submit">Upload</button>
                    </div>
                    <div class="box__uploading">Uploading&hellip;</div>

                </form>
 </div>

        </div>
    </div>
</div><!--end logo modal body-->

<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
    $('.upload_logo').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.button('loading');
        
        $('#modal-uploadfile').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    });
// set focus when modal is opened
    $('#modal-uploadfile').on('shown.bs.modal', function () {
        $('.upload_logo').button('reset');
    });
    
</script>



<script type="text/javascript">
    // feature detection for drag&drop upload
    var isAdvancedUpload = function ()
    {
        var div = document.createElement('div');
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
    }();


    // applying the effect for every form
    var forms = document.querySelectorAll('.box_upload');
    Array.prototype.forEach.call(forms, function (form)
    {
        var input = form.querySelector('input[type="file"]'),
                label = form.querySelector('label'),
                errorMsg = form.querySelector('.box__error span'),
                restart = form.querySelectorAll('.box__restart'),
                droppedFiles = false,
                showFiles = function (files)
                {
                    // label.textContent = files.length > 1 ? ( input.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name;
                },
                showErrors = function (files)
                {

                    toastr.error(files);
                },
                showSuccess = function (msg)
                {

                    toastr.success(msg);
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 2000);
                },
                triggerFormSubmit = function ()
                {
                    var event = document.createEvent('HTMLEvents');
                    event.initEvent('submit', true, false);
                    form.dispatchEvent(event);
                };

        // letting the server side to know we are going to make an Ajax request
        var ajaxFlag = document.createElement('input');
        ajaxFlag.setAttribute('type', 'hidden');
        ajaxFlag.setAttribute('name', 'ajax');
        ajaxFlag.setAttribute('value', 1);
        form.appendChild(ajaxFlag);

        // automatically submit the form on file select
        input.addEventListener('change', function (e)
        {
            showFiles(e.target.files);


            triggerFormSubmit();


        });

        // drag&drop files if the feature is available
        if (isAdvancedUpload)
        {
            form.classList.add('has-advanced-upload'); // letting the CSS part to know drag&drop is supported by the browser

            ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function (event)
            {
                form.addEventListener(event, function (e)
                {
                    // preventing the unwanted behaviours
                    e.preventDefault();
                    e.stopPropagation();
                });
            });
            ['dragover', 'dragenter'].forEach(function (event)
            {
                form.addEventListener(event, function ()
                {
                    form.classList.add('is-dragover');
                });
            });
            ['dragleave', 'dragend', 'drop'].forEach(function (event)
            {
                form.addEventListener(event, function ()
                {
                    form.classList.remove('is-dragover');
                });
            });
            form.addEventListener('drop', function (e)
            {
                droppedFiles = e.dataTransfer.files; // the files that were dropped
                showFiles(droppedFiles);


                triggerFormSubmit();

            });
        }


        // if the form was submitted
        form.addEventListener('submit', function (e)
        {
            // preventing the duplicate submissions if the current one is in progress
            if (form.classList.contains('is-uploading'))
                return false;

            form.classList.add('is-uploading');
            form.classList.remove('is-error');

            if (isAdvancedUpload) // ajax file upload for modern browsers
            {
                e.preventDefault();

                // gathering the form data
                var ajaxData = new FormData(form);
                if (droppedFiles)
                {
                    Array.prototype.forEach.call(droppedFiles, function (file)
                    {
                        ajaxData.append(input.getAttribute('name'), file);
                    });
                }

                // ajax request
                var ajax = new XMLHttpRequest();
                ajax.open(form.getAttribute('method'), form.getAttribute('action'), true);

                ajax.onload = function ()
                {
                    form.classList.remove('is-uploading');
                    if (ajax.status >= 200 && ajax.status < 400)
                    {
                        var data = JSON.parse(ajax.responseText);
                        if (data.success) {
                            var sucmsg = "Record updated Successfully";
                            showSuccess(sucmsg);
                        }
                        // form.classList.add( data.success == true ? 'is-success' : 'is-error' );
                        if (!data.success) {
                            var message = "";
                            $.each(data.error, function (index, value) {

                                message += value;
                            });
                            showErrors(message);
                        }
                        ;
                    } else
                        alert('Error. Please, contact the webmaster!');
                };

                ajax.onerror = function ()
                {
                    form.classList.remove('is-uploading');
                    alert('Error. Please, try again!');
                };

                ajax.send(ajaxData);
            } else // fallback Ajax solution upload for older browsers
            {
                var iframeName = 'uploadiframe' + new Date().getTime(),
                        iframe = document.createElement('iframe');

                $iframe = $('<iframe name="' + iframeName + '" style="display: none;"></iframe>');

                iframe.setAttribute('name', iframeName);
                iframe.style.display = 'none';

                document.body.appendChild(iframe);
                form.setAttribute('target', iframeName);

                iframe.addEventListener('load', function ()
                {
                    var data = JSON.parse(iframe.contentDocument.body.innerHTML);
                    form.classList.remove('is-uploading')
                    //  form.classList.add( data.success == true ? 'is-success' : 'is-error' )
                    form.removeAttribute('target');
                    if (!data.success)
                        errorMsg.textContent = data.error;
                    iframe.parentNode.removeChild(iframe);
                });
            }
        });


        // restart the form if has a state of error/success
        Array.prototype.forEach.call(restart, function (entry)
        {
            entry.addEventListener('click', function (e)
            {
                e.preventDefault();
                //  form.classList.remove( 'is-error', 'is-success' );
                input.click();
            });
        });

        // Firefox focus bug fix for file input
        input.addEventListener('focus', function () {
            input.classList.add('has-focus');
        });
        input.addEventListener('blur', function () {
            input.classList.remove('has-focus');
        });

    });


</script>
