<?php pageHeader(sprintf(lang('zone_area_form'), $zone->name)) ?>

<?php echo form_open('admin/locations/zone_area_form/'.$zone_id.'/'.$optn); ?>

    <div class="pure-control-group">
        <label for="code"><?php echo lang('code'); ?></label>
        <?php
        $data = ['name' => 'code', 'value' => assign_value('code', $code), 'class' => 'form-control'];
        echo form_input($data);
        ?>
    </div>
    
    <div class="pure-control-group">
        <label for="code"><?php echo lang('tax'); ?></label>
        <div class="input-group">
          <span class="input-group-addon">%</span>
                <?php
                $data = ['name' => 'tax', 'class' => 'form-control', 'maxlength' => '10', 'value' => assign_value('tax', $tax)];
                echo form_input($data);
            ?>  
        </div>
    </div>

    <button type="submit" class="pure-button pure-button-primary"><?php echo lang('save'); ?></button>

</form>

<script type="text/javascript">
$('form').submit(function() {
    $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
});
</script>
