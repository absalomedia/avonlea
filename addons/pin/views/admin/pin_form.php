<div class="page-header">
    <h2><?php echo lang('pin_payments'); ?></h2>
</div>

<?php echo form_open_multipart('admin/pin/form', array('class' => 'pure-form pure-form-stacked')); ?>
                <div class="pure-control-group">
                    <label for="<?php echo lang('enabled'); ?>"><?php echo lang('enabled'); ?></label>
                    <?php echo form_dropdown('enabled', ['0' => lang('disabled'), '1' => lang('enabled')], assign_value('enabled', $enabled), 'class="form-control"'); ?>
                </div>
				<div class="pure-control-group">
                    <label for="<?php echo lang('secret_key'); ?>"><?php echo lang('secret_key'); ?></label>
                    <?php echo form_input(['name' => 'secret_key', 'class' => 'form-control', 'value' => set_value('secret_key')]); ?>
                </div>

<div class="form-actions">
	<button class="pure-button button-secondary"><?php echo lang('cancel'); ?></button>
    <button type="submit" class="pure-button pure-button-primary"><?php echo lang('save'); ?></button>
</div>
</div>    
</div>    
</form>

<script type="text/javascript">
$('form').submit(function() {
    $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
});
</script>
