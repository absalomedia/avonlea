  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

      <div class="cover-image client"></div>

        <div id="wrapper">
        <div id="login" data-cols="1/2" class="animate form">
        <section class="login_content">
            <h1><?php echo lang('login'); ?></h1>
        <?php
            $attributes = ['class' => 'pure-form pure-form-stacked', 'id' => 'loginForm'];
             echo form_open('login/'.$redirect, $attributes); ?>

            <div class="pure-control-group">
                <label for="email"><?php echo lang('email'); ?></label>
                <input type="email" name="email"/>
            </div>
            <div class="pure-control-group">
                <label for="password"><?php echo lang('password'); ?></label>
                <input type="password" name="password"/>
            </div>

            <div class="pure-controls">
            <label class="pure-checkbox">
                <input name="remember" value="true" type="checkbox" />
                    <?php echo lang('keep_me_logged_in'); ?>
            </label>

            <input type="submit" value="<?php echo lang('form_login'); ?>" name="submit" class="pure-button pure-button-primary"/>
            </div>
        </form>

        <div style="text-align:center;">
            <a href="<?php echo site_url('forgot-password'); ?>" class="button-xsmall button-secondary pure-button"><?php echo lang('forgot_password')?></a> |
            New to AVL? <a href="#toregister" class="button-xsmall button-secondary pure-button"><?php echo lang('form_register')?></a>
        </div>
        </section>
      </div>

      <div id="register"  data-cols="1/2" class="animate form">
        <section class="login_content">
            <h1><?php echo lang('form_register'); ?></h1>
        <?php  $attributes2 = ['class' => 'pure-form pure-form-stacked', 'id' => 'registration_form'];
                echo form_open('register', $attributes2); ?>

            <input type="hidden" name="submitted" value="submitted" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />

            <div class="pure-control-group">
            <label for="company"><?php echo lang('account_company'); ?></label>
            <?php echo form_input(['name' => 'company', 'value' => assign_value('company')]); ?>
            </div>

            <div class="pure-control-group">
                    <label for="account_firstname"><?php echo lang('account_firstname'); ?></label>
                    <?php echo form_input(['name' => 'firstname', 'value' => assign_value('firstname')]); ?>
            </div>

            <div class="pure-control-group">
                    <label for="account_lastname"><?php echo lang('account_lastname'); ?></label>
                    <?php echo form_input(['name' => 'lastname', 'value' => assign_value('lastname')]); ?>
            </div>

            <div class="pure-control-group">
                    <label for="account_email"><?php echo lang('account_email'); ?></label>
                    <?php echo form_input(['name' => 'email', 'value' => assign_value('email')]); ?>
            </div>

            <div class="pure-control-group">
                    <label for="account_phone"><?php echo lang('account_phone'); ?></label>
                    <?php echo form_input(['name' => 'phone', 'value' => assign_value('phone')]); ?>
            </div>

            <div class="pure-controls">
            <label class="pure-checkbox">
                <input type="checkbox" name="email_subscribe" value="1" <?php echo set_radio('email_subscribe', '1', true); ?>/> <?php echo lang('account_newsletter_subscribe'); ?>
            </label>
            </div>

            <div class="pure-control-group">
                    <label for="account_password"><?php echo lang('account_password'); ?></label>
                    <input type="password" name="password" autocomplete="off" />
            </div>

            <div class="pure-control-group">
                    <label for="account_confirm"><?php echo lang('account_confirm'); ?></label>
                    <input type="password" name="confirm" autocomplete="off" />
            </div>

            <input type="submit" value="<?php echo lang('form_register'); ?>" class="pure-button pure-button-primary" />
        </form>
                <div style="text-align:center;">
            New to AVL? <a href="#tologin" class="button-xsmall button-secondary pure-button"><?php echo lang('login')?></a>
        </div>
        </section>
    </div>

    <script>
    <?php if (isset($registrationErrors)) :?>

        var formErrors = <?php echo json_encode($registrationErrors); ?>

        for (var key in formErrors) {
            if (formErrors.hasOwnProperty(key)) {
                $('#registration_form').find('[name="'+key+'"]').parent().append('<div class="form-error text-red">'+formErrors[key]+'</div>')
            }
        }
    <?php endif; ?>

    <?php if (isset($loginErrors)) :?>

        var formErrors = <?php echo json_encode($loginErrors); ?>

        for (var key in formErrors) {
            if (formErrors.hasOwnProperty(key)) {
                $('#loginForm').find('[name="'+key+'"]').parent().append('<div class="form-error text-red">'+formErrors[key]+'</div>')
            }
        }
    <?php endif; ?>
    </script>
</div>
