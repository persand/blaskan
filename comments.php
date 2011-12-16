
<section id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'blaskan' ); ?></p>
		</section>
		<!-- /#comments -->
		<?php return; ?>
	<?php endif; ?>

	<?php if ( have_comments() ) : ?>
		<h1 id="comments-title"><?php printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'blaskan' ), number_format_i18n( get_comments_number() ) ); ?></h1>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="post-nav" role="navigation">
				<div class="previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'blaskan' ) ); ?></div>
				<div class="next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'blaskan' ) ); ?></div>
			</nav>
			<!-- / .post-nav -->
		<?php endif; ?>

		<ol id="comment-list"><?php wp_list_comments( array( 'callback' => 'blaskan_comment' ) ); ?></ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<footer>
				<nav class="post-nav" role="navigation">
					<div class="previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'blaskan' ) ); ?></div>
					<div class="next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'blaskan' ) ); ?></div>
				</nav>
				<!-- / .post-nav -->
			</footer>
		<?php endif; ?>
	<?php else : ?>
		<?php if ( ! comments_open() && ! is_page() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'blaskan' ); ?></p>
		<?php endif;?>

	<?php endif; // end have_comments() ?>

	<?php
	$commentform = array(
		'fields' => apply_filters( 'comment_form_default_fields',

		array(
			'author' => '<label for="comment-author">' . __( 'Name', 'blaskan' ) .
      ( $req ? ' <span class="required">' . __( '(required)', 'blaskan' ) . '</span>' : '' ) .
			'</label> ' .
      '<input id="comment-author" name="author" type="text" value="' .
      esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"'.
			( $req ? ' aria-required="true"' : '' ) .
			'>',

			'email' => '<label for="comment-email">' . __( 'Email', 'blaskan' ) .
			( $req ? ' <span class="required">' . __( '(required - will be kept a secret)', 'blaskan' ) . '</span>' : '' ) .
			'</label> ' .
      '<input id="comment-email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"'.
			( $req ? ' aria-required="true"' : '' ) .
			'>',

			'url' => '<label for="comment-url">' . __( 'Website', 'blaskan' ) . '</label>' .
       '<input id="comment-url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3">' ) ),

			'comment_field' => '<label for="comment">' . __( 'Comment', 'blaskan' ) . '</label>' .
      '<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>',

			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'blaskan' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'You are logged in as <a href="%s">%s</a>. <a href="%s" title="Log out of this account">Log out?</a></p>', 'blaskan' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ),

			'comment_notes_before' => null,

			'comment_notes_after' => '<dl class="form-allowed-tags"><dt>' . __( 'You may use the following <abbr title="HyperText Markup Language">HTML</abbr>:', 'blaskan' ) . '</dt> <dd><code>' . allowed_tags() . '</code></dd></dl>',

			'id_form' => 'commentform',

			'id_submit' => 'submit',

			'title_reply' => __( 'Post a comment', 'blaskan' ),

			'title_reply_to' => __( 'Leave a Reply to %s', 'blaskan' ),

			'cancel_reply_link' => __( 'Cancel reply', 'blaskan' ),

			'label_submit' => __( 'Post comment', 'blaskan' ),
	);

	comment_form( $commentform );
	?>

</section>
<!-- / #comments -->