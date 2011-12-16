<?php get_header(); ?>

		<section id="content" role="main">
			<?php get_template_part( 'loop', 'attachment' ); ?>
		</section>
		<!-- / #content -->

		<?php get_sidebar(); ?>

		<?php get_footer(); ?>