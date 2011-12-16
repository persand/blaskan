<?php

/**
 * Credits:
 * http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
 */

add_action( 'admin_init', 'blaskan_options_init' );
add_action( 'admin_menu', 'blaskan_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function blaskan_options_init(){
	register_setting( 'theme_options', 'blaskan_options', 'blaskan_options_validate' );
	register_taxonomy_for_object_type( 'post_tag', 'page' );
  register_taxonomy_for_object_type( 'category', 'page' );
}

/**
 * Load up the menu page
 */
function blaskan_options_add_page() {
	add_theme_page( __( 'Theme Options', 'blaskan' ), __( 'Theme Options', 'blaskan' ), 'edit_theme_options', 'theme_options', 'blaskan_options_do_page' );
}

/**
 * Create arrays for the sidebars on pages options
 */
$sidebars_options = array(
	'2' => array(
		'value' =>	'two_sidebars',
		'label' => __( 'Up to two sidebars', 'blaskan' )
	),
	'1' => array(
		'value' =>	'one_sidebar',
		'label' => __( 'Up to one sidebar', 'blaskan' )
	)
);

/**
 * Create the options page
 */
function blaskan_options_do_page() {
	global $sidebars_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'blaskan' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'blaskan' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'theme_options' ); ?>
			<?php $options = get_option( 'blaskan_options' ); ?>

			<table class="form-table">

			  <tr><th colspan="2"><strong><?php _e( 'Layout', 'blaskan' ); ?></strong></th></tr>

			  <?php
				/**
				 * Content layout
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Sidebars', 'blaskan' ); ?></th>
					<td>
						<select name="blaskan_options[sidebars]">
							<?php
								$selected = $options['sidebars'];
								$p = '';
								$r = '';
								foreach ( $sidebars_options as $option ) {
									$label = __($option['label'], 'blaskan');
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="blaskan_options[sidebars]"><?php _e( 'Up to only one sidebar will result in a wider content column.', 'blaskan' ); ?></label>
					</td>
				</tr>

			  <?php
				/**
				 * Custom sidebars in pages?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Custom sidebars', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[custom_sidebars_in_pages]" name="blaskan_options[custom_sidebars_in_pages]" type="checkbox" value="1" <?php checked( '1', $options['custom_sidebars_in_pages'] ); ?> />
						<label class="description" for="blaskan_options[custom_sidebars_in_pages]"><?php _e( 'Use custom sidebars in pages.', 'blaskan' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Do not hide content in listings on small screens?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Content in listings', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[show_content_in_listings]" name="blaskan_options[show_content_in_listings]" type="checkbox" value="1" <?php checked( '1', $options['show_content_in_listings'] ); ?> />
						<label class="description" for="blaskan_options[show_content_in_listings]"><?php _e( "Show content in listings on small screens (recommended for photo blogs).", 'blaskan' ); ?></label>
					</td>
				</tr>

        <tr><th colspan="2"><strong><?php _e( 'Header', 'blaskan' ); ?></strong></th></tr>

				<?php
				/**
				 * Header message
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header message', 'blaskan' ); ?></th>
					<td>
						<textarea id="blaskan_options[header_message]" class="large-text" cols="50" rows="10" name="blaskan_options[header_message]"><?php echo stripslashes( $options['header_message'] ); ?></textarea>
						<label class="description" for="blaskan_options[header_message]"><?php _e( 'A message that is displayed in the header. Falls back to the blog description if empty.', 'blaskan' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Header image height
				 */
				if ( empty ( $options['header_image_height'] ) || !is_numeric ( $options['header_image_height'] ) ) {
					$header_image_height = '160';
				} else {
					$header_image_height = $options['header_image_height'];
				}
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header image height', 'blaskan' ); ?></th>
					<td>
						<input type="text" id="blaskan_options[header_image_height]" name="blaskan_options[header_image_height]" value="<?php echo $header_image_height; ?>" /> px<br/>
						<label class="description" for="blaskan_options[header_image_height]"><?php _e( 'The height of the image in the header', 'blaskan' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Hide site title and header message?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Hide site title and header message?', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[hide_site_title_header_message]" name="blaskan_options[hide_site_title_header_message]" type="checkbox" value="1" <?php checked( '1', $options['hide_site_title_header_message'] ); ?> />
						<label class="description" for="blaskan_options[hide_site_title_header_message]"><?php _e( "Hide", 'blaskan' ); ?></label><br/>
						<small style="color: #666"><?php _e( "Might be useful if you're using a custom header.", 'blaskan' ); ?></small>
					</td>
				</tr>

				<tr><th colspan="2"><strong><?php _e( 'Footer', 'blaskan' ); ?></strong></th></tr>

				<?php
				/**
				 * Footer message
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Footer message', 'blaskan' ); ?></th>
					<td>
						<textarea id="blaskan_options[footer_message]" class="large-text" cols="50" rows="10" name="blaskan_options[footer_message]"><?php echo stripslashes( $options['footer_message'] ); ?></textarea>
						<label class="description" for="blaskan_options[footer_message]"><?php _e( 'A message that is displayed in the footer.', 'blaskan' ); ?></label>
					</td>
				</tr>

				<tr><th colspan="2"><strong><?php _e( 'Support Blaskan', 'blaskan' ); ?></strong></th></tr>

				<?php
				/**
				 * Show credits?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Show credits', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[show_credits]" name="blaskan_options[show_credits]" type="checkbox" value="1" <?php checked( '1', $options['show_credits'] ); ?> />
						<label class="description" for="blaskan_options[show_credits]"><?php _e( 'Display links to the Blaskan theme and WordPress.org in the footer.', 'blaskan' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'blaskan' ); ?>" />
			</p>
		</form>

		<p style="color: #777; margin-top: 30px;">
			<?php printf( __( '<a href="%s">%s</a> is designed and developed by <a href="%s">%s</a>. Please report bugs and provide feedback on <a href="%s">GitHub</a>.', 'blaskan' ), 'http://www.blaskan.net', 'Blaskan', 'http://www.helloper.com', 'Per Sandström', 'http://github.com/persand/blaskan' ); ?>
		</p>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function blaskan_options_validate( $input ) {
	// Validate layout options
	if ( $input['sidebars'] !== 'one_sidebar' ) {
		$input['sidebars'] = 'two_sidebars';
	} else {
		$input['sidebars'] = 'one_sidebar';
	}

	// Our custom sidebars value is either 0 or 1
	if ( ! isset( $input['custom_sidebars_in_pages'] ) )
		$input['custom_sidebars_in_pages'] = null;
	$input['custom_sidebars_in_pages'] = ( $input['custom_sidebars_in_pages'] == 1 ? 1 : 0 );

	// Do not hide content in listings on small screens?
	if ( ! isset( $input['show_content_in_listings'] ) )
		$input['show_content_in_listings'] = null;
	$input['show_content_in_listings'] = ( $input['show_content_in_listings'] == 1 ? 1 : 0 );

	// Header message may contain allowed HTML tags
	$input['header_message'] = wp_filter_post_kses( $input['header_message'] );

	// Hide site title and header message?
	if ( ! isset( $input['hide_site_title_header_message'] ) )
		$input['hide_site_title_header_message'] = null;
	$input['hide_site_title_header_message'] = ( $input['hide_site_title_header_message'] == 1 ? 1 : 0 );

	// Header image height
	$input['header_image_height'] = esc_attr( $input['header_image_height'] );

	// Footer message may contain allowed HTML tags
	$input['footer_message'] = wp_filter_post_kses( $input['footer_message'] );

	// Our show_credits value is either 0 or 1
	if ( ! isset( $input['show_credits'] ) )
		$input['show_credits'] = null;
	$input['show_credits'] = ( $input['show_credits'] == 1 ? 1 : 0 );

	return $input;
}
