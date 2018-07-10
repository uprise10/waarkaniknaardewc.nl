<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage ibpix
 * @since ibpix 1.0
 */
?>

<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php the_title(); ?>" class="searchresult">

	<header>
		<?php the_title('<h2>','</h2>'); ?>
	</header>

	<?php the_excerpt(); ?>

	<p><?php echo esc_url(get_the_permalink()); ?></p>

	<?php if ( 'post' == get_post_type() ) : ?>

	<?php else : ?>

	<?php endif; ?>

</a>

