<?php pageHeader(lang('categories')); ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_category'); ?>');
}
</script>

<div style="text-align:right">
    <a class="btn btn-primary" href="<?php echo site_url('admin/categories/form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_category'); ?></a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th><i class="fa fa-eye-slash" aria-hidden="true"></i></th>
            <th><?php echo lang('name')?></th>
            <?php foreach ($groups as $group) :?>
                <th><?php echo $group->name; ?></th>
            <?php endforeach; ?>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php echo (count($categories) < 1) ? '<tr><td style="text-align:center;" colspan="4">'.lang('no_categories').'</td></tr>' : ''?>
        <?php
        function listCategories($parent_id, $cats, $groups, $sub = '', $hidden = false)
        {
            foreach ($cats[$parent_id] as $cat) :?>
            <tr>
                <td><?php echo ($hidden) ? '<i class="fa fa-eye-slash" aria-hidden="true"></i>' : '';
            ?></td>
                <td><?php echo $sub.$cat->name;
            ?></td>
                <?php foreach ($groups as $group) :?>
                    <td><?php echo ($cat->{'enabled'.$group->id} === '1') ? lang('enabled') : lang('disabled');
            ?></td>
                <?php endforeach;
            ?>
                <td class="text-right">
                    <div class="btn-group">
                        <a class="btn btn-default" href="<?php echo  site_url('admin/categories/form/'.$cat->id);
            ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a class="btn btn-danger" href="<?php echo  site_url('admin/categories/delete/'.$cat->id);
            ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                    </div>
                </td>
            </tr>
            <?php
            if (isset($cats[$cat->id]) && count($cats[$cat->id]) > 0) {
                $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
                $sub2 .= '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
                listCategories($cat->id, $cats, $groups, $sub2, $hidden);
            }
            endforeach;
        }

        if (isset($categories[-1])) {
            listCategories(-1, $categories, $groups, '', true);
        }

        if (isset($categories[0])) {
            listCategories(0, $categories, $groups);
        }

        ?>
    </tbody>
</table>
