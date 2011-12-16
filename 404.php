<?php get_header(); ?>

	<article id="content" role="main" class="error-404">

		<header><h1><?php _e( '4-uh-oh-4 <span>Page not found...</span>', 'blaskan' ); ?></h1></header>

    <p><?php _e( 'The page you requested could not be found... sorry. Perhaps searching will help?', 'blaskan' ); ?></p>

		<?php get_search_form(); ?>

		<script type="text/javascript">
  		// focus on search field after it has loaded
  		document.getElementById('s') && document.getElementById('s').focus();
  	</script>

	</article>
	<!-- #content -->

<?php get_footer(); ?>