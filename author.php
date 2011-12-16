<?php get_header(); ?>


		<article id="content" role="main" class="author">

		<?php if ( have_posts() ) the_post(); ?>

			<header>
				<?php echo blaskan_avatar( get_the_author_meta( 'user_email' ) ); ?>

				<h1 class="author-title"><?php the_author(); ?></h1>
			</header>

			<?php if ( get_the_author_meta( 'description' ) ): ?>
				<div class="author-description"><?php echo nl2br( get_the_author_meta( 'description' ) ); ?></div>
			<?php endif; ?>

      <h2 class="author-posts"><?php _e( 'Posts', 'blaskan' ); ?></h2>
			<?php rewind_posts(); ?>
			<ul><?php get_template_part( 'loop', 'author' ); ?></ul>

		</article>
	<!-- / #content -->

	<?php get_sidebar(); ?>

	<?php get_footer(); ?>