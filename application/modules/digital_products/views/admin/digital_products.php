<?php pageHeader(lang('dgtl_pr_header')); ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_file'); ?>');
}
</script>

<a class="pure-button pure-button-primary" style="float:right;" href="<?php echo site_url('admin/digital_products/form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_file'); ?></a>


<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th><?php echo lang('filename'); ?></th>
            <th><?php echo lang('title'); ?></th>
            <th><?php echo lang('size'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php echo (count($file_list) < 1) ? '<tr><td style="text-align:center;" colspan="4">'.lang('no_files').'</td></tr>' : ''?>
    <?php foreach ($file_list as $file) :?>
        <tr>
            <td><?php echo $file->filename; ?></td>
            <td><?php echo $file->title; ?></td>
            <td><?php echo $file->size; ?> kb</td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo  site_url('admin/digital_products/form/'.$file->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button pure-button-primary btn-danger" href="<?php echo  site_url('admin/digital_products/delete/'.$file->id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
