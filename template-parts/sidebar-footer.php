<?php
$footer_layout   = get_theme_mod( 'blaskan_footer_column', 'column-4' );
$number          = str_replace( 'column-', '', $footer_layout );
$active_sidebars = array();

if ( is_active_sidebar( 'footer-sidebar' ) ) {
	$active_sidebars[] = 'footer-sidebar';
}

for ( $i = 2; $i <= $number; $i ++ ) {
	if ( is_active_sidebar( 'footer-sidebar-' . $i ) ) {
		$active_sidebars[] = 'footer-sidebar-' . $i;
	}
}

$columns_classes = array(
	1 => 'col-md-12 col-xs-12',
	2 => 'col-md-6 col-sm-12',
	3 => 'col-md-4 col-sm-12',
	4 => 'col-md-3 col-sm-6 col-xs-12'
);


if ( ! empty( $active_sidebars ) ) { 

	$class = $columns_classes[ count( $active_sidebars ) ];

	?>

    <div class="footer-widgets container">
        <div class="row">
			<?php

			foreach ( $active_sidebars as $sidebar ) {
				echo '<div class="' . $class . '">';
				dynamic_sidebar( $sidebar );
				echo '</div>';
			}

			?>
        </div>
    </div>

<?php } ?>
