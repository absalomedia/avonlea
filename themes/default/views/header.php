<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : '';
echo config_item('company_name'); ?></title>

<link rel="shortcut icon" href="<?php echo theme_img('favicon.png');?>" type="image/png" />
<?php if (isset($meta)) :?>
<?php echo (strpos($meta, '<meta') !== false) ? $meta : '<meta name="description" content="'.$meta.'" />';?>
<?php else :?>
    <meta name="keywords" content="<?php echo config_item('default_meta_keywords');?>" />
    <meta name="description" content="<?php echo config_item('default_meta_description');?>" />
<?php endif;?>

<link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

<?php
$_css = new CSSCrunch();

/*
$_css->addFile('gumbo/normalize');
$_css->addFile('gumbo/base');
$_css->addFile('gumbo/text');
$_css->addFile('gumbo/banners');
$_css->addFile('gumbo/buttons');
$_css->addFile('gumbo/alerts');
$_css->addFile('gumbo/forms');
$_css->addFile('gumbo/grid');
$_css->addFile('gumbo/tabs');
$_css->addFile('gumbo/tables');
$_css->addFile('gumbo/pagination');
$_css->addFile('gumbo/nav');
$_css->addFile('gumbo/colors');
$_css->addFile('gumbo/tray');
*/

$_css->addFile('fonts');
$_css->addFile('animate.min');
$_css->addFile('pure.min');
$_css->addFile('icono.min');
$_css->addFile('styles');
$_css->addFile('profiler');

$_js = new JSCrunch();
$_js->addFile('jquery');
$_js->addFile('jquery.spin');

/*
$_js->addFile('gumbo');
$_js->addFile('profiler');
$_js->addFile('elementQuery.min');
*/

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
</head>
<body>

<header class="header" roler="banner">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="<?php echo base_url();?>">AVL</a>

        <ul class="pure-menu-list" role="navigation">
            <?php if (CI::Login()->isLoggedIn(false, false)) :?>
                            <li class="pure-menu-item"><a href="<?php echo  site_url('my-account');?>" class="pure-menu-link"><?php echo lang('my_account')?></a></li>
                            <li class="pure-menu-item"><a href="<?php echo site_url('logout');?>" class="pure-menu-link"><?php echo lang('logout');?></a></li>
                        <?php else : ?>
                            <li class="pure-menu-item"><a href="<?php echo site_url('login');?>" class="pure-menu-link"><?php echo lang('login');?></a></li>
                        <?php endif; ?>
                        <li class="pure-menu-item">
                            <a href="<?php echo site_url('checkout');?>" class="pure-menu-link"><i class="icono-cart"></i></a>
                        </li>
                    <li class="pure-menu-item" role="search">
                        <?php echo form_open('search', 'class="navbar-search pull-right"');?>
                    <div class="btn-group">
                        <div><input type="text" name="term" class="search-query" placeholder="<?php echo lang('search');?>"/></div>
                        <div><input type="submit" value="<?php echo lang('search');?>"/></div>
                    </div>
                </form>
                </li>
        </ul>
    </div>
</header>
<main role="main" class="main">
    <?php if (CI::session()->flashdata('message')) :?>
        <div class="alert blue">
            <?php echo CI::session()->flashdata('message');?>
        </div>
    <?php endif;?>

    <?php echo CI::breadcrumbs()->generate(); ?>
