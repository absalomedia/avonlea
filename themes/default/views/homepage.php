<div class="cover-image client"></div>
    <div id="wrapper">
    <div id="login" data-cols="1/2" class="animate form">
        <section class="login_content">
            <h1><?php echo lang('login');?></h1>
        <?php
            $attributes = array('class' => 'pure-form pure-form-stacked', 'id' => 'loginForm');
            echo form_open('login/', $attributes); ?>

            <div class="pure-control-group">
                <label for="email"><?php echo lang('email');?></label>
                <input type="email" name="email"/>
            </div>
            <div class="pure-control-group">
                <label for="password"><?php echo lang('password');?></label>
                <input type="password" name="password"/>
            </div>

            <div class="pure-controls">
            <label class="pure-checkbox">
                <input name="remember" value="true" type="checkbox" />
                    <?php echo lang('keep_me_logged_in');?>
            </label>

            <input type="submit" value="<?php echo lang('form_login');?>" name="submit" class="pure-button pure-button-primary"/>
            </div>
        </form>

        <div style="text-align:center;">
            <a href="<?php echo site_url('forgot-password'); ?>" class="button-xsmall button-secondary pure-button"><?php echo lang('forgot_password')?></a>
        </div>
        </section>
    </div>
  </div>
