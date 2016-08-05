<?php pageHeader(lang('admins')) ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete'); ?>');
}
</script>

<div class="text-right">
    <a class="pure-button pure-button-primary" href="<?php echo site_url('admin/users/form'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo lang('add_new_admin'); ?></a>
</div>

<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th><?php echo lang('firstname'); ?></th>
            <th><?php echo lang('lastname'); ?></th>
            <th><?php echo lang('email'); ?></th>
            <th><?php echo lang('username'); ?></th>
            <th><?php echo lang('access'); ?></th>
            <th/>
        </tr>
    </thead>
    <tbody>
<?php foreach ($admins as $admin) :?>
        <tr>
            <td><?php echo $admin->firstname; ?></td>
            <td><?php echo $admin->lastname; ?></td>
            <td><a href="mailto:<?php echo $admin->email; ?>"><?php echo $admin->email; ?></a></td>
            <td><?php echo $admin->username; ?></td>
            <td><?php echo $admin->access; ?></td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="pure-button" href="<?php echo site_url('admin/users/form/'.$admin->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                    <?php
                    $current_admin = \CI::session()->userdata('admin');
                    if ($current_admin['id'] != $admin->id) : ?>
                    <a class="pure-button button-danger" href="<?php echo site_url('admin/users/delete/'.$admin->id); ?>" onclick="return areyousure();"><i class="fa fa-times " aria-hidden="true"></i></a>
                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         endif; ?>
                </div>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
