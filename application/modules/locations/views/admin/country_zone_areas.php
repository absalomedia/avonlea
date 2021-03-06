<?php pageHeader(sprintf(lang('zone_areas_for'), $zone->name)); ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_zone_area'); ?>');
}
</script>

<div class="text-right">
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/country_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_country'); ?></a>
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/zone_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_zone'); ?></a>
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/zone_area_form/'.$zone->id); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_zone_area'); ?></a>
</div>

<table class="pure-table pure-table-horizontal" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th><?php echo lang('code'); ?></th>
            <th><?php echo lang('tax'); ?></th>
            <th/>
        </tr>
    </thead>
    <tbody>
<?php foreach ($areas as $location) :?>
        <tr>
            <td><?php echo $location->code; ?></td>
            <td><?php echo $location->tax + 0; ?>%</td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo  site_url('admin/locations/zone_area_form/'.$zone->id.'/'.$location->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo  site_url('admin/locations/delete_zone_area/'.$location->id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                </div>
            </td>
      </tr>
<?php endforeach; ?>
<?php if (count($areas) === 0) :?>
        <tr>
            <td colspan="3">
                <?php echo lang('no_zone_areas'); ?>
            </td>
        </tr>
<?php endif; ?>
    </tbody>
</table>
