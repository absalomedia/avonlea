<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AVL <?php echo (isset($page_title)) ? ' :: '.$page_title : ''; ?></title>

<link href='https://fonts.googleapis.com/css?family=Comfortaa|Raleway' rel='stylesheet' type='text/css'>

<?php
$_css = new CSSCrunch();

$_css->addFile('fonts');
$_css->addFile('pure.min');
$_css->addFile('font-awesome.min');
$_css->addFile('styles');
$_css->addFile('admin');
$_css->addFile('profiler');
$_css->addFile('trumbowyg');
$_css->addFile('trumb');
$_css->addFile('flatpickr.min');

$_js = new JSCrunch();
$_js->addFile('jquery-3.0.0.min');
$_js->addFile('jquery-migrate-3.0.0');

?>
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />

<?php


if (true) { //Dev Mode
//in development mode keep all the css files separate
    $_css->crunch(true);
    $_js->crunch(true);
} else {
    //combine all css files in live mode
    $_css->crunch();
    $_js->crunch();
}


//with this I can put header data in the header instead of in the body.
if (isset($additional_header_info)) {
    echo $additional_header_info;
}
?>


<?php if (CI::auth()->isLoggedIn(false, false)) :?>


<?php endif; ?>
</head>
<body>
<?php if (CI::auth()->isLoggedIn(false, false)) :?>
    <div id="layout">
    <!-- Menu toggle -->

        <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
        </a>

    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="#" class="pure-menu-link"><span class="fa fa-cogs"> Avonlea</span></a>
            <ul class="pure-menu-list">
                        <li class="pure-menu-item"><a href="<?php echo site_url('admin/orders'); ?>"><?php echo lang('common_orders'); ?> <span class="caret"></span></a>
                            <?php if (CI::auth()->checkAccess('Admin')) : ?>
                            <ul class="pure-menu-list">
                                <li class="pure-menu-item"><a href="<?php echo site_url('admin/customers'); ?>" class="pure-menu-link"><?php echo lang('common_customers'); ?></a></li>
                                <li class="pure-menu-item"><a href="<?php echo site_url('admin/customers/groups'); ?>" class="pure-menu-link"><?php echo lang('common_groups'); ?></a></li>
                                <li class="pure-menu-item"><a href="<?php echo site_url('admin/reports'); ?>" class="pure-menu-link"><?php echo lang('common_reports'); ?></a></li>
                                <li class="pure-menu-item"><a href="<?php echo site_url('admin/coupons'); ?>" class="pure-menu-link"><?php echo lang('common_coupons'); ?></a></li>
                                <li class="pure-menu-item"><a href="<?php echo site_url('admin/gift-cards'); ?>" class="pure-menu-link"><?php echo lang('common_gift_cards'); ?></a></li>
                            </ul>
                        </li>
                            <?php endif; ?>
                    <?php if (CI::auth()->checkAccess('Admin')) : ?>
                    <li class="pure-menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('common_catalog'); ?> <span class="caret"></span></a></li>
                        <ul class="pure-menu-list">
                            <li class="pure-menu-item"><a href="<?php echo site_url('admin/categories'); ?>" class="pure-menu-link"><?php echo lang('common_categories'); ?></a></li>
                            <li class="pure-menu-item"><a href="<?php echo site_url('admin/products'); ?>" class="pure-menu-link"><?php echo lang('common_products'); ?></a></li>
                            <li class="pure-menu-item"><a href="<?php echo site_url('admin/digital_products'); ?>" class="pure-menu-link"><?php echo lang('common_digital_products'); ?></a></li>
                        </ul>
                    </li>

                    <li class="pure-menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('common_content'); ?> <span class="caret"></span></a>
                        <ul class="pure-menu-list">
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/banners'); ?>" class="pure-menu-link"><?php echo lang('common_banners'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/pages'); ?>" class="pure-menu-link"><?php echo lang('common_pages'); ?></a></li>
                        </ul>
                    </li>

                    <li class="pure-menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('common_administrative'); ?> <span class="caret"></span></a>
                        <ul class="pure-menu-list">
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/settings'); ?>" class="pure-menu-link"><?php echo lang('common_Avonlea_configuration'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/shipping'); ?>" class="pure-menu-link"><?php echo lang('common_shipping_modules'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/payments'); ?>" class="pure-menu-link"><?php echo lang('common_payment_modules'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/settings/canned_messages'); ?>" class="pure-menu-link"><?php echo lang('common_canned_messages'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/locations'); ?>" class="pure-menu-link"><?php echo lang('common_locations'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/users'); ?>" class="pure-menu-link"><?php echo lang('common_administrators'); ?></a></li>
                            <li class="pure-menu-link"<a href="<?php echo site_url('admin/sitemap'); ?>" class="pure-menu-link"><?php echo 'Sitemap'; ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li class="pure-menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('common_actions'); ?> <span class="caret"></span></a>
                        <ul class="pure-menu-list">
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/dashboard'); ?>" class="pure-menu-link"><?php echo lang('common_dashboard'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url(); ?>" class="pure-menu-link"><?php echo lang('common_front_end'); ?></a></li>
                            <li class="pure-menu-link"><a href="<?php echo site_url('admin/logout'); ?>" class="pure-menu-link"><?php echo lang('common_log_out'); ?></a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
<?php endif; ?>
<div class="cover-image manager <?php if (CI::auth()->isLoggedIn(false, false)) :
?>logged<?php
endif; ?>"></div>

<div role="main" id="main" class="main">
      <a href="#nav" class="nav-toggle">Menu</a>
    <div class="content <?php if (CI::auth()->isLoggedIn(false, false)) :
?>admin<?php
endif; ?>">

    <?php
    //lets have the flashdata overright "$message" if it exists
    if (CI::session()->flashdata('message')) {
        $message = CI::session()->flashdata('message');
    }

    if (CI::session()->flashdata('error')) {
        $error = CI::session()->flashdata('error');
    }

    if (function_exists('validation_errors') && validation_errors() != '') {
        $error = validation_errors();
    }
    ?>

    <div id="js_error_container" class="alert alert-error" style="display:none;">
        <p id="js_error"></p>
    </div>

    <div id="js_note_container" class="alert alert-note" style="display:none;">

    </div>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
