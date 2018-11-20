<?php

if( ! is_front_page() ) {
	$logos_titel = get_field( 'logos_titel', 'option' );
	$logos       = get_field( 'logos', 'option' );

	if ( ! empty( $logos ) ) {
		?>
        <article class="block logo_block">
            <div class="inner">
                <div class="content">
                    <div class="intro">
                        <h2><?php echo $logos_titel; ?></h2>
                    </div>
					<?php
					while ( have_rows( 'logos', 'option' ) ) {
						the_row();

						$foto = get_sub_field( 'logo_afbeelding' );
						$link = get_sub_field( 'link' );

						if ( ! empty( $link ) ) {
							if ( ! empty( $foto ) ) {
								echo '<div class="logo-item"><a href="' . $link . '"><img src="' . $foto['url'] . '"></a></div>';
							}
						} else {
							if ( ! empty( $foto ) ) {
								echo '<div class="logo-item"><img src="' . $foto['url'] . '"></div>';
							}
						}
					}
					?>
                </div>
            </div>
        </article>
		<?php
	}
}
?>

<footer class="block footer footer_block text_center">
    <div class="inner">
        <div class="content">
            <div class="column">
                <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
            </div>
            <div class="column">
	            <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
            </div>

            <div class="copyright">&copy; <?php echo date("Y"); ?> Waar kan ik naar de WC</div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
