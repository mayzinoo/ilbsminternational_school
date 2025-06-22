<?php
        $count = 1;
        $nettotal=0;
        foreach ($resultlist->result() as $list) {
            $total=0;
            $total=$list->price * $list->quantity;
        ?>
        <tr>
            <td><?php   echo $count; ?></td>
            <td><?php echo $list->name; ?></td>
            <td><?php echo $list->quantity; ?></td>
            <td><?php echo $list->price; ?></td>
            <td><?php echo $total ; ?></td>
            <td><?php echo $list->description; ?></td>
            <td><?php echo $list->date; ?></td>
            
            <td>         
                <a href="<?php echo base_url(); ?>Inventory/edit_data/stock/<?php echo $list->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="<?php echo base_url(); ?>Inventory/delete_data/stock/<?php echo $list->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?')";>
                    <i class="fa fa-remove"></i>
                </a>
            </td>
        </tr>
        
        <?php
        $nettotal+=$total;
        $count++;
        }
        ?>
        <tr>
            <th colspan="3" style="text-align:right">Net Total</th> <th></th> <th> <?=$nettotal?> </th>
        </tr>