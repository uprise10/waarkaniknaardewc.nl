<?php
/**
 * The template for displaying search results pages.
 *
 */

get_header(); ?>

<div class="block searchresults">

	<div class="inner">

		<div class="content">

			<?php if ( have_posts() ) : ?>

				<header class="intro">
					<h1><?php printf( __( 'Resultaten voor: <span>%s</span>', 'ibpix' ), get_search_query() ); ?></h1>
				</header>

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>

					<?php
					/*
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', 'search' );

				// End the loop.
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination( array(
					'screen_reader_text' => ' ',
					'prev_text'          => __( 'Vorige', 'ibpix' ),
					'next_text'          => __( 'Volgende', 'ibpix' ),
					//'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ibpix' ) . ' </span>',
				) );

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'content', 'none' );
			endif;
			?>

		</div>

	</div>

</div>

<?php get_footer(); ?>
