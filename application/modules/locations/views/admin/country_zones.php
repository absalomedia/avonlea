<?php pageHeader(sprintf(lang('country_zones'), $country->name)); ?>
<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_zone'); ?>');
}
</script>

<div class="text-right">
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/country_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_country'); ?></a>
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/zone_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_zone'); ?></a>
</div>

<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th><?php echo lang('name'); ?></th>
            <th><?php echo lang('code'); ?></th>
            <th><?php echo lang('tax'); ?></th>
            <th><?php echo lang('status'); ?></th>
            <th/>
        </tr>
    </thead>
    <tbody>
<?php foreach ($zones as $location) :?>
        <tr>
            <td class="gc_cell_left"><?php echo  $location->name; ?></td>
            <td><?php echo $location->code; ?></td>
            <td><?php echo $location->tax + 0; ?>%</td>
            <td><?php echo ((bool) $location->status) ? 'enabled' : 'disabled'; ?></td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo site_url('admin/locations/zone_form/'.$location->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button" href="<?php echo site_url('admin/locations/zone_areas/'.$location->id); ?>"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo site_url('admin/locations/delete_zone/'.$location->id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                </div>
            </td>
      </tr>
<?php endforeach; ?>
    </tbody>
</table>
