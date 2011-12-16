
<?php if ( ! have_posts() && ! is_front_page() ) : ?>
	<article id="post-0">
		<header>
			<h1><?php _e( 'Not Found', 'blaskan' ); ?></h1>
		</header>

		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'blaskan' ); ?></p>
		<?php get_search_form(); ?>
	</article>
	<!-- /#post-0 -->
<?php elseif ( ! have_posts() && is_front_page() ) : ?>
	<?php // We cant have #content empty. That would break sidebars. ?>
	&nbsp;
<?php endif; ?>

<?php // Start the loop ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php if ( ( is_archive() || is_author() ) && ( !is_category() && !is_tag() ) ) : // Archives ?>
		<li>
		  <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
		  <time datetime="<?php the_date('c'); ?>"><?php print get_the_date(); ?></time>
		</li>
	<?php else: // Else ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php if ( has_post_thumbnail() ) : ?>
				  <figure class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</figure>
				<?php endif; ?>

			  <?php if ( get_post_type() !== 'page' ): ?>
				  <time datetime="<?php the_date('c'); ?>" pubdate><?php print get_the_date(); ?></time>
				<?php endif; ?>

				<?php if ( !is_single() && get_the_title() ) : ?>
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ); ?>">
							<?php the_title(); ?>
						</a>
					</h1>
				<?php elseif ( get_the_title() ): ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>
			</header>

			<div class="content">
	<?php if ( is_search() || is_archive() ) : ?>
			<?php the_excerpt(); ?>
	<?php else : ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blaskan' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<nav class="page-link" role="navigation">' . __( 'Pages:', 'blaskan' ), 'after' => '</nav>' ) ); ?>
	<?php endif; ?>

			<?php if ( !is_single() && !get_the_title() ) : ?>
				<p>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ); ?>">
					<?php _e( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blaskan' ); ?>
					</a>
				</p>
			<?php endif; ?>
			</div>
			<!-- / .content -->

			<footer>
			  <?php if ( get_post_type() !== 'page' ): ?>
				  <span class="author"><span class="author-label"><?php _e( 'Written by', 'blaskan' ); ?></span> <?php the_author_posts_link(); ?></span>
				<?php endif; ?>
				<?php if ( !is_single() ): ?>
					<span class="comments"><?php comments_popup_link( __( 'No comments', 'blaskan' ), __( '<span>1</span> Comment', 'blaskan' ), __( '<span>%</span> Comments', 'blaskan' ) ); ?></span>
				<?php endif; ?>
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="categories">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'blaskan' ), 'categories-label', get_the_category_list( ', ' ) ); ?>
					</span>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tags">
						<?php printf( __( '<span class="%1$s">Tagged with</span> %2$s', 'blaskan' ), 'tags-label', $tags_list ); ?>
					</span>
				<?php endif; ?>

				<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit">', '</span>' ); ?>
			</footer>
		</article>
		<!-- / #post-<?php the_ID(); ?> -->

		<?php comments_template( '', true ); ?>

		<?php if ( is_single() ): ?>
		  <nav class="post-nav" role="navigation">
				<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'blaskan' ) . '</span> %title' ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'blaskan' ) . '</span>' ); ?></div>
			</nav>
			<!-- / .post-nav -->
		<?php endif; ?>

	<?php endif; // End check which loop to display ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav class="post-nav" role="navigation">
		<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'blaskan' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'blaskan' ) ); ?></div>
	</nav>
	<!-- / .post-nav -->
<?php endif; ?>
