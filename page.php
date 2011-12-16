<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="content" role="main" <?php post_class(); ?>>

				<header>
					<?php if ( has_post_thumbnail() ) : ?>
					  <figure class="post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</figure>
					<?php endif; ?>

					<?php if ( get_the_title() ): ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>
				</header>

				<?php the_content(); ?>

				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'blaskan' ), 'after' => '</div>' ) ); ?>

				<footer>
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

					<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit-link">', '</span>' ); ?>
				</footer>

				<?php comments_template( '', true ); ?>

			</article>
			<!-- #content -->

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>