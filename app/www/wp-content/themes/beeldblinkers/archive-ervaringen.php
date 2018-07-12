<?php get_header();

    $archive_title = get_field('ervaringen_titel', 'option');
    $archive_desc = get_field('ervaringen_omschrijving', 'option');
    ?>

    <article class="block">

        <div class="inner">
            <div class="content">

                <div class="intro">
                    <?php if(!empty($archive_title)) {
                        echo '<h1>' . $archive_title . '</h1>';
                    } else { ?>
                        <h1><?php post_type_archive_title(); ?></h1>
                    <?php } ?>

                    <?php if(!empty($archive_desc)) {
                        echo $archive_desc;
                    } ?>
                </div>

            </div>
        </div>
    </article>

    <?php
    // Start the loop.
    $i=0;
    while ( have_posts() ) : the_post();

        // get acf fields related to each post
        $image_big = get_field('foto_groot');
        $quote = get_field('quote');
        $name_company = get_field('bedrijfsnaam');
        $i++;
        if ($i % 2 == 0) {
            $text_position_class = ' img-left';
        } else {
            $text_position_class = '';
        }
        ?>

        <article class="block quote_sameheight-img<?php echo $text_position_class; ?>">

            <div class="inner">

                <div class="content">

                    <div class="text grey">

                        <blockquote>
                            <?php echo $quote; ?>
                        </blockquote>

                        <p class="person"><?php the_title('',''); ?> <span>| <?php echo $name_company; ?></span></p>

                        <a class="button" href="<?php the_permalink(); ?>">Lees het verhaal <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                    </div>

                    <div class="image">
                        <img src="<?php echo $image_big['url']; ?>">
                    </div>

                </div>
            </div>
        </article>

    <?php endwhile; ?>

<?php get_footer(); ?>