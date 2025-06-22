<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> <?php echo $this->lang->line('library_book'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
						<div class="download_label"><?php echo $this->lang->line('library_book'); ?></div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <ul class="nav nav-tabs">
<li class="active"><a href="<?php echo base_url(); ?>parent/book"><i class="fa fa-list"></i> စာအုပ္မ်ား </a></li>

<!--<li class="active"><a href="<?php echo base_url(); ?>admin/member/issue/<?=$memberList->lib_member_id?>" ><i class="fa fa-list"></i>  <h3 class="box-title titlefix"><?php echo $this->lang->line('book_issued'); ?> (ငွားေသာ စာအုပ္မ်ား)</h3></a></li>-->
<li ><a href="<?php echo base_url(); ?>parent/book/returned/<?=$memberList->lib_member_id?>" ><i class="fa fa-newspaper-o"></i> ဖတ္ျပီး စာအုပ္မ်ား</a></li>
</ul>
                                            
                                      
                                      </th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($listbook)) {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($listbook as $book) {
                                            ?>
                                            <tr>
                                                
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $count." . ".$book['book_title'] ?></a>
                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($book['description'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $book['description']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                     <p class="text-left"><?php echo $book['author'] ?></p>
                                                </td>
                                              
                                              
                                               
                                            </tr>
                                            <?php
                                                                                    $count++;

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
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