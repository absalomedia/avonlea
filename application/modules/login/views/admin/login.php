   <div id="wrapper">
    <div id="login" data-cols="1/2" class="animate form">
        <section class="login_content">
            <h1><?php echo lang('login');?></h1>

        <?php
        $attributes = array('class' => 'pure-form pure-form-stacked', 'id' => 'loginForm');
        echo form_open('admin/login') ?>

            <div class="pure-control-group">
                <label for="username"><?php echo lang('username');?></label>
                <?php echo form_input(array('name'=>'username', 'class'=>'form-control')); ?>
            </div>
            <div class="pure-control-group">
                <label for="password"><?php echo lang('password');?></label>
                <?php echo form_password(array('name'=>'password', 'class'=>'form-control')); ?>
            </div>

            <div class="pure-controls">
                <label class="pure-checkbox">
                    <?php echo form_checkbox(array('name'=>'remember', 'value'=>'true'))?>
                    <?php echo lang('stay_logged_in');?>
                </label>
            </div>

            <input class="pure-button pure-button-primary" type="submit" value="<?php echo lang('login');?>"/>

            <input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
            <input type="hidden" value="submitted" name="submitted"/>

        <?php echo  form_close(); ?>

        <div class="text-center">
            <a href="<?php echo site_url('admin/forgot-password');?>" class="button-xsmall button-secondary pure-button"><?php echo lang('forgot_password');?></a>
        </div>
        </section>
    </div>
</div>
