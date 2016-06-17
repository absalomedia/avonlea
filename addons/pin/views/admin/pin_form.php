
        <h1><?php echo lang('pin_payments'); ?></h1>

<?php echo form_open_multipart('admin/pin/form', ['class' => 'pure-form pure-form-stacked']); ?>
                <div class="pure-control-group">
                	<label class="switch-light switch-ios" onclick="">
  						<input type="checkbox" name="<?php echo lang('status'); ?>">
						  <strong>
    					<?php echo lang('status'); ?>
  						</strong>
					  <span aria-hidden="true">
  					  <span>Disabled</span>
  					  <span>Enabled</span>
  					  <a></a>
  					</span>
					</label>
                        <?php echo form_hidden('enabled', assign_value('enabled', $enabled)); ?>
                </div>
				<div class="pure-control-group">
                    <label for="<?php echo lang('secret_key'); ?>"><?php echo lang('secret_key'); ?></label>
                    <?php echo form_input(['name' => 'secret_key', 'class' => 'form-control', 'value' => set_value('secret_key')]); ?>
                </div>
  				<div class="pure-control-group">
  					<label class="switch-light switch-ios" onclick="">
  						<input type="checkbox" name="<?php echo lang('testmode'); ?>">
						  <strong>
    					<?php echo lang('testmode'); ?>
  						</strong>
					  <span aria-hidden="true">
  					  <span>On</span>
  					  <span>Off</span>
  					  <a></a>
  					</span>
					</label>
                </div>
           <div class="form-actions">
	<button class="pure-button button-secondary"><?php echo lang('cancel'); ?></button>
    <button type="submit" class="pure-button pure-button-primary"><?php echo lang('save'); ?></button>
</div>
</div>    
</div>    
</form>
<script type="text/javascript">
$(function() {
    $('input[name=Status]').change(function(){
        if ($(this).val() == "on") {
            $('input[name=enabled]').val(1);
            alert($('input[name=enabled]').val());
        } else {
            $('input[name=enabled]').val(0);
        }
    });
});


$('form').submit(function() {
    $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
});
</script>
