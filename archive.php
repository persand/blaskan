<?php get_header(); ?>

		<?php
			if ( have_posts() )
				the_post();
		?>

		<?php if ( is_day() ) : ?>
			<article id="content" role="main">
				<header class="archive-header">
					<h1 class="page-title"><?php printf( __( 'Daily Archives: <time format="%s">%s</time>', 'blaskan' ), get_the_date('c'), get_the_date('j F, Y') ); ?></h1>
				</header>

				<?php rewind_posts(); ?>

				<ul>
				<?php get_template_part( 'loop', 'archive' ); ?>
				</ul>
			</article>
			<!-- / #content -->
		<?php elseif ( is_month() ) : ?>
			<article id="content" role="main">
				<header class="archive-header">
					<h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'blaskan' ), get_the_date('F, Y') ); ?></h1>
				</header>

				<?php rewind_posts(); ?>

				<ul>
				<?php get_template_part( 'loop', 'archive' ); ?>
				</ul>
			</article>
			<!-- / #content -->
		<?php elseif ( is_year() ) : ?>
			<article id="content" role="main">
				<header class="archive-header">
					<h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'blaskan' ), get_the_date('Y') ); ?></h1>
				</header>

				<?php rewind_posts(); ?>

				<ul>
				<?php get_template_part( 'loop', 'archive' ); ?>
				</ul>
			</article>
			<!-- / #content -->
		<?php elseif ( is_tag() ) : ?>
			<section id="content" role="main">
				<header class="archive-header">
					<h1 class="page-title"><?php printf( __( 'Tagged: <span>%s</span>', 'blaskan' ), single_tag_title( '', false ) ); ?></h1>

					<?php if ( tag_description() ): ?>
						<div class="archive-description"><?php echo tag_description(); ?></div>
					<?php endif; ?>
				</header>

				<?php rewind_posts(); ?>

				<?php
				// List both pages and posts
				global $wp_query;
				$args = array_merge( $wp_query->query, array( 'post_type' => array('page', 'post') ) );
				query_posts( $args );
				?>

				<?php get_template_part( 'loop', 'archive' ); ?>
			</section>
			<!-- / #content -->
		<?php elseif ( is_category() ) : ?>
			<section id="content" role="main">
				<header class="archive-header">
					<h1 class="page-title"><?php printf( __( 'Category: <span>%s</span>', 'blaskan' ), single_cat_title( '', false ) ); ?></h1>

					<?php if ( category_description() ): ?>
						<div class="archive-description"><?php echo category_description(); ?></div>
					<?php endif; ?>
				</header>

				<?php rewind_posts(); ?>

				<?php
				// List both pages and posts
				global $wp_query;
				$args = array_merge( $wp_query->query, array( 'post_type' => array('page', 'post') ) );
				query_posts( $args );
				?>

				<?php get_template_part( 'loop', 'archive' ); ?>
			</section>
			<!-- / #content -->
		<?php else : ?>
			<section id="content" role="main">
				<h1 class="title"><?php _e( 'Archives', 'blaskan' ); ?></h1>

				<?php rewind_posts(); ?>

				<?php get_template_part( 'loop', 'archive' ); ?>
			</section>
			<!-- / #content -->
		<?php endif; ?>

	<?php get_sidebar(); ?>

	<?php get_footer(); ?>