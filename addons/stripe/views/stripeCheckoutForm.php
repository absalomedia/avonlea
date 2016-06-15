<div class="page-header">
    <?php echo lang('stripe_payment'); ?>
</div>

<button class="blue" id="btn_stripe" onclick="StripeSubmitOrder()"><?php echo lang('submit_order'); ?></button>

<script>
function StripeSubmitOrder()
{
    $('#btn_stripe').attr('disabled', true).addClass('disabled');

    $.post('<?php echo base_url('/stripe/process-payment'); ?>', function(data){
        if(data.errors != undefined)
        {
            var error = '<div class="alert red">';
            $.each(data.errors, function(index, value)
            {
                error += '<p>'+value+'</p>';
            });
            error += '</div>';

            $.gumboTray(error);
            $('#btn_stripe').attr('disabled', false).addClass('disabled');
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
