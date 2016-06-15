<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Install Avonlea Invoicing</title>
<link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url('../themes/default/assets/css/fonts.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('../themes/default/assets/css/pure.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('../themes/default/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('../themes/default/assets/css/styles.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('../assets/js/jquery-2.1.3.min.js'); ?>"></script>

</head>

<body>
<div class="cover-image install"></div>
<div id="wrapper">
    <div id="login" data-cols="1/2" class="animate form">
        <section class="login_content">
        <h1>Avonlea Installer</h1>

    <?php if (isset($errors)) {
        echo $errors;
} ?>

    <form action="<?php echo base_url(); ?>" method="post" class="pure-form pure-form-stacked" accept-charset="utf-8">
                <div class="pure-control-group">
                    <label for="hostname-label">Host Name</label>
                    <?php echo form_input(['name' => 'hostname', 'class' => 'form-control', 'value' => set_value('hostname')]); ?>
                </div>
                <div class="pure-control-group">
                    <label for="database-name-label">Database Name</label>
                    <?php echo form_input(['name' => 'database', 'class' => 'form-control', 'value' => set_value('database')]); ?>
                </div>
                <div class="pure-control-group">
                    <label for="control-label">Username</label>
                    <?php echo form_input(['name' => 'username', 'class' => 'form-control', 'value' => set_value('username')]); ?>
                </div>
                <div class="pure-control-group">
                    <label for="password-label">Password</label>
                    <?php echo form_input(['name' => 'password', 'class' => 'form-control', 'value' => set_value('password')]); ?>
                </div>
                <div class="pure-control-group">
                    <label for="database-prefix-label">Database Table Prefix (ex. avl_)</label>
                    <?php echo form_input(['name' => 'prefix', 'class' => 'form-control', 'value' => set_value('prefix')]); ?>
                </div>

                <div class="alert alert-warning">
                    <p>
                        <strong>Default Login Username</strong><br> Username: admin
                    </p>
                </div>
                <div class="pure-control-group">
                    <label for="admin-password-label">Admin Password</label>
                    <?php echo form_input(['name' => 'admin-password', 'class' => 'form-control', 'value' => set_value('admin-password')]); ?>
                </div>
                <button id="btn_step1" class="pure-button pure-button-primary" type="submit">Install</button>
            </div>
        </div>
    </form>
</div>

<footer>
    <div class="container">
    </div>
</footer>

</body>
</html>
