<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage ibpix
 * @since ibpix 1.0
 */
?>

<section class="block no-results not-found">
	<header>
		<h1>Niets gevonden</h1>
	</header>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.'), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p>Sorry, maar wij hebben niets kunnen vinden dat overeenkomt met uw zoekopdracht. Probeer het nog eens met een ander zoekopdracht.</p>
		<?php get_search_form(); ?>

	<?php else : ?>

		<p>Het lijkt er op dat we niet kunnen vinden wat u zoekt. Misschien dat zoeken helpt.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

</section>