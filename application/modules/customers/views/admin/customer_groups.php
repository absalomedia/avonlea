<?php pageHeader(lang('customer_groups')); ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_group'); ?>');
}

</script>

<a class="pure-button pure-button-primary" style="float:right;" href="<?php echo site_url('admin/customers/group_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_group'); ?></a>
    
<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th><?php echo lang('group_name'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    
    <?php foreach ($groups as $group) :?>
    <tr>
        <td><?php echo $group->name; ?></td>
        <td class="text-right">
            <div class="btn-group">
                <a class="pure-button" href="<?php echo site_url('admin/customers/group_form/'.$group->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <?php if ($group->id != 1) : ?>
                <a class="pure-button button-danger" href="<?php echo site_url('admin/customers/delete_group/'.$group->id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
