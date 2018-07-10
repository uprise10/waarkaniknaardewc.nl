<?php get_header(); ?>
    <main>
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            ?>

            <article class="block article_block">
                <div class="inner">

                    <div class="content article">

                        <p class="nieuwsDate">Geplaatst op <?php echo get_the_date('d M Y'); ?> door <?php the_author(); ?></p>

                        <?php the_title('<h1 class="nieuwsTitel">', '</h1>'); ?>
                        <?php the_content(); ?>

                    </div>

                </div>
            </article>

        <?php endwhile; ?>

    </main>
<?php get_footer(); ?>