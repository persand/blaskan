<!DOCTYPE html>
<!--[if IEMobile 7 ]><html id="blaskan" class="no-js iem7" <?php language_attributes(); ?>><![endif]-->
<!--[if lt IE 7 ]><html id="blaskan" class="no-js ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html id="blaskan" class="no-js ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html id="blaskan" class="no-js ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html id="blaskan" class="no-js ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html id="blaskan" class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php blaskan_head_title(); ?></title>
	<?php wp_head(); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>
<body <?php body_class(); ?>>
<?php echo blaskan_top(); ?>
<div id="site">
	<div id="wrapper">
		<header id="header" role="banner">
		  <?php echo blaskan_header_structure(); ?>
		</header>
		<!-- / #header -->
