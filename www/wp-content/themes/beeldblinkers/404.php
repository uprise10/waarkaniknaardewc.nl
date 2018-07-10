<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage landmerc
 * @since ibpix 1.0
 */

get_header(); ?>

	<div class="block">

		<div class="inner">

			<div class="content article">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title">Oops! Deze pagina kon niet gevonden worden</h1>
					</header>

					<div class="page-content">
						<p>Misschien dat zoeken helpt?</p>

						<?php get_search_form(); ?>
					</div>
				</section>

			</div>

		</div>

	</div>

<?php get_footer(); ?>