<?php pageHeader(lang('banners')); ?>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
    create_sortable();
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};
function create_sortable()
{
    $('#banners_sortable').sortable({
        scroll: true,
        helper: fixHelper,
        axis: 'y',
        handle:'.handle',
        update: function(){
            save_sortable();
        }
    });
    $('#banners_sortable').sortable('enable');
}

function save_sortable()
{
    serial=$('#banners_sortable').sortable('serialize');

    $.ajax({
        url:'<?php echo site_url('admin/banners/organize'); ?>',
        type:'POST',
        data:serial
    });
}
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_banner'); ?>');
}
//]]>
</script>

<div class="text-right">
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/banners/banner_form/'.$banner_collection_id); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_banner'); ?></a>
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/banners/'); ?>"><?php echo lang('banner_collections'); ?></a>
</div>

<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th><?php echo lang('sort'); ?></th>
            <th><?php echo lang('name'); ?></th>
            <th><?php echo lang('enable_date'); ?></th>
            <th><?php echo lang('disable_date'); ?></th>
            <th></th>
        </tr>
    </thead>
    <?php echo (count($banners) < 1) ? '<tr><td style="text-align:center;" colspan="5">'.lang('no_banners').'</td></tr>' : ''?>
    <?php if ($banners) : ?>
    <tbody id="banners_sortable">
    <?php

    foreach ($banners as $banner) :
        $disabled = '';
        $enableOn = ($banner->enable_date === '0000-00-00') ? '' : date('m/d/y', strtotime($banner->enable_date));
        $disableOn = ($banner->disable_date === '0000-00-00') ? '' : date('m/d/y', strtotime($banner->disable_date));

        if ((!empty($enableOn) && strtotime($banner->enable_date) > time()) ||
            (!empty($disableOn) && strtotime($banner->disable_date) < time())) {
            $disabled = ' style="opacity:.6;"';
        }

        ?>
        <tr id="banners-<?php echo $banner->banner_id; ?>"<?php echo $disabled; ?>>
            <td class="handle"><a class="pure-button pure-button-primary"><span class="fa fa-sort"></span></a></td>
            <td><?php echo $banner->name; ?></td>
            <td><?php echo $enableOn; ?></td>
            <td><?php echo $disableOn; ?></td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo site_url('admin/banners/banner_form/'.$banner_collection_id.'/'.$banner->banner_id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo  site_url('admin/banners/delete_banner/'.$banner->banner_id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                </div>
            </td>
        </tr>
    <?php                                                                                                                                                                                                                     endforeach; ?>
    </tbody>
    <?php endif; ?>
</table>
