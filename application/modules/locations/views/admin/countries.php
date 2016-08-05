<?php pageHeader(lang('countries')) ?>

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
    $('#countries').sortable({
        scroll: true,
        helper: fixHelper,
        axis: 'y',
        handle:'.handle',
        update: function(){
            save_sortable();
        }
    }); 
    $('#countries').sortable('enable');
}

function save_sortable()
{
    serial=$('#countries').sortable('serialize');
            
    $.ajax({
        url:'<?php echo site_url('admin/locations/organize_countries'); ?>',
        type:'POST',
        data:serial
    });
}
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_country'); ?>');
}
//]]>
</script>

<div class="text-right">
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/country_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_country'); ?></a>
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/locations/zone_form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_zone'); ?></a>
</div>

<table class="pure-table pure-table-horizontal" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th><?php echo lang('sort'); ?></th>
            <th><?php echo lang('name'); ?></th>
            <th><?php echo lang('iso_code_2'); ?></th>
            <th><?php echo lang('iso_code_3'); ?></th>
            <th><?php echo lang('tax'); ?></th>
            <th><?php echo lang('status'); ?></th>
            <th/>
        </tr>
    </thead>
    <tbody id="countries">
<?php foreach ($locations as $location) :?>
        <tr id="country-<?php echo $location->id; ?>">
            <td class="handle"><a class="pure-button pure-button-primary"><span class="fa fa-sort"></span></a></td>
            <td><?php echo  $location->name; ?></td>
            <td><?php echo $location->iso_code_2; ?></td>
            <td><?php echo $location->iso_code_3; ?></td>
            <td><?php echo $location->tax + 0; ?>%</td>
            <td><?php echo ((bool) $location->status) ? 'enabled' : 'disabled'; ?></td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo site_url('admin/locations/country_form/'.$location->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button" href="<?php echo site_url('admin/locations/zones/'.$location->id); ?>"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo site_url('admin/locations/delete_country/'.$location->id); ?>" onclick="return areyousure<();"><i class="fa fa-times " aria-hidden="true"></i></a>
                </div>
            </td>
      </tr>
<?php endforeach; ?>
    </tbody>
</table>
