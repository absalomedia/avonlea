<?php pageHeader(lang('shipping_modules')) ?>

<?php if (count($shipping_modules) > 0) : ?>
    <table class="pure-table pure-table-horizontal">
        <tbody>
        <?php foreach ($shipping_modules as $module) : ?>
            <tr>
                <td><?php echo $module['name']; ?></td>
                <td>
                    <span class="btn-group pull-right">
                <?php if (array_key_exists($module['class'], $enabled_modules)) : ?>
                    <a class="pure-button" href="<?php echo site_url('admin/'.$module['key'].'/form/'); ?>"><i class="fa fa-gear" aria-hidden="true"></i></a>
                    <a class="pure-button button-danger" href="<?php echo site_url('admin/'.$module['key'].'/uninstall/'); ?>" onclick="return areyousure();"><i class="fa fa-times" aria-hidden="true"></i></a>
                <?php else : ?>
                    <a class="btn btn-success" href="<?php echo site_url('admin/'.$module['key'].'/install/'); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                <?php endif; ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>
