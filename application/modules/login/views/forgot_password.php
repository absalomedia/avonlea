<div id="wrapper">
    <div class="cover-image client"></div>
    <div id="forgot" data-cols="1/2" class="animate form">
    <section class="login_content">
        <h1><?php echo lang('forgot_password');?></h1>

    <?php if (validation_errors()) :?>
        <div class="alert red">
            <?php echo validation_errors();?>
        </div>
    <?php endif;

        $attributes = array('class' => 'pure-form pure-form-stacked');
        echo form_open('forgot-password', $attributes); ?>

            <div class="pure-control-group">
                <label for="email"><?php echo lang('email');?></label>
                <input type="email" name="email"/>
            </div>

        <input type="hidden" value="submitted" name="submitted"/>

        <input type="submit" value="<?php echo lang('reset_password');?>" class="pure-button pure-button-primary"/>
    </form>

    <div style="text-align:center;">
        <a href="<?php echo site_url('login'); ?>"  class="button-xsmall button-secondary pure-button"><?php echo lang('return_to_login');?></a>
    </div>
        </section>
    </div>
  </div>
