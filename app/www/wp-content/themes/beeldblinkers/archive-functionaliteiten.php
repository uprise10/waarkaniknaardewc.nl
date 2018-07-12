<?php get_header(); ?>

    <article class="block grid_3_icons bg-grey">
        <div class="inner">

            <div class="content">

                <div class="intro">
                    <?php
                    $archive_title = get_field('functionaliteiten_titel', 'option');
                    $archive_desc = get_field('functionaliteiten_omschrijving', 'option');

                    if(!empty($archive_title)) {
                        echo '<h1>' . $archive_title . '</h1>';
                    } else { ?>
                        <h1><?php post_type_archive_title(); ?></h1>
                    <?php } ?>

                    <?php if(!empty($archive_desc)) {
                        echo $archive_desc;
                    } ?>
                </div>

                <div class="overview">

                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                        // get acf fields related to each post
                        $description_small = get_field('korte_overzichts_omschrijving');
                        $mouse_over_text = get_field('mouse_over_omschrijving');
                        $icon = get_field('icoontje');

                        ?>


                        <div class="item">
                            <div class="text">
                                <div class="image">
                                    <img class="img-contain" src="<?php echo $icon['url']; ?>" alt="">
                                </div>
                                <div class="textwrap">
                                    <?php the_title('<h2>','</h2>'); ?>
                                    <p><?php echo $description_small; ?></p>
                                </div>
                            </div>
                            <div class="extra_info">
                                <?php the_title('<h2>','</h2>'); ?>
                                <p><?php echo $mouse_over_text; ?></p>
                            </div>
                        </div>

                    <?php endwhile; ?>


                </div>

            </div>

        </div>
    </article>


<?php get_footer(); ?>