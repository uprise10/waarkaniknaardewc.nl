<?php get_header(); ?>

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

        $work_title = get_field('bedrijfsnaam');
        ?>

        <header class="block title_block">
            <div class="inner">

                <div class="content">

                    <?php the_title('<h1>','</h1>');?>
                    <p><?php echo $work_title; ?></p>

                </div>

            </div>
        </header>

        <article class="block article_block">
            <div class="inner">

                <div class="content article">

                    <?php the_content(); ?>

                    <div class="info_footer">
                        <a class="button green"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a class="button green"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a class="button green"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a class="button green">website <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>

                </div>

            </div>
        </article>

    <?php endwhile; ?>

    <?php get_template_part('content-overige-ervaringen'); ?>

<?php get_footer(); ?>