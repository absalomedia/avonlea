<?php pageHeader(lang('addresses')); ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_deleteAddress'); ?>');
}
</script>

<a class="pure-button pure-button-primary" style="float:right;"href="<?php echo site_url('admin/customers/address_form/'.$customer->id); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_address'); ?></a>
<table class="table">
    <thead>
        <tr>
            <th><?php echo lang('name'); ?></th>
            <th><?php echo lang('contact'); ?></th>
            <th><?php echo lang('address'); ?></th>
            <th><?php echo lang('locality'); ?></th>
            <th><?php echo lang('country'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php echo (count($addresses) < 1) ? '<tr><td style="text-align:center;" colspan="6">'.lang('no_addresses').'</td></tr>' : ''?>
<?php foreach ($addresses as $address) :?>
        <tr>
            <td>
                <?php echo $address['lastname']; ?>, <?php echo $address['firstname']; ?>
                <?php echo (!empty($address['company'])) ? '<br/>'.$address['company'] : ''; ?>
            </td>

            <td>
                <?php echo  $address['phone']; ?><br/>
                <a href="mailto:<?php echo  $address['email']; ?>"><?php echo  $address['email']; ?></a>
            </td>

            <td>
                <?php echo $address['address1']; ?>
                <?php echo (!empty($address['address2'])) ? '<br/>'.$address['address2'] : ''; ?>
            </td>

            <td>
                <?php echo $address['city']; ?>, <?php echo $address['zone']; ?> <?php echo $address['zip']; ?>
            </td>

            <td><?php echo $address['country']; ?></td>

            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo site_url('admin/customers/address_form/'.$customer->id.'/'.$address['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo site_url('admin/customers/deleteAddress/'.$customer->id.'/'.$address['id']); ?>" onclick="return areyousure();"><i class="fa fa-times" aria-hidden="true"></i></a>
                </div>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
