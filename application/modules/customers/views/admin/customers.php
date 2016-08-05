<div class="page-header">
    <h1><?php echo lang('customers'); ?></h1>
</div>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_customer'); ?>');
}
</script>
<div class="btn-group pull-right">
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/customers/export'); ?>"><i class="fa fa-download" aria-hidden="true"></i> <?php echo lang('export'); ?></a>
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/customers/form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_customer'); ?></a>
</div>

<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <?php
            foreach (['lastname', 'firstname', 'email', 'active'] as $thead) {
                $url = 'admin/customers/'.$thead.'/';
                $icon = '';
                if ($field === $thead) {
                    $icon = ' <i class="fa fa-chevron-down" aria-hidden="true"></i>';

                    if ($by === 'ASC') {
                        $url .= 'DESC/';
                        $icon = ' <i class="fa fa-chevron-up" aria-hidden="true"></i>';
                    } else {
                        $url .= 'ASC/';
                    }
                } else {
                    $url .= 'ASC/';
                }
                $url .= $page;

                echo '<th><a href="'.site_url($url).'">'.lang($thead).$icon.'</a></th>';
            }
            ?>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $page_links = CI::pagination()->create_links();

        if ($page_links != '') :?>
        <tr><td colspan="5" style="text-align:center"><?php echo $page_links; ?></td></tr>
        <?php                                                                                                                                                                                                                 endif; ?>
        <?php echo (count($customers) < 1) ? '<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>' : ''?>
<?php foreach ($customers as $customer) :?>
        <tr>
            <?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
            <td><?php echo  $customer->lastname; ?></td>
            <td class="gc_cell_left"><?php echo  $customer->firstname; ?></td>
            <td><a href="mailto:<?php echo  $customer->email; ?>"><?php echo  $customer->email; ?></a></td>
            <td>
                <?php if ($customer->active === 1) {
            echo 'Yes';
        } else {
            echo 'No';
        }
                ?>
            </td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo site_url('admin/customers/form/'.$customer->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button" href="<?php echo site_url('admin/customers/addresses/'.$customer->id); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo site_url('admin/customers/delete/'.$customer->id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                </div>
            </td>
        </tr>
<?php endforeach;
if ($page_links != '') :?>
        <tr><td colspan="5" style="text-align:center"><?php echo $page_links; ?></td></tr>
        <?php         endif; ?>
    </tbody>
</table>
