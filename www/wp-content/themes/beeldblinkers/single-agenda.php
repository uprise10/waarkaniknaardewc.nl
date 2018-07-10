<?php get_header(); ?>
    <main>
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            ?>

            <article class="block article_block">
                <div class="inner">

                    <div class="content article">

                        <?php
                        // get raw date
                        $date = get_field('datum', false, false);
                        // make date object
                        $date = new DateTime($date);
                        // echo $date->format('j M Y');
                        ?>
                        <p class="agendaDate"><?php echo $date->format('d M Y'); ?></p>

                        <?php the_title('<h1 class="nieuwsTitel">', '</h1>'); ?>

                        <?php the_content(); ?>

                    </div>

                </div>
            </article>

        <?php endwhile; ?>

    </main>
<?php get_footer(); ?>