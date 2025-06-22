<div class="content-wrapper" style="min-height: 946px;">    
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <section class="col-md-12 content" >
            <div class="box box-primary" style="padding-top:10px;">
            <?=form_open_multipart('Schsettings/editsetting/')?>
                <div class="form-group col-md-6">
                    <label>School Name</label>
                    <input type="text" class="form-control" name="sch_name" value="<?=$settinglist->school_name?>">
                </div>
                <div class="form-group col-md-6">
                    <label>School Code</label>
                    <input type="text" class="form-control" name="sch_code" value="<?=$settinglist->school_name?>">
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>

                            <textarea class="form-control" style="resize: none;" rows="2" id="address" name="sch_address" placeholder=""></textarea>
                            <span class="text-danger"><?php echo form_error('address'); ?></span>

                </div>
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
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?></label>

                    <select  id="session_id" name="sch_session_id" class="form-control" >
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        <?php
                        foreach ($sessionlist as $session) {
                            ?>
                            <option value="<?php echo $session['id'] ?>"><?php echo $session['session'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('session_id'); ?></span>
                </div>
                <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('session_start_month'); ?></label>

                    <select  id="start_month" name="sch_start_month" class="form-control" >
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        <?php
                        foreach ($monthList as $key => $month) {
                            ?>
                            <option value="<?php echo $key ?>"><?php echo $month ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('session_id'); ?></span>
                </div>
                <div class="clearfix"></div>

                <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('language'); ?></label>

                    <select  id="language_id" name="sch_lang_id" class="form-control" >
                        <option value="">--Select--</option>
                        <?php
                        foreach ($languagelist as $language) {
                            ?>
                            <option value="<?php echo $language['id'] ?>"><?php echo $language['language'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('language_id'); ?></span>
                </div>  
                        

  <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="IsSmallBusiness"><?php echo $this->lang->line('language_rtl_text_mode'); ?></label>
                            <div class="clearfix"></div>
                            <label class="radio-inline">
                                <input type="radio" name="sch_is_rtl" value="disabled" ><?php echo $this->lang->line('disabled'); ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sch_is_rtl" value="enabled"><?php echo $this->lang->line('enabled'); ?>
                            </label>
                        </div>

                        <div class="clearfix"></div>    

                      
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('timezone'); ?></label>

                            <select  id="language_id" name="sch_timezone" class="form-control" >
                                <option value="">--Select--</option>
                                <?php
                                foreach ($timezoneList as $key => $timezone) {
                                    ?>
                                    <option value="<?php echo $key ?>" ><?php echo $timezone ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('timezone'); ?></span>
                        </div>

                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('date_format'); ?></label>

                            <select  id="date_format" name="sch_date_format" class="form-control" >
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <?php
                                foreach ($dateFormatList as $key => $dateformat) {
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $dateformat; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('date_format'); ?></span>
                        </div>
                          <div class="clearfix"></div>
                              <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('currency'); ?></label>


                            <select  id="currency" name="sch_currency" class="form-control" >
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <?php
                                foreach ($currencyList as $currency) {
                                    ?>
                                    <option value="<?php echo $currency ?>"><?php echo $currency; ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('currency'); ?></span>
                        </div>
                      
                        <div class="form-group  col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('currency_symbol'); ?></label>

                            <input id="currency_symbol" name="sch_currency_symbol" placeholder="" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('currency_symbol'); ?></span>
                        </div>
                       
                        <div class="clearfix"></div>
                        <hr/>
                        

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                            <button type="button" class="btn btn-primary submit_schsetting pull-right" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('save'); ?></button>
                        </div>
            <?=form_close()?> 
            </div>
            
            <!--</div>-->
        </section>
    </section>
    
</div>

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


    $('.edit_setting').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.button('loading');
        $.ajax({
            url: base_url + '/schsettings/getSchsetting',
            type: 'POST',
            data: {},
            dataType: "json",
            success: function (result) {
                $('input[name="sch_id"]').val(result.id);
                $('input[name="sch_name"]').val(result.name);
                $('input[name="sch_dise_code"]').val(result.dise_code);
                $('input[name="sch_phone"]').val(result.phone);
                $('input[name="sch_email"]').val(result.email);
                $('input[name="sch_currency_symbol"]').val(result.currency_symbol);
                $('textarea[name="sch_address"]').text(result.address);
                $("input[name=sch_is_rtl][value=" + result.is_rtl + "]").attr('checked', 'checked');
                $("input[name=theme][value='" + result.theme + "']").attr('checked', 'checked');
                $('select[name="sch_session_id"] option[value="' + result.session_id + '"]').attr("selected", "selected");
                $('select[name="sch_start_month"] option[value="' + result.start_month + '"]').attr("selected", "selected");
                $('select[name="sch_lang_id"] option[value="' + result.lang_id + '"]').attr("selected", "selected");
                $('select[name="sch_timezone"] option[value="' + result.timezone + '"]').attr("selected", "selected");
                $('select[name="sch_date_format"] option[value="' + result.date_format + '"]').attr("selected", "selected");
                $('select[name="sch_currency"] option[value="' + result.currency + '"]').attr("selected", "selected");

                $('#schsetting').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });
            },
            error: function () {
                console.log("error on form");
            }

        }).done(function () {
            $this.button('reset');
        });

    });


    $(document).on('click', '.submit_schsetting', function (e) {
        var $this = $(this);
        $this.button('loading');
        $.ajax({
            url: '<?php echo site_url("schsettings/ajax_schedit") ?>',
            type: 'post',
            data: $('#schsetting_form').serialize(),
            dataType: 'json',
            success: function (data) {

                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    window.location.reload(true);
                }

                $this.button('reset');
            }
        });
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