<div class="content-wrapper" style="min-height: 946px;">   
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i>  <?php echo $this->lang->line('library'); ?>
        </h1>
    </section>  
    <section class="content">
        <div class="row">         
          
            <div class="col-md-12">
                
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                    
 <ul class="nav nav-tabs">
<li><a href="<?php echo base_url(); ?>parent/book"><i class="fa fa-list"></i> စာအုပ္မ်ား </a></li>

<!--<li class="active"><a href="<?php echo base_url(); ?>admin/member/issue/<?=$memberList->lib_member_id?>" ><i class="fa fa-list"></i>  <h3 class="box-title titlefix"><?php echo $this->lang->line('book_issued'); ?> (ငွားေသာ စာအုပ္မ်ား)</h3></a></li>-->
<li class="active" ><a href="<?php echo base_url(); ?>parent/book/returned/<?=$memberList->lib_member_id?>" ><i class="fa fa-newspaper-o"></i> ဖတ္ျပီး စာအုပ္မ်ား</a></li>
</ul>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">                            
                        <div class="table-responsive">
						<div class="download_label"><?php echo $this->lang->line('book_issued'); ?></div>
                            <table class="table table-striped table-bordered table-hover">
                               
                                <tbody>

                                    <?php
                                    $count = 1;
                                    foreach ($issued_books as $book) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#" data-toggle="popover" class="detail_popover">
                                                <?php
                                                echo $book['book_title'];                ?>
                                                </a>
                                                <br/>
                                                Issue Date :  <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['issue_date'])) ?>
                                                 
                                                 <br/>
                                                 Return Date : <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['return_date'])) ?>
                                                  
                                            </td>
                                            
                                           
                                           
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->

                    </div><!-- /.box-body -->

                    </form>
                </div> 
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $(".date").datepicker({
            // format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true,
            todayHighlight: true

        });
    });
</script>