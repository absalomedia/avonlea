<?php pageHeader(lang('canned_message_form')) ?>

<?php echo form_open('admin/settings/canned_message_form/'.$optn); ?>

    <div class="pure-control-group">
        <label for="name"><?php echo lang('label_canned_name'); ?></label>
        <?php
        $name_array = ['name' => 'name', 'class' => 'form-control', 'value' => assign_value('name', $name)];

        if (!$deletable) {
            $name_array['class'] = 'form-control disabled';
            $name_array['readonly'] = 'readonly';
        }
        echo form_input($name_array); ?>
    </div>

    <div class="pure-control-group">
        <label for="subject"><?php echo lang('label_canned_subject'); ?> </label>
        <?php echo form_input(['name' => 'subject', 'class' => 'form-control', 'value' => assign_value('subject', $subject)]); ?>
    </div>

    <div class="pure-control-group">
        <label for="description"><?php echo lang('label_canned_description'); ?></label>
        <?php echo form_textarea(['name' => 'content', 'class' => 'redactor', 'value' => assign_value('content', $content)]); ?>
    </div>

    <input class="pure-button pure-button-primary" type="submit" value="<?php echo lang('save'); ?>"/>

</form>

<script type="text/javascript">
    $('form').submit(function() {
        $('input[type="submit"]').attr('disabled', true).addClass('disabled');
    });
</script>
