 <?php
        $count = 1;
        foreach ($resultlist->result() as $list) {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $list->title; ?></td>
            <td><?php echo $list->sale_person; ?></td>
            <td><?php echo $list->date; ?></td>
            
            <td> 
                <a href="<?php echo base_url(); ?>Inventory/view/sale/<?php echo $list->id; ?>" class="btn btn-default btn-xs" target="_blank" data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                    <i class="fa fa-reorder"></i>
                </a>
                <a href="<?php echo base_url(); ?>Inventory/edit_data/sale/<?php echo $list->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="<?php echo base_url(); ?>Inventory/delete_data/sale/<?php echo $list->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                    <i class="fa fa-remove"></i>
                </a>
            </td>
        </tr>
        
        <?php
        $count++;
        }
        ?>