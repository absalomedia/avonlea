<div class="page-header">
    <?php echo lang('pin_payments'); ?>
</div>

<button class="blue" id="btn_pin" onclick="PinSubmitOrder()"><?php echo lang('submit_order'); ?></button>

<script>
function PinSubmitOrder()
{
    $('#btn_pin').attr('disabled', true).addClass('disabled');

    $.post('<?php echo base_url('/pin/process-payment'); ?>', function(data){
        if(data.errors != undefined)
        {
            var error = '<div class="alert red">';
            $.each(data.errors, function(index, value)
            {
                error += '<p>'+value+'</p>';
            });
            error += '</div>';

            $.gumboTray(error);
            $('#btn_cod').attr('disabled', false).addClass('disabled');
        }
        else
        {
            if(data.orderId != undefined)
            {
                window.location = '<?php echo site_url('order-complete/'); ?>/'+data.orderId;
            }
        }
    }, 'json');

}
</script>
